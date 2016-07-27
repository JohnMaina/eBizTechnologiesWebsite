<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category Orane Metaboxes
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://metabox.io
 */



function orane_projects_metaboxes( $meta_boxes ) {

    $prefix = '_projects_mb_'; // Prefix for all fields

    $meta_boxes['orane_cmb_projects'] = array(



                                                'id' => 'projects_settings',



                                                'title' => __('Display Settings', 'orane'),



                                                'pages' => array('project'), // post type



                                                'context' => 'normal',



                                                'priority' => 'high',



                                                'show_names' => true,



                                                'fields' => array(







                                                    array(



                                                            'name'    => __('Featured?', 'orane'),



                                                            'desc'    => __('Makes This Project Featured On Home Page', 'orane'),



                                                            'id'      => $prefix . 'feature',



                                                            'type'    => 'select',



                                                            'options' => array(



                                                                '1'      => __( 'Yes', 'orane' ),



                                                                '0'      => __( 'No', 'orane' ),



                                                            ),



                                                            'default' => '1',



                                                        ),











                                                ),//ends fields array



                        );//ends metaboxes array







    return $meta_boxes;



}



add_filter( 'cmb_meta_boxes', 'orane_projects_metaboxes' );



/////////////////////////////////////////////////////////////////////////////////////////
// new in version 1.0.2
function orane_clients_metaboxes( $meta_boxes ) {

    $prefix = '_clients_mb_'; // Prefix for all fields

    $meta_boxes['orane_cmb_clients'] = array(

                                                'id' => 'clients_settings',
                                                'title' => __('Client Info', 'orane'),
                                                'pages' => array('client'), // post type
                                                'context' => 'normal',
                                                'priority' => 'high',
                                                'show_names' => true,
                                                'fields' => array(

                                                    array(
                                                        'name' => __('URL', 'orane'),
                                                        'desc' => __('The URL To The Clients Site', 'orane'),
                                                        'id' => $prefix . 'client_url',
                                                        'default'   => __('#', 'orane'),
                                                        'type' => 'text_url'
                                                    ),


                                                ),//ends fields array


                        );//ends metaboxes array

    return $meta_boxes;

}

add_filter( 'cmb_meta_boxes', 'orane_clients_metaboxes' );
//  //ends new in version 1.0.2




/////////////////////////////////////////////////////////////////////////////////////////
function orane_page_advanced_metaboxes( $meta_boxes ) {

    $prefix = '_orane_page_adv_'; // Prefix for all fields
    $meta_boxes[] = array(



                                                'id' => $prefix. 'settings',



                                                'title' => __('Background Color', 'orane'),



                                                'pages' => array('page'), // post type



                                                'show_on' => array( 'key' => 'page-template', 'value' => 'advanced.php' ),



                                                'context' => 'normal',



                                                'priority' => 'low',



                                                'show_names' => true,



                                                'fields' => array(







                                                                    array(



                                                                        'name'    => 'Show Title',



                                                                        'desc'    => 'Show or hide title?',



                                                                        'id'      => $prefix . 'show_title',



                                                                        'type'    => 'select',



                                                                        'options' => array(



                                                                            'show' => __( 'Show', 'orane' ),



                                                                            'hide'   => __( 'Hide', 'orane' ),



                                                                        ),



                                                                        'default' => 'hide',



                                                                    ),















                                                ),//ends fields array



                        );//ends metaboxes array







    return $meta_boxes;



}



add_filter( 'cmb_meta_boxes', 'orane_page_advanced_metaboxes' );



/////////////////////////////////////////////////////////////////////////////////////////























//full-width portfolio page settings



