{{ $header }}

<div class="tab-content">
	<div class="tab-pane active" id="exams">
		<div class="row">
			<div class="col-sm-12">
				<div align="left">
	    			<a href="{{ $url_back }}" class="btn btn-primary" title="Back to List">Back to List</a>
	    			<a href="{{ $url_class . '/exams/update?id=' . $exam->id }}" class="btn btn-primary" title="Update Exam">Update Exam</a>
	    			<a href="#" class="btn btn-danger delete" data-id="{{ $exam->id }}" title="Delete Exam">Delete Exam</a>
	    		</div>
	    		<br />

				<div class="panel panel-default">
					<div class="panel-heading">{{ htmlentities($exam->title) }}</div>
					<div class="panel-body">
						{{ Form::open(array('url' => '', 'class'=>'form-horizontal', 'autocomplete'=>'off', 'id'=>'form-post', 'role'=>'form', 'method' => 'post')) }}
						<div class="form-group">
							<label for="description" class="col-sm-3 control-label">Instruction:</label>
							<div class="col-sm-7 modal_details">{{ htmlentities($exam->description) }}</div>
						</div>

						<div class="form-group">
							<label for="due_date" class="col-sm-3 control-label">Time Limit:</label>
							<div class="col-sm-7 modal_details">{{ $exam->time_limit }} minutes</div>
						</div>

						<div class="form-group">
							<label for="due_date" class="col-sm-3 control-label">Due Date:</label>
							<div class="col-sm-7 modal_details">{{ date('F d, Y', strtotime($exam->due_date)) }}</div>
						</div>					    
						{{ Form::close() }}	
					</div>
				</div>

				<div class="panel panel-default" style="background-color: #428BCA; color: #ffffff;">
				  <div class="panel-body">QUESTIONS</div>
				</div>

				@foreach ($exam_items as $item)
				<div class="panel panel-default">
					<div class="panel-heading">{{ htmlentities($item->question) }}</div>
					<div class="panel-body">
						<div class="form-group">
							<label for="answer" class="col-sm-2 control-label">Options:</label>
							<div class="col-sm-7 modal_details">
								<div style="clear: both; padding-bottom: 5px;">
									@if ($item->answer == 'a')
										<span style="color: #005AB0; font-weight: bold;">A. {{ htmlentities($item->option_a) }}</span>
									@else
										A. {{ htmlentities($item->option_a) }}
									@endif
								</div>
								
								<div style="clear: both; padding-bottom: 5px;">
									@if ($item->answer == 'b')
										<span style="color: #005AB0; font-weight: bold;">B. {{ htmlentities($item->option_b) }}</span>
									@else
										B. {{ htmlentities($item->option_b) }}
									@endif
								</div>

								<div style="clear: both; padding-bottom: 5px;">
									@if ($item->answer == 'c')
										<span style="color: #005AB0; font-weight: bold;">C. {{ htmlentities($item->option_c) }}</span>
									@else
										C. {{ htmlentities($item->option_c) }}
									@endif
								</div>

								<div style="clear: both; padding-bottom: 5px;">
									@if ($item->answer == 'd')
										<span style="color: #005AB0; font-weight: bold;">D. {{ htmlentities($item->option_d) }}</span>
									@else
										D. {{ htmlentities($item->option_d) }}
									@endif
								</div>
							</div>
						</div>	
					</div>
				</div>
				@endforeach
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