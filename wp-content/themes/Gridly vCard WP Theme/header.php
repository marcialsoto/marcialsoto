<?php
    // options
    $name = of_get_option('vcard_name','John Doe');
    $position = of_get_option('vcard_position','Web Designer');
    $picture_uri = of_get_option('vcard_picture_uri',get_template_directory_uri().'/images/photo.png');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php bloginfo('name'); ?></title>
        <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
        <script>
            document['vcard_latitude'] = <?php echo of_get_option('vcard_latitude', 0); ?>;
            document['vcard_longitude'] = <?php echo of_get_option('vcard_longitude', 0); ?>;
        </script>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class('bg-cover'); ?>>
        <div class="vcard-container">
            <?php
                get_template_part('include/class-vcard-quick-contacts');

                echo new Neuethemes_vCardQuickContacts();
            ?>
            <div id="content" class="tab-container main-column">
                <!-- Top row -->
                <div class="top-row">

                    <!-- Photo -->
                    <div class="photo">
                        <ul id="photo" class="tabs">
                            <li class="def"><a href="<?php if (!is_front_page()) echo home_url()."/"?>#home"><img src="<?php echo $picture_uri ?>" alt="<?php echo $name ?>"></a></li>
                        </ul>
                    </div>
                    <!-- /Photo -->

                    <div class="attributes">
                        <a href="<?php if (!is_front_page()) echo home_url()."/"?>#home">
                            <div class="name"><?php echo $name ?></div>
                            <div class="position"><?php echo $position ?></div>
                        </a>
                    </div>


                    <div id="main-nav">

                        <ul class="tabs">
                            <li class="about"><a title="About" href="<?php if (!is_front_page()) echo home_url()."/"?>#about"><i class="fa fa-user"></i></a></li>
                            <li class="resume"><a title="Resume" href="<?php if (!is_front_page()) echo home_url()."/"?>#resume"><i class="fa fa-tasks"></i></a></li>
                            <li class="portfolio"><a title="Portfolio" href="<?php if (!is_front_page()) echo home_url()."/"?>#portfolio"><i class="fa fa-suitcase"></i></a></li>
                            <li class="contacts"><a title="Contacts" href="<?php if (!is_front_page()) echo home_url()."/"?>#contacts" class="tab-contact"><i class="fa fa-globe"></i></a></li>
                            <li class="feedback"><a title="Feedback" href="<?php if (!is_front_page()) echo home_url()."/"?>#feedback"><i class="fa fa-comments"></i></a></li>
                        </ul>

                    </div>


                </div>
                <!-- /Top row -->
                <div class="content">
                    <div class="panel-container">

