<?php date_default_timezone_set('Asia/Manila'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TBLSys</title>

    {{ HTML::style('resources/bootstrap/css/bootstrap.css') }}
    {{ HTML::style('resources/bootstrap/css/dashboard.css') }}
    {{ HTML::style('resources/bootstrap/css/datepicker.css') }}

    {{ HTML::script('resources/js/jquery-1.7.2.min.js') }}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">UMAK-TBLSys</a>
        </div>
        <div class="navbar-collapse collapse">  
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">              
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ URL::to('faculty/profile') }}">Profile</a></li>
                <li><a href="{{ URL::to('faculty/change_password') }}">Change Password</a></li>
                <li class="divider"></li>
                <li><a href="{{ URL::to('faculty/logout') }}">Logout</a></li>
              </ul>
            </li>
          </ul>
          <p class="navbar-text navbar-right">&nbsp;</p>
          <p class="navbar-text navbar-right">Hi {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} 
              <em>
                <?php
                  $type = '';
                  switch(Auth::user()->user_type) {
                    case 1: $type = 'Admin'; break;
                    case 2: $type = 'Faculty'; break;
                    case 3: $type = 'Student'; break;
                    default: $type = 'Unknown';
                  }                  
                ?>
                ({{ $type }})
                <span id="notif"></span>
              </em>
          </p>       
        </div>
      </div>
    </div>
    <!--
    <div class="container-fluid">
      <div class="row">
        <div role="navigation">
              <ul class="nav nav-justified">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Projects</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Downloads</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
              </ul>
         </div>
       </div>
    </div>
    -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          {{ $sidebar }}

          <ul class="nav nav-sidebar">
            <li class="{{ ($route=='faculty/calendar') ? 'active' : '' }}"><a href="{{ URL::to('faculty/calendar') }}">Calendar</a></li>
            <li class="{{ ($route=='faculty/announcements') ? 'active' : '' }}"><a href="{{ URL::to('faculty/announcements') }}">Announcements</a></li>
            <li>
                <a href="#">Class</a>
                @if ($menu_subjects)
                <ul class="nav" style="margin-left: 15px;">
                  @foreach ($menu_subjects as $item)
                  <li class="{{ (substr($route, 0, 31) == 'faculty/class/{id}/{group_code}' && Request::segment(3) == $item['id']) ? 'active' : '' }}"><a href="{{ $item['url'] }}">{{ $item['name'] }}</a></li>
                  @endforeach
                </ul>
                @endif
            </li>            
          </ul>
        </div>        
          <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">   
            @if(Session::has('message'))
            <div class="alert alert-info alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              {{ Session::get('message') }}
            </div>
            @endif
                
            @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              {{ Session::get('success') }}
            </div>
            @endif
                
            @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              {{ Session::get('error') }}
            </div>
            @endif

            @if( $errors->all() )   
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              {{ HTML::ul($errors->all()) }}
            </div>
            @endif                    
            {{ $content }}
          </div>        
      </div>
    </div>
<!--modal for view -->
<div class="modal fade" id="viewModalNotif" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Notifications</h4>
      </div>
      <div class="modal-body" id="modal-msg">        
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end of modal for view -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    {{ HTML::script('resources/bootstrap/js/bootstrap.min.js') }}
    {{ HTML::script('resources/bootstrap/js/docs.min.js') }}
    {{ HTML::script('resources/bootstrap/js/ie10-viewport-bug-workaround.js') }}
    {{ HTML::script('resources/bootstrap/js/bootstrap-datepicker.js') }}
    {{ HTML::script('resources/bootstrap/js/jquery.mask.min.js') }}
    <script>
      getNotification();

      function getNotification() {            
        $.ajax({
          type: 'GET',
          dataType: 'json',
          url: '{{ URL::to("faculty/faculty_notification") }}',          
        }).success(function( data ) { 
          var html = '';                        
          var msg = '';
          var pending = '';
          var month = '{{ date("M") }}';
          if(data.total > 0) {            
            var url_cal = "{{ URL::to('faculty/calendar') }}"; 
            var url_announcement = "{{ URL::to('faculty/announcements') }}";           
            msg += '<div class="form-group">';
            msg += '<label for="title" class="col-sm-4 control-label">University Calendar:</label>';
            msg += 'Today\'s Event<strong><a href="'+url_cal+'">('+data.calendar_today+')</a></strong>;';
            msg += ' Upcoming Event this '+month+'<strong><a href="'+url_cal+'">('+data.calendar_month+')</a></strong>';
            msg +=  '</div>';

            msg += '<div class="form-group">';
            msg += '<label for="title" class="col-sm-4 control-label">Announcement:</label>';
            msg += 'Today\'s Announcement<strong><a href="'+url_announcement+'">('+data.announcement_today+')</a></strong>;';
            msg += ' Upcoming Announcement this '+month+'<strong><a href="'+url_announcement+'">('+data.announcement_month+')</a></strong>';
            msg +=  '</div>';

            html += '<a data-toggle="modal" data-target="#viewModalNotif" data-id="11" class="view glyphicon glyphicon-exclamation-sign" style="color: #ff0000; cursor: pointer;" title="View notification"></a>';                    

            @if(Auth::user()->user_type == 2)
              if(data.pending_count > 0) {
                pending += '<div class="form-group">';
                pending += '<label for="title" class="col-sm-4 control-label">Subject Request('+data.pending_count+'):</label>';            
                pending += data.pending_result;
                pending +=  '</div>';
                msg += pending;
              }
            @endif

            $('#notif').html( html );  
            $('#modal-msg').html( msg );             
          }
        });
      }
    </script>
  </body>
</html>
