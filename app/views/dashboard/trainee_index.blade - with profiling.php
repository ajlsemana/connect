@if( $errors->all() )
<div class="alert alert-error">
   <button class="close" data-dismiss="alert" type="button">&times;</button>
   {{ HTML::ul($errors->all()) }}
</div>
@endif
<!--
	Course ID
	7 - Workshop - Altitude uCI 8 Reports
-->
<?php 
	$prof = FALSE;
	if($profiling):
		//if($profiling->course == 7): LIVE Environment
		if($profiling->course == 6): //LOCAL Environment
			$prof = TRUE;
		endif;
	endif;
?>
@if($prof && $profiling_ctr > 0 && Auth::user()->skills_map == 0)
<div class="row">
   <div class="span7">
      <div class="widget">
         <div class="widget-header" id="widget-head">
            <i class="icon-user"></i>
            <h3>Personal Details</h3>
         </div>
         <div class="widget-content">
			{{ Form::open(array('url'=> 'trainee/profiling', 'class'=>'form-horizontal', 'autocomplete'=>'on', 'role'=>'form', 'method' => 'post')) }}    
            <table class="table table-striped table-bordered" id="tbl-step1">
               <tbody>
                  <tr>
                     <td><b>First Name</b></td>
                     <td>{{ Auth::user()->first_name }}</td>
                  </tr>
                  <tr>
                     <td><b>Last Name</b></td>
                     <td>{{ Auth::user()->last_name }}</td>
                  </tr>
                  <tr>
                     <td><b>Company</b></td>
                     <td>{{ Auth::user()->company }}</td>
                  </tr>
                  <tr>
                     <td><b>Designation</b></td>
                     <td>{{ Auth::user()->position }}</td>
                  </tr>
                  <tr>
                     <td><b>Contact #</b></td>
                     <td>{{ Auth::user()->contact_number }}</td>
                  </tr>
                  <tr>
                     <td><b>Primary Email</b></td>
                     <td>{{ Auth::user()->primary_email_address }}</td>
                  </tr>
                  <tr>
                     <td><b>Secondary Email</b></td>
                     <td>{{ Auth::user()->secondary_email }}</td>
                  </tr>
				  <tr>
                     <td><b>Date of Birth</b></td>
                     <td><input type="date" id="birth" name="birth" required></td>
                  </tr>
				  <tr>
					<td colspan="2" align="center">
						<a href="#" class="btn btn-primary" id="step1">Next Step</a>
					</td>
				  </tr>
               </tbody>
            </table>
			<div id="div-step2" style="display: none;">
				<table class="table table-striped table-bordered">
				   <tbody>
					  <tr>
						<th colspan="2"><h3>{{ $profiling->name }}</h3></th>
					  </tr>
					  <tr>
				   </tbody>
				</table>
				 <b>1. Tell us about the major Challenges faced while creating reports in Altitude uCI 8?</b>			
					<textarea name="answer1" style="width: 100%; height: 120px;" required></textarea>
					<br><br>
				 <b>2. Please describe the Reports and their objectives that you need assistance with?</b>
					<textarea name="answer2" style="width: 100%; height: 120px;" required></textarea>
					<br><br>
				 <b>3. How knowledgeable are you with the terms, tools etc used in the Altitude uCI 8 Reporting?</b>
					<br>
					<input type="radio" name="rate" value="Poor" required> Poor<br>
					<input type="radio" name="rate" value="Average"> Average<br>
					<input type="radio" name="rate" value="Good"> Good<br>
					<input type="radio" name="rate" value="Excellent"> Excellent<br>
					<input type="hidden" name="course" value="{{ $profiling->course }}">
					<input type="hidden" name="id" value="{{ $profiling->id }}">
					<br><br>
					<center>
						<input type="submit" class="btn btn-primary" id="step2" value="Finish">				
					</center>
				{{ Form::close() }}
			</div>
         </div>
      </div>
   </div>
</div>
<script>
	$('#step1').click(function(e) {
		e.preventDefault();	
		
		if($('#birth').val() != '') {		
			$('#widget-head').hide();
			$('#tbl-step1').hide();
			$('#div-step2').show();
		} else {
			alert('Date of birth is required.');
		}
	});
