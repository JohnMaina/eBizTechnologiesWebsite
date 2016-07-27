<?php
/**
  ReduxFramework Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('Orane_Redux_Framework_config')) {

    class Orane_Redux_Framework_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;

            }

            // This is needed. Bah WordPress bugs.  ;)
            if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }



        public function initSettings() {



            // Just for demo purposes. Not needed per say.

            $this->theme = wp_get_theme();



            // Set the default arguments

            $this->setArguments();



            // Set a few help tabs so you can see how it's done

            $this->setHelpTabs();



            // Create the sections and fields

            $this->setSections();



            if (!isset($this->args['opt_name'])) { // No errors please

                return;

            }



            // If Redux is running as a plugin, this will remove the demo notice and links

            add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

            

            // Function to test the compiler hook and demo CSS output.

            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.

            add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2);

            

            // Change the arguments after they've been declared, but before the panel is created

            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );

            

            // Change the default value of a field after it's been set, but before it's been useds

            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );

            

            // Dynamically add a section. Can be also used to modify sections/fields

            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));



            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);

        }



        /**



          This is a test function that will let you see when the compiler hook occurs.

          It only runs if a field   set with compiler=>true is changed.



         * */

        function compiler_action($options, $css) {

              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = get_template_directory() . '/css/overrules.css';
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


        /**
          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {

            //$sections = array();

            $sections[] = array(

                'title' => __('Section via hook', 'orane'),

                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'orane'),

                'icon' => 'el-icon-paper-clip',

                // Leave this as a blank section, no options just some intro text set above.

                'fields' => array()

            );



            return $sections;

        }



        /**



          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.



         * */

        function change_arguments($args) {

            $args['dev_mode'] = false;



            return $args;

        }



        /**



          Filter hook for filtering the default value of any given field. Very useful in development mode.



         * */

        function change_defaults($defaults) {

            $defaults['str_replace'] = 'Testing filter hook!';



            return $defaults;

        }



        // Remove the demo link and the notice of integrated demo from the redux-framework plugin

        function remove_demo() {



            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.

            if (class_exists('ReduxFrameworkPlugin')) {

                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);



                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.

                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));

            }

        }



        public function setSections() {



            /**

              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples

             * */

            // Background Patterns Reader

            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';

            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';

            $sample_patterns        = array();



            if (is_dir($sample_patterns_path)) :



                if ($sample_patterns_dir = opendir($sample_patterns_path)) :

                    $sample_patterns = array();



                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {



                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {

                            $name = explode('.', $sample_patterns_file);

                            $name = str_replace('.' . end($name), '', $sample_patterns_file);

                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);

                        }

                    }

                endif;

            endif;



            ob_start();



            $ct             = wp_get_theme();

            $this->theme    = $ct;

            $item_name      = $this->theme->get('Name');

            $tags           = $this->theme->Tags;

            $screenshot     = $this->theme->get_screenshot();

            $class          = $screenshot ? 'has-screenshot' : '';



            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'orane'), $this->theme->display('Name'));

            

            ?>

            <div id="current-theme" class="<?php echo esc_attr($class); ?>">

            <?php if ($screenshot) : ?>

                <?php if (current_user_can('edit_theme_options')) : ?>

                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">

                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />

                        </a>

                <?php endif; ?>

                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />

                <?php endif; ?>



                <h4><?php echo $this->theme->display('Name'); ?></h4>



                <div>

                    <ul class="theme-info">

                        <li><?php printf(__('By %s', 'orane'), $this->theme->display('Author')); ?></li>

                        <li><?php printf(__('Version %s', 'orane'), $this->theme->display('Version')); ?></li>

                        <li><?php echo '<strong>' . __('Tags', 'orane') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>

                    </ul>

                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>

            <?php

            if ($this->theme->parent()) {

                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'orane'), $this->theme->parent()->display('Name'));

            }

            ?>



                </div>

            </div>



            <?php

            $item_info = ob_get_contents();



            ob_end_clean();



            $sampleHTML = '';

            if (file_exists(dirname(__FILE__) . '/info-html.html')) {

                /** @global WP_Filesystem_Direct $wp_filesystem  */

                global $wp_filesystem;

                if (empty($wp_filesystem)) {

                    require_once(ABSPATH . '/wp-admin/includes/file.php');

                    WP_Filesystem();

                }

                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');

            }





            $this->sections[] = array(

                'icon'      => 'el-icon-cogs',

                'submenu' => false,

                'title'     => __('General Settings', 'orane'),

                'fields'    => array(







                    array(

                            'id'       => 'orane-logo-image',
                            'type'     => 'media',
                            'height'   => '50px',
                            'url'      => true,
                            'title'    => __('Logo', 'orane'),
                            'desc'     => __('Set the logo dimensions below, avoid uploading large images', 'orane'),
                            'subtitle' => __('Upload Any Image For The Site Logo', 'orane'),
                            'default'  => array(
                                'url'  => get_template_directory_uri() . '/images/orane_logo.png'
                            ),
                        ),



                        array(
                            'id'       => 'opt_logo_dimensions',
                            'type'     => 'dimensions',
                            'units'    => array('em','px','%'),
                            'title'    => __('Dimensions (Width/Height) Of The Logo', 'orane'),
                            'subtitle' => __('Allows you to choose width, height, and/or unit for the logo.', 'orane'),
                            'desc'     => __('Default size is 196 x 42 (W x H), only works if you choose logo in the above option', 'orane'),
                            'default'  => array(
                                'Width'   => '196', 
                                'Height'  => '42'
                            ),

                            'compiler'  => array(
                                                    '.navbar-brand img',
                                                ),
                        ),



                        array(
                            'id'             => 'opt-logo-spacing',
                            'type'           => 'spacing',
                            'compiler'         => array('.navbar-brand img'),
                            'mode'           => 'margin',
                            'right'           => false,
                            'bottom'           => false,
                            'units'          => array('px'),
                            'units_extended' => 'false',
                            'title'          => __('Logo Position', 'orane'),
                            'subtitle'       => __('Allow you to set the logo position relative to its current position', 'orane'),
                            'desc'           => __('You can use negative numbers for reverse direction.', 'orane'),
                            'default'            => array(
                                'margin-top'     => '0px', 
                                'margin-right'   => '0px', 
                                'margin-bottom'  => '0px', 
                                'margin-left'    => '0px',
                                'units'          => 'px', 
                            )
                        ),



                    array(

                            'id'       => 'orane-logo-image-2',

                            'type'     => 'media',

                            // 'width'    => '200px',

                            // 'height'   => '50px',

                            'url'      => true,

                            'title'    => __('Logo (No Resize)', 'orane'),

                            'desc'     => __('Custom Size Logo, wont be resized, only works if the above logo is not set', 'orane'),

                            'subtitle' => __('Upload Any Image For The Site Logo', 'orane'),

                            'default'  => array(

                                'url'  => get_template_directory_uri() . '/images/orane_logo.png'

                            ),

                        ),





                    array(

                            'id'       => 'orane-logo-image-alt',

                            'type'     => 'media',

                            'url'      => true,

                            'title'    => __('Alternate Logo', 'orane'),

                            'desc'     => __('Optional', 'orane'),

                            'subtitle' => __('Greyscale Logo Used in a few place in the theme (Optional)', 'orane'),

                            'default'  => array(

                                'url'  => get_template_directory_uri() . '/images/logo_blur.png'

                            ),

                        ),






                    array(

                        'id'       => 'orane-show-menu-search',
                        'type'     => 'checkbox',
                        'title'    => __('Show Search icon in the menu?', 'orane'), 
                        'default'  => '1'

                    ),



                    array(
                            'id'       => 'orane-favicon-image',
                            'type'     => 'media',
                            'width'    => '16px',
                            'height'   => '16px',
                            'url'      => true,
                            'title'    => __('Favicon Icon', 'orane'),
                            'desc'     => __('Image will be scaled to 16 x 16', 'orane'),
                            'subtitle' => __('Upload A PNG Image For The Site Favicon', 'orane'),
                            'default'  => array(
                                            'url'  => get_template_directory_uri() . '/images/favicon.png'
                                        ),

                        ),




                        array(
                            'id'        => 'orane-opt-layout',
                            'type'      => 'image_select',
                            'compiler'  => true,
                            'title'     => __('Sidebar Options', 'orane'),
                            'subtitle'  => __('Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.', 'orane'),
                            'options'   => array(
                                                    '1' => array('alt' => '1 Column',       'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
                                                    '2' => array('alt' => '2 Column Left',  'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
                                                    '3' => array('alt' => '2 Column Right', 'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
                                                ),
                                                'default'   => '3'
                        ),



                        array(

                            'id'        => 'orane-box-full',

                            'type'      => 'image_select',

                            'compiler'  => true,

                            'title'     => __('Site Layout', 'orane'),

                            'subtitle'  => __('Choose the boxed or full-width layout for your theme', 'orane'),

                            'options'   => array(

                                '1' => array('alt' => 'Full Width',       'img' => get_template_directory_uri() . '/images/full.png'),

                                '2' => array('alt' => 'Boxed',            'img' => get_template_directory_uri() . '/images/boxed.png'),

                                

                            ),

                            'default'   => '1'

                        ),









                    array(

                        'id'       => 'orane-bg-pattern-show',

                        'type'     => 'checkbox',

                        'title'    => __('Show Background Pattern?', 'orane'), 

                        'subtitle' => __('Show Background Pattern in Boxed Layout?', 'orane'),

                        'default'  => '1'

                    ),







                        array(

                            'id'        => 'orane-bg-pattern',
                            'type'      => 'image_select',
                            'compiler'  => true,
                            'title'     => __('Theme Background Pattern', 'orane'),
                            'subtitle'  => __('Choose the background pattern for theme.', 'orane'),
                            'options'   => array(

                                'pattern-1' => array('alt' => '1',       'img' => get_template_directory_uri() . '/images/pattern/resize/1.png'),
                                'pattern-2' => array('alt' => '2',       'img' => get_template_directory_uri() . '/images/pattern/resize/2.png'),
                                'pattern-3' => array('alt' => '3',       'img' => get_template_directory_uri() . '/images/pattern/resize/3.png'),
                                // '4' => array('alt' => '4',       'img' => get_template_directory_uri() . '/images/pattern/4.png'),
                                'pattern-5' => array('alt' => '5',       'img' => get_template_directory_uri() . '/images/pattern/resize/5.png'),
                                'pattern-6' => array('alt' => '6',       'img' => get_template_directory_uri() . '/images/pattern/resize/6.png'),
                                'pattern-7' => array('alt' => '7',       'img' => get_template_directory_uri() . '/images/pattern/resize/7.png'),
                                'pattern-8' => array('alt' => '8',       'img' => get_template_directory_uri() . '/images/pattern/resize/8.png'),
                                // '9' => array('alt' => '9',       'img' => get_template_directory_uri() . '/images/pattern/9.png'),
                                'pattern-10' => array('alt' => '10',     'img' => get_template_directory_uri() . '/images/pattern/resize/10.png'),
                                

                            ),

                            'default'   => 'pattern-1'

                        ),











                    array(

                        'id'        => 'orane-theme-bg-color',

                        'type'      => 'color',

                        'title'     => __('Theme Background Color', 'orane'),

                        'subtitle'  => __('Theme Background Color, works for boxed layout.', 'orane'),

                        'default'  => '#FFFFFF',

                        'compiler'  => array(

                                                'body',

                                            ),

                        'validate' => 'color',

                        'transparent'   => false,

                        'mode'      => 'background-color',

                    ),























                    array(

                        'id'        => 'orane-editor-css',

                        'type'      => 'ace_editor',

                        'title'     => __('CSS Code', 'orane'),

                        'subtitle'  => __('Paste your CSS code here.', 'orane'),

                        'mode'      => 'css',

                        'theme'     => 'monokai',

                        'desc'      => 'Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.',

                        'default'   => "#header{\nmargin: 0 auto;\n}",

                        'validate' => 'css',

                    ),

                    array(

                        'id'        => 'orane-editor-js',

                        'type'      => 'ace_editor',

                        'title'     => __('JS Code', 'orane'),

                        'subtitle'  => __('Paste your JS code here.', 'orane'),

                        'mode'      => 'javascript',

                        'theme'     => 'chrome',

                        'desc'      => 'Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.',

                        'default'   => "",

                        'validate' => 'js',

                    ),

                )

            );





            $this->sections[] = array(

                'icon'      => 'el-icon-website',

                'title'     => __('Styling Options', 'orane'),

                'submenu' => false,

                'fields'    => array(

                    array(

                        'id'                => 'orane-select-stylesheet',

                        'type'              => 'select',

                        'customizer'        => false,

                        'title'             => __('Skin', 'orane'),

                        'subtitle'          => __('Select your color scheme.', 'orane'),

                        'options'           => array(

                                                 

                                                'darkorange.css'    => 'Dark Orange', 

                                                'darkblue.css'      => 'Dark Blue',

                                                'darkcyan.css'     => 'Dark Cyan',

                                                'lightcyan.css'     => 'Light Cyan',

                                                'orange.css'        => 'Orange',

                                                'pink.css'          => 'Pink',

                                                'tangerine.css'     => 'Tangerine',

                                                'red.css'           => 'Red',

                                                ),

                        'default'   => 'darkorange.css',

                        

                    ),







                    array(

                        'id'        => 'orane-color-scheme',

                        'type'      => 'color',

                        'title'     => __('Theme Font Color Scheme', 'orane'),

                        'subtitle'  => __('Theme Fonts Alternate Colors', 'orane'),

                        'default'  => '#0DAC9E',

                        'compiler'  => array(

                                                '.post-1 .author-name',

                                                '.topbar-shopping-cart:hover',

                                                '.a-t-2 .panel-heading i',

                                                '.member-intro .member-social-links a',

                                                '.color',

                                                '.macs .right-ul i',

                                                '.macs .left-ul i',

                                                '.seo-2 .btn-1',

                                                '.latest-blog-excerpt a',

                                                '.latest-blog-comment',

                                                '.testi-position',

                                                '.orane-sidebar ul li a:hover',

                                                '.social-icons a:hover',

                                                'footer .post-title .title:hover',

                                                '.blog-read-more:hover',

                                                'a:hover, a:focus',

                                                '.service:hover .service-head',

                                                '.service:hover .icon i',

                                                'ul.products li.product > a h3',

                                                '.woocommerce #content div.product p.price, .woocommerce #content div.product span.price, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce-page #content div.product p.price, .woocommerce-page #content div.product span.price, .woocommerce-page div.product p.price, .woocommerce-page div.product span.price',

                                                '.woocommerce .woocommerce-breadcrumb a, .woocommerce-page .woocommerce-breadcrumb a',

                                                '.bbp-breadcrumb a',

                                               

                                                '.paging-navigation ul li span',

                                                '.wpb_toggle, #content h4.wpb_toggle',

                                                '.post-1 .author-name, .color, .macs .right-ul i, .macs .left-ul i, .seo-2 .btn-1, .latest-blog-excerpt a, .latest-blog-comment, .testi-position, .orane-sidebar ul li a:hover,  .social-icons a:hover, footer .post-title .title:hover, .blog-read-more:hover, a:hover, a:focus, .service:hover .service-head, .service:hover .icon i',

                                                '.woocommerce-account .addresses .title .edit',

                                                '.planprice',

                                                '.tour:hover',

                                                '.advantages li i'

                                            ),

                        'validate' => 'color',

                        'transparent'   => false,

                        'mode'      => 'color',

                    ),











                    array(

                        'id'        => 'orane-bgcolor-scheme',

                        'type'      => 'color',

                        'title'     => __('Theme Background Color Scheme', 'orane'),

                        'subtitle'  => __('Theme Background Colors', 'orane'),

                        'default'  => '#0DAC9E',

                        'compiler'  => array(

                                                '.hero-section',

                                                '.team .member-intro',

                                                '.work',

                                                '.social-bar',

                                                '.searchform input[type="submit"]',

                                                '#commentform #submit',

                                                '.blogDetails td:hover',  

                                                '.tagcloud a:hover',

                                                '.question',

                                                '.tp-caption.mediumbgcolor, .mediumbgcolor',

                                                '.numbers',

                                                '.progress .progress-bar-warning',

                                                '.lists .list-group-item.active, .list-group-item.active:hover, .list-group-item.active:focus',

                                                '.seo .btn-1:hover',

                                                'ul.products li.product .add_to_cart_button', 

                                                '.woocommerce #content div.product form.cart .button, .woocommerce div.product form.cart .button, .woocommerce-page #content div.product form.cart .button, .woocommerce-page div.product form.cart .button',

                                                '.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active',

                                                '.woocommerce #content input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page #content input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button,  .woocommerce-page input.button.alt',

                                                '.woocommerce #content nav.woocommerce-pagination ul li a:focus, .woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li a:focus, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li span.current, .woocommerce-page nav.woocommerce-pagination ul li a:focus, .woocommerce-page nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li span.current',

                                                '.requestq li a',

                                                '.tr-btn:hover',

                                                '#bbpress-forums li.bbp-header',

                                                '.top-bar .top-socials li:hover',

                                                '.woocommerce .woocommerce-message::before, .woocommerce-page .woocommerce-message::before',

                                                '.paging-navigation ul li span',


                                            ),

                        'validate' => 'color',

                        'transparent'   => false,

                        'mode'      => 'background-color',

                    ),



                    array(

                        'id'        => 'orane-bgcolor-button',

                        'type'      => 'color',

                        'title'     => __('Buttons Color Scheme', 'orane'),

                        'subtitle'  => __('Buttons Colors', 'orane'),

                        'default'  => '#0DAC9E',

                        'compiler'  => array(

                                                

                                                'ul.products li.product .add_to_cart_button',

                                                '.subscribe .sub-btn, .subscribe input[type="submit"]',

                                                '.searchform input[type="submit"]',

                                                '#commentform #submit',

                                                '#searchsubmit',

                                                '.tagcloud a',

                                                '.seo .btn-1',

                                                'ul.products li.product .add_to_cart_button', 

                                                '.woocommerce #content div.product form.cart .button, .woocommerce div.product form.cart .button, .woocommerce-page #content div.product form.cart .button, .woocommerce-page div.product form.cart .button',

                                                '.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active',

                                                '.woocommerce #content input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page #content input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button,  .woocommerce-page input.button.alt',

                                                '.woocommerce #content nav.woocommerce-pagination ul li a:focus, .woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li a:focus, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li span.current, .woocommerce-page nav.woocommerce-pagination ul li a:focus, .woocommerce-page nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li span.current',

                                                '.wpcf7-submit',

                                                '#bbp_reply_submit, #bbp_topic_submit', 

                                                '#buddypress .comment-reply-link, #buddypress a.button, #buddypress button, #buddypress div.generic-button a, #buddypress input[type="button"], #buddypress input[type="reset"], #buddypress input[type="submit"], #buddypress ul.button-nav li a, a.bp-title-button',

                                                '.woocommerce #content input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce-page #content input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt',

                                                '.subscribe .sub-btn, .subscribe input[type="submit"]',


                                            ),

                        'validate' => 'color',

                        'transparent'   => false,

                        'mode'      => 'background-color',

                    ),



                    array(

                        'id'        => 'orane-bgcolor-button-hover',

                        'type'      => 'color',

                        'title'     => __('Buttons Hover Color Scheme', 'orane'),

                        'subtitle'  => __('Buttons Hover Colors', 'orane'),

                        'default'   => '#0DAC9E',

                        'compiler'  => array(

                                                'ul.products li.product .add_to_cart_button:hover',

                                                '.searchform input[type="submit"]:hover',

                                                '#commentform #submit:hover',

                                                '#searchsubmit:hover',

                                                '.tagcloud a:hover',

                                                '.seo .btn-1:hover',

                                                'ul.products li.product .add_to_cart_button:hover', 

                                                '.woocommerce #content div.product form.cart .button:hover, .woocommerce div.product form.cart .button:hover, .woocommerce-page #content div.product form.cart .button:hover, .woocommerce-page div.product form.cart .button:hover',

                                                '.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active',

                                                '.woocommerce #content input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce-page #content input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover,  .woocommerce-page input.button.alt:hover',

                                                '.woocommerce #content nav.woocommerce-pagination ul li a:focus, .woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li a:focus, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li span.current, .woocommerce-page nav.woocommerce-pagination ul li a:focus, .woocommerce-page nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li span.current:hover',

                                                '.wpcf7-submit:hover',

                                                '#bbp_reply_submit:hover, #bbp_topic_submit:hover',

                                            ),

                        'validate' => 'color',

                        'transparent'   => false,

                        'mode'      => 'background-color',

                    ),



                    array(

                        'id'        => 'orane-menu-style',
                        'type'      => 'color_rgba',
                        'title'     => __('Main Menu Background Color', 'orane'),
                        'subtitle'  => __('Main Menu Background Color', 'orane'),
                        'default'   => array('color' => '#ffffff', 'alpha' => '0.55'),
                        'compiler'  => array('.navbar-default', '.is-sticky .navbar-default'),
                        'mode'      => 'background',
                        'validate'  => 'colorrgba',
                        'transparent'   => true

                    ),

                    //

                    array(

                        'id'        => 'orane-menu-dropdown-style',
                        'type'      => 'color_rgba',
                        'title'     => __('Main Menu Dropdown Background Color', 'orane'),
                        'subtitle'  => __('Main Menu Dropdown Background Color', 'orane'),
                        'default'   => array('color' => '#ffffff', 'alpha' => '0.9'),
                        'compiler'  => array('.dropdown-menu', '.navbar-nav > li > .dropdown-menu'),
                        'mode'      => 'background',
                        'validate'  => 'colorrgba',
                        'transparent'   => true

                    ),



                    array(

                        'id'        => 'orane-menu-current',

                        'type'      => 'color',

                        'title'     => __('Current Element Border', 'orane'),

                        'subtitle'  => __('Main Menu Current Element Border Color', 'orane'),

                        'default'   => '#0DAC9E',

                        'compiler'  => array('.navbar-default .navbar-nav > li:hover > a', '.navbar-default .navbar-nav > li.current-menu-item > a'),

                        'mode'      => 'border-bottom-color',

                        'validate'  => 'colorrgba',

                        'transparent'   => false

                    ),



                    array(

                        'id'        => 'orane-icon-borders',

                        'type'      => 'color',

                        'title'     => __('Icons Borders Color', 'orane'),

                        'subtitle'  => __('The border around icons and form fields when selected.', 'orane'),

                        'default'   => '#0DAC9E',

                        'compiler'  => array(

                                                '.macs .right-ul i', 

                                                '.macs .left-ul i', 

                                                '.blog-read-more:hover',

                                                '.wpcf7-form-control[type="text"]:focus',

                                                '.wpcf7-form-control[type="email"]:focus',

                                                'textarea.wpcf7-form-control:focus',

                                                '#0dac9e',

                                                '#bbpress-forums ul.bbp-lead-topic, #bbpress-forums ul.bbp-topics, #bbpress-forums ul.bbp-forums, #bbpress-forums ul.bbp-replies, #bbpress-forums ul.bbp-search-results',

                                                '.woocommerce .woocommerce-message, .woocommerce-page .woocommerce-message',

                                                'ul.advantages li a',
                                                

                                                ),

                        'mode'      => 'border-color',

                        'validate'  => 'colorrgba',

                        'transparent'   => false

                    ),







                    array(

                        'id'        => 'orane-adv-page-bgcolor',

                        'type'      => 'color',

                        'title'     => __('Advanced Page Background Color', 'orane'),

                        'subtitle'  => __('"Advanced" Page Template Background Color', 'orane'),

                        'default'  => '#FFFFFF',

                        'compiler'  => array('.page-template-advanced-php', '.contact'),

                        'validate' => 'color',

                        'transparent'   => false,

                        'mode'      => 'background-color',

                    ),








                    array(

                        'id'        => 'orane-page-heading-style',

                        'type'      => 'typography',

                        'title'     => __('Page Heading Styles', 'orane'),

                        'compiler'  => array(
                                                '.blog .page-heading h1',
                                                '.services h2',
                                                '.specialities h2',
                                                '.seo h2',
                                                '.seo-2 h2',
                                                '.features h1',
                                                '.top-support h2',
                                                '.about h1',
                                                '.partners h2',
                                                '.tag-heading h1',
                                                '.construction-page h1',
                                        ),

                        'subtitle'  => __('Page Headings Styles.', 'orane'),


                        'default'   => array(

                            'color'         => '#333333',

                            'font-size'     => '55px',

                            'font-family'   => 'Oswald',

                            'font-weight'   => '500'

                        ),

                    ),

                    array(

                        'id'        => 'orane-blog-title-style',

                        'type'      => 'typography',

                        'title'     => __('Sections Title Styles', 'orane'),

                        'compiler'  => array('.blog h1'),

                        'subtitle'  => __('Sections Title Styles.', 'orane'),

                        'default'   => array(

                            'color'         => '#646464',

                            'font-size'     => '35px',

                            'font-family'   => 'Oswald',

                            'font-weight'   => '500',

                        ),

                    ),



                    array(

                        'id'        => 'orane-links-color',

                        'type'      => 'link_color',

                        'title'     => __('Links Color Option', 'orane'),

                        'subtitle'  => __('Links Colors in different states', 'orane'),

                        'compiler'  => array('a'),

                        //'regular'   => false, // Disable Regular Color

                        //'hover'     => false, // Disable Hover Color

                        //'active'    => false, // Disable Active Color

                        //'visited'   => true,  // Enable Visited Color

                        'default'   => array(

                            'regular'   => '#000',

                            'hover'     => '#0DAC9E',

                            'active'    => '#0DAC9E',

                        )

                    ),



                    array(

                        'id'        => 'orane-typography-body',
                        'type'      => 'typography',
                        'title'     => __('Body Text Font', 'orane'),
                        'subtitle'  => __('Specify the body font properties.', 'orane'),
                        'compiler'  => array('.answers', '.blog .post-1 p', 'p'),
                        'default'   => array(
                            'color'         => '#333333',
                            'font-size'     => '14px',
                            'font-family'   => 'Lato',
                            'font-weight'   => 'Normal',
                            'line-height'   => '22px',
                        ),
                    ),



                    array(

                        'id'        => 'orane-typography-main-menu',
                        'type'      => 'typography',
                        'color'     => false,
                        'title'     => __('Main Menu Text Font', 'orane'),
                        'subtitle'  => __('Specify The Main Menu Font Properties.', 'orane'),
                        'compiler'  => array('.navbar-nav  li  a', '.navbar-default .navbar-nav > li > a'),
                        'default'   => array(
                            'color'         => '#333333',
                            'font-size'     => '14px',
                            'font-family'   => 'Lato',
                            'font-weight'   => 'Normal',
                            'line-height'   => '22px',
                        ),
                    ),



                    array(

                        'id'        => 'orane-menu-color',
                        'type'      => 'link_color',
                        'title'     => __('Main Menu Color Options', 'orane'),
                        'subtitle'  => __('Main Menu Links Colors in different states', 'orane'),
                        'compiler'  => array('.navbar-nav  li  a', '.navbar-default .navbar-nav > li > a'),
                        'default'   => array(
                                                'regular'   => '#333',
                                                'hover'     => '#0DAC9E',
                                                'active'    => '#0DAC9E',
                                            )

                    ),




                    array(

                        'id'        => 'orane-vc-typography-para',
                        'type'      => 'typography',
                        'color'     => false,
                        'title'     => __('Visual Composer Elements Text Font', 'orane'),
                        'subtitle'  => __('Font For Visual Composer Elements', 'orane'),
                        'compiler'  => array('.hero-section p', '.services .service-right p', '.ideas p', '.seo p', '.seo-2 p', '.services p', '.welcome p', '.tag-heading p', '.work p', '.macs p', '.top-support p', '.top-support .support-points', '.features p', '.latest-blog-excerpt', '.qt p', '.subscribe-details p', '.partners p', '.planbg li', '.advantages p', '.popup-text p', '.construction-page p'),
                        'default'   => array(
                            'color'         => '#333333',
                            'font-size'     => '14px',
                            'font-family'   => 'Lato',
                            'font-weight'   => 'Normal',
                            'line-height'   => '22px',
                        ),
                    ),




                    array(

                        'id'        => 'orane-footer-title',

                        'type'      => 'typography',

                        'title'     => __('Footer Titles Font', 'orane'),

                        'compiler'  => array('footer h2'),

                        'subtitle'  => __('Footer Titles Font Settings', 'orane'),

                        'line-height' => false,



                        'default'   => array(

                            'color'         => '#ffffff',

                            'font-size'     => '25px',

                            'font-family'   => 'Oswald',

                            'font-weight'   => '500',



                        ),

                    ),






                )

            );


            //loading screen settings
            $this->sections[] = array(

                'icon'      => 'el-icon-repeat-alt',
                'submenu'   => false,
                'title'     => __('Loading Screen', 'orane'),
                'desc'      => __('<p class="description">Settings For The Loading Screen</p>', 'orane'),
                'fields'    => array(
                                            array(

                                                'id'       => 'orane-show-progressbar',
                                                'type'     => 'checkbox',
                                                'title'    => __('Show Loading Screen?', 'orane'), 
                                                'subtitle' => __('Show Progress bar when loading pages?', 'orane'),
                                                'default'  => '0'
                                            ),

                                            array(
                                                'id'       => 'orane-show-loading-logo',
                                                'type'     => 'checkbox',
                                                'title'    => __('Show Logo in Loading Screen', 'orane'), 
                                                'subtitle' => __('Show Logo in Loading Screen', 'orane'),
                                                'default'  => '1',
                                                'customizer'       => false,
                                            ),

                                            array(
                                                    'id'       => 'orane-loading-bgimage',
                                                    'type'     => 'media',
                                                    'url'      => true,
                                                    'title'    => __('Loading Screen Background Image', 'orane'),
                                                    'desc'     => __('Upload Any Image', 'orane'),
                                                    'subtitle' => __('Image in the loading screen background', 'orane'),
                                                    'default'  => array(
                                                        'url'  => get_template_directory_uri() . '/images/buildings.jpg'
                                                    ),
                                                ),



                                ),

             );




            //footer settings
            $this->sections[] = array(

                'icon'      => 'el-icon-inbox',
                'submenu'   => false,
                'title'     => __('Footer Settings', 'orane'),
                'desc'      => __('<p class="description">Settings for the theme footer</p>', 'orane'),
                'fields'    => array(
 

                                    array(
                                        'id'        => 'orane-footer-left',
                                        'type'      => 'editor',
                                        'title'     => __('Footer Text (Left)', 'orane'),
                                        'subtitle'  => __('You can use the following shortcodes in your footer text: [site-url] [theme-url] [login-url] [logout-url] [site-title] [site-tagline] [current-year].<br/><br/>You can use the link shortcodes, when you are creating a link in the editor, <a target="_blank" href="http://i.imgur.com/J1vXDKg.png">Screenshot</a>', 'orane'),
                                        'default'   => 'Powered by WordPress.',
                                    ),

                                    array(
                                        'id'        => 'orane-footer-right',
                                        'type'      => 'editor',
                                        'title'     => __('Footer Text (Right)', 'Orane'),
                                        'subtitle'  => __('You can use the following shortcodes in your footer text: [site-url] [theme-url] [login-url] [logout-url] [site-title] [site-tagline] [current-year].<br/><br/>You can use the link shortcodes, when you are creating a link in the editor, <a target="_blank" href="http://i.imgur.com/J1vXDKg.png">Screenshot</a>', 'orane'),
                                        'default'   => 'Copyrights &copy; WordPress.',
                                        'validate' => 'html',
                                    ),

                                    array(
                                        'id'                => 'orane-footer-columns',
                                        'type'              => 'select',
                                        'customizer'        => false,
                                        'title'             => __('Number Of Columns In The Footer Widget', 'orane'),
                                        'options'           => array(
                                                                    '4'    => '4', 
                                                                    '3'    => '3',
                                                                    '2'    => '2',
                                                                    '1'    => '1',
                                                                ),
                                        'default'   => '4',
                                    ),


                                    array(

                                            'id'       => 'orane-footer-bgimage',
                                            'type'     => 'media',
                                            'url'      => true,
                                            'title'    => __('Footer Background Image', 'orane'),
                                            'desc'     => __('Upload Any Image', 'orane'),
                                            'subtitle' => __('Image in the footer background', 'orane'),
                                            'default'  => array(
                                                'url'  => get_template_directory_uri() . '/images/1.jpg'
                                            ),

                                        ),


                                        array(
                                            'id'        => 'orane-footer-para',
                                            'type'      => 'typography',
                                            'title'     => __('Footer Regular Font Settings', 'orane'),
                                            'compiler'  => array('footer p', '.search-results footer p'),
                                            'subtitle'  => __('Footer Regular Font Settings', 'orane'),
                                            'line-height' => false,
                                            'default'   => array(
                                                                    'color'         => '#cccccc',
                                                                    'font-size'     => '13px',
                                                                    'font-family'   => 'Lato',
                                                                    'font-weight'   => 'normal',
                                                                ),

                                        ),

                                    array(
                                        'id'       => 'orane-footer-show',
                                        'type'     => 'checkbox',
                                        'title'    => __('Show Footer Bar', 'orane'), 
                                        'subtitle' => __('Show/Hide The Bottom Bar (below the footer).', 'orane'),
                                        'default'  => '1'
                                    ), 

                                        array(
                                            'id'        => 'orane-footer-bar-font',
                                            'type'      => 'typography',
                                            'title'     => __('Footer Bar Font', 'orane'),
                                            'compiler'  => array('.bottom-bar'),
                                            'subtitle'  => __('Footer Bar Font', 'orane'),
                                            'line-height' => false,
                                            'default'   => array(
                                                                    'color'         => '#fff',
                                                                    'font-size'     => '12px',
                                                                    'font-family'   => 'Oswald',
                                                                    'font-weight'   => 'normal',
                                                                ),

                                        ),



                                        array(
                                            'id'        => 'orane-bottom-bar-bgcolor',
                                            'type'      => 'color',
                                            'title'     => __('Bottom Bar Background Color', 'orane'),
                                            'subtitle'  => __('Bottom Bar Background Color', 'orane'),
                                            'default'   => '#191919',
                                            'compiler'  => array('.bottom-bar'),
                                            'mode'      => 'background-color',
                                            'validate'  => 'colorrgba',
                                            'transparent'   => false
                                        ),





                    ),

             );





            //social settings
            $this->sections[] = array(

                'icon'      => 'el-icon-group',

                'submenu' => false,

                'title'     => __('Social Settings', 'orane'),

                'heading'   => __('Social Settings', 'orane'),

                'fields'    => array(



                    array(

                        'id'       => 'orane-show-top-social',

                        'type'     => 'checkbox',

                        'title'    => __('Show Social Links On Top', 'orane'), 

                        'subtitle' => __('Show Social Links On Top Bar', 'orane'),

                        'default'  => '1',

                        'customizer'       => false,

                    ),



                    array(

                        'id'        => 'orane-social-fb',

                        'type'      => 'text',

                        'title'     => __('Facebook Link', 'orane'),

                        'subtitle'  => __('This must be a URL (Link).', 'orane'),

                        'default'   => 'http://facebook.com/getredhawkstudio',

                        'validate' => 'url',

                        'customizer'       => false,

                    ),



                    array(

                        'id'        => 'orane-social-tw',

                        'type'      => 'text',

                        'title'     => __('Twitter Link', 'orane'),

                        'subtitle'  => __('This must be a URL (Link).', 'orane'),

                        'default'   => 'http://twitter.com/getredhawkstudio',

                        'validate' => 'url',

                        'customizer'       => false,

                    ),



                    array(

                        'id'        => 'orane-social-gp',

                        'type'      => 'text',

                        'title'     => __('Google Plus Link', 'orane'),

                        'subtitle'  => __('This must be a URL (Link).', 'orane'),

                        'default'   => '',

                        'validate' => 'url',

                        'customizer'       => false,

                    ),



                    array(

                        'id'        => 'orane-social-yt',

                        'type'      => 'text',

                        'title'     => __('Youtube Link', 'orane'),

                        'subtitle'  => __('This must be a URL (Link).', 'orane'),

                        'default'   => '',

                        'validate' => 'url',

                        'customizer'       => false,

                    ),



                    array(

                        'id'        => 'orane-social-li',

                        'type'      => 'text',

                        'title'     => __('Linked-in Link', 'orane'),

                        'subtitle'  => __('This must be a URL (Link).', 'orane'),

                        'default'   => '',

                        'validate' => 'url',

                        'customizer'       => false,

                    ),



                    array(

                        'id'        => 'orane-social-dr',

                        'type'      => 'text',

                        'title'     => __('Dribbble Link', 'orane'),

                        'subtitle'  => __('This must be a URL (Link).', 'orane'),

                        'default'   => '',

                        'validate' => 'url',

                        'customizer'       => false,

                    ),





                    array(

                        'id'        => 'orane-social-red',

                        'type'      => 'text',

                        'title'     => __('Reddit Link', 'orane'),

                        'subtitle'  => __('This must be a URL (Link).', 'orane'),

                        'default'   => '',

                        'validate' => 'url',

                        'customizer'       => false,

                    ),

                    array(

                        'id'        => 'orane-social-insta',
                        'type'      => 'text',
                        'title'     => __('Instagram Link', 'orane'),
                        'subtitle'  => __('This must be a URL (Link).', 'orane'),
                        'default'   => '',
                        'validate' => 'url',
                        'customizer'       => false,

                    ),

                    array(

                        'id'        => 'orane-social-pin',
                        'type'      => 'text',
                        'title'     => __('Pinterest Link', 'orane'),
                        'subtitle'  => __('This must be a URL (Link).', 'orane'),
                        'default'   => '',
                        'validate' => 'url',
                        'customizer'       => false,

                    ),



                    array(

                        'id'        => 'orane-social-skype',

                        'type'      => 'text',

                        'title'     => __('Skype ID', 'orane'),

                        'subtitle'  => __('', 'orane'),

                        'default'   => '',

                        'customizer'       => false,

                    ),







                )

            );





            //theme sections

            $this->sections[] = array(

                'icon'      => 'el-icon-universal-access',

                'submenu' => false,

                'title'     => __('Clients Section', 'orane'),

                'desc'      => __('<p class="description">Clients Section Above The Footer</p>', 'orane'),

       



                'fields'    => array(



                    array(

                        'id'        => 'orane-show-clients-section',

                        'type'      => 'checkbox',

                        'title'     => __('Show Clients Section', 'orane'),

                        'subtitle'  => __('Clients Section is above the footer area', 'orane'),

                        'default'   => '1'

                    ),


                    array(

                        'id'        => 'orane-show-clients-section-home',

                        'type'      => 'checkbox',

                        'title'     => __('Show Clients Section on Home Page', 'orane'),

                        'subtitle'  => __('Clients Section is above the footer area', 'orane'),

                        'default'   => '1'

                    ),



                    array(

                        'id'       => 'orane-clients-bgcolor',

                        'type'     => 'color',

                        'title'    => __('Clients Section Background Color', 'orane'), 

                        'subtitle' => __('Pick a background color for the Clients section.', 'orane'),

                        'default'  => '#F7F6F6',

                        'validate' => 'color',

                        'transparent' => false,

                        'compiler'      => array('.partners-2'),

                        'mode'      => 'background-color',

                    ),

                        

                    array(

                        'id'          => 'orane-clients-title-font',

                        'type'        => 'typography', 

                        'title'       => __('Clients Section Title', 'orane'),

                   

                        'font-backup' => true,

                        'compiler'      => array('.partners h2'),

                        'units'       =>'px',

                        'subtitle'    => __('Clients Section Title Font Settings.', 'orane'),

                        'line-height' => false,

                        'default'     => array(

                            'color'       => '#333', 

                            'font-weight'  => '500', 

                            'font-family' => 'Oswald', 

                           

                            'font-size'   => '55px', 

                        ),

                        'preview' => array(

                                        'text' => 'udnag remu',

                        ),

                    ),





                    array(

                        'id'          => 'orane-clients-text-font',

                        'type'        => 'typography', 

                        'title'       => __('Clients Section Text', 'orane'),

                      

                        'font-backup' => true,

                        'compiler'      => array('.partners p'),

                        'units'       =>'px',

                        'subtitle'    => __('Clients Section Text Settings.', 'orane'),

                        'text-align'  => false,

                        'subsets'     => false,  

                        

                        'default'     => array(

                            'color'       => '#656565', 

                            'font-weight'  => '500', 

                            'font-family' => 'Lato', 

                           

                            'font-size'   => '14px', 

                            'line-height' => '24px',

                        ),

                        'preview' => array(

                                        'text' => 'udnag ramaq',

                                    ),

                    ),





                    array(

                        'id'       => 'orane-clients-text-title',

                        'type'     => 'text',

                        'title'    => __('Clients Section Title', 'orane'),

                        'subtitle' => __('The title of the clients section', 'orane'),

                        'desc'             => __('You can use | around words to style them differently', 'orane'),

                        'default'  => 'Our |Clients|'

                    ),







                    array(

                        'id'               => 'orane-clients-text-body',

                        'type'             => 'editor',

                        'title'            => __('Clients Section Text', 'orane'), 

                        

                        'subtitle'         => __('Clients Section Details', 'orane'),

                        'default'          => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce scelerisque nibh et neque faucibus suscipit. Sed auctor ipsum ut tellus faucibus tincidunt.',

                        'args'   => array(

                            'teeny'            => true,

                            'textarea_rows'    => 10

                        )

                    ),







                    array(

                        'id'       => 'orane-clients-max-num',

                        'type'     => 'select',

                        'title'    => __('Max Clients Logo To Show', 'orane'), 

                        // Must provide key => value pairs for select options

                        'options'  => array(

                            '3' => '3',

                            '6' => '6',

                            '9' => '9',

                            '12' => '12',

                        ),

                        'default'  => '6',

                    ),









                ),    

            );







            $this->sections[] = array(

                'icon'      => 'el-icon-group',

                'submenu'   => false,

                

                'title'     => __('Social Section', 'orane'),

                'desc'      => __('<p class="description">Lets you customize the additional theme sections.</p>', 'orane'),

       



                'fields'    => array(



                    array(

                        'id'       => 'orane-show-bottom-social',

                        'type'     => 'checkbox',

                        'title'    => __('Show Social Section', 'orane'), 

                        'subtitle' => __('Shows Social Links above the footer area', 'orane'),

                        'default'  => '1',



                    ),



                    array(

                        'id'          => 'orane-social-bottom-font',

                        'type'        => 'typography', 

                        'title'       => __('Social Section Icons', 'orane'),

                       

                        'font-backup' => true,

                        'compiler'      => array('.social-icons a i'),

                        'font-family'   =>false,

                        'font-weight'   => false,

                        'font-style'    => false,

                        'text-align'    => false,

                        'line-height'    => false,

                        'units'       =>'px',

                        'default'     => array(

                            'color'       => '#0DAC9E',
                            'font-size'   => '30px', 

                        ),

                    ),





                    array(

                        'id'       => 'orane-social-bottom-txtcolor',

                        'type'     => 'color',

                        'title'    => __('Social Section Links Background Color', 'orane'), 

                        'subtitle' => __('Pick a Font background color for the Social Section.', 'orane'),

                        'default'  => '#ffffff',

                        'validate' => 'color',

                        'transparent' => true,

                        'compiler'      => array('.social-icons a'),

                        'mode'      => 'background-color',

                    ),





                    array(

                        'id'       => 'orane-social-bottom-iconhover',

                        'type'     => 'color',

                        'title'    => __('Social Section Links Hover Color', 'orane'), 

                        'subtitle' => __('Pick a Font color for the Social Section Icons on mouse hover.', 'orane'),

                        'default'  => '#0181C1',

                        'validate' => 'color',

                        'transparent' => false,

                        'compiler'      => array('.social-icons a:hover i'),

                        'mode'      => 'color',

                    ),





                )

            );

            

            $this->sections[] = array(

                'icon'      => ' el-icon-shopping-cart-sign',

                'submenu' => false,

                'title'     => __('Woocommerce', 'orane'),

                'desc'      => __('<p class="description">Styling and other settings for woocommerce pages</p>', 'orane'),

                'fields'    => array(

                    array(

                        'id'        => 'orane-woo-thumb-padding',

                        'type'      => 'checkbox',

                        'title'     => __('Enable thumbnail Padding?', 'orane'),

                        'subtitle'  => __('Show or hide the padding around the products thumbnails', 'orane'),

                        'default'   => '1'

                    ),



                    array(

                        'id'       => 'orane-woo-thumb-bgcolor',

                        'type'     => 'color',

                        'title'    => __('Thumbnails Background Color', 'orane'), 

                        'subtitle' => __('Pick a background color for the thumbnails.', 'orane'),

                        'default'  => '#ffffff',

                        'validate' => 'color',

                        'transparent' => true,

                        'compiler'      => array('.woocommerce ul.products li.product, .woocommerce-page ul.products li.product'),

                        'mode'      => 'background-color',

                        'transparent'   => false,

                    ),





                    array(

                        'id'       => 'orane-woo-shop-bgcolor',

                        'type'     => 'color',

                        'title'    => __('Shop Pages Background Color', 'orane'), 

                        'subtitle' => __('Pick a background color for the Shop Pages.', 'orane'),

                        'default'  => '#ffffff',

                        'validate' => 'color',

                        'transparent' => true,

                        'compiler'      => array('.shop-main'),

                        'mode'      => 'background-color',

                        'transparent'   => false,

                    ),



                    



                    array(

                        'id'       => 'orane-woo-stars-color',
                        'type'     => 'color',
                        'title'    => __('Rating Stars Color', 'orane'), 
                        'subtitle' => __('Pick a color for rating stars.', 'orane'),
                        'default'  => '#ffb027',
                        'validate' => 'color',
                        'transparent' => true,
                        'compiler'      => array('.star-rating span, .woocommerce p.stars a, .woocommerce-page p.stars a'),
                        'mode'      => 'color',
                        'transparent'   => false,

                    ),


                    // end of fields

                )

            );



            $theme_info  = '<div class="redux-framework-section-desc">';

            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'orane') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';

            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'orane') . $this->theme->get('Author') . '</p>';

            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'orane') . $this->theme->get('Version') . '</p>';

            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';

            $tabs = $this->theme->get('Tags');

            if (!empty($tabs)) {

                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', 'orane') . implode(', ', $tabs) . '</p>';

            }

            $theme_info .= '</div>';



            if (file_exists(dirname(__FILE__) . '/../README.md')) {

                $this->sections['theme_docs'] = array(

                    'icon'      => 'el-icon-list-alt',

                    'title'     => __('Documentation', 'orane'),

                    'fields'    => array(

                        array(

                            'id'        => '17',

                            'type'      => 'raw',

                            'markdown'  => true,

                            'content'   => file_get_contents(dirname(__FILE__) . '/../README.md')

                        ),

                    ),

                );

            }

            

            // You can append a new section at any time.

            $this->sections[] = array(

                'icon'      => 'el-icon-file-edit',

                'submenu' => false,

                'title'     => __('Blog Settings', 'orane'),

                'desc'      => __('<p class="description">Settings For Blog Pages</p>', 'orane'),

                'fields'    => array(

                    array(

                        'id'        => 'orane-blog-show-meta',

                        'type'      => 'checkbox',

                        'title'     => __('Show Post Meta values?', 'orane'),

                        'subtitle'  => __('Show or hide meta values below the post heading', 'orane'),

                        'default'   => '1'

                    ),



                    array(

                        'id'        => 'orane-blog-prev-next',

                        'type'      => 'checkbox',

                        'title'     => __('Show Prev/Next links?', 'orane'),

                        'subtitle'  => __('Show or hide the previous and next post links', 'orane'),

                        'default'   => '1'

                    ),



                    array(

                        'id'        => 'orane-home-images-show',

                        'type'      => 'checkbox',

                        'title'     => __('Show Blog Images', 'orane'),

                        'subtitle'  => __('Show Blog Posts Images', 'orane'),

                        'default'   => '1'

                    ),





                    array(

                        'id'       => 'orane-blog-page-bgcolor',

                        'type'     => 'color',

                        'title'    => __('Blog Pages Background Color', 'orane'), 

                        'subtitle' => __('Pick a background color for the Blog Pages.', 'orane'),

                        'default'  => '#ffffff',

                        'validate' => 'color',

                        'transparent' => true,

                        'compiler'      => array('.blog'),

                        'mode'      => 'background-color',

                        'transparent'   => false,

                    ),



                )//end of fields

            );









            // You can append a new section at any time.

            $this->sections[] = array(

                'icon'      => 'el-icon-minus',

                'submenu' => false,

                'title'     => __('Top Bar', 'orane'),

                'desc'      => __('<p class="description">Blank Fields wont show up in the top bar.</p>', 'orane'),

                'fields'    => array(


                    array(

                        'id'       => 'orane-header-show',

                        'type'     => 'checkbox',

                        'title'    => __('Show Top Bar', 'orane'), 

                        'subtitle' => __('Show/Hide The Top Bar.', 'orane'),

                        'default'  => '1'

                    ),




                    array(

                        'id'        => 'orane-topbar-show-cart',

                        'type'      => 'checkbox',

                        'title'     => __('Show Shopping Cart Link?', 'orane'),

                        'subtitle'  => __('Show or hide Shopping cart link in the top bar', 'orane'),

                        'default'   => '0'

                    ),


                    array(

                        'id'        => 'orane-top-bar-style',

                        'type'      => 'color',

                        'title'     => __('Top Bar Background Color', 'orane'),

                        'subtitle'  => __('Top Bar Background Color', 'orane'),

                        'default'  => '#FFFFFF',

                        'compiler'  => array('.top-bar'),

                        'validate' => 'color',

                        'transparent'   => false,

                        'mode'      => 'background-color',

                    ),



                    array(

                        'id'          => 'orane-topbar-font',

                        'type'        => 'typography', 

                        'title'       => __('Top Bar Icons', 'orane'),


                        'font-backup' => true,

                        'compiler'      => array('.top-bar i'),

                        'font-family'   =>false,

                        'font-weight'   => false,

                        'font-style'    => false,

                        'text-align'    => false,

                        'line-height'    => false,

                        'units'       =>'px',

                        'subtitle'    => __('The font awesome icons font', 'orane'),

                        'default'     => array(

                            'color'       => '#999',

                            'font-size'   => '15px', 

                            

                        ),

                    ),



                    // top bar text font (not the icons)
                    array(

                        'id'          => 'orane-topbar-text-font',
                        'type'        => 'typography', 
                        'title'       => __('Top Bar Text Font', 'orane'),
                        'font-backup' => true,
                        'compiler'      => array('.top-bar-text', '.top-bar-text a'),
                        'font-family'   =>false,
                        'font-weight'   => false,
                        'font-style'    => false,
                        'text-align'    => false,
                        'line-height'    => false,
                        'units'       =>'px',
                        'subtitle'    => __('The text beside the icons in the top bar', 'orane'),
                        'default'     => array(
                            'color'       => '#999',
                            'font-size'   => '15px', 
                        ),
                    ),


                    array(

                        'id'       => 'orane-topbar-email',
                        'type'     => 'text',
                        'title'    => __('Email Address', 'orane'),
                        'subtitle' => __('Email in the top bar', 'orane'),
                        'default'  => 'name@youremail.com'
                    ),



                    array(

                        'id'        => 'orane-topbar-phone',
                        'type'      => 'text',
                        'title'     => __('Phone Number', 'orane'),
                        'subtitle'  => __('Phone Number in the top bar', 'orane'),
                        'default'   => '+98 6545678765'

                    ),



                    array(

                        'id'        => 'orane-topbar-skype',
                        'type'      => 'text',
                        'title'     => __('Skype', 'orane'),
                        'subtitle'  => __('Skype Address in the top bar', 'orane'),
                        'default'   => 'gj-designs'
                    ),





                )//end of fields

            );




            $this->sections[] = array(

                'icon'      => 'el-icon-magic',
                'submenu'   => false,
                'title'     => __('Troubleshooting', 'orane'),
                'desc'      => __('<p class="description">A few settings for troubleshooting</p>', 'orane'),
                'fields'    => array(
                		                    array(
						                        'id'        => 'orane-css-compile',
						                        'type'      => 'checkbox',
						                        'title'     => __('Re-compile CSS?', 'orane'),
						                        'subtitle' => __('Get back the css after the theme update.', 'orane'),
						                        'desc'     => __('Just Switch the state of this checkbox and hit save to recover the css settings.', 'orane'),
						                        'default'   => '0',
						                        'compiler'  => true,
						                    ),

                				),

             );  	





            $this->sections[] = array(

                'title'     => __('Import / Export', 'orane'),

                'submenu' => false,

                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'orane'),

                'icon'      => 'el-icon-refresh',

                'fields'    => array(

                    array(

                        'id'            => 'opt-import-export',

                        'type'          => 'import_export',

                        'title'         => 'Import Export',

                        'subtitle'      => 'Save and restore your Redux options',

                        'full_width'    => false,

                    ),

                ),

            );                     


