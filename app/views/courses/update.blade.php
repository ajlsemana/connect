<ol class="breadcrumb">
	@foreach ($breadcrumbs as $breadcrumb)
		<li class="{{ $breadcrumb['class'] }}"><a href="{{ $breadcrumb['href'] }}">{{ $breadcrumb['text'] }}</a></li>
   	@endforeach
</ol>

@if( $errors->all() )
    <div class="alert alert-error">
    	<button class="close" data-dismiss="alert" type="button">&times;</button>
    	{{ HTML::ul($errors->all()) }}
    </div>
@endif
<div class="widget">
    <div class="widget-header"> <i class="icon-list-alt"></i>
    	<h3>Edit Training Course</h3>
    </div>
    <!-- /widget-header -->
    
    <div class="widget-content">
    	{{ Form::model($courses, array('url'=>'admin/training-courses/updateData', 'class'=>'form-horizontal', 'id'=>'form-courses', 'role'=>'form', 'method' => 'post')) }}
		<div class="span2">&nbsp;</div>
		<div class="span8">
			<fieldset>				
				<div class="control-group">											
					<label class="control-label" for="name">Course Name:</label>
					<div class="controls">
						{{ Form::text('name', $courses->name, array('maxlength'=>'100')) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->				

				<div class="control-group">											
					<label class="control-label" for="">Date From:</label>
					<div class="controls">
						<input type="date" name="date_from" value="{{ $courses->date_from }}" required>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->

				<div class="control-group">											
					<label class="control-label" for="">Date To:</label>
					<div class="controls">
						<input type="date" name="date_to" value="{{ $courses->date_to }}" required>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
				<?php $time_explode = explode('-', $courses->time); ?>
				<div class="control-group">											
					<label class="control-label" for="">Duration:</label>
					<div class="controls">
						{{ Form::select('duration', array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'), null, array('style'=>'width: 50px;')) }} 
						<a href="{{ URL::to('admin/training-courses/add-activity?id='.$courses->id) }}">+ Add Activity Calendar</a>						
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->

				<div class="control-group">											
					<label class="control-label" for="">Time:</label>
					<div class="controls">						
						<input type="time" name="time_from" value="{{ $time_explode[0] }}" required> to <input type="time" name="time_to" value="{{ $time_explode[1] }}" required>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->

				<div class="control-group">											
					<label class="control-label" for="">Trainer:</label>
					<div class="controls">
						{{ Form::select('trainer', $assigned_trainer, null, array('id'=>'status')) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->

				<div class="control-group">											
					<label class="control-label" for="">Status:</label>
					<div class="controls">
						{{ Form::select('status', array('Ended', 'Open'), null, array('id'=>'status')) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
												
				<div class="control-group">											
					<label class="control-label" for=""></label>
					<div class="controls">
						<a class="btn btn-primary" id="submitForm">Update</a>
						<a class="btn" href="{{ $url_cancel }}">Cancel</a>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
			</fieldset>
        </div>
        <div class="span2">&nbsp;</div>
        {{ Form::hidden('id', $courses->id) }}
        {{ Form::hidden('filter_name', $filter_name) }}
        {{ Form::hidden('sort', $sort) }}
        {{ Form::hidden('order', $order) }}
        
		{{ Form::close() }}
	</div><!-- /widget-content --> 
</div><!-- /widget -->	

<script type="text/javascript">
$(document).ready(function() {
	// Submit Form
    $('#submitForm').click(function() {
    	$('#form-courses').submit();
    });
    
    $('#form-courses input').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#form-courses').submit();
		}
	});
});	
</script>