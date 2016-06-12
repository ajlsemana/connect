<h1 class="page-header">{{ $header_title }}</h1>

<div class="panel panel-default">
  <div class="panel-body">
    Group Code: <strong>{{ $class_info->group_code }}</strong>
  </div>
</div>
	
<div class="row">											
	<div class="col-sm-12">
		<ul class="nav nav-tabs" role="tablist" id="myTab">
		  	<li class="active">
		  		<a href="{{ $url_class }}" role="tab"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Wall</a>
		  	</li>				
		  	<li>
		  		<a href="{{ $url_class . '/topics' }}" role="tab"><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Topics</a>
		  	</li>	
		  	<li>
		  		<a href="{{ $url_class . '/projects' }}" role="tab"><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;Projects</a>
		  	</li>
			<li>
				<a href="{{ $url_class . '/assignments' }}" role="tab"><span class="glyphicon glyphicon-file"></span>&nbsp;&nbsp;Assignments</a>
			</li>
			<li>
				<a href="{{ $url_class . '/exams' }}" role="tab"><span class="glyphicon glyphicon-tasks"></span>&nbsp;&nbsp;Exams</a>
			</li>
			<li>
				<a href="{{ $url_class . '/quizzes' }}" role="tab"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Quizzes</a>
			</li>	
			<li>
				<a href="{{ $url_class . '/grades' }}" role="tab"><span class="glyphicon glyphicon-star"></span>&nbsp;&nbsp;Grades</a>
			</li>
			<li>
				<a href="{{ $url_class . '/students' }}" role="tab"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Students</a>
			</li>				
		</ul>
	</div>																
</div> <!-- /row -->
<br/>	
<div class="tab-content">
	<div class="tab-pane active" id="wall">
		<div class="row">
			<div class="col-sm-12">
				@if(count(Session::get('error')) > 0)	
					<div class="alert alert-warning" role="alert">
				    	<button class="close" data-dismiss="alert" type="button">&times;</button>    	    	
				    	{{ HTML::ul(Session::get('error')) }}
				    </div>
				@endif

				{{ Form::open(array('url' => 'faculty/upload', 'files' => true, 'class'=>'form-horizontal', 'autocomplete'=>'off', 'id'=>'form-post', 'role'=>'form', 'method' => 'post')) }}
				{{ Form::textarea('post_msg', null, array('placeholder' => 'Type your message here...', 'size' => '30x3', 'class' => 'form-control', 'id'=> 'post_msg', 'maxlength' => 5000)) }}
			    {{ Form::file('files[]', array('multiple' => true)) }}
			    <label class="control-label" for="upload-this">Upload this post under? </label> 
			    {{ Form::radio('upload_under', 1) }} Lecture
			    {{ Form::radio('upload_under', 2) }} Project
			    {{ Form::radio('upload_under', 3) }} Assignment
			    <br />				     
			    {{ Form::hidden('url_segment', $url_segment) }}
				<a class="btn btn-primary" id="submitForm">Submit</a>
				<a class="btn btn-default" href="">Cancel</a>			
			    {{ Form::close() }}	
		    </div>
		</div>	

		<br />

	    <div class="row">
	    	<div class="col-sm-12">
				Wall
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	$(function () {
	    $('#myTab').tab();
	})

    // Submit Form
    $('#submitForm').click(function() {
    	$('#form-post').submit();
    });
    
    $('#form-post input').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#form-post').submit();
		}
	});
});
</script>