<?php
$query = new WP_Query([ 'page_id' => get_field('404_page', 'options') ]);
if ($query->have_posts()) {
    $query->the_post();
}
?>
<?php get_header(); ?>
    <div class="content mt-10">
        <?php the_content() ?>
    </div>
<?php get_footer(); ?>
