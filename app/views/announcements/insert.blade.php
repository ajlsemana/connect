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
    <div class="widget-header"> <i class="icon-bullhorn"></i>
    	<h3>Add New Announcement</h3>
    </div>
    <!-- /widget-header -->
    
    <div class="widget-content">
    	{{ Form::open(array('url'=>'admin/announcements/addData', 'class'=>'form-horizontal', 'autocomplete'=>'off', 'id'=>'form-announcements', 'role'=>'form', 'method' => 'post')) }}
		<div class="span2">&nbsp;</div>
		<div class="span8">
			<fieldset>
				<div class="control-group">											
					<label class="control-label" for="title">Title:</label>
					<div class="controls">
						{{ Form::text('title', Input::old('title'), array('maxlength'=>'255')) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
				
				<div class="control-group">											
					<label class="control-label" for="content">Description:</label>
					<div class="controls">
						{{ Form::textarea('content', Input::old('content'), array('id'=>'editor', 'style'=>'width: 400px; height: 200px;')) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->

				<div class="control-group">											
					<label class="control-label" for="date_from">Date Start:</label>
					<div class="controls">
						{{ Form::text('date_from', Input::old('date_from'), array('class'=>'date', 'maxlength'=>'10', 'style'=>'width: 100px;')) }}
						<br />
						{{ Form::checkbox('same_day', 1, Input::old('same_day')) }}&nbsp;&nbsp;Same day event?
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->

				<div class="control-group">											
					<label class="control-label" for="date_to">Date End:</label>
					<div class="controls">
						{{ Form::text('date_to', Input::old('date_to'), array('class'=>'date', 'id'=>'date_to', 'maxlength'=>'10', 'style'=>'width: 100px;')) }}
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
        {{ Form::hidden('filter_title', $filter_title) }}
        {{ Form::hidden('filter_date_from', $filter_date_from) }}
        {{ Form::hidden('filter_date_to', $filter_date_to) }}
        {{ Form::hidden('sort', $sort) }}
        {{ Form::hidden('order', $order) }}
        
		{{ Form::close() }}
	</div><!-- /widget-content --> 
</div><!-- /widget -->	

<script type="text/javascript">
$(document).ready(function() {	
	$('.date').datepicker({
      format: 'yyyy-mm-dd'
    });

    // Submit Form
    $('#submitForm').click(function() {
    	$('#form-announcements').submit();
    });
    
    $('#form-announcements input').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#form-announcements').submit();
		}
	});

	$('input[name=\'same_day\']').click(function() {
		$('#date_to').val('');
	});
});	
</script>