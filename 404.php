<?php
get_header(); ?>
<div class="container">
	<div class="flex flex-col items-center my-20">
		<p>404</p>
		<h1><?php _e('Seite nicht gefunden.', BB_TEXT_DOMAIN); ?></h1>
		<p><?php _e('Leider konnten wir die gesuchte Seite nicht finden', BB_TEXT_DOMAIN); ?> for.</p>
		<div class="mt-6">
		  <a href="#" class="text-base font-medium text-primary-600 hover:text-primary-500">
			<?php _e('Zurück zur Startseite', BB_TEXT_DOMAIN); ?>
			<span aria-hidden="true"> &rarr;</span>
		  </a>
		</div>
	</div>
</div>
<?php get_footer(); ?>
