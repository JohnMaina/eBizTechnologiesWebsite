jQuery.noConflict();
(function( $ ) {
jQuery(document).ready( function($) {

	 "use strict";

/* ==============================================
	3D Testimonial Slider
=============================================== */	
//check if gallery plugin is loaded
if(jQuery().gallery) {
		$('#dg-container').gallery({

			current     : 0,   
			// index of current item
			autoplay    : true,
			// slideshow on / off
			interval    : 3000 
			// time between transitions
		});

}//ends if block

	
$('.price-margin-1').closest('.vc_row.wpb_row.vc_row-fluid').removeClass().addClass("price-table").addClass("container");



/* ==============================================
	Pie Charts
=============================================== */		

//if easypiechart plugin is activated
if(jQuery().easyPieChart) {
			$('#pie-charts').waypoint(function(direction) {			

				$('.chart').easyPieChart({

					barColor: orane_var.color,

					onStep: function(from, to, percent) {

						$(this.el).find('.percent').text(Math.round(percent));

					}

				});

				}, {

				offset: function() {

					return $.waypoints('viewportHeight') - $(this).height() + 200;

				}

			});

}//ends if block





	switch_style.onReady();

	//3D testimonials social links
	$('.qt').find('.fa-lg').on('click', function(){
		var link = $(this).attr('data-url');
		window.open(link,'_blank');
	});

	//3D testimonials personal links
	$('.qt').find('.name').on('click', function(){
		var link = $(this).attr('data-url');
		window.open(link,'_blank');
	});


/* ==============================================
	Takes you to the top of the page
=============================================== */
	$().UItoTop({ easingType: 'easeOutQuart' });







//hiding horizontal bar
	javascript:void(document.body.style.setProperty('overflow-x','hidden',''));	



//check if isotope is loaded
if(jQuery().isotope) {

///////////// isotope portfolio
		var $container = $('#isoport');
		// init
		    var margin = 0,
		    colWidth = function () {
		        var w = $container.width(), 
		            columnNum   = 1,
		            columnWidth = 0;

					if (w > 1600) {
						columnNum  = 6;
					}else if (w > 1200) {
						columnNum  = 5;
					} else if (w > 900) {
						columnNum  = 4;
					} else if (w > 600) {
						columnNum  = 3;
					} else if (w > 500) {
						columnNum  = 2;
					}else if (w > 300) {
						columnNum  = 2;
					} 			

		        columnWidth = Math.floor(w/columnNum);
		        $container.find('.port_item').each(function() {

		            $(this).css({
		                width: columnWidth - margin,
		            });
		        });

		        return columnWidth;
		    },

		    isotope = function () {

		        $container.isotope({
		            resizable: false,
		            itemSelector: '.port_item',
		            masonry: {
		                columnWidth: colWidth(),
		                gutterWidth: margin
		            }
		        });
		    };
		isotope();
		$(window).on('debouncedresize', isotope);

}//ends if block
////////////////////////////////////////////////////








//check if isotope is loaded
if(jQuery().isotope) {

///////////// latest blog portfolio
var $container2 = $('#grid-latest-blog ul');



// init



    var margin2 = 0,



    colWidth2 = function () {



        var w = $container2.width(), 



            columnNum   = 3,



            columnWidth = 0;



			if (w > 1600) {



				columnNum  = 3;



			}else if (w > 1200) {



				columnNum  = 3;



			} else if (w > 900) {



				columnNum  = 3;



			} else if (w > 600) {



				columnNum  = 2;



			} else if (w > 500) {



				columnNum  = 2;



			} else if (w > 300) {



				columnNum  = 1;



			}        



			columnWidth = Math.floor(w/columnNum);



        $container2.find('li').each(function() {



            $(this).css({



                width: columnWidth - margin2,



            });



        });



        return columnWidth;



    },



    isotope2 = function () {



        $container2.isotope({



            resizable: false,



            itemSelector: 'li.latest-blog-item',



            masonry: {



				 	  columnWidth: '.grid-sizer',



				      gutter: '.gutter-sizer',



            }



        });



    };







isotope2();



$(window).on('debouncedresize', isotope2);


}//ends if block
////////////////////////////////////////////////////













//check if isotope is loaded
if(jQuery().isotope) {

///////////// latest blog portfolio
var $container3 = $('.shop-2 ul.products');



// init



    var margin3 = 20,



    colWidth3 = function () {



        var w = $container3.width(), 



            columnNum   = 4,



            columnWidth = 0;



			if (w > 1600) {



				columnNum  = 4;



			}else if (w > 1200) {



				columnNum  = 4;



			} else if (w > 1000) {



				columnNum  = 4;



			} else if (w > 900) {



				columnNum  = 3;



			} else if (w > 600) {



				columnNum  = 3;



			} else if (w > 500) {



				columnNum  = 2;



			} else if (w > 400) {



				columnNum  = 2;



			} else if (w > 300) {



				columnNum  = 1;



			} else if (w > 100) {



				columnNum  = 1;



			}       



			columnWidth = Math.floor(w/columnNum);



        $container3.find('li').each(function() {



            $(this).css({



                width: columnWidth - margin3,



            });



        });



        return columnWidth;



    },



    isotope3 = function () {



        $container3.isotope({



            resizable: false,



            itemSelector: 'li.product',



            masonry: {



                columnWidth: colWidth3(),



                gutterWidth: margin3



            }



        });



    };







isotope3();



$(window).on('debouncedresize', isotope3);

}//ends if block
////////////////////////////////////////////////////






//check if isotope is loaded
if(jQuery().isotope) {

///////////// related products
var $container4 = $('.related ul.products');



// init



    var margin4 = 20,



    colWidth4 = function () {



        var w = $container4.width(), 



            columnNum   = 4,



            columnWidth = 0;



			if (w > 1600) {



				columnNum  = 4;



			}else if (w > 1200) {



				columnNum  = 4;



			} else if (w > 1000) {



				columnNum  = 4;



			} else if (w > 900) {



				columnNum  = 3;



			} else if (w > 600) {



				columnNum  = 3;



			} else if (w > 500) {



				columnNum  = 2;



			} else if (w > 400) {



				columnNum  = 2;



			} else if (w > 300) {



				columnNum  = 1;



			} else if (w > 100) {



				columnNum  = 1;



			}       



			columnWidth = Math.floor(w/columnNum);



        $container4.find('li').each(function() {



            $(this).css({



                width: columnWidth - margin4,



            });



        });



        return columnWidth;



    },



    isotope4 = function () {



        $container4.isotope({



            resizable: false,



            itemSelector: 'li.product',



            layoutMode: 'fitRows',



            masonry: {



                columnWidth: colWidth4(),



                gutterWidth: margin4



            }



        });



    };







isotope4();



$(window).on('debouncedresize', isotope4);


}//ends if block
////////////////////////////////////////////////////

















//check if isotope is loaded
if(jQuery().isotope) {

/////////////related products
var $container5 = $('.orane-portfolio-full');



// init



    var margin5 = 0,



    colWidth5 = function () {



        var w = $container5.width(), 



            columnNum   = 5,



            columnWidth = 0;



			if (w > 1600) {



				columnNum  = 5;



			}else if (w > 1200) {



				columnNum  = 5;



			} else if (w > 1000) {



				columnNum  = 4;



			} else if (w > 900) {



				columnNum  = 3;



			} else if (w > 600) {



				columnNum  = 3;



			} else if (w > 500) {



				columnNum  = 2;



			} else if (w > 400) {



				columnNum  = 2;



			} else if (w > 300) {



				columnNum  = 1;



			} else if (w > 100) {



				columnNum  = 1;



			}       



		columnWidth = Math.floor(w/columnNum);



        $container5.find('div').each(function() {



            $(this).css({



                width: columnWidth - margin5,



            });



        });



        return columnWidth;



    },



    isotope5 = function () {



        $container5.isotope({



            resizable: false,



            itemSelector: '.port_item',



            layoutMode: 'fitRows',



            masonry: {



                columnWidth: colWidth5(),



                gutterWidth: margin5



            }



        });



    };



isotope5();



$(window).on('debouncedresize', isotope5);


}//ends if block
////////////////////////////////////////////////////











///gallery filters
$('.port-filter').on( 'click', 'a', function(e) {

	e.preventDefault();
	$(".port-filter").find("a.active").removeClass("active");
	$(this).addClass("active");
  	var filterValue = $(this).attr('data-filter');

  	//check if isotope is loaded
	if(jQuery().isotope) {
	  	$container5.isotope({ filter: filterValue });
	}


});
//end of isotope stuff





//check if magnificpopup is loaded
if(jQuery().magnificPopup) {

	//magnific popup init
	$('#isoport').magnificPopup({

		type:'image',
		delegate: 'a.itemzoom_outer',

		 gallery: {
		    enabled: true
		  }

	});

}



//check if magnificpopup is loaded
if(jQuery().magnificPopup) {

	//magnific popup init
	$('#isoport').magnificPopup({

		type:'image',
		delegate: '.port_item  a.itemzoom',
		 gallery: {
		    enabled: true
		  }

	});

}


//check if magnificpopup is loaded
if(jQuery().magnificPopup) {

	//magnific popup init
	$('.orane-portfolio-full').magnificPopup({
		type:'image',
		delegate: '.port_item  a.itemzoom',
		 gallery: {
		    enabled: true
		  }

	});
}



//tiny tweeks, default widgets string display fix

  $('.orane-sidebar ul li a').each(function(i){



  		$(this).html( $(this).html().replace(/\|/g,'') );



  });













//if elevateZoom library is loaded
if(jQuery().elevateZoom) {
//zoom library
		$("#zoom_02").elevateZoom({gallery:'gal1', cursor: 'pointer', galleryActiveClass: 'active', responsive:true, });
		$('.thumbs ul li:first a').addClass('active');
}



			//hiding horizontal bar



		javascript:void(document.body.style.setProperty('overflow-x','hidden',''));	



















//////////google maps



//dont try to init google maps where not needed


if (typeof orane_map !== 'undefined') {











			$('.map-h').gMap({



				controls: {



					panControl: false,



					zoomControl: true,



					mapTypeControl: true,



					scaleControl: false,



					streetViewControl: false,



					overviewMapControl: false



				},



				address: orane_map.gmap_address,



				zoom: parseInt(orane_map.gmap_zoom),



				markers:[



					{



						address: orane_map.gmap_address,



						html: orane_map.gmap_title,



						popup: true



					}



				]



			});







}







//////ends google map



























});//end of jquery ready



})( jQuery );











		function subtractQty(){



			if(document.getElementById("qty").value - 1 < 0)



				return;



			else



				 document.getElementById("qty").value--;



		}































