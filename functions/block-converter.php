<?php

class BBBlockConverter
{
	private $ignored_blocks = ['core/spacer'];
	private $unsupported_blocks = [
		'acf/call-to-action',
		'acf/card-stroke',
		'acf/card-with-image',
		'acf/card-with-image-bg',
		'acf/custom-anchor',
		'acf/custom-anchor-global',
		'acf/custom-path-swiper',
		'acf/custom-teasers-swiper',
		'acf/facts-swiper',
		'acf/latest-blog-posts',
		'acf/latest-press-releases',
		'acf/newsletter-signup-form',
		'acf/page-teasers',
		'acf/projects',
		'acf/teaser-card-swiper',
		'acf/text-image-float',
		'core/pullquote',
		'core/block',
		'core/core-embed/twitter',
		'core/core-embed/vimeo',
		'core/core-embed/wordpress',
		'core/core-embed/youtube',
		'core/freeform',
		'core/gallery',
		'core/media-text',
		'core/separator',
	];
	private $paragraph_buffer_block_max_length = 4;

	function __construct()
	{
		add_action('admin_menu', function () {
			add_menu_page('Block Converter', 'Block Converter', 'install_plugins', 'bb_block_converter', [$this, 'block_converter_page'], 'dashicons-block-default');
			add_submenu_page('bb_block_converter', 'Unsupported Blocks', 'Unsupported Blocks', 'install_plugins', 'bb_block_converter_audit', [$this, 'unsupported_blocks_page']);
		});

		add_action('wp_ajax_bb_block_converter', [$this, 'ajax_convert_posts']);
	}

	function block_converter_page()
	{
		echo '<div class="wrap">';
		echo '<h1>' . esc_html(get_admin_page_title()) . '</h1>';

		echo '<h2>Convert Post</h2>';
		$this->convert_post_form_results();
		echo '<form method="post">';
		wp_nonce_field('bb_convert_post', 'bb_convert_post_nonce');
		echo '<table class="form-table">';
		echo '<tr>';
		echo '<th scope="row"><label for="post_id">Post ID</label></th>';
		echo '<td><input type="text" name="post_id" id="post_id" value="' . ($_POST['post_id'] ?? '') . '" required></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<th scope="row"><label for="dry_run">Dry Run</label></th>';
		echo '<td><input type="checkbox" name="dry_run" id="dry_run" checked="checked"></td>';
		echo '</tr>';
		echo '</table>';
		submit_button('Convert Post');
		echo '</form>';

		echo '<h2>Batch-convert Posts</h2>';
		echo '<form method="post">';
		wp_nonce_field('bb_convert_post_types', 'bb_convert_post_types_nonce');
		echo '<table class="form-table">';
		echo '<tr>';
		echo '<th scope="row"><label for="post_type">Post Type</label></th>';
		$post_type_options = array_map(function ($post_type) {
			$selected = $post_type == ($_POST['post_type'] ?? '') ? 'selected' : '';
			return "<option value='{$post_type}' {$selected}>{$post_type}</option>";
		}, array_keys(get_post_types()));
		echo '<td><select name="post_type" id="post_type">' . join('', $post_type_options) . '</select></td>';
		echo '</tr>';
		echo '</table>';
		submit_button('Load Posts');
		echo '</form>';

		$this->convert_posts_form_results();

		echo '</div>';
	}

	function unsupported_blocks_page()
	{
		echo '<div class="wrap">';
		echo '<style>#block_audit td span { border-radius: 1em; border: solid 1px black; padding: 4px 6px; }</style>';
		echo '<h1>' . esc_html(get_admin_page_title()) . '</h1>';
		echo '<table id="block_audit" class="wp-list-table striped widefat">';
		echo '<thead><tr><th>Post ID</th><th>Post Title</th><th>Post Type</th><th>Unsupported Blocks</th></tr></thead><tbody>';
		foreach ($this->get_posts_with_unsupported_blocks() as $p) {
			echo '<tr><td>' .
				$this->get_post_edit_a($p['ID']) .
				"</td><td>{$p['post_title']}</td><td>{$p['post_type']}</td><td><span>" .
				join('</span> <span>', $p['unsupported_blocks']) .
				'</span></td></tr>';
		}
		echo '</tbody></table>';
		echo '</div>';
	}

