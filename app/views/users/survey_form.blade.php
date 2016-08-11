@if( $errors->all() )
    <div class="alert alert-error">
    	<button class="close" data-dismiss="alert" type="button">&times;</button>
    	{{ HTML::ul($errors->all()) }}
    </div>
@endif
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
         	{{ Form::open(array('url'=>'update-feedback', 'class'=>'form-horizontal', 'autocomplete'=>'off', 'id'=>'form-feedback', 'role'=>'form', 'method' => 'post')) }}         	          	
              <table class="table">  
              	<tr>
              		<td colspan="2">
              			<b>Note: </b> You can also use decimal places for grading the engineer.<br>
              			Minimum grade is <font size="4">0</font> and the maximum grade is <font size="4">5</font>.
              		</td>
              	</tr>            	
              	<tr>
					@if($data->survey_status > 0)
						<td>
						   <table class="table" cellpadding="3">
							  <tr>
								 <td>
									&nbsp;Communication
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;		                        
									{{ Form::text('communication', $data->communication, array('style'=>'width: 45px;')) }}
								 </td>
								 <td align="right">
									Productivity
									&nbsp;&nbsp;&nbsp;		                        
									{{ Form::text('productivity', $data->productivity, array('style'=>'width: 45px;')) }}
								 </td>
							  </tr>
							  <tr>
								 <td>
									&nbsp;Commitment
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;		                        
									{{ Form::text('commitment', $data->commitment, array('style'=>'width: 45px;')) }}
								 </td>
								 <td align="right">
									Issues Fixing Quality
									&nbsp;&nbsp;&nbsp;		                        
									{{ Form::text('fixing', $data->fixing, array('style'=>'width: 45px;')) }}
								 </td>
							  </tr>
							  <tr>
								 <td>
									&nbsp;Analysis
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;		                        
									{{ Form::text('analysis', $data->analysis, array('style'=>'width: 45px;')) }}
								 </td>
								 <td align="right">
									Company Presentability
									&nbsp;&nbsp;&nbsp;		                        
									{{ Form::text('presentability', $data->presentability, array('style'=>'width: 45px;')) }}
								 </td>
							  </tr>
							  <tr>
								 <td>
									&nbsp;Quality of Delivery  
									&nbsp;&nbsp;                      		                        
									{{ Form::text('delivery', $data->delivery, array('style'=>'width: 45px;')) }}
								 </td>
								 <td align="right">
									Overall Recommendation
									&nbsp;&nbsp;&nbsp;		                        
									{{ Form::text('recommendation', $data->recommendation, array('style'=>'width: 45px;')) }}
								 </td>
							  </tr>		                  
						   </table>
						</td>
					 </tr>
					 <tr>			                  
	                  <td colspan="4">	                     
						 {{ Form::textarea('remarks', $data->remarks, array('placeholder'=>'Type your remarks here...', 'style' => 'width: 99%;', 'rows' => '7')) }}
	                  </td>
	           	   </tr>			
					@else
		            <td>
		               <table class="table" cellpadding="3">
		                  <tr>
		                     <td>
		                        &nbsp;Communication
		                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;		                        
								{{ Form::text('communication', Input::old('communication'), array('style'=>'width: 45px;')) }}
		                     </td>
		                     <td align="right">
		                        Productivity
		                        &nbsp;&nbsp;&nbsp;		                        
								{{ Form::text('productivity', Input::old('productivity'), array('style'=>'width: 45px;')) }}
		                     </td>
		                  </tr>
		                  <tr>
		                     <td>
		                        &nbsp;Commitment
		                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;		                        
								{{ Form::text('commitment', Input::old('commitment'), array('style'=>'width: 45px;')) }}
		                     </td>
		                     <td align="right">
		                        Issues Fixing Quality
		                        &nbsp;&nbsp;&nbsp;		                        
								{{ Form::text('fixing', Input::old('fixing'), array('style'=>'width: 45px;')) }}
		                     </td>
		                  </tr>
		                  <tr>
		                     <td>
		                        &nbsp;Analysis
		                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;		                        
								{{ Form::text('analysis', Input::old('analysis'), array('style'=>'width: 45px;')) }}
		                     </td>
		                     <td align="right">
		                        Company Presentability
		                        &nbsp;&nbsp;&nbsp;		                        
								{{ Form::text('presentability', Input::old('presentability'), array('style'=>'width: 45px;')) }}
		                     </td>
		                  </tr>
		                  <tr>
		                     <td>
		                        &nbsp;Quality of Delivery  
		                        &nbsp;&nbsp;                      		                        
								{{ Form::text('delivery', Input::old('delivery'), array('style'=>'width: 45px;')) }}
		                     </td>
		                     <td align="right">
		                        Overall Recommendation
		                        &nbsp;&nbsp;&nbsp;		                        
								{{ Form::text('recommendation', Input::old('recommendation'), array('style'=>'width: 45px;')) }}
		                     </td>
		                  </tr>		                  
		               </table>
		            </td>
		         </tr>
		         <tr>			                  
	                  <td colspan="4">	                     
						 {{ Form::textarea('remarks', Input::old('remarks'), array('placeholder'=>'Type your remarks here...', 'style' => 'width: 99%;', 'rows' => '7')) }}
	                  </td>
	           	   </tr>
				  @endif
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