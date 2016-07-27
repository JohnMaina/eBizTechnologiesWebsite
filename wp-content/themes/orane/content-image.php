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



								<?php if (get_post_thumbnail_id()) { ?>



								<?php the_post_thumbnail( 'post-image' ); ?>



                                



								<table border="1" class="blogDetails">



									<tr>



									<td><a href="#"><i class="fa fa-calendar-o fa-lg"></i><?php echo get_the_date('F j, Y'); ?></a></td>



										<?php  

											$comments_number = "";
											if(comments_open()){
												$comments_number = "<i class='fa fa-comment-o fa-lg'></i>" . get_comments_number();
											}else{
												$comments_number = __("Comments Closed", "orane");
											}

										?>	


										<td><a href="#"><?php echo $comments_number; ?></a></td>



									</tr>



								</table>



                                



								<?php } else { ?>



									<img src="<?php echo catch_that_image(); ?>" alt="<?php the_title(); ?>"  />



                                    <table border="1" class="blogDetails">



									<tr>



									<td><a href="#"><i class="fa fa-calendar-o fa-lg"></i><?php echo get_the_date('F j, Y'); ?></a></td>



										<?php  

											$comments_number = "";
											if(comments_open()){
												$comments_number = "<i class='fa fa-comment-o fa-lg'></i>" . get_comments_number();
											}else{
												$comments_number = "";
											}

										?>	


										<td><a href="#"><?php echo $comments_number; ?></a></td>



									</tr>



								</table>



									<?php } ?>



								<div class="post-position">



									<h1><?php echo orane_line2SpanColor(get_the_title()); ?></h1>



									<div class="author"><?php _e("Posted by:", "orane"); ?><span class="author-name"><?php the_author(); ?></span> </div>



									<p><?php the_content(); ?></p>



            



								</div>



							</div>



								



					<?php endwhile; ?>



					<?php endif; ?>