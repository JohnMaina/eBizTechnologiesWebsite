<?php

// Require WPH_Widget Class

include_once( plugin_dir_path( __FILE__ ).'wph-widget-class.php' );



////////////////////////////////////////////////////////

	// About Widget
	class Orane_About_Widget extends WPH_Widget{

	
		function __construct(){

			// Configure widget array
			$args = array( 
				// Widget Backend label
				'label' => __( 'Orane - About', 'orane' ), 
				// Widget Backend Description								
				'description' => __( 'About Widget In The Footer', 'orane' ), 		
			 );

			// fields array
			$args['fields'] = array( 							

				// Title field
				array( 		
				// field name/label									
				'name' => __( 'Title', 'orane' ), 		
				// field description					
				'desc' => __( 'Enter The Widget Title.', 'orane' ), 
				// field id		
				'id' => 'title', 
				// field type ( text, checkbox, textarea, select, select-group )								
				'type'=>'text', 	
				// class, rows, cols								
				'class' => 'widefat', 	
				// default value						
				'std' => __( 'About', 'orane' ), 
				'validate' => 'alpha_dash', 
				'filter' => 'strip_tags|esc_attr'	
				 ), 

				array( 

					'name' => __( 'Details' , 'orane'), 							
					'desc' => __( 'The Details Under The Title', 'orane' ), 
					'id' => 'details', 							
					'type'=> 'textarea', 
					'class' => 'widefat', 				 
					'validate' => 'alpha_dash', 
					'filter' => 'strip_tags|esc_attr', 

				 ),

			 ); // fields array

			// create widget
			$this->create_widget( $args );

		}

		

		// Custom validation for this widget 
		function orane_validate( $value )
		{

			if ( strlen( $value ) > 1 )
				return false;
			else
				return true;
		}

	
		// Output function
		function widget( $args, $instance )
		{

			global $redux_orane;

			$logo2 = $redux_orane['orane-logo-image-alt'];
			$num_cols = esc_attr($redux_orane['orane-footer-columns']);
			$num_cols = 12/$num_cols;
			
			//sanitize
			$title = esc_attr($instance['title']);
			$details = esc_attr($instance['details']);
			
			echo "
					<h2>{$title}</h2>
					<p>{$details}</p>
					<div class='footer-logo'>
						<img src='".esc_url($logo2['url'])."' alt='Footer Logo'>
					</div>
				";

		}//end of function

	} // ends Class Orane_About_Widget

	//////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////

	// Text Widget
	class Orane_Text_Widget extends WPH_Widget{

	
		function __construct(){

			// Configure widget array
			$args = array( 
				// Widget Backend label
				'label' => __( 'Orane - Footer Text', 'orane' ), 
				// Widget Backend Description								
				'description' => __( 'Text Widget In The Footer', 'orane' ), 		
			 );

			// fields array
			$args['fields'] = array( 							

				// Title field
				array( 		
				// field name/label									
				'name' => __( 'Title', 'orane' ), 		
				// field description					
				'desc' => __( 'Enter The Widget Title.', 'orane' ), 
				// field id		
				'id' => 'title', 
				// field type ( text, checkbox, textarea, select, select-group )								
				'type'=>'text', 	
				// class, rows, cols								
				'class' => 'widefat', 	
				// default value						
				'std' => __( 'About', 'orane' ), 
				'validate' => 'alpha_dash', 
				'filter' => 'strip_tags|esc_attr'	
				 ), 

				array( 

					'name' => __( 'Details' , 'orane'), 							
					'desc' => __( 'The Details Under The Title', 'orane' ), 
					'id' => 'details', 							
					'type'=> 'textarea', 
					'class' => 'widefat', 				 
					'validate' => 'alpha_dash', 
					'filter' => 'strip_tags|esc_attr', 
				 ),

			 ); // fields array

			// create widget
			$this->create_widget( $args );

		}

		
		// Custom validation for this widget 
		function orane_validate( $value ){

			if ( strlen( $value ) > 1 )

				return false;

			else

				return true;

		}

		

		// Output function
		function widget( $args, $instance ){

			global $redux_orane;
			$logo2 = $redux_orane['orane-logo-image-alt'];
			$num_cols = esc_attr($redux_orane['orane-footer-columns']);
			$num_cols = 12/$num_cols;

			//sanitize
			$title = esc_attr($instance['title']);
			$details = esc_attr($instance['details']);


			echo "<div class='col-md-{$num_cols} side-gap'>

					<h2>{$title}</h2>

					<p>{$details}</p>

				</div>";



			//echo $out;

		}//end of function

	

	} // ends Class Orane_Text_Widget

	//////////////////////////////////////////////////////////////

