<?php if ( post_password_required() ) { ?>
		<p class="edgtf-no-password"><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'conall' ); ?></p>
<?php } else { ?>
	<?php if ( have_comments() ) { ?>
		<div class="edgtf-comment-holder clearfix" id="comments">
			<div class="edgtf-comments">
				<ul class="edgtf-comment-list">
					<?php wp_list_comments(array( 'callback' => 'conall_edge_comment')); ?>
				</ul>
			</div>
		</div>
	<?php } else { ?>
		<?php if ( ! comments_open() ) : ?>
			<p><?php esc_html_e('Sorry, the comment form is closed at this time.', 'conall'); ?></p>
		<?php endif; ?>	
	<?php } ?>
<?php } ?>
<?php
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

$args = array(
	'id_form' => 'commentform',
	'id_submit' => 'submit_comment',
	'title_reply'=> esc_html__( 'LEAVE A COMMENT','conall' ),
	'title_reply_before' => '<h4 id="reply-title" class="comment-reply-title">',
	'title_reply_after' => '</h4>',
	'title_reply_to' => esc_html__( 'Post a Reply to %s','conall' ),
	'cancel_reply_link' => esc_html__( 'Cancel Reply','conall' ),
	'label_submit' => esc_html__( 'SUBMIT','conall' ),
	'comment_field' => '<textarea id="comment" placeholder="'.esc_html__( 'Write your comment here...','conall' ).'" name="comment" cols="45" rows="8" aria-required="true"></textarea>',
	'comment_notes_before' => '',
	'comment_notes_after' => '',
	'fields' => apply_filters( 'comment_form_default_fields', array(
		'author' => '<div class="edgtf-three-columns clearfix"><div class="edgtf-three-columns-inner"><div class="edgtf-column"><div class="edgtf-column-inner"><input id="author" name="author" placeholder="'. esc_html__( 'Name','conall' ) .'" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' /></div></div>',
		'url' => '<div class="edgtf-column"><div class="edgtf-column-inner"><input id="email" name="email" placeholder="'. esc_html__( 'E-mail','conall' ) .'" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' /></div></div>',
		'email' => '<div class="edgtf-column"><div class="edgtf-column-inner"><input id="url" name="url" type="text" placeholder="'. esc_html__( 'Website','conall' ) .'" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></div></div></div></div>'
		 ) ) );
 ?>
<?php if(get_comment_pages_count() > 1){
	?>
	<div class="edgtf-comment-pager">
		<p><?php paginate_comments_links(); ?></p>
	</div>
<?php } ?>
 <div class="edgtf-comment-form">
	<?php comment_form($args); ?>
</div>