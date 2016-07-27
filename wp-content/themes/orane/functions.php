<?php
/**
 *functions files for Orane
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 * @package WordPress
 * @subpackage Orane
 * @since Orane 1.0
*/

//redux extension loader for custom extensions
require_once( dirname( __FILE__ ) . '/admin/redux-extensions/redux-loader.php' );

//init the redux framework
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/admin/redux-framework/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/admin/redux-framework/ReduxCore/framework.php' );
}


//init your redux overrides
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/admin/options-init.php' ) ) {
    require_once( dirname( __FILE__ ) . '/admin/options-init.php' );
}


// adds the seperator and descriptions to the title tag
add_filter( 'wp_title', 'orane_wp_title', 10, 2 );

function orane_wp_title( $title, $sep ) {

    global $paged, $page;

    if ( is_feed() ) {
        return $title;
    }

    //add the sitename to the title
    $site_description = get_bloginfo( 'description', 'display' );

    if(  substr_count($title, '|') > 0 ){
       $title = orane_deleteTitleLine($title);
    }


    if ( $site_description && ( is_home() || is_front_page() ) ) {
        $title .= get_bloginfo( 'name', 'display' );
        $title = "$title $sep $site_description";
    }else{
        $title .= " $sep " . get_bloginfo( 'name', 'display' );
    }

    return $title;

}



add_action( 'init', 'orane_cmb_meta_boxes', 9999 );

function orane_cmb_meta_boxes() {

    if ( !class_exists( 'cmb_Meta_Box' ) ) {
        include_once( dirname( __FILE__ ).'/cmb/init.php' );
    }

}




//tgm plugins activation
require_once( dirname( __FILE__ ) . '/core/class-tgm-plugin-activation.php' );

//tgm hook
add_action( 'tgmpa_register', 'orane_register_required_plugins' );

function orane_register_required_plugins(){

            $plugins = array(

                                array(
                                    'name'                  => 'Meta Box',
                                    'slug'                  => 'meta-box',
                                    'required'              => true,
                                    'force_activation'      => false,
                                    'force_deactivation'    => false,
                                    'source'                => get_template_directory_uri() . '/plugins/meta-box.zip',
                                ),


                                array(

                                    'name'                  => 'WPBakery Visual Composer', // The plugin name
                                    'slug'                  => 'js_composer', // The plugin slug (typically the folder name)
                                    'source'                => get_template_directory_uri() . '/plugins/js_composer.zip', // The plugin source
                                    'required'              => true, // If false, the plugin is only 'recommended' instead of required
                                    'version'               => '4.11.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                                    'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                                    'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                                    'external_url'          => '', // If set, overrides default API URL and points to an external URL
                                ),

                                array(

                                    'name'                  => 'Slider Revolution', // The plugin name
                                    'slug'                  => 'revslider', // The plugin slug (typically the folder name)
                                    'source'                => get_template_directory_uri() . '/plugins/revslider.zip', // The plugin source
                                    'required'              => true, // If false, the plugin is only 'recommended' instead of required
                                    'version'               => '5.2.4.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                                    'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                                    'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                                    'external_url'          => '', // If set, overrides default API URL and points to an external URL
                                ),

                                array(

                                    'name'                  => 'Orane Core', // The core plugin for the orane theme
                                    'slug'                  => 'orane_core', // The plugin slug (typically the folder name)
                                    'source'                => get_template_directory_uri() . '/plugins/orane_core.zip', // The plugin source
                                    'required'              => true, // If false, the plugin is only 'recommended' instead of required
                                    'version'               => '1.6.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                                    'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                                    'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                                    'external_url'          => '', // If set, overrides default API URL and points to an external URL
                                ),

                                array(
                                    'name'                  => 'Wordpress Importer',
                                    'slug'                  => 'wordpress-importer',
                                    'required'              => false,
                                    'force_activation'      => false,
                                ),


                                array(
                                    'name'                  => 'Contact Form 7',
                                    'slug'                  => 'contact-form-7',
                                    'required'              => false,
                                    'force_activation'      => false,
                                ),


                                array(
                                    'name'                  => 'MailChimp for WordPress',
                                    'slug'                  => 'mailchimp-for-wp',
                                    'required'              => false,
                                    'force_activation'      => false,
                                ),

                        );

                        $config = array(

                            'default_path' => '',                      // Default absolute path to pre-packaged plugins.
                            'menu'         => 'tgmpa-install-plugins', // Menu slug.
                            'has_notices'  => true,                    // Show admin notices or not.
                            'dismissable'  => false,                    // If false, a user cannot dismiss the nag message.
                            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
                            'is_automatic' => true,                   // Automatically activate plugins after installation or not.
                            'message'      => '',                      // Message to output right before the plugins table.
                            'strings'      => array(

                                'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
                                'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
                                'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
                                'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
                                'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
                                'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
                                'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
                                'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
                                'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
                                'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
                                'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
                                'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
                                'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
                                'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
                                'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
                                'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
                                'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
                                'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.


                            )

                        );

            tgmpa( $plugins, $config );
}
//ends tgm plugins activation


