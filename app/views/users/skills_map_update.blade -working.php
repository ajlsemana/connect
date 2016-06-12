<?php 
  $route = Route::getCurrentRoute()->getPath(); 
  $version = 0;
  $path = 'skills-map';
  
  if($route == 'admin/skills-map-v7/update') {
    $version = 7;
    $path = 'skills-map-v7';
  } else if($route == 'admin/skills-map/update') {
    $version = 8;
  }
?>
<a href="{{ URL::to('admin/skills-map') }}" class="btn" title="Back to List"><i class="icon-arrow-left"></i></a>
<!--<a href="{{ URL::to('admin/skills-map-v7') }}" class="btn" title="Back to List"><i class="icon-arrow-left"></i></a> -->
<a href="#" type="button" class="btn" onclick="captureCurrentDiv();"><i class="icon-large icon-print"></i></a>
@if( $errors->all() )
<div class="alert alert-error">
   <button class="close" data-dismiss="alert" type="button">&times;</button>
   {{ HTML::ul($errors->all()) }}
</div>
@endif
<style>
   .pad-top {
   margin-top: 4px;
   }

   input[readonly] {
        cursor: none;
   }

   .check {
      background: url({{ asset('resources/img/check.PNG') }}) no-repeat 0px 0px;
      padding: 2px 0 7px 34px;
      border: 0; 
   }

   .uncheck {
      background: url({{ asset('resources/img/uncheck.PNG') }}) no-repeat 0px 0px;
      padding: 2px 0 6px 33px;
      border: 0;
   }

   #name h1 {
    font-size: 22px;
    font-weight: bold;
    line-height: 24px;
    color: #000;
   }

   p.title {
       font-size: 18px;
       font-weight: normal;
       line-height: 22px;
       color: #434649;
       color: #666;
   }

   td.fu-td {
    text-align: center;
    padding: 10px 5px;
    border: 1px solid #ccc;
  }

   th.rotate {
           /* Something you can count on */
           height: 140px;
           white-space: nowrap;
   }

   th.rotate > div {
     transform: 
       /* Magic Numbers */
       translate(25px, 51px)
       /* 45 is really 360 - 45 */
       rotate(295deg);
     width: 30px;
   }
   th.rotate > div > span {
     border-bottom: 1px solid #ccc;
     padding: 5px 10px;
   }

   th.row-header {
    padding: 0 10px;
    border-bottom: 1px solid #ccc;
  }

   .csstransforms & th.rotate {
     height: 140px;
     white-space: nowrap;
   }
