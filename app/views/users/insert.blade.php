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
    	<h3>Add New User</h3>
    </div>
    <!-- /widget-header -->
    
    <div class="widget-content">
    	{{ Form::open(array('url'=>'admin/users/addData', 'class'=>'form-horizontal', 'autocomplete'=>'off', 'id'=>'form-users', 'role'=>'form', 'method' => 'post')) }}
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
		            {{ Form::select('company', $companies) }}
		        	</div> <!-- /controls -->       
		        </div> <!-- /form-group -->

		        <div class="control-group"> 
					<label class="control-label" for="company">Position:</label>                    
		          <div class="controls">
		            {{ Form::text('position', Input::old('position'), array('class' => 'form-control', 'maxlength'=>'100')) }}
		        	</div> <!-- /controls -->       
		        </div> <!-- /form-group -->

				<div class="control-group">											
					<label class="control-label" for="email_address">Primary Email:</label>
					<div class="controls">
						{{ Form::text('primary_email_address', Input::old('primary_email_address'), array('maxlength'=>'100')) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->

				<div class="control-group">											
					<label class="control-label" for="email_address">Secondary Email:</label>
					<div class="controls">
						{{ Form::text('secondary_email', Input::old('secondary_email'), array('maxlength'=>'100')) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
				
				<div class="control-group">											
					<label class="control-label" for="user_type">User Type:</label>
					<div class="controls">
						{{ Form::select('user_type', $user_type_options, Input::old('user_type'), array('id'=>'user_type')) }}
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
        {{ Form::hidden('filter_username', $filter_username) }}
        {{ Form::hidden('filter_first_name', $filter_first_name) }}
        {{ Form::hidden('filter_middle_name', $filter_middle_name) }}
        {{ Form::hidden('filter_last_name', $filter_last_name) }}
        {{ Form::hidden('filter_primary_email', $filter_primary_email) }}
        {{ Form::hidden('filter_user_type', $filter_user_type) }}
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