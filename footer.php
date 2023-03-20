</main>

<footer class="bg-white text-primary mt-36" aria-labelledby="footer-heading">
	<h2 id="footer-heading" class="sr-only">Footer</h2>
	<div class="border-t-2 border-b border-b-gray-200 py-8 mb-12 lg:mb-0">
		<div class="container lg:flex lg:gap-20">
			<div class="flex-none">
				<?php get_template_part("template-parts/social-media-menu"); ?>
			</div>
			<div  class="flex-none">
				<?php //get_template_part("template-parts/newsletter-signup-form-minimal"); ?>
			</div>
			<?php if( get_field('kontakt_spendenservice', 'option') ): ?>
				<div  class="flex-none font-alt">
					<h6 class="text-base text-primary"><?= _e('Spendenservice', BB_TEXT_DOMAIN) ?></h6>
					<?php the_field('kontakt_spendenservice', 'option'); ?>
				</div>
			<?php endif; ?>
			<?php if( get_field('kontakt', 'option') ): ?>
				<div  class="flex-none font-alt">
					<h6 class="text-base text-primary"><?= _e('Kontakt', BB_TEXT_DOMAIN) ?></h6>
					<?php the_field('kontakt', 'option'); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="container lg:flex lg:items-center lg:h-24">
		<div class="lg:flex-1">
			<?php wp_nav_menu(array(
			'container' => 'nav',
			'menu' => 'footer',
			'menu_class' => 'flex flex-col lg:flex-row gap-5',
			'theme_location' => 'footer',
			)); ?>
		</div>
		<div class="lg:flex-none py-12 lg:py-0">
			<h6 class="mb-0 text-base">Wir befreien Wissen</h6>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>

</html>