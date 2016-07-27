					<?php if(have_posts()): while(have_posts()): the_post(); ?>







							<div <?php post_class("post-1"); ?>>



								



								



								<div class="post-position post_video">



									<h1><?php echo orane_line2SpanColor(get_the_title()); ?></h1>



                                   



									<div class="author">Posted by:<span class="author-name"><?php  the_author(); ?></span> </div>





                                     <?php echo do_shortcode('[audio src="'.esc_url(get_post_meta($post->ID, 'or_audio', true)).'"]'); ?>



									<p><?php the_content(); ?></p>



             



								</div>



							</div>



								



					<?php endwhile; ?>



					<?php endif; ?>