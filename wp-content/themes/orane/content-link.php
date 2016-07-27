					<?php if(have_posts()): while(have_posts()): the_post(); ?>







							<div <?php post_class("post-1"); ?>>



								<div class="post-position">



									<h1><a target="_blank" href="<?php echo esc_attr(get_the_content());?>" rel="bookmark"><?php echo orane_line2SpanColor(get_the_title()); ?></a></h1>



									<div class="author"><?php _e("Posted by:", "orane"); ?><span class="author-name"><?php the_author(); ?></span> </div>



									



            



								</div>



							</div>



								



					<?php endwhile; ?>



					<?php endif; ?>