/////////////////////////////////latest blog widget

	class Orane_Latest_Blog_Widget extends WPH_Widget

	{

	

		function __construct()

		{

			// Configure widget array

			$args = array( 

				// Widget Backend label

				'label' => __( 'Orane - Latest Blog', 'orane' ), 

				// Widget Backend Description								

				'description' => __( 'Latest Blog Posts in Footer 2', 'orane' ), 		

			 );

		

			// fields array

			$args['fields'] = array( 							

			

				// Title field

				array( 		

				// field name/label									

				'name' => __( 'Title', 'orane' ), 		

				// field description					

				'desc' => __( 'Enter The Widget Title.', 'orane' ), 

				// field id		

				'id' => 'title', 

				// field type ( text, checkbox, textarea, select, select-group )								

				'type'=>'text', 	

				// class, rows, cols								

				'class' => 'widefat', 	

				// default value						

				'std' => __( 'LATEST BLOG POSTS', 'orane' ), 

				

				'validate' => 'alpha_dash', 

				

				'filter' => 'strip_tags|esc_attr'	

				 ), 





					// Amount Field

				array(

					'name' => __( 'Count' , 'orane'),

					'desc' => __( 'Select how many posts to show.', 'orane' ),

					'id' => 'amount',

					'type'=>'select',

					// selectbox fields

					'fields' => array(

				array(

					// option name

					'name' => __( '1 Post', 'orane' ),

					// option value

					'value' => '1'

				),

				array(

					'name' => __( '2 Posts', 'orane' ),

					'value' => '2'

				),

				array(

					'name' => __( '3 Posts', 'orane' ),

					'value' => '3'	

				)

				// add more options

				),

					'validate' => 'orane_validate',

					'filter' => 'strip_tags|esc_attr',

				),





			

			 ); // fields array



			// create widget

			$this->create_widget( $args );

		}

		

		// Custom validation for this widget 

		

		function orane_validate( $value )

		{

			if ( strlen( $value ) > 1 )

				return false;

			else

				return true;

		}

		

		// Output function



		function widget( $args, $instance )

		{

			global $redux_orane;
			$num_cols = esc_attr($redux_orane['orane-footer-columns']);
			$num_cols = 12/$num_cols;

			$title = esc_attr($instance['title']);

			$amount = $instance['amount'];



			$args = array( 'post_type' => 'post', 'posts_per_page' => esc_attr($amount) );

			$loop = new WP_Query( $args );


		

			echo "<div class='orane_footer_latest_blog'>

					<h2>{$title}</h2>";



			

			while ( $loop->have_posts() ) : $loop->the_post();

			$thumb = get_the_post_thumbnail(get_the_id(),'small-thumb') ;	
			$title = get_the_title();
			$title = orane_deleteTitleLine($title);
			$day = get_the_date("d");	
			$month = get_the_date("M");
			$link = esc_url( get_the_permalink() );
			$link = esc_url($link);
			$author = get_the_author();

			if($thumb == ""){
				$default_img = get_stylesheet_directory_uri() . "/images/square_70.gif";
				$thumb = "<img src='{$default_img}'>";
			}

			$short_title = (strlen($title) > 21) ? substr($title,0,18).'...' : $title;

			echo "<ul class='foot-post'>

					<li class='small-img'>
						<a href='{$link}'>{$thumb}</a>
					</li>

					<li class='date'>
						<div class='day'>
							{$day}
						</div>

						<div class='month'>
							{$month}
						</div>

					</li>

					<li class='post-title'>

						<a href='{$link}' class='title'>{$short_title}</a>
						<p class='author'> -By {$author}</p>

					</li>

					</ul>";

			endwhile;		

			echo "</div>";

			



		}//end of function

	

	} // ends Class Orane_Latest_blog

	//////////////////////////////////////////////////////////////













