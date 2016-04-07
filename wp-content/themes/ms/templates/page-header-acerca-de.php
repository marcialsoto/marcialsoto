<?php if ( has_post_thumbnail() ) { ?>
	<figure class="photo ll">
		<?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
		
		<?php if(get_post(get_post_thumbnail_id())->post_excerpt) {?>
			<figcaption><?php echo get_post(get_post_thumbnail_id())->post_excerpt ?></figcaption>
		<?php } ?>
	</figure>
<?php } ?>
    
<div class="page-header">
  <h1>
    <?php echo roots_title(); ?>
  </h1>
  <p class="lead"><?php the_field('subtitulo'); ?></p>
  <hr />
</div>
