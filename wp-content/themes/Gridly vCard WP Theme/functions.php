<?php
require_once(get_template_directory() .'/include/class-tgm-plugin-activation.php');
require_once(get_template_directory() .'/include/class-vcard-pages.php');
require_once(get_template_directory() .'/include/class-vcard-page-manager.php');
require_once(get_template_directory() .'/include/class-vcard-shortcodes.php');
require_once(get_template_directory() .'/include/class-vcard-shortcodes-manager.php');
require_once(get_template_directory() .'/include/class-vcard-service-post-type-manager.php');

function neuethemes_vcard_register_plugins()
{
    $plugins = array(
        array(
            'name' 		=> 'Portfolio Post Type',
            'slug' 		=> 'portfolio-post-type',
            'required' 	=> true
        ),
        array(
            'name' 		=> 'Options Framework',
            'slug' 		=> 'options-framework',
            'version'   => '1.8.0',
            'required' 	=> true
        ),
        array(
            'name' 		=> 'WordPress Importer',
            'slug' 		=> 'wordpress-importer',
            'required' 	=> false
        ),
        array(
            'name' 		=> 'Column Shortcodes',
            'slug' 		=> 'column-shortcodes',
            'required' 	=> false
        )
    );

    tgmpa($plugins);
}

add_action( 'tgmpa_register', 'neuethemes_vcard_register_plugins' );

function neuethemes_vcard_optionsframework_tweak_menu ($menu)
{
    $menu['page_title'] = 'vCard Options';
    $menu['menu_title'] = 'vCard';
    $menu['mode'] = 'menu';
    $menu['position'] = '8.8';
    $menu['icon_url'] = 'dashicons-businessman';

    return $menu;
}
add_filter('optionsframework_menu', 'neuethemes_vcard_optionsframework_tweak_menu');

if (!function_exists('of_get_option'))
{
    function of_get_option($id,$default = false)
    {
        return $default;
    }
}

function neuethemes_vcard_register_page_styles()
{
    wp_register_style('font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome.min.css');
    wp_register_style('jquery-fancybox', get_stylesheet_directory_uri() . '/css/jquery.fancybox.css');
    wp_register_style('vcard-custom', get_stylesheet_directory_uri() . '/css/style.css');
    wp_register_style('vcard-color-scheme', of_get_option('vcard_color_scheme', get_template_directory_uri().'/css/colors/color-cf-blue.css'), array('vcard-custom'));
}

