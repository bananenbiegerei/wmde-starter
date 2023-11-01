<?php
get_header(); ?>
<div class="container">
	<div class="flex flex-col items-center my-20">
		<p>404</p>
		<h1><?php _e('Seite nicht gefunden.', BB_TEXT_DOMAIN); ?></h1>
		<p><?php _e('Leider konnten wir die gesuchte Seite nicht finden.', BB_TEXT_DOMAIN); ?></p>
		<div class="mt-6">
		  <form class="flex gap-5" action="<?php echo home_url('/'); ?>" method="get">
			  <input class="!mb-0" type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
			  <input type="submit" alt="Search" value="Suchen" class="btn" />
		  </form>
		</div>
	</div>
</div>
<?php get_footer(); ?>
