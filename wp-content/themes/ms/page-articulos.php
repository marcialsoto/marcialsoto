<?php $temp = $wp_query; $wp_query= null; 
	$wp_query = new WP_Query();
	$wp_query->query('showposts=5' . '&paged='.$paged);
		 ?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header-articulos'); ?>
  <?php get_template_part('templates/content', 'page-articulos'); ?>
<?php endwhile; ?>