function neuethemes_vcard_register_page_scripts()
{
    wp_register_script('jquery-noconflict', get_stylesheet_directory_uri() . '/js/jquery_noconflict_fix.js', array('jquery' ));
    wp_register_script('jquery-fancybox-pack', get_stylesheet_directory_uri() . '/js/jquery.fancybox.pack.js', array('jquery-noconflict'));
    wp_register_script('jquery-easytabs', get_stylesheet_directory_uri() . '/js/jquery.easytabs.js', array('jquery-hashchange'));
    wp_register_script('jquery-hashchange', get_stylesheet_directory_uri() . '/js/jquery.hashchange.min.js', array('jquery-noconflict'));
    wp_register_script('jquery-isotope', get_stylesheet_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery-noconflict'));
    wp_register_script('jquery-knob', get_stylesheet_directory_uri() . '/js/jquery.knob.js', array('jquery-noconflict'));
    wp_register_script('jquery-validate', get_stylesheet_directory_uri() . '/js/jquery.validate.min.js', array('jquery-noconflict'));
    wp_register_script('jquery-zflickrfeed', get_stylesheet_directory_uri() . '/js/jquery.zflickrfeed.min.js', array('jquery-noconflict'));
    wp_register_script('vcard-custom', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery-noconflict', 'google-maps'));
    wp_register_script('google-maps', 'https://maps.google.com/maps/api/js?sensor=false', array('jquery-noconflict'));
}

function neuethemes_vcard_enqueue_page_styles()
{
    wp_enqueue_style('font-awesome');
    wp_enqueue_style('jquery-fancybox');
    wp_enqueue_style('vcard-custom');
    wp_enqueue_style('vcard-color-scheme');
}

function neuethemes_vcard_enqueue_page_scripts()
{
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-nocoflict');
    wp_enqueue_script('jquery-fancybox-pack');
    wp_enqueue_script('jquery-easytabs');
    wp_enqueue_script('jquery-hashchange');
    wp_enqueue_script('jquery-isotope');
    wp_enqueue_script('jquery-knob');
    wp_enqueue_script('jquery-validate');
    wp_enqueue_script('jquery-zflickrfeed');
    wp_enqueue_script('vcard-custom');
}

function neuethemes_vcard_set_editor_stylesheet()
{
    add_editor_style('css/editor-style.css');
}

function neuethemes_vcard_enqueue_admin_styles ()
{
    wp_enqueue_style('vcard_admin_css', get_template_directory_uri().'/css/admin-style.css');
}

add_action('wp_enqueue_scripts', 'neuethemes_vcard_register_page_styles');
add_action('wp_enqueue_scripts', 'neuethemes_vcard_enqueue_page_styles');

add_action('wp_enqueue_scripts', 'neuethemes_vcard_register_page_scripts');
add_action('wp_enqueue_scripts', 'neuethemes_vcard_enqueue_page_scripts');

add_action('init', 'neuethemes_vcard_set_editor_stylesheet');

add_action('admin_enqueue_scripts', 'neuethemes_vcard_enqueue_admin_styles');

if ( ! isset( $content_width ) ) $content_width = 890;

function neuethemes_vcard_theme_activation()
{
    Neuethemes_vCardPageManager::create(new Neuethemes_VCardBlogPage(), true);
    Neuethemes_vCardPageManager::create(new Neuethemes_VCardFrontPage(), true);

    Neuethemes_vCardPageManager::create(new Neuethemes_VCardHomePage());
    Neuethemes_vCardPageManager::create(new Neuethemes_VCardAboutPage());
    Neuethemes_vCardPageManager::create(new Neuethemes_VCardResumePage());
    Neuethemes_vCardPageManager::create(new Neuethemes_VCardPortfolioPage());
    Neuethemes_vCardPageManager::create(new Neuethemes_VCardContactsPage());
    Neuethemes_vCardPageManager::create(new Neuethemes_VCardFeedbackPage());
}

add_action('after_switch_theme','neuethemes_vcard_theme_activation');

$servicesManager = new Neuethemes_vCard_ServicePostTypeManager();
add_action( 'init', array($servicesManager, 'registerPostType'), 0 );
add_action( 'add_meta_boxes', array($servicesManager, 'addIconMetaBox') );
add_action( 'save_post', array($servicesManager, 'savePost'));

Neuethemes_vCardShortcodesManager::registerShortcodes(array(
    new Neuethemes_LabelShortCodeNeuethemes(),
    new Neuethemes_ContactShortCodeNeuethemes(),
    new Neuethemes_EmploymentShortCodeNeuethemes(),
    new Neuethemes_EducationShortCodeNeuethemes(),
    new Neuethemes_JobShortCode(),
    new Neuethemes_SchoolShortCode(),
    new Neuethemes_SkillShortCodeNeuethemes(),
    new Neuethemes_SkillsShortCodeNeuethemes(),
    new Neuethemes_ButtonShortCodeNeuethemes(),
    new Neuethemes_AlertShortCodeNeuethemes()
));

add_theme_support('post-thumbnails', array('portfolio'));
add_theme_support('automatic-feed-links');
add_theme_support('html5');

function neuethemes_vcard_send_mail()
{
    //Check to make sure that the name field is not empty
    if(trim($_POST['name']) == '') {
        $hasError = true;
    } else {
        $name = trim($_POST['name']);
    }

    //Check to make sure sure that a valid email address is submitted
    if(trim($_POST['email']) == '')  {
        $hasError = true;
    } else if (!preg_match("/^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$/i", trim($_POST['email']))) {
        $hasError = '<strong>Error!</strong> Please enter a valid email address';
    } else {
        $email = trim($_POST['email']);
    }

    //Check to make sure message were entered
    if(trim($_POST['message']) == '') {
        $hasError = true;
    } else {
        if(function_exists('stripslashes')) {
            $message = stripslashes(trim($_POST['message']));
        } else {
            $message = trim($_POST['message']);
        }
    }

    //If there is no error, send the email
    if(!$hasError) {
        $emailTo = of_get_option('vcard_feedback_email'); //Put your own email address here
        $subject = 'Message from your vCard'; //Put your own subject here
        $body = "Name: $name \n\nEmail: $email \n\nSubject: $subject \n\nComments:\n $message";
        $headers = "From: ".$name." <".$email.">\r\nReply-To: ".$email."";

        $sent = mail($emailTo, $subject, $body, $headers);
        if ($sent) {
            //If message is sent
            echo "Your feedback has been sent";
        } else {
            //If errors are found
            echo "Could not send your message </br>
            Please check if you've filled all the fields with valid information and try again. Thank you.";
        }
    } else {
        echo $hasError; //If errors are found
    }
    exit();
}

function define_sendmail_url()
{
    ?>
    <script type="text/javascript">
        var sendmail_url = "<?php echo admin_url('admin-ajax.php') ?>";
    </script>
    <?php
}

add_action('wp_head','define_sendmail_url');

add_action('wp_ajax_sendmail','neuethemes_vcard_send_mail');
add_action('wp_ajax_nopriv_sendmail','neuethemes_vcard_send_mail');

function neuethemes_vcard_init_widgets()
{
    register_sidebar(array(
        'name' => 'Bottom Sidebar',
        'id' => 'vcard_bottom_sidebar',
        'before_widget' => '',
		'after_widget' => ''
    ));
}

add_action('widgets_init', 'neuethemes_vcard_init_widgets');
