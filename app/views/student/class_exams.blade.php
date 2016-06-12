{{ $header }}

<div class="tab-content">
	<div class="tab-pane active" id="exams">
		<div class="row">
	    	<div class="col-sm-12">
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>
									<a href="{{ $sort_title }}" class="@if ($sort=='title') {{ strtolower($order) }} @endif">Title</a>
								</th>
								<th>
									<a href="{{ $sort_due_date }}" class="@if ($sort=='due_date') {{ strtolower($order) }} @endif">Due Date</a>
								</th>
								<th>
									<a href="{{ $sort_points }}" class="@if ($sort=='points') {{ strtolower($order) }} @endif">Points</a>
								</th>
								<th>
									<a href="{{ $sort_grade }}" class="@if ($sort=='grade') {{ strtolower($order) }} @endif">Grade</a>
								</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						
						<tbody>
							@if( CommonHelper::arrayHasValue($exams) ) 
			 				@foreach ($exams as $exam)
							<tr>
								<td>{{ htmlentities($exam->title) }}</td>
								<td>{{ date('F d, Y', strtotime($exam->due_date)) }}</td>
								<td>{{ $exam->points }}</td>
								<td>{{ $exam->grade }}</td>
								<td>
									@if ($exam->exam_student_id == NULL)
										{{ (date('Y-m-d') <= $exam->due_date) ? 'Open' : 'Closed' }}
									@else
										Done
									@endif
								</td>
								<td>
									@if ($exam->exam_student_id == NULL && (date('Y-m-d') <= $exam->due_date))
										<a style="cursor: pointer;" data-id="{{ $exam->id }}" class="takeexam glyphicon glyphicon-pencil" title="Take Exam"></a>
									@endif
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
	});

	$('.takeexam').click(function() {
		if (confirm('Take the exam now?')) {
			location.href = "{{ $url_class . '/exams/take?id=' }}" + $(this).data('id');
		} else {
			return false;
		}
	});
});
</script>