$this->sections[] = array(
                'id' => 'wbc_importer_section',
                'title'  => esc_html__( 'Demo Content', 'orane' ),
                'desc'   => esc_html__( 'Import your favorite demo content from here.', 'orane' ),
                'icon'   => 'el-icon-website',
                'fields' => array(
                                array(
                                    'id'   => 'wbc_demo_importer',
                                    'type' => 'wbc_importer'
                                    )
                            )
                );

                    

            $this->sections[] = array(

                'type' => 'divide',

            );



            $this->sections[] = array(

                'icon'      => 'el-icon-info-sign',

                'title'     => __('Theme Information', 'orane'),

                'submenu' => false,

                'desc'      => __('<p class="description">Orane - Evolutionary WordPress Theme</p>', 'orane'),

                'fields'    => array(

                    array(

                        'id'        => 'opt-raw-info',

                        'type'      => 'raw',

                        'content'   => $item_info,

                    )

                ),

            );



            if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {

                $tabs['docs'] = array(

                    'icon'      => 'el-icon-book',

                    'title'     => __('Documentation', 'orane'),

                    'content'   => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))

                );

            }

        }



        public function setHelpTabs() {



            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.

            $this->args['help_tabs'][] = array(

                'id'        => 'redux-help-tab-1',

                'title'     => __('Theme Information 1', 'orane'),

                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'orane')

            );



            $this->args['help_tabs'][] = array(

                'id'        => 'redux-help-tab-2',

                'title'     => __('Theme Information 2', 'orane'),

                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'orane')

            );



            // Set the help sidebar

            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'orane');

        }



        /**



          All the possible arguments for Redux.

          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments



         * */

        public function setArguments() {



            $theme = wp_get_theme(); // For use with some settings. Not necessary.



            $this->args = array(

                'opt_name' => 'redux_orane',

                'display_name' => 'Orane Theme Settings',

                'display_version' => false,

                'page_slug' => '_options',

                'page_title' => 'Orane Theme Options',

                'google_api_key' => 'AIzaSyCLRtfL2sZr51rerBnAnCcamuYPCPGS2jU',

                'update_notice' => true,

                'menu_icon' =>  'http://i.imgur.com/eluJ43E.png',

                'dev_mode'  => false,

                //'intro_text' => '<p>Orane Theme Settings Panel</p>',

                'footer_text' => '<p>Orane Theme Settings Panel</p>',

                'admin_bar' => true,

                'menu_type' => 'menu',

                'menu_title' => 'Orane Theme',

                'allow_sub_menu' => true,

                'page_parent_post_type' => 'your_post_type',

                'customizer' => true,

                'default_mark' => '*',

                'hints' => 

                array(

                  'icon' => 'el-icon-question-sign',

                  'icon_position' => 'right',

                  'icon_size' => 'normal',

                  'tip_style' => 

                  array(

                    'color' => 'light',

                  ),

                  'tip_position' => 

                  array(

                    'my' => 'top left',

                    'at' => 'bottom right',

                  ),

                  'tip_effect' => 

                  array(

                    'show' => 

                    array(

                      'duration' => '500',

                      'event' => 'mouseover',

                    ),

                    'hide' => 

                    array(

                      'duration' => '500',

                      'event' => 'mouseleave unfocus',

                    ),

                  ),

                ),

                'output' => true,

                'output_tag' => true,

                'compiler' => true,

                'page_icon' => 'icon-themes',

                'page_permissions' => 'manage_options',

                'save_defaults' => true,

                'show_import_export' => true,

                'transient_time' => '3600',

                'network_sites' => true,

              );



            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.

            $this->args['share_icons'][] = array(

                'url'   => 'https://github.com/ReduxFramework/ReduxFramework',

                'title' => 'Visit us on GitHub',

                'icon'  => 'el-icon-github'

                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.

            );

            $this->args['share_icons'][] = array(

                'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',

                'title' => 'Like us on Facebook',

                'icon'  => 'el-icon-facebook'

            );

            $this->args['share_icons'][] = array(

                'url'   => 'http://twitter.com/reduxframework',

                'title' => 'Follow us on Twitter',

                'icon'  => 'el-icon-twitter'

            );

            $this->args['share_icons'][] = array(

                'url'   => 'http://www.linkedin.com/company/redux-framework',

                'title' => 'Find us on LinkedIn',

                'icon'  => 'el-icon-linkedin'

            );



        }



    }

    

    global $reduxConfig;

    $reduxConfig = new Orane_Redux_Framework_config();

}