/////////add theme features
add_theme_support('woocommerce');

function orane_theme_features()  {

    //add RSS feed links to HTML <head>
    add_theme_support( 'automatic-feed-links' );

    //post formats
    add_theme_support( 'post-formats', array( 'status', 'quote', 'gallery', 'image', 'video', 'audio', 'link', 'aside' ) );

    //internationalization
    load_theme_textdomain('orane', get_template_directory() . '/languages');

    //add thumbnails sizes
    add_theme_support( 'post-thumbnails' ); // This feature enables post-thumbnail support for a theme
    add_image_size('small-thumb', 70, 70, true);
    add_image_size('port-size', 300, 200 , true); // 400 pixel wide and 200 pixel tall, resized proportionally
    add_image_size('blog-port-size', 400, 300 , true);
    add_image_size('product-full', 425, 350, true);
    add_image_size('product-huge', 1150, 1100, true);
    add_image_size('product-gallery', 460, 400, true);
    add_image_size('post-image', 780, 340, true);
}
add_action( 'after_setup_theme', 'orane_theme_features' );







if ( ! isset( $content_width ) ){
    $content_width = 1170;
}
//////ends theme features



//add own wrappers in woocommerce
//unlock the wrappers
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);


//my theme wrappers
add_action('woocommerce_before_main_content', 'orane_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'orane_wrapper_end', 10);

//start the woocommerce wrapper
function orane_wrapper_start() {
  echo '<div class="shop-main"><section class="shop-1"><div class="container woocommerce">';
}


//end the woocommmerce wrapper
function orane_wrapper_end() {
  echo '</div></section></div>';
}


//load libraries
function orane_load_assets(){

	//initilizations script
    wp_register_script('orane-custom', get_template_directory_uri() . '/js/custom.js',array( 'jquery' ), 1 , 1);

    //google maps only on contact page
    if( is_page_template( 'contact.php' ) ){

        wp_register_script('orane-gmap', get_template_directory_uri() . '/js/jquery.gmap.js',array( 'jquery' ), 1 , 1);
        wp_register_script('orane-mapapi', '//maps.google.com/maps/api/js?sensor=false',array( 'jquery' ), 1 , 1);
        wp_enqueue_script('orane-mapapi');
        wp_enqueue_script('orane-gmap');

    }

    //isotope, debounce resize and magnific popup can only be loaded when on portfolio page or a single post gallery format
    if( is_page_template( 'portfolio-full.php' ) || is_single() ){

        wp_register_script('orane-isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js',array( 'jquery' ), 1 , 1);
        wp_register_script('orane-debouncedresize', get_template_directory_uri() . '/js/jquery.debouncedresize.js',array( 'jquery' ), 1 , 1);
        wp_register_script('orane-magnific', get_template_directory_uri() . '/js/jquery.magnific-popup.js',array( 'jquery' ), 1 , 1);
        wp_enqueue_script('orane-isotope');
        wp_enqueue_script('orane-debouncedresize');
        wp_enqueue_script('orane-magnific');

    }

    //check if woocommerce product page
    if(function_exists('is_product')){

        //is product page
        if(is_product()){
            //zoom plugin only for woocommerce product page
            wp_register_script('orane-elevateZoom', get_template_directory_uri() . '/js/jquery.elevateZoom.min.js',array( 'jquery' ), '1.0.0' , 1);
            wp_enqueue_script('orane-elevateZoom');
        }

    }


    //universal scripts, loaded on all pages
    wp_register_script('orane-switcher', get_template_directory_uri() . '/js/switcher.js',array( 'jquery' ), 1 , 1);
    wp_register_script('orane-preloader', get_template_directory_uri() . '/js/preloaders.js',array( 'jquery' ), 1 , 1);
    wp_register_script('orane-uisearch', get_template_directory_uri() . '/js/uisearch.js',array( 'jquery' ), '1.0.0' , 1);
    wp_register_script('orane-classie', get_template_directory_uri() . '/js/classie.js',array( 'jquery' ), 1 , 1);
    wp_register_script('orane-modernizer', get_template_directory_uri() . '/js/modernizr-latest.js',array( 'jquery' ), '2.8.2' , 1);
    wp_register_script('orane-SmoothScroll', get_template_directory_uri() . '/js/SmoothScroll.js',array( 'jquery' ), '1.2.1' , 1);
    wp_register_script('orane-totop', get_template_directory_uri() . '/js/jquery.ui.totop.js',array( 'jquery' ), '1.2' , 1);
    wp_register_script('orane-easing', get_template_directory_uri() . '/js/easing.js',array( 'jquery' ), '1.1.2' , 1);
    wp_register_script('orane-wow', get_template_directory_uri() . '/js/wow.min.js',array( 'jquery' ), '0.1.6' , 1);
    wp_register_script('orane-sticky', get_template_directory_uri() . '/js/jquery.sticky.js',array( 'jquery' ), '1.0.0' , 1);
    wp_register_script('orane-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js',array( 'jquery' ), '1.0.0' , 1);
    wp_register_script('orane-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js',array( 'jquery' ), '1.0.0' , 1);



    global $redux_orane, $post;
    $orane_pie_color = array( 'color' => esc_attr($redux_orane['orane-bgcolor-scheme']) );


    //only for pages/posts

    if(is_single() || is_page() ){

        wp_localize_script( 'orane-custom', 'orane_var', $orane_pie_color );
        $map_title = esc_attr( get_post_meta( $post->ID, '_contact_map_title', true ) );
        $map_address = esc_attr( get_post_meta( $post->ID, '_contact_map_address', true ) );
        $map_zoom = esc_attr( get_post_meta( $post->ID, '_contact_map_zoom', true ) );
        $orane_map = array( 'gmap_title' => $map_title, 'gmap_address' => $map_address, 'gmap_zoom' => $map_zoom );
        wp_localize_script( 'orane-gmap', 'orane_map', $orane_map );
    }







    //load the universal scripts
    wp_enqueue_script('orane-bootstrap');
    wp_enqueue_script('orane-sticky');
    wp_enqueue_script('orane-wow');
    wp_enqueue_script('orane-easing');
    wp_enqueue_script('orane-totop');
    wp_enqueue_script('orane-SmoothScroll');
    wp_enqueue_script('orane-modernizer');
    wp_enqueue_script('orane-classie');
    wp_enqueue_script('orane-uisearch');
    wp_enqueue_script('orane-waypoint');
    wp_enqueue_script('orane-preloader');
    wp_enqueue_script('orane-switcher');
    wp_enqueue_script('orane-bootstrap');
    wp_enqueue_script('orane-custom');



	//styles to be compiled
	$theme_switch = esc_attr($redux_orane['orane-bgcolor-scheme']);
	$theme_color = esc_attr($redux_orane['orane-color-scheme']);
	$theme_button = esc_attr($redux_orane['orane-bgcolor-button']);
	$border_bottom = esc_attr($redux_orane['orane-menu-current']);
	$border_color = esc_attr($redux_orane['orane-icon-borders']);
    $buttons_hover = esc_attr($redux_orane['orane-bgcolor-button-hover']);
    $show_menu_search = $redux_orane['orane-show-menu-search'];

    $search_menu_option = "";

    if($show_menu_search == 0){
    	$search_menu_option = ".menu-menu-1-container > ul.nav{
    								padding-right:0;
    							}
								.navbar-collapse{
									padding-right:0;
								}";
    }


$orane_css_compile = "#preloader span{

		border-color: #656565 {$theme_switch};

}

