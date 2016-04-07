<?php if(is_home()) {?>
<header id="topbar" class="banner navbar navbar-default navbar-static-top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="modal" data-target="#navbar-collapse">
        <span class="sr-only">Navegación</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand logo" href="<?php echo esc_url(home_url('/')); ?>"><span><?php bloginfo('name'); ?></span></a>
    </div>
  </div>
</header>
<?php }?>
  <div id="navbar-collapse" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Cerrar</span></button>
          <h3 class="modal-title" id="myModalLabel"><a href="<?php echo bloginfo('url'); ?>">marcialsoto.com</a></h3>
        </div>
        <div class="modal-body">
        <nav class="collapse in navbar-collapse" role="navigation">
          <?php
            if (has_nav_menu('primary_navigation')) :
              wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
            endif;
          ?>
        </nav>
      </div>
  </div>
  </div>
  </div>
