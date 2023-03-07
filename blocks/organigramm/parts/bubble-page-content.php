<div class="grid-x grid-margin-x">
	<div class="cell medium-8 position-relative">
		<?php get_template_part('/blocks/organigramm/parts/bubbles'); ?>
	</div>
	<div class="cell medium-4">
		<div class="has-white-background-color padding-1">
			<h2 class="h4">
				<?php echo $page->post_title; ?>
			</h2>
			<?php
   $content = apply_filters('the_content', $page->post_content);
   echo $content;
   ?>
			<?php
   $link = get_field('call_to_action_button', $page_id);
   if ($link):

   	$link_url = $link['url'];
   	$link_title = $link['title'];
   	$link_target = $link['target'] ? $link['target'] : '_self';
   	?>
				<a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
			<?php
   endif;
   ?>
		</div>
	</div>
</div>
