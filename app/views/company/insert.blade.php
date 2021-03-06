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
    <div class="widget-header"> <i class="icon-truck"></i>
    	<h3>Add New Service Provider</h3>
    </div>
    <!-- /widget-header -->
    
    <div class="widget-content">
    	{{ Form::open(array('url'=>'admin/company/addData', 'class'=>'form-horizontal', 'autocomplete'=>'off', 'id'=>'form-announcements', 'role'=>'form', 'files' => true, 'method' => 'post')) }}
		<div class="span2">&nbsp;</div>
		<div class="span8">
			<fieldset>
				<div class="control-group">											
					<label class="control-label" for="title">Logo:</label>
					<div class="controls">
						{{ Form::file('files[]', NULL) }}<br>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
				<div class="control-group">											
					<label class="control-label" for="title">Service Provider:</label>
					<div class="controls">
						{{ Form::text('company', Input::old('company'), array('maxlength'=>'100')) }}
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