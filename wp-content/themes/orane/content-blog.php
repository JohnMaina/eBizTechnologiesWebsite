						<?php  



							$show = get_post_meta( $post->ID, '_blog_mb_show_images', true );

							$show  = esc_attr( $show );



							$num = get_post_meta( $post->ID, '_blog_mb_num', true );

							$num  = esc_attr( $num );



							$show_title = get_post_meta( $post->ID, '_blog_mb_show_title', true );

							$show_title  = esc_attr( $show_title );	



							$show_read_more = get_post_meta( $post->ID, '_blog_mb_show_read_more', true );

							$show_read_more  = esc_attr( $show_read_more );



						?>



						



						<?php  if($show_title == 'on'){ ?>



						<div class="page-heading"><h1><?php echo orane_line2SpanColor(get_the_title()); ?></h1></div>



						<?php  } ?>







						<?php query_posts('post_type=post&post_status=publish&posts_per_page='.$num.'&paged='. get_query_var('paged')); ?>



						<?php if(have_posts()): while(have_posts()): the_post(); ?>


								<div  <?php post_class("post-1"); ?> >



									<!-- <img src="images/blog/2.jpg" alt="" /> -->



									<?php 



										if($show == 'on' && has_post_thumbnail() ){ 



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







									<?php } ?>



									



									<div class="post-position">

										<h1><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo orane_line2SpanColor(get_the_title()); ?></a></h1>


									<?php  



											global $redux_orane;



											$show_meta = $redux_orane['orane-blog-show-meta'];

											$show_meta = esc_attr( $show_meta );



									?>











									<?php if($show_meta == 1){ ?>



										<div class="author"><?php _e("Posted by:","orane"); ?><span class="author-name"><?php the_author(); ?></span></div>



									<?php } ?>











										<p><?php the_excerpt(); ?></p>











										<?php if($show_read_more == 'on'){ ?>	



										<a href="<?php echo esc_url( get_permalink() ); ?>" class="blog-read-more"><?php _e("Read More", "orane"); ?></a>



										<?php } ?>







									</div>



								</div>







						<?php endwhile; ?>



						<?php endif; ?>