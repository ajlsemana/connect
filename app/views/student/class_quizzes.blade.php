<div class="row">
   <div class="span12">
      <div class="widget">
         <div class="widget-header">
            <i class="icon-comments"></i>
            <h3>{{ $course->name }} {{ $module }}</h3>
         </div>
         <div class="widget-content">
            <div class="tab-content">
               <div class="tab-pane active" id="wall">
                  <div class="row">
                     <div class="span12">
                        {{ $menu }}
                        <div class="table-responsive">
                           <table class="table table-striped">
                              <thead>
                                 <tr>
                                    <th>
                                       Title
                                    </th>
                                    <th>
                                       Due Date
                                    </th>                      
                                    <th>
                                       Score
                                    </th>
                                    <th>Status</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @if( CommonHelper::arrayHasValue($quizzes) ) 						
                                 @foreach ($quizzes as $quiz)
                                 <tr align="center">
                                    <td>
                                       @if (! in_array($quiz->id, $done_quizzes) && (date('Y-m-d') <= $quiz->due_date))
                                       <a style="cursor: pointer;" data-id="{{ $quiz->id }}" class="takequiz" title="Take Quiz">{{ htmlentities($quiz->title) }}</a>
                                       @else
                                       {{ htmlentities($quiz->title) }}
                                       @endif
                                    </td>
                                    <td>{{ date('F d, Y', strtotime($quiz->due_date)) }}</td>
                                    <td>{{ (array_key_exists($quiz->id, $quiz_grade) ? $quiz_grade[$quiz->id] : 'n/a') }} / {{ $quiz->points }}</td>                                    
                                    <td>								
                                       @if (! in_array($quiz->id, $done_quizzes))
                                       {{ (date('Y-m-d') <= $quiz->due_date) ? 'Open' : 'Closed' }}
                                       @else
                                       Done
                                       @endif
                                    </td>
                                    <td>
                                       @if (! in_array($quiz->id, $done_quizzes) && (date('Y-m-d') <= $quiz->due_date))
                                       <a style="cursor: pointer;" data-id="{{ $quiz->id }}" class="takequiz icon-pencil" title="Take Quiz"></a>
                                       @endif
                                    </td>
                                 </tr>
                                 @endforeach
                                 @else
                                 <tr>
                                    <td colspan="6" align="center" style="padding: 10px;">Empty Results</td>
                                 </tr>
                                 @endif                                 
                              </tbody>
                           </table>
                        </div>
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
   	});
   
   	$('.takequiz').click(function() {
   		if (confirm('Take the quiz now? \nYou can never go back once you click OK.\nGood luck!')) {
            var stat = '';
            @if(Input::has('status'))               
               stat = '?status=attended';                         
            @endif
   			var url = '/'+$(this).data('id')+'/{{ $course->cid }}';   			
   			location.href = "{{ URL::to('trainee/quizzes/take') }}"+url+stat;
   		} else {
   			return false;
   		}
   	});
   });
</script>