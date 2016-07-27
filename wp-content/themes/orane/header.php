<?php
/**
 *  The Header for Orane
 *	Display the head section and eveerything up to the end of <div class="nav_wrapper">
 *
 * @package WordPress
 * @subpackage Orane
 * @since 1.0
 */
	//global variables that carries all the theme options
	global $redux_orane;
	$favicon = $redux_orane['orane-favicon-image'];
	$main_logo = $redux_orane['orane-logo-image']['url'];
	$second_logo = $redux_orane['orane-logo-image-2']['url'];
	$theme_colors = $redux_orane['orane-bgcolor-scheme'];
	$show_progress = $redux_orane['orane-show-progressbar'];
	$show_menu_search = $redux_orane['orane-show-menu-search'];
	$loading_bg_img = $redux_orane['orane-loading-bgimage']['url'];


	$sitelogo = $main_logo;

	//default logo is the primary one
	$logo_primary = true;
	if($main_logo == ""){
		//if the primary logo is not set then use the secondary one
		$sitelogo = $second_logo;
		$logo_primary = false;
	}

?><!DOCTYPE html>
<!--[if lt IE 7 ]>
<html class="ie ie6" <?php language_attributes(); ?>> 
<![endif]-->
<!--[if IE 7 ]>
<html class="ie ie7" <?php language_attributes(); ?>> 
<![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8" <?php language_attributes(); ?>> 
<![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
	<head>
		<meta charset="<?php echo esc_url(bloginfo( 'charset' )); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<link rel="pingback" href="<?php esc_url(bloginfo( 'pingback_url' )); ?>">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="shortcut icon" type="image/png" href="<?php echo esc_url($favicon['url']); ?>"/>
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!--[if lt IE 9]>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
		<![endif]-->

		<?php wp_head(); ?>
	</head>



<?php  

	$bgpattern = esc_attr($redux_orane['orane-bg-pattern']);
	$showpat = esc_attr($redux_orane['orane-bg-pattern-show']);
	$show_loading_logo = esc_attr($redux_orane['orane-show-loading-logo']);

	if($showpat == 0){
		$bgpattern = "";
	}

?>
<body <?php body_class($bgpattern); ?> > 


	
		<!-- is preloader enabled -->
		<?php if($show_progress == 1){ ?>	
			<!-- PRELOADER -->
				<div id="preloader" style="background:url('<?php echo $loading_bg_img; ?>') no-repeat scroll 0 0 / cover  #fff;">
					<div class="preloader-container">
						<div class="pre-circle">
							<p><?php _e("Loading", "orane"); ?></p>
							<span class="rotate double"></span>


					<?php if($show_loading_logo == 1){ ?>
						<div class="pre-logo">
							<img src="<?php echo esc_url($sitelogo); ?>" alt="LOGO" />
						</div>
					<?php } ?>	
						</div>
					</div>
				</div>
			<!-- END PRELOADER -->
		<?php } ?>	



		<!--    top contact / socialbar   -->
<?php  

	$boxed = $redux_orane['orane-box-full'];
	$show_cart = $redux_orane['orane-topbar-show-cart'];
	$top_email = $redux_orane['orane-topbar-email'];
	$top_phone = $redux_orane['orane-topbar-phone'];
	$top_skype = $redux_orane['orane-topbar-skype'];

?>



<?php 

$addclass = "";
if( $boxed == 2 ){ 
	$addclass = "boxed-wrap";	
}

?>

<div class="full-wrap <?php echo sanitize_html_class($addclass); ?>">
		<header>

				<?php  

							$cart_url = "";
							if ( class_exists( 'WooCommerce' ) ) {
								global $woocommerce;

									$cart_url = $woocommerce->cart->get_cart_url();

							}

							$show_top_bar = $redux_orane['orane-header-show'];
							$show_top_bar = esc_attr( $show_top_bar );
							$show_top_social = $redux_orane['orane-show-top-social'];
							$show_top_social = esc_attr( $show_top_social );
							$fb_link = $redux_orane['orane-social-fb'];
							$fb_link = esc_url($fb_link);
							$tw_link = $redux_orane['orane-social-tw'];
							$tw_link = esc_url($tw_link);
							$gp_link = $redux_orane['orane-social-gp'];
							$tw_link = esc_url($tw_link);
							$yt_link = $redux_orane['orane-social-yt'];
							$tw_link = esc_url($tw_link);
							$li_link = $redux_orane['orane-social-li'];
							$tw_link = esc_url($tw_link);
							$dr_link = $redux_orane['orane-social-dr'];
							$tw_link = esc_url($tw_link);
							$red_link = $redux_orane['orane-social-red'];
							$tw_link = esc_url($tw_link);
							$ins_link = $redux_orane['orane-social-insta'];
							$ins_link = esc_url($ins_link);
							$pin_link = $redux_orane['orane-social-pin'];
							$pin_link = esc_url($pin_link);

				?>



			<?php if($show_top_bar == 1){ ?>

			<div class="top-bar">
				<div class="container">
					<div class='col-md-6 top-info'>
						<?php if($show_cart == 1){ ?>
							<a class='top-bar-text topbar-shopping-cart' href='<?php echo esc_url($cart_url); ?>'>
								<i class='fa fa-shopping-cart'></i>
							</a>
						<?php } ?>

						<?php if(!empty($top_email)){ ?>
						<i class="fa fa-envelope"></i>
						<span class="top-bar-text"><a href="mailto:<?php echo sanitize_email($top_email); ?>"><?php echo sanitize_email($top_email); ?></a></span>
						<?php } ?>

						<?php if(!empty($top_phone)){ ?>
						<i class="fa fa-mobile fa-lg"></i>
						<span class="top-bar-text"><a href='skype:<?php echo esc_attr($top_phone); ?>?call'><?php echo esc_attr($top_phone); ?></a></span>
						<?php } ?>

						<?php if(!empty($top_skype)){ ?>
						<i class="fa fa-skype fa-lg"></i>
						<span class="top-bar-text"><a href='skype:<?php echo esc_attr($top_skype); ?>?call'><?php echo esc_attr($top_skype); ?></a></span>
						<?php } ?>	



					</div>


					<?php if($show_top_social == 1){ ?>
					<div class='col-md-6'>
						<ul class='top-socials'>
							<?php if($fb_link != "")  { ?><li><a href='<?php echo esc_url($fb_link); ?>' target="_blank"><i class='fa fa-facebook'></i></a></li> <?php } ?>
							<?php if($tw_link != "")  { ?><li><a href='<?php echo esc_url($tw_link); ?>' target="_blank"><i class='fa fa-twitter'></i></a></li> <?php } ?>
							<?php if($gp_link != "")  { ?><li><a href='<?php echo esc_url($gp_link); ?>' target="_blank"><i class='fa fa-google-plus'></i></a></li><?php } ?>
							<?php if($yt_link != "")  { ?><li><a href='<?php echo esc_url($yt_link); ?>' target="_blank"><i class='fa fa-youtube'></i></a></li><?php } ?>
							<?php if($dr_link != "")  { ?><li><a href='<?php echo esc_url($dr_link); ?>' target="_blank"><i class='fa fa-dribbble'></i></a></li><?php } ?>
							<?php if($li_link != "")  { ?><li><a href='<?php echo esc_url($li_link); ?>' target="_blank"><i class='fa fa-linkedin'></i></a></li><?php } ?>
							<?php if($red_link != "") { ?><li><a href='<?php echo esc_url($red_link); ?>' target="_blank"><i class='fa fa-reddit'></i></a></li><?php } ?>
							<?php if($ins_link != "") { ?><li><a href='<?php echo esc_url($ins_link); ?>' target="_blank"><i class='fa fa-instagram'></i></a></li><?php } ?>
							<?php if($pin_link != "") { ?><li><a href='<?php echo esc_url($pin_link); ?>' target="_blank"><i class='fa fa-pinterest'></i></a></li><?php } ?>
						</ul>
					</div>

					<?php } ?>
				</div>
			</div>
			<?php } ?>
		<!--End Home-->


		</header>
		<!--  /end  top contact / socialbar   -->
		<!-- top navigation starts -->
		<div class="nav_wrapper">
		<nav class="navbar navbar-default" role="navigation">
		  <div class="container container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only"><?php _e("Toggle navigation", "orane"); ?></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			<?php if($logo_primary){ ?>	
			  <a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>">
			<?php }else{ ?>  
			  <a class="navbar-brand-secondary" href="<?php echo esc_url( home_url() ); ?>">
			<?php } ?>  
				<img src='<?php echo esc_url($sitelogo); ?>' alt="LOGO">
			  </a>
			</div>


			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			  	<?php 

				  if ( has_nav_menu( 'top-menu' ) ) {
					  	wp_nav_menu(
					  			array( 
					  			'theme_location' => 'top-menu', 
					  			'container_class' => '', 
					  			'menu_class'=> 'nav navbar-nav navbar-right'
					  			) 
					  	);
				  }


			  	?>



											
				<?php if($show_menu_search == 1){ ?>
					<!-- the search form inside the navigation menu -->
					<div class="sr">
						<form action="<?php echo esc_url( home_url() ); ?>">
						<input id="search" name="s" type="text" placeholder="<?php _e("What're you looking for ?", "orane"); ?>">
						<input id="search_submit" value="Search" type="submit">
						</form>
					</div>
				<?php } ?>
	


			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->

		</nav>
		</div>
		<!-- /ends top navigation -->

<!-- header.php ends here -->