</style>
{{ HTML::style('resources/css/tooltip.css') }}
<?php $url_path = 'admin/'.$path.'/'.'updateData'; ?>
{{ Form::model($skills, array('url'=>$url_path, 'class'=>'form-horizontal', 'id'=>'form-skills', 'role'=>'form', 'method' => 'post')) }}
<div class="rows">
   <div class="row" style="color: #1f49aa;">
      <div class="span12">
         <table cellpadding="15">    
            <tr style="background: #FFF;">
               <td width="10%">
                  <?php
                     $pic = 'no-photo.jpg';
                     $destinationPath = Config::get('app.url_storage') . '/profile_pic/'.$pic;
           
                   $version_img = 'resources/img/uCI_v'.$version.'_large.jpg';
                   if($version == 8) {
                      $version_img = 'resources/img/uCI_v'.$version.'_large.png';
                   }
                     ?>       
                  @if(! empty($skills->profile_pic))
                  <?php $pic = $skills->profile_pic; ?>
                  <?php $destinationPath = Config::get('app.url_storage') . '/profile_pic/'.$pic; ?>           
                  @endif   
        <div style="text-align: left;">
                  {{ HTML::image($destinationPath, 'logo', array('width' => '160', 'title' => 'engineer photo', 'class' => '', 'style' => 'height: 160px !important; border: 1px solid #f2f2f2;')) }} 
        </div>
               </td>
               <td width="40%">
                  <span id="name"><h1>{{ $skills->fullname }}</h1></span>
                  <p class="title" dir="ltr">{{ $company[$skills->company] }}</p>
               </td>
               <td width="50%" align="right">   
        {{ HTML::image($version_img, 'uCI version', array('style' => '', 'class' => 'version-photo')) }}
        <!--
                  <div id="divProgress"></div>
          <br>
          <b>Status (%):</b>
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           {{ Form::text('status', $skills->status, array('style'=>'width: 15%; color: #1f49aa;')) }}         
           <br>
           <b>Status as of:</b>
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           <?php
            $status_as = $skills->status_as_of;
            if($skills->status_as_of == '0000-00-00') {
               $status_as = '';
            }
           ?>
           <input type="text" name="status_as_of" style="color: #1f49aa;" value="{{ $status_as }}" class="date">
           <script>
            $('.date').datepicker({
              format: 'yyyy-mm-dd'
            });
           </script>
        -->
               </td>
            </tr>
         </table>                        
      </div>
      <center>    
      <h3><u><font color="#00649a">Altitude uCI {{ $version }} Skills Map</font></u></h3>
   </center>
      <div class="span12" style="padding: 5px 0; color: #fff; background: #00649a; margin-top: 6px;">
         <center>
            <font size="3">Core Skills</font>
      <span style="float: right; margin: -17px 7px 0 0;">
      {{ $colored_circle_cs }}
      </span>
         </center>
      </div>
      <div class="span12">
         <table class="table table-striped table-bordered">
            <thead>
               <tr align="center">
                  <th> Infrastructure</th>
                  <th> Pacing Mode</th>
                  <th> Channels</th>
                  <th> Development</th>
                  <th> Installation / Patch Upgrade</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <!-- start Infrastructure -->
                  <td>
                     <?php $core_rate = array(); ?>
                     {{ HTML::image('resources/img/skills-map/infrastructure/vbox.png', 'logo', array('onmouseover' => 'tooltip.pop(this, "#tip2"); getSkillData(this.id);', 'width' => '55', 'height' => '27', 'class' => 'img-responsive' , 'id' => 'img-vbox')) }}
                     <?php
                        $core_rate[$skills->vbox][][$skills->vbox_rate] = HTML::image('resources/img/skills-map/infrastructure/vbox.jpg', 'logo', array('width' => '55', 'height' => '27', 'class' => 'img-responsive'));
                        ?>
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                   
                     <i class="@if($skills->vbox != '0') check @else uncheck @endif"></i>                     
           <!--
             USE THIS IF YOU WILL PUT LINE GRAPH ON TEXT
             <span class="@if($skills->vbox != '0') check @else uncheck @endif"></span>
           -->
                     {{ dropDown('vbox', $skills->vbox) }}                    
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/infrastructure/alcatel.png', 'logo', array('onmouseover' => 'tooltip.pop(this, "#tip2"); getSkillData(this.id);','width' => '96', 'height' => '27', 'class' => 'img-responsive', 'id' => 'img-alcatel')) }}
                        <?php
                           $core_rate[$skills->alcatel][][$skills->alcatel_rate] = HTML::image('resources/img/skills-map/infrastructure/alcatel.jpg', 'logo', array('width' => '96', 'height' => '27', 'class' => 'img-responsive'));
                           ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="@if($skills->alcatel != '0') check @else uncheck @endif"></i>                        
                        {{ dropDown('alcatel', $skills->alcatel) }}
                     </div>
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/infrastructure/avaya.png', 'logo', array('onmouseover' => 'tooltip.pop(this, "#tip2"); getSkillData(this.id);','width' => '53', 'height' => '17', 'class' => 'img-responsive', 'id' => 'img-avaya')) }}
                        <?php
                           $core_rate[$skills->avaya][][$skills->avaya_rate] = HTML::image('resources/img/skills-map/infrastructure/avaya.jpg', 'logo', array('width' => '53', 'height' => '17', 'class' => 'img-responsive'));
                           ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="@if($skills->avaya != '0') check @else uncheck @endif"></i>                        
                        {{ dropDown('avaya', $skills->avaya) }}
                     </div>
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/infrastructure/cisco.png', 'logo', array('onmouseover' => 'tooltip.pop(this, "#tip2"); getSkillData(this.id);','width' => '49', 'height' => '20', 'class' => 'img-responsive', 'id' => 'img-cisco')) }}
                        <?php
                           $core_rate[$skills->cisco][][$skills->cisco_rate] = HTML::image('resources/img/skills-map/infrastructure/cisco.png', 'logo', array('width' => '49', 'height' => '20', 'class' => 'img-responsive'));
                           ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="@if($skills->cisco != '0') check @else uncheck @endif"></i>                      
                        {{ dropDown('cisco', $skills->cisco) }}
                     </div>
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/infrastructure/sql.png', 'logo', array('onmouseover' => 'tooltip.pop(this, "#tip2"); getSkillData(this.id);','width' => '80', 'height' => '23', 'class' => 'img-responsive', 'id' => 'img-sql_server')) }}
                        <?php
                           $core_rate[$skills->sql_server][][$skills->sql_rate] = HTML::image('resources/img/skills-map/infrastructure/sql.png', 'logo', array('width' => '80', 'height' => '23', 'class' => 'img-responsive'));
                           ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="@if($skills->sql_server != '0') check @else uncheck @endif"></i>                        
                        {{ dropDown('sql_server', $skills->sql_server) }}
                     </div>
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/infrastructure/oracle.jpg', 'logo', array('onmouseover' => 'tooltip.pop(this, "#tip2"); getSkillData(this.id);','width' => '83', 'height' => '19', 'class' => 'img-responsive', 'id' => 'img-oracle')) }}
                        <?php
                           $core_rate[$skills->oracle][][$skills->oracle_rate] = HTML::image('resources/img/skills-map/infrastructure/oracle.jpg', 'logo', array('width' => '83', 'height' => '19', 'class' => 'img-responsive'));
                           ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="@if($skills->oracle != '0') check @else uncheck @endif"></i>
                        {{ dropDown('oracle', $skills->oracle) }}
                     </div>
                  </td>
                  <!-- end Infrastructure -->
                  <!-- start Pacing Mode -->
                  <td>
                     {{ HTML::image('resources/img/skills-map/pacing/altitude_routing.png', 'logo', array('onmouseover' => 'tooltip.pop(this, "#tip2"); getSkillData(this.id);', 'width' => '104', 'height' => '28', 'class' => 'img-responsive', 'id' => 'img-altitude_routing')) }}
                     &nbsp;&nbsp;&nbsp;&nbsp;
                     <i class="@if($skills->altitude_routing != '0') check @else uncheck @endif"></i>                     
                     {{ dropDown('altitude_routing', $skills->altitude_routing) }}
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/pacing/altitude_dialer.png', 'logo', array('onmouseover' => 'tooltip.pop(this, "#tip2"); getSkillData(this.id);', 'width' => '89', 'height' => '24', 'class' => 'img-responsive', 'id' => 'img-altitude_dialer')) }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="@if($skills->altitude_dialer != '0') check @else uncheck @endif"></i>                        
                        {{ dropDown('altitude_dialer', $skills->altitude_dialer) }}
                     </div>
                  </td>
                  <!-- end Pacing Mode -->
                  <!-- start Channels -->
                  <td>
                     {{ HTML::image('resources/img/skills-map/channels/altitude_voice.png', 'logo', array('onmouseover' => 'tooltip.pop(this, "#tip2"); getSkillData(this.id);', 'width' => '75', 'height' => '25', 'class' => 'img-responsive', 'id' => 'img-altitude_voice')) }}
                     &nbsp;&nbsp;&nbsp;
                     <i class="@if($skills->altitude_voice != '0') check @else uncheck @endif"></i>
                     {{ dropDown('altitude_voice', $skills->altitude_voice) }}
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/channels/altitude_email.png', 'logo', array('onmouseover' => 'tooltip.pop(this, "#tip2"); getSkillData(this.id);', 'width' => '67', 'height' => '21', 'class' => 'img-responsive', 'id' => 'img-altitude_email')) }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="@if($skills->altitude_email != '0') check @else uncheck @endif"></i>                        
                        {{ dropDown('altitude_email', $skills->altitude_email) }}
                     </div>
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/channels/altitude_chat.png', 'logo', array('onmouseover' => 'tooltip.pop(this, "#tip2"); getSkillData(this.id);', 'width' => '62', 'height' => '24', 'class' => 'img-responsive', 'id' => 'img-altitude_chat')) }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="@if($skills->altitude_chat != '0') check @else uncheck @endif"></i>                        
                        {{ dropDown('altitude_chat', $skills->altitude_chat) }}
                     </div>
                     <div class="pad-top" @if($version == 7) style="display: none;" @endif>                        
                        {{ HTML::image('resources/img/skills-map/channels/social.PNG', 'logo', array('onmouseover' => 'tooltip.pop(this, "#tip2"); getSkillData(this.id);', 'width' => '50', 'height' => '23', 'class' => 'img-responsive', 'id' => 'img-social')) }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="@if($skills->social != '0') check @else uncheck @endif"></i>                        
                        {{ dropDown('social', $skills->social) }}
                     </div>
                  </td>
                  <!-- end Channels -->
                  <!-- start Development -->
                  <td>
                     {{ HTML::image('resources/img/skills-map/development/altitude_desktop.png', 'logo', array('onmouseover' => 'tooltip.pop(this, "#tip2"); getSkillData(this.id);', 'width' => '87', 'height' => '23', 'class' => 'img-responsive', 'id' => 'img-altitude_desktop')) }}
                     &nbsp;&nbsp;&nbsp;
                     <i class="@if($skills->altitude_desktop != '0') check @else uncheck @endif"></i>                     
                     {{ dropDown('altitude_desktop', $skills->altitude_desktop) }}
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/development/altitude_ivr.png', 'logo', array('onmouseover' => 'tooltip.pop(this, "#tip2"); getSkillData(this.id);', 'width' => '84', 'height' => '24', 'class' => 'img-responsive', 'id' => 'img-altitude_ivr')) }}
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="@if($skills->altitude_ivr != '0') check @else uncheck @endif"></i>                        
                        {{ dropDown('altitude_ivr', $skills->altitude_ivr) }}
                     </div>
                     <div class="pad-top" @if($version == 7) style="display: none;" @endif>                        
                        {{ HTML::image('resources/img/skills-map/development/altitude_express_routing.png', 'logo', array('onmouseover' => 'tooltip.pop(this, "#tip2"); getSkillData(this.id);', 'width' => '83', 'height' => '28', 'class' => 'img-responsive', 'id' => 'img-altitude_express_routing')) }}
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="@if($skills->altitude_express_routing != '0') check @else uncheck @endif"></i>                        
                        {{ dropDown('altitude_express_routing', $skills->altitude_express_routing) }}
                     </div>
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/development/altitude_integration.png', 'logo', array('onmouseover' => 'tooltip.pop(this, "#tip2"); getSkillData(this.id);', 'width' => '67', 'height' => '24', 'class' => 'img-responsive', 'id' => 'img-altitude_integration')) }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="@if($skills->altitude_integration != '0') check @else uncheck @endif"></i>                        
                        {{ dropDown('altitude_integration', $skills->altitude_integration) }}
                     </div>
                     <div class="pad-top" @if($version == 7) style="display: none;" @endif>                        
                        {{ HTML::image('resources/img/skills-map/development/altitude_workflow.png', 'logo', array('onmouseover' => 'tooltip.pop(this, "#tip2"); getSkillData(this.id);', 'width' => '56', 'height' => '25', 'class' => 'img-responsive', 'id' => 'img-altitude_workflow')) }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="@if($skills->altitude_workflow != '0') check @else uncheck @endif"></i>                        
                        {{ dropDown('altitude_workflow', $skills->altitude_workflow) }}
                     </div>
                  </td>
                  <!-- end Development -->
                  <!-- start Installation / Patch Updgrade -->
                  <td>
                     {{ HTML::image('resources/img/skills-map/installation/uci_installation.png', 'logo', array('onmouseover' => 'tooltip.pop(this, "#tip2"); getSkillData(this.id);', 'width' => '104', 'height' => '28', 'class' => 'img-responsive', 'id' => 'img-uci_installation')) }}
                     &nbsp;&nbsp;&nbsp;&nbsp;
                     <i class="@if($skills->uci_installation != '0') check @else uncheck @endif"></i>                     
                     {{ dropDown('uci_installation', $skills->uci_installation) }}
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/installation/uci_patch.PNG', 'logo', array('onmouseover' => 'tooltip.pop(this, "#tip2"); getSkillData(this.id);', 'width' => '89', 'height' => '24', 'class' => 'img-responsive', 'id' => 'img-uci_patch')) }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="@if($skills->uci_patch != '0') check @else uncheck @endif"></i>                        
                        {{ dropDown('uci_patch', $skills->uci_patch) }}
                     </div>
                  </td>
                  <!-- end Installation / Patch Updgrade -->                        
               </tr>
            </tbody>
         </table>
      </div>
      <div class="span6">
         <div style="text-align: center; padding: 5px 0; color: #fff; background: #00649a;">
            <font size="3">Advanced Skills</font>
         </div>
         <table class="table table-striped table-bordered">
            <thead>
               <tr align="center">
                  <th> Third Party / Connectors</th>
                  <th> Training</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>
                     {{ HTML::image('resources/img/skills-map/connectors/sap.png', 'logo', array('width' => '48', 'height' => '24', 'class' => 'img-responsive')) }}
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                     
                     <i class="@if($skills->sap != '0') check @else uncheck @endif"></i>
                     {{ dropDown('sap', $skills->sap) }}
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/connectors/siebel.png', 'logo', array('width' => '77', 'height' => '19', 'class' => 'img-responsive')) }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="@if($skills->siebel != '0') check @else uncheck @endif"></i>                        
                        {{ dropDown('siebel', $skills->siebel) }}
                     </div>
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/connectors/ms_crm.png', 'logo', array('width' => '120', 'height' => '25', 'class' => 'img-responsive')) }}
                        &nbsp;&nbsp;
                        <i class="@if($skills->ms_crm != '0') check @else uncheck @endif"></i>                        
                        {{ dropDown('ms_crm', $skills->ms_crm) }}
                     </div>
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/connectors/teleopti.png', 'logo', array('width' => '64', 'height' => '22', 'class' => 'img-responsive')) }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="@if($skills->teleopti != '0') check @else uncheck @endif"></i>                        
                        {{ dropDown('teleopti', $skills->teleopti) }}
                     </div>                     
                  </td>
                  <td>
                     Supervisor
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <i class="@if($skills->supervisor != '0') check @else uncheck @endif"></i>                     
                     {{ dropDown('supervisor', $skills->supervisor) }}
                     <div class="pad-top">                        
                        Administrator
                        &nbsp;&nbsp;&nbsp;
                        <i class="@if($skills->administrator != '0') check @else uncheck @endif"></i>                        
                        {{ dropDown('administrator', $skills->administrator) }}
                     </div>
                     <div class="pad-top">                        
                        Developer
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="@if($skills->developer != '0') check @else uncheck @endif"></i>                        
                        {{ dropDown('developer', $skills->developer) }}
                     </div>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
      <div class="span6">
         <div id="voc" style="text-align: center; padding: 5px 0; color: #fff; background: #00649a;">
            <font size="3">Voice of the Customers</font>
      <span style="float: right; margin: -17px 7px 0 0;">
        {{ $colored_circle_ce }}
      </span>
         </div>
         <table class="table table-striped table-bordered">
      <thead>
               <tr align="center">
                  <th colspan="2"> <a href="#viewFeedbacksModal" data-toggle="modal">No. of Feedbacks ( {{ $no_of_feedbacks }} )</a> <span style="float: right;"><a href="#feedbackModal" data-toggle="modal"><i class="icon-large icon-plus"></i></a></span></th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>
                     <?php                    
                        $communication_avg = number_format($votc_average->communication_avg, 2);
                        $commitment_avg = number_format($votc_average->commitment_avg, 2);
                        $analysis_avg = number_format($votc_average->analysis_avg, 2);
                        $delivery_avg = number_format($votc_average->delivery_avg, 2);
                        $productivity_avg = number_format($votc_average->productivity_avg, 2);
                        $fixing_avg = number_format($votc_average->fixing_avg, 2);
                        $presentability_avg = number_format($votc_average->presentability_avg, 2);
                        $recommendation_avg = number_format($votc_average->recommendation_avg, 2);
                     ?>
                     Communication
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                     
                        <b>{{ $communication_avg }}</b>
                     <div class="pad-top">                        
                        Commitment
                        &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;                        
                        <b>{{ $commitment_avg }}</b>
                     </div>
                     <div class="pad-top">                        
                        Analysis
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                        
                        <b>{{ $analysis_avg }}</b>
                     </div>
                     <div class="pad-top">                        
                        Quality of Delivery
                        &nbsp;&nbsp;                                                
                        <b>{{ $delivery_avg }}</b>
                     </div>
                  </td>
                  <td>
                     Productivity
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                     
                     <b>{{ $productivity_avg }}</b>
                     <div class="pad-top">                        
                        Issues Fixing Quality
                        &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;                        
                        <b>{{ $fixing_avg }}</b>
                     </div>
                     <div class="pad-top">                        
                        Company Presentability
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                        
                        <b>{{ $presentability_avg }}</b>
                     </div>
                     <div class="pad-top">                        
                        Overall Recommendation
                        &nbsp;&nbsp;&nbsp;                        
                        <b>{{ $recommendation_avg }}</b>                      
                     </div>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
      <div style="clear: both;"></div>
      <div class="span6">
         <div style="text-align: center; padding: 5px 0; color: #fff; background: #00649a;">
            <font size="3"><a href="" id="a-legend" style="color: #fff;">Individual Grades <i id="zoom" class="icon-plus-sign"></i></a></font>
         </div>
         <div id="div-legend" style="display: none; padding: 5px; height: 177px; background: #FFF; overflow-y: auto;">
            <strong>INFRASTRUCTURE</strong>            
            <ul>
            <li>Altitude vBox - {{ $skills->vbox }} </li>
            <li>Alcatel Lucent - {{ $skills->alcatel }} </li>
            <li>AVAYA - {{ $skills->avaya }} </li>
            <li>CISCO - {{ $skills->cisco }} </li>
            <li>SQL Server - {{ $skills->sql_server }} </li>
            <li>ORACLE - {{ $skills->oracle }} </li>
            </ul>
            <strong>PACING MODE</strong>
            <ul>
            <li>altitude unified routing - {{ $skills->altitude_routing }} </li>
            <li>altitude unified dialer - {{ $skills->altitude_dialer }} </li>            
            </ul>
            <strong>CHANNELS</strong>
            <ul>
            <li>altitude voice - {{ $skills->altitude_voice }} </li>
            <li>altitude email - {{ $skills->altitude_email }} </li>
            <li>altitude chat - {{ $skills->altitude_chat }} </li>
            <li @if($version == 7) style="display: none;" @endif>social media - {{ $skills->social }} </li>
            </ul>
            <strong>DEVELOPMENT</strong>
            <ul>
            <li>altitude unified desktop - {{ $skills->altitude_desktop }} </li>
            <li>altitude IVR - {{ $skills->altitude_ivr }} </li>
            <li @if($version == 7) style="display: none;" @endif>altitude express routing - {{ $skills->altitude_express_routing }} </li>
            <li>altitude integration - {{ $skills->altitude_integration }} </li>
            <li @if($version == 7) style="display: none;" @endif>altitude workflow - {{ $skills->altitude_workflow }} </li>
            </ul>
            <strong>INSTALLATION / PATCH UPGRADE</strong>
            <ul>
            <li>Altitude uCI 8 New Installation - {{ $skills->uci_installation }} </li>
            <li>Altitude uCI 8 Patch update - {{ $skills->uci_patch }} </li>
            </ul>
            <strong>THIRD PARTY / CONNECTORS</strong>
            <ul>
            <li>SAP - {{ $skills->sap }} </li>
            <li>SIEBEL - {{ $skills->siebel }} </li>
            <li>Microsoft Dynamics CRM - {{ $skills->ms_crm }} </li>
            <li>TELEOPTI - {{ $skills->teleopti }} </li>
            </ul>
            <strong>TRAINING</strong>
            <ul>
            <li>Supervisor - {{ $skills->supervisor }} </li>
            <li>Administrator - {{ $skills->administrator }} </li>            
            <li>Developer - {{ $skills->developer }} </li>
            </ul>
            <strong>CUSTOMER EXPERIENCE</strong>
            <ul>
            <li>Communication - {{ $skills->communication }} </li>
            <li>Commitment - {{ $skills->commitment }} </li> 
            <li>Analysis - {{ $skills->analysis }} </li>  
            <li>Quality of Delivery - {{ $skills->quality_of_delivery }} </li>  
            <li>Productivity - {{ $skills->productivity }} </li>  
            <li>Issues Fixing Quality - {{ $skills->fixing }} </li>  
            <li>Company Presentability - {{ $skills->presentability }} </li>             
            <li>Overall Recommendation - {{ $skills->recommendation }} </li>
            </ul>
         </div>
      </div>
      <div class="span6">
         <div style="text-align: center; padding: 5px 0; color: #fff; background: #00649a;">
            <font size="3"><a href="" id="a-history" style="color: #fff;">History of Updates <i id="zoom-history" class="icon-plus-sign"></i></a></font>
         </div>
         <div id="div-history" style="display: none; padding: 5px; height: 177px; background: #FFF; overflow-y: auto;">
            <?php
               $history = array();
               //date('m d Y', strtotime($announcement->date_from))
               //INFRASTRUCTURE
               $history[$skill_history->vbox_date][] = 'Altitude vBox was updated to '. $skills->vbox.' by '.$skill_history->vbox_by;
               $history[$skill_history->alcatel_date][] = 'Alcatel Lucent was updated to '. $skills->alcatel.' by '.$skill_history->alcatel_by;
               $history[$skill_history->avaya_date][] = 'AVAYA was updated to '. $skills->avaya.' by '.$skill_history->avaya_by;
               $history[$skill_history->cisco_date][] = 'CISCO was updated to '. $skills->cisco.' by '.$skill_history->cisco_by;
               $history[$skill_history->sql_date][] = 'SQL Server was updated to '. $skills->sql_server.' by '.$skill_history->sql_server_by;
               $history[$skill_history->oracle_date][] = 'ORACLE was updated to '. $skills->oracle.' by '.$skill_history->oracle_by;
               
               //PACING MODE
               $history[$skill_history->altitude_routing_date][] = 'altitude unified routing was updated to '.$skills->altitude_routing.' by '.$skill_history->altitude_routing_by;
               $history[$skill_history->altitude_dialer_date][] = 'altitude unified dialer was updated to '.$skills->altitude_dialer.' by '.$skill_history->altitude_dialer_by;

               //CHANNELS
               $history[$skill_history->altitude_voice_date][] = 'altitude voice was updated to '.$skills->altitude_voice.' by  '.$skill_history->altitude_voice_by;
               $history[$skill_history->altitude_email_date][] = 'altitude email was updated to '.$skills->altitude_email.' by '.$skill_history->altitude_email_by;
               $history[$skill_history->altitude_chat_date][] = 'altitude chat was updated to '.$skills->altitude_chat.' by '.$skill_history->altitude_chat_by;
               $history[$skill_history->social_date][] = 'social media was updated to '.$skills->social.' by '.$skill_history->social_by;

               //DEVELOPMENT
               $history[$skill_history->altitude_desktop_date][] = 'altitude unified desktop was updated to '.$skills->altitude_desktop.' by '.$skill_history->altitude_desktop_by;
               $history[$skill_history->altitude_ivr_date][] = 'altitude IVR was updated to '.$skills->altitude_ivr.' by '.$skill_history->altitude_ivr_by;
               $history[$skill_history->altitude_express_routing_date][] = 'altitude express routing was updated to '.$skill_history->altitude_express_routing_by;
               $history[$skill_history->altitude_integration_date][] = 'altitude integration was updated to '.$skills->altitude_integration.' by '.$skill_history->altitude_integration_by;
               $history[$skill_history->altitude_workflow_date][] = 'altitude workflow was updated to '.$skills->altitude_workflow.' by '.$skill_history->altitude_workflow_by;

               //INSTALLATION / PATCH UPGRADE
               $history[$skill_history->uci_installation_date][] = 'Altitude uCI 8 New Installation was updated to '. $skills->uci_installation .' by '. $skill_history->uci_installation_by;
               $history[$skill_history->uci_patch_date][] = 'Altitude uCI 8 Patch update was updated to '. $skills->uci_patch .' by '. $skill_history->uci_patch_by;

               //THIRD PARTY / CONNECTORS
               $history[$skill_history->sap_date][] = 'SAP was updated to '. $skills->sap .' by '. $skill_history->sap_by;
               $history[$skill_history->siebel_date][] = 'SIEBEL was updated to '.$skills->siebel .' by '. $skill_history->siebel_by;
               $history[$skill_history->ms_crm_date][] = 'Microsoft Dynamics CRM was updated to '. $skills->ms_crm .' by '. $skill_history->ms_crm_by;
               $history[$skill_history->teleopti_date][] = 'TELEOPTI was updated to '. $skills->teleopti .' by '. $skill_history->teleopti_by;

               //TRAINING
               $history[$skill_history->supervisor_date][] = 'Supervisor was updated to '. $skills->supervisor .' by '. $skill_history->supervisor_by;
               $history[$skill_history->administrator_date][] = 'Administrator was updated to '. $skills->administrator .' by '. $skill_history->administrator_by;
               $history[$skill_history->developer_date][] = 'Developer was updated to '. $skills->developer .' by '. $skill_history->developer_by;

               /*
               //CUSTOMER EXPERIENCE
               $history[$skill_history->communication_date][] = 'Communication was updated to '. $skills->communication .' by '. $skill_history->communication_by;
               $history[$skill_history->commitment_date][] = 'Commitment was updated to '. $skills->commitment .' by '. $skill_history->commitment_by; 
               $history[$skill_history->analysis_date][] = 'Analysis was updated to '. $skills->analysis .' by '. $skill_history->analysis_by;  
               $history[$skill_history->quality_of_delivery_date][] = 'Quality of Delivery was updated to '. $skills->quality_of_delivery .' by '. $skill_history->quality_of_delivery_by; 
               $history[$skill_history->productivity_date][] = 'Productivity was updated to '. $skills->productivity .' by '. $skill_history->productivity_by; 
               $history[$skill_history->fixing_date][] = 'Issues Fixing Quality was updated to '. $skills->fixing .' by '. $skill_history->fixing_by;  
               $history[$skill_history->presentability_date][] = 'Company Presentability was updated to '. $skills->presentability .' by '. $skill_history->presentability_by;
               $history[$skill_history->recommendation_date][] = 'Overall Recommendation was updated to '. $skills->recommendation .' by '. $skill_history->recommendation_by;

               $history[$skill_history->status_update][] = 'Status % was updated to '. $skills->status .' by '. $skill_history->status_by;
               $history[$skill_history->status_as_of_date][] = 'Status as of was updated to '. date('m/d/Y', strtotime($skills->status_as_of)) .' by '. $skill_history->status_as_of_by;
               */
               krsort($history);   
             
               foreach($history as $key_history => $history_value):
                  $skill_histories = str_replace(':', '-',str_replace(' ', '', $key_history));                  
                  if($key_history != '0000-00-00 00:00:00') {
                        echo '<i class="icon-plus" id="i-'.$skill_histories.'"></i> <a href="#" id="'.$skill_histories.'" class="history-date" title="click me">'.date('M d, Y H:i:s', strtotime($key_history)).'</a><br>';
                     foreach($history_value as $history_values):
                        echo '<div class="'.$skill_histories.'" style="margin-left: 12px; display: none;"><i class="icon-check"></i> '.$history_values.'</div>';
                     endforeach; 
                  }
               endforeach;      
            ?>
         </div>
      </div>

      <div class="span12" style="text-align: center; padding: 5px 0;">
         {{ Form::hidden('skill_id', $skills->id ) }}
         {{ Form::hidden('id', $_GET['id'] ) }}
         <input type="submit" class="btn btn-primary" id="submitForm" style="background: #2c6b00;" value="UPDATE SKILLS MAP">
         <a href="" class="btn" style="background: #999999;">REVERT CHANGES</a>                  
      </div>
      <?php
         ksort($core_rate); 
         unset($core_rate[0]); 
         ?>      
      <?php
         #echo '<pre>';     
         #print_r($core_rate);
         ?>
      <script>      
    var val = '{{ $skills->status }}';
    var pcolor;
    
    if(val > 0 && val < 100) {
      pcolor = '#ff671c';
    } else if(val == 100) {
      pcolor = '#30CD74';
    }     
    /*
    UNCOMMENT TO SHOW PIE CHART
         $("#divProgress").circularloader({
            progressPercent: {{ $skills->status }} ,
            progressBarColor: pcolor, 
            progressBarBackground: "#CDCDCD",                
            fontSize: "24px",
            progressBarWidth: 17,
            radius: 55
         });
         */
         $("#a-legend").toggle(function() {
             $('#zoom').attr('class', 'icon-minus-sign');
             $("#div-legend").show();
           }, function() {
             $('#zoom').attr('class', 'icon-plus-sign');
             $("#div-legend").hide();
        });

         $("#a-history").toggle(function() {
             $('#zoom-history').attr('class', 'icon-minus-sign');
             $("#div-history").show();
           }, function() {
             $('#zoom-history').attr('class', 'icon-plus-sign');
             $("#div-history").hide();
        });
      </script>           
   </div>
</div>
<div class="row">
   <div class="span12">
     <table class="table table-striped">
         <tr>
            <td>
               <div id="container-core" style="min-width: 570px; max-width: 650px; height: 400px; margin: 0 auto"></div>
            </td>
            <td align="right">
               <div id="container" style="min-width: 570px; max-width: 650px; height: 400px; margin: 0 auto"></div>
            </td>
         </tr>
         <tr>
            <td colspan="2">            
               <div id="container-experience" style="min-width: 570px; max-width: 650px; height: 400px; margin: 0 auto"></div>   
            </td>
         </tr>
            <tr>
               <table>       
                  <tr><th align="left" colspan="2">Grades Definition</th></tr>
                  <tr align="left" >
                     <td>1:</td>
                     <td>Has very little practical exposure to the subject. But no hands-on experience.</td>
                  </tr>
                  <tr align="left" >
                     <td>2:</td>
                     <td>Has hands-on experience on the subject but still need to be attended by an expert to do the job.</td>
                  </tr>
                  <tr align="left" >
                     <td>3:</td>
                     <td>Can autonomously do the job but may need remote help from an expert.</td>
                  </tr>
                  <tr align="left" >
                     <td>4:</td>
                     <td>Can do the job fully autonomous.</td>
                  </tr>
                  <tr align="left" >
                     <td>5:</td>
                     <td>Can guide, help and train others to achieve a job.</td>
                  </tr>        
               </table>
            </td>         
         </tr>
     </table> 
     <div id="skillModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
          <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
          <span id="span-skill-img"></span>
        </div>
        <div class="modal-body">
          <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
          {{ HTML::script('resources/js/ddslick.js') }}     
          <table style="color: #1f49aa; font-size: 13px;" >      
            <tr>
              <td>Customer</td>
              <td>
              <br>
                <div id="myDropdown-skill"></div>
                <br>
                <input type="hidden" name="cust_id_remark" id="cust_id_remark" value="">
                <input type="hidden" name="skill_name" id="skill_name" value="">
                <input type="hidden" name="skill_rate" id="skill_rate" value="">
                <input type="hidden" name="old_skill_rate" id="old_skill_rate" value="">
                {{ Form::hidden('uid', $_GET['id'] ) }}
                <script>
                  var ddData = [
                    @foreach($customers as $cust)           
                      <?php 
                        $cust_photo = $cust->logo;
                        if($cust->logo == '') {
                          $cust_photo = 'no-photo.jpg';
                        }
                      ?>
                      {
                        text: "{{ $cust->company }}",
                        value: {{ $cust->id }},
                        selected: false,
                        //description: "Description with Facebook",
                        imageSrc: "{{ Config::get('app.url_storage') . '/company_logo/'.$cust_photo }}"
                      },
                    @endforeach
                    
                  ];
                  
                  $('#myDropdown-skill').ddslick({
                    data:ddData,
                    width:448,
                    selectText: "Select your preferred customer",
                    imagePosition:"left",
                    onSelected: function(selectedData){
                      for(var i in selectedData) {
                        if(selectedData[i].value != undefined) {
                          var cust_id = selectedData[i].value;
                          $('#cust_id_remark').val(cust_id);
                        }
                      }             
                    }   
                  });
                </script>
              </td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Remarks</td>
              <td>
                <textarea style="width: 98%;" rows="7" name="remarks" id="skill-remarks"></textarea>
              </td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <center>
          <a href="" class="btn btn-primary" id="skill-save">Save</a>
          <a href="" class="btn">Cancel</a>
          </center>
        </div>
      </div>
   {{ Form::close() }}
   </div>
</div>

<div id="feedbackModal" style="overflow-y: auto;"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3 id="myModalLabel">Feedbacks</h3>
  </div>
  <div class="modal-body">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    {{ HTML::script('resources/js/ddslick.js') }}     
    {{ Form::open(array('url'=>'admin/'.$path.'/add-feedback', 'class'=>'form-horizontal', 'autocomplete'=>'off', 'id'=>'form-feedback', 'role'=>'form', 'method' => 'post')) }}
      <table style="color: #1f49aa; font-size: 13px;" >
      <tr>
        <td>Customer:</td>
        <td>
        <br>
          <div id="myDropdown"></div>
          <br>
          <input type="hidden" name="cust_id_feedback" id="cust_id_feedback" value="">
          {{ Form::hidden('uid', $_GET['id'] ) }}
          <script>
            var ddData = [
              @foreach($customers as $cust)           
                <?php 
                  $cust_photo = $cust->logo;
                  if($cust->logo == '') {
                    $cust_photo = 'no-photo.jpg';
                  }
                ?>
                {
                  text: "{{ $cust->company }}",
                  value: {{ $cust->id }},
                  selected: false,
                  //description: "Description with Facebook",
                  imageSrc: "{{ Config::get('app.url_storage') . '/company_logo/'.$cust_photo }}"
                },
              @endforeach
              
            ];
            
            $('#myDropdown').ddslick({
              data:ddData,
              width:448,
              selectText: "Select your preferred customer",
              imagePosition:"left",
              onSelected: function(selectedData){
                for(var i in selectedData) {
                  if(selectedData[i].value != undefined) {
                    var cust_id = selectedData[i].value;
                    $('#cust_id_feedback').val(cust_id);
                  }
                }             
              }   
            });
          </script>
        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4">
          <table class="tables" width="100%" cellpadding="3">
            <tr>
              <td>
                        &nbsp;Communication
                        &nbsp;&nbsp;&nbsp;
                        <input type="number" min="0" max="5" value="0" name="f_communication" style="width: 40px;">
                     </td>
              <td align="right">
                        Productivity
                        <input type="number" min="0" max="5" value="0" name="f_productivity" style="width: 40px;">
                     </td>
            </tr>
                  <tr>                     
                     <td>
                        &nbsp;Commitment
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="number" min="0" max="5" value="0" name="f_commitment" style="width: 40px;">
                     </td>
                     <td align="right">
                        Issues Fixing Quality
                        <input type="number" min="0" max="5" value="0" name="f_fixing" style="width: 40px;">
                     </td>
                  </tr>                  
            <tr>
              <td>
                        &nbsp;Analysis
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="number" min="0" max="5" value="0" name="f_analysis" style="width: 40px;">
                     </td>              
              <td align="right">
                        Company Presentability
                        <input type="number" min="0" max="5" value="0" name="f_presentability" style="width: 40px;">
                     </td>
            </tr>
            <tr>              
              <td>
                        &nbsp;Quality of Delivery                        
                        <input type="number" min="0" max="5" value="0" name="f_delivery" style="width: 40px;">
                     </td>              
              <td align="right">
                        Overall Recommendation
                        <input type="number" min="0" max="5" value="0" name="f_recommendation" style="width: 40px;">
                     </td>
            </tr>                  
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="4" align="center"><input type="submit" id="submit-feedback" class="btn btn-primary" value="Save"> <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>  </td>
      </tr>      
      </table>
      {{ Form::close() }}
    <script>
      $('#submit-feedback').click(function(e) {
        e.preventDefault();
        
        if($('#cust_id_feedback').val() != '') {
          $('#form-feedback').submit();
        } else {
          alert('- Customer field is required.');
        }             
      });
    </script>
  </div>
</div>

<div id="viewFeedbacksModal" style="overflow-y: hidden; width: 850px;"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3 id="myModalLabel">Customer Feedback</h3>
  </div>
  <div class="modal-body">
      {{ Form::open(array('url'=>'admin/'.$path.'/update-feedback', 'class'=>'form-horizontal', 'autocomplete'=>'off', 'id'=>'form-feedback-update', 'role'=>'form', 'method' => 'post')) }}
    <table cellpadding="5" class="table-header-rotated">
      @if($customer_feedbacks)
      <thead>
         <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th class="rotate"><div><span>Communication</span></div></th>       
            <th class="rotate"><div><span>Commitment</span></div></th>
            <th class="rotate"><div><span>Analysis</span></div></th>
            <th class="rotate"><div><span>Quality of Delivery</span></div></th>
            <th class="rotate"><div><span>Productivity</span></div></th>
            <th class="rotate"><div><span>Issues Fixing Quality</span></div></th>
            <th class="rotate"><div><span>Company Presentability</span></div></th>
            <th class="rotate"><div><span>Overall Recommendation</span></div></th>
            <th class="rotate"><div><span>Created By</span></div></th>
            <th class="rotate"><div><span>Created At</span></div></th>
      </tr>
         </thead>
      @foreach($customer_feedbacks as $cust_feed)
      <?php 
        $cust_logo = $cust_feed->logo;
        $cb_feedback_del = '';
        $readonly_feedback = 'readonly';
        if($cust_feed->logo == '') {
          $cust_logo = 'no-photo.jpg';
        }

        if(Auth::user()->id == $cust_feed->admin_id) {
          $readonly_feedback = '';
          $cb_feedback_del = '<input type="checkbox" title="check to delete" class="feed-checkbox" name="selected[]" value="'.$cust_feed->id.'" />';
          //$a_delete_feedback = '<a href="" class="delete-feedback" data-id="'.$cust_feed->id.'"><i class="icon-trash"></i></a>';
        }

        $dest_logo = Config::get('app.url_storage') . '/company_logo/'.$cust_logo;
      ?>
         <tbody>
          <tr id="tr-feedback-{{ $cust_feed->id }}">
            <th class="row-header">{{ $cb_feedback_del }}</th>
            <th class="row-header">
               {{ HTML::image($dest_logo, 'logo', array('width' => '40', 'title' => $cust_feed->company, 'class' => '', 'style' => 'height: 40px !important;')) }}<br>
               <font size="1">{{ $cust_feed->company }}</font>
            </th> 
            <input type="hidden" name="id[]" value="{{ $cust_feed->id }}">
            <td class="fu-td"><input type="number" min="0" max="5" {{ $readonly_feedback }} name="fu_communication[]" value="{{ $cust_feed->communication }}" style="width: 35px;"></td>
            <td class="fu-td"><input type="number" min="0" max="5" {{ $readonly_feedback }} name="fu_commitment[]" value="{{ $cust_feed->commitment }}" style="width: 35px;"></td>
            <td class="fu-td"><input type="number" min="0" max="5" {{ $readonly_feedback }} name="fu_analysis[]" value="{{ $cust_feed->analysis }}" style="width: 35px;"></td>
            <td class="fu-td"><input type="number" min="0" max="5" {{ $readonly_feedback }} name="fu_delivery[]" value="{{ $cust_feed->delivery }}" style="width: 35px;"></td>
            <td class="fu-td"><input type="number" min="0" max="5" {{ $readonly_feedback }} name="fu_productivity[]" value="{{ $cust_feed->productivity }}" style="width: 35px;"></td>
            <td class="fu-td"><input type="number" min="0" max="5" {{ $readonly_feedback }} name="fu_fixing[]" value="{{ $cust_feed->fixing }}" style="width: 35px;"></td>
            <td class="fu-td"><input type="number" min="0" max="5" {{ $readonly_feedback }} name="fu_presentability[]" value="{{ $cust_feed->presentability }}" style="width: 35px;"></td>
            <td class="fu-td"><input type="number" min="0" max="5" {{ $readonly_feedback }} name="fu_recommendation[]" value="{{ $cust_feed->recommendation }}" style="width: 35px;"></td>
            <td class="fu-td">{{ $cust_feed->admin }}</td>
            <td class="fu-td">{{ $cust_feed->created_at }}</td>            
      </tr>
         @endforeach
         <tr>
            <td colspan="13" align="center">
               <input type="submit" id="submit-update-feedback" class="btn btn-primary" value="Update"> 
               <button class="btn" id="delete-feedback">Delete Checked</button>
            </td>
         </tr>         
         </tbody>
         @else
            <td colspan="2">** Empty Results **</td>
         @endif
    </table>
      <input type="hidden" name="uid" value="{{ $_GET['id'] }}">
      {{ Form::close() }}
      <script>
         $('#delete-feedback').click(function(e){
            e.preventDefault();    
            var count = $("[name='selected[]']:checked").length;
  
            if (count>0) {
              var items = new Array();
              var del_items = '';
              
              $("[name='selected[]']:checked").each(function() {
                items.push($(this).data('name'));
                del_items += $(this).val()+'|';
              });
              
              if(confirm('Are you sure you want to delete this customer feedback?')) {    
                var url = '{{ URL::to("admin/".$path."/delete-feedback?uid=".$_GET['id']."&id=") }}'+del_items;
                window.location.href = url;   
              }
            } else {
              alert('Please check customer row feedback to delete.');                
            }                
         });
      </script>
  </div>
</div>

<div style="display:none;">
    <div id="tip2" style="height: 420px; overflow-y: auto;">        
        <h3>Allows any HTML content</h3>
        <p>Allows any HTML content contained in the page by just passing the element ID to the tooltip.pop() command.</p>
    </div>   
    <script>
      function toggleRemarks() {        
        $("#div-remarks").toggle();      
      }  
    </script>                      
</div>
<?php
   function dropDown($name, $value) {      
      $dd_skills = '';
      $unallowed_array = array(
        'sap', 'siebel', 'ms_crm', 'teleopti', 'supervisor', 'administrator', 'developer'
      );

      if(! in_array($name, $unallowed_array)) {
        $dd_skills = 'dd-skills';
      }

      $html = '<select name="'.$name.'" style="width: 40px;" id="'.$name.'" class="'.$dd_skills.'">         
         <option value="0" '.($value == '0' ? 'selected' : '').'>0</option>
         <option value="1" '.($value == '1' ? 'selected' : '').'>1</option>
         <option value="2" '.($value == '2' ? 'selected' : '').'>2</option>
         <option value="3" '.($value == '3' ? 'selected' : '').'>3</option>
         <option value="4" '.($value == '4' ? 'selected' : '').'>4</option>
         <option value="5" '.($value == '5' ? 'selected' : '').'>5</option>         
      </select>';
      $html .= '<input type="hidden" value="'.$value.'" id="h-old-'.$name.'">';

      return $html;
   }
   
   function textBox($name, $value) {      
      $html = '<input readonly type="text" style="width: 40px;" size="5" name="'.$name.'" value="'.$value.'">';

      return $html;
   }
?>
{{ HTML::script('resources/js/html2canvas.js') }}
{{ HTML::script('resources/js/tooltip.js') }}
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<div id="container-remarks" style="display: none;"></div>
<script type="text/javascript"><!--
$(function () {
$('#container-remarks').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'Skill History Updates'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Proficiency'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'Avaya',
            data: [ 1, 3, 2, 5, 4 ]
        }]
    });
});

