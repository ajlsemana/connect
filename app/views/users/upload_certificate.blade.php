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
    	<h3>Upload Training Certificate</h3>
    </div>
    <!-- /widget-header -->
    
    <div class="widget-content">
    	{{ Form::model($attendees[0], array('url'=>'admin/attendees/upload-certificate', 'class'=>'form-horizontal', 'files' => true, 'id'=>'form-users', 'role'=>'form', 'method' => 'post')) }}
    	<div class="container">
    		<div class="row">
				<div class="span4">
						<div class="control-group">											
							<label class="control-label" for="first_name">First Name:</label>
							<div class="controls">
								{{ $attendees[0]->first_name }}
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->			

						<div class="control-group">											
							<label class="control-label" for="last_name">Last Name:</label>
							<div class="controls">
								{{ $attendees[0]->last_name }}
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->

						<div class="control-group">											
							<label class="control-label" for="company">Company:</label>
							<div class="controls">
								{{ (array_key_exists($attendees[0]->company, $company) ? $company[$attendees[0]->company] : $attendees[0]->company) }}
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->

						<div class="control-group">											
							<label class="control-label">Primary Email:</label>
							<div class="controls">
								{{ $attendees[0]->primary_email_address }}
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->	

						<div class="control-group">											
							<label class="control-label">Secondary Email:</label>
							<div class="controls">
								{{ ($attendees[0]->secondary_email != '' ? $attendees[0]->secondary_email : 'n/a' ) }}
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->	

						<div class="control-group">											
							<label class="control-label" for="number">Contact No.:</label>
							<div class="controls">
								{{ $attendees[0]->contact_number }}
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->

						<div class="control-group">											
							<label class="control-label" for="courses">Training Course:</label>
							<div class="controls">
								{{ $attendees[0]->name }}								
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->

						<div class="control-group">											
							<label class="control-label" for="courses">Training Date:</label>
							<div class="controls">	
								<?php
									$date_from = substr(date('d M Y', strtotime($attendees[0]->date_from)), 3);
									$date_to = substr(date('d M Y', strtotime($attendees[0]->date_to)), 3);
									$training_date = date('d M Y', strtotime($attendees[0]->date_from)).' '.date('d M Y', strtotime($attendees[0]->date_to));
									if($date_from == $date_to) {
										$training_date = substr(date('d M Y', strtotime($attendees[0]->date_from)), 0, 2).' - '.date('d M Y', strtotime($attendees[0]->date_to));
									}									
								?>								
								{{ $training_date }}
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->														
		        </div>
		        <div class="span4">
		        	<strong>UPLOAD TRAINING CERTIFICATE</strong>
		        	{{ Form::file('files[]', NULL) }}<br>
		        	{{ Form::hidden('course', strtoupper($attendees[0]->name)) }}
		        	<a class="btn btn-primary submitForm">UPLOAD NOW</a>
		        	<a class="btn" href="{{ $url_cancel }}">CANCEL</a>
		        	<hr>
		        	<strong>DOWNLOAD CERTIFICATE</strong><br>
		        	<?php
		        		$path = Config::get('app.url_storage') . '/certificates/' . $attendees[0]->certificate;
		        	?>
		        	@if(! empty($attendees[0]->certificate))
		        	<a target="_blank" href="{{ $path }}"><i class="icon-large icon-certificate"></i> {{ $attendees[0]->certificate }}</a>
		        	@else
		        		n/a
		        	@endif
		        </div>
		    </div>
		    <br>
    	</div>
        {{ Form::hidden('id', $attendees[0]->rid) }}        
        
		{{ Form::close() }}
	</div><!-- /widget-content --> 
</div><!-- /widget -->	

<script type="text/javascript">
$(document).ready(function() {
    // Submit Form
    $('.submitForm').click(function() {
    	$('#form-users').submit();
    });
    
    $('#form-users input').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#form-users').submit();
		}
	});


	$('#attendance_status').change(function() {
		var v = $(this).val();

		if(v == 'Reschedule') {
			alert('If you choose to RESCHEDULE you also need to change the TRAINING DATE.');
		}
	});
});	
</script>