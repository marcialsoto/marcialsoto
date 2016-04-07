<?php
class Neuethemes_vCardCommentsWalker extends Walker_Comment
{
    function start_lvl (&$output, $depth = 0, $args = array())
    {
    ?>
        <ul class="children">
    <?php
    }

    function end_lvl (&$output, $depth = 0, $args = array())
    {
    ?>
        </ul>
    <?php
}

    function start_el (&$output, $object, $depth = 0, $args = array(), $current_object_id = 0)
    {
        $GLOBALS['comment'] = $object;
    ?>
        <li class="comment">
            <div>
                <table class="comment-header">
                    <tr>
                        <td><?php echo get_avatar($object); ?></td>
                        <td>

                                <h5 class="author">
                                    <?php comment_author_url_link(get_comment_author())?>
                                    -
                                    <?php $this->replyLink($args); ?>
                                </h5>
                                <p class="comm-date"><?php echo date("F d, Y", strtotime($object->comment_date)) ?></p>

                        </td>
                    </tr>
                </table>

                <div class="comment-entry">
                    <?php comment_text() ?>
                </div>
            </div>
    <?php
    }

    function end_el (&$output, $object, $depth = 0, $args = array())
    {
    ?>
       </li>
    <?php
    }

    private function replyLink ($args)
    {
        $link = get_comment_reply_link(array_merge( $args, array('depth' => $args['max_depth'] - 1, 'max_depth' => $args['max_depth'])));
        echo preg_replace('/comment-reply-link/', 'comment-reply-link ' . 'reply', $link, 1);
    }
}
?>

        <div id="comments">
            <h4><?php comments_number( "No comments", "Comments (1)", "Comments (%)" ) ?></h4>
            <ol class="comments-list">
                <?php wp_list_comments(array('walker' => new Neuethemes_vCardCommentsWalker())); ?>
            </ol>
            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
                <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
                    <div class="nav-previous"><?php previous_comments_link('&larr; Older Comments'); ?></div>
                    <div class="nav-next"><?php next_comments_link('Newer Comments &rarr;'); ?></div>
                    <div class="clear"></div>
                </nav><!-- #comment-nav-above -->
            <?php endif ?>
            <div id="respond">
                <?php comment_form(array('class_submit'=>'button-red')) ?>
            </div>
        </div>

