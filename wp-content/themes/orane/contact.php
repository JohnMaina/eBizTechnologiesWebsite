<?php



/*



Template Name: Contact Us



*/



get_header(); ?>



						<?php  



								global $post;

								global $redux_orane;



								$form_title = get_post_meta( $post->ID, '_contact_mb_form_title', true );



								$form_details = get_post_meta( $post->ID, '_contact_mb_form_details', true );

								



								$form_shortcode = get_post_meta( $post->ID, '_contact_mb_form_shortcode', true );

								





								//contact info



								$info_title = get_post_meta( $post->ID, '_contact_info_mb_form_title', true );

								



								$info_details = get_post_meta( $post->ID, '_contact_info_mb_form_details', true );

								



								$info_street = get_post_meta( $post->ID, '_contact_info_mb_street', true );

								



								// $info_state = get_post_meta( $post->ID, '_contact_info_state', true );



								$info_company = get_post_meta( $post->ID, '_contact_info_mb_company', true );

								



								$info_country = get_post_meta( $post->ID, '_contact_info_mb_country', true );

								



								$info_phone = get_post_meta( $post->ID, '_contact_info_mb_phone', true );

								



								$info_email = get_post_meta( $post->ID, '_contact_info_mb_email', true );
								$info_extras = get_post_meta( $post->ID, '_contact_info_mb_extras', true );
								
								$info_second_address_title = get_post_meta( $post->ID, '_contact_info_mb_second_title', true );
								$info_second_details = get_post_meta( $post->ID, '_contact_info_mb_extras2', true );





								$show_social = get_post_meta($post->ID, '_contact_info_mb_show_social_icons');

								



								$map_pos = get_post_meta($post->ID, '_contact_map_map_position');

								if(isset($map_pos[0])){
									$map_pos[0] = esc_attr($map_pos[0]);
								}
								


								$fb_link = $redux_orane['orane-social-fb'];
								



								$tw_link = $redux_orane['orane-social-tw'];

								



								$gp_link = $redux_orane['orane-social-gp'];

								



								$yt_link = $redux_orane['orane-social-yt'];

							



								$li_link = $redux_orane['orane-social-li'];

								



								$dr_link = $redux_orane['orane-social-dr'];

								



								$red_link = $redux_orane['orane-social-red'];

								



								$red_skype = $redux_orane['orane-social-skype'];

								



								



						?>






<?php if(isset($map_pos[0])){ ?>
<?php if($map_pos[0] == 'on'){ ?>



			<div class="map">



				<div class="map-h">



				</div>



			</div>



<?php } ?>			

<?php } ?>





		<!--Blog section-->



		<section class="contact">



			<div class="container">















				<div class="row">























								<div class="contact">



									<div class="container contact-info">



										<div class="col-md-7">



											<h2><?php echo esc_attr($form_title); ?></h2>



											<aside class="sublines"><?php echo esc_attr( $form_details ); ?></aside>



										<?php  



											echo do_shortcode($form_shortcode);



										?>







										</div>



										



										<div class="col-md-5 info">



											<h2><?php echo esc_attr( $info_title ); ?></h2>



											<aside class="sublines"><?php echo esc_attr( $info_details ); ?></aside>



											<address>



											  <i class="fa fa-home fa-lg"></i><strong><?php echo esc_attr( $info_company ); ?></strong><br>



											     <span class="aside"><?php echo esc_attr( $info_street ); ?></span><br>



												<span class="aside"><?php echo esc_attr( $info_country ); ?></span><br>



											  <div class="phn"><i class="fa fa-phone fa-lg"></i><?php echo esc_attr( $info_phone ); ?></div>



											  <div class="phn"><i class="fa fa-envelope-o fa-lg"></i><?php echo esc_attr( $info_email ); ?></div>

											  <?php  
											  	$extras_string = "";
											  	$info_extras = explode("\n", $info_extras);
											  	foreach ($info_extras as $key => $value) {
											  		// $extras_string += "";
											  		//<i class="fa fa-envelope-o fa-lg"></i>
											  		$out = preg_replace("/\|(.+?)\|/", "<i class='fa $1'></i>", $value);
											  		$extras_string .= $out . "<br/>";

											  	}

											  ?>

											  <div class="phn"> <?php echo $extras_string; ?> </div>



											</address>



											











											<?php if( esc_attr( $show_social[0] ) == 'on'){ ?>







											<ul class="social-icons-2">



												<?php if(!empty($fb_link)) {?><li><a href="<?php echo esc_url( $fb_link ); ?>"><i class="fa fa-facebook fa-2x"></i></a></li><?php } ?>



												<?php if(!empty($red_skype)) {?><li><a href="<?php echo esc_url( $red_skype ); ?>"><i class="fa fa-skype fa-2x"></i></a></li><?php } ?>



												<?php if(!empty($gp_link)) {?><li><a href="<?php echo esc_url( $gp_link ); ?>"><i class="fa fa-google-plus fa-2x"></i></a></li><?php } ?>



												<?php if(!empty($tw_link)) {?><li><a href="<?php echo esc_url( $tw_link ); ?>"><i class="fa fa-twitter fa-2x"></i></a></li><?php } ?>



												<?php if(!empty($li_link)) {?><li><a href="<?php echo esc_url( $li_link ); ?>"><i class="fa fa-linkedin fa-2x"></i></a></li><?php } ?>



											</ul>



											<?php } ?>



											



										</div>


										<div class="col-md-5 info">

											<address>
											<h2><?php echo esc_attr( $info_second_address_title ); ?></h2>

											  <?php  
											  	//$info_second_details
											  	$extras_string = "";
											  	$info_extras = explode("\n", $info_second_details);
											  	foreach ($info_extras as $key => $value) {
											  		// $extras_string += "";
											  		//<i class="fa fa-envelope-o fa-lg"></i>
											  		$out = preg_replace("/\|(.+?)\|/", "<i class='fa $1'></i>", $value);
											  		$extras_string .= $out . "<br/>";

											  	}

											  ?>


											<div class="phn"><?php echo $extras_string; ?></div>
											</address>

										</div>





									</div>



								</div>











				</div>	



			</div>	



		</section>















<section <?php post_class("orane-contact"); ?> >



<?php if(have_posts()): while(have_posts()): the_post(); ?>



	



			<?php the_content(); ?>



			



<?php endwhile; ?>



<?php endif; ?>







</section>







<?php if(empty($map_pos)){ ?>



			<div class="map">



				<div class="map-h">



				</div>



			</div>



<?php } ?>



		











		



<?php get_footer(); ?>