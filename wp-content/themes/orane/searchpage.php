<?php
/*
	Template Name: Search Page
*/

get_header(); ?>


<div <?php post_class("orane-home"); ?> >

<div class="container">
	<div class="row">
		<div class="tag-heading">
		<h1><?php echo __("Search", "orane"); ?></h1>
		<?php get_search_form(); ?>
		</div>
	</div>
</div>
</div>

	

		<div class="clearfix"></div>

		
<?php get_footer(); ?>