<?php
defined('ABSPATH') or die("No scripts for you!");
/**
  Plugin name: WP Cookie User Info
  Plugin URI: https://accesspressthemes.com/wordpress-plugins/wp-cookie-user-info/
  Description: Plugin to display cookie info bar on your website, for letting visitors get notified about the sites preferences and legal issues.
  Version: 1.1.0
  Author: AccessPress Themes
  Author URI: http://accesspressthemes.com
  Text Domain: wp-cookie-user-info
  Domain Path: /languages/
 */
  if (!class_exists('WPCUI_Class')) {

    /**
     * This is a Class for the plugin WP Cookie User Info
     */
    class WPCUI_Class {

        function __construct() {
            $this->define_some_constants();

            register_activation_hook( __FILE__ , array($this, 'wpcui_plugin_activation'));

            add_action( 'init' , array( $this , 'load_default_general_options' ) );

            $this->define_web_fonts();

            add_action('admin_post_save_manage_form_settings', array($this, 'save_manage_form_settings'));

            add_action('admin_post_save_choice_settings', array($this, 'save_choice_settings'));

            add_action('admin_menu', array($this, 'register_a_menu'));

            add_action('admin_menu', array($this, 'register_submenus'));

            add_action('admin_enqueue_scripts', array($this, 'register_admin_scripts'));

            add_action('wp_enqueue_scripts', array($this, 'register_frontend_scripts'));

            add_action('plugins_loaded', array($this, 'load_wpcui_textdomain'));

            add_action('wp_footer', array($this, 'frontend_display_cookie_bar'));

            add_action('admin_post_save_custom_template', array($this, 'save_custom_template'));
            add_filter( 'admin_footer_text', array( $this, 'wpcui_admin_footer_text' ) );
            add_filter( 'plugin_row_meta', array( $this, 'wpcui_plugin_row_meta' ), 10, 2 );
            add_action( 'admin_init', array( $this, 'wpcui_redirect_to_site' ), 1 );
          
        }

        function wpcui_admin_footer_text( $text ){
            global $post;
            if ( (isset( $_GET[ 'page' ] ) && in_array($_GET[ 'page' ], array('wp-cookie-user-info','wpcui-manage-settings','wpcui-choice-settings','wpcui-custom-template-settings','wpcui-about') ) || ( (isset( $_GET[ 'post_type' ] )) && $_GET[ 'post_type' ] == 'wp-cookie-user-info' ) ) ) {
                $link = 'https://wordpress.org/support/plugin/wp-cookie-user-info/reviews/#new-post';
                $pro_link = 'https://accesspressthemes.com/wordpress-plugins/wp-cookie-user-info-pro/';
                $text = 'Enjoyed WP Cookie User Info? <a href="' . $link . '" target="_blank">Please leave us a ★★★★★ rating</a> We really appreciate your support! | Try premium version of <a href="' . $pro_link . '" target="_blank">WP Cookie User Info Pro</a> - more features, more power!';
                return $text;
            } else {
                return $text;
            }
        }

        function wpcui_plugin_row_meta( $links, $file ){

            if ( strpos( $file, 'wp-cookie-user-info.php' ) !== false ) {
                $new_links = array(
                    'demo' => '<a href="http://demo.accesspressthemes.com/wordpress-plugins/wp-user-cookie-info" target="_blank"><span class="dashicons dashicons-welcome-view-site"></span>Live Demo</a>',
                    'doc' => '<a href="https://accesspressthemes.com/documentation/wp-cookie-user-info/" target="_blank"><span class="dashicons dashicons-media-document"></span>Documentation</a>',
                    'support' => '<a href="http://accesspressthemes.com/support" target="_blank"><span class="dashicons dashicons-admin-users"></span>Support</a>',
                    'pro' => '<a href="https://accesspressthemes.com/wordpress-plugins/wp-cookie-user-info-pro/" target="_blank"><span class="dashicons dashicons-cart"></span>Premium version</a>'
                );

                $links = array_merge( $links, $new_links );
            }

            return $links;
        }

        function wpcui_redirect_to_site(){
            if ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] == 'wpcui-documentation-wp' ) {
                wp_redirect( 'https://accesspressthemes.com/documentation/wp-cookie-user-info/' );
                exit();
            }
            if ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] == 'wpcui-premium-wp' ) {
                wp_redirect( 'https://accesspressthemes.com/wordpress-plugins/wp-cookie-user-info-pro/' );
                exit();
            }
        }

        public function define_web_fonts(){
          if (!defined('WPCUI_WEB_FONTS')) {
              $wpcui_fonts = get_option('wpcui_typo_fonts');
              $new_web_font = array();
              if (!empty($wpcui_fonts)) {
                 foreach ($wpcui_fonts as $index => $value) {
                    $new_web_font[$index] = str_replace(' ', '+', $value);
                }
            }
            $string_var = join('|',$new_web_font);
            define('WPCUI_WEB_FONTS',$string_var);
        }
    }

        /**
         * 
         * This is a function for registering a menu into the Plugin
         *
         * @since 1.0.0
         */
        function register_a_menu() {

            //Adding a custom menu
            add_menu_page(__('WP Cookie User Info', WPCUI_DOMAIN), __('WP Cookie User Info', WPCUI_DOMAIN), 'manage_options', WPCUI_DOMAIN, array($this, 'display_menu_page'), WPCUI_IMAGE . 'my_cookie_icon.png');
        }

        /**
         * This is a function for registering the list of submenus into the Plugin
         *
         * @since 1.0.0
         */
        function register_submenus() {
            add_submenu_page(WPCUI_DOMAIN, __('Cookie Info Manager', WPCUI_DOMAIN), __('Cookie Info Manager', WPCUI_DOMAIN), 'manage_options', WPCUI_DOMAIN, array($this, 'display_menu_page'));

            $this->register_manage_settings();

            add_submenu_page(WPCUI_DOMAIN, __('General Settings', WPCUI_DOMAIN), __('General Settings', WPCUI_DOMAIN), 'manage_options', 'wpcui-choice-settings', array($this, 'choose_from_cookies'));

            add_submenu_page(WPCUI_DOMAIN, __('Custom Template', WPCUI_DOMAIN), __('Custom Template', WPCUI_DOMAIN), 'manage_options', 'wpcui-custom-template-settings', array($this, 'list_custom_template'));

            add_submenu_page(WPCUI_DOMAIN, __('More WordPress Stuff', WPCUI_DOMAIN), __('More WordPress Stuff', WPCUI_DOMAIN), 'manage_options', 'wpcui-about', array($this, 'display_about_page'));

            add_submenu_page( WPCUI_DOMAIN, __( 'Documentation', WPCUI_DOMAIN ), __( 'Documentation', WPCUI_DOMAIN ), 'manage_options', 'wpcui-documentation-wp', '__return_false', null, 9 );
            
            add_submenu_page(WPCUI_DOMAIN, __( 'Check Premium Version', WPCUI_DOMAIN ), __( 'Check Premium Version', WPCUI_DOMAIN ), 'manage_options', 'wpcui-premium-wp', '__return_false', null, 9 );
        }

        /**
         * This is a function for registering the submenus manage_settings into the Plugin
         *
         * @since 1.0.0
         */
        function register_manage_settings() {
            //Manage Settings
            global $wpdb;
            global $action; //action to be
            global $result;
            global $custom_templates;
            $label = '';

            $table = $wpdb->prefix . "wpcui_settings";

            //For Add and Edit on Specific cookie bar
            if (isset($_GET['action'])) {
                if (array_key_exists('page', $_GET)) {
                    if ($_GET['action'] == 'edit' && $_GET['page'] == 'wpcui-manage-settings') {
                        $action = ucwords(sanitize_text_field($_GET['action'])) . ' ';
                        $id = intval($_GET['id']);
                        $result = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id = %d",$id));
                    } elseif ($_GET['action'] == 'add' && $_GET['page'] == 'wpcui-manage-settings') {
                        $action = ucwords(sanitize_text_field($_GET['action'])) . ' New ';
                        $result = false;
                    } elseif ($selected_cookie = get_option('wpcui_selected_cookie_option')) {
                        $id = $selected_cookie['cookie-bar']; //Accessing the selected cookie bar
                        $action = (isset($selected_cookie['status'])) ? 'Activated ' : 'Selected '; //When activated and not activated for selected cookie bar in Activation Settings  
                    }

                    $label = ($action == 'Edit ') ? 'Selected ' : $action; //For just Edit we dont need to display in admin menu
                }
            } else {
                $result = $wpdb->get_row("SELECT * FROM $table"); //Retreive data
                if ($result && empty($result)) {
                    $action = 'Add New ';
                    $label = $action;
                } else {

                    if (isset($_GET['message'])) {
                        $action = 'Recent ';
                        $label = 'Selected ';
                        $id = intval($_GET['replaced']);
                        $result = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id = %d",$id));
                    } elseif ($selected_cookie = get_option('wpcui_selected_cookie_option')) {
                        $id = $selected_cookie['cookie-bar']; //Accessing the selected cookie bar
                        $result = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id = %d",$id));

                        $action = (isset($selected_cookie['status'])) ? 'Activated ' : 'Selected '; //When activated and not activated for selected cookie bar in Activation Settings  
                        $label = (empty($result)) ? "Add New " : $action;
                    } else {
                        $action = 'Add New ';
                        $label = $action;
                    }
                }
            }


            $table_name = $wpdb->prefix . 'wpcui_custom_template';
            $custom_templates = $wpdb->get_results("SELECT * FROM $table_name");


            add_submenu_page(WPCUI_DOMAIN, __("$action Info", WPCUI_DOMAIN), __("$label Info", WPCUI_DOMAIN), 'manage_options', 'wpcui-manage-settings', array($this, 'display_manage_settings_page'));
            //End Manage Settings
        }

        /**
         * This is a function for registering admin assets into the Plugin
         *
         * @since 1.0.0
         */
        function register_admin_scripts() {

            $pages = array(WPCUI_DOMAIN, 'wpcui-manage-settings', 'wpcui-about', 'wpcui-choice-settings', 'wpcui-custom-template-settings');

            if (isset($_GET['page']) && in_array($_GET['page'], $pages)) {

                wp_enqueue_style('wp-color-picker');
                wp_enqueue_script('wpcui-colorpicker-alpha', WPCUI_JS . 'wp-color-picker-alpha.js', array('wp-color-picker'), WPCUI_VERSION);

                wp_enqueue_script('admin_assets_scripts', WPCUI_JS . 'wpcui-admin-script.js', array('jquery'), WPCUI_VERSION);

                wp_enqueue_style('admin_assets_styles', WPCUI_CSS . 'wpcui-admin-style.css', array(), WPCUI_VERSION); //change styles to style in file name

                wp_enqueue_script('wpcui_nice_select_script', WPCUI_JS . 'jquery.nice-select.min.js', array('jquery'), WPCUI_VERSION);

                wp_enqueue_style('wpcui_nice_select_style', WPCUI_CSS . 'nice-select.css', array(), WPCUI_VERSION);

                wp_enqueue_style('wpcui-fontawesome', WPCUI_CSS . 'font-awesome/font-awesome.min.css', WPCUI_VERSION);

                wp_enqueue_script('wpcui-pro-webfont', '//ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js');

                // wp_enqueue_style('wpcui-google-fonts', '//fonts.googleapis.com/css?family=Raleway|ABeeZee|Aguafina+Script|Open+Sans|Roboto|Roboto+Slab|Lato|Titillium+Web|Source+Sans+Pro|Playfair+Display|Montserrat|Khand|Oswald|Ek+Mukta|Rubik|PT+Sans+Narrow|Poppins|Oxygen:300,400,600,700|Montserrat:300,800', array(), WPCUI_VERSION);
            }
        }

        /**
         * This is a function for registering frontend assets into the Plugin
         *
         * @since 1.0.0
         */
        function register_frontend_scripts() {

            wp_enqueue_script('wpcui-frontend_assets_scripts', WPCUI_JS . 'wpcui-frontend-script.js', array('jquery'), WPCUI_VERSION);
            wp_enqueue_style('wpcui-frontend_assets_styles', WPCUI_CSS . 'wpcui-frontend-style.css', array(), WPCUI_VERSION); //change styles to style in file name
            wp_enqueue_style('wpcui-fontawesome', WPCUI_CSS . 'font-awesome/font-awesome.min.css', WPCUI_VERSION);
            // wp_enqueue_style('wpcui-google-fonts', '//fonts.googleapis.com/css?family=Raleway|ABeeZee|Aguafina+Script|Open+Sans|Roboto|Roboto+Slab|Lato|Titillium+Web|Source+Sans+Pro|Playfair+Display|Montserrat|Khand|Oswald|Ek+Mukta|Rubik|PT+Sans+Narrow|Poppins|Oxygen:300,400,600,700', array(), WPCUI_VERSION);

            wp_enqueue_script('wpb-pro-webfont', '//ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js');

            wp_enqueue_style('wpcui_font_families','https://fonts.googleapis.com/css?family='.WPCUI_WEB_FONTS);

        }

        /**
         * This is a function for displaying cookie infos in list 
         *
         * @since 1.0.0
         */
        function display_menu_page() {
            $title = 'Listing';
            include_once WPCUI_DIR_PATH . 'inc/backend/wp_cookie_user_info.php';
        }

        /**
         * This is a function for choosing a Cookie info to activate into the Plugin
         *
         * @since 1.0.0
         */
        function choose_from_cookies() {

            if (current_user_can('manage_options')) {

                //To display the selected cookie first
                $selected_cookie = get_option('wpcui_selected_cookie_option');

                global $wpdb;

                $table = $wpdb->prefix . "wpcui_settings";

                $cookie_bars = $wpdb->get_results("SELECT * FROM $table");

                $active = false;

                if (count($cookie_bars) > 0) {
                    $active = true;
                }

                $title = 'Settings';

                include_once WPCUI_DIR_PATH . 'inc/backend/wpcui_settings_choice.php';
            }
        }

        /**
         * This is a function for saving form values for cookie info
         *
         * @since 1.0.0
         */
        function save_manage_form_settings() {
            if (isset($_POST['wpcui_nonce_field']) && wp_verify_nonce($_POST['wpcui_nonce_field'], 'wpcui_nonce') && current_user_can('manage_options')) {
                include_once WPCUI_DIR_PATH . 'settings/save_manage_form_settings.php';
            }
        }

        /**
         * This is a function for saving choosen cookie as active or inactive for cookie info
         *
         * @since 1.0.0
         */
        function save_choice_settings() {
            if (isset($_POST['wpcui_nonce_field']) && wp_verify_nonce($_POST['wpcui_nonce_field'], 'wpcui_nonce') && current_user_can('manage_options')) {
                include_once WPCUI_DIR_PATH . 'settings/save_choice_settings.php';
            }
        }

        /**
         * This is a function for displaying a submenu manage settings into the Plugin
         *
         * @since 1.0.0
         */
        function display_manage_settings_page() {

            if (current_user_can('manage_options')) {
                global $action;
                global $result;
                include_once WPCUI_DIR_PATH . 'inc/backend/manage_settings.php';
            }
        }

        /**
         * This is a function for displaying a submenu about into the Plugin
         *
         * @since 1.0.0
         */
        function display_about_page() {
            $title = 'More WordPress Stuff';
            include_once WPCUI_DIR_PATH . 'inc/backend/about.php';
        }

        /**
         * This is a function executes on plugin activation
         *
         * @since 1.0.0
         */
        function wpcui_plugin_activation() {

            include_once WPCUI_DIR_PATH . 'settings/advanced/activate.php';
        }

        /**
         * This function loads default values from the database
         *
         * @since 1.0.0
         */
        function load_default_general_options() {
            $options = array(
                'display_type' => array('bar'),
                'more_info_action' => array('page redirect'),
                'bar_position' => array('top absolute', 'top fixed', 'bottom'),
                'bar_template_type' => array(
                    'Template-1' => array(
                        'img' => WPCUI_IMAGE . 'template_images/template1.PNG'
                    ),
                    'Template-2' => array(
                        'img' => WPCUI_IMAGE . 'template_images/template2.PNG'
                    ),
                    'Template-3' => array(
                        'img' => WPCUI_IMAGE . 'template_images/template3.PNG'
                    ),
                    'Template-4' => array(
                        'img' => WPCUI_IMAGE . 'template_images/template4.PNG'
                    ),
                    'Template-5' => array(
                        'img' => WPCUI_IMAGE . 'template_images/template5.PNG'
                    ),
                ),
                'cookie_expiry' => array('show Always', 'per Session', 'show Once', 'show After'),
                'link_target' => array('_blank', '_self'),
                'displayed_pages' => array('show on all pages', 'show on Home page'),
                'select_template_type' => array('default', 'custom'),
            );
            update_option('wpcui_general_option', $options);

            /** Updating Google font into Database */
            $wpcui_font_family = array('Montserrat', 'Rubik', 'Open Sans', 'ABeeZee', 'Abel', 'Abril Fatface', 'Aclonica', 'Acme', 'Actor', 'Adamina', 'Advent Pro', 'Aguafina Script', 'Akronim', 'Aladin', 'Aldrich', 'Alef', 'Alegreya', 'Alegreya SC', 'Alegreya Sans', 'Alegreya Sans SC', 'Alex Brush', 'Alfa Slab One', 'Alice', 'Alike', 'Alike Angular', 'Allan', 'Allerta', 'Allerta Stencil', 'Allura', 'Almendra', 'Almendra Display', 'Almendra SC', 'Amarante', 'Amaranth', 'Amatic SC', 'Amethysta', 'Amiri', 'Amita', 'Anaheim', 'Andada', 'Andika', 'Angkor', 'Annie Use Your Telescope', 'Anonymous Pro', 'Antic', 'Antic Didone', 'Antic Slab', 'Anton', 'Arapey', 'Arbutus', 'Arbutus Slab', 'Architects Daughter', 'Archivo Black', 'Archivo Narrow', 'Arimo', 'Arizonia', 'Armata', 'Artifika', 'Arvo', 'Arya', 'Asap', 'Asar', 'Asset', 'Astloch', 'Asul', 'Atomic Age', 'Aubrey', 'Audiowide', 'Autour One', 'Average', 'Average Sans', 'Averia Gruesa Libre', 'Averia Libre', 'Averia Sans Libre', 'Averia Serif Libre', 'Bad Script', 'Balthazar', 'Bangers', 'Basic', 'Battambang', 'Baumans', 'Bayon', 'Belgrano', 'Belleza', 'BenchNine', 'Bentham', 'Berkshire Swash', 'Bevan', 'Bigelow Rules', 'Bigshot One', 'Bilbo', 'Bilbo Swash Caps', 'Biryani', 'Bitter', 'Black Ops One', 'Bokor', 'Bonbon', 'Boogaloo', 'Bowlby One', 'Bowlby One SC', 'Brawler', 'Bree Serif', 'Bubblegum Sans', 'Bubbler One', 'Buda', 'Buenard', 'Butcherman', 'Butterfly Kids', 'Cabin', 'Cabin Condensed', 'Cabin Sketch', 'Caesar Dressing', 'Cagliostro', 'Calligraffitti', 'Cambay', 'Cambo', 'Candal', 'Cantarell', 'Cantata One', 'Cantora One', 'Capriola', 'Cardo', 'Carme', 'Carrois Gothic', 'Carrois Gothic SC', 'Carter One', 'Caudex', 'Cedarville Cursive', 'Ceviche One', 'Changa One', 'Chango', 'Chau Philomene One', 'Chela One', 'Chelsea Market', 'Chenla', 'Cherry Cream Soda', 'Cherry Swash', 'Chewy', 'Chicle', 'Chivo', 'Cinzel', 'Cinzel Decorative', 'Clicker Script', 'Coda', 'Coda Caption', 'Codystar', 'Combo', 'Comfortaa', 'Coming Soon', 'Concert One', 'Condiment', 'Content', 'Contrail One', 'Convergence', 'Cookie', 'Copse', 'Corben', 'Courgette', 'Cousine', 'Coustard', 'Covered By Your Grace', 'Crafty Girls', 'Creepster', 'Crete Round', 'Crimson Text', 'Croissant One', 'Crushed', 'Cuprum', 'Cutive', 'Cutive Mono', 'Damion', 'Dancing Script', 'Dangrek', 'Dawning of a New Day', 'Days One', 'Dekko', 'Delius', 'Delius Swash Caps', 'Delius Unicase', 'Della Respira', 'Denk One', 'Devonshire', 'Dhurjati', 'Didact Gothic', 'Diplomata', 'Diplomata SC', 'Domine', 'Donegal One', 'Doppio One', 'Dorsa', 'Dosis', 'Dr Sugiyama', 'Droid Sans', 'Droid Sans Mono', 'Droid Serif', 'Duru Sans', 'Dynalight', 'EB Garamond', 'Eagle Lake', 'Eater', 'Economica', 'Eczar', 'Ek Mukta', 'Electrolize', 'Elsie', 'Elsie Swash Caps', 'Emblema One', 'Emilys Candy', 'Engagement', 'Englebert', 'Enriqueta', 'Erica One', 'Esteban', 'Euphoria Script', 'Ewert', 'Exo', 'Exo 2', 'Expletus Sans', 'Fanwood Text', 'Fascinate', 'Fascinate Inline', 'Faster One', 'Fasthand', 'Fauna One', 'Federant', 'Federo', 'Felipa', 'Fenix', 'Finger Paint', 'Fira Mono', 'Fira Sans', 'Fjalla One', 'Fjord One', 'Flamenco', 'Flavors', 'Fondamento', 'Fontdiner Swanky', 'Forum', 'Francois One', 'Freckle Face', 'Fredericka the Great', 'Fredoka One', 'Freehand', 'Fresca', 'Frijole', 'Fruktur', 'Fugaz One', 'GFS Didot', 'GFS Neohellenic', 'Gabriela', 'Gafata', 'Galdeano', 'Galindo', 'Gentium Basic', 'Gentium Book Basic', 'Geo', 'Geostar', 'Geostar Fill', 'Germania One', 'Gidugu', 'Gilda Display', 'Give You Glory', 'Glass Antiqua', 'Glegoo', 'Gloria Hallelujah', 'Goblin One', 'Gochi Hand', 'Gorditas', 'Goudy Bookletter 1911', 'Graduate', 'Grand Hotel', 'Gravitas One', 'Great Vibes', 'Griffy', 'Gruppo', 'Gudea', 'Gurajada', 'Habibi', 'Halant', 'Hammersmith One', 'Hanalei', 'Hanalei Fill', 'Handlee', 'Hanuman', 'Happy Monkey', 'Headland One', 'Henny Penny', 'Herr Von Muellerhoff', 'Hind', 'Holtwood One SC', 'Homemade Apple', 'Homenaje', 'IM Fell DW Pica', 'IM Fell DW Pica SC', 'IM Fell Double Pica', 'IM Fell Double Pica SC', 'IM Fell English', 'IM Fell English SC', 'IM Fell French Canon', 'IM Fell French Canon SC', 'IM Fell Great Primer', 'IM Fell Great Primer SC', 'Iceberg', 'Iceland', 'Imprima', 'Inconsolata', 'Inder', 'Indie Flower', 'Inika', 'Inknut Antiqua', 'Irish Grover', 'Istok Web', 'Italiana', 'Italianno', 'Jacques Francois', 'Jacques Francois Shadow', 'Jaldi', 'Jim Nightshade', 'Jockey One', 'Jolly Lodger', 'Josefin Sans', 'Josefin Slab', 'Joti One', 'Judson', 'Julee', 'Julius Sans One', 'Junge', 'Jura', 'Just Another Hand', 'Just Me Again Down Here', 'Kadwa', 'Kalam', 'Kameron', 'Kantumruy', 'Karla', 'Karma', 'Kaushan Script', 'Kavoon', 'Kdam Thmor', 'Keania One', 'Kelly Slab', 'Kenia', 'Khand', 'Khmer', 'Khula', 'Kite One', 'Knewave', 'Kotta One', 'Koulen', 'Kranky', 'Kreon', 'Kristi', 'Krona One', 'Kurale', 'La Belle Aurore', 'Laila', 'Lakki Reddy', 'Lancelot', 'Lateef', 'Lato', 'League Script', 'Leckerli One', 'Ledger', 'Lekton', 'Lemon', 'Libre Baskerville', 'Life Savers', 'Lilita One', 'Lily Script One', 'Limelight', 'Linden Hill', 'Lobster', 'Lobster Two', 'Londrina Outline', 'Londrina Shadow', 'Londrina Sketch', 'Londrina Solid', 'Lora', 'Love Ya Like A Sister', 'Loved by the King', 'Lovers Quarrel', 'Luckiest Guy', 'Lusitana', 'Lustria', 'Macondo', 'Macondo Swash Caps', 'Magra', 'Maiden Orange', 'Mako', 'Mallanna', 'Mandali', 'Marcellus', 'Marcellus SC', 'Marck Script', 'Margarine', 'Marko One', 'Marmelad', 'Martel', 'Martel Sans', 'Marvel', 'Mate', 'Mate SC', 'Maven Pro', 'McLaren', 'Meddon', 'MedievalSharp', 'Medula One', 'Megrim', 'Meie Script', 'Merienda', 'Merienda One', 'Merriweather', 'Merriweather Sans', 'Metal', 'Metal Mania', 'Metamorphous', 'Metrophobic', 'Michroma', 'Milonga', 'Miltonian', 'Miltonian Tattoo', 'Miniver', 'Miss Fajardose', 'Modak', 'Modern Antiqua', 'Molengo', 'Molle', 'Monda', 'Monofett', 'Monoton', 'Monsieur La Doulaise', 'Montaga', 'Montez', 'Montserrat Alternates', 'Montserrat Subrayada', 'Moul', 'Moulpali', 'Mountains of Christmas', 'Mouse Memoirs', 'Mr Bedfort', 'Mr Dafoe', 'Mr De Haviland', 'Mrs Saint Delafield', 'Mrs Sheppards', 'Muli', 'Mystery Quest', 'NTR', 'Neucha', 'Neuton', 'New Rocker', 'News Cycle', 'Niconne', 'Nixie One', 'Nobile', 'Nokora', 'Norican', 'Nosifer', 'Nothing You Could Do', 'Noticia Text', 'Noto Sans', 'Noto Serif', 'Nova Cut', 'Nova Flat', 'Nova Mono', 'Nova Oval', 'Nova Round', 'Nova Script', 'Nova Slim', 'Nova Square', 'Numans', 'Nunito', 'Odor Mean Chey', 'Offside', 'Old Standard TT', 'Oldenburg', 'Oleo Script', 'Oleo Script Swash Caps', 'Open Sans Condensed', 'Oranienbaum', 'Orbitron', 'Oregano', 'Orienta', 'Original Surfer', 'Oswald', 'Over the Rainbow', 'Overlock', 'Overlock SC', 'Ovo', 'Oxygen', 'Oxygen Mono', 'PT Mono', 'PT Sans', 'PT Sans Caption', 'PT Sans Narrow', 'PT Serif', 'PT Serif Caption', 'Pacifico', 'Palanquin', 'Palanquin Dark', 'Paprika', 'Parisienne', 'Passero One', 'Passion One', 'Pathway Gothic One', 'Patrick Hand', 'Patrick Hand SC', 'Patua One', 'Paytone One', 'Peddana', 'Peralta', 'Permanent Marker', 'Petit Formal Script', 'Petrona', 'Philosopher', 'Piedra', 'Pinyon Script', 'Pirata One', 'Plaster', 'Play', 'Playball', 'Playfair Display', 'Playfair Display SC', 'Podkova', 'Poiret One', 'Poller One', 'Poly', 'Pompiere', 'Pontano Sans', 'Poppins', 'Port Lligat Sans', 'Port Lligat Slab', 'Pragati Narrow', 'Prata', 'Preahvihear', 'Press Start 2P', 'Princess Sofia', 'Prociono', 'Prosto One', 'Puritan', 'Purple Purse', 'Quando', 'Quantico', 'Quattrocento', 'Quattrocento Sans', 'Questrial', 'Quicksand', 'Quintessential', 'Qwigley', 'Racing Sans One', 'Radley', 'Rajdhani', 'Raleway', 'Raleway Dots', 'Ramabhadra', 'Ramaraja', 'Rambla', 'Rammetto One', 'Ranchers', 'Rancho', 'Ranga', 'Rationale', 'Ravi Prakash', 'Redressed', 'Reenie Beanie', 'Revalia', 'Rhodium Libre', 'Ribeye', 'Ribeye Marrow', 'Righteous', 'Risque', 'Roboto', 'Roboto Condensed', 'Roboto Mono', 'Roboto Slab', 'Rochester', 'Rock Salt', 'Rokkitt', 'Romanesco', 'Ropa Sans', 'Rosario', 'Rosarivo', 'Rouge Script', 'Rozha One', 'Rubik Mono One', 'Rubik One', 'Ruda', 'Rufina', 'Ruge Boogie', 'Ruluko', 'Rum Raisin', 'Ruslan Display', 'Russo One', 'Ruthie', 'Rye', 'Sacramento', 'Sahitya', 'Sail', 'Salsa', 'Sanchez', 'Sancreek', 'Sansita One', 'Sarala', 'Sarina', 'Sarpanch', 'Satisfy', 'Scada', 'Scheherazade', 'Schoolbell', 'Seaweed Script', 'Sevillana', 'Seymour One', 'Shadows Into Light', 'Shadows Into Light Two', 'Shanti', 'Share', 'Share Tech', 'Share Tech Mono', 'Shojumaru', 'Short Stack', 'Siemreap', 'Sigmar One', 'Signika', 'Signika Negative', 'Simonetta', 'Sintony', 'Sirin Stencil', 'Six Caps', 'Skranji', 'Slabo 13px', 'Slabo 27px', 'Slackey', 'Smokum', 'Smythe', 'Sniglet', 'Snippet', 'Snowburst One', 'Sofadi One', 'Sofia', 'Sonsie One', 'Sorts Mill Goudy', 'Source Code Pro', 'Source Sans Pro', 'Source Serif Pro', 'Special Elite', 'Spicy Rice', 'Spinnaker', 'Spirax', 'Squada One', 'Sree Krushnadevaraya', 'Stalemate', 'Stalinist One', 'Stardos Stencil', 'Stint Ultra Condensed', 'Stint Ultra Expanded', 'Stoke', 'Strait', 'Sue Ellen Francisco', 'Sumana', 'Sunshiney', 'Supermercado One', 'Sura', 'Suranna', 'Suravaram', 'Suwannaphum', 'Swanky and Moo Moo', 'Syncopate', 'Tangerine', 'Taprom', 'Tauri', 'Teko', 'Telex', 'Tenali Ramakrishna', 'Tenor Sans', 'Text Me One', 'The Girl Next Door', 'Tienne', 'Tillana', 'Timmana', 'Tinos', 'Titan One', 'Titillium Web', 'Trade Winds', 'Trocchi', 'Trochut', 'Trykker', 'Tulpen One', 'Ubuntu', 'Ubuntu Condensed', 'Ubuntu Mono', 'Ultra', 'Uncial Antiqua', 'Underdog', 'Unica One', 'UnifrakturCook', 'UnifrakturMaguntia', 'Unkempt', 'Unlock', 'Unna', 'VT323', 'Vampiro One', 'Varela', 'Varela Round', 'Vast Shadow', 'Vesper Libre', 'Vibur', 'Vidaloka', 'Viga', 'Voces', 'Volkhov', 'Vollkorn', 'Voltaire', 'Waiting for the Sunrise', 'Wallpoet', 'Walter Turncoat', 'Warnes', 'Wellfleet', 'Wendy One', 'Wire One', 'Work Sans', 'Yanone Kaffeesatz', 'Yantramanav', 'Yellowtail', 'Yeseva One', 'Yesteryear', 'Zeyada');
    // $wpcui_fonts = get_option('wpcui_typo_fonts');
    // if (empty($wpcui_fonts)) {
            update_option('wpcui_typo_fonts', $wpcui_font_family);
        // }

        }

        /**
         * This is a function for defining constant values
         * throughout the plugin
         *
         * @since 1.0.0
         */
        function define_some_constants() {
            defined('WPCUI_DIR_PATH') or define('WPCUI_DIR_PATH', plugin_dir_path(__FILE__));
            defined('WPCUI_DIR_URL') or define('WPCUI_DIR_URL', plugin_dir_url(__FILE__));
            defined('WPCUI_CSS') or define('WPCUI_CSS', WPCUI_DIR_URL . 'assets/css/');
            defined('WPCUI_JS') or define('WPCUI_JS', WPCUI_DIR_URL . 'assets/js/');
            defined('WPCUI_VERSION') or define('WPCUI_VERSION', '1.1.0');
            defined('WPCUI_IMAGE') or define('WPCUI_IMAGE', WPCUI_DIR_URL . 'assets/images/');
            defined('WPCUI_DOMAIN') or define('WPCUI_DOMAIN', 'wp-cookie-user-info');
        }

        /**
         * This is a function for loading the text domains for plugins
         * Translations
         *
         * @since 1.0.0
         */
        function load_wpcui_textdomain() {
            load_textdomain(WPCUI_DOMAIN, dirname(plugin_basename(__FILE__)) . '/languages');
        }

        /**
         * This is a function for displaying cookie info in the frontend
         * Translations
         *
         * @since 1.0.0
         */
        function frontend_display_cookie_bar() {

            $selected_cookie = get_option('wpcui_selected_cookie_option');

            if ($selected_cookie['status'] ||
                    isset($_GET['wpcui_notice_preview']) //unless in preview mode
                ) {

                global $wpdb;
            $table = $wpdb->prefix . 'wpcui_settings';

                //Check for preview mode too
            $id = (isset($_GET['wpcui_notice_preview'])) ? intval($_GET['wpcui_notice_preview']) : intval($selected_cookie['cookie-bar']);
            $result = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id=%d",$id));
            $general_settings = maybe_unserialize($result->general_settings);
            $display_settings = maybe_unserialize($result->display_settings);
            $extra_settings = maybe_unserialize($result->extra_settings);

                // Custom template retreival if enabled
            $custom_template = false;
            if (
!empty( $display_settings['layout']['select_template_type']  ) && $display_settings['layout']['select_template_type'] == 'custom') {
                $custom_table_name = $wpdb->prefix . 'wpcui_custom_template';
                $id = esc_attr($display_settings['layout']['selected_custom_template']);
                $whole_templates = $wpdb->get_row($wpdb->prepare("SELECT * FROM $custom_table_name WHERE public_id=%d",$id));
                $custom_template = maybe_unserialize($whole_templates->template_details);
            }

                //Check for preview mode
            if (isset($_GET['wpcui_notice_preview'])) {
                include_once WPCUI_DIR_PATH . 'inc/frontend/cookie-bar-display.php';
            } elseif (
                (!isset($_COOKIE['cookieExpiry']))
            ) {

                if (
                    ($selected_cookie['displayed_pages'] == 'show on all pages') ||
                    (($selected_cookie['displayed_pages'] == 'show on Home page') && is_front_page())
                ) {

                    include_once WPCUI_DIR_PATH . 'inc/frontend/cookie-bar-display.php';
                }
            }
        }
    }

        /**
         * This is a function for displaying custom templates in a list
         * Translations
         *
         * @since 1.0.0
         */
        function list_custom_template() {

            if (isset($_GET['page']) && $_GET['page'] == 'wpcui-custom-template-settings') {
                if (isset($_GET['action'])) {
                    if ($_GET['action'] == 'add') {
                        $options = get_option('wpcui_general_option');
                        $base_templates = $options['display_type'];
                        $bar_templates = $options['bar_template_type'];
                        $title = __("Add New Template", WPCUI_DOMAIN);
                        include_once WPCUI_DIR_PATH . 'inc/backend/custom_templates/add_custom_template.php';
                    } elseif ($_GET['action'] == 'edit') {
                        global $wpdb;
                        $table_name = $wpdb->prefix . 'wpcui_custom_template';
                        $id = intval($_GET['id']);
                        $selected_template = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id=%d", $id));
                        $custom_template = maybe_unserialize($selected_template->template_details);
                        $options = get_option('wpcui_general_option');
                        $base_templates = $options['display_type'];
                        $bar_templates = $options['bar_template_type'];
                        $title = __("Edit $selected_template->template_name", WPCUI_DOMAIN);
                        include_once WPCUI_DIR_PATH . 'inc/backend/custom_templates/edit_custom_template.php';
                    }
                } else {
                    $title = 'Custom Template';
                    include_once WPCUI_DIR_PATH . 'inc/backend/custom_templates/listing_custom_template.php';
                }
            }
        }

        /**
         * This is a function for saving a custom template
         * Translations
         *
         * @since 1.0.0
         */
        function save_custom_template() {
            if ($_POST['wpcui_template_nonce'] && wp_verify_nonce($_POST['wpcui_template_nonce'], 'wpcui_template_nonce_field') && current_user_can('manage_options')) {
                include_once WPCUI_DIR_PATH . 'settings/custom_templates/save_custom_template.php';
            }
        }

        function sanitize_text_or_array_field($array_or_string) {
        if( is_string($array_or_string) ){
            $array_or_string = sanitize_text_field($array_or_string);
        }elseif( is_array($array_or_string) ){
            foreach ( $array_or_string as $key => &$value ) {
                if ( is_array( $value ) ) {
                    $value = $this->sanitize_text_or_array_field($value);
                }
                else {
                    $value = sanitize_text_field( $value );
                }
            }
        }

        return $array_or_string;
        }

        function sanitize_general_setting($array){
            foreach ($array as $main_index => $first_dim) {
                foreach ($first_dim as $category_index => $second_dim) {
                    foreach ($second_dim as $valued_index => $value) {
                        if ($valued_index == 'general_text') {
                            
                            $allowed_html = wp_kses_allowed_html( 'post' );
                            $general_settings[$main_index][$category_index][$valued_index] = wp_kses($value,$allowed_html) ;
                        }
                        else{
                        $general_settings[$main_index][$category_index][$valued_index] = sanitize_text_field($value) ;
                        }
                    }
                }
            }
            return $general_settings;
        }
    }

    new WPCUI_Class(); //Class initialization
} //End of Class