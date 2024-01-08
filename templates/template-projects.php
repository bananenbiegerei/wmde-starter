<?php
/*
Template Name: Projects template
*/
get_header(); ?>
<?php
$args = ['post_type' => 'projects', 'post_status' => 'publish', 'posts_per_page' => -1, 'order' => 'DESC'];
$projects = new WP_Query($args);
?>
<div class="pb-10">
    <div class="container grid grid-cols-12">
        <div class="col-span-12 pt-5">
            <?php get_template_part('template-parts/breadcrumbs'); ?>
            <h1 class=""><?php the_title(); ?></h1>
            <?php if (has_excerpt()): ?>
            <div class="font-alt text-2xl font-normal mb-5">
                <?php the_excerpt(); ?>
            </div>
            <?php endif; ?>
            <?php if (have_rows('call_to_actions_in_header')): ?>
            <div class="">
                <?php while (have_rows('call_to_actions_in_header')):
                	the_row(); ?>
                <?php $cta_link = get_sub_field('cta_link'); ?>
                <?php if ($cta_link): ?>
                <a class="btn " href="<?php echo esc_url($cta_link['url']); ?>"
                    target="<?php echo esc_attr($cta_link['target']); ?>">
                    <?= bb_icon('arrow-right', 'icon-base') ?>
                    <?php echo esc_html($cta_link['title']); ?></a>
                <?php endif; ?>
                <?php
                endwhile; ?>
            </div>
            <?php endif; ?>
        </div>

    </div>
</div>

<?php the_content(); ?>
<div x-data="{selectedFilter: ''}" class="container">
    <div class="btn-group  mb-5 lg:mb-10">
        <button x-on:click="selectedFilter=''" class="btn btn-outline" :class="{'btn-active': !selectedFilter}"
            type="button">Alle</button>

        <?php
        $terms = get_terms([
        	'taxonomy' => 'project_types',
        	'hide_empty' => true
        ]);
        foreach ($terms as $term): ?>
        <button x-on:click="selectedFilter='<?php echo $term->slug; ?>'" class="btn btn-outline"
            :class="{'btn-active': selectedFilter == '<?php echo $term->slug; ?>'}"
            type="button"><?php echo $term->name; ?></button>
        <?php endforeach;
        ?>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">
        <?php while ($projects->have_posts()):
        	$projects->the_post(); ?>
        <?php
        $terms = get_the_terms(get_the_ID(), 'project_types');
        $classes = '';
        if ($terms && !is_wp_error($terms)):
        	$classes = join(
        		' ',
        		array_map(function ($term) {
        			return $term->slug;
        		}, $terms)
        	);
        endif;
        ?>
        <?php include locate_template('template-parts/card-project.php', false, false); ?>
        <?php
        endwhile; ?>
    </div>

    <?php wp_reset_postdata(); ?>
</div>

<?php get_footer(); ?>