<div class="hover:shadow-lg rounded-xl">
    <a href="<?php the_permalink(); ?>">
        <figure class="aspect-h-1 aspect-w-1">
            <?php the_post_thumbnail('four-columns', ['class' => 'object-cover rounded-xl']); ?>
        </figure>
        <div class="p-3">
            <h2 class="text-lg uppercase text-primary"><?php the_title(); ?></h2>
        </div>
    </a>
</div>