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
    <div class="widget-header"> <i class="icon-user"></i>
    	<h3>Add New Attendee</h3>
    </div>
    <!-- /widget-header -->
    
    <div class="widget-content">
    	{{ Form::open(array('url'=>'admin/attendees/addData', 'class'=>'form-horizontal', 'autocomplete'=>'off', 'id'=>'form-users', 'role'=>'form', 'method' => 'post')) }}
		<div class="span3">&nbsp;</div>
		<div class="span7">
			<fieldset>				
				<div class="control-group">											
					<label class="control-label" for="first_name">First Name:</label>
					<div class="controls">
						{{ Form::text('first_name', Input::old('first_name'), array('maxlength'=>'50')) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->				
				
				<div class="control-group">											
					<label class="control-label" for="last_name">Last Name:</label>
					<div class="controls">
						{{ Form::text('last_name', Input::old('last_name'), array('maxlength'=>'50')) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->

				<div class="control-group"> 
					<label class="control-label" for="company">Company:</label>                    
		          <div class="controls">
		            {{ Form::text('company', Input::old('company'), array('class' => 'form-control', 'maxlength'=>'100')) }}
		        	</div> <!-- /controls -->       
		        </div> <!-- /form-group -->

		        <div class="control-group"> 
					<label class="control-label" for="company">Contact Number:</label>                    
		          <div class="controls">
		            {{ Form::text('contact_number', Input::old('contact_number'), array('class' => 'form-control', 'maxlength'=>'15')) }}
		        	</div> <!-- /controls -->       
		        </div> <!-- /form-group -->

				<div class="control-group">											
					<label class="control-label" for="email_address">Email Address:</label>
					<div class="controls">
						{{ Form::text('email', Input::old('email'), array('maxlength'=>'100')) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->	
				<!--
				<div class="control-group">											
					<label class="control-label" for="user_type">Training Course:</label>
					<div class="controls">
						{{ Form::select('course', $course_options, Input::old('course'), array('id'=>'course_options')) }}
					</div> 			
				</div>
				-->	

				<div class="control-group">											
					<label class="control-label" for="user_type">Training Courses:</label>
					<div class="controls">
						<?php
							foreach($course_options as $courses){
								echo Form::checkbox('course[]', $courses).' '.$courses.'<br>';
							}
						?>
					</div> 			
				</div>

				<div class="control-group">											
					<label class="control-label" for="user_type">Remarks:</label>
					<div class="controls">
						{{ Form::textarea('remarks', Input::old('remarks'), array('id'=>'editor', 'style'=>'width: 400px; height: 100px;')) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->

				<div class="control-group">											
					<label class="control-label" for="user_type">Reference <i>(for admin)</i>:</label>
					<div class="controls">
						{{ Form::select('reference', array('' => '- Please Select -', 'POP' => 'POP', 'with PO' => 'with PO'), null, array('id' => '')) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
								
				<div class="control-group">											
					<label class="control-label" for=""></label>
					<div class="controls">
						<a class="btn btn-primary" id="submitForm">Submit</a>
						<a class="btn" href="{{ $url_cancel }}">Cancel</a>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
			</fieldset>
        </div>
        <div class="span2">&nbsp;</div>        
        {{ Form::hidden('filter_first_name', $filter_first_name) }}       
        {{ Form::hidden('filter_last_name', $filter_last_name) }}
        {{ Form::hidden('filter_primary_email', $filter_primary_email) }}
        {{ Form::hidden('filter_status', $filter_status) }}    
        {{ Form::hidden('sort', $sort) }}
        {{ Form::hidden('order', $order) }}
        
		{{ Form::close() }}
	</div><!-- /widget-content --> 
</div><!-- /widget -->	

<script type="text/javascript">
$(document).ready(function() {
    // Submit Form
    $('#submitForm').click(function() {
    	$('#form-users').submit();
    });
    
    $('#form-users input').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#form-users').submit();
		}
	});
});	
</script>