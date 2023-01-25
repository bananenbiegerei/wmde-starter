<section class="custom-block swiper">
  <div class="grid-container">
    <div class="grid-x grid-margin-x">
      <div class="medium-12 cell">
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </div>
  <div class="swiper welcome-swiper">
    <div class="swiper-wrapper">
      <?php if ( have_rows('slides') ): ?>
        <?php while ( have_rows('slides') ) : the_row(); ?>
          <div class="swiper-slide">
            <?php
            $image = get_sub_field('bild');
            $size = 'twelve-columns-sixteen-nine'; // (thumbnail, medium, large, full or custom size)
            if( $image ) {
              echo wp_get_attachment_image( $image, $size );
            } ?>
            <?php if( get_sub_field( 'beschreibung' ) ) : ?>
              <div class="text-container">
                <div class="grid-container">
                  <div class="grid-x grid-margin-x">
                    <div class="medium-6 cell padding-top-2">
                      <?php the_sub_field( 'beschreibung' ); ?>
                          <?php
                          $link = get_sub_field('call_to_action');
                          if( $link ):
                         $link_url = $link['url'];
                         $link_title = $link['title'];
                         $link_target = $link['target'] ? $link['target'] : '_self';
                      ?>
                      <a class="button" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                          <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>
            <div class="triangle-container">
            </div>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>

  </div>
</section>



<!-- <div class="grid-x grid-margin-x">
<div class="medium-2">
<div class="swiper-button-prev"></div>
</div>
<div class="medium-8">

</div>
<div class="medium-2">
<div class="swiper-button-next"></div>
</div>
</div> -->
