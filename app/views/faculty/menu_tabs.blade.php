@if( $errors->all() )
<div class="alert alert-error">
   <button class="close" data-dismiss="alert" type="button">&times;</button>
   {{ HTML::ul($errors->all()) }}
</div>
@endif
<div class="widget ">
   <div class="widget-header">
      <i class="icon-flag"></i>
      <h3>{{ $course->name }}</h3>
   </div>
   <!-- /widget-header -->
   <div class="widget-content">
      <div class="tabbable">         	  
         @if($course->attendance_status == 'Confirmed')
         <ul class="nav nav-tabs">
            <li class="active">
               <a href="#">Home</a>
            </li>
            <li>
               <a href="{{ URL::to('trainee/wall-announcement/'.$course->id) }}">Announcements</a>
            </li>
            <li>
               <a href="{{ URL::to('') }}">Assignments</a>
            </li>
            <li>
               <a href="{{ URL::to('trainee/calendar/'.$course->id) }}">Calendar</a>
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
         <div class="tab-content">
            HOME here...            
         </div>
         @else
            <div class="alert alert-info">
               <b>** Your status needs to be Confirmed by the admin before you can explore full functionalities. **</b>
            </div>
         @endif
      </div>
   </div>
   <!-- /widget-content -->
</div>