.hero-section, .work, .social-bar, .searchform input[type='submit'], #commentform #submit, .blogDetails td:hover, .tagcloud a:hover, .question, .tp-caption.mediumbgcolor, .mediumbgcolor, .numbers, .progress .progress-bar-warning, .seo .btn-1:hover, ul.products li.product .add_to_cart_button, .woocommerce #content div.product form.cart .button, .woocommerce div.product form.cart .button, .woocommerce-page #content div.product form.cart .button, .woocommerce-page div.product form.cart .button, .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active, .woocommerce #content input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page #content input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page input.button.alt, .woocommerce #content nav.woocommerce-pagination ul li a:focus, .woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li a:focus, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li span.current, .woocommerce-page nav.woocommerce-pagination ul li a:focus, .woocommerce-page nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li span.current, .wpcf7-submit{

background-color: {$theme_switch};

}

.post-1 .author-name, .a-t-2 .panel-heading i, .color, .macs .right-ul i, .macs .left-ul i, .seo-2 .btn-1, .latest-blog-excerpt a, .latest-blog-comment, .testi-position, .orane-sidebar ul li a:hover, .social-icons a:hover, footer .post-title .title:hover, .current-menu-item > a, .blog-read-more:hover, a:hover, a:focus, .service:hover .service-head, .service:hover .icon i, ul.products li.product > a h3, .woocommerce #content div.product p.price, .woocommerce #content div.product span.price, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce-page #content div.product p.price, .woocommerce-page #content div.product span.price, .woocommerce-page div.product p.price, .woocommerce-page div.product span.price, .woocommerce .woocommerce-breadcrumb a, .woocommerce-page .woocommerce-breadcrumb a, .bbp-breadcrumb a, .woocommerce-pagination .page-numbers li a, .wpb_toggle, #content h4.wpb_toggle, .post-1 .author-name, .color, .macs .right-ul i, .macs .left-ul i, .seo-2 .btn-1, .latest-blog-excerpt a, .latest-blog-comment, .testi-position, .orane-sidebar ul li a:hover,  .navbar-default .navbar-nav > li.current-menu-item > a, .social-icons a:hover, footer .post-title .title:hover, .current-menu-item > a, .blog-read-more:hover, a:hover, a:focus, .service:hover .service-head, .service:hover .icon i, .woocommerce-account .addresses .title .edit{

	color: {$theme_color};

}

