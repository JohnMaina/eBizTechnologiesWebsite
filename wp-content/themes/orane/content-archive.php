						<?php if(have_posts()): while(have_posts()): the_post(); ?>



							



							



								



								<div  <?php post_class("post-1"); ?> >									



									<div class="post-position">



										<h3><a href="<?php esc_url( the_permalink() ); ?>"><?php echo orane_line2SpanColor(get_the_title()); ?></a></h3>



										<div class="author"><?php _e("Posted by:", "orane"); ?><span class="author-name"><?php esc_attr(the_author()); ?></span></div>



										<p><?php the_excerpt(); ?></p>



									</div>



								</div>







						<?php endwhile; ?>



						<?php endif; ?>