<?php

/**

 * The default template for displaying content. Used for both single and index/archive/search.

 *

 * @package WordPress

 * @subpackage Orane

 * @author Redhawk 

 */

?>



					<?php if(have_posts()): while(have_posts()): the_post(); ?>

							<div <?php post_class("post-1"); ?>>

								<!-- <img src="images/blog/2.jpg" alt="" /> -->

								

								

								<div class="post-position orane-quote">

									<h1><?php echo orane_line2SpanColor(get_the_title()); ?></h1>

									<div class="author"><?php _e("Posted by:", "orane"); ?><span class="author-name"><?php the_author(); ?></span> </div>

									<?php the_content(); ?>

            
								</div>

							</div>

								

					<?php endwhile; ?>

					<?php endif; ?> 

