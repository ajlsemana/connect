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
    	<h3>Training Cost for <u>{{ strtoupper($full_course) }}</u></h3>
    </div>
    <!-- /widget-header -->
    
    <div class="widget-content">
    	{{ Form::model($training_cost, array('url'=>'admin/attendees/update-cost', 'class'=>'form-horizontal', 'id'=>'form-users', 'role'=>'form', 'method' => 'post')) }}
		<div class="span3">&nbsp;</div>
		<div class="span7">
			<fieldset>				
				<div class="control-group">											
					<label class="control-label" for="">Groceries:</label>
					<div class="controls">
						{{ Form::text('groceries', null, array('maxlength'=>'50')) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->	

				<div class="control-group">											
					<label class="control-label" for="">Lunch:</label>
					<div class="controls">
						{{ Form::text('lunch', null, array('maxlength'=>'50')) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->

				<div class="control-group">											
					<label class="control-label" for="">Room:</label>
					<div class="controls">
						{{ Form::text('room', null, array('maxlength'=>'50')) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->	

				<div class="control-group">											
					<label class="control-label" for="">Trainer:</label>
					<div class="controls">
						{{ Form::text('trainer', null, array('maxlength'=>'50')) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->	

				<div class="control-group">											
					<label class="control-label" for="">Stationary:</label>
					<div class="controls">
						{{ Form::text('stationary', null, array('maxlength'=>'50')) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->	

				<div class="control-group">											
					<label class="control-label" for="">Transportation:</label>
					<div class="controls">
						{{ Form::text('transportation', null, array('maxlength'=>'50')) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->	

				<div class="control-group">											
					<label class="control-label" for="">Miscellaneous:</label>
					<div class="controls">
						{{ Form::text('miscellaneous', null, array('maxlength'=>'50')) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
				<hr>
				<div class="control-group">											
					<label class="control-label" for="">Total Cost:</label>
					<div class="controls">
						<b>
						<?php
							$sum = 0;
							$sum = $training_cost->groceries + $training_cost->lunch + $training_cost->room
								+ $training_cost->trainer + $training_cost->stationary + $training_cost->transportation + $training_cost->miscellaneous;

							echo (double) $sum;
						?>
						</b>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->			

				<div class="control-group">											
					<label class="control-label" for=""></label>
					<div class="controls">
						<a class="btn btn-primary" id="submitForm">Update</a>
						<a class="btn" href="javascript:window.history.back();">Cancel</a>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
			</fieldset>
        </div>
        <div class="span2">&nbsp;</div>
    
        {{ Form::hidden('id', $training_cost->id) }}
        {{ Form::hidden('course', $training_cost->course) }}
        
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