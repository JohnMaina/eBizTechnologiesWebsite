					<?php if(have_posts()): while(have_posts()): the_post(); ?>



							<div <?php post_class("post-1"); ?>>

								

								

								<div class="post-position post_video">

									<h1><?php echo orane_line2SpanColor(get_the_title()); ?></h1>

                                   

									<div class="author"><?php _e("Posted by:", "orane"); ?><span class="author-name"><?php the_author(); ?></span> </div>

                                     <?php echo wp_oembed_get(get_post_meta($post->ID, 'or_media', true)); ?>

                                     

									<p><?php the_content(); ?></p>

             

								</div>

							</div>

								

					<?php endwhile; ?>

					<?php endif; ?>