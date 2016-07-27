<?php  
// Plain Hero, no images and stuff
class Wish_Parallax {

        var $shortcode = 'wish_parallax';
        var $title = "Parallax Banner";
        var $details = "Parallax Banner With Text and a link";
        //var $path = "/templates/rating_hero.php";

    function __construct() {
        // We safely integrate with VC with this hook
        add_action( 'init', array( $this, 'integrateWithVC' ) );
 
        // Use this when creating a shortcode addon
        add_shortcode( $this->shortcode, array( $this, 'renderShortcode' ) );

        // Register CSS and JS
        //add_action( 'wp_enqueue_scripts', array( $this, 'loadCssAndJs' ) );
    }
 
    public function integrateWithVC() {
        // Check if Visual Composer is installed
        if ( ! defined( 'WPB_VC_VERSION' ) ) {
            // Display notice that Visual Compser is required
            add_action('admin_notices', array( $this, 'showVcVersionNotice' ));
            return;
        }
 
        vc_map( array(
            "name" => __($this->title, 'wish'),
            "description" => __($this->details, 'wish'),
            "base" => $this->shortcode,
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/13-161-document.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Wish Components', 'wish'),
            //'admin_enqueue_js' => array(plugins_url('admin_assets/hero_star.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
                                        // fields for tab 1
                                        array(
                                            "type" => "textfield",
                                            "heading" => __("Title", "wish"),
                                            "param_name" => "title",
                                            "description" => __("The Title", "wish"),
                                            "value" => __("High Resolution Quality", 'wish'),
                                            "admin_label" => true,
                                        ), 

                                        array(
                                            "type" => "textarea",
                                            "holder" => "div",
                                            "class" => "",
                                            "heading" => __("Details", 'wish'),
                                            "param_name" => "details",
                                            "value" => __("Duis aute irure dolor in reprehenderit in voluptate velit esse cillumdolo eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce scelerisque nibh et neque faucibus suscipit. Sed auctor ipsum ut tellus faucibus tincidunt.", 'wish'),
                                            "description" => __("The details below the title", 'wish'),
                                            "admin_label" => false,
                                        ),


                                        array(
                                            "type" => "attach_image",
                                            "holder" => "div",
                                            "class" => "",
                                            "heading" => __("Background Image", 'orane'),
                                            "param_name" => "image",
                                            "description" => __("The large image in the background", 'orane'),

                                        ), 


                                        array(
                                            "type" => "vc_link",
                                            "holder" => "div",
                                            "class" => "",
                                            "heading" => __("Link To The Page", 'orane'),
                                            "param_name" => "link",
                                            "description" => __("The Link below the text", 'orane'),
                                            "admin_label" => false,
                                        ), 

                                        array(
                                            "type" => "textfield",
                                            "heading" => __("Link Text", "wish"),
                                            "param_name" => "link_text",
                                            "description" => __("The Text in the above link, set it blank if you dont want the link to show", "wish"),
                                            "value" => __("Discover", 'wish'),
                                            "admin_label" => false,
                                        ),






                    )
        ) );
    }
    

    public function renderShortcode( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'title'         => 'title',
        'details'       => 'details',
        'image'         => 'Image',
        'link'          => '#',
        'link_text'     => ''
      ), $atts ) );
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      

          $imgsrc = wp_get_attachment_image_src( $image, 'full' );
    
          if($image == "Image"){
            $imgsrc = plugins_url('images/1.jpg', __FILE__);
            $img = "<img src='{$imgsrc}' alt='parallax'>";
          }


          $link = vc_build_link($link); //parse the link
          $link_url = $link["url"];
          $link_target = $link["target"];

          if($link == ""){
            $link = "#";
          }




          $link_string = "<div class='buttons animated' data-animation='flipInX' data-animation-delay='500'><a href='{$link_url}' class='fill'>{$link_text}</a></div>";
     
          if($link_text == ""){
            $link_string = "";
          }



      $output = "<div class='parallax-1' style='background-image: url({$imgsrc})'>
                    <div class='container high-quality'>
                        <div class='row'>
                            <div class='col-lg-5 col-lg-offset-1'>
                                <div class='info'>
                                    <h3 class='animated' data-animation='fadeInUp' data-animation-delay='100'>{$title}</h3>
                                    <div class='description animated' data-animation='fadeInUp' data-animation-delay='300'>{$details}</div>
                                    {$link_string}
                                </div>
                            </div>
                            <div class='col-lg-6'></div>
                        </div>
                    </div>
                </div>";


      return $output;
    }

    /*
    Load plugin css and javascript files which you may need on front end of your site
    */
    public function loadCssAndJs() {
      wp_register_style( 'vc_extend_style', plugins_url('assets/vc_extend.css', __FILE__) );
      wp_enqueue_style( 'vc_extend_style' );

      // If you need any javascript files on front end, here is how you can load them.
      //wp_enqueue_script( 'vc_extend_js', plugins_url('assets/vc_extend.js', __FILE__), array('jquery') );
    }

    /*
    Show notice if your plugin is activated but Visual Composer is not
    */
    public function showVcVersionNotice() {
        $plugin_data = get_plugin_data(__FILE__);
        echo '
        <div class="updated">
          <p>'.sprintf(__('<strong>%s</strong> requires <strong><a href="http://bit.ly/vcomposer" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'vc_extend'), $plugin_data['Name']).'</p>
        </div>';
    }


    public function outputTitleTrue( $title ) {
        return '<h4 class="wpb_element_title">' . __( $title, 'js_composer' ) . ' ' . $this->settings( 'logo' ) . '</h4>';
    }





}//end of class
?>