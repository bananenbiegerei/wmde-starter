<?php $ctas = bb_get_synced_ctas(); ?>
<?php if (!empty($ctas)): ?>
<ul class="flex flex-col md:flex-row items-center md:space-x-2 space-y-3 md:space-y-0 mb-4 md:mb-0">
    <?php foreach ($ctas as $cta): ?>
    <?php $link = $cta['link']; ?>
    <?php $link_color = $cta['color']; ?>
    <?php if ($link): ?>
    <a class="w-full md:w-auto btn btn-<?php echo $link_color; ?>" href="<?php echo esc_url($link['url']); ?>"
        target="<?php echo esc_attr($link['target']); ?>"><?php echo esc_html($link['title']); ?></a>
    <?php endif; ?>
    <?php endforeach; ?>
</ul>
<?php endif; ?>