$(function () {
    $('#container-experience').highcharts({

        chart: {
            polar: true,
            type: 'area'
        },

        title: {
            text: 'Voice of the Customers',
            x: 0
        },

        pane: {
            size: '80%'
        },

        xAxis: {
            categories: ['Communication', 'Commitment', 'Analysis', 'Quality of Delivery', 'Productivity', 'Issues Fixing Quality', 'Company Presentability', 'Overall Recommendation'],
            tickmarkPlacement: 'on',
         //visible: false,
            lineWidth: 0
        },

        yAxis: {
            gridLineInterpolation: 'polygon',
            lineWidth: 0,
            min: 0,
      categories: [1, 2, 3, 4, 5]
        },

        tooltip: {
            shared: true
            //pointFormat: '<span style="color:{series.color}">{series.name}: <b>${point.y:,.0f}</b><br/>'
        },

        legend: {
            align: 'right',
            verticalAlign: 'top',
            y: 70,
            layout: 'vertical'
        },
        <?php
            $cust_exp = $communication_avg.', '.$commitment_avg.', '.$analysis_avg.', '.$delivery_avg.', '.
            $productivity_avg.', '.$fixing_avg.', '.$presentability_avg.', '.$recommendation_avg;   
         ?>
        series: [
           {
         showInLegend: false,
               name: 'Voice of the Customers',
               data: [{{ $cust_exp }}],
               pointPlacement: 'on'
            }
        ]

    });
});