/**

  Custom function for the callback referenced above

 */

if (!function_exists('admin_folder_my_custom_field')):

    function admin_folder_my_custom_field($field, $value) {

        print_r($field);

        echo '<br/>';

        print_r($value);

    }

endif;



/**

  Custom function for the callback validation referenced above

 * */

if (!function_exists('admin_folder_validate_callback_function')):

    function admin_folder_validate_callback_function($field, $value, $existing_value) {

        $error = false;

        $value = 'just testing';



        /*

          do your validation



          if(something) {

            $value = $value;

          } elseif(something else) {

            $error = true;

            $value = $existing_value;

            $field['msg'] = 'your custom error message';

          }

         */



        $return['value'] = $value;

        if ($error == true) {

            $return['error'] = $field;

        }

        return $return;

    }

endif;

//////////////////////////////////redux save callback
add_action ('redux/options/redux_orane/saved', 'orane_redux_save', 10, 2);

function orane_redux_save($data, $changed){

        global $redux_orane;

        //the key to the stylessheet switcher
        $key = "orane-select-stylesheet";
        $new = "";

        if (array_key_exists($key, $changed)) {
            $new = $redux_orane['orane-select-stylesheet'];
        }

        if($new == ""){
            return;
        }

        //change the fields dynamically
        global $reduxConfig;

        if($new == "darkorange.css"){

            $reduxConfig->ReduxFramework->set('orane-color-scheme', '#D86838');
            $reduxConfig->ReduxFramework->set('orane-bgcolor-scheme', '#D86838');
            $reduxConfig->ReduxFramework->set('orane-bgcolor-button', '#D86838');
            $reduxConfig->ReduxFramework->set('orane-bgcolor-button-hover', '#4F4F4F');
            $reduxConfig->ReduxFramework->set('orane-menu-current', '#D86838');
            $reduxConfig->ReduxFramework->set('orane-icon-borders', '#D86838');
            $reduxConfig->ReduxFramework->set('orane-top-bar-style', '#ffffff');

        }elseif($new == "darkcyan.css"){

            $reduxConfig->ReduxFramework->set('orane-color-scheme', '#2DB4A8');
            $reduxConfig->ReduxFramework->set('orane-bgcolor-scheme', '#2DB4A8');
            $reduxConfig->ReduxFramework->set('orane-bgcolor-button', '#2DB4A8');
            $reduxConfig->ReduxFramework->set('orane-bgcolor-button-hover', '#4F4F4F');
            $reduxConfig->ReduxFramework->set('orane-menu-current', '#2DB4A8');
            $reduxConfig->ReduxFramework->set('orane-icon-borders', '#2DB4A8');
            $reduxConfig->ReduxFramework->set('orane-top-bar-style', '#ffffff');


        }elseif($new == "darkblue.css"){

            $reduxConfig->ReduxFramework->set('orane-color-scheme', '#198DC7');
            $reduxConfig->ReduxFramework->set('orane-bgcolor-scheme', '#198DC7');
            $reduxConfig->ReduxFramework->set('orane-bgcolor-button', '#198DC7');
            $reduxConfig->ReduxFramework->set('orane-bgcolor-button-hover', '#4F4F4F');
            $reduxConfig->ReduxFramework->set('orane-menu-current', '#198DC7');
            $reduxConfig->ReduxFramework->set('orane-icon-borders', '#198DC7');
            $reduxConfig->ReduxFramework->set('orane-top-bar-style', '#ffffff');

        }elseif($new == "lightcyan.css"){

            $reduxConfig->ReduxFramework->set('orane-color-scheme', '#5BBFC5');
            $reduxConfig->ReduxFramework->set('orane-bgcolor-scheme', '#5BBFC5');
            $reduxConfig->ReduxFramework->set('orane-bgcolor-button', '#5BBFC5');
            $reduxConfig->ReduxFramework->set('orane-bgcolor-button-hover', '#4F4F4F');
            $reduxConfig->ReduxFramework->set('orane-menu-current', '#5BBFC5');
            $reduxConfig->ReduxFramework->set('orane-icon-borders', '#5BBFC5');
            $reduxConfig->ReduxFramework->set('orane-top-bar-style', '#ffffff');

        }elseif($new == "orange.css"){

            $reduxConfig->ReduxFramework->set('orane-color-scheme', '#FF8833');
            $reduxConfig->ReduxFramework->set('orane-bgcolor-scheme', '#FF8833');
            $reduxConfig->ReduxFramework->set('orane-bgcolor-button', '#FF8833');
            $reduxConfig->ReduxFramework->set('orane-bgcolor-button-hover', '#4F4F4F');
            $reduxConfig->ReduxFramework->set('orane-menu-current', '#FF8833');
            $reduxConfig->ReduxFramework->set('orane-icon-borders', '#FF8833');
            $reduxConfig->ReduxFramework->set('orane-top-bar-style', '#ffffff');

        }elseif($new == "pink.css"){

            $reduxConfig->ReduxFramework->set('orane-color-scheme', '#D7509C');
            $reduxConfig->ReduxFramework->set('orane-bgcolor-scheme', '#D7509C');
            $reduxConfig->ReduxFramework->set('orane-bgcolor-button', '#D7509C');
            $reduxConfig->ReduxFramework->set('orane-bgcolor-button-hover', '#4F4F4F');
            $reduxConfig->ReduxFramework->set('orane-menu-current', '#D7509C');
            $reduxConfig->ReduxFramework->set('orane-icon-borders', '#D7509C');
            $reduxConfig->ReduxFramework->set('orane-top-bar-style', '#ffffff');

        }elseif($new == "tangerine.css"){

            $reduxConfig->ReduxFramework->set('orane-color-scheme', '#E2492F');
            $reduxConfig->ReduxFramework->set('orane-bgcolor-scheme', '#E2492F');
            $reduxConfig->ReduxFramework->set('orane-bgcolor-button', '#E2492F');
            $reduxConfig->ReduxFramework->set('orane-bgcolor-button-hover', '#4F4F4F');
            $reduxConfig->ReduxFramework->set('orane-menu-current', '#E2492F');
            $reduxConfig->ReduxFramework->set('orane-icon-borders', '#E2492F');
            $reduxConfig->ReduxFramework->set('orane-top-bar-style', '#ffffff');

        }elseif($new == "red.css"){

            $reduxConfig->ReduxFramework->set('orane-color-scheme', '#EE3535');
            $reduxConfig->ReduxFramework->set('orane-bgcolor-scheme', '#EE3535');
            $reduxConfig->ReduxFramework->set('orane-bgcolor-button', '#EE3535');
            $reduxConfig->ReduxFramework->set('orane-bgcolor-button-hover', '#4F4F4F');
            $reduxConfig->ReduxFramework->set('orane-menu-current', '#EE3535');
            $reduxConfig->ReduxFramework->set('orane-icon-borders', '#EE3535');
            $reduxConfig->ReduxFramework->set('orane-top-bar-style', '#ffffff');

        }
  

}


//append custom css for redux admin
function orane_admin_css() {

    wp_register_style(
	        'redux-admin-css',
	        get_template_directory_uri() . "/css/redux_overrules.css",
	        array( 'redux-css' ), // Be sure to include redux-css so it's appended after the core css is applied
	        time(),
	        'all'
    ); 

    wp_enqueue_style('redux-admin-css');

}

// This example assumes your opt_name is set to redux_demo, replace with your opt_name value

add_action( 'redux/page/redux_orane/enqueue', 'orane_admin_css' );