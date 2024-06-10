<?php
function wmde_comment($comment, $args, $depth)
{
    if ('div' === $args['style']) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    } ?>
<<?php echo $tag; ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID() ?>"><?php
    if ('div' != $args['style']) { ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
    }
    if ($comment->comment_approved == '0') { ?>
        <em class="comment-awaiting-moderation"><?php _e('Dein Kommentar wartet auf Moderation.', BB_TEXT_DOMAIN); ?>
        </em><br />
        <?php
    } ?>

        <?php comment_text(); ?>
        <p class="meta small"><?php comment_type(); ?> <?php _e('von', BB_TEXT_DOMAIN) ?> <?php comment_author_link(); ?> <?php _e('am', BB_TEXT_DOMAIN) ?> <?php comment_date(); ?> <?php _e('um', BB_TEXT_DOMAIN) ?> <?php comment_time(); ?></p>
        <div class="reply"><?php comment_reply_link(array_merge($args, [ 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'], ])); ?>
        </div><?php if ('div' != $args['style']) : ?>
    </div><?php endif; ?>

    <?php
}