/////////////////////////////////Flickr Gallery Widget

	class Orane_Flickr_Gallery_Widget extends WPH_Widget

	{

	

		function __construct()

		{

			// Configure widget array

			$args = array( 

				// Widget Backend label

				'label' => __( 'Orane - Flikr Gallery', 'orane' ), 

				// Widget Backend Description								

				'description' => __( 'Flikr Gallery in Footer 2', 'orane' ), 		

			 );

		

			// fields array

			$args['fields'] = array( 							

			

				// Title field

				array( 		

					// field name/label									

					'name' => __( 'Title', 'orane' ), 		

					// field description					

					'desc' => __( 'Flickr Gallery in the footer', 'orane' ), 

					// field id		

					'id' => 'title', 

					// field type ( text, checkbox, textarea, select, select-group )								

					'type'=>'text', 	

					// class, rows, cols								

					'class' => 'widefat', 	

					// default value						

					'std' => __( 'Flickr Stream', 'orane' ), 

					

					'validate' => 'alpha_dash', 

					

					'filter' => 'strip_tags|esc_attr'	

				 ), 





					// Amount Field

				array(

					'name' => __( 'Count', 'orane' ),

					'desc' => __( 'Select how many posts to show.', 'orane' ),

					'id' => 'amount',

					'type'=>'select',

					// selectbox fields

					'fields' => array(

									array(

										'name' => __( '3 Images', 'orane' ),

										'value' => '3'

									),

									array(

										'name' => __( '6 Images', 'orane' ),

										'value' => '6'

									),

									array(

										'name' => __( '9 Images', 'orane' ),

										'value' => '9'	

									)

								// add more options

								),

					'validate' => 'orane_validate',

					'filter' => 'strip_tags|esc_attr',

				),







				array( 		

					// field name/label									

					'name' => __( 'Gallery URL', 'orane' ), 		

					// field description					

					'desc' => __( 'Flickr Gallery URL', 'orane' ), 

					// field id		

					'id' => 'url', 

					// field type ( text, checkbox, textarea, select, select-group )								

					'type'=>'text', 	

					// class, rows, cols								

					'class' => 'widefat', 	

					// default value						

					'std' => __( 'https://www.flickr.com/photos/flickr/galleries/72157648989290536/', 'orane' ), 

					

					'validate' => 'alpha_dash', 

					

					'filter' => 'strip_tags|esc_attr'	

				 ),









				array( 		

					// field name/label									

					'name' => __( 'Flickr Key', 'orane' ), 		

					// field description					

					'desc' => __( 'Get Your Flick Key: https://www.flickr.com/services/apps/create/apply/', 'orane' ), 

					// field id		

					'id' => 'key', 

					// field type ( text, checkbox, textarea, select, select-group )								

					'type'=>'text', 	

					// class, rows, cols								

					'class' => 'widefat', 	

					// default value						

					'std' => __( '4fcfa1814cbbba6355e1f4c85c8c7934', 'orane' ), 

					

					'validate' => 'alpha_dash', 

					

					'filter' => 'strip_tags|esc_attr'	

				 ),







			

			 ); // fields array



			// create widget

			$this->create_widget( $args );

		}

		

		// Custom validation for this widget 

		

		function orane_validate( $value )

		{

			if ( strlen( $value ) > 1 )

				return false;

			else

				return true;

		}

		

		// Output function



		function widget( $args, $instance )

		{



			if(!orane_check_internet_connection('www.flikr.com')){

				echo __("Couldnt Connect to the flickr network", "orane");

				return;

			}

			global $redux_orane;
			$num_cols = esc_attr($redux_orane['orane-footer-columns']);
			$num_cols = 12/$num_cols;



			//https://farm{farm-id}.staticflickr.com/{server-id}/{id}_{secret}_s.jpg

			$title = esc_attr($instance['title']);

			$amount = esc_attr($instance['amount']);

			$url = esc_url($instance['url']);

			$gall_url = $url;

			$key = esc_attr($instance['key']);



			if(trim($key) == ""){

					$key = "4fcfa1814cbbba6355e1f4c85c8c7934";

			}



			$url = urlencode($url);

			$fl_url = "https://api.flickr.com/services/rest/?method=flickr.urls.lookupGallery&api_key=" . $key . "&url=" . $url . "&format=json&nojsoncallback=1";

			$data = wp_remote_get($fl_url);



			if( is_wp_error($data) ){

				return;	

			}



			

			$data = json_decode($data['body'], true);

			

			//print_r($data);

			

			$gid = $data['gallery']['id'];



			$imgurl = "https://api.flickr.com/services/rest/?method=flickr.galleries.getPhotos&api_key=" . $key . "&gallery_id=" . $gid . "&per_page=6&page=1&format=json&nojsoncallback=1";

			

			$datag = wp_remote_get($imgurl);



			$datag = json_decode($datag['body'], true);

			

			$photos = $datag['photos']['photo'];



			echo "

					<h2>{$title}</h2>

					<ul class='flickr'>";



			$count = 0;

			foreach($photos as $in=>$photo){

					$count++;

					$pid = $photo['id'];

					$psecret = $photo['secret'];

					$pserver = $photo['server'];

					$pfarm = $photo['farm'];


					echo	"<li><a target='_blank' href='{$gall_url}'><img src='https://farm{$pfarm}.staticflickr.com/{$pserver}/{$pid}_{$psecret}_s.jpg' alt='' /></a></li>";

					

					if($count == $amount){

						break;

					}

			}


		

			echo	"</ul>";



		}//end of function

	

	} // ends Flikr Gallery Widget

	//////////////////////////////////////////////////////////////