$(function () {
    $('#container').highcharts({

        chart: {
            polar: true,
            type: 'area'
        },

        title: {
            text: 'Advance Skills',
            x: 0
        },

        pane: {
            size: '80%'
        },

        xAxis: {
            categories: ['SAP', 'SIEBEL', 'MS Dynamics CRM', 'TELEOPTI', 'Supervisor', 'Administrator', 'Developer'],
            tickmarkPlacement: 'on',
         //visible: false,
            lineWidth: 0
        },

        yAxis: {
            gridLineInterpolation: 'polygon',
            lineWidth: 0,
            min: 0,
      categories: [1, 2, 3, 4, 5]
        },

        tooltip: {
            shared: true
            //pointFormat: '<span style="color:{series.color}">{series.name}: <b>${point.y:,.0f}</b><br/>'
        },

        legend: {
            align: 'right',
            verticalAlign: 'top',
            y: 70,
            layout: 'vertical'
        },
        <?php
            $advance_skills = ($skills->sap == 'na' ? 0 : $skills->sap).', '.($skills->siebel == 'na' ? 0 : $skills->siebel).', '.($skills->ms_crm == 'na' ? 0 : $skills->ms_crm).', '.($skills->teleopti == 'na' ? 0 : $skills->teleopti).', '.($skills->supervisor == 'na' ? 0 : $skills->supervisor).', '.($skills->administrator == 'na' ? 0 : $skills->administrator).', '.($skills->developer == 'na' ? 0 : $skills->developer);
                  
      #$advance_skills = $skills->sap.', '.$skills->siebel.', '.$skills->ms_crm.', '.$skills->teleopti.', '.$skills->supervisor.', '.$skills->administrator.', '.$skills->developer;
         ?>
        series: [
           {
         showInLegend: false,
               name: 'Advance Skills',
               data: [{{ $advance_skills }}],
               pointPlacement: 'on'
            }
        ]

    });
});

