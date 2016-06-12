<h1 class="page-header">{{ $header_title }}</h1>		
<div class="panel panel-default">
  <div class="panel-body">
    Group Code: <strong>{{ $class_info->group_code }}</strong>
  </div>
</div>
	
<div class="row">											
	<div class="col-sm-12">
		<ul class="nav nav-tabs" role="tablist" id="myTab">
		  	<li class="{{ ($tab_active == 'wall') ? 'active' : '' }}">
		  		<a href="{{ $url_class }}" role="tab"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Wall</a>
		  	</li>			  			
		  	<li class="{{ ($tab_active == 'topics') ? 'active' : '' }}">
		  		<a href="{{ $url_class . '/topics' }}" role="tab"><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Topics</a>
		  	</li>		  	
		  	<li class="{{ ($tab_active == 'projects') ? 'active' : '' }}">
		  		<a href="{{ $url_class . '/projects' }}" role="tab"><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;Projects</a>
		  	</li>
			<li class="{{ ($tab_active == 'assignments') ? 'active' : '' }}">
				<a href="{{ $url_class . '/assignments' }}" role="tab"><span class="glyphicon glyphicon-file"></span>&nbsp;&nbsp;Assignments</a>
			</li>
			<!--<li class="{{ ($tab_active == 'exams') ? 'active' : '' }}">
				<a href="{{ $url_class . '/exams' }}" role="tab"><span class="glyphicon glyphicon-tasks"></span>&nbsp;&nbsp;Exams</a>
			</li>-->
			<li class="{{ ($tab_active == 'quizzes') ? 'active' : '' }}">
				<a href="{{ $url_class . '/quizzes' }}" role="tab"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Quizzes</a>
			</li>	
			<li class="{{ ($tab_active == 'grades') ? 'active' : '' }}">
				<a href="{{ $url_class . '/grades' }}" role="tab"><span class="glyphicon glyphicon-star"></span>&nbsp;&nbsp;Grades</a>
			</li>	
			<li class="{{ ($tab_active == 'students') ? 'active' : '' }}">
				<a href="{{ $url_class . '/students' }}" role="tab"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Students</a>
			</li>
			<li class="{{ ($tab_active == 'conference') ? 'active' : '' }}">
				<a href="{{ $video_link }}" target="_blank" role="tab"><span class="glyphicon glyphicon-facetime-video"></span>&nbsp;&nbsp;Conference</a>
			</li>		
		</ul>
	</div>																
</div> <!-- /row -->
<br/>