<div class="row">
   <div class="span6">
      <div class="widget">
         <div class="widget-header">
            <i class="icon-bell"></i>
            <h3>Today's New Registrants</h3>
         </div>
         <div class="widget-content">
            @if( CommonHelper::arrayHasValue($users) ) 		 
            @foreach ($users as $user)	
            <?php
               $then = new DateTime($user->cat);
               $now = new DateTime();

               $sinceThen = $then->diff($now);	
               $timer = $sinceThen->h.' hr(s) '.$sinceThen->i.' min(s)';					
               //Combined
               /*
               echo $sinceThen->d.' days have passed.<br>';
               echo $sinceThen->h.' hours have passed.<br>';
               echo $sinceThen->i.' minutes have passed.<br>';
               */
               $fullname = '<a href="'.URL::to('admin/attendees/update?id='.$user->rid).'">'.$user->first_name.' '.$user->last_name.'</a> is going for <b>'.$user->name.'</b>';
               ?>		
            <i class="icon-star" style="color: #08659B;"></i> {{ $fullname }}<br>			  
            @endForeach
            @else
            ** No results found. **
            @endif			     
         </div>
      </div>
   </div>
   <div class="span6">
         <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-list-alt"></i>
              <h3> Total Users</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <div class="widget big-stats-container">
                <div class="widget-content">
                  <h6 class="bigstats">Our portal users are getting bigger and bigger each day. The goal is to make everyone happy and satisfied based on our services.</h6>
                  <div id="big_stats" class="cf">                       
                      <div class="stat" title="{{ $total[0]->trainers }} @if($total[0]->trainers > 1) TRAINERS @else TRAINER @endif"> {{ HTML::image('resources/img/trainer.png', 'trainers', array('height' => '50', 'width' => '50', 'class' => 'img-responsive')) }}<br><span class="value">{{ $total[0]->trainers }}</span> </div>                                                                                 
                      <div class="stat" title="{{ $total[0]->trainees }} @if($total[0]->trainees > 1) TRAINEES @else TRAINEE @endif"> {{ HTML::image('resources/img/trainee.png', 'trainees', array('height' => '50', 'width' => '50', 'class' => 'img-responsive')) }}<br> <span class="value">{{ $total[0]->trainees }}</span> </div>    
                      <div class="stat" title="{{ $total[0]->engineers }} @if($total[0]->engineers > 1) ENGINEERS @else ENGINEER @endif"> {{ HTML::image('resources/img/engineer.png', 'engineers', array('height' => '50', 'width' => '50', 'class' => 'img-responsive')) }}<br> <span class="value">{{ $total[0]->engineers }}</span> </div>    
                      <div class="stat" title="{{ $total[0]->managers }} @if($total[0]->managers > 1) RESOURCE MANAGERS @else RESOURCE MANAGER @endif"> {{ HTML::image('resources/img/manager.png', 'resource managers', array('height' => '50', 'width' => '50', 'class' => 'img-responsive')) }}<br> <span class="value">{{ $total[0]->managers }}</span> </div>    
                  </div>
                  <div class="alert alert-info" id="stat-box" style="text-align: center;">
                   <strong>TRAINERS, TRAINEE, ENGINEERS and RESOURCE MANAGERS</strong>
                 </div>
                </div>
                <!-- /widget-content --> 
                
              </div>
            </div>
          </div>
      </div>
   </div>
</div>
<script>
$( "div.stat" ).hover(function() {
  var val = $( this ).attr('title');
  $('#stat-box').html('<strong style="color: #f20c0c;">'+val.toUpperCase()+'</strong>');
},
   function() {
      $('#stat-box').html('<strong>TRAINERS, TRAINEE, ENGINEERS and RESOURCE MANAGERS</strong>');
   }
);
</script>