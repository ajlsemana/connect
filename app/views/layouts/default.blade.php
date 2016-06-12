<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>blueConnect</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
{{ HTML::style('resources/css/bootstrap.min.css') }}
{{ HTML::style('resources/css/bootstrap-responsive.min.css') }}
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
        rel="stylesheet">
{{ HTML::style('resources/css/font-awesome.css') }}
{{ HTML::style('resources/css/datepicker.css') }}
{{ HTML::style('resources/css/style.css') }}
{{ HTML::script('resources/js/jquery-1.7.2.min.js') }}

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
    	<div class="container">
    		<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
    			<span class="icon-bar"></span>
    			<span class="icon-bar"></span>
    			<span class="icon-bar"></span> 
    		</a>
    		{{ HTML::image('resources/img/logo-thumb.png', 'logo', array('id' => 'logo', 'title' => 'blue mena logo', 'class' => 'img-responsive')) }}           
      	
      		<div class="nav-collapse">
        		
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
        		<div class="span12">
          			
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
        		<div class="span12" align="center"> &copy; {{ date('Y') }} Blue Mena Group </div>
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
