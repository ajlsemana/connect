<div class="row">
<div class="span12">
<div class="widget">
<div class="widget-header">
   <i class="icon-comments"></i>
   <h3>{{ htmlentities($quiz->title) }} - {{ $course->name }}</h3>
</div>
<div class="widget-content">
<div class="tab-content">
<div class="tab-pane active" id="wall">
   <div class="row">
      <div class="span12">
         <div class="tab-content">
            <div class="tab-pane active" id="quizzes">
               <div class="row">
                  <div class="span12">
                     <div class="panel panel-default">
                        <div class="panel-body">
                           {{ Form::open(array('url' => URL::to('trainee/quizzes/submitQuiz'), 'class'=>'', 'autocomplete'=>'off', 'id'=>'form-post', 'role'=>'form', 'method' => 'post')) }}
                           <div class="form-group">
                              <label for="description"><b>Instruction</b></label>
                              {{ htmlentities($quiz->description) }}
                           </div>
                           <div class="form-group">
                           	<br>
                              <label for="time_limit"><b>Time Limit</b></label>
                              <div id="countdowntimer" style="width: 200px; height: 50px;"></div>
                           </div>
                           <br />
                           @for ($counter = 0; $counter < count($quiz_items); $counter++)
                           <div class="form-group">
                              <label for="question">{{ ($counter+1).'.' }} {{ htmlentities($quiz_items[$counter]->question) }}</label>
                              <div style="clear: both; padding-bottom: 15px;">
                                 <div style="float: left; width: 25px;">
                                    {{ Form::radio('answer['.$quiz_items[$counter]->id.']', 'a') }}
                                 </div>
                                 <div style="float: left;">{{ htmlentities($quiz_items[$counter]->option_a) }}</div>
                              </div>
                              <div style="clear: both; padding-bottom: 15px;">
                                 <div style="float: left; width: 25px;">
                                    {{ Form::radio('answer['.$quiz_items[$counter]->id.']', 'b') }}
                                 </div>
                                 <div style="float: left;">{{ htmlentities($quiz_items[$counter]->option_b) }}</div>
                              </div>
                              <div style="clear: both; padding-bottom: 15px;">
                                 <div style="float: left; width: 25px;">
                                    {{ Form::radio('answer['.$quiz_items[$counter]->id.']', 'c') }}
                                 </div>
                                 <div style="float: left;">{{ htmlentities($quiz_items[$counter]->option_c) }}</div>
                              </div>
                              <div style="clear: both; padding-bottom: 30px;">
                                 <div style="float: left; width: 25px;">
                                    {{ Form::radio('answer['.$quiz_items[$counter]->id.']', 'd') }}
                                 </div>
                                 <div style="float: left;">{{ htmlentities($quiz_items[$counter]->option_d) }}</div>
                              </div>
                           </div>
                           @endfor
                           <div class="form-group">
                              <label for=""></label>
                              <br />
                              <a class="btn btn-primary" id="submitForm">Submit</a>
                           </div>
                           @if(isset($_GET['status']))
                              {{ Form::hidden('status', 'attended') }}
                           @endif
                           {{ Form::hidden('id', $quiz->id) }}
                           {{ Form::hidden('course_id', $course->cid) }}
                           {{ Form::hidden('count', $counter, array('id' => 'count')) }}												
                           {{ Form::hidden('quiz_student_id', $quiz_student_id) }}
                           {{ Form::close() }}	
                        </div>
                     </div>
                  </div>
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
       countdowntimer.setSeconds(countdowntimer.getSeconds() + {{ ($quiz->time_limit*60) }}); 
   
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