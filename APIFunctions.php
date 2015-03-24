<?php

function addIntroText($parameters){
	return $introHTML = '
		<div class="intro-copy">
			<p>'.$parameters['intro_text'].'</p>
		</div>';
}

function introPanel($parameters){
	return $introPanel ='<a href="http://images.laterooms.com/en/promo/hotel-voucher.html">
							<img src="../LP_test/uploads/hero_images/'.$parameters['banner'].'" alt="LATEROOMS.COM GIFT VOUCHER">
						</a>';
}

function headerSection($parameters){
	return $header = '
	<div class="template-container">
		<header class="header-container">
            <div id="mobile-header">
                    <img src="uploads/hero_images/'.$parameters['header_image'].'" alt="">
                </div>
                <div id="tablet-header">
                  <img src="uploads/hero_images//'.$parameters['header_image'].'" alt="">
                </div>
                <div id="desktop-header">
                  <img src="uploads/hero_images/'.$parameters['header_image'].'" alt="">
                </div>
         </header>
    </div>
	';
}

function createHotelResultRows($hoteldetails,$parameters){
	$count = 0;
	$row = '<div class="content-container">
				<div class="row">
					<!-- HOTEL ROW '.$count.' -->
					<div class="hotel-row">
					<div class="top-strip-panel">';
				
					if($parameters['template'] == 'deals-intro'){
						$intro = addIntroText($parameters);
						$row.=$intro ;
					}
					if($parameters['banner'] != ''){
						$banner = introPanel($parameters);
						$row.=$banner ;
					}
				$row.='</div>';


	foreach($hoteldetails as $key => $HD){
		$row.='
			<div class="grid">
				<a class="newlink" href="http://www.laterooms.com/en/hotel-reservations/'.$HD->id.'_'.$HD->url_slug.'.aspx" target="_blank">
			       	<div class="hotel-image">
			       		<img src="'.$HD->img.'" border="0">
			        		<!--div class="top-temptation">
			        			<p>Top Temptation</p>
			        		</div-->
			        </div>
			        <div class="hotel-name">'.$HD->name.'</div>
			        <div class="location">'.$HD->star_rating.'<span style="color:#FFCD1B;">&#9733;</span>&nbsp;&nbsp;'.$HD->location->city.'</div> 
			        <div class="saving">you save <span style="font-weight:600;">£XX</span></div>
			        <div class="rate">from <span style="font-weight:600; font-size:30px;">'.$HD->PriceBreakdown->PriceInUserCurrency->BasePrice.'</span></div>
			        <div class="was-rate">'.$HD->PriceBreakdown->PriceInUserCurrency->BasePrice.'</div>
			    </a>
			</div>';
			$count++;
		}
	    if($count == 3){
	    	$row.=' <div style="clear:both"></div></div></div>';
	    }
   
    return $row ;}

function createWeddingHotelResultRows($hoteldetails,$parameters){
	$count = 0;
	
	foreach($hoteldetails as $key => $HD){

	$picNumber = $key+1;

	$row.='<div class="uk-grid">
                <div class="uk-width-1-1 uk-width-medium-8-10">
					<div class="uk-grid">
						<div class="uk-width-1-1 uk-width-medium-4-10">
							<span class="picture_number">'.$picNumber.'</span>';
								$row.=createDeeplinkIntoWebsite($HD, $parameters);
								$row.='<img class="uk-width-1-1" src="'.$HD->img.'" alt="'.$HD->name.'">
								</a>
						</div>
						<div class="uk-width-1-1 uk-width-medium-6-10">
							<h2>';
								$row.=createDeeplinkIntoWebsite($HD, $parameters);
								$row.=$HD->name.' '.$HD->star_rating;
								$row.='<img src="images/star-medium.png" alt=""></a>
							</h2>
							<p>'.$HD->location->address .' '.$HD->location->city.' '.$HD->location->postcode.'</p>';

							if($HD->location->dist->m)	{
								$row .= '<p>'.$HD->location->dist->m.' miles from '.$parameters['keyword'].'</p>';
							}
							


							$row .= '<!--i class="uk-icon-wifi uk-icon-small"></i> <span>Wi-fi Available</span--> 
							</div>
						</div>
					</div>
				<div class="uk-width-1-1 uk-width-medium-2-10">
			<div class="customers-reviews">';

				$guest_rating = correctrating($HD->guest_rating);

					if($guest_rating == 1){
						$row .= '<i class="wordreviews">Poor</i><br/><img src="images/gr1.jpg" height="10" alt="'.$guest_rating.'/6" />';
					}else if($guest_rating == 2){
						$row .= '<i class="wordreviews">Not Good</i><br/><img src="images/gr2.jpg" height="10" alt="'.$guest_rating.'/6" />';
					}else if($guest_rating == 3){
						$row .= '<i class="wordreviews">Average</i><br/><img src="images/gr3.jpg" height="10" alt="'.$guest_rating.'/6" />';
					}else if($guest_rating == 4){
						$row .= '<i class="wordreviews">Good!</i><br/><img src="images/gr4.jpg" height="10" alt="'.$guest_rating.'/6" />';
					}else if($guest_rating == 5){
						$row .= '<i class="wordreviews">Excellent</i><br/><img src="images/gr5.jpg" height="10" alt="'.$guest_rating.'/6" />';
					}else if($guest_rating == 6){
						$row .= '<i class="wordreviews">Fabulous</i><br/><img src="images/gr6.jpg" height="10" alt="'.$guest_rating.'/6" />';
					}else{
						$row .= 'N/A';
						}
						
				$row .= '<br/>
				<span>customers rating</span>
			</div>
			<div class="rate-container">
				<div class="from-rate">
					<div class="pad">
						<p class="from">
							<span>Prices from </span>';



							$row.=createDeeplinkIntoWebsite($HD, $parameters);
							$row.='&pound;'.$HD->PriceBreakdown->PriceInUserCurrency->Total.'</a>
						</p>
					</div>
				</div>									
			</div>';
				$row.=createDeeplinkIntoWebsite($HD, $parameters);
				$row.='<button class="uk-button">Book now</button></a>
			</div>
                </div>
          <hr class="uk-grid-divider">';
	}
    return $row ;
}

