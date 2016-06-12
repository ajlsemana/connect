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
					<div class="panel-heading">New Exam</div>
					<div class="panel-body">
						{{ Form::open(array('url' => $url_class . '/addExam', 'class'=>'form-horizontal', 'autocomplete'=>'off', 'id'=>'form-post', 'role'=>'form', 'method' => 'post')) }}
						<div class="form-group">
							<label for="title" class="col-sm-3 control-label">Exam Title:</label>
							<div class="col-sm-7">
								{{ Form::text('title', Input::old('title'), array('class' => 'form-control','maxlength'=>'255')) }}
							</div>
						</div>

						<div class="form-group">
							<label for="description" class="col-sm-3 control-label">Instruction:</label>
							<div class="col-sm-7">
								{{ Form::textarea('description', Input::old('description'), array('size' => '30x10', 'class' => 'form-control', 'id'=> 'description', 'maxlength' => 5000)) }}
							</div>
						</div>

						<div class="form-group">
							<label for="due_date" class="col-sm-3 control-label">Time Limit:</label>
							<div class="col-sm-7">
								{{ Form::text('time_limit', Input::old('time_limit'), array('placeholder' => '0', 'style' => 'width: 110px;', 'class' => 'time_limit form-control', 'maxlength' => '3')) }}
								<p class="help-block">Time limit in minutes</p>
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

						@if (Input::old('question'))
							@for ($counter = 0; $counter < count(Input::old('question')); $counter++)
								<div class="form-group" id="question_{{ $counter }}">
									<label for="question" class="col-sm-3 control-label">Question:</label>
									<div class="col-sm-7">
										{{ Form::text('question['.$counter.']', Input::old('question['.$counter.']'), array('class' => 'form-control','maxlength'=>'255')) }}
									</div>
								</div>

								<div class="form-group" id="answer_{{ $counter }}">
									<label for="answer" class="col-sm-3 control-label">Options:</label>
									<div class="col-sm-7">
										<div style="clear: both; padding-bottom: 50px;">
											<div style="float: left; width: 40px;">
												@if (Input::old('answer['.$counter.']') == 'a')
													{{ Form::radio('answer['.$counter.']', 'a', TRUE) }}
												@else
													{{ Form::radio('answer['.$counter.']', 'a') }}
												@endif
											</div>
											<div style="float: left;">{{ Form::text('option['.$counter.'][a]', Input::old('option['.$counter.'][a]'), array('style' => 'width: 300px;', 'class' => 'form-control','maxlength'=>'255')) }}</div>
										</div>
										
										<div style="clear: both; padding-bottom: 50px;">
											<div style="float: left; width: 40px;">
												@if (Input::old('answer['.$counter.']') == 'b')
													{{ Form::radio('answer['.$counter.']', 'b', TRUE) }}
												@else
													{{ Form::radio('answer['.$counter.']', 'b') }}
												@endif
											</div>
											<div style="float: left;">{{ Form::text('option['.$counter.'][b]', Input::old('option['.$counter.'][b]'), array('style' => 'width: 300px', 'class' => 'form-control','maxlength'=>'255')) }}</div>
										</div>

										<div style="clear: both; padding-bottom: 50px;">
											<div style="float: left; width: 40px;">
												@if (Input::old('answer['.$counter.']') == 'c')
													{{ Form::radio('answer['.$counter.']', 'c', TRUE) }}
												@else
													{{ Form::radio('answer['.$counter.']', 'c') }}
												@endif
											</div>
											<div style="float: left;">{{ Form::text('option['.$counter.'][c]', Input::old('option['.$counter.'][c]'), array('style' => 'width: 300px', 'class' => 'form-control','maxlength'=>'255')) }}</div>
										</div>

										<div style="clear: both; padding-bottom: 50px;">
											<div style="float: left; width: 40px;">
												@if (Input::old('answer['.$counter.']') == 'd')
													{{ Form::radio('answer['.$counter.']', 'd', TRUE) }}
												@else
													{{ Form::radio('answer['.$counter.']', 'd') }}
												@endif
											</div>
											<div style="float: left;">{{ Form::text('option['.$counter.'][d]', Input::old('option['.$counter.'][d]'), array('style' => 'width: 300px', 'class' => 'form-control','maxlength'=>'255')) }}</div>
										</div>

										@if ($counter > 0)
										<div style="clear: both; padding-bottom: 10px;" align="left">
											<a class="btn btn-primary deleteQuestion" data-id="{{ $counter }}">Delete Question</a>
										</div>
										@endif
									</div>
								</div>					
							@endfor
						@else
							<div class="form-group" id="question_0">
								<label for="question" class="col-sm-3 control-label">Question:</label>
								<div class="col-sm-7">
									{{ Form::text('question[0]', Input::old('question[0]'), array('class' => 'form-control','maxlength'=>'255')) }}
								</div>
							</div>

							<div class="form-group" id="answer_0">
								<label for="answer" class="col-sm-3 control-label">Options:</label>
								<div class="col-sm-7">
									<div style="clear: both; padding-bottom: 50px;">
										<div style="float: left; width: 40px;">{{ Form::radio('answer[0]', 'a', TRUE) }}</div>
										<div style="float: left;">{{ Form::text('option[0][a]', Input::old('option[0][a]'), array('style' => 'width: 300px;', 'class' => 'form-control','maxlength'=>'255')) }}</div>
									</div>
									
									<div style="clear: both; padding-bottom: 50px;">
										<div style="float: left; width: 40px;">{{ Form::radio('answer[0]', 'b') }}</div>
										<div style="float: left;">{{ Form::text('option[0][b]', Input::old('option[0][b]'), array('style' => 'width: 300px', 'class' => 'form-control','maxlength'=>'255')) }}</div>
									</div>

									<div style="clear: both; padding-bottom: 50px;">
										<div style="float: left; width: 40px;">{{ Form::radio('answer[0]', 'c') }}</div>
										<div style="float: left;">{{ Form::text('option[0][c]', Input::old('option[0][c]'), array('style' => 'width: 300px', 'class' => 'form-control','maxlength'=>'255')) }}</div>
									</div>

									<div style="clear: both; padding-bottom: 50px;">
										<div style="float: left; width: 40px;">{{ Form::radio('answer[0]', 'd') }}</div>
										<div style="float: left;">{{ Form::text('option[0][d]', Input::old('option[0][d]'), array('style' => 'width: 300px', 'class' => 'form-control','maxlength'=>'255')) }}</div>
									</div>
								</div>
							</div>
						@endif

						<div class="form-group" id="addQuestionBtn">
							<label for="" class="col-sm-3 control-label"></label>
							<div class="col-sm-7">
								<a class="btn btn-primary" id="addQuestion">Add More Questions</a>
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-3 control-label"></label>
							<div class="col-sm-7">
								<br />
								<a class="btn btn-primary" id="submitForm">Submit</a>
							</div>
						</div>
						{{ Form::hidden('count', Input::old('counter'), array('id' => 'count')) }}
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
	$('.time_limit').mask('00');
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
	
	// Add Question
	$('#addQuestion').click(function() {
	 	itemcount = isNaN(parseInt($('#count').val())) ? 0 : parseInt($('#count').val());
	 	itemcount = itemcount + 1;
	 	$('#count').val(itemcount);
    	
	 	question_div = '<div class="form-group" id="question_'+itemcount+'">';
		question_div += '	<label for="question" class="col-sm-3 control-label">Question:</label>';
		question_div += '	<div class="col-sm-7">';
		question_div += '		<input class="form-control" maxlength="255" name="question['+itemcount+']" type="text">';
		question_div += '	</div>';
		question_div += '</div>';

		question_div += '<div class="form-group" id="answer_'+itemcount+'">';
		question_div += '	<label for="answer" class="col-sm-3 control-label">Options:</label>';
		question_div += '	<div class="col-sm-7">';
		question_div += '		<div style="clear: both; padding-bottom: 50px;">';
		question_div += '			<div style="float: left; width: 40px;"><input name="answer['+itemcount+']" type="radio" value="a" checked="checked"></div>';
		question_div += '			<div style="float: left;"><input style="width: 300px;" class="form-control" maxlength="255" name="option['+itemcount+'][a]" type="text"></div>';
		question_div += '		</div>';
		question_div += '		<div style="clear: both; padding-bottom: 50px;">';
		question_div += '			<div style="float: left; width: 40px;"><input name="answer['+itemcount+']" type="radio" value="b"></div>';
		question_div += '			<div style="float: left;"><input style="width: 300px" class="form-control" maxlength="255" name="option['+itemcount+'][b]" type="text"></div>';
		question_div += '		</div>';
		question_div += '		<div style="clear: both; padding-bottom: 50px;">';
		question_div += '			<div style="float: left; width: 40px;"><input name="answer['+itemcount+']" type="radio" value="c"></div>';
		question_div += '			<div style="float: left;"><input style="width: 300px" class="form-control" maxlength="255" name="option['+itemcount+'][c]" type="text"></div>';
		question_div += '		</div>';
		question_div += '		<div style="clear: both; padding-bottom: 50px;">';
		question_div += '			<div style="float: left; width: 40px;"><input name="answer['+itemcount+']" type="radio" value="d"></div>';
		question_div += '			<div style="float: left;"><input style="width: 300px" class="form-control" maxlength="255" name="option['+itemcount+'][d]" type="text"></div>';
		question_div += '		</div>';
		question_div += '		<div style="clear: both; padding-bottom: 10px;" align="left">';
		question_div += '			<a class="btn btn-primary deleteQuestion" data-id="'+itemcount+'">Delete Question</a>';
		question_div += '		</div>';
		question_div += '	</div>';
		question_div += '</div>';

		$(question_div).insertBefore('#addQuestionBtn');
		
		$('#question_' + itemcount).page();
		$('#answer_' + itemcount).page();
    });

	// Delete Question	
	$('.container').on('click', '.deleteQuestion', function () { 	
		id = $(this).data('id');

		$('#question_' + id).remove();
		$('#answer_' + id).remove();
	});
});
</script>