<!DOCTYPE html>
<!--[if IE 9]>
<html class="lt-ie10" lang="en" >
   <![endif]-->
   <html class="no-js" lang="en" data-useragent="Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)">
      <head>
         <meta charset="utf-8"/>
         <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
         <title>Blue Mena Group</title>
         <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
		 <?php if($route != '/'): ?>
         {{ HTML::style('resources/css_home/docs.css') }}
		 <?php endif; ?>
         {{ HTML::style('resources/css_home/style.css') }}
         {{ HTML::style('resources/css_home/foundation-icons.css') }}
		 
		 {{ HTML::script('resources/js_home/jquery.js') }}
      </head>
      <body>
	  <?php if($route != 'login'): ?>
		<div id="fInquiry"><a href="{{ URL::to('/') }}" class="btn btn-green">blueConnect</a></div>
	  <?php endif; ?>
         <?php if($route == 'home'): ?>
         <header class="h-header -with-video">
            <div class="h-fvideo">
               <div class="h-fvideo__wrapper" style="opacity: 1;">
                  <video id="homepage-video" class="h-fvideo__video js-fvideo" loop="" muted="" preload="auto" style="" poster="data:image/gif,AAAA" autoplay="">
                     <source src="http://connect.bluemena.com/20151020_173713.mp4" type="video/mp4">
                  </video>
               </div>
               <div class="h-fvideo__sm">
                  <div class="h-iloop js-iloop">
                     <ul class="h-iloop__list">
                        <li class="h-iloop__item">
                           <div style="background-image: url(../../tblsys/resources/img/slider1.JPG);">
                           </div>
                        </li>
                        <li class="h-iloop__item -anim-1 -fading-out">
                           <div style="background-image: url(../../tblsys/resources/img/slider2.JPG);">
                           </div>
                        </li>
                        <li class="h-iloop__item -anim-2 -fading-out">
                           <div style="background-image: url(../../tblsys/resources/img/slider3.JPG);">
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="h-header__inner row collapse">
               <div class="h-header__block columns -no-bg -lg">
                  <!--  removed width classes -->
                  <div class="h-header__top">
                     <a class="h-header__logo-wrap" href="" title="blue mena group">
                        {{ HTML::image('resources/img/logo.png', 'logo', array('id' => 'logo', 'title' => 'blue mena logo', 'class' => 'img-responsive')) }}           
                        <!-- WIP: need to handle fallback using modernizer -->
                     </a>                                             
                        <!-- WIP: need to handle fallback using modernizer -->                     
                     <div class="h-header__nav-toggle menu-trigger">MENU <span class="h-burger"></span></div>
                     <!-- &#9776; -->
                  </div>
                  <div class="h-header__meta -meta-home js-fvideo-fade-me" style="transform: translate3d(0px, 32px, 0px); opacity: 0.666667;">
                     <div class="h-header__meta-content">
                        <!--  -meta-simple class added -->
                        <h1 class=" h-header__title">
                           Blue Mena
                        </h1>
                        <p class="h-header__snippet f-serif">
                           Blue Mena Group is the leading customer service ecosystem specialist in Middle East and North-Africa                           
                        </p>
                     </div>
                  </div>
               </div>
               <div class="h-header__block--bg small-12 medium-7 columns">
                  <nav class="h-header__nav-wrap">
                     <ul class="h-nav--main -nav-hairline--down">
                        <li class="h-nav__entry {{ ($route == 'home') ? '-is_active' : '' }}">
                           <a href="{{ URL::to('home') }}" class="h-nav__link">Home</a>
                        </li>
                        <li class="h-nav__entry {{ ($route == 'about_us') ? '-is_active' : '' }}">
                           <a href="{{ URL::to('about_us') }}" class="h-nav__link">About Us</a>
                        </li>
                        <li class="h-nav__entry {{ ($route == 'consultancy' OR $route == 'technology' OR $route == 'execution' OR $route == 'training' OR $route == 'outsourcing' OR $route == 'services') ? '-is_active' : '' }}">
                           <a href="{{ URL::to('services') }}" class="h-nav__link">Services</a>
                        </li>
                        <li class="h-nav__entry {{ ($route == 'technical' || $route == 'script' || $route == 'inbound' || $route == 'outbound' || $route == 'contact_center') ? '-is_active' : '' }}">
                           <a href="{{ URL::to('contact_center') }}" class="h-nav__link">Trainings</a>
                        </li>
						      <!--<li class="h-nav__entry {{ ($route == 'registration') ? '-is_active' : '' }}">
                           <a href="{{ URL::to('registration') }}" class="h-nav__link">Join Us</a>
                        </li>-->
                        <li class="h-nav__entry {{ ($route == 'contact_us') ? '-is_active' : '' }}">
                           <a href="{{ URL::to('contact_us') }}" class="h-nav__link">Contact Us</a>
                        </li>
                     </ul>
                  </nav>
               </div>
            </div>
         </header>
         <?php else: ?>
         <header class="h-header -has-subnav">
            <div class="h-header__inner row collapse">
               <div class="h-header__block small-12 medium-5 columns">
                  <div class="h-header__top">
                     <a class="h-header__logo-wrap" href="" title="blue mena group">
                        {{ HTML::image('resources/img/logo.png', 'logo', array('id' => 'logo', 'title' => 'blue mena logo', 'class' => 'img-responsive')) }}           
                        <!-- WIP: need to handle fallback using modernizer -->
                     </a>
                     <div class="h-header__nav-toggle menu-trigger">MENU <span class="h-burger"></span></div>
                     <!-- &#9776; -->
                  </div>
                  <div class="h-header__meta -meta-simple">
                     <!--  -meta-simple class added -->
                     <h2 class="h-header__title">
                        <?php
                           if($route == 'history' || $route == 'chairman') {
                           	 echo 'About Us';
                           } elseif($route == 'technology' || $route == 'training' || $route == 'execution' || $route == 'outsourcing') {
                           	 echo 'Services';
                           } elseif($route == 'technical' || $route == 'script' || $route == 'inbound' || $route == 'outbound' || $route == 'contact_center') {
                           	 echo 'Trainings';
                           } elseif($route == 'login') {
                               echo 'Welcome to BMG';
                           } else {
                           	 echo ucwords(str_replace('_', ' ', $route));
                           }
                        ?>
                     </h2>
                  </div>
               </div>
               <div class="h-header__block--bg small-12 medium-7 columns">
                  <nav class="h-header__nav-wrap">
                     <ul class="h-nav--main -nav-hairline--down">
                        <li class="h-nav__entry {{ ($route == 'home') ? '-is_active' : '' }}">
                           <a href="{{ URL::to('home') }}" class="h-nav__link">Home</a>
                        </li>
                        <li class="h-nav__entry {{ ($route == 'about_us' || $route == 'chairman' || $route == 'history') ? '-is_active' : '' }}">
                           <a href="{{ URL::to('about_us') }}" class="h-nav__link">About Us</a>
                        </li>
                        <li class="h-nav__entry {{ ($route == 'consultancy' OR $route == 'technology' OR $route == 'execution' OR $route == 'training' OR $route == 'outsourcing' OR $route == 'services') ? '-is_active' : '' }}">
                           <a href="{{ URL::to('services') }}" class="h-nav__link">Services</a>
                        </li>
                        <li class="h-nav__entry {{ ($route == 'technical' || $route == 'script' || $route == 'inbound' || $route == 'outbound' || $route == 'contact_center') ? '-is_active' : '' }}">
                           <a href="{{ URL::to('contact_center') }}" class="h-nav__link">Trainings</a>
                        </li>						
						      <!--<li class="h-nav__entry {{ ($route == 'registration') ? '-is_active' : '' }}">
                           <a href="{{ URL::to('registration') }}" class="h-nav__link">Join Us</a>
                        </li>-->
                        <li class="h-nav__entry {{ ($route == 'contact_us') ? '-is_active' : '' }}">
                           <a href="{{ URL::to('contact_us') }}" class="h-nav__link">Contact Us</a>
                        </li>
                     </ul>
                  </nav>
               </div>
            </div>
            <?php if($route == 'about_us' || $route == 'history' || $route == 'chairman'): ?>
            <nav class="h-header__subnav-wrap">
               <div class="row collapse">
                  <ul class="h-nav--subnav -nav-hairline--up small-12 js-collapsible">
                     <li class="h-nav__entry {{ ($route == 'about_us' ? '-is_active' : '') }}" data-id="js-dden0">
                        <a href="{{ URL::to('about_us') }}" class="h-nav__link--sub">Overview</a>
                     </li>
                     <li class="h-nav__entry {{ ($route == 'history' ? '-is_active' : '') }}" data-id="js-dden1">
                        <a href="{{ URL::to('history') }}" class="h-nav__link--sub">History</a>
                     </li>
					 <li class="h-nav__entry {{ ($route == 'chairman' ? '-is_active' : '') }}" data-id="js-dden2">
                        <a href="{{ URL::to('chairman') }}" class="h-nav__link--sub">The Chairman</a>
                     </li>
                     <li class="h-nav__entry -collapsed js-collapsed" style="display: none;">
                        <ul id="subnav_collapsed" class="h-dd f-dropdown" data-dropdown-content="">
                           <li class="h-dd__entry {{ ($route == 'about_us' ? '-is_active' : '') }}" data-id="js-dden0" style="display: none;">
                              <a href="{{ URL::to('about_us') }}" class="h-dd__link">Overview</a>
                           </li>
                           <li class="h-dd__entry {{ ($route == 'history' ? '-is_active' : '') }}" data-id="js-dden1" style="display: none;">
                              <a href="{{ URL::to('history') }}" class="h-dd__link">History</a>
                           </li>
						   <li class="h-dd__entry {{ ($route == 'chairman' ? '-is_active' : '') }}" data-id="js-dden2" style="display: none;">
                              <a href="{{ URL::to('chairman') }}" class="h-dd__link">The Chairman</a>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </div>
            </nav>
            <?php elseif($route == 'services' || $route == 'technology' || $route == 'training' || $route == 'execution' || $route == 'outsourcing'): ?>
            <nav class="h-header__subnav-wrap">
               <div class="row collapse">
                  <ul class="h-nav--subnav -nav-hairline--up small-12 js-collapsible">
                     <li class="h-nav__entry {{ ($route == 'technology' ? '-is_active' : '') }}" data-id="js-dden0">
                        <a href="{{ URL::to('technology') }}" class="h-nav__link--sub">Technology</a>
                     </li>
                     <li class="h-nav__entry {{ ($route == 'training' ? '-is_active' : '') }}" data-id="js-dden1">
                        <a href="{{ URL::to('training') }}" class="h-nav__link--sub">Trainings</a>
                     </li>
                     <li class="h-nav__entry {{ ($route == 'execution' ? '-is_active' : '') }}" data-id="js-dden0">
                        <a href="{{ URL::to('execution') }}" class="h-nav__link--sub">Project Execution</a>
                     </li>
                     <li class="h-nav__entry {{ ($route == 'outsourcing' ? '-is_active' : '') }}" data-id="js-dden1">
                        <a href="{{ URL::to('outsourcing') }}" class="h-nav__link--sub">Process Outsourcing</a>
                     </li>
                     <li class="h-nav__entry -collapsed js-collapsed" style="display: none;">
                        <ul id="subnav_collapsed" class="h-dd f-dropdown" data-dropdown-content="">
                           <li class="h-dd__entry {{ ($route == 'technology' ? '-is_active' : '') }}" data-id="js-dden0" style="display: none;">
                              <a href="{{ URL::to('technology') }}" class="h-dd__link">Technology</a>
                           </li>
                           <li class="h-dd__entry {{ ($route == 'training' ? '-is_active' : '') }}" data-id="js-dden1" style="display: none;">
                              <a href="{{ URL::to('training') }}" class="h-dd__link">Trainings</a>
                           </li>
                           <li class="h-dd__entry {{ ($route == 'execution' ? '-is_active' : '') }}" data-id="js-dden0" style="display: none;">
                              <a href="{{ URL::to('execution') }}" class="h-dd__link">Project Execution</a>
                           </li>
                           <li class="h-dd__entry {{ ($route == 'outsourcing' ? '-is_active' : '') }}" data-id="js-dden1" style="display: none;">
                              <a href="{{ URL::to('outsourcing') }}" class="h-dd__link">Process Outsourcing</a>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </div>
            </nav>
            <?php elseif($route == 'technical' || $route == 'script' || $route == 'inbound' || $route == 'outbound' || $route == 'contact_center'): ?>
            <nav class="h-header__subnav-wrap">
               <div class="row collapse">
                  <ul class="h-nav--subnav -nav-hairline--up small-12 js-collapsible">
                     <li class="h-nav__entry {{ ($route == 'contact_center' ? '-is_active' : '') }}" data-id="js-dden0">
                        <a href="{{ URL::to('contact_center') }}" class="h-nav__link--sub">Introduction to Contact Center</a>
                     </li>
                     <li class="h-nav__entry {{ ($route == 'script' ? '-is_active' : '') }}" data-id="js-dden1">
                        <a href="{{ URL::to('script') }}" class="h-nav__link--sub">Script Development</a>
                     </li>
                     <li class="h-nav__entry {{ ($route == 'technical' ? '-is_active' : '') }}" data-id="js-dden1">
                        <a href="{{ URL::to('technical') }}" class="h-nav__link--sub">Technical Administration</a>
                     </li>
                     <li class="h-nav__entry {{ ($route == 'inbound' ? '-is_active' : '') }}" data-id="js-dden0">
                        <a href="{{ URL::to('inbound') }}" class="h-nav__link--sub">Inbound Floor Operations</a>
                     </li>
                     <li class="h-nav__entry {{ ($route == 'outbound' ? '-is_active' : '') }}" data-id="js-dden1">
                        <a href="{{ URL::to('outbound') }}" class="h-nav__link--sub">Outbound Floor Operations</a>
                     </li>
                     <li class="h-nav__entry -collapsed js-collapsed" style="display: none;">
                        <ul id="subnav_collapsed" class="h-dd f-dropdown" data-dropdown-content="">
                           <li class="h-dd__entry {{ ($route == 'contact_center' ? '-is_active' : '') }}" data-id="js-dden0" style="display: none;">
                              <a href="{{ URL::to('contact_center') }}" class="h-dd__link">Introduction to Contact Center</a>
                           </li>
                           <li class="h-dd__entry {{ ($route == 'script' ? '-is_active' : '') }}" data-id="js-dden1" style="display: none;">
                              <a href="{{ URL::to('script') }}" class="h-dd__link">Script Development</a>
                           </li>
                           <li class="h-dd__entry {{ ($route == 'technical' ? '-is_active' : '') }}" data-id="js-dden1" style="display: none;">
                              <a href="{{ URL::to('technical') }}" class="h-dd__link">Technical Administration</a>
                           </li>
                           <li class="h-dd__entry {{ ($route == 'inbound' ? '-is_active' : '') }}" data-id="js-dden0" style="display: none;">
                              <a href="{{ URL::to('inbound') }}" class="h-dd__link">Inbound Floor Operations</a>
                           </li>
                           <li class="h-dd__entry {{ ($route == 'outbound' ? '-is_active' : '') }}" data-id="js-dden1" style="display: none;">
                              <a href="{{ URL::to('outbound') }}" class="h-dd__link">Outbound Floor Operations</a>
                           </li>                        
                        </ul>
                     </li>
                  </ul>
               </div>
            </nav>
            <?php endif; ?>
         </header>
         <?php endif; ?>
         <div class="h-content">
            {{ $content }}
         </div>
         <div class="h-mmenu">
            <a href="#" class="h-menu__exit js-menu-close"></a>
            <div id="menu" class="h-menu">
               <nav class="h-menu__container">
                  <div class="h-menu__main-level">
                     <div class="h-menu__actions">
                        <a href="#" class="h-menu__close js-menu-close">
                        <span class="h-icon--small -icon-close -icon-white" style="background-image: none;">          
                        <i class="step fi-power size-48"></i>
                        </span>
                        </a>
                     </div>
                     <h3 class="h-menu__head">Blue Mena Group</h3>
                     <ul class="h-menu__list">
                        <li>
                           <a href="{{ URL::to('home') }}" class="h-menu__link  -white {{ ($route == 'home' ? '-trail' : '') }}">Home</a>
                        </li>
                        <li>
                           <a href="#" class="h-menu__link h-menu__link--next -white {{ ($route == 'about_us' ? '-trail' : '') }}">
                           About Us
                           <span class="h-icon--small -icon-arrow-right h-menu__icon-n -icon-white" style="background-image: none;">                       
                           <i class="step fi-arrow-right size-24"></i>
                           </span>
                           </a>
                           <div class="h-menu__level {{ ($route == 'about_us' || $route == 'chairman' || $route == 'history' ? 'js-level-open' : '') }} ">
                              <div class="h-menu__actions">
                                 <a href="#" class="h-menu__back">
                                 <span class="h-icon--small h-menu__icon-back -icon-arrow-left" style="background-image: none;">                  
                                 <i class="step fi-arrow-left size-24"></i>
                                 </span>
                                 BMG
                                 </a>
                                 <a href="#" class="h-menu__close js-menu-close">
                                 <span class="h-icon--small -icon-close" style="background-image: none;">                            
                                 <i class="step fi-power size-48"></i>
                                 </span>
                                 </a>
                              </div>
                              <h3 class="h-menu__head">
                                 <a href="{{ URL::to('about_us') }}">
                                 About Us
                                 </a>
                              </h3>
                              <ul class="h-menu__list">
                                 <li>
                                    <a href="{{ URL::to('about_us') }}" class="h-menu__link {{ ($route == 'about_us' ? '-trail' : '') }} ">Overview</a>
                                 </li>
                                 <li>
                                    <a href="{{ URL::to('history') }}" class="h-menu__link {{ ($route == 'history' ? '-trail' : '') }} ">History</a>
                                 </li>
								 <li>
                                    <a href="{{ URL::to('chairman') }}" class="h-menu__link {{ ($route == 'chairman' ? '-trail' : '') }} ">The Chairman</a>
                                 </li>
                              </ul>
                           </div>
                        </li>
                        <li>
                           <a href="#" class="h-menu__link h-menu__link--next -white {{ ($route == 'services' ? '-trail' : '') }}">
                           Services
                           <span class="h-icon--small -icon-arrow-right h-menu__icon-n -icon-white" style="background-image: none;">                       
                           <i class="step fi-arrow-right size-24"></i>
                           </span>
                           </a>
                           <div class="h-menu__level {{ ($route == 'services' || $route == 'technology' || $route == 'training' || $route == 'execution' || $route == 'outsourcing' ? 'js-level-open' : '') }} ">
                              <div class="h-menu__actions">
                                 <a href="#" class="h-menu__back">
                                 <span class="h-icon--small h-menu__icon-back -icon-arrow-left" style="background-image: none;">                  
                                 <i class="step fi-arrow-left size-24"></i>
                                 </span>
                                 BMG
                                 </a>
                                 <a href="#" class="h-menu__close js-menu-close">
                                 <span class="h-icon--small -icon-close" style="background-image: none;">                            
                                 <i class="step fi-power size-48"></i>
                                 </span>
                                 </a>
                              </div>
                              <h3 class="h-menu__head">
                                 <a href="{{ URL::to('services') }}">
                                 Services
                                 </a>
                              </h3>
                              <ul class="h-menu__list">
                                 <li>
                                    <a href="{{ URL::to('technology') }}" class="h-menu__link {{ ($route == 'technology' ? '-trail' : '') }} ">Technology</a>
                                 </li>
                                 <li>
                                    <a href="{{ URL::to('training') }}" class="h-menu__link {{ ($route == 'training' ? '-trail' : '') }} ">Trainings</a>
                                 </li>
                                 <li>
                                    <a href="{{ URL::to('execution') }}" class="h-menu__link {{ ($route == 'execution' ? '-trail' : '') }} ">Project Execution</a>
                                 </li>
                                 <li>
                                    <a href="{{ URL::to('outsourcing') }}" class="h-menu__link {{ ($route == 'outsourcing' ? '-trail' : '') }} ">Process Outsourcing</a>
                                 </li>
                              </ul>
                           </div>
                        </li>
						<li>
						   <a href="#" class="h-menu__link h-menu__link--next -white {{ ($route == 'contact_center' ? '-trail' : '') }}">
						   Courses
						   <span class="h-icon--small -icon-arrow-right h-menu__icon-n -icon-white" style="background-image: none;">                       
						   <i class="step fi-arrow-right size-24"></i>
						   </span>
						   </a>
						   <div class="h-menu__level {{ ($route == 'technical' || $route == 'script' || $route == 'inbound' || $route == 'outbound' || $route == 'contact_center' ? 'js-level-open' : '') }} ">
							  <div class="h-menu__actions">
								 <a href="#" class="h-menu__back">
								 <span class="h-icon--small h-menu__icon-back -icon-arrow-left" style="background-image: none;">                  
								 <i class="step fi-arrow-left size-24"></i>
								 </span>
								 BMG
								 </a>
								 <a href="#" class="h-menu__close js-menu-close">
								 <span class="h-icon--small -icon-close" style="background-image: none;">                            
								 <i class="step fi-power size-48"></i>
								 </span>
								 </a>
							  </div>
							  <h3 class="h-menu__head">
								 Courses
							  </h3>
							  <ul class="h-menu__list">
								 <li>
									<a href="{{ URL::to('contact_center') }}" class="h-menu__link {{ ($route == 'contact_center' ? '-trail' : '') }} ">Introduction to Contact Center</a>
								 </li>
								 <li>
									<a href="{{ URL::to('script') }}" class="h-menu__link {{ ($route == 'script' ? '-trail' : '') }} ">Script Development</a>
								 </li>
								 <li>
									<a href="{{ URL::to('technical') }}" class="h-menu__link {{ ($route == 'technical' ? '-trail' : '') }} ">Technical Administration</a>
								 </li>
								 <li>
									<a href="{{ URL::to('inbound') }}" class="h-menu__link {{ ($route == 'inbound' ? '-trail' : '') }} ">Inbound Floor Operations</a>
								 </li>
								 <li>
									<a href="{{ URL::to('outbound') }}" class="h-menu__link {{ ($route == 'outbound' ? '-trail' : '') }} ">Outbound Floor Operations</a>
								 </li>
							  </ul>
						   </div>
						</li>
						<!--<li>
                           <a href="{{ URL::to('registration') }}" class="h-menu__link  -white">Join Us</a>
                        </li>-->
                        <li>
                           <a href="{{ URL::to('contact_us') }}" class="h-menu__link  -white">Contact Us</a>
                        </li>
                     </ul>
                  </div>
               </nav>
            </div>
         </div>
         <footer class="h-footer">
            <div class="row">
               <div class="column medium-4">
                  <br>
                  <center>
                     <span class='st_facebook_large' displayText='Facebook'></span>
                     <span class='st_twitter_large' displayText='Tweet'></span>
                     <span class='st_googleplus_large' displayText='Google +'></span>
                  </center>
               </div>
               <div class="column medium-4">
                  <div class="h-footer__cr">
                     <h4 style="color: #828282;">ABOUT US</h4>
                     <p style="color: #828282;">
                        Blue Mena Group is one of the leading customer service in the MENA region for offering 
                        high level operational and business consultancy services. We are here to help you to 
                        achieve what is beyond the expectation of your business. We will be your true companion 
                        for your growth and success because that's our main objective.
                     </p>
                  </div>
               </div>
               <div class="column medium-4">
                  <div class="h-footer__cr">
                     <h4 style="color: #828282;">CONTACT US</h4>
                     <p style="color: #828282;">
                        Dubai Internet City<br>
                        Building 1 - Office 215<br>
                        Po Box 500071<br>
                        Dubai - UAE
                     </p>
                     <p style="color: #828282;">
                        Tel: +971 4 391 20 40<br>
                        Fax: +971 4 391 88 81<br>
                        Email: info@bluemena.com
                     </p>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="column medium-7">
                  <div class="h-footer__cr" style="color: #828282;">
                     <p>&copy; Blue Mena Group 2015. All Rights Reserved.</p>
                  </div>
               </div>
            </div>
         </footer>
         
         {{ HTML::script('resources/js_home/foundation.js') }}	 
         {{ HTML::script('resources/js_home/modernizr.js') }}	 
         {{ HTML::script('resources/js_home/libs.min.js') }}
         {{ HTML::script('resources/js_home/main.min.js') }}      
         <script>
            $(document).foundation();
            
            var w = $( window ).width();
            
            if(w < 640) {
				$('#logo').attr('src', '<?php echo asset('resources/img/logo-thumb.png'); ?>');
				$('#right-side-bar').show();
            } else {
				$('#logo').attr('src', '<?php echo asset('resources/img/logo.png'); ?>');
				$('#right-side-bar').hide();
            }
            
            $(window).resize(function(){
				var w = $( window ).width();
				
				if(w < 640) {
					$('#logo').attr('src', '<?php echo asset('resources/img/logo-thumb.png'); ?>');
					$('#right-side-bar').show();
				} else {
					$('#logo').attr('src', '<?php echo asset('resources/img/logo.png'); ?>');
					$('#right-side-bar').hide();
				}
            });
         </script>
         <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
      </body>
   </html>