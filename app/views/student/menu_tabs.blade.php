@if( $errors->all() )
<div class="alert alert-error">
   <button class="close" data-dismiss="alert" type="button">&times;</button>
   {{ HTML::ul($errors->all()) }}
</div>
@endif 
@if($course->attendance_status == 'Confirmed' OR $course->reference == 'POP')
<ul class="nav nav-tabs">
   <?php
      $status = '';

      if(isset($_GET['status'])) {
         $status = '?status=attended';
      }
   ?>
   <li class="@if (in_array($route, array('trainee/enrolled-training/{id}'))) active @endif">
      <a href="{{ URL::to('trainee/enrolled-training/'.$course->cid.$status) }}">Home</a>
   </li>
   <li class="@if (in_array($route, array('trainee/wall-announcement/{course_id}'))) active @endif">      
      <a href="{{ URL::to('trainee/wall-announcement/'.$course->cid.$status) }}">Announcements</a>
   </li>
   <li class="@if (in_array($route, array('trainee/quizzes/{id}'))) active @endif">
      <a href="{{ URL::to('trainee/quizzes/'.$course->cid.$status) }}">Assignments</a>
   </li>
   <li class="@if (in_array($route, array('trainee/calendar/{id}'))) active @endif">      
      <a href="{{ URL::to('trainee/calendar/'.$course->cid.$status) }}">Calendar</a>
   </li>
   <?php               
      $path = Config::get('app.url_storage') . '/certificates/' . $course->certificate;
      $target = 'target="_blank"';
      if(empty($course->certificate)) {                  
         $path = 'javascript:alert(\'No certificate uploaded yet for this course.\')';
         $target = '';
      }               
      ?>
   <li class=""><a {{ $target }} href="{{ $path }}">Certificate</a></li>
   <li>
      <a href="#">Surveys</a>
   </li>
</ul>
<br>
@else
<div class="alert alert-info">
   <b>** Your status needs to be Confirmed by the admin before you can explore full functionalities. **</b>
</div>
@endif