.hero-section, .work, .social-bar, .searchform input[type='submit'], #commentform #submit, .blogDetails td:hover, .tagcloud a:hover, .question, .tp-caption.mediumbgcolor, .mediumbgcolor, .numbers, .progress .progress-bar-warning, .seo .btn-1:hover, ul.products li.product .add_to_cart_button, .woocommerce #content div.product form.cart .button, .woocommerce div.product form.cart .button, .woocommerce-page #content div.product form.cart .button, .woocommerce-page div.product form.cart .button, .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active, .woocommerce #content input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page #content input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page input.button.alt, .woocommerce #content nav.woocommerce-pagination ul li a:focus, .woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li a:focus, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li span.current, .woocommerce-page nav.woocommerce-pagination ul li a:focus, .woocommerce-page nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li span.current, .wpcf7-submit{

	background-color: {$theme_switch};

}

.navbar-default .navbar-nav > li:hover > a, .navbar-default .navbar-nav > li.current-menu-item > a{

	border-bottom-color: {$border_bottom};

}

.macs .right-ul i, .macs .left-ul i, .blog-read-more:hover, .wpcf7-form-control[type='text']:focus, .wpcf7-form-control[type='email']:focus, textarea.wpcf7-form-control:focus{

	border-color: {$border_color};

}

.popup{

	background: -webkit-linear-gradient(top left, white 50%, {$theme_switch} 50%);

    background:    -moz-linear-gradient(top left, white 50%, {$theme_switch} 50%);

    background:     -ms-linear-gradient(top left, white 50%, {$theme_switch} 50%);

    background:      -o-linear-gradient(top left, white 50%, {$theme_switch} 50%);

    background:         linear-gradient(top left, white 50%, {$theme_switch} 50%);

}

.popup:hover {

    background: -webkit-linear-gradient(top left, {$theme_switch} 50%, white 50%);

    background:    -moz-linear-gradient(top left, {$theme_switch} 50%, white 50%);

    background:     -ms-linear-gradient(top left, {$theme_switch} 50%, white 50%);

    background:      -o-linear-gradient(top left, {$theme_switch} 50%, white 50%);

    background:         linear-gradient(top left, {$theme_switch} 50%, white 50%);

	transition:.5s;

}

.tp-caption.mediumbgcolor, .mediumbgcolor{

	background-color:{$theme_switch} !important;

}

.subscribe input[type='submit']{
    background-color: {$theme_button};
}
.seo .btn-1{
    background-color: {$theme_switch};
}