function orane_portfolio_settings( $meta_boxes ) {







    $prefix = '_portfolio_mb_'; // Prefix for all fields



    $meta_boxes['cmb_portfolio_settings'] = array(



                                                'id' => 'portfolio_settings',



                                                'title' => 'Portfolio Settings',



                                                'pages' => array('page'), // post type



                                                'context' => 'normal',



                                                'priority' => 'high',



                                                'show_names' => true, // Show field names on the left



                                                'show_on' => array( 'key' => 'page-template', 'value' => 'portfolio-full.php' ),



                                                'fields' => array(







                                                    array(



                                                        'name'    => __('Width:', 'orane'),



                                                        'desc'    => __('Makes The Portfolio Full-Width Or Inside The Container', 'orane'),



                                                        'id'      => $prefix . 'width',



                                                        'type'    => 'select',



                                                        'options' => array(



                                                            'full'      => __( 'Full Width', 'orane' ),



                                                            'cont'      => __( 'Container', 'orane' ),



                                                        ),



                                                        'default' => 'full',



                                                    ),







                                                    array(



                                                        'name'    => __('Number Of Images:', 'orane'),



                                                        'desc'    => __('Number Of Images To Show', 'orane'),



                                                        'id'      => $prefix . 'num',



                                                        'type'    => 'select',



                                                        'options' => array(



                                                            '4'      => __( '4', 'orane' ),



                                                            '5'      => __( '5', 'orane' ),



                                                            '8'      => __( '8', 'orane' ),



                                                            '10'     => __( '10', 'orane' ),



                                                            '12'     => __( '12', 'orane' ),



                                                            '15'     => __( '15', 'orane' ),



                                                            '16'     => __( '16', 'orane' ),



                                                            '20'     => __( '20', 'orane' ),



                                                            '24'     => __( '24', 'orane' ),



                                                        ),



                                                        'default' => '8',



                                                    ),















                                                    array(



                                                        'name'    => __('Animation Effect', 'orane'),



                                                        'desc'    => __('Animation Effect On Mouse Hover', 'orane'),



                                                        'id'      => $prefix . 'effect',



                                                        'type'    => 'select',



                                                        'options' => array(



                                                            'portfolio-dark'       => __( 'Dark Effect', 'orane' ),



                                                            'portfolio-slideup'    => __( 'Slide Up', 'orane' ),



                                                        ),



                                                        'default' => 'portfolio-slideup',



                                                    ),



















                                                ),//ends fields array



                                            );//ends metaboxes array







    return $meta_boxes;



}



add_filter( 'cmb_meta_boxes', 'orane_portfolio_settings' );















/////////////////////////////////////////////////////////////////////////////////////



//full-width portfolio page settings



///////////////////////////////////////////////////////////////////////////////////////



function orane_blog_metaboxes( $meta_boxes ) {







    $prefix = '_blog_mb_'; // Prefix for all fields



    $meta_boxes[] = array(



                                                'id' => 'blog_meta_settings',



                                                'title' => __('Blog Settings', 'orane'),



                                                'pages' => array('page'), // post type



                                                'show_on' => array( 'key' => 'page-template', 'value' => 'blog.php' ),



                                                'context' => 'normal',



                                                'priority' => 'high',



                                                //'show_names' => true, // Show field names on the left



                                                'fields' => array(







                                                    array(



                                                            'name' => 'Show Images',



                                                            'desc' => 'Show Post Images?',



                                                            'id' => $prefix . 'show_images',



                                                            'type' => 'checkbox'



                                                        ),







                                                    array(



                                                            'name' => 'Show Title',



                                                            'desc' => 'Show Blog Title?',



                                                            'id' => $prefix . 'show_title',



                                                            'type' => 'checkbox'



                                                        ),







                                                    array(



                                                            'name' => 'Show Read More?',



                                                            'desc' => 'Show Read More Links?',



                                                            'id' => $prefix . 'show_read_more',



                                                            'type' => 'checkbox'



                                                        ),







                                                    array(



                                                        'name'    => 'Posts Per Page:',



                                                        'desc'    => 'Number Of Posts To Show On Each Blog Page',



                                                        'id'      => $prefix . 'num',



                                                        'type'    => 'select',



                                                        'options' => array(



                                                            '2'      => __( '2', 'orane' ),



                                                            '3'      => __( '3', 'orane' ),



                                                            '4'      => __( '4', 'orane' ),



                                                            '5'      => __( '5', 'orane' ),



                                                            '6'      => __( '6', 'orane' ),



                                                            '7'      => __( '7', 'orane' ),



                                                            '8'      => __( '8', 'orane' ),



                                                            '9'      => __( '9', 'orane' ),



                                                            '10'     => __( '10', 'orane' ),



                                                        ),



                                                        'default' => '4',



                                                    ),















                                                ),//ends fields array



                                            );//ends metaboxes array







    return $meta_boxes;



}



add_filter( 'cmb_meta_boxes', 'orane_blog_metaboxes' );















/////////////////////////////////////////////////////////////////////////////////////























/////////////////////////////////////////////////////////////////////////////////////



//Contact page settings



///////////////////////////////////////////////////////////////////////////////////////



