<?php
    require_once(get_template_directory() .'/include/class-vcard-pages.php');
    require_once(get_template_directory() .'/include/class-vcard-page-manager.php');
    get_header();

?>
    <div id="home">
        <?php Neuethemes_vCardPageManager::show(new Neuethemes_VCardHomePage()) ?>
    </div>

    <div id="about">
        <div class="plain-content">
            <?php Neuethemes_vCardPageManager::show(new Neuethemes_VCardAboutPage()) ?>
        </div>
        <!-- Grey block -->
        <?php
            $neuethemes_vcard_services = get_posts(array('posts_per_page' => 9, 'post_type' => Neuethemes_vCard_ServicePostTypeManager::postTypeSlug));
            if (count($neuethemes_vcard_services) > 0)
            {
                ?>
                <div class="grey-content">
                    <?php
                        $neuethemes_vcard_processedServices = 0;
                        foreach($neuethemes_vcard_services as $service)
                        {
                            $icon = get_post_meta($service->ID,Neuethemes_vCard_IconMetaBox::iconMetaKey,true);
                            $color = get_post_meta($service->ID,Neuethemes_vCard_IconMetaBox::colorMetaKey,true);
                            ?>
                            <div class="one-third <?php echo Neuethemes_VCardAboutPage::adjustColumnLast($neuethemes_vcard_processedServices)?>">
                                <div class="services">
                                    <div class="servtitle">
                                        <div class="servicon"><i class="fa <?php echo "$icon $color"?>"></i><h3><?php echo $service->post_title ?></h3></div>
                                    </div>
                                    <div>
                                        <p><?php echo $service->post_excerpt ?></p>
                                        <?php if (!empty($service->post_content)) { ?>
                                            <a href="<?php echo get_permalink($service->ID)?>"><span>Leer más <i class="icon-angle-right"></i></span></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $neuethemes_vcard_processedServices++;
                        }
                    ?>
                </div>
            <?php
            }
        ?>
        <!-- /Grey block -->
    </div>

    <div id="resume">

        <!-- Resume -->
        <!-- Resume title -->
        <div class="plain-content">
            <?php Neuethemes_vCardPageManager::Show(new Neuethemes_VCardResumePage()) ?>
        </div>
        <!-- /Resume title -->

        <div class="clear dividewhite3"></div>

    </div>

    <div id="portfolio">

        <!-- Portfolio -->
        <div class="plain-content">
            <div>
                <?php Neuethemes_vCardPageManager::show(new Neuethemes_VCardPortfolioPage())?>
            </div>
            <!-- Project Feed Filter -->
            <ul class="project-feed-filter">
                <li><a href="" class="current" data-filter="*">Todos <i class="icon-angle-right"></i></a></li>
                <?php
                    $neuethemes_vcard_categories = get_terms(array('portfolio_tag'));
                    if (is_array($neuethemes_vcard_categories))
                    {
                        foreach ($neuethemes_vcard_categories as $category) {
                            if (!is_object($category)) continue;
                            if (property_exists($category, 'slug') && property_exists($category, 'name')) {
                                ?>
                                <li><a href=""
                                       data-filter=".<?php echo $category->slug ?>"><?php echo $category->name ?> <i
                                            class="icon-angle-right"></i></a></li>
                            <?php
                            }
                        }
                    }?>
            </ul>
            <!-- /Project Feed Filter -->
            <?php
                $neuethemes_vcard_folios = get_posts(array('posts_per_page' => -1, 'post_type' => 'portfolio'));
            ?>

            <!-- Project Feed -->
            <div class="project-feed">

                <?php
                    if (is_array($neuethemes_vcard_folios))
                    foreach($neuethemes_vcard_folios as $folio)
                    {
                        $tags = wp_get_post_terms($folio->ID,'portfolio_tag');
                        $classes = "";

                        if (is_array($tags))
                        foreach($tags as $tag)
                        {
                            if (property_exists($tag, 'slug'))
                            {
                                $classes .=  $tag->slug . ' ';
                            }
                        }

                        $thumbnail_id = get_post_meta($folio->ID,'_thumbnail_id',true);
                        $thumbnail = wp_get_attachment_url($thumbnail_id);
                        $content = $folio->post_content;
                        ?>

                        <div class="one-third project-item <?php echo $classes ?>">
                            <img src="<?php echo $thumbnail ?>" alt="" />
                            <div class="overlay"></div>
                            <div class="mask">
                                <a href="<?php echo $thumbnail ?>" class="icon-image folio" rel="gallery"></a>
                                <?php if (!empty($content)) { ?>
                                    <a href="<?php echo get_permalink($folio->ID) ?>" class="item-title"><?php echo $folio->post_title ?></a>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>

            </div>
            <!-- /Project Feed -->

        </div>
        <!-- / Portfolio -->

    </div>

    <div id="contacts">

        <!-- Contacts -->
        <div class="plain-content">
            <?php Neuethemes_vCardPageManager::show(new Neuethemes_VCardContactsPage()) ?>
        </div>
        <div class="clear dividewhite6"></div>
        <!-- Google Map -->
        <div id="map"></div>
        <!-- /Google Map -->

        <!-- / Contacts -->
    </div>

    <div id="feedback">

        <!-- Feedback -->
        <div class="plain-content">
            <?php Neuethemes_vCardPageManager::show(new Neuethemes_VCardFeedbackPage()) ?>

            <!-- Contact Form -->
            <div class="feedbacks">
                <form method="post" id="contact-form" action="">
                    <label>Nombre</label>
                    <input type="text" name="name" />
                    <label>Correo</label>
                    <input type="text" name="email" />
                    <label>Web</label>
                    <input type="text" name="website" />
                    <label>Mensaje</label>
                    <textarea cols="100" rows="8" name="message"></textarea>
                    <input type="submit" value="Enviar" class="button-red">
                    <input type="hidden" name="action" value="sendmail"/>
                </form>
            </div>
        </div>
        <!-- /Contact Form -->

        <!-- / Feedback -->


<?php
    get_footer();