ul.products li.product .add_to_cart_button, .subscribe .sub-btn, .subscribe input[type='submit'], .searchform input[type='submit'], #commentform #submit, #searchsubmit, .tagcloud a, .seo .btn-1, ul.products li.product .add_to_cart_button, .woocommerce #content div.product form.cart .button, .woocommerce div.product form.cart .button, .woocommerce-page #content div.product form.cart .button, .woocommerce-page div.product form.cart .button, .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active, .woocommerce #content input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page #content input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page input.button.alt, .woocommerce #content nav.woocommerce-pagination ul li a:focus, .woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li a:focus, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li span.current, .woocommerce-page nav.woocommerce-pagination ul li a:focus, .woocommerce-page nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li span.current, .wpcf7-submit, #bbp_reply_submit, #bbp_topic_submit, #buddypress .comment-reply-link, #buddypress a.button, #buddypress button, #buddypress div.generic-button a, #buddypress input[type='button'], #buddypress input[type='reset'], #buddypress input[type='submit'], #buddypress ul.button-nav li a, a.bp-title-button, .woocommerce #content input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce-page #content input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt, .subscribe .sub-btn, .subscribe input[type='submit']{
    background-color: {$theme_button};
}

.paging-navigation ul li span{
    background-color: {$theme_switch};
}

.a-t-2 .panel-group .panel{
    border-color: {$theme_switch};
}
.wpcf7-submit:hover{
    border-color: {$theme_switch};
    color: {$theme_switch};
}

.contact .social-icons-2 li:hover{
    border-color:{$theme_switch};
    color: {$theme_switch};
}

.contact .social-icons-2 li:hover a{
    color: {$theme_switch};
}

.woocommerce nav.woocommerce-pagination ul li span.current{
    border-color: {$theme_switch};
}

.paging-navigation ul li span.current{
    border-color: {$theme_switch};
}
{$search_menu_option}
";





	  orane_compile_css($orane_css_compile);
    wp_enqueue_style( 'orane-main-css', get_stylesheet_uri(), array() );
    wp_enqueue_style('orane-css-compile',get_template_directory_uri() . '/css/compile.css');

}
add_action( 'wp_enqueue_scripts', 'orane_load_assets' );


//woocommerce images override
function orane_woocommerce_image_dimensions() {

    global $pagenow;

    if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {

        return;

    }



    $catalog = array(

        'width' => '400', // px
        'height'    => '400', // px
        'crop'  => 1 // true

    );


    $single = array(

        'width' => '600', // px
        'height'    => '600', // px
        'crop'  => 1 // true

    );


    $thumbnail = array(

        'width' => '240', // px
        'height'    => '240', // px
        'crop'  => 0 // false

    );

    // Image sizes
    update_option( 'shop_catalog_image_size', $catalog ); // Product category thumbs
    update_option( 'shop_single_image_size', $single ); // Single product image
    update_option( 'shop_thumbnail_image_size', $thumbnail ); // Image gallery thumbs

}



add_action( 'after_switch_theme', 'orane_woocommerce_image_dimensions', 1 );


//visual composer settings
if ( defined( 'WPB_VC_VERSION' ) ) {
    vc_disable_frontend();
}


//set visual composer as "built-into the theme"
add_action( 'vc_before_init', 'orane_vcSetAsTheme' );
function orane_vcSetAsTheme() {
    vc_set_as_theme($disable_updater = false);
}



//helper functions:
//style the title tag words enclosed inside ||
function orane_line2SpanColor($title){

     $title1 = preg_replace("/\|(.+?)\|/", "<span class='color'>$1</span>", $title);
     return $title1;

}

//remove the || from titles where not needed
function orane_deleteTitleLine($title){
    $title = str_replace("|","",$title);
    return $title;
}

//bold the title tag words enclosed inside ||
function line2Bold($title){

     $title1 = preg_replace("/\|(.+?)\|/", "<b>$1</b>", $title);
     return $title1;
}



//allows to add inline styles
function orane_add_inline_styles($selector, $css, $value){

        $selector = esc_attr($selector);
        $css= esc_attr($css);
        $value = esc_attr($value);


        $value_out = get_theme_mod( $value ); //E.g. #FF0000
        $custom_css = "

                {$selector}{



                        {$css}: {$value_out};

                }";



        wp_add_inline_style('orane-css-compile', $custom_css );



}//end of function




