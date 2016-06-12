<div class="row">
   <div class="span12">
      <div class="widget">
         <div class="widget-header">
            <i class="icon-pencil"></i>
            <h3>{{ $course->name }} Assignment</h3>
         </div>
         <div class="widget-content">
            <div class="tab-content">
               <div class="tab-pane active" id="quizzes">
                  <div class="row">
                     <div class="span12">
                        <div align="left">
                           <a href="{{ URL::to($url_back) }}" class="btn btn-primary" title="Back to List">Back to List</a>
                           <a href="{{ URL::to('trainer/quizzes/update/' . $quiz->id) }}" class="btn btn-primary" title="Update Quiz">Update Quiz</a>
                           <a href="#" class="btn btn-danger delete" data-id="{{ $quiz->id }}" title="Delete Quiz">Delete Quiz</a>
                        </div>
                        <br />
                        <div class="panel panel-default">
                           <div class="panel-heading"><h3>{{ htmlentities($quiz->title) }}</h3></div>
                           <div class="panel-body">
                              {{ Form::open(array('url' => '', 'class'=>'form-horizontal', 'autocomplete'=>'off', 'id'=>'form-post', 'role'=>'form', 'method' => 'post')) }}
                              <div class="control-group">
                                 <label for="description" class="span3 control-label"><b>Instruction:</b></label>
                                 <div class="span7 modal_details">{{ htmlentities($quiz->description) }}</div>
                              </div>
                              <div class="control-group">
                                 <label for="due_date" class="span3 control-label"><b>Time Limit:</b></label>
                                 <div class="span7 modal_details">{{ $quiz->time_limit }} minutes</div>
                              </div>
                              <div class="control-group">
                                 <label for="due_date" class="span3 control-label"><b>Due Date:</b></label>
                                 <div class="span7 modal_details">{{ date('F d, Y', strtotime($quiz->due_date)) }}</div>
                              </div>
                              {{ Form::close() }}	
                           </div>
                        </div>
                        <div class="panel panel-default" style="font-weight: 700; background-color: #428BCA; color: #ffffff;">
                           <div class="panel-body">QUESTIONS</div>
                        </div>
                        <?php $ctr = 1; ?>
                        @foreach ($quiz_items as $item)
                        <div class="panel panel-default">
                           <div class="panel-heading"><?php echo '<strong>'.$ctr.')</strong>'; ?> {{ htmlentities($item->question) }}</div>
                           <div class="panel-body">
                              <div class="control-group">
                                 <label for="answer" class="span2 control-label">Choices:</label>
                                 <div class="modal_details">
                                    <div style="clear: both; margin-left: 30px; padding-bottom: 5px;">
                                       @if ($item->answer == 'a')
                                       <span style="color: #005AB0; font-weight: bold;">A. {{ htmlentities($item->option_a) }}</span>
                                       @else
                                       A. {{ htmlentities($item->option_a) }}
                                       @endif
                                    </div>
                                    <div style="clear: both; margin-left: 30px; padding-bottom: 5px;">
                                       @if ($item->answer == 'b')
                                       <span style="color: #005AB0; font-weight: bold;">B. {{ htmlentities($item->option_b) }}</span>
                                       @else
                                       B. {{ htmlentities($item->option_b) }}
                                       @endif
                                    </div>
                                    <div style="clear: both; margin-left: 30px; padding-bottom: 5px;">
                                       @if ($item->answer == 'c')
                                       <span style="color: #005AB0; font-weight: bold;">C. {{ htmlentities($item->option_c) }}</span>
                                       @else
                                       C. {{ htmlentities($item->option_c) }}
                                       @endif
                                    </div>
                                    <div style="clear: both; margin-left: 30px; padding-bottom: 5px;">
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
                        <?php $ctr++; ?>
                        @endforeach
                     </div>
                  </div>
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
   
   	// Delete
   	$('.delete').click(function() {
   		if (confirm('Delete Quiz?')) {
   			id = $(this).data('id');
   			cid = '{{ Input::segment(5) }}';
   
   			location.href = "{{ URL::to('trainer/quizzes/delete') }}/" + id +'/'+cid;
   		} else {
   			return false;
   		}
   	});
   });
</script>