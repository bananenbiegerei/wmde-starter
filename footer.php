</main>
<footer class="bg-white" aria-labelledby="footer-heading">
	<h2 id="footer-heading" class="sr-only">Footer</h2>
	<div class="border-y border-primary-600 py-8">
		<div class="container grid grid-cols-4">
			<div>
				<?php get_template_part("template-parts/social-media-menu"); ?>
			</div>
			<div>
				<?php get_template_part("template-parts/newsletter-signup-form-minimal"); ?>
			</div>
			<?php if( get_field('kontakt_spendenservice', 'option') ): ?>
				<div>
					<?php the_field('kontakt_spendenservice', 'option'); ?>
				</div>
			<?php endif; ?>
			<?php if( get_field('kontakt', 'option') ): ?>
				<div>
					<?php the_field('kontakt', 'option'); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="container"></div>
</footer>

<?php wp_footer(); ?>
</body>

</html>