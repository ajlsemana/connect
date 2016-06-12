<?php
   $enrolled_array = array();
   $ended_array = array();
   
   if($enrolled_courses) {
      foreach($enrolled_courses as $row) {
         $enrolled_array[$row->uid][] = $row->name;
      }
   }
   
   if($ended_courses) {
      foreach($ended_courses as $row2) {
         $ended_array[$row2->uid][] = $row2->name;
      }
   }

   $color_arr = array(
         'red' => '#B6392A',
         'green' => '#1F9851',
         'yellow' => '#F6D259',
         'blue' => '#14B9D5'
      );
?>
{{ HTML::style('resources/css/pages/plans.css') }}
<style>        
   .image-oval {            
   /* width has to be 70% of height */
   /* could use width:70%; in a square container */      
      border: 1px solid #e0e0e0;

   /* beware that Safari needs actual
    px for border radius (bug) */
      -webkit-border-radius:63px 63px 63px 63px/
      108px 108px 72px 72px;
      /* fails in Safari, but overwrites in Chrome */
      border-radius: 50%;
   } 

   .badge {
     height: 26px;     
     display: table-cell;
     text-align: center;
     vertical-align: middle;
     border-radius: 50%;      
     font-size: 10px;
     background: #FFF;
     color: #000;     
   }  

   body {
      background: #E4E4E4;
   }
   
   .img:hover {
    opacity: 0.5;
    filter: alpha(opacity=100); /* For IE8 and earlier */ 
	} 

   a.excerpt-names:hover:after{
      content: attr(title);
      padding: 8px 12px;
      color: #85003a;
      position: absolute;
      left: 50px;
      top: 85%;
      white-space: nowrap;
      z-index: 20;
      -moz-border-radius: 3px;
      -webkit-border-radius: 3px;
      border-radius: 3px;
      -moz-box-shadow: 0px 0px 2px #c0c1c2;
      -webkit-box-shadow: 0px 0px 2px #c0c1c2;
      box-shadow: 0px 0px 2px #c0c1c2;
      background-image: -moz-linear-gradient(top, #ffffff, #eeeeee);
      background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, #ffffff),color-stop(1, #eeeeee));
      background-image: -webkit-linear-gradient(top, #ffffff, #eeeeee);
      background-image: -moz-linear-gradient(top, #ffffff, #eeeeee);
      background-image: -ms-linear-gradient(top, #ffffff, #eeeeee);
      background-image: -o-linear-gradient(top, #ffffff, #eeeeee);
   }
</style>
<div class="row">
<div class="span12" style="background: #E4E4E4; padding-bottom: 20px;">
   @if( CommonHelper::arrayHasValue($users) ) 
   @foreach ($users as $user) 
   <?php
      $color_arr = array(
         'red' => '#B6392A',
         'green' => '#1F9851',
         'yellow' => '#F6D259',
         'blue' => '#14B9D5'
      );

      $pic = 'no-photo.jpg';
      $destinationPath = Config::get('app.url_storage') . '/profile_pic/'.$pic;                       
      ?>       
   @if(! empty($user->profile_pic))
   <?php $pic = $user->profile_pic; ?>
   <?php $destinationPath = Config::get('app.url_storage') . '/profile_pic/'.$pic; ?>           
   @endif
   <div class="pricing-plans plans-4">
      <div class="plan-container">
         <div class="plan">
            <div class="plan-header">
               <!-- /plan-price -->
            </div>
               <div class="plan-price">
                  <a href="{{ $url_update . '?id=' . $user->id }}">{{ HTML::image($destinationPath, 'engineer photo', array('title' => $user->first_name.' '.$user->last_name, 'id' => 'photo-'.$user->id, 'data-id' => $user->id, 'class' => 'version-wrapper img-responsive', 'style' => 'z-index: -1; width: 178px; height: 178px !important;')) }}</a>                              
               </div>                     
               <div class="version-wrapper" style="width: 154px; padding: 5px 12px; background: #a5a5a5; opacity: 0.9;position: absolute;left: 8px; top: 145px; display: none;" id="version-{{ $user->id }}" data-id="{{ $user->id }}">
                  <div style="margin-left: 40px; float: left;">
                  <a href="{{ $url_update . '?show=v7&id=' . $user->id }}#a-version7" class="a-versions">
                     {{ HTML::image('resources/img/v7.png', 'uCI version 7', array('title' => 'uCI version 7', 'class' => 'img-responsive', 'style' => 'width: 35px;')) }}
                  </a>
                  </div>
                  <div style="margin-right: 40px; float: right;">
                  <a href="{{ $url_update . '?show=v8&id=' . $user->id }}#a-version8" class="a-versions">
                     {{ HTML::image('resources/img/v8_circle.png', 'uCI version 8', array('title' => 'uCI version 8', 'class' => 'img-responsive', 'style' => 'width: 20px;')) }}
                  </a>
                  </div>
               </div>               
               <div class="plan-title">                 
                  <div id="ac-{{ $user->id }}" style="background: #FFF; width: 30px; height: 30px; top: 165px; position: absolute;">                     
                     &nbsp;&nbsp;<a href="#view_courses_modal{{ $user->id }}" role="button" data-toggle="modal" title="view courses"><i class="icon-sitemap"></i></a>                 
                  </div>
               </div>
            
            <!-- /plan-header -->           
            <div class="plan-features" style="background: #FFF; width: 178px;">
               <ul>
               <div id="view_courses_modal{{ $user->id }}" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                     <h3 id="myModalLabel">Courses of {{ $user->first_name.' '.$user->last_name }}</h3>
                  </div>
                  <div class="modal-body">
                     <table class="table table-striped table-bordered">
                        <thead>
                           <tr>
                              <th> Enrolled Training </th>
                              <th> Attended Training</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(TRUE): ?>                            
                           <tr align="center">
                              <td>
                                 <?php 
                                    if(isset($enrolled_array[$user->id])) {
                                       foreach($enrolled_array[$user->id] as $value_enrolled)
                                       echo $value_enrolled.'<br><br>';
                                    } else {
                                       echo 'n/a';
                                    }
                                    ?>
                              </td>
                              <td>
                                 <?php 
                                    if(isset($ended_array[$user->id])) {
                                       foreach($ended_array[$user->id] as $value_ended)
                                       echo $value_ended.'<br><br>';
                                    } else {
                                       echo 'n/a';
                                    }
                                    ?>
                              </td>
                           </tr>
                           <?php
                              else:
                              ?>
                           <tr align="center">
                              <td colspan="2">Empty Results</td>
                           </tr>
                           <?php
                              endif;                           
                              ?> 
                        </tbody>
                     </table>
                  </div>
                  <div class="modal-footer">
                     <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>                    
                  </div>
               </div>
               <!--<div style="height: 70px; background: #0077B5; color: #FFF;">-->
               <div style="margin-top: -15px; height: 60px; font-family: sans-serif;">
                  <br>
                  <span class="term">                     
                     <a class="@if(strlen($user->first_name.' '.$user->last_name) >= 20) excerpt-names @endif" title="{{ $user->first_name.' '.$user->last_name }}" href="{{ URL::to('admin/skills-map/update?id='.$user->id) }}"><h4 style="color: #333; padding-left: 10px;">{{ ttruncat($user->first_name.' '.$user->last_name, 20) }}</h4></a>
                     <a class="@if(strlen($company[$user->company]) >= 20) excerpt-names @endif" title="{{ $company[$user->company] }}" href="{{ URL::to('admin/company?filter_company='.$user->company) }}"><h5 style="padding-left: 10px; font-size: 13px; color: #333; font-weight: normal;">{{ ttruncat($company[$user->company], 20) }}</h5></a>
                  </span>
               </div>
            </div>
            <!-- /plan-features -->                      
         </div>
         <!-- /plan -->
      </div>
      <!-- /plan-container -->            
   </div>
   <!-- /pricing-plans -->
   @endforeach
   @endif   
   <?php
      function ttruncat($text,$numb) {
      if (strlen($text) > $numb) { 
        $text = substr($text, 0, $numb); 
        $text = substr($text,0,strrpos($text," ")); 
        $etc = " ...";  
        $text = $text.$etc; 
        }
         return $text; 
      }
      ?>   
</div>
</div>
<!-- /widget -->              
<script type="text/javascript"><!--
   $('.version-wrapper').hover(function() {
         $('#ac-'+$(this).attr('data-id')).hide();
         $('#version-'+$(this).attr('data-id')).show();
         $('#photo-'+$(this).attr('data-id')).css('opacity', '0.5');
       }, function(){
         $('#ac-'+$(this).attr('data-id')).show();
         $('#version-'+$(this).attr('data-id')).hide();
       $('#photo-'+$(this).attr('data-id')).css('opacity', '1');
   });
   //--></script>