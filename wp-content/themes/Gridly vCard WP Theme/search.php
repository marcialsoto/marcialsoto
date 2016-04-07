<?php get_header(); ?>
                            <div class="plain-content">
                                <h1>Search results for: <?php echo get_search_query(); ?></h1>

                                <div class="blog-feed">
                                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                                    <div class="post-date">
                                        <?php $date = get_the_date('Y|F j'); $date = explode('|', $date); ?>
                                        <div class="post-year"><?php echo $date[0]; ?></div>
                                        <div class="post-day"><?php echo $date[1]; ?></div>
                                        <div class="trianglewrap-blog"><div class="triangle-blog"></div></div>
                                    </div>
                                    <div class="post-title">
                                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <div class="post-details">
                                            <i class="fa fa-user"></i>&nbsp; By <a href="<?php the_author_link() ?>"><?php the_author() ?></a>
                                            &nbsp; &nbsp; &nbsp; <i class="fa fa-tag"></i>&nbsp;<?php the_tags() ?>
                                            &nbsp; &nbsp; &nbsp; <i class="fa fa-comments"></i>&nbsp; <a href="<?php the_permalink(); ?>"><?php comments_number() ?></a>
                                        </div>
                                        <div class="post-body">
                                            <?php the_content('<span>Learn More <i class="icon-angle-right"></i></span>'); ?>
                                        </div>
                                        <div>
                                            <?php wp_link_pages('before=<div id="page-links">&after=</div>'); ?>
                                        </div>
                                    </div>
                                    <?php endwhile; else: ?>
                                        <h2 class="aligncenter"></h2>
                                    <?php endif; ?>
                                </div>

                                <div class="clear"></div>

                                <div class="vcard-pagination">
                                    <?php
                                        $big = 999999999; // need an unlikely integer

                                        echo paginate_links( array(
                                            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                            'format' => '?paged=%#%',
                                            'current' => max( 1, get_query_var('paged') ),
                                            'total' => $wp_query->max_num_pages,
                                            'type' => 'list'
                                        ) );
                                    ?>
                                </div>

                                <div class="clear"></div>
                            </div>
<?php
    get_sidebar();
    get_footer();
?>
