{{ $header }}

<div class="tab-content">
	<div class="tab-pane active" id="topic">
		<div class="row">
			<div class="col-sm-12">
				<div align="left">
	    			<a href="{{ $url_back }}" class="btn btn-primary" title="Back to List">Back to List</a>
	    		</div>
	    		<br />

				<div class="panel panel-default">
					<div class="panel-heading">Update Topic</div>
					<div class="panel-body">
						{{ Form::model($topic, array('url' => $url_class . '/updateTopic', 'files' => true, 'class'=>'form-horizontal', 'autocomplete'=>'off', 'id'=>'form-post', 'role'=>'form', 'method' => 'post')) }}
						<div class="form-group">
							<label for="title" class="col-sm-3 control-label">Topic:</label>
							<div class="col-sm-7">
								{{ Form::text('topic_name', $topic->title, array('class' => 'form-control','maxlength'=>'255')) }}
							</div>
						</div>

						<div class="form-group">
							<label for="week_from" class="col-sm-3 control-label">Week From:</label>
							<div class="col-sm-7">
								<input type="number" value="{{ $topic->week_from }}" name="week_from" min="1" max="18">
							</div>
						</div>

						<div class="form-group">
							<label for="week_to" class="col-sm-3 control-label">Week To:</label>
							<div class="col-sm-7">
								<input type="number" value="{{ $topic->week_to }}" name="week_to" min="1" max="18">
							</div>
						</div>

						<div class="form-group">
							<label for="search_query" class="col-sm-3 control-label">Search Query:</label>
							<div class="col-sm-7">
								{{ Form::text('search_query', $topic->search_query, array('class' => 'form-control','maxlength'=>'255')) }}
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-3 control-label"></label>
							<div class="col-sm-7">
								<a class="btn btn-primary" id="submitForm">Submit</a>
							</div>
						</div>
						{{ Form::hidden('id', $topic->id) }}
						{{ Form::hidden('class_id', $class_info->id) }}
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
	});

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