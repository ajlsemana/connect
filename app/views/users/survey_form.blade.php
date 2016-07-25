<div class="row">	
   <div class="span3">&nbsp;</div>
   <div class="span6">
   		<br>
   		<div class="widget">
         <div class="widget-header">
            <i class=" icon-pencil"></i>
            <h3>Customer Feedback Form ({{ $total_survey_done }}/{{ $total_survey }})</h3>
         </div>
         <div class="widget-content">
         	<?php
         		$pic = 'no-photo.jpg';

                if(! empty($data->profile_pic)) {
                   $pic = $data->profile_pic;
                }
                $destinationPath = Config::get('app.url_storage') . '/profile_pic/'.$pic;
         	?>         	
         	  {{ HTML::image($destinationPath, 'photo', array('width' => '160', 'title' => 'engineer photo', 'class' => '', 'style' => 'padding: 0; margin: 0; float: left; height: 160px !important;')) }}
         	  <br><br>
         	  &nbsp;&nbsp;
         	  <font size="4"><b>{{ $data->fullname }}</b></font>  
         	  <br>       
         	  &nbsp;&nbsp;	  
         	  <font size="3" class="title" color="#666">{{ $company[$data->company] }}</font>
         	{{ Form::open(array('url'=>'admin/skills-map/update-feedback', 'class'=>'form-horizontal', 'autocomplete'=>'off', 'id'=>'form-feedback', 'role'=>'form', 'method' => 'post')) }}         	          	
              <table class="table">  
              	<tr>
              		<td colspan="2">
              			<b>Note: </b> You can also use decimal places for grading the engineer.
              			Minimum grade is 0 and the maximum grade is 5.
              		</td>
              	</tr>            	
              	<tr>
		            <td>
		               <table class="table" cellpadding="3">
		                  <tr>
		                     <td>
		                        &nbsp;Communication
		                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                        <input type="number" step="any" min="0" max="5" value="<?php echo (! empty($data->communication) ? $data->communication : 0); ?>" name="f_communication" style="width: 45px;">
		                     </td>
		                     <td align="right">
		                        Productivity
		                        &nbsp;&nbsp;&nbsp;
		                        <input type="number" step="any" min="0" max="5" value="<?php echo (! empty($data->productivity) ? $data->productivity : 0); ?>" name="f_productivity" style="width: 45px;">
		                     </td>
		                  </tr>
		                  <tr>
		                     <td>
		                        &nbsp;Commitment
		                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                        <input type="number" step="any" min="0" max="5" value="<?php echo (! empty($data->commitment) ? $data->commitment : 0); ?>" name="f_commitment" style="width: 45px;">
		                     </td>
		                     <td align="right">
		                        Issues Fixing Quality
		                        &nbsp;&nbsp;&nbsp;
		                        <input type="number" step="any" min="0" max="5" value="<?php echo (! empty($data->fixing) ? $data->fixing : 0); ?>" name="f_fixing" style="width: 45px;">
		                     </td>
		                  </tr>
		                  <tr>
		                     <td>
		                        &nbsp;Analysis
		                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                        <input type="number" step="any" min="0" max="5" value="<?php echo (! empty($data->analysis) ? $data->analysis : 0); ?>" name="f_analysis" style="width: 45px;">
		                     </td>
		                     <td align="right">
		                        Company Presentability
		                        &nbsp;&nbsp;&nbsp;
		                        <input type="number" step="any" min="0" max="5" value="<?php echo (! empty($data->presentability) ? $data->presentability : 0); ?>" name="f_presentability" style="width: 45px;">
		                     </td>
		                  </tr>
		                  <tr>
		                     <td>
		                        &nbsp;Quality of Delivery  
		                        &nbsp;&nbsp;                      
		                        <input type="number" step="any" min="0" max="5" value="<?php echo (! empty($data->delivery) ? $data->delivery : 0); ?>" name="f_delivery" style="width: 45px;">
		                     </td>
		                     <td align="right">
		                        Overall Recommendation
		                        &nbsp;&nbsp;&nbsp;
		                        <input type="number" step="any" min="0" max="5" value="<?php echo (! empty($data->recommendation) ? $data->recommendation : 0); ?>" name="f_recommendation" style="width: 45px;">
		                     </td>
		                  </tr>		                  
		               </table>
		            </td>
		         </tr>
		         <tr>			                  
	                  <td colspan="4">
	                     <textarea placeholder="Type your remarks here..." style="width: 99%;" rows="7" name="remarks">{{ $data->remarks }}</textarea>
	                  </td>
	           	   </tr>
	           	 @if($data->survey_status == 0)
		         <tr>
		            <td colspan="4" align="center"><a id="submit-feedback" style="background: #2c6b00;" class="btn btn-primary">Send Feedback</a> <a data-dismiss="modal" aria-hidden="true" class="btn" onclick="document.getElementById('form-feedback').reset();">Clear</a>  </td>
		         </tr>
		         @else
		         <tr>
		            <td colspan="4" align="center">
		            	<div class="alert alert-success">                          
                          <i class="icon-ok-sign"></i> <b>Survey Done</b>
                        </div>		            	
		            </td>
		         </tr>
		         @endif
              </table>	 
              {{ Form::hidden('id', $data->id) }} 
              {{ Form::hidden('uid', $data->uid) }} 
              {{ Form::hidden('key', $_GET['key']) }} 
              {{ Form::hidden('to', $_GET['to']) }} 
              {{ Form::close() }}   
         </div>
      </div>
   </div>           
   <div class="span3">&nbsp;</div>
</div>
<script>
	$('.navbar').css('display', 'none');
	$('.subnavbar').css('display', 'none');

	@if($data->survey_status > 0)
		$('input, textarea').attr('disabled', 'disabled');
	@endif

	$('#submit-feedback').click(function() {
        @if($data->survey_status > 0)
    		alert('You already participated in this survey.');
    	@else    		
        	$('#form-feedback').submit();
        @endif
      });
      
      $('#form-feedback input').keydown(function(e) {
        if (e.keyCode == 13) {
        	@if($data->survey_status > 0)
        		alert('You already participated in this survey.');
        	@else        		
            	$('#form-feedback').submit();
            @endif
        }
     });
</script>