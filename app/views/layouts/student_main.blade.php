<!DOCTYPE html>
<html lang="en" data-ng-app="">
<head>
  <meta charset="utf-8">
  <title>Blue Mena Group Portal</title>
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
        <a class="brand" href="{{ URL::to('admin/dashboard') }}">
          {{ HTML::image('resources/img/logo-thumb.png', 'logo', array('id' => 'logo', 'title' => 'blue mena logo', 'class' => 'img-responsive')) }}           
        </a>
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
</body>
</html>
