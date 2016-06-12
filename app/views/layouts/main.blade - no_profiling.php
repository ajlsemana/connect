<?php date_default_timezone_set('Asia/Dubai'); ?>
<!DOCTYPE html>
<html lang="en" data-ng-app="">
   <head>
      <meta charset="utf-8">
      <title>blueConnect</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
      <meta name="apple-mobile-web-app-capable" content="yes">
      <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
      {{ HTML::style('resources/css/bootstrap.min.css') }}
      {{ HTML::style('resources/css/bootstrap-responsive.min.css') }}
      {{ HTML::style('resources/css/font-awesome.css') }}
      {{ HTML::style('resources/css/datepicker.css') }}
      {{ HTML::style('resources/css/style.css') }}
      {{ HTML::style('resources/css/pages/dashboard.css') }}
      {{ HTML::script('resources/js/jquery-1.7.2.min.js') }}
      {{ HTML::script('resources/js/CircularLoader.js') }}
      <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
      <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
      <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->
   </head>
   <body>
      <div class="navbar navbar-fixed-top">
         <div class="navbar-inner">
            <div class="container">
               <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span> 
               </a>
               <a class="brand" href="#">
                  blueConnect
               </a>
               <div class="nav-collapse">
                  <ul class="nav pull-right">
                     @if(Auth::check())
                     <li>
                        <?php
                              $pic = 'no-photo.jpg';
                              $destinationPath = Config::get('app.url_storage') . '/profile_pic/'.$pic;                       
                           ?>                                  
                           @if(! empty(Auth::user()->profile_pic))
                           <?php $pic = Auth::user()->profile_pic; ?>
                           <?php $destinationPath = Config::get('app.url_storage') . '/profile_pic/'.$pic; ?>           
                           @endif                                          
                        <a style="cursor: default;">Hi {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} 
                        <em>
                        <?php                           
                           switch(Auth::user()->user_type) {
                             case 1: $type = 'Admin'; break;
                             case 2: $type = 'Trainer'; break;
                             case 3:  
                                 if(Auth::user()->skills_map) {
                                    $type = 'Engineer';
                                 } else {
                                    $type = 'Trainee';
                                 }
                             break;
                             case 5: $type = 'Resource Manager'; break;
                             default: $type = 'Unknown';
                           }                  
                           ?>
                        ({{ $type }})
                        </em>
                        </a>
                     </li>
                     <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">                        
                        {{ HTML::image($destinationPath, 'logo', array('class' => 'img-circle', 'width' => '20', 'height' => '20', 'title' => 'photo')) }} Account <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                           @if(Auth::user()->user_type == 1)
                           <li><a href="{{ URL::to('user/profile') }}">Profile</a></li>
                           <li><a href="{{ URL::to('user/change_password') }}">Change Password</a></li>
                           <li><a href="{{ URL::to('trainee/logout') }}">Logout</a></li>
                           @elseif(Auth::user()->user_type == 2)
                           <li><a href="{{ URL::to('trainer/profile') }}">Profile</a></li>
                           <li><a href="{{ URL::to('trainer/change_password') }}">Change Password</a></li>
                           <li><a href="{{ URL::to('trainer/logout') }}">Logout</a></li>
                           @elseif(Auth::user()->user_type == 5 || Auth::user()->user_type == 3)
                           <li><a href="{{ URL::to('trainee/profile') }}">Profile</a></li>
                           <li><a href="{{ URL::to('trainee/change_password') }}">Change Password</a></li>
                           <li><a href="{{ URL::to('trainee/logout') }}">Logout</a></li>
                           @endif
                        </ul>
                     </li>
                     @endif
                  </ul>
               </div>
               <!--/.nav-collapse --> 
            </div>
            <!-- /container --> 
         </div>
         <!-- /navbar-inner --> 
      </div>
      <!-- /navbar -->
      @if(Auth::check() && Auth::user()->user_type == 1)
      <div class="subnavbar">
         <div class="subnavbar-inner">
            <div class="container">
               <ul class="mainnav">
                  @if(Auth::user()->username != 'mich' && Auth::user()->username != 'ahmer' && Auth::user()->username != 'rbk' && Auth::user()->username != 'ayman')
                  <li class="@if (in_array($route, array('admin/dashboard'))) active @endif"><a href="{{ URL::to('admin/dashboard') }}"><i class="icon-home"></i><span>Home</span> </a> </li>
                  <li class="@if (in_array($route, array('admin/users', 'admin/users/update', 'admin/users/add'))) active @endif"><a href="{{ URL::to('admin/users') }}"><i class="icon-group"></i><span>Users</span> </a> </li>
                  <li class="@if (in_array($route, array('admin/attendees', 'admin/attendees/certificate', 'admin/attendees/add', 'admin/attendees/update', 'admin/attendees/listing-info/{id}'))) active @endif"><a href="{{ URL::to('admin/attendees') }}"><i class="icon-list"></i><span>Training Candidates</span> </a> </li>
                  <li class="@if (in_array($route, array('admin/skills-map', 'admin/skills-map/update', 'admin/skills-map-v7', 'admin/skills-map-v7/update'))) active @endif"><a href="{{ URL::to('admin/skills-map') }}"><i class="icon-bar-chart"></i><span>Skills Map</span> </a> </li>
                  <li class="@if (in_array($route, array('admin/training-courses', 'admin/training-courses/add-activity', 'admin/training-courses/view-timeline/{cid}','admin/training-courses/add', 'admin/training-courses/update'))) active @endif"><a href="{{ URL::to('admin/training-courses') }}"><i class="icon-star"></i><span>Training</span> </a> </li>
                  <li class="@if (in_array($route, array('admin/company', 'admin/company/add', 'admin/company/update'))) active @endif"><a href="{{ URL::to('admin/company') }}"><i class="icon-truck "></i><span>Service Providers</span> </a> </li>
                  <li class="@if (in_array($route, array('admin/announcements', 'admin/announcements/add', 'admin/announcements/update'))) active @endif"><a href="{{ URL::to('admin/announcements') }}"><i class="icon-calendar "></i><span>Announcements</span> </a> </li>
                  @else
                  <li class="@if (in_array($route, array('admin/dashboard'))) active @endif"><a href="{{ URL::to('admin/dashboard') }}"><i class="icon-home"></i><span>Home</span> </a> </li>
                  <!--<li class="@if (in_array($route, array('admin/attendees/temp-update', 'admin/attendees/temp-listings', 'admin/attendees/add', 'admin/attendees/update'))) active @endif"><a href="{{ URL::to('admin/attendees/temp-listings') }}"><i class="icon-list"></i><span>Attendees</span> </a> </li>-->
                  <li class="dropdown @if (in_array($route, array('admin/attendees/add-cost/{course}', 'admin/attendees/temp-listings-info/{id}', 'admin/attendees/temp-listings/{course}', 'admin/attendees/temp-update', 'admin/attendees/temp-listings', 'admin/attendees/add', 'admin/attendees/update'))) active @endif">
                     <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> 
                     <i class="icon-group"></i><span>Attendees</span> <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                        <li><a href="{{ URL::to('admin/attendees/temp-listings') }}">All Courses</a></li>
                        <li><a href="{{ URL::to('admin/attendees/temp-listings/TA') }}">Technical Administration</a></li>
                        <li><a href="{{ URL::to('admin/attendees/temp-listings/SD') }}">Script Development</a></li>
                        <li><a href="{{ URL::to('admin/attendees/temp-listings/IFO') }}">Inbound Floor Operations</a></li>
                        <li><a href="{{ URL::to('admin/attendees/temp-listings/OFO') }}">Outbound Floor Operations</a></li>
                        <li><a href="{{ URL::to('admin/attendees/temp-listings/ITCC') }}">Introduction to Contact Center</a></li>
                     </ul>
                  </li>
                  <li class="dropdown @if (in_array($route, array('admin/attendees/temp-listings/{course}/report'))) active @endif">
                     <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> 
                     <i class="icon-list-alt"></i><span>Business Report</span> <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                        <li><a href="{{ URL::to('admin/attendees/temp-listings/TA/report') }}">Technical Administration</a></li>
                        <li><a href="{{ URL::to('admin/attendees/temp-listings/SD/report') }}">Script Development</a></li>
                        <li><a href="{{ URL::to('admin/attendees/temp-listings/IFO/report') }}">Inbound Floor Operations</a></li>
                        <li><a href="{{ URL::to('admin/attendees/temp-listings/OFO/report') }}">Outbound Floor Operations</a></li>
                        <li><a href="{{ URL::to('admin/attendees/temp-listings/ITCC/report') }}">Introduction to Contact Center</a></li>
                     </ul>
                  </li>
                  @endif                  
               </ul>
               </li>
               </ul>
            </div>
            <!-- /container --> 
         </div>
         <!-- /subnavbar-inner --> 
      </div>
      <!-- /subnavbar -->
      @endif
      <div class="main">
         <div class="main-inner">
            <div class="container">
               @if(Auth::check() && in_array(Auth::user()->user_type, array(2, 3, 4, 5)))
               <div class="row">
                  <div class="span12">
                     <div class="widget">
                        <div class="widget-header">
                           <i class="icon-bookmark"></i>
                           <h3>Important Shortcuts</h3>
                        </div>
                        <!-- /widget-header -->
                        <div class="widget-content">
                           <div class="shortcuts" style="text-transform: uppercase;"> 
                              @if(in_array(Auth::user()->user_type, array(3, 5)))    
                              <?php
                                 $status = '';

                                 if(isset($_GET['status'])) {
                                    $status = '?status=attended';
                                 }
                              ?>                          
                              <a href="{{ URL::to('trainee/dashboard') }}" class="shortcut" @if (in_array($route, array('trainee/dashboard'))) style="background: #FFC15E;" @endif><i class="shortcut-icon icon-home" @if (in_array($route, array('trainee/dashboard'))) style="color: #2D5498;" @endif></i><span class="shortcut-label">Home</span> </a>            
                              <a href="#myModal"  role="button" data-toggle="modal" class="shortcut" @if ($status == '' && in_array($route, array('trainee/quizzes/take/{id}/{cid}', 'trainee/quizzes/{id}', 'trainee/wall-announcement/{course_id}', 'trainee/enrolled-training/{id}', 'trainee/calendar/{id}', 'trainee/enrolled-training/{id}/{status}', 'trainee/calendar/{id}'))) style="background: #FFC15E;" @endif><i class="shortcut-icon icon-check" @if ($status == '' && in_array($route, array('trainee/quizzes/take/{id}/{cid}', 'trainee/quizzes/{id}', 'trainee/wall-announcement/{course_id}', 'trainee/calendar/{id}', 'trainee/enrolled-training/{id}/{status}', 'trainee/calendar/{id}'))) style="color: #2D5498;" @endif></i><span class="shortcut-label">Enrolled Training</span> </a>                              
                              <a href="#myEndedModal"  role="button" data-toggle="modal" class="shortcut" @if ($status != '' || isset($_SESSION['course_status'])) style="background: #FFC15E;" @endif><i class="shortcut-icon icon-lock" @if ($status != '' || isset($_SESSION['course_status'])) style="color: #2D5498;" @endif></i><span class="shortcut-label">Attended Training</span> </a> <!-- mytrap -->
                                 @if(Auth::user()->skills_map == 1)  
                                    <a href="{{ URL::to('trainee/skills-map?id='.Auth::user()->id) }}" class="shortcut" @if (in_array($route, array('trainee/skills-map-v7', 'trainee/skills-map'))) style="background: #FFC15E;" @endif><i class="shortcut-icon icon-bar-chart" @if (in_array($route, array('trainee/skills-map-v7', 'trainee/skills-map'))) style="color: #2D5498;" @endif></i><span class="shortcut-label">My Skills Map</span> </a>
                                    @if(Auth::user()->user_type == 5)                                                     
                                    <a href="{{ URL::to('trainee/engineers') }}" class="shortcut" @if (in_array($route, array('trainee/engineers', 'trainee/engr-skills-map-v7', 'trainee/engr-skills-map'))) style="background: #FFC15E;" @endif><i class="shortcut-icon icon-group" @if (in_array($route, array('trainee/engineers', 'trainee/engr-skills-map-v7', 'trainee/engr-skills-map'))) style="color: #2D5498;" @endif></i><span class="shortcut-label">Team Skills Map</span> </a>
                                    @endif
                                 @endif
                              @elseif(Auth::user()->user_type == 2)                                                     
                              <a href="{{ URL::to('trainer/dashboard') }}" class="shortcut" @if (in_array($route, array('trainer/dashboard'))) style="background: #FFC15E;" @endif><i @if (in_array($route, array('trainer/dashboard'))) style="color: #2D5498;" @endif class="shortcut-icon icon-home"></i><span class="shortcut-label">Home</span> </a>                              
                              <a href="#myCoursesAss" role="button" data-toggle="modal" class="shortcut" @if (in_array($route, array('trainer/quizzes/{id}', 'trainer/quizzes/view/{id}/{cid}', 'trainer/quizzes/students/{id}', 'trainer/quizzes/add/{id}', 'trainer/quizzes/update/{id}'))) style="background: #FFC15E;" @endif><i class="shortcut-icon icon-pencil" @if (in_array($route, array('trainer/quizzes/{id}', 'trainer/quizzes/view/{id}/{cid}', 'trainer/quizzes/students/{id}', 'trainer/quizzes/add/{id}', 'trainer/quizzes/update/{id}'))) style="color: #2D5498;" @endif></i><span class="shortcut-label">Assignments</span> </a>
                              <a href="#myCourses" role="button" data-toggle="modal" class="shortcut" @if (in_array($route, array('trainer/wall-announcement/{course_id}'))) style="background: #FFC15E;" @endif><i class="shortcut-icon icon-comments-alt" @if (in_array($route, array('trainer/wall-announcement/{course_id}'))) style="color: #2D5498;" @endif></i><span class="shortcut-label">Announcements</span> </a>                              
                              @endif
                           </div>
                        </div>
                        <!-- /shortcuts --> 
                        <!-- /widget-content --> 
                     </div>
                  </div>
               </div>
               <?php
                  $month = array(
                              '01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr',
                              '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug',
                              '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'
                              );  
               ?>
               @if(Auth::user()->user_type == 2)                                                                   
               <div id="myCourses" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                     <h3 id="myModalLabel">Assigned Courses</h3>
                  </div>
                  <div class="modal-body">
                     <table class="table table-striped table-bordered">
                        <thead>
                           <tr>
                              <th> Course </th>
                              <th> Date</th>                              
                              <th class="td-actions"> </th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php                                                         
                              foreach($assigned_courses as $assigned) {
                              $explode_from = explode('-', $assigned->date_from);
                              $explode_to = explode('-', $assigned->date_to);
                              ?>
                           <tr align="center">
                              <td><a href="{{ URL::to('trainer/wall-announcement/'.$assigned->id) }}">{{ $assigned->name }}</a></td>
                              <td>
                                 <?php
                                    if($explode_from[1] == $explode_to[1]) {
                                    echo $explode_from[2].' - '.$explode_to[2].' '.$month[$explode_from[1]].' '.$explode_to[0];
                                    } else {
                                    echo $explode_from[2].' '.$month[$explode_from[1]].' to '.$explode_to[2].' '.$month[$explode_to[1]].' '.$explode_to[0];
                                    }
                                    ?>
                              </td>                              
                              <td><a href="{{ URL::to('trainer/wall-announcement/'.$assigned->id) }}" title="Comment to this course"><i class="icon-comment"></i></a></td>
                           </tr>
                           <?php
                              }
                              ?> 
                        </tbody>
                     </table>
                  </div>      
               </div>

               <div id="myCoursesAss" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                     <h3 id="myModalLabel">Assigned Courses</h3>
                  </div>
                  <div class="modal-body">
                     <table class="table table-striped table-bordered">
                        <thead>
                           <tr>
                              <th> Course </th>
                              <th> Date</th>                              
                              <th class="td-actions"> </th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php                                                         
                              foreach($assigned_courses as $assigned) {
                              $explode_from = explode('-', $assigned->date_from);
                              $explode_to = explode('-', $assigned->date_to);
                              ?>
                           <tr align="center">
                              <td><a href="{{ URL::to('trainer/quizzes/'.$assigned->id) }}">{{ $assigned->name }}</a></td>
                              <td>
                                 <?php
                                    if($explode_from[1] == $explode_to[1]) {
                                    echo $explode_from[2].' - '.$explode_to[2].' '.$month[$explode_from[1]].' '.$explode_to[0];
                                    } else {
                                    echo $explode_from[2].' '.$month[$explode_from[1]].' to '.$explode_to[2].' '.$month[$explode_to[1]].' '.$explode_to[0];
                                    }
                                    ?>
                              </td>                              
                              <td><a href="{{ URL::to('trainer/quizzes/'.$assigned->id) }}" title="Create assignment for this course"><i class="icon-pencil"></i></a></td>
                           </tr>
                           <?php
                              }
                              ?> 
                        </tbody>
                     </table>
                  </div>      
               </div>
               @endif  
               @if(Auth::user()->user_type == 5 && $route == 'trainee/dashboard')
                  <script>
                     //window.location.href = '{{ URL::to("trainee/engineers") }}';
                  </script>
               @endif                
               @if(in_array(Auth::user()->user_type, array(3, 5)))              
               <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                     <h3 id="myModalLabel">Enrolled Training</h3>
                  </div>
                  <div class="modal-body">
                     <table class="table table-striped table-bordered">
                        <thead>
                           <tr>
                              <th> Course </th>
                              <th> Date</th>
                              <th> Status</th>
                              <th class="td-actions"> </th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                              if(count($enrolledCourses) > 0):                                                                                
                              foreach($enrolledCourses as $enrolled) {
                              $explode_from = explode('-', $enrolled->date_from);
                              $explode_to = explode('-', $enrolled->date_to);
                              ?>
                           <tr align="center">
                              <td><a href="{{ URL::to('trainee/enrolled-training/'.$enrolled->id) }}" title="Go to this course">{{ $enrolled->name }}</a></td>
                              <td>
                                 <?php
                                    if($explode_from[1] == $explode_to[1]) {
                                    echo $explode_from[2].' - '.$explode_to[2].' '.$month[$explode_from[1]].' '.$explode_to[0];
                                    } else {
                                    echo $explode_from[2].' '.$month[$explode_from[1]].' to '.$explode_to[2].' '.$month[$explode_to[1]].' '.$explode_to[0];
                                    }
                                    ?>
                              </td>
                              <td>{{ $enrolled->attendance_status }}</td>
                              <td><a href="{{ URL::to('trainee/enrolled-training/'.$enrolled->id) }}" title="Go to this course"><i class="icon-fullscreen"></i></a></td>
                           </tr>
                           <?php
                              }
                              else:  
                              ?>
                                 <tr align="center">
                                    <td colspan="4">Empty Results</td>
                                 </tr>
                                 <?php
                              endif;                                                       
                              ?> 
                        </tbody>
                     </table>
                  </div>
                  <div class="modal-footer">
                     <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>                    
                  </div>
               </div>
               <div id="myEndedModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                     <h3 id="myModalLabel">Attended Training</h3>
                  </div>
                  <div class="modal-body">
                     <table class="table table-striped table-bordered">
                        <thead>
                           <tr>
                              <th> Course </th>
                              <th> Date</th>
                              <th> Status</th>
                              <th class="td-actions"> </th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 

                              if(count($endedCourses) > 0):                                                                         
                              foreach($endedCourses as $enrolled) {
                              $explode_from = explode('-', $enrolled->date_from);
                              $explode_to = explode('-', $enrolled->date_to);
                              ?>
                              <tr align="center">
                                 <td><a href="{{ URL::to('trainee/enrolled-training/'.$enrolled->id.'?status=attended') }}">{{ $enrolled->name }}</a></td>
                                 <td>
                                    <?php
                                       if($explode_from[1] == $explode_to[1]) {
                                       echo $explode_from[2].' - '.$explode_to[2].' '.$month[$explode_from[1]].' '.$explode_to[0];
                                       } else {
                                       echo $explode_from[2].' '.$month[$explode_from[1]].' to '.$explode_to[2].' '.$month[$explode_to[1]].' '.$explode_to[0];
                                       }
                                       ?>
                                 </td>
                                 <!--<td>{{ $enrolled->attendance_status }}</td>-->
                                 <td>Completed</td>
                                 <td><a href="{{ URL::to('trainee/enrolled-training/'.$enrolled->id.'?status=attended') }}" title="Go to this course"><i class="icon-fullscreen"></i></a></td>
                              </tr>
                           <?php
                              }
                              else:
                                 ?>
                                 <tr align="center">
                                    <td colspan="4">Empty Results</td>
                                 </tr>
                                 <?php
                              endif;                           
                              ?> 
                        </tbody>
                     </table>
                  </div>
                  <div class="modal-footer">
                     <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>                    
                  </div>
               </div>
                  @endif
               @endif
               <div class="row">
                  <div class="span12" style="padding-top: 10px;" id="main-container">
                     @if(Session::has('message'))
                     <div class="alert alert-info">
                        <button class="close" data-dismiss="alert" type="button">&times;</button>
                        {{ Session::get('message') }}
                     </div>
                     @endif
                     @if(Session::has('success'))
                     <div class="alert alert-success">
                        <button class="close" data-dismiss="alert" type="button">&times;</button>
                        {{ Session::get('success') }}
                     </div>
                     @endif
                     @if(Session::has('error'))
                     <div class="alert alert-error">
                        <button class="close" data-dismiss="alert" type="button">&times;</button>
                        {{ Session::get('error') }}
                     </div>
                     @endif
                     {{ $content }}                     
                  </div>
                  <!-- /span12 --> 
               </div>
               <!-- /row --> 
            </div>
            <!-- /container --> 
         </div>
         <!-- /main-inner --> 
      </div>
      <!-- /main -->
      <div class="footer">
         <div class="footer-inner">
            <div class="container">
               <div class="row">
                  <div class="span12" align="center"> &copy; Blue Mena Group {{ date('Y') }}. All Rights Reserved.</div>
                  <!-- /span12 --> 
               </div>
               <!-- /row --> 
            </div>
            <!-- /container --> 
         </div>
         <!-- /footer-inner --> 
      </div>   
      <!-- /footer --> 
      <!-- end of modal for delete -->
      <!-- Javascript
         ================================================== --> 
      <!-- Placed at the end of the document so the pages load faster -->       
      {{ HTML::script('resources/js/angular.min.js') }}
      {{ HTML::script('resources/js/excanvas.min.js') }}
      {{ HTML::script('resources/js/bootstrap.js') }}
      {{ HTML::script('resources/js/bootstrap-datepicker.js') }}
      {{ HTML::script('resources/js/full-calendar/fullcalendar.min.js') }}
      {{ HTML::script('resources/js/base.js') }}
      {{ HTML::script('resources/bootstrap/js/jquery.mask.min.js') }}
   </body>
</html>