<?php get_header(); ?>

<div class="mt-20 container flex flex-col space-y-20">
	<?php
	// First loop to output sticky posts
	$sticky_posts = get_option( 'sticky_posts' );
	$count_sticky_posts = count( $sticky_posts );
	
	if ( $count_sticky_posts > 0 ) {
		$sticky_args = array(
			'post__in' => $sticky_posts,
			'ignore_sticky_posts' => 1,
		);
	
		$sticky_query = new WP_Query( $sticky_args );
	
		if ( $sticky_query->have_posts() ) { ?>
			<div class="grid grid-cols-2 gap-10">
			<?php while ( $sticky_query->have_posts() ) {
				$sticky_query->the_post();
				if ( $count_sticky_posts === 1 ) {
					get_template_part( 'template-parts/content-horizontal', get_post_format() );
				} else {
					get_template_part( 'template-parts/content-excerpt', get_post_format() );
				}
			} ?>
			</div>
		<?php }
	
		// Reset the post data
		wp_reset_postdata();
	}
	
	// Second loop to output normal posts
	$normal_args = array(
		'post__not_in' => $sticky_posts,
	);
	
	$normal_query = new WP_Query( $normal_args );
	
	if ( $normal_query->have_posts() ) { ?>
		<div class="grid grid-cols-4 gap-10">
		<?php while ( $normal_query->have_posts() ) {
			$normal_query->the_post();
			get_template_part( 'template-parts/content', get_post_format() );
		} ?>
		</div>
	<?php }
	
	// Reset the post data
	wp_reset_postdata();
	?>

	
	<div class="flex items-center justify-between border-t border-gray-200 bg-white py-3">
	  <div class="flex flex-1 justify-between sm:hidden">
		<a href="#" class="relative inline-flex items-center rounded-md border border-primary bg-white px-4 py-2 text-sm font-medium text-primary hover:bg-primary-50">Previous</a>
		<a href="#" class="relative ml-3 inline-flex items-center rounded-md border border-primary bg-white px-4 py-2 text-sm font-medium text-primary hover:bg-primary-50">Next</a>
	  </div>
	  <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
		<div>
		  <p class="text-sm text-primary">
			Showing
			<span class="font-medium">1</span>
			to
			<span class="font-medium">10</span>
			of
			<span class="font-medium">97</span>
			results
		  </p>
		</div>
		<div>
		  <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
			<a href="#" class="relative inline-flex items-center rounded-l-md border border-primary bg-white px-2 py-2 text-sm font-medium text-primary hover:bg-primary-50 primary:z-20">
			  <span class="sr-only">Previous</span>
			  <!-- Heroicon name: mini/chevron-left -->
			  <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
				<path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
			  </svg>
			</a>
			<!-- Current: "z-10 bg-primary-50 border-primary text-primary-600", Default: "bg-white border-primary text-primary hover:bg-primary-50" -->
			<a href="#" aria-current="page" class="relative z-10 inline-flex items-center border border-primary bg-primary-50 px-4 py-2 text-sm font-medium text-primary font-bold primary:z-20">1</a>
			<a href="#" class="relative inline-flex items-center border border-primary bg-white px-4 py-2 text-sm font-medium text-primary hover:bg-primary-50 primary:z-20">2</a>
			<a href="#" class="relative hidden items-center border border-primary bg-white px-4 py-2 text-sm font-medium text-primary hover:bg-primary-50 primary:z-20 md:inline-flex">3</a>
			<span class="relative inline-flex items-center border border-primary bg-white px-4 py-2 text-sm font-medium text-primary">...</span>
			<a href="#" class="relative hidden items-center border border-primary bg-white px-4 py-2 text-sm font-medium text-primary hover:bg-primary-50 primary:z-20 md:inline-flex">8</a>
			<a href="#" class="relative inline-flex items-center border border-primary bg-white px-4 py-2 text-sm font-medium text-primary hover:bg-primary-50 primary:z-20">9</a>
			<a href="#" class="relative inline-flex items-center border border-primary bg-white px-4 py-2 text-sm font-medium text-primary hover:bg-primary-50 primary:z-20">10</a>
			<a href="#" class="relative inline-flex items-center rounded-r-md border border-primary bg-white px-2 py-2 text-sm font-medium text-primary hover:bg-primary-50 primary:z-20">
			  <span class="sr-only">Next</span>
			  <!-- Heroicon name: mini/chevron-right -->
			  <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
				<path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
			  </svg>
			</a>
		  </nav>
		</div>
	  </div>
	</div>
</div>
<?php get_footer();