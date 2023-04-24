<style>
	/* FIXME: @IS tailwind streamline */
	/* Comments */
	.comment {
		color: $black;
		border-radius: $global-radius;
		overflow: hidden;
	
		.children {
			list-style: none;
	
			.comment {
				margin-left: $space-medium;
			}
		}
	
		&:not(:first-child) {
			margin-top: $space-small;
		}
	
		&-body {
			background-color: $white;
			padding: $space-small;
	
			.meta {
				font-family: $header-font-family;
			}
	
			.comment-reply-link {
				@include button(false, $blue, $blue, $white !important, solid);
				font-family: $header-font-family;
			}
		}
	
		.children {
			margin-top: $space-small;
		}
	
		& &-respond {
			background-color: $white;
			padding: $space-small;
	
		}
	
		&-reply-title {
			display: flex;
			justify-content: space-between;
		}
	
		#cancel-comment-reply-link {   
			@include button();
			font-family: $header-font-family;
		}
	
		&-form-cookies-consent {
			display: flex;
	
			input#wp-comment-cookies-consent {
				margin: 0;
			}
		}
	}
</style>

<?php if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) : ?>
	<?php die('You can not access this page directly!'); ?>
<?php endif; ?>

<?php if (!empty($post->post_password)) : ?>
	<?php if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
			<p><?php_e('This post is password protected. Enter the password to view comments.'); ?></p>
	<?php endif; ?>
<?php endif; ?>

<?php if ($comments) : ?>
	<ul class="no-bullet">
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
	<p><?php_e('No comments yet') ?></p>
	<h3><?php_e('Leave a comment'); ?></h3>
<?php endif; ?>

<?php if (comments_open()) :
$user_ID = get_current_user_id();
?>
	<?php if (get_option('comment_registration') && !$user_ID) : ?>
		<p><?php_e('You must be'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php_e('logged in') ?>
			</a> <?php_e('to post a comment.'); ?>
		</p>
	<?php else : ?>
		<?php
		comment_form(
			array(
				'title_reply'        => esc_html__( 'Leave a comment' ),
				'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
				'title_reply_after'  => '</h3>',
				'class_submit' => 'button',
				'logged_in_as' => sprintf(
					'<p class="logged-in-as">%s</p>',
					sprintf(
						/* translators: 1: User name, 2: Edit user link, 3: Logout URL. */
						__( 'Logged in as <a href="%2$s">%1$s</a><br><a class="button margin-top-1" href="%3$s">%4$s</a>' ),
						$user_identity,
						get_edit_user_link(),
						/** This filter is documented in wp-includes/link-template.php */
						wp_logout_url( apply_filters( 'the_permalink', get_permalink( get_the_ID() ), get_the_ID() ) ),
						pll__('Log out'),
					),
				),
			)
		);
		?>
	<?php endif; ?>
<?php else : ?>
	<p><?php_e('The comments are closed.'); ?></p>
<?php endif; ?>
