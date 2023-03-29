<?php
$image = get_field('image');
$size = 'full';
$align = get_field('image_direction') == 'left' ? 'float-left pr-1 pb-1' : 'float-right  pl-1 pb-1';
$text = get_field('text');
$link = get_field('link');
$link_url = $link['url'];
$link_title = $link['title'];
$link_target = $link['target'] ? $link['target'] : '_self';
if( get_field('image_direction') == 'left' ) {
	$direction = 'lg:float-left lg:pr-8 pb-5 w-full lg:w-auto lg:max-w-sm';
}
if( get_field('image_direction') == 'right' ) {
	$direction = 'lg:float-right lg:pl-8 pb-5 w-full lg:w-auto lg:max-w-sm';
}
?>

<?php if ($image): ?>
	<div class="bb-text-image-float clearfix">

	<?php if ( get_field( 'link_on_image' ) ): ?>
		<a class="<?php echo $direction; ?>" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?>
			<?php echo wp_get_attachment_image( $image, $size );?>
		</a>
		<?php echo $text; ?>
	
	<?php else: ?>
		<div class="<?php echo $direction; ?>">
			<?php echo wp_get_attachment_image( $image, $size );?>
		</div>
		<?php echo $text; ?>
	<?php endif; ?>

	</div>
<?php endif; ?>