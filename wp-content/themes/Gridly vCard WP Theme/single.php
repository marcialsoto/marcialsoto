<?php get_header(); ?>
        <div class="plain-content">
            <div class="blog-feed">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <div class="post-date">
                        <?php $date = get_the_date('Y|M j'); $date = explode('|', $date); ?>
                        <div class="post-year"><?php echo $date[0]; ?></div>
                        <div class="post-day"><?php echo $date[1]; ?></div>
                        <div class="trianglewrap-blog"><div class="triangle-blog"></div></div>
                    </div>
                    <div class="post-title">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="post-details">
                            <i class="fa fa-user"></i>&nbsp; By <a href="<?php the_author_link() ?>"><?php the_author() ?></a>
                            <?php if (has_tag()) : ?>&nbsp; &nbsp; &nbsp;  <i class="fa fa-tag"></i>&nbsp;<?php the_tags() ?><?php endif ?>
                            &nbsp; &nbsp; &nbsp; <i class="fa fa-comments"></i>&nbsp; <a href="<?php the_permalink(); ?>"><?php comments_number() ?></a>
                        </div>

                        <div <?php post_class("post-body"); ?>>
                            <?php
                                if ( has_post_thumbnail() ) {
                                    the_post_thumbnail();
                                }
                            ?>
                            <?php the_content(); ?>
                        </div>
                        <div>
                            <?php wp_link_pages('before=<div id="page-links">&after=</div>'); ?>
                        </div>
                        <?php comments_template(); ?>
                    </div>
                    <div class="clear dividewhite6"></div>
                <?php endwhile; endif; ?>
            </div>
        </div>
    <div class="clear cleardividwhite3"></div>
<?php
    get_sidebar();
    get_footer();
?>
