<div id="banner" class="nonsemantic-decoration">
    <div id="silhouettes" class="nonsemantic-decoration">
        <span id="mother-fucking-id-1"></span>
        <span id="mother-fucking-id-2"></span>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/marcial-soto.png">
    </div>
    <div id="strap" class="nonsemantic-decoration"></div>
</div>
<header class="wrap">

    <h1 class="page-title ft"><?php the_author_meta('display_name', 1); ?></h1>
    <p class="intro"><?php the_author_meta('description', 1); ?></p>

    <ul class="list-inline list-links">
        <li>
            <a class="btn btn-inverse btn-default" href="http://twitter.com/marcialsoto" target="_blank">
                <i class="fa fa-twitter"></i> Sígueme
            </a>
        </li>
        <li>
            <a class="btn btn-text" href="<?php echo bloginfo('url'); ?>/acerca-de">
                <i class="icon-profile" title="Acerca De"></i>
                Perfil
            </a>
        </li>
    </ul>

</header>

<hr />

<section>

    <h2 class="list-title"><i class="fa fa-lightbulb-o"></i>Proyectos Recientes</h2>

    <ul class="post-list">
    <?php
    // the query
    $args = array(
    'post_type' => 'proyectos',
    'posts_per_page'    => '5',
);
    $the_query = new WP_Query( $args ); ?>

    <?php if ( $the_query->have_posts() ) : ?>

    <!-- pagination here -->

    <!-- the loop -->
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <li class="post-block">
            <?php if ( has_post_thumbnail() ) { ?>
                <div class="right photo">
                    <?php the_post_thumbnail('proyecto-thumb'); ?>
                </div>
            <?php } ?>
            <h3 class="post-title"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p class="post-meta"><?php the_excerpt(); ?></p>
        </li>
    <?php endwhile; ?>
    <!-- end of the loop -->

    <!-- pagination here -->

    <?php wp_reset_postdata(); ?>

    <?php else : ?>
       <li class="post-block"><?php _e( 'Sorry, no posts matched your criteria.' ); ?></li>
    <?php endif; ?>

    </ul>

</section>

<section>

    <h2 class="list-title"><i class="fa fa-pencil"></i>Últimos Artículos</h2>

    <ul class="post-list">
    <?php
    // the query
    $args = 'showposts=5';
    $the_query = new WP_Query( $args ); ?>

    <?php if ( $the_query->have_posts() ) : ?>

    <!-- pagination here -->

    <!-- the loop -->
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <li class="post-block">
            <h3 class="post-title"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p class="post-meta"><?php get_template_part('templates/entry-meta'); ?></p>
        </li>
    <?php endwhile; ?>
    <!-- end of the loop -->

    <!-- pagination here -->

    <?php wp_reset_postdata(); ?>

    <?php else : ?>
       <li class="post-block"><?php _e( 'Sorry, no posts matched your criteria.' ); ?></li>
    <?php endif; ?>
    </ul>

</section>

<hr />

<aside id="sitemeta">

    <nav id="nav" role="navigation">

        <ul class="nav-menu">

            <li><a href="http://jimramsden.com/notes"><i class="fa fa-pencil"></i>Artículos</a></li>

            <li><a href="http://jimramsden.com/projects"><i class="fa fa-lightbulb-o"></i>Proyectos</a></li>

            <li><a href="http://jimramsden.com/about"><span class="glyphicon glyphicon-user"></span>Perfil</a></li>

        </ul>

    </nav>

</aside>
