<?php 
   $route = Route::getCurrentRoute()->getPath(); 
   $version = 0;  
   
   if($route == 'admin/skills-map-v7/update') {
     $version = 7;    
   } else if($route == 'admin/skills-map/update') {
     $version = 8;
   }

   $color_arr = array(
      'red' => '#B6392A',
      'green' => '#1F9851',
      'yellow' => '#F6D259',
      'blue' => '#14B9D5'
   );
?>
<a href="{{ URL::to('admin/skills-map') }}" class="btn" title="Back to List"><i class="icon-arrow-left"></i></a>
<a href="#" class="btn" onclick="captureCurrentDiv();"><i class="icon-large icon-print"></i></a>
@if( $errors->all() )
<div class="alert alert-error">
   <button class="close" data-dismiss="alert" type="button">&times;</button>
   {{ HTML::ul($errors->all()) }}
</div>
@endif
<style>
   .rows {      
      font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
   }

   body {
      background: #EAEDF2;
   }

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
   padding: 0 5px;
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

   .tb-head {      
      text-align: center;  
      font-size: 15px;  
      color: #FFF; 
      background: #9FA7B4;      
   }

   .a-get-skill {
      text-decoration: none !important;
   }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
{{ HTML::style('resources/css/tipr.css') }}
{{ HTML::script('resources/js/tipr.js') }}
{{ Form::model($skillsV7, array('url'=>'admin/skills-map-v7/updateData', 'class'=>'form-horizontal', 'id'=>'form-skills-v7', 'role'=>'form', 'method' => 'post')) }}
<div class="rows">
   <div class="row" style="color: #1f49aa;">
      <div class="span12">
         <table>
            <tr>
               <td>
                  <?php
                     $pic = 'no-photo.jpg';
                     $destinationPath = Config::get('app.url_storage') . '/profile_pic/'.$pic;
                     
                     $version_img = 'resources/img/uCI_v'.$version.'_large.jpg';
                     if($version == 8) {
                      $version_img = 'resources/img/uCI_v'.$version.'_large.png';
                     }
                     ?>       
                  @if(! empty($skillsV7->profile_pic))
                  <?php $pic = $skillsV7->profile_pic; ?>
                  <?php $destinationPath = Config::get('app.url_storage') . '/profile_pic/'.$pic; ?>           
                  @endif   
                  <div style="text-align: left;">
                     {{ HTML::image($destinationPath, 'logo', array('width' => '160', 'title' => 'engineer photo', 'class' => '', 'style' => 'padding: 0; margin: 0; height: 160px !important;')) }} 
                  </div>
               </td>
               <td style="background: #FFF;">
                  <div style="padding: 0 52px 0 20px;">
                     <span id="name">
                        <h1>{{ $skillsV7->fullname }}</h1>
                     </span>
                     <p class="title" dir="ltr">{{ $company[$skillsV7->company] }}</p>
                  </div>
               </td>
            </tr>
         </table>
      </div>
      <!-- START OF V7 SKILLS MAP -->
      <!-- trap -->
         <!-- start div for V7 -->
         <div id="a-version7" class="span12" style="border-right: 20px solid {{ $color_arr[$colored_circle_csV7] }}; border-radius: 3px 3px 0px 0px; width: 95.9%; cursor: pointer; padding: 5px 0; color: #fff; background: #323A45; margin-top: 25px;">
            <div style="text-align: left; margin-left: 6px; position: absolute;">
               <i class="icon-plus" id="plus-minus-v7"></i>
            </div>
            <div style="text-align: center; text-shadow: 2px 2px 2px #000;">   
               <i class="icon-bar-chart"></i>                        
               <font size="3">uCI 7</font>        
            </div>
         </div>
      <div class="v7-wrapper">
         <div class="span12" id="v7-inner-wrapper-1">            
            <table class="table table-bordered">
               <tr class="tb-head">
                  <td style="border-right: 3px solid #EAEDF2;"> Infrastructure</td>
                  <td style="border-right: 3px solid #EAEDF2;"> Pacing Mode</td>
                  <td style="border-right: 3px solid #EAEDF2;"> Channels</td>
                  <td style="border-right: 3px solid #EAEDF2;"> Development</td>
                  <td> Contact Center Setup</td>
               </tr>        
               <tbody>
                  <tr style="background: #FFF; border: 1px solid;">
                     <!-- start Infrastructure -->
                     <td style="border-right: 3px solid #EAEDF2;">
                        <?php $core_rate = array(); ?>
                        <a id="av7-vbox" onclick="getSkillDataV7(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['vbox']) }}">{{ HTML::image('resources/img/skills-map/infrastructure/vbox.png', 'logo', array('onclick' => ' getSkillDataV7(this.id);', 'width' => '55', 'height' => '27', 'class' => 'img-responsive' , 'id' => 'img-vbox')) }}</a>
                        <?php
                           $core_rate[$skillsV7->vbox][][$skillsV7->vbox_rate] = HTML::image('resources/img/skills-map/infrastructure/vbox.jpg', 'logo', array('width' => '55', 'height' => '27', 'class' => 'img-responsive'));
                           ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                   
                        <i class="@if($skillsV7->vbox != '0') check @else uncheck @endif"></i>                     
                        {{ dropDownV7('vbox', $skillsV7->vbox) }}                    
                        <div class="pad-top">                        
                           <a id="av7-alcatel" onclick="getSkillDataV7(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['alcatel']) }}">{{ HTML::image('resources/img/skills-map/infrastructure/alcatel.png', 'logo', array('onclick' => ' getSkillDataV7(this.id);','width' => '96', 'height' => '27', 'class' => 'img-responsive', 'id' => 'img-alcatel')) }}</a>
                           <?php
                              $core_rate[$skillsV7->alcatel][][$skillsV7->alcatel_rate] = HTML::image('resources/img/skills-map/infrastructure/alcatel.jpg', 'logo', array('width' => '96', 'height' => '27', 'class' => 'img-responsive'));
                              ?>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skillsV7->alcatel != '0') check @else uncheck @endif"></i>                        
                           {{ dropDownV7('alcatel', $skillsV7->alcatel) }}
                        </div>
                        <div class="pad-top">                        
                           <a id="av7-avaya" onclick="getSkillDataV7(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['avaya']) }}">{{ HTML::image('resources/img/skills-map/infrastructure/avaya.png', 'logo', array('onclick' => ' getSkillDataV7(this.id);','width' => '53', 'height' => '17', 'class' => 'img-responsive', 'id' => 'img-avaya')) }}</a>
                           <?php
                              $core_rate[$skillsV7->avaya][][$skillsV7->avaya_rate] = HTML::image('resources/img/skills-map/infrastructure/avaya.jpg', 'logo', array('width' => '53', 'height' => '17', 'class' => 'img-responsive'));
                              ?>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skillsV7->avaya != '0') check @else uncheck @endif"></i>                        
                           {{ dropDownV7('avaya', $skillsV7->avaya) }}
                        </div>
                        <div class="pad-top">                        
                           <a id="av7-cisco" onclick="getSkillDataV7(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['cisco']) }}">{{ HTML::image('resources/img/skills-map/infrastructure/cisco.png', 'logo', array('onclick' => ' getSkillDataV7(this.id);','width' => '49', 'height' => '20', 'class' => 'img-responsive', 'id' => 'img-cisco')) }}</a>
                           <?php
                              $core_rate[$skillsV7->cisco][][$skillsV7->cisco_rate] = HTML::image('resources/img/skills-map/infrastructure/cisco.png', 'logo', array('width' => '49', 'height' => '20', 'class' => 'img-responsive'));
                              ?>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skillsV7->cisco != '0') check @else uncheck @endif"></i>                      
                           {{ dropDownV7('cisco', $skillsV7->cisco) }}
                        </div>
                        <div class="pad-top">                        
                           <a id="av7-sql_server" onclick="getSkillDataV7(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['sql_server']) }}">{{ HTML::image('resources/img/skills-map/infrastructure/sql.png', 'logo', array('onclick' => ' getSkillDataV7(this.id);','width' => '80', 'height' => '23', 'class' => 'img-responsive', 'id' => 'img-sql_server')) }}</a>
                           <?php
                              $core_rate[$skillsV7->sql_server][][$skillsV7->sql_rate] = HTML::image('resources/img/skills-map/infrastructure/sql.png', 'logo', array('width' => '80', 'height' => '23', 'class' => 'img-responsive'));
                              ?>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skillsV7->sql_server != '0') check @else uncheck @endif"></i>                        
                           {{ dropDownV7('sql_server', $skillsV7->sql_server) }}
                        </div>
                        <div class="pad-top">                        
                           <a id="av7-oracle" onclick="getSkillDataV7(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['oracle']) }}">{{ HTML::image('resources/img/skills-map/infrastructure/oracle.jpg', 'logo', array('onclick' => ' getSkillDataV7(this.id);','width' => '83', 'height' => '19', 'class' => 'img-responsive', 'id' => 'img-oracle')) }}</a>
                           <?php
                              $core_rate[$skillsV7->oracle][][$skillsV7->oracle_rate] = HTML::image('resources/img/skills-map/infrastructure/oracle.jpg', 'logo', array('width' => '83', 'height' => '19', 'class' => 'img-responsive'));
                              ?>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skillsV7->oracle != '0') check @else uncheck @endif"></i>
                           {{ dropDownV7('oracle', $skillsV7->oracle) }}
                        </div>
                     </td>
                     <!-- end Infrastructure -->
                     <!-- start Pacing Mode -->
                     <td style="border-right: 3px solid #EAEDF2;">
                        <a id="av7-altitude_routing" onclick="getSkillDataV7(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['altitude_routing']) }}">{{ HTML::image('resources/img/skills-map/pacing/altitude_routing.png', 'logo', array('onclick' => ' getSkillDataV7(this.id);', 'width' => '104', 'height' => '28', 'class' => 'img-responsive', 'id' => 'img-altitude_routing')) }}</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="@if($skillsV7->altitude_routing != '0') check @else uncheck @endif"></i>                     
                        {{ dropDownV7('altitude_routing', $skillsV7->altitude_routing) }}
                        <div class="pad-top">                        
                           <a id="av7-altitude_dialer" onclick="getSkillDataV7(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['altitude_dialer']) }}">{{ HTML::image('resources/img/skills-map/pacing/altitude_dialer.png', 'logo', array('onclick' => ' getSkillDataV7(this.id);', 'width' => '89', 'height' => '24', 'class' => 'img-responsive', 'id' => 'img-altitude_dialer')) }}</a>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skillsV7->altitude_dialer != '0') check @else uncheck @endif"></i>                        
                           {{ dropDownV7('altitude_dialer', $skillsV7->altitude_dialer) }}
                        </div>
                     </td>
                     <!-- end Pacing Mode -->
                     <!-- start Channels -->
                     <td style="border-right: 3px solid #EAEDF2;">
                        <a id="av7-altitude_voice" onclick="getSkillDataV7(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['altitude_voice']) }}">{{ HTML::image('resources/img/skills-map/channels/altitude_voice.png', 'logo', array('onclick' => ' getSkillDataV7(this.id);', 'width' => '75', 'height' => '25', 'class' => 'img-responsive', 'id' => 'img-altitude_voice')) }}</a>
                        &nbsp;&nbsp;&nbsp;
                        <i class="@if($skillsV7->altitude_voice != '0') check @else uncheck @endif"></i>
                        {{ dropDownV7('altitude_voice', $skillsV7->altitude_voice) }}
                        <div class="pad-top">                        
                           <a id="av7-altitude_email" onclick="getSkillDataV7(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['altitude_email']) }}">{{ HTML::image('resources/img/skills-map/channels/altitude_email.png', 'logo', array('onclick' => ' getSkillDataV7(this.id);', 'width' => '67', 'height' => '21', 'class' => 'img-responsive', 'id' => 'img-altitude_email')) }}</a>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skillsV7->altitude_email != '0') check @else uncheck @endif"></i>                        
                           {{ dropDownV7('altitude_email', $skillsV7->altitude_email) }}
                        </div>
                        <div class="pad-top">                        
                           <a id="av7-altitude_chat" onclick="getSkillDataV7(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['altitude_chat']) }}">{{ HTML::image('resources/img/skills-map/channels/altitude_chat.png', 'logo', array('onclick' => ' getSkillDataV7(this.id);', 'width' => '62', 'height' => '24', 'class' => 'img-responsive', 'id' => 'img-altitude_chat')) }}</a>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skillsV7->altitude_chat != '0') check @else uncheck @endif"></i>                        
                           {{ dropDownV7('altitude_chat', $skillsV7->altitude_chat) }}
                        </div>
                     </td>
                     <!-- end Channels -->
                     <!-- start Development -->
                     <td style="border-right: 3px solid #EAEDF2;">
                        <a id="av7-altitude_desktop" onclick="getSkillDataV7(this.id);" href="#skillDataModal" data-toggle="modal" class="tipd a-get-skill" data-tip="{{ html_entity_decode($skill_desc['altitude_desktop']) }}">{{ HTML::image('resources/img/skills-map/development/altitude_desktop.png', 'logo', array('onclick' => ' getSkillDataV7(this.id);', 'width' => '87', 'height' => '23', 'class' => 'img-responsive', 'id' => 'img-altitude_desktop')) }}</a>
                        &nbsp;&nbsp;&nbsp;
                        <i class="@if($skillsV7->altitude_desktop != '0') check @else uncheck @endif"></i>                     
                        {{ dropDownV7('altitude_desktop', $skillsV7->altitude_desktop) }}
                        <div class="pad-top">                        
                           <a id="av7-altitude_ivr" onclick="getSkillDataV7(this.id);" href="#skillDataModal" data-toggle="modal" class="tipd a-get-skill" data-tip="{{ html_entity_decode($skill_desc['altitude_ivr']) }}">{{ HTML::image('resources/img/skills-map/development/altitude_ivr.png', 'logo', array('onclick' => ' getSkillDataV7(this.id);', 'width' => '84', 'height' => '24', 'class' => 'img-responsive', 'id' => 'img-altitude_ivr')) }}</a>
                           &nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skillsV7->altitude_ivr != '0') check @else uncheck @endif"></i>                        
                           {{ dropDownV7('altitude_ivr', $skillsV7->altitude_ivr) }}
                        </div>
                        <div class="pad-top">                        
                           <a id="av7-altitude_integration" onclick="getSkillDataV7(this.id);" href="#skillDataModal" data-toggle="modal" class="tipd a-get-skill" data-tip="{{ html_entity_decode($skill_desc['altitude_integration']) }}">{{ HTML::image('resources/img/skills-map/development/altitude_integration.png', 'logo', array('onclick' => ' getSkillDataV7(this.id);', 'width' => '67', 'height' => '24', 'class' => 'img-responsive', 'id' => 'img-altitude_integration')) }}</a>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skillsV7->altitude_integration != '0') check @else uncheck @endif"></i>                        
                           {{ dropDownV7('altitude_integration', $skillsV7->altitude_integration) }}
                        </div>
                     </td>
                     <!-- end Development -->
                     <!-- start Installation / Patch Updgrade -->
                     <td>
                        <a id="av7-uci_installation" onclick="getSkillDataV7(this.id);" href="#skillDataModal" data-toggle="modal" class="tipd a-get-skill" data-tip="{{ html_entity_decode($skill_desc['uci_installation']) }}">{{ HTML::image('resources/img/skills-map/installation/uci_installation.png', 'logo', array('onclick' => ' getSkillDataV7(this.id);', 'width' => '104', 'height' => '28', 'class' => 'img-responsive', 'id' => 'img-uci_installation')) }}</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="@if($skillsV7->uci_installation != '0') check @else uncheck @endif"></i>                     
                        {{ dropDownV7('uci_installation', $skillsV7->uci_installation) }}
                        <div class="pad-top">                        
                           <a id="av7-uci_patch" onclick="getSkillDataV7(this.id);" href="#skillDataModal" data-toggle="modal" class="tipd a-get-skill" data-tip="{{ html_entity_decode($skill_desc['uci_patch']) }}">{{ HTML::image('resources/img/skills-map/installation/uci_patch.PNG', 'logo', array('onclick' => ' getSkillDataV7(this.id);', 'width' => '89', 'height' => '24', 'class' => 'img-responsive', 'id' => 'img-uci_patch')) }}</a>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skillsV7->uci_patch != '0') check @else uncheck @endif"></i>                        
                           {{ dropDownV7('uci_patch', $skillsV7->uci_patch) }}
                        </div>
                     </td>
                     <!-- end Installation / Patch Updgrade -->                        
                  </tr>
               </tbody>
            </table>
         </div>
         <div class="span12" id="v7-inner-wrapper-2">
            <!--<div style="border-radius: 3px 3px 0px 0px; text-align: center; padding: 5px 0; color: #fff; background: #323A45;">
               <font size="3">Advanced Skills</font>
            </div>-->
            <table class="table table-bordered">  
               <tr class="tb-head">
                  <td style="width: 25%; border-right: 3px solid #EAEDF2;"> Third Party / Connectors</td>
                  <td style="width: 25%; border-right: 3px solid #EAEDF2;"> Training</td>
                  <td> Customers</td>                  
               </tr>    
               <tbody>
                  <tr style="background: #FFF;">
                     <td style="border-right: 3px solid #EAEDF2;">
                        <a id="av7-sap" onclick="getSkillDataV7(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['sap']) }}">{{ HTML::image('resources/img/skills-map/connectors/sap.png', 'logo', array('onclick' => ' getSkillDataV7(this.id);', 'width' => '48', 'height' => '24', 'class' => 'img-responsive', 'id' => 'img-sap')) }}</a>                     
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                     
                        <i class="@if($skillsV7->sap != '0') check @else uncheck @endif"></i>
                        {{ dropDownV7('sap', $skillsV7->sap) }}
                        <div class="pad-top">                        
                           <a id="av7-siebel" onclick="getSkillDataV7(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['siebel']) }}">{{ HTML::image('resources/img/skills-map/connectors/siebel.png', 'logo', array('onclick' => ' getSkillDataV7(this.id);', 'width' => '77', 'height' => '19', 'class' => 'img-responsive', 'id' => 'img-siebel')) }}</a>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skillsV7->siebel != '0') check @else uncheck @endif"></i>                        
                           {{ dropDownV7('siebel', $skillsV7->siebel) }}
                        </div>
                        <div class="pad-top">                        
                           <a id="av7-ms_crm" onclick="getSkillDataV7(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['ms_crm']) }}">{{ HTML::image('resources/img/skills-map/connectors/ms_crm.png', 'logo', array('onclick' => ' getSkillDataV7(this.id);', 'width' => '120', 'height' => '25', 'class' => 'img-responsive', 'id' => 'img-ms_crm')) }}</a>  
                           &nbsp;&nbsp;
                           <i class="@if($skillsV7->ms_crm != '0') check @else uncheck @endif"></i>                        
                           {{ dropDownV7('ms_crm', $skillsV7->ms_crm) }}
                        </div>
                        <div class="pad-top">                        
                           <a id="av7-teleopti" onclick="getSkillDataV7(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['teleopti']) }}">{{ HTML::image('resources/img/skills-map/connectors/teleopti.png', 'logo', array('onclick' => ' getSkillDataV7(this.id);', 'width' => '64', 'height' => '22', 'class' => 'img-responsive', 'id' => 'img-teleopti')) }}</a>  
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skillsV7->teleopti != '0') check @else uncheck @endif"></i>                        
                           {{ dropDownV7('teleopti', $skillsV7->teleopti) }}
                        </div>
                     </td>
                     <td style="border-right: 3px solid #EAEDF2;">                        
                        <a id="av7-supervisor" onclick="getSkillDataV7(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['supervisor']) }}">
                           Supervisor
                        </a>                       
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="@if($skillsV7->supervisor != '0') check @else uncheck @endif"></i>
                        {{ dropDownV7('supervisor', $skillsV7->supervisor) }}
                        <div class="pad-top">                                                   
                           <a id="av7-administrator" onclick="getSkillDataV7(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['administrator']) }}">
                              Administrator
                           </a>
                           &nbsp;&nbsp;&nbsp;
                           <i class="@if($skillsV7->administrator != '0') check @else uncheck @endif"></i>                        
                           {{ dropDownV7('administrator', $skillsV7->administrator) }}
                        </div>
                        <div class="pad-top">  
                           <a id="av7-developer" onclick="getSkillDataV7(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['developer']) }}">
                              Developer
                           </a>                                                 
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skillsV7->developer != '0') check @else uncheck @endif"></i>                        
                           {{ dropDownV7('developer', $skillsV7->developer) }}
                        </div>
                     </td>
                     <td colspan="2">
                        <table class="table table-bordered">                                   
                           <tbody>
                              @if($allEngrCustomersV7)
                              <tr>
                                 <td style="background: #FFF;">
                                    <div style="padding: 7px; text-align: center; overflow-y: auto;">
                                       @foreach($allEngrCustomersV7 as $engr_cust)
                                       <?php
                                          $cust_logo = $engr_cust->logo;
                                          if($engr_cust->logo == '') {
                                           $cust_logo = 'no-photo.jpg';
                                          }
                                          
                                          $img_logo_src = Config::get('app.url_storage') . '/company_logo/'.$cust_logo;
                                          ?>
                                       <div style="height: 100px; background: #ffffff; float: left; margin: 6px;">
                                          <img class="img-responsive" src="{{ $img_logo_src }}" width="60" alt="customer logo" title="{{ $engr_cust->company }}">
                                       </div>
                                       @endforeach
                                    </div>
                                 </td>
                              </tr>
                              @else
                              <tr>
                                 <td style="background: #FFF;">
                                    <div style="height: 126px;"></div>
                                 </td>
                              <tr>
                              @endif
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>         
      </div>
      <!--
      <div class="span6 v7-wrapper">
         <div id="voc-v7" style="text-align: center; padding: 5px 0; color: #fff; background: #9FA7B4;">
            <font size="3">Customers</font> 
         </div>
         <div style="max-height: 177px; overflow-y: auto;">
            <table class="table table-bordered">                                   
               <tbody>
                  @if($allEngrCustomersV7)
                  <tr>
                     <td colspan="2" style="background: #FFF;">
                        <div style="padding: 7px; text-align: center; overflow-y: auto;">
                           @foreach($allEngrCustomersV7 as $engr_cust)
                           <?php
                              $cust_logo = $engr_cust->logo;
                              if($engr_cust->logo == '') {
                               $cust_logo = 'no-photo.jpg';
                              }
                              
                              $img_logo_src = Config::get('app.url_storage') . '/company_logo/'.$cust_logo;
                              ?>
                           <div style="height: 100px; background: #ffffff; float: left; margin: 6px;">
                              <img class="img-responsive" src="{{ $img_logo_src }}" width="90" alt="customer logo" title="{{ $engr_cust->company }}">
                           </div>
                           @endforeach
                        </div>
                     </td>
                  </tr>
                  @else
                  <tr>
                     <td colspan="2" style="background: #FFF;">
                        <div style="height: 126px;"></div>
                     </td>
                  <tr>
                  @endif
               </tbody>
            </table>
         </div>
      </div>
      -->
      <div class="v7-wrapper">
         <div class="span12x" style="text-align: center;">
            {{ Form::hidden('skill_id', $skillsV7->id ) }}
            {{ Form::hidden('id', $_GET['id'] ) }}
            <input type="hidden" name="cust_id_remarkV7" id="cust_id_remarkV7" value="">
            <input type="hidden" name="skill_nameV7" id="skill_nameV7" value="">
            <input type="hidden" name="skill_rateV7" id="skill_rateV7" value="">
            <input type="hidden" name="old_skill_rateV7" id="old_skill_rateV7" value="">
            <input type="hidden" name="remarksV7" id="remarksV7" value="">
            <!--<input type="submit" class="btn btn-primary" id="" style="background: #2c6b00;" value="UPDATE SKILLS MAP V7">
            <a href="" class="btn" style="background: #999999;">REVERT CHANGES</a>-->                  
            {{ Form::close() }}
         </div>
      </div>
      <div class="v7-wrapper">
         <div class="span12">
            <table class="tables" width="100%">
               <tr class="tb-head" style="padding: 5px 0;">                  
                  <td style="padding: 5px 0; border-right: 3px solid #EAEDF2;" class=""> Core Skills</td>
                  <td style="" class=""> Advanced Skills</td>                 
               </tr>
               <tr>                  
                  <td style="background: #fff; border-right: 3px solid #EAEDF2;">
                     <div id="container-coreV7" style="min-width: 570px; max-width: 650px; height: 400px; margin: 0 auto"></div>
                  </td>
                  <td>
                     <div id="containerV7" style="background: #fff;  min-width: 570px; max-width: 650px; height: 400px; margin: 0 auto"></div>
                  </td>                  
               </tr>
            </table>
         </div>
      </div>
      <!-- end div for V7 -->
      <!--END OF V7 SKILLS MAP-->
         {{ Form::model($skills, array('url'=>'admin/skills-map/updateData', 'class'=>'form-horizontal', 'id'=>'form-skills', 'role'=>'form', 'method' => 'post')) }}
         <!--start wrapper v8 -->
         <div class="span12">&nbsp;</div>
         <div id="a-version8" class="span12" style="border-right: 20px solid {{ $color_arr[$colored_circle_cs] }}; border-radius: 3px 3px 0px 0px; width: 95.9%; cursor: pointer; padding: 5px 0; color: #fff; background: #323A45; margin-top: 6px;">
            <div style="text-align: left; margin-left: 6px; position: absolute;">
               <i class="icon-plus" id="plus-minus-v8"></i>
            </div>
            <div style="text-align: center; text-shadow: 2px 2px 2px #000;">            
            <center>   
               <i class="icon-bar-chart"></i>             
               <font size="3">uCI 8</font>               
            </center>
         </div>
      </div>
      <div class="v8-wrapper">
         <div class="span12">
            <table class="table table-bordered">               
               <tr class="tb-head">
                  <td style="border-right: 3px solid #EAEDF2;"> Infrastructure</td>
                  <td style="border-right: 3px solid #EAEDF2;"> Pacing Mode</td>
                  <td style="border-right: 3px solid #EAEDF2;"> Channels</td>
                  <td style="border-right: 3px solid #EAEDF2;"> Development</td>
                  <td> Contact Center Setup</td>
               </tr>               
               <tbody>
                  <tr style="background: #FFF;">
                     <!-- start Infrastructure -->
                     <td style="border-right: 3px solid #EAEDF2;">
                        <?php $core_rate = array(); ?>    
                        <a id="a-vbox" data-tip="{{ html_entity_decode($skill_desc['vbox']) }}" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill">                    
                        {{ HTML::image('resources/img/skills-map/infrastructure/vbox.png', 'logo', array('onclick' => ' getSkillData(this.id);', 'width' => '55', 'height' => '27', 'class' => 'img-responsive', 'id' => 'img-vbox')) }}
                        </a>
                        <?php
                           $core_rate[$skills->vbox][][$skills->vbox_rate] = HTML::image('resources/img/skills-map/infrastructure/vbox.jpg', 'logo', array('width' => '55', 'height' => '27', 'class' => 'img-responsive'));
                        ?>              
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                   
                        <i class="@if($skills->vbox != '0') check @else uncheck @endif"></i>                     
                        {{ dropDown('vbox', $skills->vbox) }}                    
                        <div class="pad-top">                                              
                           <a id="a-alcatel" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['alcatel']) }}">{{ HTML::image('resources/img/skills-map/infrastructure/alcatel.png', 'logo', array('onclick' => ' getSkillData(this.id);','width' => '96', 'height' => '27', 'class' => 'img-responsive', 'id' => 'img-alcatel')) }}</a>                        
                           <?php
                              $core_rate[$skills->alcatel][][$skills->alcatel_rate] = HTML::image('resources/img/skills-map/infrastructure/alcatel.jpg', 'logo', array('width' => '96', 'height' => '27', 'class' => 'img-responsive'));
                              ?>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skills->alcatel != '0') check @else uncheck @endif"></i>                        
                           {{ dropDown('alcatel', $skills->alcatel) }}
                        </div>
                        <div class="pad-top">                        
                           <a id="a-avaya" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['avaya']) }}">{{ HTML::image('resources/img/skills-map/infrastructure/avaya.png', 'logo', array('onclick' => ' getSkillData(this.id);','width' => '53', 'height' => '17', 'class' => 'img-responsive', 'id' => 'img-avaya')) }}</a>
                           <?php
                              $core_rate[$skills->avaya][][$skills->avaya_rate] = HTML::image('resources/img/skills-map/infrastructure/avaya.jpg', 'logo', array('width' => '53', 'height' => '17', 'class' => 'img-responsive'));
                              ?>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skills->avaya != '0') check @else uncheck @endif"></i>                        
                           {{ dropDown('avaya', $skills->avaya) }}
                        </div>
                        <div class="pad-top">                        
                           <a id="a-cisco" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['cisco']) }}">{{ HTML::image('resources/img/skills-map/infrastructure/cisco.png', 'logo', array('onclick' => ' getSkillData(this.id);','width' => '49', 'height' => '20', 'class' => 'img-responsive', 'id' => 'img-cisco')) }}</a>
                           <?php
                              $core_rate[$skills->cisco][][$skills->cisco_rate] = HTML::image('resources/img/skills-map/infrastructure/cisco.png', 'logo', array('width' => '49', 'height' => '20', 'class' => 'img-responsive'));
                              ?>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skills->cisco != '0') check @else uncheck @endif"></i>                      
                           {{ dropDown('cisco', $skills->cisco) }}
                        </div>
                        <div class="pad-top">                        
                           <a id="a-sql_server" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill"  data-tip="{{ html_entity_decode($skill_desc['sql_server']) }}">{{ HTML::image('resources/img/skills-map/infrastructure/sql.png', 'logo', array('onclick' => ' getSkillData(this.id);','width' => '80', 'height' => '23', 'class' => 'img-responsive', 'id' => 'img-sql_server')) }}</a>
                           <?php
                              $core_rate[$skills->sql_server][][$skills->sql_rate] = HTML::image('resources/img/skills-map/infrastructure/sql.png', 'logo', array('width' => '80', 'height' => '23', 'class' => 'img-responsive'));
                              ?>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skills->sql_server != '0') check @else uncheck @endif"></i>                        
                           {{ dropDown('sql_server', $skills->sql_server) }}
                        </div>
                        <div class="pad-top">                        
                           <a id="a-oracle" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill"  data-tip="{{ html_entity_decode($skill_desc['oracle']) }}">{{ HTML::image('resources/img/skills-map/infrastructure/oracle.jpg', 'logo', array('onclick' => ' getSkillData(this.id);','width' => '83', 'height' => '19', 'class' => 'img-responsive', 'id' => 'img-oracle')) }}</a>
                           <?php
                              $core_rate[$skills->oracle][][$skills->oracle_rate] = HTML::image('resources/img/skills-map/infrastructure/oracle.jpg', 'logo', array('width' => '83', 'height' => '19', 'class' => 'img-responsive'));
                              ?>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skills->oracle != '0') check @else uncheck @endif"></i>
                           {{ dropDown('oracle', $skills->oracle) }}
                        </div>
                     </td>
                     <!-- end Infrastructure -->
                     <!-- start Pacing Mode -->
                     <td style="border-right: 3px solid #EAEDF2;">
                        <a id="a-altitude_routing" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill"  data-tip="{{ html_entity_decode($skill_desc['altitude_routing']) }}">{{ HTML::image('resources/img/skills-map/pacing/altitude_routing.png', 'logo', array('onclick' => ' getSkillData(this.id);', 'width' => '104', 'height' => '28', 'class' => 'img-responsive', 'id' => 'img-altitude_routing')) }}</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="@if($skills->altitude_routing != '0') check @else uncheck @endif"></i>                     
                        {{ dropDown('altitude_routing', $skills->altitude_routing) }}
                        <div class="pad-top">                        
                           <a id="a-altitude_dialer" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill"  data-tip="{{ html_entity_decode($skill_desc['altitude_dialer']) }}">{{ HTML::image('resources/img/skills-map/pacing/altitude_dialer.png', 'logo', array('onclick' => ' getSkillData(this.id);', 'width' => '89', 'height' => '24', 'class' => 'img-responsive', 'id' => 'img-altitude_dialer')) }}</a>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skills->altitude_dialer != '0') check @else uncheck @endif"></i>                        
                           {{ dropDown('altitude_dialer', $skills->altitude_dialer) }}
                        </div>
                     </td>
                     <!-- end Pacing Mode -->
                     <!-- start Channels -->
                     <td style="border-right: 3px solid #EAEDF2;">
                        <a id="a-altitude_voice" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['altitude_voice']) }}">{{ HTML::image('resources/img/skills-map/channels/altitude_voice.png', 'logo', array('onclick' => ' getSkillData(this.id);', 'width' => '75', 'height' => '25', 'class' => 'img-responsive', 'id' => 'img-altitude_voice')) }}</a>
                        &nbsp;&nbsp;&nbsp;
                        <i class="@if($skills->altitude_voice != '0') check @else uncheck @endif"></i>
                        {{ dropDown('altitude_voice', $skills->altitude_voice) }}
                        <div class="pad-top">                        
                           <a id="a-altitude_email" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['altitude_email']) }}">{{ HTML::image('resources/img/skills-map/channels/altitude_email.png', 'logo', array('onclick' => ' getSkillData(this.id);', 'width' => '67', 'height' => '21', 'class' => 'img-responsive', 'id' => 'img-altitude_email')) }}</a>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skills->altitude_email != '0') check @else uncheck @endif"></i>                        
                           {{ dropDown('altitude_email', $skills->altitude_email) }}
                        </div>
                        <div class="pad-top">                        
                           <a id="a-altitude_chat" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['altitude_chat']) }}">{{ HTML::image('resources/img/skills-map/channels/altitude_chat.png', 'logo', array('onclick' => ' getSkillData(this.id);', 'width' => '62', 'height' => '24', 'class' => 'img-responsive', 'id' => 'img-altitude_chat')) }}</a>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skills->altitude_chat != '0') check @else uncheck @endif"></i>                        
                           {{ dropDown('altitude_chat', $skills->altitude_chat) }}
                        </div>
                        <div class="pad-top">                        
                           <a id="a-social" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['social']) }}">{{ HTML::image('resources/img/skills-map/channels/social.PNG', 'logo', array('onclick' => ' getSkillData(this.id);', 'width' => '50', 'height' => '23', 'class' => 'img-responsive', 'id' => 'img-social')) }}</a>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skills->social != '0') check @else uncheck @endif"></i>                        
                           {{ dropDown('social', $skills->social) }}
                        </div>
                     </td>
                     <!-- end Channels -->
                     <!-- start Development -->
                     <td style="border-right: 3px solid #EAEDF2;">
                        <a id="a-altitude_desktop" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tipd a-get-skill" data-tip="{{ html_entity_decode($skill_desc['altitude_desktop']) }}">{{ HTML::image('resources/img/skills-map/development/altitude_desktop.png', 'logo', array('onclick' => ' getSkillData(this.id);', 'width' => '87', 'height' => '23', 'class' => 'img-responsive', 'id' => 'img-altitude_desktop')) }}</a>
                        &nbsp;&nbsp;&nbsp;
                        <i class="@if($skills->altitude_desktop != '0') check @else uncheck @endif"></i>                     
                        {{ dropDown('altitude_desktop', $skills->altitude_desktop) }}
                        <div class="pad-top">                        
                           <a id="a-altitude_ivr" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tipd a-get-skill" data-tip="{{ html_entity_decode($skill_desc['altitude_ivr']) }}">{{ HTML::image('resources/img/skills-map/development/altitude_ivr.png', 'logo', array('onclick' => ' getSkillData(this.id);', 'width' => '84', 'height' => '24', 'class' => 'img-responsive', 'id' => 'img-altitude_ivr')) }}</a>
                           &nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skills->altitude_ivr != '0') check @else uncheck @endif"></i>                        
                           {{ dropDown('altitude_ivr', $skills->altitude_ivr) }}
                        </div>
                        <div class="pad-top">                        
                           <a id="a-altitude_express_routing" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tipd a-get-skill" data-tip="{{ html_entity_decode($skill_desc['altitude_express_routing']) }}">{{ HTML::image('resources/img/skills-map/development/altitude_express_routing.png', 'logo', array('onclick' => ' getSkillData(this.id);', 'width' => '83', 'height' => '28', 'class' => 'img-responsive', 'id' => 'img-altitude_express_routing')) }}</a>
                           &nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skills->altitude_express_routing != '0') check @else uncheck @endif"></i>                        
                           {{ dropDown('altitude_express_routing', $skills->altitude_express_routing) }}
                        </div>
                        <div class="pad-top">                        
                           <a id="a-altitude_integration" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tipd a-get-skill" data-tip="{{ html_entity_decode($skill_desc['altitude_integration']) }}">{{ HTML::image('resources/img/skills-map/development/altitude_integration.png', 'logo', array('onclick' => ' getSkillData(this.id);', 'width' => '67', 'height' => '24', 'class' => 'img-responsive', 'id' => 'img-altitude_integration')) }}</a>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skills->altitude_integration != '0') check @else uncheck @endif"></i>                        
                           {{ dropDown('altitude_integration', $skills->altitude_integration) }}
                        </div>
                        <div class="pad-top">                        
                           <a id="a-altitude_workflow" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tipd a-get-skill" data-tip="{{ html_entity_decode($skill_desc['altitude_workflow']) }}">{{ HTML::image('resources/img/skills-map/development/altitude_workflow.png', 'logo', array('onclick' => ' getSkillData(this.id);', 'width' => '56', 'height' => '25', 'class' => 'img-responsive', 'id' => 'img-altitude_workflow')) }}</a>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skills->altitude_workflow != '0') check @else uncheck @endif"></i>                        
                           {{ dropDown('altitude_workflow', $skills->altitude_workflow) }}
                        </div>
                     </td>
                     <!-- end Development -->
                     <!-- start Installation / Patch Updgrade -->
                     <td>
                        <a id="a-uci_installation" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tipd a-get-skill" data-tip="{{ html_entity_decode($skill_desc['uci_installation']) }}">{{ HTML::image('resources/img/skills-map/installation/uci_installation.png', 'logo', array('onclick' => ' getSkillData(this.id);', 'width' => '104', 'height' => '28', 'class' => 'img-responsive', 'id' => 'img-uci_installation')) }}</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="@if($skills->uci_installation != '0') check @else uncheck @endif"></i>                     
                        {{ dropDown('uci_installation', $skills->uci_installation) }}
                        <div class="pad-top">                        
                           <a id="a-uci_patch" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tipd a-get-skill" data-tip="{{ html_entity_decode($skill_desc['uci_patch']) }}">{{ HTML::image('resources/img/skills-map/installation/uci_patch.PNG', 'logo', array('onclick' => ' getSkillData(this.id);', 'width' => '89', 'height' => '24', 'class' => 'img-responsive', 'id' => 'img-uci_patch')) }}</a>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skills->uci_patch != '0') check @else uncheck @endif"></i>                        
                           {{ dropDown('uci_patch', $skills->uci_patch) }}
                        </div>

                        <div class="pad-top">                        
                           <a id="a-reporting_framework" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tipd a-get-skill" data-tip="{{ html_entity_decode($skill_desc['reporting_framework']) }}">{{ HTML::image('resources/img/skills-map/installation/reporting_framework.png', 'logo', array('onclick' => ' getSkillData(this.id);', 'width' => '70', 'height' => '24', 'class' => 'img-responsive', 'id' => 'img-reporting_framework')) }}</a>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skills->reporting_framework != '0') check @else uncheck @endif"></i>                        
                           {{ dropDown('reporting_framework', $skills->reporting_framework) }}
                        </div>                           
                     </td>
                     <!-- end Installation / Patch Updgrade -->                        
                  </tr>
               </tbody>
            </table>
         </div>
         <div class="span12 v8-wrapper">
            <!--<div style="border-radius: 3px 3px 0px 0px; text-align: center; padding: 5px 0; color: #fff; background: #323A45;">
               <font size="3">Advanced Skills</font>
            </div>-->
            <table class="table table-bordered">               
               <tr class="tb-head">
                  <td style="border-right: 3px solid #EAEDF2;"> Quality / Operation</td>
                  <td style="border-right: 3px solid #EAEDF2;"> Connectors</td>
                  <td style="border-right: 3px solid #EAEDF2;"> OTCS</td>
                  <td> Training</td>
               </tr>               
               <tbody>
                  <tr style="background: #FFF;">
                     <td style="border-right: 3px solid #EAEDF2;">                                                
                        <div class="pad-top">                        
                           <a id="a-strategy_manager" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['strategy_manager']) }}">{{ HTML::image('resources/img/skills-map/connectors/strategy_manager.png', 'logo', array('onclick' => ' getSkillData(this.id);', 'width' => '70', 'height' => '24', 'class' => 'img-responsive', 'id' => 'img-strategy_manager')) }}</a>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skills->strategy_manager != '0') check @else uncheck @endif"></i>                        
                           {{ dropDown('strategy_manager', $skills->strategy_manager) }}
                        </div>
                        <div class="pad-top">                        
                           <a id="a-enterprise_recorder" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['enterprise_recorder']) }}">{{ HTML::image('resources/img/skills-map/connectors/enterprise_recorder.png', 'logo', array('onclick' => ' getSkillData(this.id);', 'width' => '75', 'height' => '24', 'class' => 'img-responsive', 'id' => 'img-enterprise_recorder')) }}</a>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skills->enterprise_recorder != '0') check @else uncheck @endif"></i>                        
                           {{ dropDown('enterprise_recorder', $skills->enterprise_recorder) }}
                        </div>
                        <div class="pad-top">                        
                           <a id="a-mobile_dashboard" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['mobile_dashboard']) }}">{{ HTML::image('resources/img/skills-map/connectors/mobile_dashboard.png', 'logo', array('onclick' => ' getSkillData(this.id);', 'width' => '87', 'height' => '22', 'class' => 'img-responsive', 'id' => 'img-mobile_dashboard')) }}</a>  
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skills->mobile_dashboard != '0') check @else uncheck @endif"></i>                        
                           {{ dropDown('mobile_dashboard', $skills->mobile_dashboard) }}                           
                        </div>
                     </td>
                     <td style="border-right: 3px solid #EAEDF2;">
                        <a id="a-sap" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['sap']) }}">{{ HTML::image('resources/img/skills-map/connectors/sap.png', 'logo', array('onclick' => ' getSkillData(this.id);', 'width' => '48', 'height' => '24', 'class' => 'img-responsive', 'id' => 'img-sap')) }}</a>                     
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                     
                        <i class="@if($skills->sap != '0') check @else uncheck @endif"></i>
                        {{ dropDown('sap', $skills->sap) }}
                        <div class="pad-top">                        
                           <a id="a-siebel" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['siebel']) }}">{{ HTML::image('resources/img/skills-map/connectors/siebel.png', 'logo', array('onclick' => ' getSkillData(this.id);', 'width' => '77', 'height' => '19', 'class' => 'img-responsive', 'id' => 'img-siebel')) }}</a>  
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skills->siebel != '0') check @else uncheck @endif"></i>                        
                           {{ dropDown('siebel', $skills->siebel) }}
                        </div>
                        <div class="pad-top">                        
                           <a id="a-ms_crm" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['ms_crm']) }}">{{ HTML::image('resources/img/skills-map/connectors/ms_crm.png', 'logo', array('onclick' => ' getSkillData(this.id);', 'width' => '120', 'height' => '25', 'class' => 'img-responsive', 'id' => 'img-ms_crm')) }}</a>  
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skills->ms_crm != '0') check @else uncheck @endif"></i>                        
                           {{ dropDown('ms_crm', $skills->ms_crm) }}
                        </div>
                        <div class="pad-top">                        
                           <a id="a-teleopti" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tip a-get-skill" data-tip="{{ html_entity_decode($skill_desc['teleopti']) }}">{{ HTML::image('resources/img/skills-map/connectors/teleopti.png', 'logo', array('onclick' => ' getSkillData(this.id);', 'width' => '64', 'height' => '22', 'class' => 'img-responsive', 'id' => 'img-teleopti')) }}</a>  
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skills->teleopti != '0') check @else uncheck @endif"></i>                        
                           {{ dropDown('teleopti', $skills->teleopti) }}
                        </div>
                     </td>
                     <td style="border-right: 3px solid #EAEDF2;">
                        <div class="pad-top">                        
                           <a id="a-otcs" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tipd a-get-skill" data-tip="{{ html_entity_decode($skill_desc['otcs']) }}">{{ HTML::image('resources/img/skills-map/connectors/otcs.png', 'logo', array('onclick' => ' getSkillData(this.id);', 'width' => '55', 'height' => '24', 'class' => 'img-responsive', 'id' => 'img-otcs')) }}</a>
                           &nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skills->otcs != '0') check @else uncheck @endif"></i>                        
                           {{ dropDown('otcs', $skills->otcs) }}
                        </div>
                     </td>
                     <td style="border-right: 3px solid #EAEDF2;">                        
                           <a id="a-supervisor" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tipd a-get-skill" data-tip="{{ html_entity_decode($skill_desc['supervisor']) }}">
                              Supervisor
                           </a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="@if($skills->supervisor != '0') check @else uncheck @endif"></i>                     
                        {{ dropDown('supervisor', $skills->supervisor) }}
                        <div class="pad-top">                                                   
                           <a id="a-administrator" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tipd a-get-skill" data-tip="{{ html_entity_decode($skill_desc['administrator']) }}">
                              Administrator
                           </a>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skills->administrator != '0') check @else uncheck @endif"></i>                        
                           {{ dropDown('administrator', $skills->administrator) }}
                        </div>
                        <div class="pad-top">                                                   
                           <a id="a-developer" onclick="getSkillData(this.id);" href="#skillDataModal" data-toggle="modal" class="tipd a-get-skill" data-tip="{{ html_entity_decode($skill_desc['developer']) }}">
                              Developer
                           </a>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <i class="@if($skills->developer != '0') check @else uncheck @endif"></i>                        
                           {{ dropDown('developer', $skills->developer) }}
                        </div>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
      <div class="span12 v8-wrapper">
         <div id="voc" style="text-align: center; padding: 5px 0; color: #fff; background: #9FA7B4;">
            <font size="3">Customers</font> 
         </div>
         <div style="background: #FFF;" id="v8-engr-customers">
            @if($allEngrCustomers)                   
               @foreach($allEngrCustomers as $engr_cust)
               <?php
                  $cust_logo = $engr_cust->logo;
                  if($engr_cust->logo == '') {
                   $cust_logo = 'no-photo.jpg';
                  }
                  
                  $img_logo_src = Config::get('app.url_storage') . '/company_logo/'.$cust_logo;
                  ?>                  
                  <img style="padding: 8px;" class="img-responsive" src="{{ $img_logo_src }}" width="60" alt="customer logo" title="{{ $engr_cust->company }}">                  
               @endforeach  
            @else
               <div style="height: 85px;">&nbsp;</div>                                       
            @endif
         </div>
      </div>
      <!--end wrapper v8 -->
      <div style="clear: both;"></div>
      <div class="span12 v8-wrapper" style="text-align: center; padding: 2px 0;">
         {{ Form::hidden('skill_id', $skills->id ) }}
         {{ Form::hidden('id', $_GET['id'] ) }}
         <!--<input type="submit" class="btn btn-primary" id="submitForm" style="background: #2c6b00;" value="UPDATE SKILLS MAP V8">
         <a href="" class="btn" style="background: #999999;">REVERT CHANGES</a>-->
      </div>
      <div class="v8-wrapper">
         <div class="span12">
            <table class="tables" width="100%">
               <tr class="tb-head" style="padding: 5px 0;">                  
                  <td style="padding: 5px 0; border-right: 3px solid #EAEDF2;" class=""> Core Skills</td>
                  <td style="" class=""> Advanced Skills</td>                 
               </tr>
               <tr>
                  <td style="background: #fff; border-right: 3px solid #EAEDF2;">
                     <div id="container-core" style="min-width: 570px; max-width: 650px; height: 400px; margin: 0 auto"></div>
                  </td>
                  <td>
                     <div id="container" style="background: #fff; min-width: 570px; max-width: 650px; height: 400px; margin: 0 auto"></div>
                  </td>
               </tr>
            </table>
         </div>
      </div>
      <div class="span12">&nbsp;</div>
      <div id="a-voc" class="span12" style="border-right: 20px solid {{ $color_arr[$colored_circle_ce] }}; border-radius: 3px 3px 0px 0px; width: 95.9%; cursor: pointer; padding: 5px 0; color: #fff; background: #323A45; margin-top: 6px;">
            <div style="text-align: left; margin-left: 6px; position: absolute;">
               <i class="icon-plus" id="plus-minus-voc"></i>
            </div>
            <div style="text-align: center; text-shadow: 2px 2px 2px #000;">            
            <center>                        
               <font size="3">Voice of the Customer</font>               
            </center>
         </div>
      </div>
      <style>
         .arrow-up {
           width: 0; 
            height: 0; 
            border-left: 7px solid transparent;
            border-right: 7px solid transparent;
            
            border-top: 7px solid #000;
         }
      </style>
      <div class="span12 wrapper-voc">     
            <table class="table" style="background: #FFF;" height="400">
               <thead>
                  <tr align="center" style="background: #9FA7B4;">
                     <th colspan="2"> <a href="#viewFeedbacksModal" style="color: #FFF;" data-toggle="modal">No. of Feedbacks ( <span id="span-no-feedback">{{ $no_of_feedbacks }}</span> )</a> <span style="float: right;"><a href="#feedbackModal" style="color: #FFF;" data-toggle="modal"><i class="icon-large icon-plus"></i></a></span></th>                     
                  </tr>
               </thead>
               <tbody>
                  <tr id="tr-feedback">
                     <td style="border-right: 3px solid #EAEDF2;">
                        <?php                    
                           $communication_avg = (float) number_format($votc_average->communication_avg, 2);
                           $commitment_avg = (float) number_format($votc_average->commitment_avg, 2);
                           $analysis_avg = (float) number_format($votc_average->analysis_avg, 2);
                           $delivery_avg = (float) number_format($votc_average->delivery_avg, 2);
                           $productivity_avg = (float) number_format($votc_average->productivity_avg, 2);
                           $fixing_avg = (float) number_format($votc_average->fixing_avg, 2);
                           $presentability_avg = (float) number_format($votc_average->presentability_avg, 2);
                           $recommendation_avg = (float) number_format($votc_average->recommendation_avg, 2);
                        ?>
                        <table id="tbl-feedback">
                           <tr>
                              <td>Communication</td>
                              <td>                                 
                                 {{ createPipeLine($communication_avg, 'communication') }}                                                                                        
                              </td>                              
                           </tr>
                           <tr>
                              <td>Commitment</td>
                              <td>                                 
                                 {{ createPipeLine($commitment_avg, 'commitment') }}                                                                                    
                              </td>
                           </tr>
                           <tr>
                              <td>Analysis</td>
                              <td>                                 
                                 {{ createPipeLine($analysis_avg, 'analysis') }}                                                                                       
                              </td>
                           </tr>                           
                           <tr>
                              <td>Quality of Delivery</td>
                              <td>                                 
                                 {{ createPipeLine($delivery_avg, 'quality') }}                                                                                          
                              </td>
                           </tr>
                           <tr>
                              <td>Productivity</td>
                              <td>                                 
                                 {{ createPipeLine($productivity_avg, 'productivity') }}                                                                                                 
                              </td>
                           </tr>
                           <tr>
                              <td>Issues Fixing Quality</td>
                              <td>                                 
                                 {{ createPipeLine($fixing_avg, 'issue') }}                                                                                         
                              </td>
                           </tr>
                           <tr>
                              <td>Company Presentability</td>
                              <td>                                 
                                 {{ createPipeLine($presentability_avg, 'presentability') }}                                                                                           
                              </td>
                           </tr>                 
                           <tr>
                              <td>Overall Recommendation</td>
                              <td>                                 
                                 {{ createPipeLine($recommendation_avg, 'recommendation') }}                                                                                                
                              </td>
                           </tr>                        
                        </table>                                                
                     </td>
                     <td align="center">
                        <div id="container-experience" style="min-width: 570px; max-width: 650px; height: 400px; margin: 0 auto"></div>
                     </td>
                  </tr>
               </tbody>
            </table>
      </div>
      <div class="span12 wrapper-voc">
         <div id="voc" style="border-radius: 3px 3px 0px 0px; text-align: center; padding: 5px 0; color: #fff; background: #9FA7B4;">
            <font size="3">Customers</font> 
         </div>
            <div style="background: #FFF;" id="voc-engr-customers">
                  @if($customer_feedback_logo)                   
               @foreach($customer_feedback_logo as $engr_voc_cust)
               <?php
                  $cust_logo = $engr_voc_cust->logo;
                  if($engr_voc_cust->logo == '') {
                   $cust_logo = 'no-photo.jpg';
                  }
                  
                  $img_logo_src = Config::get('app.url_storage') . '/company_logo/'.$cust_logo;
                  ?>                  
                  <img style="padding: 8px;" class="img-responsive" src="{{ $img_logo_src }}" width="60" alt="customer logo" title="{{ $engr_voc_cust->company }}">                  
               @endforeach  
            @else
               <div style="height: 85px;">&nbsp;</div>                                       
            @endif                 
         </div>
      </div> 
      <div id="scroll-voc"></div>
      <?php
         function createPipeLine($value, $id) {
            $html = '';            

            $html .= '
                     <input id="" data-id="'.$id.'" disabled class="fb-range" type="range" min="0" max="5" step="any" value="'.$value.'" style="padding: 1px 0; width: 346px; border: 0; background: #fff;">
                     <span id="fb-range-'.$id.'"><b>'.$value.'</b></span>
                     <div style="width: 350px; height: 10px;">
                        <div style="float: left; width: 206px; height: 5px; background: #B6392A;"></div>                        
                        <div style="float: left; width: 67px; height: 5px; background: #1F9851;"></div>                        
                        <div style="float: left; width: 32px; height: 5px; background: #F6D259;"></div>
                        <div style="float: left; width: 41px; height: 5px; background: #14B9D5;"></div>                        
                     </div>

                     <div style="width: 350px; height: 10px; font-size: 9px;">
                        <div style="float: left; width: 204px; height: 5px; background: #FFF;">0</div>                        
                        <div style="float: left; width: 65px; height: 5px; background: #FFF;">3</div>                        
                        <div style="float: left; width: 30px; height: 5px; background: #FFF;">4</div>
                        <div style="float: left; width: 48px; height: 5px; background: #FFF;">
                           <div style="float: left;">4.5</div>
                           <div style="float: right;">&nbsp;&nbsp;&nbsp;&nbsp;5</div>
                        </div>                                                
                     </div>
                  ';

            return $html;        
         }

         ksort($core_rate); 
         unset($core_rate[0]); 
      ?>      
      <script>      
         //start small tooltip for description
         $('.tip').tipr();
         $('.tipd').tipd();
         ////end small tooltip for description

         //START: Slider Control
         $('.fb-range').change(function() {
            var id = $(this).attr('data-id');
            var v = $(this).val();

            $('#fb-range-'+id).html('<b>'+v.substr(0, 4)+'</b>');
         });
         //END: Slider Control

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
      <div class="row">
         <div class="span12">
            <table>
               <tr>
                  <th align="left" colspan="2">Grades Definition</th>
               </tr>
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
         </div>
      </div>
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
               <input type="hidden" value="" id="hidden-skill">
               <a href="" class="btn btn-primary" id="skill-save">Save</a>
               <a id="cancel-skillModal" class="btn">Cancel</a>
            </center>
         </div>
      </div>
      {{ Form::close() }}
   </div>
