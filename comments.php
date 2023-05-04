<?php if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) : ?>
<?php die('You can not access this page directly!'); ?>
<?php endif; ?>

<?php if (!empty($post->post_password)) : ?>
<?php if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
<p><?php _e('This post is password protected. Enter the password to view comments.'); ?></p>
<?php endif; ?>
<?php endif; ?>

<?php if ($comments) : ?>
<ul class="list-none border rounded-xl my-20">
	<?php
		wp_list_comments(
			array(
				'style' => 'ul',
				'type' => 'comment',
				'callback' => 'wmde_comment',
			)
		);
		?>
</ul>
<?php else : ?>
<p><?php _e('No comments yet') ?></p>
<?php endif; ?>

<?php if (comments_open()) :
$user_ID = get_current_user_id();
?>
<?php if (get_option('comment_registration') && !$user_ID) : ?>
<p><?php _e('You must be'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in') ?>
	</a> <?php _e('to post a comment.'); ?>
</p>
<?php else : ?>
<?php
		comment_form(
			array(
				'title_reply'        => esc_html__( 'Leave a comment' ),
				'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
				'title_reply_after'  => '</h3>',
				'class_submit' => 'btn bnt-base',
				'logged_in_as' => sprintf(
					'<p class="logged-in-as">%s</p>',
					sprintf(
						/* translators: 1: User name, 2: Edit user link, 3: Logout URL. */
						__( 'Logged in as <a href="%2$s">%1$s</a><br><a class="button margin-top-1" href="%3$s">%4$s</a>' ),
						$user_identity,
						get_edit_user_link(),
						/** This filter is documented in wp-includes/link-template.php */
						wp_logout_url( apply_filters( 'the_permalink', get_permalink( get_the_ID() ), get_the_ID() ) ),
						__('Log out'),
					),
				),
			)
		);
		?>
<?php endif; ?>
<?php else : ?>
<p><?php _e('The comments are closed.'); ?></p>
<?php endif; ?>