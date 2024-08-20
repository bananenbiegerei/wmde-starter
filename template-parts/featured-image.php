<div class="relative">
    <div class="bb-block-image bg-neutral-light aspect-w-16 aspect-h-9 rounded-t-3xl">
        <figure class="w-full w-full">
            <?php the_post_thumbnail('large', ['class' => 'rounded-t-3xl object-cover w-full h-full overflow-hidden']); ?>
            <?php if (bbWikimediaCommonsMedia::has_post_thumbnail_caption()): ?>
            <figcaption class="invisible nohover:hidden flex absolute left-0 bottom-0 right-0 text-white bg-neutral-dark w-auto h-auto z-20 p-2 text-sm flex items-start gap-4 break-all">
                <?= bb_icon('info', 'flex-shrink-0') ?> <div class="self-center"><?php the_post_thumbnail_caption(); ?></div>
            </figcaption>
            <?php endif; ?>
        </figure>
    </div>
    <?php if (bbWikimediaCommonsMedia::has_post_thumbnail_caption()): ?>
    <figcaption class="hidden nohover:flex rounded-3xl  left-0 bottom-0 right-0 text-white bg-neutral-dark w-auto h-auto z-20 p-2 text-sm flex items-start gap-4 break-all">
        <?= bb_icon('info', 'flex-shrink-0') ?> <div class="self-center"><?php the_post_thumbnail_caption(); ?></div>
    </figcaption>
    <?php endif; ?>
</div>