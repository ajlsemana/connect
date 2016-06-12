{{ $header }}

<div class="tab-content">
	<div class="tab-pane active" id="exams">
		<div class="row">
			<div class="col-sm-12">
				<div align="left">
	    			<a href="{{ $url_back }}" class="btn btn-primary" title="Back to List">Back to List</a>
	    		</div>
	    		<br />

				<div class="panel panel-default">
					<div class="panel-heading">{{ htmlentities($exam->title) }}</div>
					<div class="panel-body">
						{{ Form::open(array('url' => $url_class . '/exams/submitExam', 'class'=>'', 'autocomplete'=>'off', 'id'=>'form-post', 'role'=>'form', 'method' => 'post')) }}
						<div class="form-group">
							<label for="description">Instruction:</label>
							{{ htmlentities($exam->description) }}
						</div>

						<div class="form-group">
							<label for="time_limit">Time Limit:</label>
							<div id="countdowntimer" style="width: 200px; height: 50px;"></div>
						</div>

						<br />
						@for ($counter = 0; $counter < count($exam_items); $counter++)
							<div class="form-group">
								<label for="question">{{ ($counter+1).'.' }} {{ htmlentities($exam_items[$counter]->question) }}</label>
								<div style="clear: both; padding-bottom: 15px;">
									<div style="float: left; width: 25px;">
										{{ Form::radio('answer['.$exam_items[$counter]->id.']', 'a') }}
									</div>
									<div style="float: left;">{{ htmlentities($exam_items[$counter]->option_a) }}</div>
								</div>
								
								<div style="clear: both; padding-bottom: 15px;">
									<div style="float: left; width: 25px;">
										{{ Form::radio('answer['.$exam_items[$counter]->id.']', 'b') }}
									</div>
									<div style="float: left;">{{ htmlentities($exam_items[$counter]->option_b) }}</div>
								</div>

								<div style="clear: both; padding-bottom: 15px;">
									<div style="float: left; width: 25px;">
										{{ Form::radio('answer['.$exam_items[$counter]->id.']', 'c') }}
									</div>
									<div style="float: left;">{{ htmlentities($exam_items[$counter]->option_c) }}</div>
								</div>

								<div style="clear: both; padding-bottom: 30px;">
									<div style="float: left; width: 25px;">
										{{ Form::radio('answer['.$exam_items[$counter]->id.']', 'd') }}
									</div>
									<div style="float: left;">{{ htmlentities($exam_items[$counter]->option_d) }}</div>
								</div>
							</div>					
						@endfor

						<div class="form-group">
							<label for=""></label>
							<br />
							<a class="btn btn-primary" id="submitForm">Submit</a>
						</div>

						{{ Form::hidden('id', $exam->id) }}
						{{ Form::hidden('count', $counter, array('id' => 'count')) }}
						{{ Form::hidden('class_id', $class_info->subject_id) }}
						{{ Form::hidden('group_code', $class_info->group_code) }}
						{{ Form::hidden('exam_student_id', $exam_student_id) }}
					    {{ Form::close() }}	
					</div>
				</div>
		    </div>
		</div>	
	</div>
</div>

{{ HTML::script('resources/bootstrap/timer/jquery.plugin.js') }}
{{ HTML::script('resources/bootstrap/timer/jquery.countdown.js') }}
{{ HTML::style('resources/bootstrap/timer/jquery.countdown.css') }}
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

	countdowntimer = new Date(); 
    countdowntimer.setSeconds(countdowntimer.getSeconds() + {{ ($exam->time_limit*60) }}); 

	$('#countdowntimer').countdown({
		until: countdowntimer, 
		format: 'MS', 
	    onExpiry: liftOff
	}); 

	function liftOff() { 
	    alert('Time is up! Your exam will be submitted automatically.'); 

	    $('#form-post').submit();
	}
});
</script>