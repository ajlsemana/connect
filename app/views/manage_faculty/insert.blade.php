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
    	<h3>Assign New Subject</h3>
    </div>
    <!-- /widget-header -->
    
    <div class="widget-content">
    	{{ Form::open(array('url'=>'admin/manage_faculty/addData', 'class'=>'form-horizontal', 'autocomplete'=>'off', 'id'=>'form-manage-faculty', 'role'=>'form', 'method' => 'post')) }}
		<div class="span2">&nbsp;</div>
		<div class="span8">
			<fieldset>
				<div class="control-group">											
					<label class="control-label" for="code">Faculty:</label>
					<div class="controls">
						{{ Form::select('user_id', $faculty_options, Input::old('user_id'), array('id'=>'user_id')) }}
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
				
				<div class="control-group">											
					<label class="control-label" for=""></label>
					<div class="controls" id="faculty-load">						
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
				
				<div class="control-group">											
					<label class="control-label" for="subject_id">Subjects:</label>
					<div class="controls">
						{{ Form::select('subject_id[]', $subject_options, Input::old('subject_id'), array('multiple' => true, 'id'=>'subject_id', 'style'=>'min-width:  350px;')) }}
					</div> 				
				</div> 							

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
        {{ Form::hidden('filter_faculty', $filter_faculty) }}
        {{ Form::hidden('filter_subject', $filter_subject) }}
        {{ Form::hidden('sort', $sort) }}
        {{ Form::hidden('order', $order) }}
        
		{{ Form::close() }}
	</div><!-- /widget-content --> 
</div><!-- /widget -->	

<script type="text/javascript">
$(document).ready(function() {
	$('#user_id').change(function() {    	
    	var id = $(this).val();		
		var html = '';
		$.ajax({
		  type: 'GET',
		  dataType: 'json',
		  url: '{{ URL::to("admin/manage_faculty/getLoads") }}',
		  data: 'user_id='+ id
		}).success(function( data ) {						
			if(data.mid) {	
				html += '<div class="alert alert-success">';
				html += data.html;                                                  
                html += '</div>';                                                                                                 				
			} else {
				html += '<div class="alert alert">';
				html += data.html;
				html += '** No load available yet for this faculty. **';
				html += '</div>';  
			}
			$('#faculty-load').html( html );
		});	  			
	}); 

	// Submit Form
    $('#submitForm').click(function() {
    	$('#form-manage-faculty').submit();
    });
    
    $('#form-manage-faculty input').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#form-manage-faculty').submit();
		}
	});
});	
</script>