	function convert_posts_form_results()
	{
		if (isset($_POST['bb_convert_post_types_nonce']) && wp_verify_nonce($_POST['bb_convert_post_types_nonce'], 'bb_convert_post_types')) {
			$post_type = $_POST['post_type'];
			// Get all posts ID
			$post_ids = [];
			$query = new WP_Query(['post_type' => $post_type, 'posts_per_page' => -1]);
			while ($query->have_posts()) {
				$query->the_post();
				$post_ids[] = get_the_ID();
			}
			wp_reset_postdata();
			echo '<script>var postsID = ' . json_encode($post_ids) . ', adminURL = "' . admin_url('admin-ajax.php') . '";</script>';
			echo <<<EOF
						<script>
							function convertPosts() {
								var done = 0;
								var batches = [];
								var count = postsID.length;
								var size = 10;
								while (postsID.length > 0) {
									batches.push(postsID.splice(0, size));
								}
								batches.forEach((b) => {
									jQuery.ajax({
										url: adminURL,
										data: {
											action: 'bb_block_converter',
											posts_id: b,
										},
										success: function (data) {
											done += data.length;
											document.getElementById('results').value = done;
										},
										error: function (errorThrown) {
											console.log(errorThrown);
										},
									});
								});
							}
						</script>
			EOF;
			echo '<hr>';
			echo '<p>Ready to convert ' . count($post_ids) . ' posts. <button class="button" onclick="convertPosts()">Convert</button></p>';
			echo '<progress style="width:100%" id="results" max="' . count($post_ids) . '" value="0"></progress>';
		}
	}

	function convert_post_form_results()
	{
		if (isset($_POST['bb_convert_post_nonce']) && wp_verify_nonce($_POST['bb_convert_post_nonce'], 'bb_convert_post') && $_POST['post_id'] != '') {
			$post_id = $_POST['post_id'];
			$dry_run = ($_POST['dry_run'] ?? 'off') == 'on' ? true : false;
			[$post_content, $new_post_content] = $this->convert_post($post_id, $dry_run);
			// Output //
			echo '<h2>Conversion Result</h2>';
			echo '<p>Converted post ' . $this->get_post_edit_a($_POST['post_id']) . ($dry_run ? ' <b>DRY RUN</b> ' : '') . '</p>';
			if ($dry_run) {
				echo '<p><b>Old content:</b></p>';
				echo '<textarea rows="20" cols="100">';
				print_r($post_content);
				echo '</textarea>';
				echo '<p><b>New content:</b></p>';
				echo '<textarea rows="20" cols="100">';
				print_r($new_post_content);
				echo '</textarea>';
			}
		}
	}

	function get_post_edit_a($post_id)
	{
		return "<a href=\"" . get_admin_url() . "post.php?post={$post_id}&action=edit\" target=\"_blank\">{$post_id}</a>";
	}

	function get_posts_with_unsupported_blocks()
	{
		$posts_data = [];
		$query = new WP_Query(['post_type' => 'any', 'posts_per_page' => -1, 'post_status' => ['publish', 'draft', 'private']]);
		while ($query->have_posts()) {
			$query->the_post();
			$p = ['ID' => get_the_ID(), 'post_title' => get_the_title(), 'post_type' => get_post_type(), 'unsupported_blocks' => []];
			foreach ($this->unsupported_blocks as $unsupported_block) {
				if (str_contains(get_the_content(), "<!-- wp:{$unsupported_block} ")) {
					$p['unsupported_blocks'][] = $unsupported_block;
				}
			}
			if (count($p['unsupported_blocks']) > 0) {
				$posts_data[] = $p;
			}
		}
		wp_reset_postdata();
		return $posts_data;
	}

