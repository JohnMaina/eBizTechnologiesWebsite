<?php

add_action( 'add_meta_boxes', 'orane_layout_meta' );

function orane_layout_meta()

{

    add_meta_box( 'cd-sidebar-pos', 'Page Layout', 'orane_layout_meta_cb', 'page', 'normal', 'high' );

}

 

function orane_layout_meta_cb( $post )

{

    $layout = get_post_meta( $post->ID, '_cd_post_layout', true );
    $layout = esc_attr($layout);
     

    // Set our layout variable, even on new posts

    if( empty( $layout ) ) $layout = 'default';

     

    // Theme directory for borrowing 2011 images

    $dir = get_template_directory_uri();

    wp_nonce_field( 'save_post_layout', 'layout_nonce' );

    ?>

    <fieldset class="clearfix">

    <p><?php _e("Please note: this only works if you've selected 'Sidebar Template' in the Page Attributes section", "orane"); ?></p>

    <div class="cd-layout">

        <input type="radio" id="sidebar-default" name="_cd_post_layout" value="default" <?php checked( $layout, 'default' ); ?> />

        <label for="sidebar-default">

            <img src="<?php echo CDSB_URL ?>default.png" alt="Use the Default Sidebar" />

            <span><?php _e("Use theme default", "orane"); ?></span>

        </label>

    </div>

    <div class="cd-layout">

        <input type="radio" id="sidebar-left" name="_cd_post_layout" value="left" <?php checked( $layout, 'left' ); ?> />

        <label for="sidebar-left">

            <img src="<?php echo esc_url($dir); ?>/inc/images/sidebar-content.png" alt="sidebar then content" />

            <span><?php _e("Sidebar on the left", "orane"); ?></span>

        </label>

    </div>

    <div class="cd-layout">

        <input type="radio" id="sidebar-right" name="_cd_post_layout" value="right" <?php checked( $layout, 'right' ); ?> />

        <label for="sidebar-right">

            <img src="<?php echo esc_url($dir); ?>/inc/images/content-sidebar.png" alt="content then sidebar" />

            <span><?php _e("Sidebar on the right", "orane"); ?></span>

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

     

    if( isset( $_POST['_cd_post_layout'] ) )

        update_post_meta( $id, '_cd_post_layout', esc_attr( strip_tags( $_POST['_cd_post_layout'] ) ) );

}

?>