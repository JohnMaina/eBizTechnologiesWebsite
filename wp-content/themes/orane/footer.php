		<?php 



			clientsFooter();

							global $redux_orane;
							$fb_link =  $redux_orane['orane-social-fb'];
							$tw_link =  $redux_orane['orane-social-tw'];
							$gp_link =  $redux_orane['orane-social-gp'];							
							$yt_link =  $redux_orane['orane-social-yt'];							
							$li_link =  $redux_orane['orane-social-li'];							
							$dr_link =  $redux_orane['orane-social-dr'];							
							$red_link =  $redux_orane['orane-social-red'];
							$ins_link = $redux_orane['orane-social-insta'];							
							$skype_link = $redux_orane['orane-social-skype'];	
							$show_social = $redux_orane['orane-show-bottom-social'];
							$pin_link = $redux_orane['orane-social-pin'];

							$footer_bg_img = $redux_orane['orane-footer-bgimage']['url'];

							//number of columns in the footer
							$num_cols = esc_attr($redux_orane['orane-footer-columns']);
							$num_total = $num_cols;
							//the class name col-md-xx
							$num_cols = 12/$num_cols;


?>


	<?php if(esc_attr($show_social == 1)){ ?>
		<section class="social-bar">
			<div class="container">
				<div class="col-md-12 social-icons">

					<?php if($fb_link != "")  { ?>
						<a href="<?php echo esc_url($fb_link); ?>"><i class="fa fa-facebook fa-2x"></i></a>
					<?php } ?>
					
					<?php if($skype_link != "")  { ?>
					<a href="<?php echo esc_attr($skype_link); ?>"><i class="fa fa-skype fa-2x"></i></a>
					<?php } ?>
					
					<?php if($tw_link != "")  { ?>
					<a href="<?php echo esc_url($tw_link); ?>"><i class="fa fa-twitter fa-2x"></i></a>
					<?php } ?>

					<?php if($gp_link != "")  { ?>
					<a href="<?php echo esc_url($gp_link); ?>"><i class="fa fa-google-plus fa-2x"></i></a>
					<?php } ?>

					<?php if($li_link != "")  { ?>
					<a href="<?php echo esc_url($li_link); ?>"><i class="fa fa-linkedin fa-2x"></i></a>
					<?php } ?>

					<?php if($ins_link != "")  { ?>
					<a href="<?php echo esc_url($ins_link); ?>"><i class="fa fa-instagram fa-2x"></i></a>
					<?php } ?>

					<?php if($pin_link != "")  { ?>
					<a href="<?php echo esc_url($pin_link); ?>"><i class="fa fa-pinterest fa-2x"></i></a>
					<?php } ?>

					
					

				</div>
			</div>
		</section>
	<?php } ?>




<!-- update in version 1.0.2 -->
<?php if ( is_active_sidebar( 'orane_footer2' ) ) { ?>
		<footer style='background: url("<?php echo $footer_bg_img; ?>") no-repeat scroll 0 0 / cover  #333'>
			<div class="container">


			<!-- footer widget column 1 -->
			<div class='<?php echo sanitize_html_class("col-md-" . $num_cols); ?> side-gap'>
			<?php 
				if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('orane_footer1') ) :
			    endif; 
			?>
			</div>	
			
			<?php if($num_total > 1){ ?>
			<!-- footer widget column 2 -->
			<div class='<?php echo sanitize_html_class("col-md-" . $num_cols); ?> side-gap'>
			<?php 
				if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('orane_footer2') ) :
			    endif; 
			?>
			</div>	
			<?php } ?>


			<?php if($num_total > 2){ ?>
			<!-- footer widget column 3 -->
			<div class='<?php echo sanitize_html_class("col-md-" . $num_cols); ?> side-gap'>
			<?php 
				if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('orane_footer3') ) :
			    endif; 
			?>
			</div>	
			<?php } ?>

			

			<?php if($num_total > 3){ ?>
			<!-- footer widget column 4 -->
			<div class='<?php echo sanitize_html_class("col-md-" . $num_cols); ?> side-gap'>
			<?php 
				if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('orane_footer4') ) :
			    endif; 
			?>
			</div>	
			<?php } ?>

			
	

			</div>
			<!-- /ends container -->
		</footer>
<?php } ?>
<!-- / ends update in version 1.0.2 -->

		<!-- /ends footer -->


		<!-- bottom bar (all rights, powered by etc...) -->

		<?php  

			//codes are validated in redux already
			$jscode = $redux_orane['orane-editor-js'];
			$csscode = $redux_orane['orane-editor-css'];
			$show_bot_bar = esc_attr( $redux_orane['orane-footer-show'] );
			$theme_switch = esc_attr( $redux_orane['orane-bgcolor-scheme'] );
			$theme_color = esc_attr( $redux_orane['orane-color-scheme']);
			$theme_button = esc_attr( $redux_orane['orane-bgcolor-button']);
			$border_bottom = esc_attr( $redux_orane['orane-menu-current']);
			$border_color = esc_attr( $redux_orane['orane-icon-borders']);

			if($show_bot_bar == 1){
		?>



		<div class="bottom-bar">
			<div class="container">
				<div class="col-md-12">

					<div class='left'><?php echo wp_kses_post( orane_footer_shortcodes($redux_orane['orane-footer-left']) ); ?></div>

				  <div class='right'><?php echo wp_kses_post( orane_footer_shortcodes($redux_orane['orane-footer-right']) ); ?></div>

				</div>

			</div>

		</div>

		<?php
			}
		?>


<script type="text/javascript">
	<?php  
		echo esc_js($jscode);
	?>
</script>
</div>

<style>
	<?php  
		echo esc_attr($csscode);
	?>
</style>

<?php  
	$boxed = esc_attr( $redux_orane['orane-box-full'] );
?>

<?php wp_footer(); ?>
</body>
</html>