<?php



/**



 * The default template for displaying content. Used for both single and index/archive/search.



 *



 * @package WordPress



 * @subpackage Orane



 * @author Redhawk 



 */



?>







	<?php if(have_posts()): while(have_posts()): the_post(); ?>







							<div <?php post_class("post-1"); ?>>



								



								<div class="post-position">



									<h1><?php echo orane_line2SpanColor(get_the_title()); ?></h1>



									<div class="author"><?php _e("Posted by:", "orane"); ?><span class="author-name"><?php the_author(); ?></span> </div>



                                    <?php 



								



								$images = rwmb_meta( 'orane_gallery', 'type=image_advanced' );

								

							



								?>







								



								<div <?php post_class("orane-portfolio-full"); ?> >



									<?php foreach ( $images as $image ){ ?>



									    <div class='port_item port_item-third'>



					                        <a href='<?php echo esc_url($image['full_url']); ?>' class='itemzoom_outer'><img src="<?php echo esc_url($image['full_url']); ?>"></a>



					                        <div class='mask'>



					                            <h2><?php echo esc_attr($image['caption']); ?></h2>



					                            <a href='<?php echo esc_url($image['full_url']); ?>' title='<?php echo esc_attr($title); ?>' class='itemzoom item-mag'></a>



					                            



					                        </div>



					                    </div>



					                <?php } ?>    



								</div>



				







								<?php the_content(); ?>



            



								</div>



							</div>



								



					<?php endwhile; ?>



					<?php endif; ?>