function displayLowerAdverts($parameters){

	if($parameters['ad2'] ==''){

		$ads = '<div class="panels-bottom-container">
					<div class="panel-left">
	    				<a href="http://blog.laterooms.com/2013/01/top-romantic-breaks-around-britains-coast/">
	       					<img src="../LP_test/uploads/hero_images/'.$parameters['ad1'].'" width="" alt="">
	       				</a>
	    			</div>
					<div class="panel-left-mobile">
						<a href="http://blog.laterooms.com/2013/01/top-romantic-breaks-around-britains-coast/">
							<img src="../LP_test/uploads/hero_images/'.$parameters['ad1'].'" width="100%" alt="">
						</a>
					</div>
				</div>';
	}else{

		$ads = '<div class="panels-bottom-container">
	       			<div class="panel-left">
	       				<a href="http://blog.laterooms.com/2013/01/top-romantic-breaks-around-britains-coast/">
	       					<img src="../LP_test/uploads/hero_images/'.$parameters['ad1'].'" width="" alt="">
	       				</a>
	       			</div>
	       			<div class="panel-left-mobile">
						<a href="http://blog.laterooms.com/2013/01/top-romantic-breaks-around-britains-coast/">
							<img src="../LP_test/uploads/hero_images/'.$parameters['ad1'].'" width="100%" alt="">
						</a>
					</div>
	        		<div class="panel-right">
	        			<a href="http://blog.laterooms.com/2013/01/top-romantic-breaks-around-britains-coast/">
	        				<img src="../LP_test/uploads/hero_images/'.$parameters['ad2'].'" width="" alt="">
	        			</a>
	        		</div>
	        		<div class="panel-right-mobile">
						<a href="http://blog.laterooms.com/2013/01/top-romantic-breaks-around-britains-coast/">
							<img src="../LP_test/uploads/hero_images/'.$parameters['ad2'].'" width="100%" alt="">
						</a>
					</div>
	       		</div>';		
	}
   return $ads ;
   }

function hotelLNLs($hoteldetails){
	
	$hotelDistanceCount = 0;
	global $ZoomIndex ;

	foreach($hoteldetails as $key => $HD){

		$hotelDistanceCount = incrementDistanceCount($HD->location->dist->m, $hotelDistanceCount);
		$ZoomIndex = calculateZoonIndex($hotelDistanceCount);
		$latLongs[$key]['id']  = $HD->id;
		$latLongs[$key]['lat'] =  $HD->location->geopoint->lat;
		$latLongs[$key]['long']=  $HD->location->geopoint->long;
		
	}

	return $latLongs ;
}

function calculateZoonIndex($hotelDistanceCount){

		if($hotelDistanceCount < 5){
			$ZoomIndex = 12;
		}else if($hotelDistanceCount >= 10){
			$ZoomIndex = 14;
		}else{
			$ZoomIndex = 13;
		}
		return $ZoomIndex ;
}

function incrementDistanceCount($miles, $hotelDistanceCount){
	if($miles < 1){
		$hotelDistanceCount++;
	}

	return $hotelDistanceCount ;
}
function getFormattedStartDate($parameters){

	if(strtolower($parameters['brand']) =='laterooms.com'){

		$formattedStartDate 		= str_replace('-', '', $parameters['start_date']);
		$dateStringFormattedToBrand = 'd=' .$formattedStartDate ;

	}else{

		$startDateInSeconds 		= strtotime($parameters['start_date']);
		$one_day 					= 86400 ;
		$nightsInSeconds 			= $one_day * $parameters['nights'];
		$stayInSeconds 				= $startDateInSeconds + $nightsInSeconds;
		$endDate 					= date('Y-m-d', $stayInSeconds);
		$dateStringFormattedToBrand = 'arrivalDate=' . $parameters['start_date'] . '&departureDate='. $endDate ;
	}

	return $dateStringFormattedToBrand ;}

function uploadImage($value){
	$target_dir = "uploads/hero_images/";
	$target_file = $target_dir . basename($value["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		
	    $check = getimagesize($value["tmp_name"]);
	    if($check !== false) {
	        echo "<p>File is an image - " . $check["mime"] . ".</p>";
	        $uploadOk = 1;
	    } else {
	        echo "<p>File is not an image.</p>";
	        $uploadOk = 0;
	    }
	    
	// Check if file already exists
		if (file_exists($target_file)) {
		    echo "<p>Sorry, file already exists.</p>";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    echo "<p>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "<p>Sorry, your file was not uploaded.</p>";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($value["tmp_name"], $target_file)) {
		        echo "<p>The file ". basename( $value["name"]). " has been uploaded.</p>";
		    } else {
		        echo "<p>Sorry, there was an error uploading your file.</p>";
		    }
		}
	}}