function isThisTouchDevice(){







	var deviceAgent = navigator.userAgent.toLowerCase();



	var isTouchDevice = Modernizr.touch || 



	(deviceAgent.match(/(iphone|ipod|ipad)/) ||



	deviceAgent.match(/(android)/)  || 



	deviceAgent.match(/(iemobile)/) || 



	deviceAgent.match(/iphone/i) || 



	deviceAgent.match(/ipad/i) || 



	deviceAgent.match(/ipod/i) || 



	deviceAgent.match(/blackberry/i) || 



	deviceAgent.match(/bada/i));



	return isTouchDevice;



}



















/////just for demo, commented otherwise



				(function ($j) {







				  switch_style = {







				    onReady: function () {      



				      this.switch_style_click();



				    },



				    



				    switch_style_click: function(){



				    	$j(".color-styles li a").click(function(e){



				    		e.preventDefault();



				    		var id = $j(this).attr("href");



				    		$j("#css_switcher").attr("href", "http://redhawk-studio.com/themes/orane_demo/wp-content/themes/Orane/css/" + id + ".css");    		
				    		$j("#css_switcher2").attr("href", "http://redhawk-studio.com/themes/orane_demo/wp-content/themes/Orane/css/compile_" + id + ".css"); 
				    		// $j('.ideas').css('background-image', 'url(http://redhawk-studio.com/themes/orane_demo/wp-content/themes/Orane/images/px_'+id+'.jpg)');

				    		

				    	});



				    },



				  };







				})(jQuery);



/////////////////////////////////				