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
    	<h3>Edit User</h3>
    </div>
    <!-- /widget-header -->
    
    <div class="widget-content">
    	{{ Form::model($user, array('url'=>'admin/users/updateData', 'class'=>'form-horizontal', 'files' => true, 'id'=>'form-users', 'role'=>'form', 'method' => 'post')) }}
		<div class="span3">&nbsp;</div>
		<div class="span7">
			<fieldset>
				<div class="control-group">											
					<label class="control-label" for="code">Photo:</label>
					<div class="controls">
						<?php
	                     $pic = 'no-photo.jpg';
	                     $destinationPath = Config::get('app.url_storage') . '/profile_pic/'.$pic;                       
                     ?>       
	                  @if(! empty($user->profile_pic))
	                  <?php $pic = $user->profile_pic; ?>
	                  <?php $destinationPath = Config::get('app.url_storage') . '/profile_pic/'.$pic; ?>           
	                  @endif                  
                  {{ HTML::image($destinationPath, 'profile picture', array('width' => '120', 'height' => '120', 'title' => 'photo', 'class' => 'img-responsive')) }}
                  <br>
                  {{ Form::file('image') }}	
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->				
				<div class="control-group">											
					<label class="control-label" for="username">Username:</label>
					<div class="controls">
						{{ Form::text('username', $user->username, array('maxlength'=>'50', 'readonly' => 'readonly')) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->

				<div class="control-group">											
					<label class="control-label" for="user_type">User Type:</label>
					<div class="controls">
						<input type="radio" class="r-type" name="user_type" value="2" @if($user->user_type == 2) checked @endif> Trainer													
						<input type="radio" class="r-type" name="user_type" value="3" @if($user->user_type == 3 && $user->skills_map == 0) checked @endif> Trainee					
						<input type="radio" class="r-type" name="user_type" value="4" @if($user->user_type == 3 && $user->skills_map == 1) checked @endif> Engineer						
						<input type="radio" class="r-type" name="user_type" value="5" @if($user->user_type == 5) checked @endif> Resource Manager
					</div> <!-- /controls -->	
					<div id="r-msg"></div>			
				</div> <!-- /control-group -->
				
				<div class="control-group">											
					<label class="control-label" for="first_name">First Name:</label>
					<div class="controls">
						{{ Form::text('first_name', null, array('maxlength'=>'50')) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
				
				<div class="control-group">											
					<label class="control-label" for="middle_name">Middle Name:</label>
					<div class="controls">
						{{ Form::text('middle_name', null, array('maxlength'=>'50')) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->

				<div class="control-group">											
					<label class="control-label" for="last_name">Last Name:</label>
					<div class="controls">
						{{ Form::text('last_name', null, array('maxlength'=>'50')) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->

				<div class="control-group">											
					<label class="control-label" for="email_address">Email Address:</label>
					<div class="controls">
						{{ Form::text('primary_email_address', null, array('maxlength'=>'100')) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
				
				<div class="control-group">											
					<label class="control-label" for="email_address">Company:</label>
					<div class="controls" id="comp">
						@if($user->skills_map == 1 || $user->user_type == 2 || $user->user_type == 5)
							{{ Form::select('company', $companies, null, array('id'=>'utype')) }}
						@else 
							{{ Form::text('company', null, array('maxlength'=>'100')) }}
						@endif
					</div> <!-- /controls -->				
				</div>

				<div class="control-group">											
					<label class="control-label" for="email_address">Job Position:</label>
					<div class="controls">
						{{ Form::text('position', null, array('maxlength'=>'100')) }}
					</div> <!-- /controls -->				
				</div>				

				<div class="control-group">											
					<label class="control-label" for="status">Status:</label>
					<div class="controls">
						{{ Form::select('status', $status_options, null, array('id'=>'status')) }}
						{{ Form::hidden('skills_map', $user->skills_map) }}
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
        {{ Form::hidden('id', $user->id) }}
        {{ Form::hidden('filter_username', $filter_username) }}
        {{ Form::hidden('filter_first_name', $filter_first_name) }}
        {{ Form::hidden('filter_middle_name', $filter_middle_name) }}
        {{ Form::hidden('filter_last_name', $filter_last_name) }}
        {{ Form::hidden('filter_primary_email', $filter_primary_email) }}
        {{ Form::hidden('filter_user_type', $filter_user_type) }}
        {{ Form::hidden('filter_status', $filter_status) }}
        {{ Form::hidden('sort', $sort) }}
        {{ Form::hidden('order', $order) }}
        {{ Form::hidden('mode', 'user') }}
        
		{{ Form::close() }}
	</div><!-- /widget-content --> 
</div><!-- /widget -->	

<script type="text/javascript">
$(document).ready(function() {
	$('.r-type').click(function() {
    	var value = $(this).val();
    	var dd = '{{ Form::text('company', $user->company, array('maxlength'=>'100')) }}';

    	if(value == 4 || value == 5) {  		
			dd = '{{ Form::select('company', $companies, null, array('id'=>'utype')) }}';			
			$('#r-msg').html('<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>Select a new company if you want to change user type into Engineer or Resource Manager.</div>');			
    	}

    	$('#comp').html(dd);
    });

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