function CSS($parameters){

	if($parameters['template'] == 'deals-tabbed'){

		$CSSAndPath = '

			<!-- UPDATE THE ABOVE SECTION TO content="noindex" FOR DUPLICATE PAGES -->

			<link rel="stylesheet" href="../LP_test/templates-code/templates-code/deals-tabbed/promo-links/deals-tabbed/css/laterooms_main.css">
			<!--[if lte IE 9]>
			<link rel="stylesheet" href="../LP_test/templates-code/templates-code/deals-tabbed/promo-links/deals-tabbed/css/laterooms_ie.css">
			<link rel="stylesheet" type="text/css" href="../LP_test/templates-code/templates-code/deals-tabbed/promo-links/deals-tabbed/css/grid-ie9.css" />
			<![endif]-->
			<link rel="stylesheet" href="../LP_test/templates-code/templates-code/deals-tabbed/promo-links/deals-tabbed/css/custom.css">
			        
			        
			<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
			<link rel="stylesheet" href="../LP_test/templates-code/templates-code/deals-tabbed/promo-links/deals-tabbed/css/grid.css">
			<link rel="stylesheet" href="../LP_test/templates-code/templates-code/deals-tabbed/promo-links/deals-tabbed/css/grid-max-767.css" media="screen and (max-width:767px)"/>
			<link rel="stylesheet" href="../LP_test/templates-code/templates-code/deals-tabbed/promo-links/deals-tabbed/css/grid-min-768-max-979.css" media="screen and (min-width:768px)"/>
			<link rel="stylesheet" href="../LP_test/templates-code/templates-code/deals-tabbed/promo-links/deals-tabbed/css/grid-min-980.css" media="screen and (min-width:980px)" />
			<!--[if IE]>  
			<link rel="stylesheet" type="text/css" href="../../promo-links/deals-tabbed/css/grid-ie.css" />
			<!--<![endif]-->';	

	}elseif($parameters['template'] == 'deals-intro'){

		$CSSAndPath = '
			<link rel="stylesheet" href="../LP_test/templates-code/templates-code/deals-intro/promo-links/deals-no-intro/css/laterooms_main.css">
		    <!--[if lte IE 9]>
		    <link rel="stylesheet" href="../LP_test/templates-code/templates-code/deals-intro/promo-links/deals-no-intro/css/laterooms_ie.css">
		    <link rel="stylesheet" type="text/css" href="templates-code/templates-code/deals-intro/promo-links/deals-no-intro/css/grid-ie9.css" />
		    <![endif]-->
		    <link rel="stylesheet" href="../LP_test/templates-code/templates-code/deals-intro/promo-links/deals-no-intro/css/custom.css">
		            
		            
		    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
		    <link rel="stylesheet" href="../LP_test/templates-code/templates-code/deals-intro/promo-links/deals-no-intro/css/grid.css">
		    <link rel="stylesheet" href="../LP_test/templates-code/templates-code/deals-intro/promo-links/deals-no-intro/css/grid-max-767.css" media="screen and (max-width:767px)"/>
		    <link rel="stylesheet" href="../LP_test/templates-code/templates-code/deals-intro/promo-links/deals-no-intro/css/grid-min-768-max-979.css" media="screen and (min-width:768px)"/>
		    <link rel="stylesheet" href="../LP_test/templates-code/templates-code/deals-intro/promo-links/deals-no-intro/css/grid-min-980.css" media="screen and (min-width:980px)" />
		    <!--[if IE]>  
		    <link rel="stylesheet" type="text/css" href="../LP_test/templates-code/templates-code/deals-intro/promo-links/deals-no-intro/css/grid-ie.css" />
		    <![endif]-->';

	}elseif($parameters['template'] == 'deals-no-intro'){


		$CSSAndPath = '
			<link rel="stylesheet" href="../LP_test/templates-code/templates-code/deals-no-intro/promo-links/deals-no-intro/css/laterooms_main.css">
			<!--[if lte IE 9]>
			<link rel="stylesheet" href="../LP_test/templates-code/templates-code/deals-no-intro/promo-links/deals-no-intro/css/laterooms_ie.css">
			<link rel="stylesheet" type="text/css" href="../../promo-links/deals-no-intro/css/grid-ie9.css" />
			<![endif]-->
			<link rel="stylesheet" href="../LP_test/templates-code/templates-code/deals-no-intro/promo-links/deals-no-intro/css/custom.css">
			        
			        
			<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
			<link rel="stylesheet" href="../LP_test/templates-code/templates-code/deals-no-intro/promo-links/deals-no-intro/css/grid.css">
			<link rel="stylesheet" href="../LP_test/templates-code/templates-code/deals-no-intro/promo-links/deals-no-intro/css/grid-max-767.css" media="screen and (max-width:767px)"/>
			<link rel="stylesheet" href="../LP_test/templates-code/templates-code/deals-no-intro/promo-links/deals-no-intro/css/grid-min-768-max-979.css" media="screen and (min-width:768px)"/>
			<link rel="stylesheet" href="../LP_test/templates-code/templates-code/deals-no-intro/promo-links/deals-no-intro/css/grid-min-980.css" media="screen and (min-width:980px)" />
			<!--[if IE]>  
			<link rel="stylesheet" type="text/css" href="../LP_test/templates-code/templates-code/deals-no-intro/promo-links/deals-no-intro/css/grid-ie.css" />
			<![endif]-->';

	}

	return $CSSAndPath ; }

