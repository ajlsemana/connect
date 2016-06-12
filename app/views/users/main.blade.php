<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Blue Mena Group | Admin</title>
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
        <a class="brand" href="{{ URL::to('admin/dashboard') }}">Blue Mena Group</a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          @if(Auth::check())
          <li>
            <a style="cursor: default;">Hi {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} 
              <em>
                <?php
                  $type = '';
                  switch(Auth::user()->user_type) {
                    case 1: $type = 'Admin'; break;
                    case 2: $type = 'Trainer'; break;
                    case 3: $type = 'Trainee'; break;
                    default: $type = 'Unknown';
                  }                  
                ?>
                ({{ $type }})
              </em>
            </a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="icon-user"></i> Account <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="{{ URL::to('user/profile') }}">Profile</a></li>
                <li><a href="{{ URL::to('user/change_password') }}">Change Password</a></li>
                <li><a href="{{ URL::to('auth/logout') }}">Logout</a></li>
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
        <li class="@if (in_array($route, array('admin/attendees', 'admin/attendees/add', 'admin/attendees/update'))) active @endif"><a href="{{ URL::to('admin/attendees') }}"><i class="icon-list"></i><span>Attendees</span> </a> </li>    
        <li class="@if (in_array($route, array('admin/training-courses', 'admin/training-courses/add', 'admin/training-courses/update'))) active @endif"><a href="{{ URL::to('admin/training-courses') }}"><i class="icon-bell"></i><span>Training</span> </a> </li>
        <li class="@if (in_array($route, array('admin/announcements', 'admin/announcements/add', 'admin/announcements/update'))) active @endif"><a href="{{ URL::to('admin/announcements') }}"><i class="icon-calendar "></i><span>Activities</span> </a> </li>
        @else
        <li class="@if (in_array($route, array('admin/dashboard'))) active @endif"><a href="{{ URL::to('admin/dashboard') }}"><i class="icon-home"></i><span>Home</span> </a> </li>
        <!--<li class="@if (in_array($route, array('admin/attendees/temp-update', 'admin/attendees/temp-listings', 'admin/attendees/add', 'admin/attendees/update'))) active @endif"><a href="{{ URL::to('admin/attendees/temp-listings') }}"><i class="icon-list"></i><span>Attendees</span> </a> </li>-->
        <li class="dropdown @if (in_array($route, array('admin/attendees/temp-listings-info/{id}', 'admin/attendees/temp-listings/{course}', 'admin/attendees/temp-update', 'admin/attendees/temp-listings', 'admin/attendees/add', 'admin/attendees/update'))) active @endif"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> 
          <i class="icon-list"></i><span>Attendees</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="{{ URL::to('admin/attendees/temp-listings') }}">All Courses</a></li>
            <li><a href="{{ URL::to('admin/attendees/temp-listings/TA') }}">Technical Administration</a></li> 
            <li><a href="{{ URL::to('admin/attendees/temp-listings/SD') }}">Script Development</a></li>
            <li><a href="{{ URL::to('admin/attendees/temp-listings/IFO') }}">Inbound Floor Operations</a></li>
            <li><a href="{{ URL::to('admin/attendees/temp-listings/OFO') }}">Outbound Floor Operations</a></li>
            <li><a href="{{ URL::to('admin/attendees/temp-listings/ITCC') }}">Introduction to Contact Center</a></li>                 
        </li>
        @endif
        <!--
        <li class="@if (in_array($route, array('admin/sections', 'admin/sections/add', 'admin/sections/update'))) active @endif"><a href="{{ URL::to('admin/sections') }}"><i class="icon-th-large "></i><span>Sections</span> </a></li>
        <li class="@if (in_array($route, array('admin/manage_faculty', 'admin/manage_faculty/add', 'admin/manage_faculty/update'))) active @endif"><a href="{{ URL::to('admin/manage_faculty') }}"><i class="icon-group"></i><span>Manage Faculty</span> </a> </li>
        -->
        <!--<li class="dropdown @if (in_array($route, array('admin/users', 'admin/users/add', 'admin/semesters', 'admin/users/update', 'admin/announcements', 'admin/announcements/add', 'admin/announcements/update'))) active @endif"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> 
          <i class="icon-cogs"></i><span>Settings</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="{{ URL::to('admin/users') }}">Users</a></li>
            <li><a href="{{ URL::to('admin/announcements') }}">Annoucements</a></li>
            <li><a href="{{ URL::to('admin/semesters') }}">Semesters</a></li>-->
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
          <div class="row">
            <div class="span12" style="padding-top: 10px;">
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
                
            </div><!-- /span12 --> 
          </div><!-- /row --> 
      </div><!-- /container --> 
    </div><!-- /main-inner --> 
</div><!-- /main -->

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

<!-- Javascript
================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 

{{ HTML::script('resources/js/excanvas.min.js') }}
{{ HTML::script('resources/js/chart.min.js') }}
{{ HTML::script('resources/js/bootstrap.js') }}
{{ HTML::script('resources/js/bootstrap-datepicker.js') }}
{{ HTML::script('resources/js/full-calendar/fullcalendar.min.js') }}

{{ HTML::script('resources/js/base.js') }}

</body>
</html>