//the css compiler
function orane_compile_css($css) {

      $filename = get_template_directory() . '/css/compile.css';
      global $wp_filesystem;

      if( empty( $wp_filesystem ) ) {
        require_once( ABSPATH .'/wp-admin/includes/file.php' );
        WP_Filesystem();

      }

      if( $wp_filesystem ) {

        $wp_filesystem->put_contents(
            $filename,
            $css,
            FS_CHMOD_FILE // predefined mode settings for WP files
        );

      }


}//end of function




//load woocommerce css for some pages
add_action('wp','orane_check_template');

function orane_check_template() {

        define('WOOCOMMERCE_USE_CSS', false);

}


//woo breadcrumbs customization
add_filter( 'woocommerce_breadcrumb_defaults', 'orane_change_breadcrumb_delimiter' );
function orane_change_breadcrumb_delimiter( $defaults ) {



    // Change the breadcrumb delimeter from '/' to '>'



    $defaults['delimiter'] = ' &gt; ';



    return $defaults;



}






//paginations:
function orane_pagination() {



    // Don't print empty markup if there's only one page.
    if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
        return;
    }

    $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
    $pagenum_link = html_entity_decode( get_pagenum_link() );
    $query_args   = array();
    $url_parts    = explode( '?', $pagenum_link );

    if ( isset( $url_parts[1] ) ) {
        wp_parse_str( $url_parts[1], $query_args );
    }

    $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
    $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';
    $format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
    $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

    // Set up paginated links.
    $links = paginate_links( array(
        'base'     => $pagenum_link,
        'format'   => $format,
        'total'    => $GLOBALS['wp_query']->max_num_pages,
        'current'  => $paged,
        'mid_size' => 3,
        'add_args' => array_map( 'urlencode', $query_args ),
        'prev_text' => '«',
        'next_text' => '»',
        'type'      => 'list',
    ) );

    if ( $links ) :
    ?>



    <nav class="navigation paging-navigation pagination" role="navigation">







            <?php echo balanceTags($links, true); ?>



    </nav><!-- .navigation -->



    <?php



    endif;



}











//excerpt settings:



function orane_excerpt_more( $more ) {



    return '...';



}



add_filter('excerpt_more', 'orane_excerpt_more');







//theme widgets:



include_once( dirname( __FILE__ ).'/orane-widgets.php' );


function orane_widgets_init() {
    //the sidebar
    register_sidebar( array(
        'name' => 'Sidebar',
        'id' => 'orane_sidebar',
        'before_widget' => '<div class="orane-sidebar">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="rounded">',
        'after_title' => '</h2>',
    ) );


    //the footer 1
    register_sidebar( array(

        'name' => 'Footer Column 1',
        'id' => 'orane_footer1',
        'before_widget' => '<div class="orane_footer_widget_single">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => '',

    ) );


    //the footer 2
    register_sidebar( array(

        'name' => 'Footer Column 2',
        'id' => 'orane_footer2',
        'before_widget' => '<div class="orane_footer_widget_single">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => '',

    ) );



    //the footer 3
    register_sidebar( array(

        'name' => 'Footer Column 3',
        'id' => 'orane_footer3',
        'before_widget' => '<div class="orane_footer_widget_single">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => '',

    ) );


    //the footer 4
    register_sidebar( array(

        'name' => 'Footer Column 4',
        'id' => 'orane_footer4',
        'before_widget' => '<div class="orane_footer_widget_single">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => '',

    ) );



}
add_action( 'widgets_init', 'orane_widgets_init' );







// tags cloud







function orane_tag_cloud_widget($args) {



    $args['largest'] = 14; //largest tag



    $args['smallest'] = 14; //smallest tag



    $args['unit'] = 'px'; //tag font unit



    return $args;



}

add_filter( 'widget_tag_cloud_args', 'orane_tag_cloud_widget' );







function orane_next_prev(){

     $prevPost = get_previous_post(true);
     $nextPost = get_next_post(true);
     $nextURL = "";
     $prevURL = "";

     $next_str = "";
     $prev_str = "";

     $next_string = __("Next >>", 'orane');
     $prev_string = __("<< Previous", 'orane');

	if(!empty($nextPost)){
        $nextURL = esc_url(get_permalink($nextPost->ID));
        $next_str = "<div class='next_prev col-md-12'><a class='pull-right' href='{$nextURL}'><span class='color'>{$next_string}</span></a>";
     } else {
        $next_str = "<div class='next_prev col-md-12'>";
     }


     if(!empty($prevPost)){
        $prevURL = esc_url(get_permalink($prevPost->ID));
        $prev_str = "<a class='pull-left' href='{$prevURL}'><span class='color'>{$prev_string}</span></a></div>";
     }else{

          $prev_str .= "</div>";
     }


     echo $next_str;
     echo $prev_str;

	wp_link_pages( array(

		'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'orane' ) . '</span>',

		'after'       => '</div>',

		'link_before' => '<span>',

		'link_after'  => '</span>',

		) );



}