function meta($parameters){
	return '
	<!doctype html>
	<!--[if lt IE 7]>      <html lang="en" class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
	<!--[if IE 7]>         <html lang="en" class="no-js lt-ie9 lt-ie8"><![endif]-->
	<!--[if IE 8]>         <html lang="en" class="no-js lt-ie9"><![endif]-->
	<!--[if IE 9]>         <html lang="en" class="no-js lt-ie10"><![endif]-->
	<!--[if gt IE 9]><!-->
	<html lang="en" class="no-js">
	<!--<![endif]-->
	<head>
	 <meta charset="UTF-8">
	   <title>'.$parameters['campaign'].'</title>
	 <meta name="Description" content="#"/>
	 <meta name="keywords" content="#" />
	 <!-- UPDATE THE BELOW SECTION TO content="noindex" FOR DUPLICATE PAGES -->
	<meta name="robots" content="index, follow" />
	<link rel="canonical" href="#"/>
	<!-- UPDATE THE ABOVE SECTION TO content="noindex" FOR DUPLICATE PAGES -->';}

function extras(){
	return '<!-- LATO -->
	<link href="http://fonts.googleapis.com/css?family=Lato:400,400italic,700,700italic" rel="stylesheet" type="text/css">
	<!--LATO-->

	<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.7.1/modernizr.min.js"></script>
	        <script>
	        window.Modernizr || document.write("<script src="/scripts/thirdparty/modernizr/modernizr.js">\x3C/script>");
	        </script>
	        
	<script type="text/javascript" src="http://images.laterooms.com/promo-links/responsive-template2/js/respond.min.js"></script>        
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	        
	<!--div-hover-->
	<script type="text/javascript">
	$(".grid").click(function(){
	window.location=$(this).find("a").attr("href");
	return false;
	});
	</script>
	<!--div-hover-->   

	<!--Intilery-->
	<script type="text/javascript">
	_gaq = [] || _gaq;window.INTILERY = {};INTILERY.gaq = [];(function($, _push) {_gaqPush = _push;$.push = function() {INTILERY.gaq.push(arguments[0]);return _gaqPush.apply(_gaq, arguments);}})(_gaq, _gaq.push);var _itq = _itq || [];
	_itq.push(["_setAccount", "38"]);
	(function(){
	var it = document.createElement("script"); it.type = "text/javascript"; it.async = true;
	it.src = ("https:" == document.location.protocol ? "https://" : "http://") + "laterooms.intilery-analytics.com/rest/it.js";
	var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(it, s);
	})();
	</script>
	<!--Intilery-end-->


	<!--Google analytics-->
	<script type="text/javascript">

	var _gaq = _gaq || [];
	var pluginUrl =
	"//www.google-analytics.com/plugins/ga/inpage_linkid.js";
	_gaq.push(["_require", "inpage_linkid", pluginUrl]);
	_gaq.push(["_setAccount", "UA-324587-1"]);
	_gaq.push(["_setDomainName", "laterooms.com"]);
	_gaq.push(["_trackPageview"]);

	(function() {
	var ga = document.createElement("script"); ga.type = "text/javascript"; ga.async = true;
	ga.src = ("https:" == document.location.protocol ? "https://ssl" : "http://www") + ".google-analytics.com/ga.js";
	var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ga, s);
	})();

	</script>
	<!--Google analytics-->     
	</head>


	    <body>
	    <section class="main">
	        <section class="header">
	            <div class="container">
	                <div class="menu"></div>
	               
	                    <a class="newlink" href="http://www.laterooms.com/en/main.aspx"><img src="../LP_test/templates-code/templates-code/deals-intro/promo-links/deals-no-intro/images/logox1.png" alt="LateRooms.com"></a>
	                
	                <nav class="identity-nav">
	                    <ul>
	                        <li>
	                            <a class="newlink" href="http://www.laterooms.com/en/MyAccount.mvc">My Account</a> <span>/</span> <a class="newlink" href="http://www.laterooms.com/en/MyAccountRegistration.mvc">Register</a>
	                        </li>
	                        <li>
	                            <a class="newlink" href="http://www.laterooms.com/en/ManageBooking.mvc">My Booking</a>
	                        </li>
	                    </ul>
	                </nav>
	                <nav class="main-nav">
	                    <ul>
	                        <li>
	                            <a class="newlink" target="_blank" href="http://www.laterooms.com/en/main.aspx" >Home</a>
	                        </li>
	                        <li>
	                            <a class="newlink" target="_blank" href="http://www.laterooms.com/en/Hotels.aspx" rel="nofollow">Search</a>
	                        </li>
	                        <li>
	                            <a class="newlink" href="http://www.laterooms.com/en/special-offers.mvc">Special Offers</a>
	                        </li>
	                        <li>
	                            <a class="newlink" href="http://www.laterooms.com/en/city-guides.aspx">City Guides</a>
	                        </li>
	                        <li>
	                            <a class="newlink" href="http://www.laterooms.com/en/business-hotel-booking-services.aspx" rel="nofollow">Corporate</a>
	                        </li>
	                        <li class="dd">
	                            About Us
	                            <ul>
	                                <li><a class="newlink" href="http://www.laterooms.com/en/static/AboutUs.mvc" rel="nofollow">Who are we</a></li>
	                                <li><a href="http://laterooms.custhelp.com/app/answers/list" rel="nofollow">Help</a></li>
	                                <li><a href="http://laterooms.custhelp.com/app/home" rel="nofollow">Customer Support</a></li>
	                            </ul>
	                        </li>
	                        <li class="dd">
	                            Other Services
	                            <ul>
	                                <li><a class="newlink" href="http://www.laterooms.com/en/static/holiday-cottages.mvc" rel="nofollow">Book a Cottage</a></li>
	                                <li><a class="newlink" href="http://www.laterooms.com/en/static/london-theatre-tickets.mvc" rel="nofollow">Book London Theatre Tickets</a></li>
	                                <li><a href="http://www.carhiremarket.com/laterooms?Affiliate_ID=540" rel="nofollow">Hire a Car</a></li>
	                            </ul>
	                        </li>
	                    </ul>
	                </nav>
	            </div>
	        </section>';}

function tabs(){
	return $tabs = '<!-- TABS -->
	    	<div class="tabbed ui-tabs ui-widget ui-widget-content ui-corner-all">
		      <div class="row">
		        <div class="tab-row">
		          <ul class="mobile ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
		            <li style="display:inline;" class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tab1" aria-labelledby="ui-id-1" aria-selected="false"><a href="#tab1" class="tab ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-1">Tab 1</a> </li>
		            <li style="display:inline;" class="ui-state-default ui-corner-top ui-tabs-active ui-state-active" role="tab" tabindex="0" aria-controls="tab2" aria-labelledby="ui-id-2" aria-selected="true"><a href="#tab2" class="tab ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-2">Tab 2</a></li>
		            <li style="display:inline;" class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tab3" aria-labelledby="ui-id-3" aria-selected="false"><a href="#tab3" class="tab-end ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-3">Tab 3</a></li>
		          </ul>
		        </div>
		      </div>
		      <div style="clear:both;"></div>
			<!-- END TABS -->
		<!-- END TABS -->';
}

function tabbedMatrix($hoteldetails){
	//print_r($hoteldetails);
	$count = 0;
	$tabbedBody = '
		<!-- CONTENT CONTAINER -->  
		<div class="content-container">
		<div id="tab'.$count.'">
			<!-- HOTEL ROW 1 -->  
		<div class="row">
		
		<div class="hotel-row">';

	$tabbedBody.= tabs();
	foreach($hoteldetails as $key => $HD){

		$tabbedBody.='
		    	 <div class="grid">
		        	<a class="newlink" href="#hotellink#">
		        	 <div class="hotel-image"><img src="#imagesrc#" border="0">
		             	<div class="top-temptation"><p>Top Temptation</p></div>
		            </div>
		            <div class="hotel-name">#hotelname#</div>
		            <div class="location">#star#<span style="color:#FFCD1B;">&#9733;</span>&nbsp;&nbsp;#location#</div> 
		            <div class="saving">you save <span style="font-weight:600;">£XX</span></div>
		            <div class="rate">from <span style="font-weight:600; font-size:30px;">#rate#</span></div>
		            <div class="was-rate">#wasrate#</div>
		            </a>
		        </div>';
		        echo $count ;
		    if($count == 3){
		    	$tabbedBody.='<div style="clear:both"></div>';
		 	}
		 			$count++ ;
		}


	$tabbedBody.='
	</div></div></div>
			<!-- HOTEL ROW 1 -->
		</div>
	';

	return $tabbedBody ;
}

function insertMainDetails($_POST, $link){
		$ids 			= $_POST["ids"];
		$campaign 		= $_POST["campaign"];
		$template 		= $_POST["template"];
		$intro_text		= $_POST["intro_text"];

		
		$insertCampaignDetails = "INSERT INTO `campaign_ids`(campaign,ids, template, intro_text) VALUES ('$campaign','$ids', '$template','$intro_text')";
		$result = mysql_query($insertCampaignDetails, $link);
}
function insertHeaderImage($_POST, $link, $_FILES){
		$header_image 	= $_FILES['header_image']['name'] ;
		$campaign 		= $_POST["campaign"];
		if($header_image){

			echo $insertCampaignDetails = "UPDATE `campaign_ids` SET header_image  = '$header_image' WHERE campaign = '$campaign'";
			return $result = mysql_query($insertCampaignDetails, $link);
		}
};

function insertAdvertOne($_POST, $link, $_FILES){
		if($_FILES['ad1']['name']){
			$insertCampaignDetails = "UPDATE `campaign_ids` SET ad1 = '".$_FILES['ad1']['name']."' WHERE campaign = '".$_POST['campaign']."'";
			return $result = mysql_query($insertCampaignDetails, $link);			
		}
};
function insertAdvertTwo($_POST, $link, $_FILES){
		if($_FILES['ad2']['name']){
			$insertCampaignDetails = "UPDATE `campaign_ids` SET ad2 = '".$_FILES['ad2']['name']."' WHERE campaign = '".$_POST['campaign']."'";
			return $result = mysql_query($insertCampaignDetails, $link);			
		}
};

function insertBanner($_POST, $link, $_FILES){

		if($_FILES['banner']['name']){
			$insertCampaignDetails = "UPDATE `campaign_ids` SET banner = '".$_FILES['banner']['name']."' WHERE campaign = '".$_POST['campaign']."'";
			return $result = mysql_query($insertCampaignDetails, $link);			
		}}
function validateQuery($result,$_POST){
	echo "<!--pre>";
	print_r($_POST);
	echo "</pre-->";
	$campaign =  $_POST['campaign'] ;
			if (!$result) {
		    	$message = die('Invalid query: ' . mysql_error());
			}else{
				$message = "That has been added to the Database<br />To see it click <a href='index2.php?campaign=".$campaign."'>here</a><br />";
			}			
			return $message ;}

function genericFooter(){
	return  $genericFooter = '
	<!-- SIGN UP -->
	<div class="row">
		<div class="sign-up">
	    	<p>Sign up today to receive the <span style="color:#d31753;">latest hotel deals and travel inspiration</span></p>
	        <div class="btn-secondary"><a href="http://www.laterooms.com/en/Subscribe.aspx" target="_blank">Get Deals</a></div>
	    </div>
	</div>
	<!-- SIGN UP -->

	<!-- APP PANEL -->

	<div class="row">
		<div class="app-bar">
	    	<div class="app-store"><a href="https://itunes.apple.com/gb/app/laterooms.com/id334701579" target="_blank"><img src="../LP_test/templates-code/templates-code/deals-intro/promo-links/deals-no-intro/images/app-store.jpg" width="198" height="57" border="0"></a></div>
	        <div class="google-play"><a href="https://play.google.com/store/apps/details?id=com.laterooms" target="_blank"><img src="../LP_test/templates-code/templates-code/deals-intro/promo-links/deals-no-intro/images/google.jpg" width="171" height="57" border="0"></a></div>
	        <div class="app-text">Download our free app today</div>
	    </div>
	</div>

	<!-- APP PANEL -->


	</div> 
	<!-- CONTENT CONTAINER END -->    
	   
	</div>
	<!-- TEMPLATE CONTAINER END --> 
	    </section>
	    <div class="footer-container">    
	        <section class="terms">
	            <div class="container">
	                <p>
	                <span style="font-weight:bold;">Terms and Conditions:</span>&nbsp;&nbsp;All rates correct at time of publication.
	                </p>
	            </div>
	        </section>

	        <section class="footer">
	            <div class="container">
	                <h2 class="footer">
	                    Hotels in...
	                </h2>
	                <ul class="regions">
	                    <li title="Hotels in England" data-region="England">
	                        <a class="newlink" href="http://www.laterooms.com/en/r1_hotels-in-england.aspx">England</a>
	                    </li>
	                    <li title="Hotels in Scotland" data-region="Scotland">
	                        <a class="newlink" href="http://www.laterooms.com/en/r2_hotels-in-scotland.aspx">Scotland</a>
	                    </li>
	                    <li title="Hotels in Wales" data-region="Wales">
	                        <a class="newlink" href="http://www.laterooms.com/en/r3_hotels-in-wales.aspx">Wales</a>
	                    </li>
	                    <li title="Hotels in Ireland" data-region="Ireland">
	                        <a class="newlink" href="http://www.laterooms.com/en/r5_hotels-in-republic-of-ireland.aspx">Ireland</a>
	                    </li>
	                    <li title="Hotels in N.Ireland" data-region="NIreland">
	                        <a class="newlink" href="http://www.laterooms.com/en/r4_hotels-in-northern-ireland.aspx">N.Ireland</a>
	                    </li>
	                    <li title="Hotels in Popular cities" data-region="Popularcities">
	                        <a class="newlink" href="null">Popular cities</a>
	                    </li>
	                    <li title="Hotels in World regions" data-region="Worldregions">
	                        <a class="newlink" href="http://www.laterooms.com/en/r21686_hotels-in-world.aspx">World regions</a>
	                    </li>
	                </ul>
	                <ul class="subregions" data-subregion="England">
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16280256_birmingham-hotels.aspx" title="Hotels in Birmingham">Birmingham Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16295585_london-hotels.aspx" title="Hotels in London">London Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16279504_bath-hotels.aspx" title="Hotels in Bath">Bath Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16280256_birmingham-hotels.aspx" title="Hotels in Birmingham">Birmingham Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16280441_blackpool-hotels.aspx" title="Hotels in Blackpool">Blackpool Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k17183357_bournemouth-hotels.aspx" title="Hotels in Bournemouth">Bournemouth Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16281408_brighton-hotels.aspx" title="Hotels in Brighton">Brighton Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16281449_bristol-hotels.aspx" title="Hotels in Bristol">Bristol Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16282392_cambridge-hotels.aspx" title="Hotels in Cambridge">Cambridge Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16283308_cheltenham-hotels.aspx" title="Hotels in Cheltenham">Cheltenham Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16283350_chester-hotels.aspx" title="Hotels in Chester">Chester Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16284641_coventry-hotels.aspx" title="Hotels in Coventry">Coventry Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16287809_exeter-hotels.aspx" title="Hotels in Exeter">Exeter Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16290884_harrogate-hotels.aspx" title="Hotels in Harrogate">Harrogate Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16843804_lake-district-hotels.aspx" title="Hotels in Lake District">Lake District Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16294317_leeds-hotels.aspx" title="Hotels in Leeds">Leeds Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16294936_liverpool-hotels.aspx" title="Hotels in Liverpool">Liverpool Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16296355_manchester-hotels.aspx" title="Hotels in Manchester">Manchester Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16298218_newcastle-hotels.aspx" title="Hotels in Newcastle">Newcastle Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16298328_newquay-hotels.aspx" title="Hotels in Newquay">Newquay Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16298835_norwich-hotels.aspx" title="Hotels in Norwich">Norwich Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16298850_nottingham-hotels.aspx" title="Hotels in Nottingham">Nottingham Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16299423_oxford-hotels.aspx" title="Hotels in Oxford">Oxford Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16300126_plymouth-hotels.aspx" title="Hotels in Plymouth">Plymouth Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16300940_reading-hotels.aspx" title="Hotels in Reading">Reading Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16302469_scarborough-hotels.aspx" title="Hotels in Scarborough">Scarborough Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16302933_sheffield-hotels.aspx" title="Hotels in Sheffield">Sheffield Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16304646_stratford-hotels.aspx" title="Hotels in Stratford">Stratford Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16305980_torquay-hotels.aspx" title="Hotels in Torquay">Torquay Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16308280_windermere-hotels.aspx" title="Hotels in Windermere">Windermere Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16308894_york-hotels.aspx" title="Hotels in York">York Hotels</a>
	                    </li>
	                </ul>
	                <ul class="subregions" data-subregion="Scotland">
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16287261_edinburgh-hotels.aspx" title="">Hotels in Edinburgh</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16289408_glasgow-hotels.aspx" title="">Hotels in Glasgow</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16277298_aberdeen-hotels.aspx" title="">Hotels in Aberdeen</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16286614_dundee-hotels.aspx" title="">Hotels in Dundee</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16299913_perth-hotels.aspx" title="">Hotels in Perth</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16288614_fort-william-hotels.aspx" title="">Hotels in Fort William</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16291473_highlands-hotels.aspx" title="">Hotels in Highlands</a>
	                    </li>
	                </ul>
	                <ul class="subregions" data-subregion="Wales">
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16282562_cardiff-hotels.aspx" title="Hotels in Cardiff">Cardiff Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16305002_swansea-hotels.aspx" title="Hotels in Swansea">Swansea Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16298319_newport-hotels.aspx" title="Hotels in Newport">Newport Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16295060_llandudno-hotels.aspx" title="Hotels in Llandudno">Llandudno Hotels</a>
	                    </li>
	                </ul>
	                <ul class="subregions" data-subregion="Ireland">
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16837028_dublin-hotels.aspx" title="Hotels in Dublin">Dublin Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16837518_cork-hotels.aspx" title="Hotels in Cork">Cork Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16837621_galway-hotels.aspx" title="Hotels in Galway">Galway Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16860014_limerick-hotels.aspx" title="Hotels in Limerick">Limerick Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16837173_killarney-hotels.aspx" title="Hotels in Killarney">Killarney Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16837622_waterford-hotels.aspx" title="Hotels in Waterford">Waterford Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16837623_wexford-hotels.aspx" title="Hotels in Wexford">Wexford Hotels</a>
	                    </li>
	                </ul>
	                <ul class="subregions" data-subregion="NIreland">
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k16279755_belfast-hotels.aspx" title="Hotels in Belfast">Belfast Hotels</a>
	                    </li>
	                </ul>
	                <ul class="subregions" data-subregion="Popularcities">
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k12835253_paris-hotels.aspx" title="Hotels in Paris">Paris Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k12832640_nice-hotels.aspx" title="Hotels in Nice">Nice Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k15765562_barcelona-hotels.aspx" title="Hotels in Barcelona">Barcelona Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k14605275_amsterdam-hotels.aspx" title="Hotels in Amsterdam">Amsterdam Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k12672232_prague-hotels.aspx" title="Hotels in Prague">Prague Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k12936832_berlin-hotels.aspx" title="Hotels in Berlin">Berlin Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k13659368_rome-hotels.aspx" title="Hotels in Rome">Rome Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k13652155_milan-hotels.aspx" title="Hotels in Milan">Milan Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k13645939_florence-hotels.aspx" title="Hotels in Florence">Florence Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k13667136_venice-hotels.aspx" title="Hotels in Venice">Venice Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k13653788_naples-hotels.aspx" title="Hotels in Naples">Naples Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k15790393_madrid-hotels.aspx" title="Hotels in Madrid">Madrid Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k13028673_munich-hotels.aspx" title="Hotels in Munich">Munich Hotels</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/k11513504_sydney-hotels.aspx" title="Hotels in Sydney">Sydney Hotels</a>
	                    </li>
	                </ul>
	                <ul class="subregions" data-subregion="Worldregions">
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/r101_hotels-in-europe.aspx" title="Hotels in Europe">Hotels in Europe</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/r21680_hotels-in-africa.aspx" title="Hotels in Africa">Hotels in Africa</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/r21681_hotels-in-south-america.aspx" title="Hotels in South America">Hotels in South America</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/r21682_hotels-in-north-america.aspx" title="Hotels in North America">Hotels in North America</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/r21683_hotels-in-asia.aspx" title="Hotels in Asia">Hotels in Asia</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/r21684_hotels-in-australasia.aspx" title="Hotels in Australasia">Hotels in Australasia</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/r7_hotels-in-italy.aspx" title="Hotels in Italy">Hotels in Italy</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/r31_hotels-in-france.aspx" title="Hotels in France">Hotels in France</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/r62_hotels-in-spain.aspx" title="Hotels in Spain">Hotels in Spain</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/r24_hotels-in-germany.aspx" title="Hotels in Germany">Hotels in Germany</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/r25_hotels-in-netherlands.aspx" title="Hotels in Netherlands">Hotels in Netherlands</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/r57_hotels-in-portugal.aspx" title="Hotels in Portugal">Hotels in Portugal</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/r14_hotels-in-belgium.aspx" title="Hotels in Belgium">Hotels in Belgium</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/r6_hotels-in-usa.aspx" title="Hotels in USA">Hotels in USA</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/r80_hotels-in-new-zealand.aspx" title="Hotels in New Zealand">Hotels in New Zealand</a>
	                    </li>
	                </ul>
	                <hr>
	                <ul class="links">
	                    <li>
	                        <a href="http://laterooms.custhelp.com/app/home" target="sameWindow" rel="" title="Contact Us" accesskey="C">Contact Us</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/static/TermsOfUse.mvc" target="sameWindow" rel="" title="Terms and Conditions" accesskey="T">Terms and Conditions</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/static/TermsOfUse.mvc#s4" target="sameWindow" rel="" title="Privacy Policy" accesskey="P">Privacy Policy</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/static/CookieUsage.mvc" target="sameWindow" rel="" title="Cookie Usage" accesskey="U">Cookie Usage</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/static/LegalDisclaimer.mvc" target="sameWindow" rel="" title="Disclaimer" accesskey="D">Disclaimer</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/price-promise.mvc" target="sameWindow" rel="" title="Price Promise" accesskey="null">Price Promise</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/static/AboutUs.mvc" target="sameWindow" rel="" title="About Us" accesskey="null">About Us</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/JobOpportunities.mvc" target="sameWindow" rel="" title="Job Opportunities" accesskey="null">Job Opportunities</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/static/ThingsCare.mvc" target="sameWindow" rel="" title="Things we care about" accesskey="null">Things we care about</a>
	                    </li>
	                    <li>
	                        <a href="http://mediacentre.laterooms.com/" target="_blank" rel="" title="Media Centre" accesskey="null">Media Centre</a>
	                    </li>
	                    <li>
	                        <a href="http://laterooms.custhelp.com/app/answers/list/kw/a%5Cuserguide/search/1" target="sameWindow" rel="" title="User Guide" accesskey="E">User Guide</a>
	                    </li>
	                    <li>
	                        <a  href="http://laterooms.custhelp.com/app/home" target="sameWindow" rel="" title="FAQ" accesskey="null">FAQ</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/business-hotel-booking-services.aspx" target="sameWindow" rel="" title="Business Booking" accesskey="null">Business Booking</a>
	                    </li>
	                    <li>
	                        <a href="http://affiliates.laterooms.com/Index.aspx" target="sameWindow" rel="" title="Affiliates" accesskey="null">Affiliates</a>
	                    </li>
	                    <li>
	                        <a href="http://hoteladmin.laterooms.com/SignIn.aspx" target="sameWindow" rel="" title="Hotel Admin" accesskey="null">Hotel Admin</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/static/AddYourHotel.mvc" target="sameWindow" rel="" title="Add your hotel" accesskey="null">Add your hotel</a>
	                    </li>
	                    <li>
	                        <a class="newlink" href="http://www.laterooms.com/en/static/travel-resources.mvc" target="sameWindow" rel="" title="Resources" accesskey="null">Resources</a>
	                    </li>
	                </ul>
	                <span>Copyright © 1999 - 2014 LateRooms Ltd</span>
	            </div>
	        </section>
	        </div>

		    <script src="http://images.laterooms.com/link-changer/linkchanger-v2.js"></script>
	        <script src="../LP_test/templates-code/templates-code/deals-intro/promo-links/deals-no-intro/js/bootstrap-datepicker.js"></script>
	        <script src="../LP_test/templates-code/templates-code/deals-intro/promo-links/deals-no-intro/js/datePicker.js"></script>
	        <script src="../LP_test/templates-code/templates-code/deals-intro/promo-links/deals-no-intro/js/datePickerSelect.js"></script>
	        <script src="../LP_test/templates-code/templates-code/deals-intro/promo-links/deals-no-intro/js/searchBar.js"></script>
	        <script src="../LP_test/templates-code/templates-code/deals-intro/promo-links/deals-no-intro/js/searchBarValidation.js"></script>
	        <script src="../LP_test/templates-code/templates-code/deals-intro/promo-links/deals-no-intro/js/jquery.simplemodal.js"></script>
	        <script src="../LP_test/templates-code/templates-code/deals-intro/promo-links/deals-no-intro/js/errorMessage.js"></script>
	        <script src="../LP_test/templates-code/templates-code/deals-intro/promo-links/deals-no-intro/js/main.js"></script>
	    </body>
	</html>';}


function createPartnerParameters($parameters){

		if(strtolower($parameters['brand']) == 'laterooms.com'){
				if($parameters['p']){
					$pcode='p'.$parameters['p'] .'/';
				}
				if($parameters['pv']){	
					$pvcode ='pv'.$parameters['pv'] .'/';
				}
			}else if(strtolower($parameters['brand']) == 'asiarooms.com'){
				if($parameters['p']){
					$pcode='p/'.$parameters['p'] .'/';
				}
				if($parameters['pv']){	
					$pvcode ='&pv='.$parameters['pv'] ;
				}
			}
			$partnetParameters= array(
					'pcode' => $pcode,
					'pvcode'=> $pvcode
			);

			return $partnetParameters ;}

function createDeeplinkIntoWebsite($HD, $parameters){
	
	$formattedStartDate = getFormattedStartDate($parameters);

	$partnetParameters = createPartnerParameters($parameters);

	if($parameters['p']){

		if(($parameters['p'] == '1301') || ($parameters['p'] =='1422')){
			$UTMCode = '&utm_source=cpc&utm_medium=conferencehotelfinder&utm_campaign=' . $parameters['event name'];
		}else{
			$UTMCode = '&utm_source=affiliates&utm_medium=conferencehotelfinder&utm_campaign=aff'.$parameters['p'].'_' . urlencode($parameters['event name']);
		}
		
	}else{
		$UTMCode = "&utm_source=referral&utm_medium=conferencehotelfinder&utm_campaign=" . $parameters['event name'] ;
	}
	if(strtolower($parameters['brand']) == 'asiarooms.com'){
		$deepLink = 'http://www.'.$parameters['brand'].'/en/'. $partnetParameters['pcode'] .'hotel-reservations/'.$HD->id . '_' . $HD->url_slug .'.aspx?'.$formattedStartDate.'&amp;n='.$parameters['nights'].'&amp;rt='.$parameters['adults'].'-'.$parameters['children'] .$UTMCode . $partnetParameters['pvcode'];
	}else{
		$deepLink = 'http://www.'.$parameters['brand'].'/en/'. $partnetParameters['pcode'] . $partnetParameters['pvcode'] .'hotel-reservations/'.$HD->id . '_' . $HD->url_slug .'.aspx?'.$formattedStartDate.'&amp;n='.$parameters['nights'].'&amp;rt='.$parameters['adults'].'-'.$parameters['children'] .$UTMCode;
	}
	
	$deeplinkHTML = '<a href="'.$deepLink.'" target="_blank">';

	return $deeplinkHTML;}

function correctrating($rating){

	return round($rating/100*6);}


function createViewMoreButton($parameters){

	$formattedStartDate = getFormattedStartDate($parameters);

	if($parameters['keyword_id'] == 0){
		$keywordOrRegion = $parameters['events_region_id'];
	}else{
		$keywordOrRegion = $parameters['keyword_id'];
	}

		if(strtolower($parameters['brand']) == 'laterooms.com'){
			if($parameters['p'] != ''){
				$paramString = '/p'.$parameters['p'].'/';
				if($parameters['pv']){
					$paramString.='pv'.$parameters['pv'] .'/';
				}
			}else{
				$paramString = '/';
			}
		}else if(strtolower($parameters['brand']) == 'asiarooms.com'){
			if($parameters['p']){
				$paramString = 	'/p/'.$parameters['p']. '/';
			}else{
				$paramString = '/';
			}
		}

            $viewMoreButton = '<div class="uk-grid" data-uk-grid-margin>
                					<div class="uk-width-medium-1-1">
                    					<div class="uk-panel uk-text-center">
											<a href="';
												$viewMoreButton.= $parameters['brand_url'].$parameters['language'];
												$viewMoreButton.= $paramString;
												$viewMoreButton.= 'k'.$keywordOrRegion.'_';
												$viewMoreButton.= $parameters['keyword_friendly_text'].'-hotels.aspx';
												$viewMoreButton.= '?d='.$formattedStartDate.'&n='.$parameters['nights'];
												$viewMoreButton.= '&SortOrder='.$parameters['order by'];
												$viewMoreButton.= '&SortedAscending='.$parameters['sortingAsc'].'" target="_blank">
												<button class="uk-button uk-button-large">
												View more hotels near '. $parameters['keyword'] .' </button>
											</a>
                    					</div>
               						 </div>
            					</div>';
	return $viewMoreButton ;
 }

function createViewMoreButtonPostcode($parameters){
           $viewMoreButton = '<div class="uk-grid" data-uk-grid-margin>
                					<div class="uk-width-medium-1-1">
                    					<div class="uk-panel uk-text-center">
											<a href="http://www.laterooms.com/en/Hotels.aspx?k='.$parameters['firstPartOfpostcode'].'&d='.$parameters['start_date'].'&n=1&rt=2-0&rt-adult=2&rt-child=0" target="_blank">
												<button class="uk-button uk-button-large">
												View more hotels near '. $parameters['firstPartOfpostcode'] .' </button>
											</a>
                    					</div>
               						 </div>
            					</div>';

		return $viewMoreButton ;
}
