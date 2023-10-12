<div class="flex flex-col space-y-4 @container/eventscard">
    <div class="aspect-w-4 aspect-h-3">
        <?php the_post_thumbnail('medium', array('class' => 'object-cover w-full h-full rounded-xl'));?>
    </div>
    <h4 class="text-base">
        <?php the_title(); ?>
    </h4>
</div>