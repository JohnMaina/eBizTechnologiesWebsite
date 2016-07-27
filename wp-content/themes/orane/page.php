<?php

/*

	Default Page Template

*/



get_header(); ?>

<div class="container">

	<div class="row">

		<div <?php post_class(); ?> >

		<?php if(have_posts()): while(have_posts()): the_post(); ?>	

					<div class="page-heading page-center"><h1><?php echo orane_line2SpanColor(get_the_title()); ?></h1></div>	

					<?php the_content(); ?>

		<?php endwhile; ?>

		<?php endif; ?>


		<?php  
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
		?>

		</div>



	</div>

</div>



	



		<div class="clearfix"></div>



	











<?php get_footer(); ?>