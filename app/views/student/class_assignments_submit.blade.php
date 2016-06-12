{{ $header }}

<div class="tab-content">
	<div class="tab-pane active" id="assignments">
		<div class="row">
			<div class="col-sm-12">
				<div align="left">
	    			<a href="{{ $url_back }}" class="btn btn-primary" title="Back to List">Back to List</a>
	    		</div>
	    		<br />

				<div class="panel panel-default">
					<div class="panel-heading">Submit Assignment</div>
					<div class="panel-body">
						{{ Form::open(array('url' => $url_class . '/assignments/submitAssignment', 'files' => true, 'class'=>'form-horizontal', 'autocomplete'=>'off', 'id'=>'form-post', 'role'=>'form', 'method' => 'post')) }}
						<div class="form-group">
							<label for="notes" class="col-sm-3 control-label">Notes:</label>
							<div class="col-sm-7">
								{{ Form::textarea('notes', Input::old('notes'), array('size' => '30x10', 'class' => 'form-control', 'id'=> 'notes', 'maxlength' => 5000)) }}
							</div>
						</div>

						<div class="form-group">
							<label for="files" class="col-sm-3 control-label">Files:</label>
							<div class="col-sm-7">
								{{ Form::file('files[]', array('multiple' => true)) }}
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-3 control-label"></label>
							<div class="col-sm-7">
								<a class="btn btn-primary" id="submitForm">Submit</a>
							</div>
						</div>
						{{ Form::hidden('id', $assignment->id) }}
						{{ Form::hidden('class_id', $class_info->subject_id) }}
						{{ Form::hidden('group_code', $class_info->group_code) }}
					    {{ Form::close() }}	
					</div>
				</div>
		    </div>
		</div>	
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	$(function () {
	    $('#myTab').tab();
	})

    // Submit Form
    $('#submitForm').click(function() {
    	$('#form-post').submit();
    });
    
    $('#form-post input').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#form-post').submit();
		}
	});
	
});
</script>