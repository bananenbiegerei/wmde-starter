<?php get_header(); ?>
<?php while (have_posts()): ?>
<?php the_post(); ?>
<?php
$author = get_queried_object();
$author_id = $author->ID;
$portrait = get_field('portrait', 'user_' . $author_id);
?>

<?php if (has_post_thumbnail()): ?>
<div class="bg-gray min-h-[12rem] pb-10">
	<div class="container lg:grid lg:grid-cols-12 lg:gap-10">
		<div class="lg:col-span-10 lg:col-start-2">
			<?php get_template_part('template-parts/categories-tags'); ?>
			<h1 class="my-5 lg:mb-0"><?php the_title(); ?></h1>
		</div>

		<?php if (has_excerpt()): ?>
		<div class="<?php echo $excerpt_style; ?> lg:text-xl lg:col-span-5 lg:col-start-2">
			<?php echo strip_tags(get_the_excerpt()); ?>
		</div>
		<?php endif; ?>
		<div class="lg:col-span-5 my-5 lg:my-0">
			<div class="bb-image-block aspect-w-16 aspect-h-9 bg-gray-200 rounded-xl overflow-hidden">
				<figure class="w-full w-full">
					<?php the_post_thumbnail('large', ['class' => 'object-cover w-full h-full overflow-hidden']); ?>
					<?php if (bbWikimediaCommonsMedia::has_post_thumbnail_caption()): ?>
					<figcaption class="invisible flex absolute left-0 bottom-0 right-0 text-white bg-gray-900 w-auto h-auto z-20 p-2 text-sm flex items-start gap-4 break-all">
						<?= bb_icon('info', 'flex-shrink-0') ?> <div class="self-center"><?php the_post_thumbnail_caption(); ?></div>
					</figcaption>
					<?php endif; ?>
				</figure>
			</div>
		</div>
		<div class="col-span-8 lg:col-span-10 lg:col-start-2">
			<div class="flex gap-10 mb-2">
				
			
			<?php if (get_field('custom_authors')): ?>
				<?php while (have_rows('custom_authors')): ?>
				<?php the_row(); ?>
					<div class="flex flex-col gap-1">
						<?php 
						$image = get_sub_field('portrait');
						$size = 'thumb';
						if( $image ) { ?>
							<div class="w-24 h-24 rounded overflow-hidden">
								<div class="aspect-w-1 aspect-h-1">
									<?php echo wp_get_attachment_image( $image, $size, "", ["class" => "w-full h-full object-cover"] ); ?>
								</div>
							</div>
						<?php }
						?>
						<p class="mb-0 font-bold text-sm">
							<?php the_sub_field('author'); ?>
						</p>
						
					</div>
				<?php endwhile; ?>
			</div>
				<p class="text-base">
					<?php echo get_the_date(); ?>
				</p>
			<?php else: ?>
				<div class="flex flex-col gap-1">
					<div class="w-24 h-24 rounded overflow-hidden">
					<div class="aspect-w-1 aspect-h-1">
						<?php if ($portrait) {
							$portrait_image = $portrait['url'];
							$portrait_alt = $portrait['alt'];
							?>
							<img class="w-full h-full object-cover" src="<?php echo esc_url($portrait_image); ?>" alt="<?php echo esc_attr($portrait_alt); ?>">
							<?php
						} 
						?>
					</div>
					</div>
					<p class="mb-0 font-bold text-sm">
						<?php the_author(); ?>
					</p>
					<p class="text-base">
						<?php echo get_the_date(); ?>
					</p>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php else: ?>

<?php endif; ?>

<div class="content py-10">
	<?php the_content(); ?>
</div>
<div class="bg-gray py-5">
	<div class="container">
		<?php if ( comments_open() || get_comments_number() ) { ?>
			<section class="comments-container lg:grid lg:grid-cols-12">
						<div class="lg:col-span-8 lg:col-start-3">
							<?php comments_template(); ?>
						</div>
			</section>
		<?php }
		?>
	</div>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>