</div>
<div id="feedbackModal" style="overflow-y: auto;"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-header">
      <button type="button" data-dismiss="modal" aria-hidden="true" class="close" onclick="document.getElementById('form-feedback').reset();">&times;</button>
      <h3 id="myModalLabel">Feedbacks</h3>
   </div>
   <div class="modal-body">
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
      {{ HTML::script('resources/js/ddslick.js') }}     
      {{ Form::open(array('url'=>'admin/skills-map/add-feedback', 'class'=>'form-horizontal', 'autocomplete'=>'off', 'id'=>'form-feedback', 'role'=>'form', 'method' => 'post')) }}
      <table style="color: #1f49aa; font-size: 13px;" >
         <tr>
            <td>Customer</td>
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
            <td><font size="1"><a href="" id="ft-remarks"><i class="icon-small icon-plus"> Remarks</a></font></td>
            <td>
               <div id="div-f-remarks" style="display: none;">
                  <textarea name="feedback_remarks" id="feedback-remarks" rows="6" style="width: 98%;"></textarea>
               </div>
            </td>
            <td>&nbsp;</td>
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
                        <input type="number" step="any" min="0" max="5" value="0" name="f_communication" style="width: 40px;">
                     </td>
                     <td align="right">
                        Productivity
                        <input type="number" step="any" min="0" max="5" value="0" name="f_productivity" style="width: 40px;">
                     </td>
                  </tr>
                  <tr>
                     <td>
                        &nbsp;Commitment
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="number" step="any" min="0" max="5" value="0" name="f_commitment" style="width: 40px;">
                     </td>
                     <td align="right">
                        Issues Fixing Quality
                        <input type="number" step="any" min="0" max="5" value="0" name="f_fixing" style="width: 40px;">
                     </td>
                  </tr>
                  <tr>
                     <td>
                        &nbsp;Analysis
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="number" step="any" min="0" max="5" value="0" name="f_analysis" style="width: 40px;">
                     </td>
                     <td align="right">
                        Company Presentability
                        <input type="number" step="any" min="0" max="5" value="0" name="f_presentability" style="width: 40px;">
                     </td>
                  </tr>
                  <tr>
                     <td>
                        &nbsp;Quality of Delivery                        
                        <input type="number" step="any" min="0" max="5" value="0" name="f_delivery" style="width: 40px;">
                     </td>
                     <td align="right">
                        Overall Recommendation
                        <input type="number" step="any" min="0" max="5" value="0" name="f_recommendation" style="width: 40px;">
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td colspan="4" align="center"><input type="submit" id="submit-feedback" style="background: #2c6b00;" class="btn btn-primary" value="Save"> <a data-dismiss="modal" aria-hidden="true" class="btn" onclick="document.getElementById('form-feedback').reset();">Cancel</a>  </td>
         </tr>
      </table>
      {{ Form::close() }}
      <script>
         $('#ft-remarks').click(function(e){
           e.preventDefault();
           var div_remarks = $('#div-f-remarks').is(':hidden');
           
           if(div_remarks) {
             $(this).html('<i class="icon-small icon-minus"> Remarks');          
             $("#div-f-remarks").show();
           } else {
             $(this).html('<i class="icon-small icon-plus"> Remarks');           
             $('#feedback-remarks').val('');
             $("#div-f-remarks").hide();
           }
         });
         
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
<div id="viewFeedbacksModal" style="left: 30%; overflow-y: hidden; width: 1100px;"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-header">
      <button type="button" data-dismiss="modal" aria-hidden="true" class="close" aria-hidden="true">&times;</button>
      <h3 id="myModalLabel">Customer Feedback</h3>
   </div>
   <div class="modal-body">
      <div id="feedback-msg" style="color: #1db200; font-weight: bold;"></div>
      {{ Form::open(array('url'=>'admin/skills-map/update-feedback', 'class'=>'form-horizontal', 'autocomplete'=>'off', 'id'=>'form-feedback-update', 'role'=>'form', 'method' => 'post')) }}
      <table cellpadding="3" class="table-header-rotated">
         @if($customer_feedbacks)
         <thead>
            <tr>
               <th>&nbsp;</th>
               <th class="rotate">
                  <div><span>Communication</span></div>
               </th>
               <th class="rotate">
                  <div><span>Commitment</span></div>
               </th>
               <th class="rotate">
                  <div><span>Analysis</span></div>
               </th>
               <th class="rotate">
                  <div><span>Quality of Delivery</span></div>
               </th>
               <th class="rotate">
                  <div><span>Productivity</span></div>
               </th>
               <th class="rotate">
                  <div><span>Issues Fixing Quality</span></div>
               </th>
               <th class="rotate">
                  <div><span>Company Presentability</span></div>
               </th>
               <th class="rotate">
                  <div><span>Overall Recommendation</span></div>
               </th>
               <th class="rotate">
                  <div><span>Created By</span></div>
               </th>
               <th class="rotate">
                  <div><span>Remarks</span></div>
               </th>
               <th class="rotate">
                  <div><span>Created At</span></div>
               </th>
               <th class="rotate">&nbsp;</th>
            </tr>
         </thead>
         @foreach($customer_feedbacks as $cust_feed)
         <?php 
            $cust_logo = $cust_feed->logo;
            
            if($cust_feed->logo == '') {
              $cust_logo = 'no-photo.jpg';
            }
            
            #$cb_feedback_del = '<input type="checkbox" title="check to delete" class="feed-checkbox" name="selected[]" value="'.$cust_feed->id.'" />';
            $a_delete_feedback = '<a href="" class="delete-feedback" data-id="'.$cust_feed->id.'"><i class="icon-trash"></i></a>';
            
            $dest_logo = Config::get('app.url_storage') . '/company_logo/'.$cust_logo;
            ?>
         <tbody>
            <tr id="tr-feedback-{{ $cust_feed->id }}">
               <th class="row-header">
                  {{ HTML::image($dest_logo, 'logo', array('width' => '40', 'title' => $cust_feed->company, 'class' => '', 'style' => 'height: 40px !important;')) }}<br>
                  <font size="1">{{ $cust_feed->company }}</font>
               </th>
               <input type="hidden" name="id[]" value="{{ $cust_feed->id }}">
               <td class="fu-td"><input type="number" step="any" min="0" max="5" name="fu_communication[]" value="{{ $cust_feed->communication }}" style="width: 50px;"></td>
               <td class="fu-td"><input type="number" step="any" min="0" max="5" name="fu_commitment[]" value="{{ $cust_feed->commitment }}" style="width: 50px;"></td>
               <td class="fu-td"><input type="number" step="any" min="0" max="5" name="fu_analysis[]" value="{{ $cust_feed->analysis }}" style="width: 50px;"></td>
               <td class="fu-td"><input type="number" step="any" min="0" max="5" name="fu_delivery[]" value="{{ $cust_feed->delivery }}" style="width: 50px;"></td>
               <td class="fu-td"><input type="number" step="any" min="0" max="5" name="fu_productivity[]" value="{{ $cust_feed->productivity }}" style="width: 50px;"></td>
               <td class="fu-td"><input type="number" step="any" min="0" max="5" name="fu_fixing[]" value="{{ $cust_feed->fixing }}" style="width: 50px;"></td>
               <td class="fu-td"><input type="number" step="any" min="0" max="5" name="fu_presentability[]" value="{{ $cust_feed->presentability }}" style="width: 50px;"></td>
               <td class="fu-td"><input type="number" step="any" min="0" max="5" name="fu_recommendation[]" value="{{ $cust_feed->recommendation }}" style="width: 50px;"></td>
               <td class="fu-td">{{ $cust_feed->admin }}</td>
               <td class="fu-td">{{ nl2br($cust_feed->remarks) }}</td>
               <td class="fu-td">{{ $cust_feed->created_at }}</td>
               <td class="fu-td">{{ $a_delete_feedback }}</td>
            </tr>
            @endforeach
            <tr>
               <td colspan="13" align="center">
                  <input type="submit" id="submit-update-feedback" style="background: #2c6b00;" class="btn btn-primary" value="Save"> 
                  <button data-dismiss="modal" aria-hidden="true" id="btn-fb-cancel" class="btn">Cancel</button>
               </td>
            </tr>
         </tbody>
         @else
         <td colspan="2">** Empty Results **</td>
         @endif
      </table>
      <input type="hidden" name="uid" value="{{ $_GET['id'] }}">
      <input type="hidden" name="del-feedback" id="del-feedback" value="">
      {{ Form::close() }}
      <script>
         $('.delete-feedback').click(function(e){
            e.preventDefault();    
            var id = $(this).attr('data-id');
            
            if(confirm('Are you sure you want to permanently delete this feedback?')) {
               $.ajax({
                   url: '{{ URL::to("admin/skills-map/delete-feedback") }}',
                   type: 'GET',
                   data: { id: id, uid: {{ $_GET['id'] }} },
                   success: function (response) {
                        var sp = response.split('|');                        
                        var num = {{ (int) $no_of_feedbacks }} - 1;                       
                        var c = sp[0];  
                                             
                        window.location.reload();// = '{{ URL::to("admin/skills-map/update?show=voc&id=".$_GET["id"]."#scroll-voc") }}';
                        /*
                        $('#span-no-feedback').text(num);

                        //$('#a-voc').css('border-right', '20px solid violet');               
                        $('#tbl-feedback').html(sp[1]);
                        $('#feedback-msg').text('Successfully deleted feedback!');
                        */
                   },
                   error: function () {
                       alert('Failed to delete.');
                   }
               });
               $('#tr-feedback-'+id).remove();
            }
         });

         $('#btn-fb-cancel').click(function(e) {
            e.preventDefault();

            $('#feedback-msg').text('');
         });
      </script>
   </div>
