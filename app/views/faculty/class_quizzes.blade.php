<div class="tab-content">
   <div class="tab-pane active" id="quizzes">
      <div class="row">
         <div class="span12">
            <div align="left">
               <a href="{{ URL::to('trainer/quizzes/add/'.Input::segment(3)) }}" class="btn btn-primary" title="Add New Quiz">Add New Assignment</a>
            </div>
            <br />
            <div class="widget">
               <div class="widget-header">
                  <i class="icon-list"></i>
                  <h3>{{ $course->name }} Assignments</h3>
               </div>
               <div class="widget-content">
                  <div class="table-responsive">
                     <table class="table table-striped">
                        <thead>
                           <tr>
                              <th>
                                 Title
                              </th>
                              <th>
                                 Time Limit
                              </th>
                              <th>
                                 Points
                              </th>
                              <th>
                                 Due Date
                              </th>
                              <th>Status</th>
                              <th>Visibility</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @if( CommonHelper::arrayHasValue($quizzes) ) 
                           @foreach ($quizzes as $quiz)
                           <tr align="center">
                              <td>{{ $quiz->title }}</td>
                              <td>{{ $quiz->time_limit }} minutes</td>
                              <td>{{ $quiz->points }}</td>
                              <td>{{ date('F d, Y', strtotime($quiz->due_date)) }}</td>
                              <td>{{ (date('Y-m-d') <= $quiz->due_date) ? 'Open' : 'Closed' }}</td>
                              <td>
                                 @if($quiz->visible == 1)
                                 <i class="icon-eye-open" title="show"></i>
                                 @else
                                 <i class="icon-eye-close" title="hidden"></i>
                                 @endif
                              </td>
                              <td>
                                 <a href="{{ URL::to('trainer/quizzes/view/' . $quiz->id.'/'. Request::segment(3)) }}" class="icon-search" style="cursor: pointer;" title="View Details"></a>&nbsp;&nbsp;                                 
                                 <a href="{{ URL::to('trainer/quizzes/update/' . $quiz->id) }}" class="icon-pencil" title="Update"></a>&nbsp;&nbsp;                                 
                                 <a href="#" data-id="{{ $quiz->id }}" class="delete icon-trash" title="Delete"></a>&nbsp;&nbsp;
                                 <a href="{{ URL::to('trainer/quizzes/students/' . $quiz->id) }}?course={{ $course->name }}" class="icon-user" title="Quiz Results"></a> 
                              </td>
                           </tr>
                           @endforeach
                           @else
                           <tr>
                              <td colspan="6" class="align-center" style="padding: 10px;">Empty Results</td>
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
<script type="text/javascript">
   $(document).ready(function() {
   	$(function () {
   	    $('#myTab').tab();
   	})
   
   	// Delete
   	$('.delete').click(function() {
   		if (confirm('Delete Quiz?')) {
   			id = $(this).data('id');
            cid = '{{ Input::segment(3) }}';
   			location.href = "{{ URL::to('trainer/quizzes/delete') }}/" + id +'/'+cid;
   		} else {
   			return false;
   		}
   	});
   });
</script>