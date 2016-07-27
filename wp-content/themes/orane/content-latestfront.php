						<?php 



							global $redux_orane; 



							$show = $redux_orane['orane-home-images-show'];

							$show = esc_attr( $show );



							$addclass = "";



							if($show == 1){



								$addclass = "post-margin";



							}



						?>





						<?php if(have_posts()): while(have_posts()): the_post(); ?>



								



								<?php  



									if ( !has_post_thumbnail() ) {



										$addclass = "";



									}		



								?>	







								<div  <?php post_class("post-1 " . $addclass); ?> >



									<?php 



										if($show == 1){ 



											if ( has_post_thumbnail() ) {



												the_post_thumbnail( 'post-image' ); 



									?>



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







									<?php }} ?>



									



									<div class="post-position">



										<h1><?php echo orane_line2SpanColor(get_the_title()); ?></h1>



										<div class="author"><?php _e("Posted by:", "orane"); ?><span class="author-name"><?php the_author(); ?></span></div>



										<p><?php the_excerpt(); ?></p>



										<a href="<?php echo esc_url( get_permalink() ); ?>" class="blog-read-more"><?php _e("Read More", "orane"); ?></a>



									</div>



								</div>







						<?php endwhile; ?>



						<?php endif; ?>