{{ $header }}

<div class="tab-content">
	<div class="tab-pane active" id="grades">
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
								<td>{{ $student->last_name }}, {{ $student->first_name }}</td>
								<td>
									@if ($student->class_status == 0)
										Pending
									@elseif ($student->class_status == 1)
										Active
									@endif
								</td>
								<td>
									<a data-id="{{ $student->id }}" style="cursor: pointer;" class="view" title="View Grades">[ View Grades ]</a>
								</td>
							</tr>
							<tr id="row_{{ $student->id }}" style="display: none;">
								<td colspan="3">
									<div class="row">
								    	<div class="col-sm-12">								    		
											@if( CommonHelper::arrayHasValue($grades[$student->id]['projects']) ) 
					 						<div class="table-responsive">
						 						<table class="table table-bordered">
													<thead>
														<tr class="info">
															<th>Project</th>
															<th style="width: 20%">Date of Submission</th>
															<th style="width: 30%">Grade</th>
														</tr>
													</thead>
													<tbody>
														@foreach ($grades[$student->id]['projects'] as $project)
														<tr>
															<td>{{ htmlentities($project->title) }}</td>
															<td>{{ $project->created_at }}</td>
															<td>{{ $project->grade }} / {{ $project->points }} <em>({{ number_format(($project->grade/$project->points) * 100, 2) }}%)</em></td>
														</tr>
														@endforeach
													</tbody>
												</table>
											</div>
											@endif

											@if( CommonHelper::arrayHasValue($grades[$student->id]['assignments']) ) 
					 						<div class="table-responsive">
						 						<table class="table table-bordered">
													<thead>
														<tr class="info">
															<th>Assignment</th>
															<th style="width: 20%">Date of Submission</th>
															<th style="width: 30%">Grade</th>
														</tr>
													</thead>
													<tbody>
														@foreach ($grades[$student->id]['assignments'] as $assignment)
														<tr>
															<td>{{ htmlentities($assignment->title) }}</td>
															<td>{{ $assignment->created_at }}</td>
															<td>{{ $assignment->grade }} / {{ $assignment->points }} <em>({{ number_format(($assignment->grade/$assignment->points) * 100, 2) }}%)</em></td>
														</tr>
														@endforeach
													</tbody>
												</table>
											</div>
											@endif

											@if( CommonHelper::arrayHasValue($grades[$student->id]['exams']) ) 
					 						<div class="table-responsive">
						 						<table class="table table-bordered">
													<thead>
														<tr class="info">
															<th>Exam</th>
															<th style="width: 20%">Date Taken</th>
															<th style="width: 30%">Grade</th>
														</tr>
													</thead>
													<tbody>
														@foreach ($grades[$student->id]['exams'] as $exam)
														<tr>
															<td>{{ htmlentities($exam->title) }}</td>
															<td>{{ $exam->created_at }}</td>
															<td>{{ $exam->grade }} / {{ $exam->points }} <em>({{ number_format(($exam->grade/$exam->points) * 100, 2) }}%)</em></td>
														</tr>
														@endforeach
													</tbody>
												</table>
											</div>
											@endif

											@if( CommonHelper::arrayHasValue($grades[$student->id]['quizzes']) ) 
					 						<div class="table-responsive">
						 						<table class="table table-bordered">
													<thead>
														<tr class="info">
															<th>Quiz</th>
															<th style="width: 20%">Date Taken</th>
															<th style="width: 30%">Grade</th>
														</tr>
													</thead>
													<tbody>
														@if($grades)
															@foreach ($grades[$student->id]['quizzes'] as $quiz)
															<tr>
																<td>{{ htmlentities($quiz->title) }}</td>
																<td>{{ $quiz->created_at }}</td>
																<td>{{ $quiz->grade }} / {{ $quiz->points }} <em>({{ ($quiz->points > 0 ? number_format(($quiz->grade/$quiz->points) * 100, 2) : '') }}%)</em></td>
															</tr>
															@endforeach														
														@endif
													</tbody>
												</table>
											</div>
											@endif
										</div>
									</div>
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

	// View
	$('.view').click(function() {
		student_id = $(this).data('id');

		$('#row_' + student_id).slideToggle();
	});
});
</script>