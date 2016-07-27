						<?php if(have_posts()): while(have_posts()): the_post(); ?>



							



								<div  <?php post_class("post-1"); ?> >									



									<div class="post-position">



										<h3><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo orane_line2SpanColor(get_the_title()); ?></a></h3>



										<div class="author"><?php echo _e("Posted by:", "orane"); ?><span class="author-name"><?php the_author(); ?></span></div>



										



										<?php if(get_the_content() != ""){ ?>



											<p><?php the_excerpt(); ?></p>



										<?php }else{ ?>



											<p><?php _e("No Content Found In The Post", "orane"); ?></p>



										<?php } ?>	



									</div>



								</div>







						<?php endwhile; ?>



					<?php else: ?>

						<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'orane' ); ?></p>





						<?php endif;?>