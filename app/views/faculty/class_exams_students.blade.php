{{ $header }}

<div class="tab-content">
	<div class="tab-pane active" id="exams">
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
									<a data-toggle="modal" data-target="#viewModal" data-id="{{ $student->es_id }}" class="view glyphicon glyphicon-file" style="cursor: pointer;" title="View Exam"></a>
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
        <h4 class="modal-title" id="myModalLabel">Exam</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(array('url'=>'', 'class'=>'form-horizontal', 'role'=>'form', 'method' => 'post')) }}
		<div class="form-group">
			<label for="title" class="col-sm-4 control-label">Student:</label>
			<div class="col-sm-7 modal_details" id="d_student"></div>
		</div>

		<div class="form-group">
			<label for="title" class="col-sm-4 control-label">Exam:</label>
			<div class="col-sm-7 modal_details" id="d_exam"></div>
		</div>

		<div class="form-group">
			<label for="files" class="col-sm-4 control-label">Answers:</label>
			<div class="col-sm-7 modal_details" id="d_answers"></div>
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

<script type="text/javascript">
$(document).ready(function() {
	$(function () {
	    $('#myTab').tab();
	})

	// View
    $('.view').click(function() {
    	$('#d_student').html('');
    	$('#d_exam').html('');
    	$('#d_answers').html('');
    	
    	$.ajax({
			url: '{{ $url_class . '/exams/students/getDetails' }}',
			type: 'GET',
			dataType: 'json',
			data: 'id=' + $(this).data('id'),
			beforeSend: function() {
			},
			success: function(output_string) {
				if (output_string) {					
					$('#d_student').html(output_string.student);
			    	$('#d_exam').html(output_string.exam);
			    	$('#d_answers').html(output_string.answers);
				} else {
					location.href = '{{ $url_class . '/exams' }}';
				}
			},
			error: function() {
				location.href = '{{ $url_class . '/exams' }}';
			}
		}); 
	});
});
</script>