$(function () {
    $('#container-core').highcharts({

        chart: {
            polar: true,
            type: 'area'
        },

        title: {
            text: 'Core Skills',
            x: 0
        },

        pane: {
            size: '80%'
        },

        xAxis: {
            categories: ['altitude vBox', 'Alcatel-Lucent', 'AVAYA', 'CISCO', 'SQL Server', 'ORACLE', 'altitude unified routing', 'altitude unified dialer', 'altitude voice', 'altitude email', 'altitude chat', 'social media', 'altitude unified desktop', 'altitude ivr', 'altitude express routing', 'altitude integration', 'altitude workflow', 'altitude uCI New Installation', 'altitude uCI Patch update'],
            tickmarkPlacement: 'on',
         //visible: false,
            lineWidth: 0
        },

        yAxis: {
            gridLineInterpolation: 'polygon',
            lineWidth: 0,
            min: 0,
      categories: [1, 2, 3, 4, 5]
        },

        tooltip: {
            shared: true
            //pointFormat: '<span style="color:{series.color}">{series.name}: <b>${point.y:,.0f}</b><br/>'
        },

        legend: {
            align: 'right',
            verticalAlign: 'top',
            y: 70,
            layout: 'vertical'
        },
        <?php            
            $core_skills = ($skills->vbox == 'na' ? 0 : $skills->vbox).', '.($skills->alcatel == 'na' ? 0 : $skills->alcatel).', '.($skills->avaya == 'na' ? 0 : $skills->avaya).', '.($skills->cisco == 'na' ? 0 : $skills->cisco).', '.($skills->sql_server == 'na' ? 0 : $skills->sql_server).', '.($skills->oracle == 'na' ? 0 : $skills->oracle);
            $core_skills .= ', '.($skills->altitude_routing == 'na' ? 0 : $skills->altitude_routing).', '.($skills->altitude_dialer == 'na' ? 0 : $skills->altitude_dialer);
            $core_skills .= ', '.($skills->altitude_voice == 'na' ? 0 : $skills->altitude_voice).', '.($skills->altitude_email == 'na' ? 0 : $skills->altitude_email).', '.($skills->altitude_chat == 'na' ? 0 : $skills->altitude_chat).', '.($skills->social == 'na' ? 0 : $skills->social);
            $core_skills .= ', '.($skills->altitude_desktop == 'na' ? 0 : $skills->altitude_desktop).', '.($skills->altitude_ivr == 'na' ? 0 : $skills->altitude_ivr).', '.($skills->altitude_express_routing == 'na' ? 0 : $skills->altitude_express_routing).', '.($skills->altitude_integration == 'na' ? 0 : $skills->altitude_integration).', '.($skills->altitude_workflow == 'na' ? 0 : $skills->altitude_workflow);
            $core_skills .= ', '.($skills->uci_installation == 'na' ? 0 : $skills->uci_installation).', '.($skills->uci_patch == 'na' ? 0 : $skills->uci_patch);          
         ?>
        series: [
           {
         showInLegend: false,
               name: 'Core Skills',
               data: [{{ $core_skills }}],
               pointPlacement: 'on'
            }
        ]

    });
});
   //$(document).ready(function() {
      // Submit Form
       $('#submitForm').click(function() {
         $('#form-skills').submit();
       });
       
       $('#form-skills input').keydown(function(e) {
         if (e.keyCode == 13) {
            $('#form-skills').submit();
         }
      });

       $('#skill-save').click(function(e) {
          e.preventDefault();
          var error = '';

          if($('#cust_id_remark').val() == '') {
            error += '- Please select customer.';
          }
          /*
          if($('#skill-remarks').val() == '') {
            error += '- Remarks is required.';
          }
          */
          if(error == '') {
            $('#form-skills').submit();
          } else {
            alert(error);
          }
       });
   //});

   $('.dd-skills').change(function() {
      var id = $(this).attr('id');
      var src = $('#img-'+id).attr('src');
      var dd_val = $(this).val();
      var h_old_rate = $('#h-old-'+id).val();

      $('#skillModal').css({ 'overflow-y': 'auto', 'display': 'block' });
      $('#skillModal').addClass('in');
      $('#span-skill-img').html('<img src="'+src+'">');
      $('#skill_name').val(id);
      $('#skill_rate').val(dd_val);
      $('#old_skill_rate').val(h_old_rate);
      $('<div class="modal-backdrop fade in" id="modal-black"></div>').insertAfter('#skillModal');      
   });

   $('.history-date').click(function(e) {
      e.preventDefault();
      var icon = $('#i-'+$(this).attr('id')).attr('class');

      if(icon == 'icon-plus') {
         $('#i-'+$(this).attr('id')).attr('class', 'icon-minus');
      } else {
         $('#i-'+$(this).attr('id')).attr('class', 'icon-plus');
      }

      $('.'+$(this).attr('id')).toggle('slow');
   });  

   function getSkillData(id) {
      var sp = id.split('-');
      $.ajax({
          url: '{{ URL::to("admin/".$path."/getSkillData") }}',
          type: 'GET',
          data: { uid: "{{ $_GET['id'] }}", skill_name : sp[1]} ,
          success: function (response) {
              var html = $('#container-remarks').html();         

              $('#tip2').html(response);
              $("#container-div-remarks").html(html);
          },
          error: function () {
              $('#tip2').html('<h5>Empty Result</h5>');
          }
      }); 
   }

   function captureCurrentDiv() {
      html2canvas([document.getElementById('main-container')], {   
         onrendered: function(canvas)  
         {
            var img = canvas.toDataURL();
            $.post("{{ URL::to('/') }}/save.php", {data: img}, function (file) {               
               window.location.href =  "{{ URL::to('/') }}/download.php?path="+ file          
            }
            );   
         }
      });
   }
   //--></script>