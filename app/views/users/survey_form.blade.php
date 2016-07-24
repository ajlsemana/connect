<div class="row">	
   <div class="span3">&nbsp;</div>
   <div class="span6">
   		<br>
   		<div class="widget">
         <div class="widget-header">
            <i class=" icon-pencil"></i>
            <h3>Customer Feedback Form</h3>
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
         	{{ Form::open(array('url'=>'admin/skills-map/add-feedback', 'class'=>'form-horizontal', 'autocomplete'=>'off', 'id'=>'form-feedback', 'role'=>'form', 'method' => 'post')) }}         	          	
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
		                        <input type="number" step="any" min="0" max="5" value="0" name="f_communication" style="width: 40px;">
		                     </td>
		                     <td align="right">
		                        Productivity
		                        &nbsp;&nbsp;&nbsp;
		                        <input type="number" step="any" min="0" max="5" value="0" name="f_productivity" style="width: 40px;">
		                     </td>
		                  </tr>
		                  <tr>
		                     <td>
		                        &nbsp;Commitment
		                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                        <input type="number" step="any" min="0" max="5" value="0" name="f_commitment" style="width: 40px;">
		                     </td>
		                     <td align="right">
		                        Issues Fixing Quality
		                        &nbsp;&nbsp;&nbsp;
		                        <input type="number" step="any" min="0" max="5" value="0" name="f_fixing" style="width: 40px;">
		                     </td>
		                  </tr>
		                  <tr>
		                     <td>
		                        &nbsp;Analysis
		                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                        <input type="number" step="any" min="0" max="5" value="0" name="f_analysis" style="width: 40px;">
		                     </td>
		                     <td align="right">
		                        Company Presentability
		                        &nbsp;&nbsp;&nbsp;
		                        <input type="number" step="any" min="0" max="5" value="0" name="f_presentability" style="width: 40px;">
		                     </td>
		                  </tr>
		                  <tr>
		                     <td>
		                        &nbsp;Quality of Delivery  
		                        &nbsp;&nbsp;                      
		                        <input type="number" step="any" min="0" max="5" value="0" name="f_delivery" style="width: 40px;">
		                     </td>
		                     <td align="right">
		                        Overall Recommendation
		                        &nbsp;&nbsp;&nbsp;
		                        <input type="number" step="any" min="0" max="5" value="0" name="f_recommendation" style="width: 40px;">
		                     </td>
		                  </tr>
		               </table>
		            </td>
		         </tr>
		         <tr>
		            <td colspan="4" align="center"><input type="submit" id="submit-feedback" style="background: #2c6b00;" class="btn btn-primary" value="Send Feedback"> <a data-dismiss="modal" aria-hidden="true" class="btn" onclick="document.getElementById('form-feedback').reset();">Clear</a>  </td>
		         </tr>
              </table>	 
              {{ Form::hidden('id', $data->id) }} 
              {{ Form::hidden('uid', $data->uid) }} 
              {{ Form::close() }}   
         </div>
      </div>
   </div>           
   <div class="span3">&nbsp;</div>
</div>
<script>
	$('.navbar').css('display', 'none');
	$('.subnavbar').css('display', 'none');
</script>