function orane_contact_info_metaboxes( $meta_boxes ) {











    $prefix = '_contact_info_mb_'; // Prefix for all fields



    $meta_boxes['contact_info_settings'] = array(



                                                'id' => 'contact_info_settings',



                                                'title' => __('Contact Info Settings', 'orane'),



                                                'pages' => array('page'), // post type



                                                'show_on' => array( 'key' => 'page-template', 'value' => 'contact.php' ),



                                                'context' => 'normal',



                                                'priority' => 'high',



                                                'show_names' => true, // Show field names on the left



                                                'fields' => array(







                                                    array(



                                                        'name' => __('Title', 'orane'),



                                                        'desc' => __('The Title Of The Contact Info Section', 'orane'),



                                                        'id' => $prefix . 'form_title',



                                                        'default'   => __('Contact Info', 'orane'),



                                                        'type' => 'text'



                                                    ),







                                                    array(



                                                        'name' => __('Details','orane'),



                                                        'desc' => __('The Details Under The Title','orane'),



                                                        'default'   => __('Fill Out The Form and we will get back to you asap.', 'orane'),



                                                        'id' => $prefix . 'form_details',



                                                        'type' => 'textarea_small'



                                                    ), 







                                                    array(



                                                        'name' => __('Company', 'orane'),



                                                        'desc' => __('Company Title', 'orane'),



                                                        'id' => $prefix . 'company',



                                                        'default'   => __('Redhawk Studio', 'orane'),



                                                        'type' => 'text'



                                                    ),







                                                    array(



                                                        'name' => __('Street', 'orane'),



                                                        'desc' => __('Street Title', 'orane'),



                                                        'id' => $prefix . 'street',



                                                        'default'   => __('Street # 10', 'orane'),



                                                        'type' => 'text'



                                                    ),







                                                    array(



                                                        'name' => __('Country', 'orane'),



                                                        'desc' => __('Country Title', 'orane'),



                                                        'id' => $prefix . 'country',



                                                        'default'   => 'USA',



                                                        'type' => 'text'



                                                    ),







                                                    array(



                                                        'name' => __('Phone', 'orane'),



                                                        'desc' => __('Address', 'orane'),



                                                        'id' => $prefix . 'phone',



                                                        'default'   => '',



                                                        'type' => 'text'



                                                    ),











                                                    array(
                                                        'name' => __('email', 'orane'),
                                                        'desc' => __('Email', 'orane'),
                                                        'id' => $prefix . 'email',
                                                        'default'   => 'example@email.com',
                                                        'type' => 'text_email'
                                                    ),

                                                    array(
                                                        'name' => __('Extra Fields', 'orane'),
                                                        'desc' => __('Extra Fields <a target="_blank" href="http://i.imgur.com/pRBIx2K.png">How To use</a>', 'orane'),
                                                        'id' => $prefix . 'extras',
                                                        'default'   => '',
                                                        'type' => 'textarea_small'
                                                    ),




                                                    array(

                                                            'name' => 'Show Social Icons?',
                                                            'desc' => 'Show Social Icons?',
                                                            'id' => $prefix . 'show_social_icons',
                                                            'type' => 'checkbox',                               

                                                        ),


                                                    //extra fields for ashwini	
                                                    array(
                                                        'name' => __('Second Address Title', 'orane'),
                                                        'desc' => __('Second Title', 'orane'),
                                                        'id' => $prefix . 'second_title',
                                                        'default'   => '',
                                                        'type' => 'text'
                                                    ),



                                                    array(
                                                        'name' => __('Second Address Details', 'orane'),
                                                        'desc' => __('Extra Fields <a target="_blank" href="http://i.imgur.com/pRBIx2K.png">How To use</a>', 'orane'),
                                                        'id' => $prefix . 'extras2',
                                                        'default'   => '',
                                                        'type' => 'textarea_small'
                                                    ),











                                                ),//ends fields array



                                            );//ends metaboxes array



















    $prefix = '_contact_mb_';



    $meta_boxes[] = array(



                                                'id'        => 'contact_settings',



                                                'title'     => 'Contact Form Settings',



                                                'pages'     => array('page'), // post type



                                                'show_on' => array( 'key' => 'page-template', 'value' => 'contact.php' ),



                                                'context'   => 'normal',



                                                'priority'  => 'high',



                                                'show_names' => true, // Show field names on the left



                                                'fields' => array(







                                                    array(



                                                        'name'      => 'Title',



                                                        'desc'      => 'The Title Of The Contact Form',



                                                        'id'        => $prefix . 'form_title',



                                                        'default'   => 'Get In Touch With Us',



                                                        'type'      => 'text'



                                                    ),







                                                    array(



                                                        'name'      => 'Details',



                                                        'desc'      => 'The Details Under The Title',



                                                        'default'   => 'Fill Out The Form and we will get back to you asap.',



                                                        'id'        => $prefix . 'form_details',



                                                        'type'      => 'textarea_small'



                                                    ), 







                                                    array(



                                                        'name' => 'Contact Form Shortcode',



                                                        'desc' => 'You can generate the shortcode using contact form 7, or any other popular form plugins.',



                                                        'id' => $prefix . 'form_shortcode',



                                                        'default'   => '',



                                                        'type' => 'text'



                                                    ),







                                                ),//ends fields array



                                            );//ends metaboxes array























    $prefix = '_contact_map_';



    $meta_boxes['contact_map_settings'] = array(



                                                'id' => 'contact_map_settings',



                                                'title' => __('Google Maps Settings', 'orane'),



                                                'pages' => array('page'), // post type



                                                'show_on' => array( 'key' => 'page-template', 'value' => 'contact.php' ),



                                                'context' => 'normal',



                                                'priority' => 'high',



                                                'show_names' => true, // Show field names on the left



                                                'fields' => array(







                                                    array(



                                                        'name' => __('Title', 'orane' ),



                                                        'desc' => __('The Title Of The Contact Info Section', 'orane'),



                                                        'id' => $prefix . 'title',



                                                        'default'   => __('Our Headquarters', 'orane'),



                                                        'type' => 'text'



                                                    ),







                                                    array(



                                                        'name' => __('Address', 'orane' ),



                                                        'desc' => __('Address', 'orane'),



                                                        'default'   => __('1600 Amphitheatre Parkway, Mountain View, CA 94043, United States', "orane"),



                                                        'id' => $prefix . 'address',



                                                        'type' => 'text'



                                                    ),







                                                    array(



                                                        'name' => __('Zoom', 'orane'),



                                                        'desc' => __('Map Zoom', 'orane'),



                                                        'default'   => '13',



                                                        'id' => $prefix . 'zoom',



                                                        'type' => 'text'



                                                    ),







                                                    array(



                                                            'name' => 'Show Map Above The Form?',



                                                            'desc' => 'Show The Map Above Or Below The Form?',



                                                            'id' => $prefix . 'map_position',



                                                            'type' => 'checkbox',



                                                            



                                                        ),



















                                                ),//ends fields array



                                            );//ends metaboxes array























    return $meta_boxes;



}