</script>
@else
<div class="row">
   <div class="span6">
      <div class="widget">
         <div class="widget-header">
            <i class="icon-calendar"></i>
            <h3>Upcoming Trainings</h3>
         </div>
         <div class="widget-content">
            {{ Form::open(array('url'=> 'trainee/registration_process', 'class'=>'form-horizontal', 'autocomplete'=>'on', 'id'=>'form-users', 'role'=>'form', 'method' => 'post')) }}    
            <?php
               $month = array(
                  '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
                  '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
                  '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
               );                                                        
               foreach($course_options as $key => $courses) {
                  echo '&nbsp;&nbsp;&nbsp;<i class="icon-star-empty"></i> <font size="2" color="#08659B">'.strtoupper($key).'</font><br>';                                    
                  foreach($courses as $key_id => $course_val) {
                     $explode = explode('-', $course_val);   
                     if($month[$explode[1]] != $month[$explode[4]]) {
                        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.(! in_array($key_id, $enrolled_courses) ? Form::checkbox('course[]', $key_id) : '<i class="icon-thumbs-up"></i>').' <b>'.$explode[2].' '.strtoupper($month[$explode[1]]).' '.$explode[0].' to '.$explode[5].' '.strtoupper($month[$explode[4]]).' '.$explode[3].'</b><br>';
                     } else {
                        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.(! in_array($key_id, $enrolled_courses) ? Form::checkbox('course[]', $key_id) : '<i class="icon-thumbs-up"></i>').' <b>'.$explode[2].' - '.$explode[5].' '.strtoupper($month[$explode[1]]).' '.$explode[0].'</b><br>';
                     }
                  }
               }
               ?>            
            {{ Form::hidden('user_type', '3') }}
            <br>
            <input type="submit" class="btn btn-primary" value="REGISTER NOW">
            <input type="reset" class="btn" value="CANCEL">
            {{ Form::close() }}
         </div>
      </div>
   </div>
   <div class="span6">
      <div class="widget">
         <div class="widget-header">
            <i class="icon-bullhorn"></i>
            <h3>Announcements</h3>
         </div>
         <div class="widget-content">
            @if($announcements)
            <table class="table table-striped table-bordered">
               <tbody>
                  @foreach($announcements as $announcement)
                  <tr>
                     <?php
                        $exp = explode('-', $announcement->date_from);
                        $expTo = explode('-', $announcement->date_to);                        
                        echo '<td>';
                        echo '<h3 style="color: #08659B;">'.$announcement->title.'</h3>';
                        echo '<font size="1">';
                        if($exp[1] == $expTo[1]) { 						
                           echo ($expTo[2] == $exp[2] ? $exp[2] : $exp[2].' - '.$expTo[2]).' '.$month[$exp[1]].' '.$exp[0].'<br><br>';                           
                        } else {                           
                           echo $exp[2].' '.$month[$exp[1]].' '.$exp[0].' - '.$expTo[2].' '.$month[$expTo[1]].' '.$expTo[0].'<br><br>';                           
                        }
                        echo '</font>';
                        echo $announcement->content;
                        echo '</td>';
                        #$exp[2].' - '.$exp[5].' '.strtoupper($month[$exp[1]]).' '.$exp[0].'</b><br>';
                        ?> 
                  </tr>
                  @endforeach  
               </tbody>
            </table>
            @else
            ** No announcement. **
            @endif
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="span12">
      <div class="widget">
         <div class="widget-header">
            <i class="icon-envelope-alt"></i>
            <h3>How may can we help you?</h3>
         </div>
         <div class="widget-content">
            {{ Form::open(array('url'=> 'trainee/send-mail', 'class'=>'form-horizontal', 'autocomplete'=>'on', 'id'=>'form-email', 'role'=>'form', 'method' => 'post')) }}    
            <table class="table table-striped table-bordered">
               <tr>
                  <td>
                     Subject&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     {{ Form::text('subject', null, array('style' => 'width: 700px;')) }}
                  </td>
               </tr>
               <tr>
                  <td>
                     Regarding 
                     {{ Form::select('regarding', array('' => '- Please Select -', 'Feedback' => 'Feedback', 'Complaints' => 'Complaints', 'Inquiry' => 'Inquiry')) }}
                  </td>
               </tr>
               <tr>
                  <td>
                     Message&nbsp;&nbsp;
                     {{ Form::textarea('message', null, array('style' => 'width: 700px;', 'wrap' => 'hard')) }}
                  </td>
               </tr>
               <tr>
                  <td>
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     {{ Form::submit('Send Message', array('class' => 'btn-primary btn')) }}
                     {{ Form::reset('Clear', array('class' => 'btn')) }}
                  </td>
               </tr>
            </table>
            {{ Form::close() }}
         </div>
      </div>
   </div>
</div>
@endif
</div>