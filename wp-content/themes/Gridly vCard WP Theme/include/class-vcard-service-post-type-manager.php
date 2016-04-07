<?php
if (!class_exists('Neuethemes_vCard_IconMetaBox'))
{
    class Neuethemes_vCard_IconMetaBox
    {
        const nonce = 'neuethemes_vcard_services_iconMetaBox_nonce';
        const action = 'neuethemes_vcard_services_iconMetaBox';
        const iconInputName = 'neuethemes_vcard_service_icon_input';
        const colorInputName = 'neuethemes_vcard_service_icon_color_input';
        const iconMetaKey = 'neuethemes_vcard_service_icon';
        const colorMetaKey = 'neuethemes_vcard_service_icon_background';
        private $color;

        public function render($post)
        {
            wp_nonce_field(self::action,self::nonce);
            $icon = get_post_meta($post->ID,self::iconMetaKey,true);
            if (!$icon)
                $icon = 'fa-comment';

            $this->color = get_post_meta($post->ID,self::colorMetaKey,true);
            if (!$this->color)
                $this->color = 'web';

            ?>
            <label for="<?php echo self::iconInputName?>">Specify Font-Awesome <a href="http://fortawesome.github.io/Font-Awesome/icons/">icon</a> for service:</label>
            <input type="text" id="<?php echo self::iconInputName?>" name="<?php echo self::iconInputName?>" value="<?php echo esc_attr($icon)?>" />
            <br/>
            <label for="<?php echo self::colorInputName?>">Set icon background color:</label>
            <select id="<?php echo self::colorInputName?>" name="<?php echo self::colorInputName?>">
                <option value="web" <?php  $this->toggleSelected('web')?>>web</option>
                <option value="ui" <?php  $this->toggleSelected('ui')?>>ui</option>
                <option value="app"<?php  $this->toggleSelected('app')?>>app</option>
            </select>

        <?php
        }

        private function toggleSelected($option)
        {
            if ($this->color == $option)
                echo "selected='selected'";

        }

    }
}

if (!class_exists('Neuethemes_vCard_ServicePostTypeManager'))
{
    class Neuethemes_vCard_ServicePostTypeManager
    {
        const postTypeSlug = 'neue_vcard_service';
        private $postType;

        public function __construct ()
        {
            $this->postType = array(
                'labels' => array(
                    'name'                => _x( 'Services', 'Post Type General Name', 'vcard' ),
                    'singular_name'       => _x( 'Service', 'Post Type Singular Name', 'vcard' ),
                    'menu_name'           => __( 'Services', 'vcard' ),
                    'parent_item_colon'   => __( 'Parent Item:', 'vcard' ),
                    'all_items'           => __( 'All Items', 'vcard' ),
                    'view_item'           => __( 'View Item', 'vcard' ),
                    'add_new_item'        => __( 'Add New Item', 'vcard' ),
                    'add_new'             => __( 'Add New', 'vcard' ),
                    'edit_item'           => __( 'Edit Item', 'vcard' ),
                    'update_item'         => __( 'Update Item', 'vcard' ),
                    'search_items'        => __( 'Search Item', 'vcard' ),
                    'not_found'           => __( 'Not found', 'vcard' ),
                    'not_found_in_trash'  => __( 'Not found in Trash', 'vcard' ),
                ),
                'supports'            => array( 'title', 'editor', 'author','excerpt'),
                'hierarchical'        => false,
                'public'              => true,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'show_in_nav_menus'   => true,
                'show_in_admin_bar'   => true,
                'menu_position'       => 8,
                'menu_icon'           => 'dashicons-admin-tools',
                'can_export'          => true,
                'has_archive'         => true,
                'exclude_from_search' => false,
                'publicly_queryable'  => true,
                'capability_type'     => 'page',
            );
        }

        public function registerPostType()
        {
            register_post_type( self::postTypeSlug, $this->postType );
        }

        public function addIconMetaBox()
        {
            $iconMetaBox = new Neuethemes_vCard_IconMetaBox();
            add_meta_box('vcard_service_icon_sectionId','Customize Icon', array($iconMetaBox,'render'),self::postTypeSlug,'side','high');
        }

        public function savePost($post_id)
        {
            if (!isset($_POST[Neuethemes_vCard_IconMetaBox::nonce]))
                return $post_id;

            $nonce = $_POST[Neuethemes_vCard_IconMetaBox::nonce];
            if (!wp_verify_nonce($nonce,Neuethemes_vCard_IconMetaBox::action))
                return $post_id;

            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
                return $post_id;

            $icon = sanitize_text_field($_POST[Neuethemes_vCard_IconMetaBox::iconInputName]);
            $color = sanitize_text_field($_POST[Neuethemes_vCard_IconMetaBox::colorInputName]);

            update_post_meta($post_id, Neuethemes_vCard_IconMetaBox::iconMetaKey,$icon);
            update_post_meta($post_id, Neuethemes_vCard_IconMetaBox::colorMetaKey,$color);
        }
    }
}
