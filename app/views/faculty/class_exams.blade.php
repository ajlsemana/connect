{{ $header }}

<div class="tab-content">
	<div class="tab-pane active" id="exams">
		<div class="row">
	    	<div class="col-sm-12">
	    		<div align="left">
	    			<a href="{{ $url_insert }}" class="btn btn-primary" title="Add New Exam">Add New Exam</a>
	    		</div>
	    		<br />

				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>
									<a href="{{ $sort_title }}" class="@if ($sort=='title') {{ strtolower($order) }} @endif">Title</a>
								</th>
								<th>
									<a href="{{ $sort_time_limit }}" class="@if ($sort=='time_limit') {{ strtolower($order) }} @endif">Time Limit</a>
								</th>
								<th>
									<a href="{{ $sort_points }}" class="@if ($sort=='points') {{ strtolower($order) }} @endif">Points</a>
								</th>
								<th>
									<a href="{{ $sort_due_date }}" class="@if ($sort=='due_date') {{ strtolower($order) }} @endif">Due Date</a>
								</th>								
								<th>Status</th>
								<th>Visibility</th>
								<th>Action</th>
							</tr>
						</thead>
						
						<tbody>
							@if( CommonHelper::arrayHasValue($exams) ) 
			 				@foreach ($exams as $exam)
							<tr>
								<td>{{ htmlentities($exam->title) }}</td>
								<td>{{ $exam->time_limit }} minutes</td>
								<td>{{ $exam->points }}</td>
								<td>{{ date('F d, Y', strtotime($exam->due_date)) }}</td>								
								<td>																		
									{{ (date('Y-m-d') <= $exam->due_date) ? 'Open' : 'Closed' }}									
								</td>
								<td>
									@if($exam->visible == 1)
										<span class="glyphicon glyphicon-eye-open" title="show"></span>
									@else
										<span class="glyphicon glyphicon-eye-close" title="hidden"></span>
									@endif
								</td>
								<td>
									<a href="{{ $url_class . '/exams/view?id=' . $exam->id }}" class="glyphicon glyphicon-search" style="cursor: pointer;" title="View Details"></a>&nbsp;&nbsp;
									@if (date('Y-m-d') <= $exam->due_date)
									<a href="{{ $url_class . '/exams/update?id=' . $exam->id }}" class="glyphicon glyphicon-pencil" title="Update"></a>&nbsp;&nbsp;
									@endif
									<a href="#" data-id="{{ $exam->id }}" class="delete glyphicon glyphicon-trash" title="Delete"></a>&nbsp;&nbsp;
									<a href="{{ $url_class . '/exams/students?id=' . $exam->id }}" class="glyphicon glyphicon-user" title="Exam Results"></a> 
								</td>
							</tr>
							@endforeach
							@else
							<tr>
								<td colspan="6" class="align-center" style="padding: 10px;">Empty Results</td>
							</tr>
							@endif
						</tbody>
					</table>
				</div>

				@if( CommonHelper::arrayHasValue($exams) ) 
			    <h6 class="paginate">
					<span>{{ $exams->appends($arrFilters)->links() }}</span>
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

	// Delete
	$('.delete').click(function() {
		if (confirm('Delete Exam?')) {
			id = $(this).data('id');

			location.href = "{{ $url_class . '/exams/delete?id=' }}" + id;
		} else {
			return false;
		}
	});
});
</script>