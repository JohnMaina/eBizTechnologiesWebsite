					<?php if(have_posts()): while(have_posts()): the_post(); ?>

							<div <?php post_class("post-1"); ?>>
								
								
								<div class="post-position post_status">
									<div class="avatar">
              <?php echo get_avatar( get_the_author_meta( 'ID' ), 70 ); ?>   
          </div>
              <div class="status-info">
                  <small class="status-time"><?php _e( 'By ', 'orane' ); echo get_the_author_meta('first_name') ." ". get_the_author_meta('last_name') .' '; _e( 'On ', 'orane' ); the_time('F j, Y g:i a'); ?></small>
                  <?php the_content(); ?>
              </div>
             
								</div>
							</div>
								
					<?php endwhile; ?>
					<?php endif; ?>