	function convert_block($block)
	{
		if (in_array($block['blockName'], $this->ignored_blocks)) {
			$new_block = ['blockName' => 'tmp/ignore', 'innerHTML' => '', 'innerContent' => []];
			return $new_block;
		}

		switch ($block['blockName']) {
			case 'core/heading':
				// Remove classes
				$block['innerHTML'] = preg_replace('/ ?class=".*?" ?/i', '', $block['innerHTML']);
				// Extract headline type and anchor ID
				preg_match('/<(h.)( id="(.*?)")?>/', $block['innerHTML'], $match);
				$new_block = [
					'blockName' => 'acf/heading',
					'attrs' => [
						'name' => 'acf/heading',
						'data' => [
							'field_6332f0b132592' => strip_tags(trim($block['innerHTML'])), // headline text
							'field_6332f0c432593' => $match[1], // headline type,
							'field_63ef9861a9a68' => $match[3] ?? null, // ID for anchor nav
							'field_6399a788bde81' => 'default', // size
							'field_63f346930b9b5' => 0, // has_bg_color
							'field_63e3a8189c006' => '#ffffff', // bg_color
						],
						'mode' => 'auto',
					],
				];
				break;

			case 'core/paragraph':
				$new_block = [
					'blockName' => 'acf/paragraph',
					'attrs' => [
						'name' => 'acf/paragraph',
						'data' => [
							'field_6332e57c9e5c2' => trim($block['innerHTML']),
							'field_6332e7ddefe75' => 'default',
						],
						'mode' => 'auto',
					],
				];
				break;

			case 'core/list':
				// Here we flatten the block content and convert it to a acf/paragraph
				// FIXME: strip_tags as well?
				$block['noContainers'] = true;
				$new_block = [
					'blockName' => 'acf/paragraph',
					'attrs' => [
						'name' => 'acf/paragraph',
						'data' => [
							'field_6332e57c9e5c2' => trim(render_block($block)),
							'field_6332e7ddefe75' => 'default',
						],
						'mode' => 'auto',
					],
				];
				break;

			case 'core/image':
				$new_block = [
					'blockName' => 'acf/image',
					'attrs' => [
						'name' => 'acf/image',
						'data' => [
							'image' => $block['attrs']['id'],
							'_image' => 'field_6328565a67504',
						],
						'mode' => 'auto',
					],
				];
				break;

			case 'core/quote':
				$quote = '';
				foreach ($block['innerBlocks'] as $innerBlock) {
					$quote .= $innerBlock['innerHTML'];
				}
				$quote = strip_tags($quote, ['p', 'em', 'strong']);
				$source = strip_tags($block['innerHTML']);
				$new_block = [
					'blockName' => 'acf/blockquote',
					'attrs' => [
						'name' => 'acf/blockquote',
						'data' => [
							'field_632dac8f25165' => $quote,
							'field_63fc870875578' => $source,
						],
						'mode' => 'auto',
					],
				];
				break;

			case 'core/spacer':
				$new_block = [
					'blockName' => 'acf/spacer',
					'attrs' => [
						'name' => 'acf/spacer',
						'data' => [
							'field_63ee0802c943c' => 'base', // height
						],
						'mode' => 'auto',
					],
				];
				break;

			case 'core/buttons':
				$new_block = $block;
				$new_block['blockName'] = 'core/group';
				$new_block['innerHTML'] = "<div class=\"wp-block-group has-light-blue-background-color has-background\">\n\n</div>";
				$new_block['innerContent'] = ["<div class=\"wp-block-group has-light-blue-background-color has-background\">", null, '</div>'];
				break;

			case 'core/button':
				preg_match('/<a.*(href="(.*?)")>(.*?)<\/a>/', $block['innerHTML'], $match);
				$new_block = [
					'blockName' => 'acf/button',
					'attrs' => [
						'name' => 'acf/button',
						'data' => [
							'_display' => 'field_63e3acafc838e',
							'_display_color' => 'field_63fddb3f3625d_field_63e3b4bc78fbb',
							'_display_icon' => 'field_63f34d06623df_field_63fdddbc600fd',
							'_display_position' => 'field_63e3af2bd0a99_field_63fddf137717d',
							'_display_size' => 'field_63e3ad06c8390',
							'_display_style' => 'field_63e3acbdc838f',
							'_link' => 'field_63e3aca3c838d',
							'display' => '',
							'display_color' => 'primary',
							'display_icon' => 'none',
							'display_position' => 'justify-start',
							'display_size' => 'btn-base',
							'display_style' => 'btn',
							'link' => ['title' => strip_tags($match[3]) ?? 'Missing Title', 'url' => $match[2] ?? '#', 'target' => ''],
						],
						'mode' => 'auto',
					],
				];
				break;

			case 'acf/organimgramm':
				$new_block = $block;
				$new_block['blockName'] = 'acf/organigramm';
				$new_block['attrs']['name'] = 'acf/organigramm';
				break;

			case 'acf/stoerer':
				$new_block = [
					'blockName' => 'acf/button',
					'attrs' => [
						'name' => 'acf/button',
						'data' => [
							'_display' => 'field_63e3acafc838e',
							'_display_color' => 'field_63fddb3f3625d_field_63e3b4bc78fbb',
							'_display_icon' => 'field_63f34d06623df_field_63fdddbc600fd',
							'_display_position' => 'field_63e3af2bd0a99_field_63fddf137717d',
							'_display_size' => 'field_63e3ad06c8390',
							'_display_style' => 'field_63e3acbdc838f',
							'_link' => 'field_63e3aca3c838d',
							'display' => '',
							'display_color' => 'primary',
							'display_icon' => 'none',
							'display_position' => 'justify-start',
							'display_size' => 'btn-base',
							'display_style' => 'btn',
							'link' => $block['attrs']['data']['link'],
						],
						'mode' => 'auto',
					],
				];
				break;

			default:
				$new_block = $block;
				break;
		}

		$new_block['innerContent'] = $new_block['innerContent'] ?? [];
		$new_inner_content = [];
		foreach ($block['innerBlocks'] as $inner_block) {
			if (gettype($inner_block) == 'string') {
				$new_inner_content[] = $inner_block;
			} else {
				$new_inner_content[] = $this->convert_block($inner_block);
			}
		}
		$new_block['innerBlocks'] = $new_inner_content;

		clog('---');
		clog($block);
		clog($new_block);

		return $new_block;
	}

