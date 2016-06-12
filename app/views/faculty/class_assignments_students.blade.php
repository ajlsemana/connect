{{ $header }}

<div class="tab-content">
	<div class="tab-pane active" id="assignments">
		<div class="row">
	    	<div class="col-sm-12">
	    		<div align="left">
	    			<a href="{{ $url_back }}" class="btn btn-primary" title="Back to List">Back to List</a>
	    		</div>
	    		<br />

				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>
									<a href="{{ $sort_student }}" class="@if ($sort=='student') {{ strtolower($order) }} @endif">Student</a>
								</th>
								<th>
									<a href="{{ $sort_grade }}" class="@if ($sort=='grade') {{ strtolower($order) }} @endif">Grade</a>
								</th>
								<th>Action</th>
							</tr>
						</thead>
						
						<tbody>
							@if( CommonHelper::arrayHasValue($students) ) 
			 				@foreach ($students as $student)
							<tr>
								<td>{{ $student->first_name }} {{ $student->last_name }}</td>
								<td>{{ $student->grade }}</td>
								<td>
									<a data-toggle="modal" data-target="#viewModal" data-id="{{ $student->as_id }}" class="view glyphicon glyphicon-folder-open" style="cursor: pointer;" title="View Notes and Files"></a>&nbsp;&nbsp;
									<a data-toggle="modal" data-target="#gradeModal" data-id="{{ $student->as_id }}" data-points="{{ $student->points }}" class="grade glyphicon glyphicon-stats" style="cursor: pointer;" title="Set Grade"></a>
								</td>
							</tr>
							@endforeach
							@else
							<tr>
								<td colspan="3" class="align-center" style="padding: 10px;">Empty Results</td>
							</tr>
							@endif
						</tbody>
					</table>
				</div>

				@if( CommonHelper::arrayHasValue($students) ) 
			    <h6 class="paginate">
					<span>{{ $students->appends($arrFilters)->links() }}</span>
				</h6>
				@endif
			</div>
		</div>
	</div>
</div>

<!--modal for view -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Attached Files</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(array('url'=>'', 'class'=>'form-horizontal', 'role'=>'form', 'method' => 'post')) }}
		<div class="form-group">
			<label for="title" class="col-sm-4 control-label">Student:</label>
			<div class="col-sm-7 modal_details" id="d_student"></div>
		</div>

		<div class="form-group">
			<label for="title" class="col-sm-4 control-label">Notes:</label>
			<div class="col-sm-7 modal_details" id="d_notes"></div>
		</div>

		<div class="form-group">
			<label for="files" class="col-sm-4 control-label">Files:</label>
			<div class="col-sm-7 modal_details" id="d_files"></div>
		</div>
		{{ Form::close() }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end of modal for view -->

<!--modal for grade -->
<div class="modal fade" id="gradeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Grade</h4>
      </div>
      {{ Form::open(array('url'=>$url_grade, 'class'=>'form-horizontal', 'role'=>'form', 'method' => 'post')) }}
	  <div class="modal-body">
        <div class="form-group">
			<label for="title" class="col-sm-4 control-label">Student:</label>
			<div class="col-sm-7 modal_details" id="g_student"></div>
		</div>

		<div class="form-group">
			<label for="files" class="col-sm-4 control-label">Grade:</label>
			<div class="col-sm-7 modal_details" id="g_grade"></div>
		</div>
		{{ Form::hidden('id', $assignment_id) }}
		{{ Form::hidden('as_id', '', array('id' => 'g_as_id')) }}
		{{ Form::hidden('class_id', $class_info->subject_id) }}
		{{ Form::hidden('group_code', $class_info->group_code) }}		
      </div>
      <div class="modal-footer">
      	<button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
<!-- end of modal for grade -->

<script type="text/javascript">
$(document).ready(function() {
	$(function () {
	    $('#myTab').tab();
	})

	// View
    $('.view').click(function() {
    	$('#d_student').html('');
    	$('#d_notes').html('');
    	$('#d_files').html('');
    	
    	$.ajax({
			url: '{{ $url_class . '/assignments/students/getDetails' }}',
			type: 'GET',
			dataType: 'json',
			data: 'id=' + $(this).data('id'),
			beforeSend: function() {
			},
			success: function(output_string) {
				if (output_string) {					
					$('#d_student').html(output_string.student);
			    	$('#d_notes').html(output_string.notes);
			    	$('#d_files').html(output_string.files);
				} else {
					location.href = '{{ $url_class . '/assignments' }}';
				}
			},
			error: function() {
				location.href = '{{ $url_class . '/assignments' }}';
			}
		}); 
	});

	// Grade
    $('.grade').click(function() {
    	$('#g_student').html('');
    	$('#g_grade').html('');

    	$('#g_as_id').val($(this).data('id'));

    	points = $(this).data('points');
    	
    	$.ajax({
			url: '{{ $url_class . '/assignments/students/getDetails' }}',
			type: 'GET',
			dataType: 'json',
			data: 'id=' + $(this).data('id'),
			beforeSend: function() {
			},
			success: function(output_string) {
				if (output_string) {	

					grade_option = '<select name="grade">';
					for (i=0; i<=points; i++) {
						grade_option = grade_option + '<option value="'+i+'">'+i+'</option>';
					}
					grade_option = grade_option + '</select> / ' + points + ' points';

					$('#g_student').html(output_string.student);
			    	$('#g_grade').html(grade_option);
				} else {
					location.href = '{{ $url_class . '/assignments' }}';
				}
			},
			error: function() {
				location.href = '{{ $url_class . '/assignments' }}';
			}
		}); 
	});
});
</script>