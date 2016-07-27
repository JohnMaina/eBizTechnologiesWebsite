					<?php  

							global $redux_orane;

							$show_img_gobal = $redux_orane['orane-home-images-show'];
							$show_img_gobal = esc_attr( $show_img_gobal);

							$addclass = "";

							if($show_img_gobal == 0 || !has_post_thumbnail()){

								$addclass = "post-margin";

							}



					?>



					<?php if(have_posts()): while(have_posts()): the_post(); ?>



							<div <?php post_class("post-1"); ?>>

								<!-- <img src="images/blog/2.jpg" alt="" /> -->



								<?php if( has_post_thumbnail() && $show_img_gobal == 1 ){ ?>

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

								<?php } ?>



								

								<div class="post-position">

									<h1><?php echo orane_line2SpanColor(get_the_title()); ?></h1>

									

									<?php  

											global $redux_orane;

											$show_meta = $redux_orane['orane-blog-show-meta'];
											$show_meta = esc_attr( $show_meta );

									?>

									<?php if($show_meta == 1){ ?>

										<div class="author"><?php _e("Posted by:", 'orane'); ?><span class="author-name"><?php the_author(); ?></span> <?php _e("on", "orane"); ?><span class="author-name"><?php echo get_the_date('F j, Y'); ?></span></div>

									<?php } ?>

									<p><?php the_content(); ?></p>

								</div>

							</div>

								

					<?php endwhile; ?>

					<?php endif; ?>