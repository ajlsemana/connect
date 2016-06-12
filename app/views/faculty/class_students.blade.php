{{ $header }}

<div class="tab-content">
	<div class="tab-pane active" id="students">
		<div class="row">
	    	<div class="col-sm-12">
	    		<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>
									<a href="{{ $sort_student }}" class="@if ($sort=='student') {{ strtolower($order) }} @endif">Student</a>
								</th>
								<th>
									<a href="{{ $sort_status }}" class="@if ($sort=='status') {{ strtolower($order) }} @endif">Status</a>
								</th>
								<th>Action</th>
							</tr>
						</thead>
						
						<tbody>
							@if( CommonHelper::arrayHasValue($students) ) 
			 				@foreach ($students as $student)
							<tr>
								<td>{{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_name }}</td>
								<td>
									@if ($student->class_status == 0)
										Pending
									@elseif ($student->class_status == 1)
										Active
									@endif
								</td>
								<td>
									@if ($student->class_status == 0)
										<a href="#" data-id="{{ $student->student_id }}" class="add glyphicon glyphicon-ok" title="Approve Student"></a>&nbsp;&nbsp;
										<a href="#" data-id="{{ $student->student_id }}" class="delete glyphicon glyphicon-trash" title="Reject Student"></a>
									@elseif ($student->class_status == 1)
										@if ($student->video_status == 0)
											<a href="#" data-id="{{ $student->student_id }}" class="invite glyphicon glyphicon-facetime-video" title="invite to chat"></a>
										@elseif ($student->class_status == 1)
											<a href="#" data-id="{{ $student->student_id }}" class="close-invite glyphicon glyphicon-off" title="deactivate chat"></a>
										@endif
										<a href="#" data-id="{{ $student->student_id }}" class="delete glyphicon glyphicon-remove" title="Reject Student"></a>										
									@endif
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

<script type="text/javascript">
$(document).ready(function() {
	$(function () {
	    $('#myTab').tab();
	})

	// Invite to Video Conference
	$('.invite').click(function() {
		if (confirm('Activate Student Video Conference?')) {
			id = $(this).data('id');

			location.href = "{{ $url_class . '/students/updateVideoStatus?id=' }}" + id;
		} else {
			return false;
		}
	});

	// Deactivate to Video Conference
	$('.close-invite').click(function() {
		if (confirm('Deactivate Student Video Conference?')) {
			id = $(this).data('id');

			location.href = "{{ $url_class . '/students/endVideoStatus?id=' }}" + id;
		} else {
			return false;
		}
	});

	// Add
	$('.add').click(function() {
		if (confirm('Approve Student?')) {
			id = $(this).data('id');

			location.href = "{{ $url_class . '/students/add?id=' }}" + id;
		} else {
			return false;
		}
	});

	// Delete
	$('.delete').click(function() {
		if (confirm('Reject Student?')) {
			id = $(this).data('id');

			location.href = "{{ $url_class . '/students/delete?id=' }}" + id;
		} else {
			return false;
		}
	});
});
</script>