<?php



/*



Template Name: Portfolio



*/







get_header(); ?>







<?php 



	global $post;



	$num_images = get_post_meta( $post->ID, '_portfolio_mb_num', true );

	$num_images = esc_attr($num_images);



	$args = array( 'post_type' => 'project', 'posts_per_page' => $num_images); 



	$loop = new WP_Query( $args );



	$width = get_post_meta( $post->ID, '_portfolio_mb_width', true );

	$width = esc_attr($width);



	$effect = get_post_meta( $post->ID, '_portfolio_mb_effect', true );

	$effect = esc_attr($effect);
	$effect = sanitize_html_class($effect);





?>



















<section class="portfolio">



	<?php if($width == "full"){ ?><div class="container-fluid"><?php }else{ ?><div class="container"><?php } ?>



		<div class="row">



			<div class="col-md-12 tag-heading">



				<h1> <?php echo orane_line2SpanColor(get_the_title()); ?> </h1>



				<p><?php echo esc_attr($post->post_content); ?></p>



			</div>



		</div>



		<div class="row">







			<?php  



				$pid = $post->ID;



				$ctax = get_terms('orane_project_types');



				$tarray = array();



				foreach($ctax as $tkey=>$tvalue){



						$tarray[$tvalue->slug] =  $tvalue->name;



				}







			?>







			<div class="col-md-12">



					<div class="port-filter">











						<a href="#" class="active" data-filter="*">All</a>



						<?php foreach($tarray as $key=>$value){ ?>



							<a href="#" data-filter=".<?php echo esc_attr($key); ?>"><?php echo esc_attr($value); ?></a>



						<?php } ?>















					</div>



			</div>



		</div>







			<div class="row">







					<div <?php post_class("orane-portfolio-full {$effect}"); ?> >



						<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>



					<?php  



					           $pid =  get_the_ID();



					           $terms = get_the_terms( $pid, 'orane_project_types' ,  ' ' );



					           $thumbid = get_post_thumbnail_id( $pid );



					           $thumb = get_the_post_thumbnail($pid, 'port-size');



					           $full = wp_get_attachment_image_src($thumbid, 'full') ;



					           $link = get_post_permalink();



					           $title = get_the_title();



					           $slg = "";



					          



								if(!empty($terms)){	



							           foreach($terms as $slug){



							           		$slg .= sanitize_html_class($slug->slug) . " ";



							           }



								}



					?>



							

					
										
									    <div class='port_item port_item-third <?php echo esc_attr($slg); ?>'>



					                        <a href='#' class='itemzoom_outer'><?php echo wp_kses_post($thumb); ?></a>



												



											<?php if($effect != "portfolio-dark"){ ?>	



					                        	<a href='<?php echo esc_url($full[0]); ?>' title='<?php echo esc_attr($title); ?>' class='itemzoom item-mag'></a>



											<?php } ?>	







					                        <div class='mask'>



					                            <h2><?php echo esc_attr($title); ?></h2>







												<?php if($effect == "portfolio-dark"){ ?>



													<a href='<?php echo esc_url($full[0]); ?>' title='<?php echo esc_attr($title); ?>' class='itemzoom item-mag'></a>



												<?php } ?>	



					                            



					                            <a href='<?php echo esc_url( $link ); ?>' class='info'><?php _e("Read More", "orane"); ?></a>











					                        </div>



					                    </div>







						<?php endwhile; ?>



			</div>



	</div>



	







</section>







		<div class="clearfix"></div>































<?php get_footer(); ?>