</div>
<div id="skillDataModal" class="modal hide fade" style="left: 30%; overflow-y: auto; width: 80%;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">   
   <button type="button" data-dismiss="modal" aria-hidden="true" class="close" aria-hidden="true">&times;</button>      
   <div class="modal-body" id="skillDataBody"></div>
   <div class="modal-footer">
      <center>               
         <button data-dismiss="modal" aria-hidden="true" class="btn">Cancel</button>
      </center>
   </div>
</div>
<div style="display:none;">
   <div id="tip2" style="height: 420px; overflow-y: auto;">
      <h3>Allows any HTML content</h3>
      <p>Allows any HTML content contained in the page by just passing the element ID to the tooltip.pop() command.</p>
   </div>   
   <script>
      function toggleRemarks() {            
        var div_hidden = $('#div-remarks').is(':hidden');;
        
        if(div_hidden) {
          $('#span-history').html('<i class="icon-large icon-minus" title="hide history"></i>');
          $("#div-remarks").show();
        } else {
          $('#span-history').html('<i class="icon-large icon-plus" title="show history"></i>');
          $("#div-remarks").hide();
        }
      }  
      
      function deleteSkillProficiency(id) { 
        if(confirm('Are you sure you want to delete this skill history?')) {
           $.ajax({
                url: '{{ URL::to("admin/skills-map/deleteSkill") }}',
                type: 'GET',
                data: { uid : {{ $_GET["id"] }}, id: id } ,
                success: function (response) {                            
                    $('#tr'+id).remove();                               
                },
                error: function () {
                    alert('Failed to delete.');
                }
            });               
            //window.location.href = '{{ URL::to("admin/skills-map/deleteSkill?uid=".$_GET["id"]."&id=") }}'+id;
         }                
      }

      function deleteSkillProficiencyV7(id) {
        if(confirm('Are you sure you want to delete this skill history?')) {
           $.ajax({
                url: '{{ URL::to("admin/skills-map-v7/deleteSkill") }}',
                type: 'GET',
                data: { uid : {{ $_GET["id"] }}, id: id },
                success: function (response) {                 
                    $('#tr-skill-'+id).remove();                               
                },
                error: function () {
                    alert('Failed to delete.');
                }
            });                           
         }        
        //window.location.href = '{{ URL::to("admin/skills-map-v7/deleteSkill?uid=".$_GET["id"]."&id=") }}'+id;
      }
   </script>                      
