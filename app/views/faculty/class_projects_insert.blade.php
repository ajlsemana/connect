{{ $header }}

<div class="tab-content">
	<div class="tab-pane active" id="projects">
		<div class="row">
			<div class="col-sm-12">
				<div align="left">
	    			<a href="{{ $url_back }}" class="btn btn-primary" title="Back to List">Back to List</a>
	    		</div>
	    		<br />

				<div class="panel panel-default">
					<div class="panel-heading">New Project</div>
					<div class="panel-body">
						{{ Form::open(array('url' => $url_class . '/addProject', 'files' => true, 'class'=>'form-horizontal', 'autocomplete'=>'off', 'id'=>'form-post', 'role'=>'form', 'method' => 'post')) }}
						<div class="form-group">
							<label for="title" class="col-sm-3 control-label">Project Title:</label>
							<div class="col-sm-7">
								{{ Form::text('title', Input::old('title'), array('class' => 'form-control','maxlength'=>'255')) }}
							</div>
						</div>

						<div class="form-group">
							<label for="description" class="col-sm-3 control-label">Description:</label>
							<div class="col-sm-7">
								{{ Form::textarea('description', Input::old('description'), array('size' => '30x10', 'class' => 'form-control', 'id'=> 'description', 'maxlength' => 5000)) }}
							</div>
						</div>

						<div class="form-group">
							<label for="title" class="col-sm-3 control-label">Points:</label>
							<div class="col-sm-7">
								{{ Form::text('points', Input::old('points'), array('class' => 'form-control', 'style' => 'width: 50px;', 'maxlength'=>'3')) }}
							</div>
						</div>

						<div class="form-group">
							<label for="due_date" class="col-sm-3 control-label">Due Date:</label>
							<div class="col-sm-7">
								{{ Form::text('due_date', Input::old('due_date'), array('placeholder' => 'yyyy-mm-dd', 'style' => 'width: 110px;', 'class' => 'date form-control')) }}
								<p class="help-block">e.g. {{ date('Y-m-d') }}</p>
							</div>
						</div>

						<div class="form-group">
							<label for="show_hidden" class="col-sm-3 control-label">Show/Hidden:</label>
							<div class="col-sm-7">								
								{{ Form::checkbox('show_hide', '1') }}								
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

	$('.date').mask('0000-00-00');
	//$('.date').datepicker();

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