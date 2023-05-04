<?php get_header(); ?>

<div class="mt-20 container flex flex-col space-y-20">
	<?php
 // First loop to output sticky posts
 $sticky_posts = get_option('sticky_posts');
 $count_sticky_posts = count($sticky_posts);

 if ($count_sticky_posts > 0) {
 	$sticky_args = [
 		'post__in' => $sticky_posts,
 		'ignore_sticky_posts' => 1,
 	];

 	$sticky_query = new WP_Query($sticky_args);

 	if ($sticky_query->have_posts()) { ?>
			<div class="lg:grid lg:grid-cols-2 lg:gap-10">
			<?php while ($sticky_query->have_posts()) {
   	$sticky_query->the_post();
   	if ($count_sticky_posts === 1) {
   		get_template_part('template-parts/content-horizontal', get_post_format());
   	} else {
   		get_template_part('template-parts/content-excerpt', get_post_format());
   	}
   } ?>
			</div>
		<?php }

 	// Reset the post data
 	wp_reset_postdata();
 }

 // Second loop to output normal posts
 $normal_args = [
 	'post__not_in' => $sticky_posts,
 	'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
 ];

 $normal_query = new WP_Query($normal_args);

 if ($normal_query->have_posts()) { ?>
		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
		<?php while ($normal_query->have_posts()) {
  	$normal_query->the_post();
  	get_template_part('template-parts/content', get_post_format());
  } ?>
		</div>
	<?php }

 // Reset the post data
 wp_reset_postdata();
 ?>


	<div class="flex items-center justify-between border-t border-gray-200 bg-white py-3">
		<div class="flex flex-1 justify-between sm:hidden">
			<?php previous_posts_link('Previous'); ?>
			<?php next_posts_link('Next'); ?>
		</div>
		<div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between sm:items-center">
			<div>
				<p class="text-sm text-primary">
					<?php _e('Zeigt', BB_TEXT_DOMAIN); ?>
					<span class="font-medium"><?php echo $wp_query->current_post + 1; ?></span>
					<?php _e('bis', BB_TEXT_DOMAIN); ?>
					<span class="font-medium"><?php echo $wp_query->current_post + $wp_query->post_count; ?></span>
					<?php _e('von', BB_TEXT_DOMAIN); ?>
					<span class="font-medium"><?php echo $wp_query->found_posts; ?></span>
					<?php _e('Artikeln', BB_TEXT_DOMAIN); ?>
				</p>
			</div>
			<div>
				<?php
    $big = 999999999;
    $args = [
    	'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
    	'format' => '?paged=%#%',
    	'current' => max(1, get_query_var('paged')),
    	'total' => $wp_query->max_num_pages,
    	'type' => 'array',
    	'prev_text' =>
    		'<span class="sr-only">Previous</span><svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd"/></svg>',
    	'next_text' =>
    		'<span class="sr-only">Next</span><svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd"/></svg>',
    	'prev_next' => true,
    	'show_all' => false,
    	'end_size' => 1,
    	'mid_size' => 2,
    ];

    $links = paginate_links($args);

    if (!empty($links)) {
    	echo '<ul class="pagination">';
    	foreach ($links as $link) {
    		echo '<li class="">' . $link . '</li>';
    	}
    	echo '</ul>';
    }
    ?>
			</div>
		</div>
	</div>

</div>
<?php get_footer();