</div>
<?php
   function dropDown($name, $value) {      
      $dd_skills = '';
      $unallowed_array = array(
        #'supervisor', 'administrator', 'developer'
      );
   
      if(! in_array($name, $unallowed_array)) {
        $dd_skills = 'dd-skills';
      }
   
      $html = '<select name="'.$name.'" style="width: 40px;" id="'.$name.'" data-name="v8" class="'.$dd_skills.'">         
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
   
   function dropDownV7($name, $value) {      
      $dd_skills = '';
      $unallowed_array = array(
        #'supervisor', 'administrator', 'developer'
      );
   
      if(! in_array($name, $unallowed_array)) {
        $dd_skills = 'dd-skills';
      }
   
      $html = '<select name="'.$name.'" style="width: 40px;" id="'.$name.'" data-name="v7" class="'.$dd_skills.'">         
         <option value="0" '.($value == '0' ? 'selected' : '').'>0</option>
         <option value="1" '.($value == '1' ? 'selected' : '').'>1</option>
         <option value="2" '.($value == '2' ? 'selected' : '').'>2</option>
         <option value="3" '.($value == '3' ? 'selected' : '').'>3</option>
         <option value="4" '.($value == '4' ? 'selected' : '').'>4</option>
         <option value="5" '.($value == '5' ? 'selected' : '').'>5</option>         
      </select>';
      $html .= '<input type="hidden" value="'.$value.'" id="h-oldV7-'.$name.'">';
   
      return $html;
   }
   
   function textBox($name, $value) {      
      $html = '<input readonly type="text" style="width: 40px;" size="5" name="'.$name.'" value="'.$value.'">';
   
      return $html;
   }
   ?>
{{ HTML::script('resources/js/html2canvas.js') }}
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript"><!--
   $(function () {
       $('#containerV7').highcharts({
   
           chart: {
               polar: true,
               type: 'area'
           },
   
           title: {
               text: '',
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
               max: 6,
               categories: [0, 1, 2, 3, 4, 5]
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
      $advance_skills = ($skillsV7->sap == 'na' ? 0 : $skillsV7->sap).', '.($skillsV7->siebel == 'na' ? 0 : $skillsV7->siebel).', '.($skillsV7->ms_crm == 'na' ? 0 : $skillsV7->ms_crm).', '.($skillsV7->teleopti == 'na' ? 0 : $skillsV7->teleopti).', '.($skillsV7->supervisor == 'na' ? 0 : $skillsV7->supervisor).', '.($skillsV7->administrator == 'na' ? 0 : $skillsV7->administrator).', '.($skillsV7->developer == 'na' ? 0 : $skillsV7->developer);
            
      #$advance_skills = $skillsV7->sap.', '.$skillsV7->siebel.', '.$skillsV7->ms_crm.', '.$skillsV7->teleopti.', '.$skillsV7->supervisor.', '.$skillsV7->administrator.', '.$skillsV7->developer;
      ?>
           series: [
              {
            showInLegend: false,
                  name: 'Advanced Skills',
                  data: [{{ $advance_skills }}],
                  pointPlacement: 'on'
               }
           ]
   
       });
   });
   
   $(function () {
       $('#container-coreV7').highcharts({
   
           chart: {
               polar: true,
               type: 'area'
           },
   
           title: {
               text: '',
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
               max: 6,
               categories: [0, 1, 2, 3, 4, 5]
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
            $core_skills = ($skillsV7->vbox == 'na' ? 0 : $skillsV7->vbox).', '.($skillsV7->alcatel == 'na' ? 0 : $skillsV7->alcatel).', '.($skillsV7->avaya == 'na' ? 0 : $skillsV7->avaya).', '.($skillsV7->cisco == 'na' ? 0 : $skillsV7->cisco).', '.($skillsV7->sql_server == 'na' ? 0 : $skillsV7->sql_server).', '.($skillsV7->oracle == 'na' ? 0 : $skillsV7->oracle);
            $core_skills .= ', '.($skillsV7->altitude_routing == 'na' ? 0 : $skillsV7->altitude_routing).', '.($skillsV7->altitude_dialer == 'na' ? 0 : $skillsV7->altitude_dialer);
            $core_skills .= ', '.($skillsV7->altitude_voice == 'na' ? 0 : $skillsV7->altitude_voice).', '.($skillsV7->altitude_email == 'na' ? 0 : $skillsV7->altitude_email).', '.($skillsV7->altitude_chat == 'na' ? 0 : $skillsV7->altitude_chat).', '.($skillsV7->social == 'na' ? 0 : $skillsV7->social);
            $core_skills .= ', '.($skillsV7->altitude_desktop == 'na' ? 0 : $skillsV7->altitude_desktop).', '.($skillsV7->altitude_ivr == 'na' ? 0 : $skillsV7->altitude_ivr).', '.($skillsV7->altitude_express_routing == 'na' ? 0 : $skillsV7->altitude_express_routing).', '.($skillsV7->altitude_integration == 'na' ? 0 : $skillsV7->altitude_integration).', '.($skillsV7->altitude_workflow == 'na' ? 0 : $skillsV7->altitude_workflow);
            $core_skills .= ', '.($skillsV7->uci_installation == 'na' ? 0 : $skillsV7->uci_installation).', '.($skillsV7->uci_patch == 'na' ? 0 : $skillsV7->uci_patch);          
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
   
   $(function () {
       $('#container-experience').highcharts({
   
           chart: {
               polar: true,
               type: 'area'
           },
   
           title: {
               text: 'Voice of the Customer',
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
               max: 6,
               categories: [0, 1, 2, 3, 4, 5]
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
                  name: 'Voice of the Customer',
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
               text: '',
               x: 0
           },
   
           pane: {
               size: '80%'
           },
   
           xAxis: {
               categories: ['SAP', 'SIEBEL', 'MS Dynamics CRM', 'TELEOPTI', 'Mobile Dashboard', 'Strategy Manager', 'Altitude Enterprise Recorder', 'OTCS', 'Supervisor', 'Administrator', 'Developer'],
               tickmarkPlacement: 'on',
            //visible: false,
               lineWidth: 0
           },
   
           yAxis: {
               gridLineInterpolation: 'polygon',
               lineWidth: 0,
               min: 0,
               max: 6,
               categories: [0, 1, 2, 3, 4, 5]
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
      $advance_skills = ($skills->sap == 'na' ? 0 : $skills->sap).', '.($skills->siebel == 'na' ? 0 : $skills->siebel).', '.($skills->ms_crm == 'na' ? 0 : $skills->ms_crm).', '.($skills->teleopti == 'na' ? 0 : $skills->teleopti).', ';
      $advance_skills .= ($skills->mobile_dashboard == 'na' ? 0 : $skills->mobile_dashboard).', '.($skills->strategy_manager == 'na' ? 0 : $skills->strategy_manager).', '.($skills->enterprise_recorder == 'na' ? 0 : $skills->enterprise_recorder).', '.($skills->otcs == 'na' ? 0 : $skills->otcs).', ';
      $advance_skills .= ($skills->supervisor == 'na' ? 0 : $skills->supervisor).', '.($skills->administrator == 'na' ? 0 : $skills->administrator).', '.($skills->developer == 'na' ? 0 : $skills->developer);
            
      #$advance_skills = $skills->sap.', '.$skills->siebel.', '.$skills->ms_crm.', '.$skills->teleopti.', '.$skills->supervisor.', '.$skills->administrator.', '.$skills->developer;
      ?>
           series: [
              {
            showInLegend: false,
                  name: 'Advanced Skills',
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
               text: '',
               x: 0
           },
   
           pane: {
               size: '80%'
           },
   
           xAxis: {
               categories: ['altitude vBox', 'Alcatel-Lucent', 'AVAYA', 'CISCO', 'SQL Server', 'ORACLE', 'altitude unified routing', 'altitude unified dialer', 'altitude voice', 'altitude email', 'altitude chat', 'social media', 'altitude unified desktop', 'altitude ivr', 'altitude express routing', 'altitude integration', 'altitude workflow', 'altitude uCI New Installation', 'altitude uCI Patch update', 'altitude reporting'],
               tickmarkPlacement: 'on',
            //visible: false,
               lineWidth: 0
           },
   
           yAxis: {
               gridLineInterpolation: 'polygon',
               lineWidth: 0,
               min: 0,
               max: 6,
               categories: [0, 1, 2, 3, 4, 5]
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
            $core_skills .= ', '.($skills->uci_installation == 'na' ? 0 : $skills->uci_installation).', '.($skills->uci_patch == 'na' ? 0 : $skills->uci_patch).', '.($skills->reporting_framework == 'na' ? 0 : $skills->reporting_framework);         
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
   
          $('#submitFormV7').click(function() {
            $('#form-skills-v7').submit();
          });
          
          $('#form-skills-v7 input').keydown(function(e) {
            if (e.keyCode == 13) {
               $('#form-skills-v7').submit();
            }
         });
   
          $('#skill-save').click(function(e) {
             e.preventDefault();
             var error = '';
             
             if($('#skill_rate').val() != 0 || $('#skill_rateV7').val() != 0) {
               if($('#skill_name').val() == 'supervisor' || $('#skill_name').val() == 'administrator' || $('#skill_name').val() == 'developer'
                  || $('#skill_nameV7').val() == 'supervisor' || $('#skill_nameV7').val() == 'administrator' || $('#skill_nameV7').val() == 'developer'
               ) {                   
                  //do nothing...
               } else {
                  if($('#cust_id_remark').val() == '') {
                     error += '- Please select customer.';
                   }
               }
             }
   
             if(error == '') {
               if($('#hidden-skill').val() == 'v8') {
                 $('#form-skills').submit();
               } else {
               $('#cust_id_remarkV7').val($('#cust_id_remark').val());
               $('#remarksV7').val($('#skill-remarks').val());
                  $('#form-skills-v7').submit();
               }
             } else {
               alert(error);
             }
          });
      //});
      
      var dd_old_val;
      var dd;
      var setLastSelected = function(element) {
         $(element).data('lastSelected', $(element).find("option:selected"));
      };
              
      $("select").each(function () {
         setLastSelected(this);
      });

      $('#cancel-skillModal').click(function() {
         dd.attr("selected", true);
      });


      $('.dd-skills').change(function() {
         var id = $(this).attr('id');
         var src = $('#img-'+id).attr('src');
         var dd_val = $(this).val();
         var h_old_rate = $('#h-old-'+id).val();
         var version = $(this).attr('data-name');
         
         dd = $(this).data('lastSelected');

         $('#skillModal').css({ 'overflow-y': 'auto', 'display': 'block' });
         $('#skillModal').addClass('in');

         if(src != undefined) {
            $('#span-skill-img').html('<img src="'+src+'">');
         } else {
            $('#span-skill-img').html('<b>'+id.toUpperCase()+'</b>');
         }
   
         if(version == 'v8') {     
           $('#skill_name').val(id);
           $('#skill_rate').val(dd_val);
           $('#old_skill_rate').val(h_old_rate);
         } else { 
            h_old_rate = $('#h-oldV7-'+id).val();
           $('#skill_nameV7').val(id);
           $('#skill_rateV7').val(dd_val);
           $('#old_skill_rateV7').val(h_old_rate);
         }
   
         $('#hidden-skill').val(version);
         $('<div class="modal-backdrop fade in" id="modal-black"></div>').insertAfter('#skillModal');      
      });

      $('#cancel-skillModal').click(function(e){         
         e.preventDefault();

         $('#skillModal').css({ 'display': 'none' });
         $('#modal-black').css({ 'display': 'none' });
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

      var div_v7 = false;
      var div_v8 = false;
      var div_voc = false;
      
      @if(isset($_GET['show']))
         @if($_GET['show'] == 'v7')
            div_v7 = true;
            $('#a-version7').css('background', '#323A45');
            $('#plus-minus-v7').attr('class', 'icon-minus');
            $('.v8-wrapper').hide();
            $('.wrapper-voc').hide();
         @elseif($_GET['show'] == 'v8')
            div_v8 = true;
            $('#a-version8').css('background', '#323A45');
            $('#plus-minus-v8').attr('class', 'icon-minus');
            $('.v7-wrapper').hide();
            $('.wrapper-voc').hide();
         @elseif($_GET['show'] == 'voc')
            //div_voc = true;
            $('#a-version8').css('background', '#323A45');
            $('#plus-minus-voc').attr('class', 'icon-minus');
            $('.v7-wrapper').hide();
            $('.v8-wrapper').hide();
            $('.wrapper-voc').show();
         @endif
      @else  
         $('.v7-wrapper').hide();
         $('.v8-wrapper').hide(); 
         $('.wrapper-voc').hide();       
      @endif
      
      $('#a-version7').click(function() {
      
         if(div_v7) {
            $('.v7-wrapper').hide( 1000 );
            $(this).css({"background":"#323A45"});
            $('#plus-minus-v7').attr('class', 'icon-plus');
            div_v7 = false;
         } else {
            $('.v7-wrapper').show( 1000 );
            $(this).css({"background":"#323A45","color":"#FFF"});
            $('#plus-minus-v7').attr('class', 'icon-minus');
            div_v7 = true;
         }      
      });
      
      $('#a-version8').click(function() {

         if(div_v8) {
            $('.v8-wrapper').hide( 1000 );
            $(this).css({"background":"#323A45"});
            $('#plus-minus-v8').attr('class', 'icon-plus');
            div_v8 = false;
         } else {
            $('.v8-wrapper').show( 1000 );
            $(this).css({"background":"#323A45","color":"#FFF"});
            $('#plus-minus-v8').attr('class', 'icon-minus');
            div_v8 = true;
         }
      }); 

      $('#a-voc').click(function() {
      
         if(! div_voc) {
            $('.wrapper-voc').show( 1000 );
            //$(this).css({"background":"#323A45"});
            $('#plus-minus-voc').attr('class', 'icon-minus');
            div_voc = true;
         } else {
            $('.wrapper-voc').hide( 1000 );
            //$(this).css({"background":"#323A45","color":"#FFF"});
            $('#plus-minus-voc').attr('class', 'icon-plus');
            div_voc = false;
         }      
      });
      
      function showDescription(skill_name) {
         $.ajax({
             url: '{{ URL::to("admin/skills-map/getDescription") }}',
             type: 'GET',
             data: { skill_name : skill_name } ,
             success: function (response) {                 
                 $('#tip2').html(response);                               
             },
             error: function () {
                 $('#tip2').html('<h5>Skill has no description.</h5>');
             }
         });          
      }

      function getSkillData(id) {
         var sp = id.split('-');
         $.ajax({
             url: '{{ URL::to("admin/skills-map/getSkillData") }}',
             type: 'GET',
             data: { uid: "{{ $_GET['id'] }}", skill_name : sp[1]} ,
             success: function (response) {
                 $('#skillDataBody').html(response);
             },
             error: function () {
                 $('#tip2').html('<h5>Empty Result</h5>');
             }
         }); 
      }
   
      function getSkillDataV7(id) {
         var sp = id.split('-');
         $.ajax({
             url: '{{ URL::to("admin/skills-map-v7/getSkillData") }}',
             type: 'GET',
             data: { uid: "{{ $_GET['id'] }}", skill_name : sp[1]} ,
             success: function (response) {
                 $('#skillDataBody').html(response);                            
             },
             error: function () {
                 $('#tip2').html('<h5>Empty Result</h5>');
             }
         }); 
      }

      function saveSkillProficiency() {
         var sp = id.split('-');
         $.ajax({
             url: '{{ URL::to("admin/skills-map/updateSkill") }}',
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
            }, 
            letterRendering: false,
            taintTest: false,
            useCORS: false
         });
      }
      //--></script>