add_filter( 'cmb_meta_boxes', 'orane_contact_info_metaboxes' );



























/////////////////////////////////////////////////////////////////////////////////////



























//new metaboxes types



function cmb2_get_post_options( $query_args ) {







    $args = wp_parse_args( $query_args, array(



        'post_type' => 'page',



        'numberposts' => 10,



    ) );







    $posts = get_posts( $args );







    $post_options = array();



    $post_options[] = array(



                       'name' => "None",



                       'value' => "#"



                   );











    if ( $posts ) {



        foreach ( $posts as $post ) {



                   $post_options[] = array(



                       'name' => $post->post_title,



                       'value' => $post->ID



                   );



        }



    }







    return $post_options;



}























/////////////////////////////////////////////////////////////////////



add_action( 'add_meta_boxes', 'orane_layout_meta' );



function orane_layout_meta()



{



    if(  !isset($_GET['post']) || !isset($_POST['post_ID']) ){



        return;



    }







    $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;



    $template_file = esc_attr( get_post_meta($post_id,'_wp_page_template',TRUE) );



    if ($template_file == 'blog.php') {



        add_meta_box( 'orane-sidebar-pos', 'Page Layout', 'orane_layout_meta_cb', 'page', 'side', 'high' );



    }



















}



















function orane_layout_meta_cb( $post )



{



    $layout = esc_attr( get_post_meta( $post->ID, '_orane_post_layout', true ) );



    // Set our layout variable, even on new posts



    if( empty( $layout ) ) $layout = 'default';



     



    // Theme directory for borrowing 2011 images



    $dir = get_template_directory_uri();



    wp_nonce_field( 'save_post_layout', 'layout_nonce' );



    ?>



    <fieldset class="layout-choose clearfix">



    <div class="cd-layout">



        <input type="radio" id="sidebar-default" name="_orane_post_layout" value="default" <?php checked( $layout, 'default' ); ?> />



        <label for="sidebar-default">



            <img src="<?php echo esc_url($dir); ?>/images/full_width.png" alt="Use the Default Sidebar" />



            <!-- <span>Use theme default</span> -->



        </label>



    </div>



    <div class="cd-layout">



        <input type="radio" id="sidebar-left" name="_orane_post_layout" value="left" <?php checked( $layout, 'left' ); ?> />



        <label for="sidebar-left">



            <img src="<?php echo esc_url($dir); ?>/images/left_sidebar.png" alt="sidebar then content" />



            <!-- <span>Sidebar on the left</span> -->



        </label>



    </div>



    <div class="cd-layout">



        <input type="radio" id="sidebar-right" name="_orane_post_layout" value="right" <?php checked( $layout, 'right' ); ?> />



        <label for="sidebar-right">



            <img src="<?php echo esc_url($dir); ?>/images/right_sidebar.png" alt="content then sidebar" />



            <!-- <span>Sidebar on the right</span> -->



        </label>



    </div>



    </fieldset>



    <?php



}



 



