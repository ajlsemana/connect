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
					<div class="panel-heading">New Topic</div>
					<div class="panel-body">
						{{ Form::open(array('url'=> $url_class . '/addTopic', 'class'=>'form-horizontal', 'autocomplete'=>'off', 'id'=>'form-topic', 'role'=>'form', 'method' => 'post')) }}		
						<div class="form-group">
							<label for="title" class="col-sm-3 control-label">Topic:</label>
							<div class="col-sm-7">
								{{ Form::text('topic_name', Input::old('topic_name'), array('class' => 'form-control','maxlength'=>'50')) }}		
							</div>
						</div>					

						<div class="form-group">
							<label for="title" class="col-sm-3 control-label">Week From:</label>
							<div class="col-sm-7">
								<input type="number" name="week_from" min="1" max="18">
							</div>
						</div>

						<div class="form-group">
							<label for="title" class="col-sm-3 control-label">Week To:</label>
							<div class="col-sm-7">								
								<input type="number" name="week_to" min="1" max="18">
							</div>
						</div>

						<div class="form-group">
							<label for="title" class="col-sm-3 control-label">Search Query:</label>
							<div class="col-sm-7">								
								{{ Form::text('search_query', Input::old('search_query'), array('placeholder' => 'eg: Polymorphism in Java', 'class' => 'form-control','maxlength'=>'100')) }}			
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
    // Submit Form
    $('#submitForm').click(function() {
    	$('#form-topic').submit();
    });
    
    $('#form-topic input').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#form-topic').submit();
		}
	});
});	
</script>