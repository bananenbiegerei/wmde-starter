<?php

class BBBlockConverter
{
	function __construct()
	{
		add_action('admin_menu', function () {
			add_menu_page('Block Converter', 'Block Converter', 'install_plugins', 'bb_block_converter', [$this, 'menu_page'], 'dashicons-hammer');
		});
	}

	function menu_page()
	{
		echo '<div class="wrap">';
		echo '<h1>' . esc_html(get_admin_page_title()) . '</h1>';

		if (isset($_POST['bb_convert_post_types_nonce']) && wp_verify_nonce($_POST['bb_convert_post_types_nonce'], 'bb_convert_post_types')) {
			$post_type = $_POST['post_type'];
			$dry_run = ($_POST['dry_run'] ?? 'off') == 'on' ? true : false;
			$results = $this->convert_posts($post_type, $dry_run);
			// Output //
			echo '<h2>Conversion</h2>';
			echo '<p>';
			echo join(
				', ',
				array_map(function ($r) {
					return "<a href=\"" . get_admin_url() . "post.php?post={$r}&action=edit\" target=\"_blank\">{$r}</a>";
				}, $results),
			);
			echo '</p>';
		} elseif (isset($_POST['bb_convert_post_nonce']) && wp_verify_nonce($_POST['bb_convert_post_nonce'], 'bb_convert_post')) {
			$post_id = $_POST['post_id'];
			$dry_run = ($_POST['dry_run'] ?? 'off') == 'on' ? true : false;
			$debug = $this->convert_post($post_id, $dry_run);
			// Output //
			echo '<p>';
			echo $dry_run ? '<b>DRY RUN</b> ' : '';
			echo "<a href=\"" . get_admin_url() . "post.php?post={$_POST['post_id']}&action=edit\" target=\"_blank\">{$_POST['post_id']}</a></p>";
			echo '</p>';
			echo '<textarea rows="20" cols="100">';
			print_r($debug[0]);
			echo "\n\n-------------\n\n";
			print_r($debug[1]);
			echo '</textarea>';
			file_put_contents(get_template_directory() . '/old.txt', $debug[0]);
			file_put_contents(get_template_directory() . '/new.txt', $debug[1]);
		}

		echo '<form method="post">';
		wp_nonce_field('bb_convert_post', 'bb_convert_post_nonce');
		echo '<table class="form-table">';
		echo '<tr>';
		echo '<th scope="row"><label for="post_id">Post ID</label></th>';
		echo '<td><input type="text" name="post_id" id="post_id" value="55449"></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<th scope="row"><label for="dry_run">Dry Run</label></th>';
		echo '<td><input type="checkbox" name="dry_run" id="dry_run" checked="checked"></td>';
		echo '</tr>';

		echo '</table>';
		submit_button('Convert Post');
		echo '</div>';
		echo '</form>';

		$post_type_options = array_map(function ($post_type) {
			return "<option value='{$post_type}'>{$post_type}</option>";
		}, array_keys(get_post_types()));

		echo '<form method="post">';
		wp_nonce_field('bb_convert_post_types', 'bb_convert_post_types_nonce');
		echo '<table class="form-table">';
		echo '<tr>';
		echo '<th scope="row"><label for="post_type">Post Type</label></th>';
		echo '<td><select name="post_type" id="post_type" value="">' . join('', $post_type_options) . '</select></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<th scope="row"><label for="dry_run">Dry Run</label></th>';
		echo '<td><input type="checkbox" name="dry_run" id="dry_run" checked="checked"></td>';
		echo '</tr>';
		echo '</table>';
		submit_button('Convert All Posts');
		echo '</div>';
		echo '</form>';
	}

	function convert_posts($post_type, $dry_run = false)
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

	function convert_post($post_id, $dry_run = false)
	{
		$p = get_post($post_id);
		$blocks = parse_blocks($p->post_content);
		$new_blocks = [];
		foreach ($blocks as $block) {
			if ($block['blockName']) {
				$new_blocks[] = $this->convert_block($block);
			} else {
				$new_blocks[] = $block;
			}
		}
		$new_post_content = serialize_blocks($new_blocks);
		if (!$dry_run) {
			$this->db_update_post_content($post_id, $new_post_content);
		}
		return [$p->post_content, $new_post_content];
	}

	function convert_block($block)
	{
		switch ($block['blockName']) {
			case 'core/heading':
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
			default:
				$new_block = $block;
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

		return $new_block;
	}

	function db_update_post_content($post_id, $post_content)
	{
		global $wpdb;
		$query = $wpdb->prepare("UPDATE {$wpdb->prefix}posts SET post_content=%s WHERE ID=%d", $post_content, $post_id);
		$result = $wpdb->query($query);
		return $result;
	}
}

new BBBlockConverter();
