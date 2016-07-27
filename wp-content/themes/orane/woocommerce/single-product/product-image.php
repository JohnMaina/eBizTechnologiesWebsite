<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

?>
<div class="images">

	<?php
	  $attachment_ids = array();
      if ( has_post_thumbnail( $product->id ) ) {
        $attachment_ids[] = get_post_thumbnail_id( $product->id );
      }

      $attachment_ids = array_merge( $attachment_ids, $product->get_gallery_attachment_ids() );
   	
	?>

	<div class="shop-row-1">
		
			<ul id="gal1"> 

	<?php  
		$count = 0;
		$first_full = "";
		$first_huge = "";

		foreach ( $attachment_ids as $position => $attachment_id ) {
			$count++;
	      $attachment_post = get_post( $attachment_id );

	      if ( is_null( $attachment_post ) ) {
	        continue;
	      }
	      $img_full = wp_get_attachment_image_src( $attachment_id, 'product-gallery' );
	      $img_thumb = wp_get_attachment_image_src( $attachment_id, 'thumbnail' );
	      $img_huge = wp_get_attachment_image_src( $attachment_id, 'product-huge' );
	      if($count == 1){
	      	$first_full = $img_full;
	      	$first_huge = $img_huge;
	      }
	    ?>	
				<li>
					<a class="<?php if($count == 1) echo 'active'; ?>" href="#" data-image="<?php echo $img_full[0]; ?>" data-zoom-image="<?php echo $img_huge[0]; ?>"> 
						<img id="img_0<?php echo $count; ?>" src="<?php echo $img_thumb[0]; ?>" alt="" /> 
					</a>
				</li>
	<?php

			if($count == 4){
				break;
			}
	    } 

	?>

			</ul>
			
			<div class="shop-single">
			<img id="zoom_02" src="<?php echo $first_full[0]; ?>" data-zoom-image="<?php echo $first_huge[0]; ?>" alt="" />
			</div>
		
    </div>


	<?php //do_action( 'woocommerce_product_thumbnails' ); ?>

</div>
