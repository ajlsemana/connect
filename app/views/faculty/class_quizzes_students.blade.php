<div class="row">
   <div class="span12">
      <div class="widget">
         <div class="widget-header">
            <i class="icon-pencil"></i>
            <h3>Trainee Result for {{ $_GET['course'] }}</h3>
         </div>
         <div class="widget-content">
            <div class="tab-content">
               <div class="tab-pane active" id="quizzes">
                  <div class="row">
                     <div class="span12">
                        <div align="left">
                           <a href="javascript:window.history.back();" class="btn btn-primary" title="Back to List">Back to List</a>
                        </div>
                        <br />
                        <div class="table-responsive">
                           <table class="table table-striped">
                              <thead>
                                 <tr>
                                    <th>
                                       Trainee Name
                                    </th>
                                    <th>
                                       Assignment Score
                                    </th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @if( CommonHelper::arrayHasValue($students) ) 
                                 @foreach ($students as $student)
                                 <tr align="center">
                                    <td>{{ $student->last_name }}, {{ $student->first_name }}</td>
                                    <td>{{ $student->grade }} / {{ $student->points }}</td>
                                    <td>
                                       <a data-toggle="modal" data-target="#viewModal" data-id="{{ $student->qs_id }}" class="view icon-file" style="cursor: pointer;" title="View Quiz"></a>
                                    </td>
                                 </tr>
                                 @endforeach
                                 @else
                                 <tr>
                                    <td colspan="3" class="align-center" style="padding: 10px;">Empty Results</td>
                                 </tr>
                                 @endif
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--modal for view -->
            <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Assignment</h4>
                     </div>
                     <div class="modal-body">
                        <div class="control-group">
                           <label for="title" class="col-sm-4 control-label">Trainee Name:</label>
                           <div class="span7 modal_details" id="d_student"></div>
                        </div>
                        <div class="control-group">
                           <label for="title" class="col-sm-4 control-label">Assignment Title:</label>
                           <div class="span7 modal_details" id="d_quiz"></div>
                        </div>
                        <div class="control-group">
                           <label for="files" class="col-sm-4 control-label">Answers:</label>
                           <div class="span7 modal_details" id="d_answers"></div>
                        </div>                        
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>
            <!-- end of modal for view -->
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function() {
   	$(function () {
   	    $('#myTab').tab();
   	})
   
   	// View
       $('.view').click(function() {
       	$('#d_student').html('');
       	$('#d_quiz').html('');
       	$('#d_answers').html('');
       	
       	$.ajax({
   			url: '{{ URL::to("trainer/quizzes/getDetails") }}/'+ $(this).data('id'),
   			type: 'GET',
   			dataType: 'json',
   			//data: 'id=' + $(this).data('id'),
   			beforeSend: function() {
   			},
   			success: function(output_string) {               
   				if (output_string) {					
   					$('#d_student').html(output_string.student);
   			    	$('#d_quiz').html(output_string.quiz);
   			    	$('#d_answers').html(output_string.answers);
   				} else {
   					//location.href = '{{ URL::to("trainer/quizzes") }}';
   				}
   			},
   			error: function() {      
   				//location.href = '{{ URL::to("trainer/quizzes") }}';
   			}
   		}); 
   	});
   });
</script>