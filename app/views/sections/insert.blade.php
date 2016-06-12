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
    <div class="widget-header"> <i class="icon-th-large"></i>
    	<h3>Add New Section</h3>
    </div>
    <!-- /widget-header -->
    
    <div class="widget-content">
    	{{ Form::open(array('url'=>'admin/sections/addData', 'class'=>'form-horizontal', 'autocomplete'=>'off', 'id'=>'form-sections', 'role'=>'form', 'method' => 'post')) }}
		<div class="span3">&nbsp;</div>
		<div class="span7">
			<fieldset>
				<div class="control-group">											
					<label class="control-label" for="semester">Semester:</label>
					<div class="controls">						
						{{ Form::select('semester', $semester_options, Input::old('semester'), array('id'=>'semester')) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
				
				<div class="control-group">											
					<label class="control-label" for="code">Code:</label>
					<div class="controls">
						{{ Form::text('code', Input::old('code'), array('maxlength'=>'50')) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->							

				<div class="control-group">											
					<label class="control-label" for="school_year_from">School Year:</label>
					<div class="controls">
						{{ Form::text('school_year_from', Input::old('school_year_from'), array('class'=>'date', 'maxlength'=>'10', 'style'=>'width: 50px;')) }}
						-
						{{ Form::text('school_year_to', Input::old('school_year_to'), array('class'=>'date', 'maxlength'=>'10', 'style'=>'width: 50px;')) }}
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
        {{ Form::hidden('filter_code', $filter_code) }}
        {{ Form::hidden('filter_name', $filter_name) }}
        {{ Form::hidden('filter_date_from', $filter_date_from) }}
        {{ Form::hidden('filter_date_to', $filter_date_to) }}
        {{ Form::hidden('filter_semester', $filter_semester) }}
        {{ Form::hidden('sort', $sort) }}
        {{ Form::hidden('order', $order) }}
        
		{{ Form::close() }}
	</div><!-- /widget-content --> 
</div><!-- /widget -->	

<script type="text/javascript">
$(document).ready(function() {	
	$(".date").datepicker( {
	    format: "yyyy",
	    viewMode: "years", 
	    minViewMode: "years"
	});

    // Submit Form
    $('#submitForm').click(function() {
    	$('#form-sections').submit();
    });
    
    $('#form-sections input').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#form-sections').submit();
		}
	});
});	
</script>