add_action( 'save_post', 'orane_layout_save' );



function orane_layout_save( $id )



{



    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;



    if( !isset( $_POST['layout_nonce'] ) || !wp_verify_nonce( $_POST['layout_nonce'], 'save_post_layout' ) ) return;



    if( !current_user_can( 'edit_page' ) ) return;



     



    if( isset( $_POST['_orane_post_layout'] ) ){



        update_post_meta( $id, '_orane_post_layout', esc_attr( strip_tags( $_POST['_orane_post_layout'] ) ) );



    }



}























add_action( 'admin_print_styles-post.php', 'orane_layout_enqueue' );



add_action( 'admin_print_styles-post-new.php', 'orane_layout_enqueue' );



function orane_layout_enqueue(){



    wp_enqueue_style( 'orane-layout-style', esc_url( get_template_directory_uri() ) . '/css/admin.css', array(), NULL, 'all' );



}



///////////////////////////////////////////////////////////////















add_filter( 'rwmb_meta_boxes', 'orane_register_meta_boxes_gallery_posts');



function orane_register_meta_boxes_gallery_posts( $meta_boxes )



{







    $prefix = 'orane';



    // 1st meta box



    $meta_boxes[] = array(



        'id'       => 'orane_gallery_posts',



        'title'    => __('Options for different post fomats', 'orane'),



        'pages'    => array( 'post' ),



        'context' => 'normal',



        'priority' => 'high',







        'fields' => array(



            array(



                'name'             => __( 'Upload Gallery Images', 'orane' ),



                'id'               => "{$prefix}_gallery",



                'type'             => 'image_advanced',



                'max_file_uploads' => 100,



            ),



             array(



                'name' => __( 'Enter a Video URL', 'orane' ),



                'id'   => "{$prefix}_media",



                'desc' => __( 'Enter a youtube or vimeo URL. Supports services of Animoto, Blip, CollegeHumor, DailyMotion, Flickr, FunnyOrDie.com, Hulu, Imgur, Instagram, iSnare, Issuu, Meetup.com, EmbedArticles, Mixcloud, Photobucket, PollDaddy, Rdio, Revision3, Scribd, SlideShare, SmugMug, SoundCloud, Spotify, TED, Twitter, Vimeo, Vine, WordPress.tv, YouTube, Scribd<br /><i>Twitter - older versions of WordPress have issues with https embeds, just remove the s from the https to fix.</i><br /><i>YouTube - only public and "unlisted" videos and playlists - "private" videos will not embed.</i>', 'orane' ),



                'type' => 'oembed',



            ),



        array(



                // Field name - Will be used as label



                'name'  => __( 'Audio File', 'orane' ),



                // Field ID, i.e. the meta key



                'id'    => "{$prefix}_audio",



                // Field description (optional)



                'desc'  => __( 'Enter url of your audio file for Audio post type e.g http://my.mp3s.com/cool/songs/coolest.mp3', 'orane' ),



                'type'  => 'text',



                // Default value (optional)



                'std'   => __( '', 'orane' ),



                // CLONES: Add to make the field cloneable (i.e. have multiple value)



                'clone' => false,



            ),           



        



            



        )



    );



    return $meta_boxes;



}















///////////////////////////////////display first image from posts



function catch_that_image() {



  global $post, $posts;



  $first_img = '';



  ob_start();



  ob_end_clean();



  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);



  $first_img = $matches[1][0];



 



  if(empty($first_img)){ //Defines a default image



    $first_img = "/images/default.jpg";



  }



  return $first_img;



}



















function orane_checkPageTemplate($temp_name){



    if(  isset($_GET['post'])   ){



        $post_id = esc_attr( $_GET['post'] );



    }elseif( isset($_POST['post_ID']) ){



        $post_id = esc_attr( $_POST['post_ID'] );



    }else{



        return;



    }



    











    $template_file = esc_attr( get_post_meta($post_id,'_wp_page_template',TRUE) );















    if ( $template_file == $temp_name ) {



        return true;



    }else{



        return false;



    }















}