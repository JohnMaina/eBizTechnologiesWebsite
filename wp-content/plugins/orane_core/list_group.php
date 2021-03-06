<?php  
//Register "container" content element
vc_map( array(
    "name" => __("List Group", "orane"),
    "description" => __("A List With Plain Text", 'orane'),
    "controls" => "full",
    "base" => "orane_list_group",
    "as_parent" => array('only' => 'orane_list_group_single'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "icon" => plugins_url('assets/icons/3-206-writting-pad.png', __FILE__),
    "show_settings_on_create" => true,
    "category" => __('Orane Components', 'orane'),
    "params" => array(
        // add params same as with any other content element
        array(
            "type" => "textfield",
            "heading" => __("Title", "orane"),
            "param_name" => "title",
            "admin_label" => true,
            "description" => __("Features Section Title", "orane"),
            "value" => __("Our Features", 'orane')
        )
    ),
    "js_view" => 'VcColumnView'
) );

/////////////////////////////////////////////////////////////////child elements
vc_map( array(
    "name" => __("List Item", "orane"),
    "base" => "orane_list_group_single",
    "content_element" => true,
    "as_child" => array('only' => 'orane_list_group'), // Use only|except attributes to limit parent (separate multiple values with comma)
    "params" => array(
        // add params same as with any other content element
        array(
            "type" => "textfield",
            "heading" => __("Title", "orane"),
            "param_name" => "content",
            "admin_label" => true,
            "description" => __("Title", "orane"),
            "value" => __("List Item Title", 'orane')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Badge Value", "orane"),
            "param_name" => "badge",
            "description" => __("Badge can be a number to show number of unread messages etc", "orane"),
            "value" => __("10", 'orane')
        ),
        array(
              "type"        => "dropdown",
              "heading"     => __("Active?", "orane"),
              "param_name"  => "active",
              "value"       => array(
                                    '0'   => 'Plain',
                                    '1'   => 'Active',
                            ),
              "std"         => 0,
              "description" => __("If active, it will highlight the list item", "orane"),
        ),


        array(
            "type" => "vc_link",
            "holder" => "div",
            "class" => "",
            "heading" => __("Link To A Page", 'orane'),
            "param_name" => "link",
            "description" => __("The Link To A Page.", 'orane')
        ),




    )//ends params

) );//ends vc_map

////////////////////////////////////Starts container class
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Orane_List_Group extends WPBakeryShortCodesContainer {

    public function content( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'title'   => 'title'
      ), $atts ) );
     
     $title = lineToSpanColor($title);

      $output = "<div class='lists'>
                        <div class='row'>
                            <div class='col-md-12 list-gap-right'>
                                <h2>{$title}</h2>
                                <ul class='list-group'>
                                  ".do_shortcode($content)."
                                </ul>
                            </div>
                        </div>
                </div>  ";
      
      return $output;
    }


    }//end of container class
} //end if

///////////////////////////////////////////ends container class


if ( class_exists( 'WPBakeryShortCode' ) ) {
class WPBakeryShortCode_Orane_List_Group_Single extends WPBakeryShortCode {


        public function content( $atts, $content = null ) {
        
          extract( shortcode_atts( array(
            'badge'           => '',
            'active'          => '',
            'link'            => '',
          ), $atts ) );
         // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

          $link = vc_build_link($link); //parse the link
          $link_url = esc_url( $link["url"] );
          $link_target = esc_attr( $link["target"] );

          
          if($link == ""){
            $link_url = "#";
            $link_target = "";
          }



          $addclass = "";
          if($active == 'Active'){
            $addclass = "active";
          }
          
          $output = "<li class='list-group-item {$addclass}'><a target='{$link_target}' href='{$link_url}'>{$content}</a><span class='badge'>{$badge}</span></li>";
          return $output;
        }


}//end class

} //end if

/////////////////////////////////////////////////////////////////////////////////////////////

?>