// register menus
function orane_nav_menu() {
  register_nav_menu('top-menu',__( 'Top Menu' ));
}



add_action( 'init', 'orane_nav_menu' );

function orane_submenu_class($menu) {
  $menu = preg_replace('/ class="sub-menu"/',' class="dropdown-menu" ',$menu);
  $menu = preg_replace('/ menu-item-has-children /',' dropdown ',$menu);
  //menu-item-has-children
  return $menu;

}


add_filter('wp_nav_menu','orane_submenu_class');

require_once( dirname( __FILE__ ) . '/comments-walker.php' );





//search widgets filter
add_filter('get_search_form', 'orane_form');

function orane_form($text) {



     $text = str_replace('value="Search"', 'value="Search"', $text);



     return $text;



}


//layout metaboxes
require_once( dirname( __FILE__ ) . '/cmb.php' );

function clientsFooter(){

            global $redux_orane;
            $is_front = 0;

            if ( is_front_page() ){
                $clients_show_home = esc_attr( $redux_orane['orane-show-clients-section-home'] );
                if( $clients_show_home == 0 ){
                    return;
                }

                $is_front = 1;
            }


            $show_clients = esc_attr( $redux_orane['orane-show-clients-section'] );

            if($show_clients == 0 && $is_front == 0){
                return "";
            }

            $max = esc_attr( $redux_orane['orane-clients-max-num'] );
            $title = orane_line2SpanColor( esc_attr($redux_orane["orane-clients-text-title"]) );
            $body = wp_kses_post($redux_orane["orane-clients-text-body"]);
            $count = 0;
            $args = array( 'post_type' => 'client', 'posts_per_page' => $max );
            $loop = new WP_Query( $args );

            echo "<section class='partners partners-2'>
                        <div class='container'>
                            <div class='col-md-6'>";

            echo            "<h2>{$title}</h2>
                                <p>{$body}</p>
                            </div>";

            echo            "<div class='col-md-6'>
                                <div class='row'>";


                while ( $loop->have_posts() ) : $loop->the_post();

                $thumb = get_the_post_thumbnail();
                $id = get_the_id();
                $url = get_post_meta( $id, '_clients_mb_client_url', true );

                $count++;

                    if($count % 3 == 0){

                        echo        "<div class='col-md-4 border-2'>

                                        <a href='{$url}' target='_blank'>{$thumb}</a>

                                    </div>";
                    }else{

                        echo        "<div class='col-md-4 border-1'>

                                        <a href='{$url}' target='_blank'>{$thumb}</a>

                                    </div>";
                    }

                endwhile;

                echo      "</div>

                        </div>

                        </div>

                    </section>";



}//end of clients footer


//auto-updates server settings
// if(orane_check_internet_connection()){

//     require_once('wp-updates-theme.php');
//     new WPUpdatesThemeUpdater_1197( 'http://wp-updates.com/api/2/theme', basename( get_template_directory() ) );

// }


//update server
require get_template_directory() . '/theme-update-checker.php';
$WishUpdateChecker = new ThemeUpdateChecker(
                            'orane',
                            'http://redhawk-studio.com/themes/updates/orane-metadata.json'
                            );






//check if offline
function orane_check_internet_connection($sCheckHost = 'www.google.com'){

    return (bool) @fsockopen($sCheckHost, 80, $iErrno, $sErrStr, 5);

}


//parse for shortcodes in the footer
function orane_footer_shortcodes($string) {

    $string = str_replace("[current-year]", date("Y") , $string );
    $string = str_replace("[site-tagline]", get_bloginfo ( 'description' ), $string);
    $string = str_replace("[site-title]", get_bloginfo('name'), $string);
    $string = str_replace("[logout-url]", wp_logout_url(), $string);
    $string = str_replace("[login-url]", wp_login_url(), $string);
    $string = str_replace("[theme-url]", 'http://themeforest.net/item/orane-an-evolutionary-wordpress-theme/10660712', $string);
    $string = str_replace("[site-url]", get_site_url(), $string);



    return $string;

}


