{{ $header }}

<div class="tab-content">
	<div class="tab-pane active" id="projects">
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
							@if( CommonHelper::arrayHasValue($projects) ) 
			 				@foreach ($projects as $project)
							<tr>
								<td>{{ htmlentities($project->title) }}</td>
								<td>{{ date('F d, Y', strtotime($project->due_date)) }}</td>
								<td>{{ $project->points }}</td>
								<td>{{ $project->grade }}</td>
								<td>
									@if ($project->project_student_id == NULL)
										{{ (date('Y-m-d') <= $project->due_date) ? 'Open' : 'Closed' }}
									@else
										Done
									@endif
								</td>
								<td>
									<a data-toggle="modal" data-target="#viewModal" data-id="{{ $project->id }}" class="view glyphicon glyphicon-search" style="cursor: pointer;" title="View Details"></a>&nbsp;&nbsp;
									@if (date('Y-m-d') <= $project->due_date && $project->project_student_id==NULL)
									<a href="{{ $url_class . '/projects/submit?id=' . $project->id }}" class="glyphicon glyphicon-floppy-disk" title="Submit Project"></a>&nbsp;&nbsp;
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

				@if( CommonHelper::arrayHasValue($projects) ) 
			    <h6 class="paginate">
					<span>{{ $projects->appends($arrFilters)->links() }}</span>
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
        <h4 class="modal-title" id="myModalLabel">Project Details</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(array('url'=>'', 'class'=>'form-horizontal', 'role'=>'form', 'method' => 'post')) }}
		<div class="form-group">
			<label for="title" class="col-sm-4 control-label">Project Title:</label>
			<div class="col-sm-7 modal_details" id="d_title"></div>
		</div>

		<div class="form-group">
			<label for="description" class="col-sm-4 control-label">Description:</label>
			<div class="col-sm-7 modal_details" id="d_description"></div>
		</div>

		<div class="form-group">
			<label for="due_date" class="col-sm-4 control-label">Points:</label>
			<div class="col-sm-7 modal_details" id="d_points"></div>
		</div>

		<div class="form-group">
			<label for="due_date" class="col-sm-4 control-label">Due Date:</label>
			<div class="col-sm-7 modal_details" id="d_due_date"></div>
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

<script type="text/javascript">
$(document).ready(function() {
	$(function () {
	    $('#myTab').tab();
	})

	// View
    $('.view').click(function() {
    	$('#d_title').html('');
    	$('#d_description').html('');
    	$('#d_points').html('');
    	$('#d_due_date').html('');
    	$('#d_files').html('');
    	
    	$.ajax({
			url: '{{ $url_class . '/projects/getDetails' }}',
			type: 'GET',
			dataType: 'json',
			data: 'id=' + $(this).data('id'),
			beforeSend: function() {
			},
			success: function(output_string) {
				if (output_string) {					
					$('#d_title').html(output_string.title);
			    	$('#d_description').html(output_string.description);
			    	$('#d_points').html(output_string.points);
			    	$('#d_due_date').html(output_string.due_date);
			    	$('#d_files').html(output_string.files);
				} else {
					location.href = '{{ $url_class . '/projects' }}';
				}
			},
			error: function() {
				location.href = '{{ $url_class . '/projects' }}';
			}
		}); 
	});
});
</script>