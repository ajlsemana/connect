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
    <div class="widget-header"> <i class="icon-calendar"></i>
    	<h3>Add New Semester</h3>
    </div>
    <!-- /widget-header -->
    
    <div class="widget-content">
    	{{ Form::open(array('url'=>'admin/semesters/addData', 'class'=>'form-horizontal', 'autocomplete'=>'off', 'id'=>'form-semester', 'role'=>'form', 'method' => 'post')) }}
		<div class="span2">&nbsp;</div>
		<div class="span8">
			<fieldset>
				<div class="control-group">											
					<label class="control-label" for="title">Semester:</label>
					<div class="controls">
						{{ Form::text('semester', Input::old('semester'), array('maxlength'=>'30')) }}
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
        {{ Form::hidden('filter_sem_name', $filter_sem_name) }}
        {{ Form::hidden('sort', $sort) }}
        {{ Form::hidden('order', $order) }}
        
		{{ Form::close() }}
	</div><!-- /widget-content --> 
</div><!-- /widget -->	

<script type="text/javascript">
$(document).ready(function() {		
    // Submit Form
    $('#submitForm').click(function() {
    	$('#form-semester').submit();
    });
    
    $('#form-semester input').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#form-semester').submit();
		}
	});
});	
</script>