</main>
<footer class="bg-white" aria-labelledby="footer-heading">
	<h2 id="footer-heading" class="sr-only">Footer</h2>
	<div class="border-y border-primary-600 py-8">
		<div class="container lg:flex lg:gap-20">
			<div class="flex-none">
				<?php get_template_part("template-parts/social-media-menu"); ?>
			</div>
			<div  class="flex-1">
				<?php get_template_part("template-parts/newsletter-signup-form-minimal"); ?>
			</div>
			<?php if( get_field('kontakt_spendenservice', 'option') ): ?>
				<div  class="flex-none">
					<?php the_field('kontakt_spendenservice', 'option', false, false); ?>
				</div>
			<?php endif; ?>
			<?php if( get_field('kontakt', 'option') ): ?>
				<div  class="flex-none">
					<?php the_field('kontakt', 'option', false, false); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="container flex items-center">
		<?php wp_nav_menu(array(
		'container' => 'nav',
		'menu' => 'footer',
		'menu_class' => 'menu horizontal',
		'theme_location' => 'footer',
		)); ?>
	</div>
</footer>

<?php wp_footer(); ?>
</body>

</html>