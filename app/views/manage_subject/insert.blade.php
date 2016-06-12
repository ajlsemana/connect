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
    <div class="widget-header"> <i class="icon-group"></i>
    	<h3>Assign New Section</h3>
    </div>
    <!-- /widget-header -->
    
    <div class="widget-content">
    	{{ Form::open(array('url'=>'admin/manage_subject/addData', 'class'=>'form-horizontal', 'autocomplete'=>'off', 'id'=>'form-manage-subject', 'role'=>'form', 'method' => 'post')) }}
		<div class="span2">&nbsp;</div>
		<div class="span8">
			<fieldset>
				<div class="control-group">											
					<label class="control-label" for="subject_id">Subjects:</label>
					<div class="controls">
						{{ Form::select('subject_id', $subject_options, Input::old('subject_id'), array('id'=>'subject_id')) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->

				<div class="control-group">											
					<label class="control-label" for=""></label>
					<div class="controls" id="section-area">						
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
				
				<div class="control-group">											
					<label class="control-label" for="subject_id">Section:</label>
					<div class="controls">
						{{ Form::select('section_id[]', $section_options, Input::old('section_id'), array('multiple' => true, 'id'=>'section_id')) }}
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
        {{ Form::hidden('filter_subject', $filter_subject) }}
        {{ Form::hidden('filter_section', $filter_section) }}
        {{ Form::hidden('sort', $sort) }}
        {{ Form::hidden('order', $order) }}
        
		{{ Form::close() }}
	</div><!-- /widget-content --> 
</div><!-- /widget -->	

<script type="text/javascript">
$(document).ready(function() {	
	$('#subject_id').change(function() { 		
    	var subject_id = $(this).val();		
		var html = '';
		if(subject_id != '') {
			$.ajax({
			  type: 'GET',
			  dataType: 'json',
			  url: '{{ URL::to("admin/manage_subject/getAvailableSection") }}',
			  data: 'subject_id='+ subject_id
			}).success(function( data ) {			 							
				if(data.result != 0) {	
					html += '<div class="alert alert-success">';
					html += data.result;                                                  
	                html += '</div>';                                                                                                 				
				} else {
					html += '<div class="alert alert">';				
					html += '** All of the section below has already been assigned to this subject. **';
					html += '</div>';  
				}
				$('#section-area').html( html );
			});	
		} else {
			$('#section-area').html('');
		} 			
	}); 

	// Submit Form
    $('#submitForm').click(function() {
    	$('#form-manage-subject').submit();
    });
    
    $('#form-manage-subject input').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#form-manage-subject').submit();
		}
	});
});	
</script>