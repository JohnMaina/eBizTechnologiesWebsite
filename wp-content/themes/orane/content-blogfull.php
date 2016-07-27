						<?php query_posts('post_type=post&post_status=publish&posts_per_page=2&paged='. get_query_var('paged')); ?>



						<?php if(have_posts()): while(have_posts()): the_post(); ?>



							



							







								<div  <?php post_class("post-1"); ?> >



									<?php the_post_thumbnail( 'post-image' ); ?>



									<table border="1" class="blogDetails">



										<tr>



										<td><a href="#"><i class="fa fa-calendar-o fa-lg"></i><?php the_date(); ?></a></td>



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



									



									<div class="post-position">



										<h1><?php echo orane_line2SpanColor(get_the_title()); ?></h1>



										<div class="author"><?php _e("Posted by:", "orane"); ?><span class="author-name"><?php the_author(); ?></span></div>



										<p><?php the_excerpt(); ?></p>



										<a href="<?php echo esc_url( get_permalink() ); ?>" class="blog-read-more"><?php _e("Read More", "orane"); ?></a>



									</div>



								</div>







						<?php endwhile; ?>



						<?php endif; ?>