/////////////////////////////////Contact Info Widget

	class Orane_Contact_Widget extends WPH_Widget

	{

	

		function __construct()

		{

			// Configure widget array

			$args = array( 

				// Widget Backend label

				'label' => __( 'Orane - Contact Info', 'orane' ), 

				// Widget Backend Description								

				'description' => __( 'Contact Info in Footer 2', 'orane' ), 		

			 );

		

			// fields array

			$args['fields'] = array(

					// Title field

					array( 		

					// field name/label									

					'name' => __( 'Title', 'orane' ), 		

					// field description					

					'desc' => __( 'Enter The Widget Title.', 'orane' ), 

					// field id		

					'id' => 'title', 

					// field type ( text, checkbox, textarea, select, select-group )								

					'type'=>'text', 	

					// class, rows, cols								

					'class' => 'widefat', 	

					// default value						

					'std' => __( 'CONTACT INFO', 'orane' ), 

					

					'validate' => 'alpha_dash', 

					

					'filter' => 'strip_tags|esc_attr'	

				 ), 

						

			

				// Title field

				array( 		

					// field name/label									

					'name' => __( 'Address', 'orane' ), 		

					// field description					

					'desc' => __( 'Address.', 'orane' ), 

					// field id		

					'id' => 'address', 

					// field type ( text, checkbox, textarea, select, select-group )								

					'type'=>'text', 	

					// class, rows, cols								

					'class' => 'widefat', 	

					// default value						

					'std' => __( 'Address: New Street 4204, Unknown Place, NY City, NY, USA', 'orane' ), 

					

					'validate' => 'alpha_dash', 

					

					'filter' => 'strip_tags|esc_attr'	

				 ), 



				// Title field

				array( 		

					// field name/label									

					'name' => __( 'Phone', 'orane' ), 		

					// field description					

					'desc' => __( 'Phone.', 'orane' ), 

					// field id		

					'id' => 'phone', 

					// field type ( text, checkbox, textarea, select, select-group )								

					'type'=>'text', 	

					// class, rows, cols								

					'class' => 'widefat', 	

					// default value						

					'std' => __( 'Phone: +00 41 587 9852', 'orane' ), 

					

					'validate' => 'alpha_dash', 

					

					'filter' => 'strip_tags|esc_attr'	

				 ), 







				// Title field

				array( 		

					// field name/label									

					'name' => __( 'Mail', 'orane' ), 		

					// field description					

					'desc' => __( 'Mail.', 'orane' ), 

					// field id		

					'id' => 'email', 

					// field type ( text, checkbox, textarea, select, select-group )								

					'type'=>'text', 	

					// class, rows, cols								

					'class' => 'widefat', 	

					// default value						

					'std' => __( 'Mail: info@business.com', 'orane' ), 

					

					'validate' => 'alpha_dash', 

					

					'filter' => 'strip_tags|esc_attr'	

				 ),









			

			 ); // fields array



			// create widget

			$this->create_widget( $args );

		}

		

		// Custom validation for this widget 

		

		function orane_validate( $value )

		{

			if ( strlen( $value ) > 1 )

				return false;

			else

				return true;

		}

		

		// Output function



		function widget( $args, $instance )

		{

			global $redux_orane;
			$num_cols = esc_attr($redux_orane['orane-footer-columns']);
			$num_cols = 12/$num_cols;
			

			$img = esc_url( get_template_directory_uri() ) . "/images/footer-map.png";

			$title = esc_attr($instance['title']);

			$address = esc_attr($instance['address']);

			$phone = esc_attr($instance['phone']);

			$email = esc_attr($instance['email']);

			$address_encoded = urlencode($address);

			echo "

					<h2>{$title}</h2>

					

					<img src='{$img}' alt='' />

					

					<ul class='address'>

						<li><i class='fa fa-home '></i>   <a target='_blank' href='https://www.google.com/maps/place/{$address_encoded}'>{$address}</a></li>

						<li><i class='fa fa-phone '></i>  <a href='skype:{$phone}?call'>{$phone}</a></li>

						<li><i class='fa fa-send '></i>   <a href='mailto:{$email}'>{$email}</a></li>

					</ul>";





		}//end of function

	

	} // ends Orane_Contact_Widget

	//////////////////////////////////////////////////////////////







	// Register widget

	if ( ! function_exists( 'orane_register_widget' ) )

	{

		function orane_register_widget()

		{

			//register_widget( 'Orane_clients_Widget' );

			register_widget( 'Orane_About_Widget' );

			register_widget( 'Orane_Latest_Blog_Widget' );

			register_widget( 'Orane_Flickr_Gallery_Widget' );

			register_widget( 'Orane_Contact_Widget' );

			register_widget('Orane_Text_Widget');

			// register_widget('Orane_Links_Widget');
		}

		

		add_action( 'widgets_init', 'orane_register_widget', 1 );

	}





