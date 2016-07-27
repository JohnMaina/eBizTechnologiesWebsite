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
								
								<div class="post-position post-aside">
									<p><?php the_content(); ?></p>
            
								</div>
							</div>
								
					<?php endwhile; ?>
					<?php endif; ?>
					<hr />