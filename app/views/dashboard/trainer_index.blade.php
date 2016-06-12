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
                  '01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr',
                  '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug',
                  '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'
               );                                                        
               foreach($course_options as $key => $courses) {
                  echo '&nbsp;&nbsp;&nbsp;<i class="icon-star-empty"></i> <font size="2" color="#08659B">'.strtoupper($key).'</font><br>';                                    
                  foreach($courses as $key_id => $course_val) {
                     $explode = explode('-', $course_val);   
                     if($month[$explode[1]] != $month[$explode[4]]) {
                        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$explode[2].' '.strtoupper($month[$explode[1]]).' '.$explode[0].' to '.$explode[5].' '.strtoupper($month[$explode[4]]).' '.$explode[3].'</b><br>';
                     } else {
                        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>'.$explode[2].' - '.$explode[5].' '.strtoupper($month[$explode[1]]).' '.$explode[0].'</b><br>';
                     }
                  }
               }
            ?>                     
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
            <table class="table table-striped table-bordered">       
                <tbody>
                  @foreach($announcements as $announcement)
                     <tr>
                     <?php
                        $exp = explode('-', $announcement->date_from);
                        $expTo = explode('-', $announcement->date_to);                        
                        echo '<td>';
                        echo '<h3 style="color: #08659B;">'.$announcement->title.'</h3>';
                        echo 'Date: ';
                        if($exp[1] == $expTo[1]) {                           
                           echo $exp[2].' - '.$expTo[2].' '.$month[$exp[1]].' '.$exp[0].'<br><br>';                           
                        } else {                           
                           echo $exp[2].' '.$month[$exp[1]].' '.$exp[0].' - '.$expTo[2].' '.$month[$expTo[1]].' '.$expTo[0].'<br><br>';                           
                        }
                        echo $announcement->content;
                        echo '</td>';
                        #$exp[2].' - '.$exp[5].' '.strtoupper($month[$exp[1]]).' '.$exp[0].'</b><br>';
                     ?> 
                     </tr>              
                  @endforeach                  
                </tbody>
              </table>            
         </div>
      </div>
   </div>
</div>
</div>