//remove redux admin notices and ads
function orane_removeDemoModeLink() { // Be sure to rename this function to something more unique
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );
    }
}
add_action('init', 'orane_removeDemoModeLink');



if ( ! function_exists( 'redux_disable_dev_mode_plugin' ) ) {
        function redux_disable_dev_mode_plugin( $redux ) {
            if ( $redux->args['opt_name'] != 'redux_demo' ) {
                $redux->args['dev_mode'] = false;
            }
        }

        add_action( 'redux/construct', 'redux_disable_dev_mode_plugin' );
}







//what happens in the demo data import, stays in this function
function orane_after_demo_import( $demo_active_import , $demo_directory_path ) {
		reset( $demo_active_import );
		$current_key = key( $demo_active_import );


		$wbc_menu_array = array( 'demo1' );

		//set menu: bug: duplicates menu items on each demo data import

		/*if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			$top_menu = get_term_by( 'name', 'Menu 1', 'nav_menu' );


			if ( isset( $top_menu->term_id ) ) {

				 //remove_theme_mod( 'nav_menu_locations' ); doesnt work


				 set_theme_mod( 'nav_menu_locations', array(
				 		'top-menu' => $top_menu->term_id,
					)
				 );

			}
		}*/

		// array of demos/homepages to check/select from
		$wbc_home_pages = array(
			'demo1' => 'Home',
		);
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
			$page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
			if ( isset( $page->ID ) ) {
				update_option( 'page_on_front', $page->ID );
				update_option( 'show_on_front', 'page' );
			}
		}
}
add_action( 'wbc_importer_after_content_import', 'orane_after_demo_import', 10, 2 );

// visual composer helper functions
if ( !function_exists( 'orane_build_style' ) ) {

    function orane_build_style( $bg_image = '', $bg_color = '', $bg_image_repeat = '', $font_color = '', $padding = '', $padding_bottom = '', $padding_top = '', $margin_bottom = '' ) {
        $has_image = false;
        $style = '';
        if ( ( int ) $bg_image > 0 && ( $image_url = wp_get_attachment_url( $bg_image, 'large' ) ) !== false ) {
            $has_image = true;
            $style .= "background-image: url(" . $image_url . ");";
        }
        if ( !empty( $bg_color ) ) {
            $style .= 'background-color: ' . $bg_color . ';';
        }
        if ( !empty( $bg_image_repeat ) && $has_image ) {
            if ( $bg_image_repeat === 'cover' ) {
                $style .= "background-repeat:no-repeat;background-size: cover;";
            } elseif ( $bg_image_repeat === 'contain' ) {
                $style .= "background-repeat:no-repeat;background-size: contain;";
            } elseif ( $bg_image_repeat === 'no-repeat' ) {
                $style .= 'background-repeat: no-repeat;';
            }
        }
        if ( !empty( $font_color ) ) {
            $style .= 'color: ' . $font_color . ';';
        }
        if ( $padding != '' ) {
            $style .= 'padding: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $padding ) ? $padding : $padding . 'px' ) . ';';
        }
        if ( $padding_bottom != '' ) {
            $style .= 'padding-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $padding_bottom ) ? $padding_bottom : $padding_bottom . 'px' ) . ';';
        }
        if ( $padding_top != '' ) {
            $style .= 'padding-top: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $padding_top ) ? $padding_top : $padding_top . 'px' ) . ';';
        }
        if ( $margin_bottom != '' ) {
            $style .= 'margin-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $margin_bottom ) ? $margin_bottom : $margin_bottom . 'px' ) . ';';
        }
        return empty( $style ) ? $style : ' style="' . $style . '"';
    }

}


//stop visual composer from asking to activate, its not required in the built-into theme version
setcookie('vchideactivationmsg', '1', strtotime('+3 years'), '/');


// set revolution slider as a part of theme
if(function_exists( 'set_revslider_as_theme' )){
add_action( 'init', 'orane_revolution_as_theme' );
    function orane_revolution_as_theme() {
         set_revslider_as_theme();
    }
}


//add extra parameters for Row element
if(function_exists('vc_add_param')){
vc_add_param( "vc_row", array(
    "type" => "dropdown",
    "class" => "",
    "group"  => "Width",
    "heading" => "Type",
    "param_name" => "type",
    "value" => array(
        "Orane Default" => "",
        "Container" => "container",
    ),
) );
}




?>
