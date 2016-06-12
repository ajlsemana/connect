<h1 class="page-header">{{ $header_title }}</h1>
	
<div class="row">											
	<div class="col-sm-12">
		<ul class="nav nav-tabs" role="tablist" id="myTab">
			<li class="{{ ($tab_active == 'home') ? 'active' : '' }}">
		  		<a href="{{ $url_class }}" role="tab"><i class="fa fa-home fa-fw"></i>&nbsp;&nbsp;Home</a>
		  	</li>
		  	<li class="{{ ($tab_active == 'wall') ? 'active' : '' }}">
		  		<a href="{{ $url_class }}" role="tab"><i class="fa fa-comment fa-fw"></i>&nbsp;&nbsp;Announcements</a>
		  	</li>
			<li class="{{ ($tab_active == 'quizzes') ? 'active' : '' }}">
				<a href="{{ $url_class.'/quizzes' }}" role="tab"><i class="fa fa-pencil-square-o fa-fw"></i>&nbsp;&nbsp;Assignments</a>
			</li>	
			<li class="{{ ($tab_active == 'certificates') ? 'active' : '' }}">
				<a href="{{ $url_class.'/quizzes' }}" role="tab"><i class="fa fa-certificate fa-fw"></i>&nbsp;&nbsp;Certificates</a>
			</li>
			<li class="{{ ($tab_active == 'calendar') ? 'active' : '' }}">
				<a href="{{ $url_class.'/quizzes' }}" role="tab"><i class="fa fa-calendar fa-fw"></i>&nbsp;&nbsp;Calendar</a>
			</li>
			<li class="{{ ($tab_active == 'survey') ? 'active' : '' }}">
				<a href="{{ $url_class.'/quizzes' }}" role="tab"><i class="fa fa-check-square-o fa-fw"></i>&nbsp;&nbsp;Survey</a>
			</li>										
		</ul>
	</div>																
</div> <!-- /row -->
<br/>