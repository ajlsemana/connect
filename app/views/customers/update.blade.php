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
    	<h3>Edit Customer</h3>
    </div>
    <!-- /widget-header -->
    
    <div class="widget-content">
    	{{ Form::model($company, array('url'=>'admin/customers/updateData', 'class'=>'form-horizontal', 'id'=>'form-announcements', 'files' => true, 'role'=>'form', 'method' => 'post')) }}
		<div class="span3">&nbsp;</div>
		<div class="span7">
			<fieldset>
				<div class="control-group">											
					<label class="control-label" for="title">Logo:</label>
					<div class="controls">
						@if($company->logo != '')
						{{ HTML::image(Config::get('app.url_storage') . '/company_logo/'.$company->logo, 'logo', array('style' => 'width: 120; height: 120px;', 'class' => '')) }}
						@else
						{{ HTML::image(Config::get('app.url_storage') . '/profile_pic/no-photo.jpg', 'logo', array('style' => 'width: 100px; height: 100px;', 'class' => '')) }}
						@endif
						<br>
						{{ Form::hidden('old_logo', $company->logo) }}
						{{ Form::file('files[]', NULL) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
				
				<div class="control-group">											
					<label class="control-label" for="title">Company:</label>
					<div class="controls">
						{{ Form::text('company', $company->company, array('maxlength'=>'100')) }}
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
         {{ Form::hidden('id', $company->id) }}        
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