	function convert_post($post_id, $dry_run = false)
	{
		$post_content = get_post($post_id)->post_content;
		$blocks = parse_blocks($post_content);
		$new_blocks = [];
		$previous_block_name = null;
		$paragraph_buffer_block = null;
		$paragraph_buffer_block_max_length = $this->paragraph_buffer_block_max_length;

		// NOTE: this gets top level blocks... recursion is handled in convert_block()
		foreach ($blocks as $block) {
			// Skip null blocks
			if (!$block['blockName']) {
				continue;
			}
			if ($previous_block_name == 'core/paragraph' && $block['blockName'] == 'core/paragraph') {
				// If 2 paragraphs in a row, first check if we've reached $paragraph_buffer_block_max_length
				// If so, flush $paragraph_buffer_block
				if (count($paragraph_buffer_block['innerContent']) >= $paragraph_buffer_block_max_length) {
					$new_blocks[] = $this->convert_block($paragraph_buffer_block);
					$paragraph_buffer_block = $block;
				}
				// Add block to $paragraph_buffer_block
				$paragraph_buffer_block['innerHTML'] .= $block['innerHTML'];
				$paragraph_buffer_block['innerContent'] = array_merge($paragraph_buffer_block['innerContent'], $block['innerContent']);
			} elseif ($block['blockName'] == 'core/paragraph') {
				// If 1 single paragraph, create new paragraph buffer
				$paragraph_buffer_block = $block;
			} else {
				// Else for other blocks, first flush paragraph buffer
				if ($paragraph_buffer_block) {
					$new_blocks[] = $this->convert_block($paragraph_buffer_block);
					$paragraph_buffer_block = null;
				}
				// Convert current block
				$new_block = $this->convert_block($block);
				if ($new_block != null) {
					$new_blocks[] = $new_block;
				}
			}
			$previous_block_name = $block['blockName'];
		}
		// Handle last paragraph
		if ($paragraph_buffer_block) {
			$new_blocks[] = $this->convert_block($paragraph_buffer_block);
		}

		$new_post_content = serialize_blocks($new_blocks);
		// Cleanup markup...
		$new_post_content = str_replace('--><!--', "-->\n\n<!--", $new_post_content);
		$new_post_content = str_replace('<!-- wp:tmp/ignore /-->', '', $new_post_content);
		if (!$dry_run) {
			$this->db_update_post_content($post_id, $new_post_content);
		}
		return [$post_content, $new_post_content];
	}

	function convert_post_type($post_type, $dry_run = false)
	{
		$post_ids = [];
		$query = new WP_Query(['post_type' => $post_type, 'posts_per_page' => -1]);
		while ($query->have_posts()) {
			$query->the_post();
			$this->convert_post(get_the_ID(), $dry_run);
			$post_ids[] = get_the_ID();
		}
		wp_reset_postdata();
		return $post_ids;
	}

	function ajax_convert_posts()
	{
		if (isset($_REQUEST) && $_REQUEST['posts_id']) {
			$posts_id = $_REQUEST['posts_id'];
			$results = [];
			foreach ($posts_id as $post_id) {
				$result = $this->convert_post(intval($post_id), false);
				$results[] = intval($post_id);
			}
			wp_send_json($results);
		}
		wp_die();
	}

	function db_update_post_content($post_id, $post_content)
	{
		// Saving post to DB via SQL rather than with `update_post()` because of some UTF8 weirdness...
		global $wpdb;
		$query = $wpdb->prepare("UPDATE {$wpdb->prefix}posts SET post_content=%s WHERE ID=%d", $post_content, $post_id);
		$result = $wpdb->query($query);
		return $result;
	}
}

new BBBlockConverter();
