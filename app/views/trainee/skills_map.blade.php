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
</style>
<div class="rows">
   @if($skills)
   <center>
      <h3><u><font color="#00649a">Altitude uCI 8 Certification</font></u></h3>
   </center>
   <div class="row" style="color: #1f49aa;">
      <div class="span10"> 
         <b>Name:</b> 
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
         {{ $skills->fullname }}<br>
         <b>Status:</b>
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         {{ Form::text('status', $skills->status, array('style'=>'width: 80%; color: #1f49aa;')) }}<br>
         <b>Status as of:</b>
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <input type="date" name="status_as_of" style="color: #1f49aa;" value="{{ $skills->status_as_of }}" required>
      </div>
      {{ HTML::image('resources/img/skills-map/altitude-powered.png', 'logo', array('width' => '75', 'height' => '75', 'title' => 'powered by altitude', 'class' => 'img-responsive')) }}                
      <div class="span12" style="padding: 5px 0; color: #fff; background: #00649a; margin-top: 6px;">
         <center>
            <h4>Core Skills</h4>
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
                     {{ HTML::image('resources/img/skills-map/infrastructure/vbox.jpg', 'logo', array('width' => '55', 'height' => '27', 'class' => 'img-responsive')) }}
                     <?php
                        $core_rate[$skills->vbox][][$skills->vbox_rate] = HTML::image('resources/img/skills-map/infrastructure/vbox.jpg', 'logo', array('width' => '55', 'height' => '27', 'class' => 'img-responsive'));
                        ?>
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     {{ Form::text('vbox', $skills->vbox, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                     {{ Form::text('vbox_rate', $skills->vbox_rate, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/infrastructure/alcatel.jpg', 'logo', array('width' => '96', 'height' => '27', 'class' => 'img-responsive')) }}
                        <?php
                           $core_rate[$skills->alcatel][][$skills->alcatel_rate] = HTML::image('resources/img/skills-map/infrastructure/alcatel.jpg', 'logo', array('width' => '96', 'height' => '27', 'class' => 'img-responsive'));
                           ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        {{ Form::text('alcatel', $skills->alcatel, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                        {{ Form::text('alcatel_rate', $skills->alcatel_rate, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}                      
                     </div>
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/infrastructure/avaya.jpg', 'logo', array('width' => '53', 'height' => '17', 'class' => 'img-responsive')) }}
                        <?php
                           $core_rate[$skills->avaya][][$skills->avaya_rate] = HTML::image('resources/img/skills-map/infrastructure/avaya.jpg', 'logo', array('width' => '53', 'height' => '17', 'class' => 'img-responsive'));
                           ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{ Form::text('avaya', $skills->avaya, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                        {{ Form::text('avaya_rate', $skills->avaya_rate, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}                       
                     </div>
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/infrastructure/cisco.png', 'logo', array('width' => '49', 'height' => '20', 'class' => 'img-responsive')) }}
                        <?php
                           $core_rate[$skills->cisco][][$skills->cisco_rate] = HTML::image('resources/img/skills-map/infrastructure/cisco.png', 'logo', array('width' => '49', 'height' => '20', 'class' => 'img-responsive'));
                           ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{ Form::text('cisco', $skills->cisco, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                        {{ Form::text('cisco_rate', $skills->cisco_rate, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}                       
                     </div>
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/infrastructure/sql.png', 'logo', array('width' => '80', 'height' => '23', 'class' => 'img-responsive')) }}
                        <?php
                           $core_rate[$skills->sql_server][][$skills->sql_rate] = HTML::image('resources/img/skills-map/infrastructure/sql.png', 'logo', array('width' => '80', 'height' => '23', 'class' => 'img-responsive'));
                           ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{ Form::text('sql_server', $skills->sql_server, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                        {{ Form::text('sql_rate', $skills->sql_rate, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}                        
                     </div>
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/infrastructure/oracle.jpg', 'logo', array('width' => '83', 'height' => '19', 'class' => 'img-responsive')) }}
                        <?php
                           $core_rate[$skills->oracle][][$skills->oracle_rate] = HTML::image('resources/img/skills-map/infrastructure/oracle.jpg', 'logo', array('width' => '83', 'height' => '19', 'class' => 'img-responsive'));
                           ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{ Form::text('oracle', $skills->oracle, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                        {{ Form::text('oracle_rate', $skills->oracle_rate, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}                        
                     </div>
                  </td>
                  <!-- end Infrastructure -->
                  <!-- start Pacing Mode -->
                  <td>
                     {{ HTML::image('resources/img/skills-map/pacing/altitude_routing.png', 'logo', array('width' => '104', 'height' => '28', 'class' => 'img-responsive')) }}
                     &nbsp;&nbsp;&nbsp;&nbsp;
                     {{ Form::text('altitude_routing', $skills->altitude_routing, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                     {{ Form::text('altitude_routing_rate', $skills->altitude_routing_rate, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/pacing/altitude_dialer.png', 'logo', array('width' => '89', 'height' => '24', 'class' => 'img-responsive')) }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{ Form::text('altitude_dialer', $skills->altitude_dialer, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                        {{ Form::text('altitude_dialer_rate', $skills->altitude_dialer_rate, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}                        
                     </div>
                  </td>
                  <!-- end Pacing Mode -->
                  <!-- start Channels -->
                  <td>
                     {{ HTML::image('resources/img/skills-map/channels/altitude_voice.png', 'logo', array('width' => '75', 'height' => '25', 'class' => 'img-responsive')) }}
                     &nbsp;&nbsp;&nbsp;
                     {{ Form::text('altitude_voice', $skills->altitude_voice, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                     {{ Form::text('altitude_voice_rate', $skills->altitude_voice_rate, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/channels/altitude_email.png', 'logo', array('width' => '67', 'height' => '21', 'class' => 'img-responsive')) }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{ Form::text('altitude_email', $skills->altitude_email, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                        {{ Form::text('altitude_email_rate', $skills->altitude_email_rate, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}                       
                     </div>
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/channels/altitude_chat.png', 'logo', array('width' => '62', 'height' => '24', 'class' => 'img-responsive')) }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{ Form::text('altitude_chat', $skills->altitude_chat, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                        {{ Form::text('altitude_chat_rate', $skills->altitude_chat_rate, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}                      
                     </div>
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/channels/social.PNG', 'logo', array('width' => '50', 'height' => '23', 'class' => 'img-responsive')) }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{ Form::text('social', $skills->social, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                        {{ Form::text('social_rate', $skills->social_rate, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}                        
                     </div>
                  </td>
                  <!-- end Channels -->
                  <!-- start Development -->
                  <td>
                     {{ HTML::image('resources/img/skills-map/development/altitude_desktop.png', 'logo', array('width' => '87', 'height' => '23', 'class' => 'img-responsive')) }}
                     &nbsp;&nbsp;&nbsp;
                     {{ Form::text('altitude_desktop', $skills->altitude_desktop, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                     {{ Form::text('altitude_desktop_rate', $skills->altitude_desktop_rate, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/development/altitude_ivr.png', 'logo', array('width' => '84', 'height' => '24', 'class' => 'img-responsive')) }}
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        {{ Form::text('altitude_ivr', $skills->altitude_ivr, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                        {{ Form::text('altitude_ivr_rate', $skills->altitude_ivr_rate, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}                        
                     </div>
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/development/altitude_express_routing.png', 'logo', array('width' => '83', 'height' => '28', 'class' => 'img-responsive')) }}
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        {{ Form::text('altitude_express_routing', $skills->altitude_express_routing, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                        {{ Form::text('altitude_express_routing_rate', $skills->altitude_express_routing_rate, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}                        
                     </div>
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/development/altitude_integration.png', 'logo', array('width' => '67', 'height' => '24', 'class' => 'img-responsive')) }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{ Form::text('altitude_integration', $skills->altitude_integration, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                        {{ Form::text('altitude_integration_rate', $skills->altitude_integration_rate, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}                       
                     </div>
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/development/altitude_workflow.png', 'logo', array('width' => '56', 'height' => '25', 'class' => 'img-responsive')) }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{ Form::text('altitude_workflow', $skills->altitude_workflow, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                        {{ Form::text('altitude_workflow_rate', $skills->altitude_workflow_rate, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}                       
                     </div>
                  </td>
                  <!-- end Development -->
                  <!-- start Installation / Patch Updgrade -->
                  <td>
                     {{ HTML::image('resources/img/skills-map/installation/uci_installation.PNG', 'logo', array('width' => '104', 'height' => '28', 'class' => 'img-responsive')) }}
                     &nbsp;&nbsp;&nbsp;&nbsp;
                     {{ Form::text('uci_installation', $skills->uci_installation, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                     {{ Form::text('uci_installation_rate', $skills->uci_installation_rate, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/installation/uci_patch.PNG', 'logo', array('width' => '89', 'height' => '24', 'class' => 'img-responsive')) }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{ Form::text('uci_patch', $skills->uci_patch, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                        {{ Form::text('uci_patch_rate', $skills->uci_patch_rate, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}                        
                     </div>
                  </td>
                  <!-- end Installation / Patch Updgrade -->                        
               </tr>
            </tbody>
         </table>
      </div>
      <div class="span6">
         <div style="text-align: center; padding: 5px 0; color: #fff; background: #00649a;">
            <h4>Advance Skills</h4>
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
                     {{ Form::text('sap', $skills->sap, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                     {{ Form::text('sap_rate', $skills->sap_rate, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/connectors/siebel.jpg', 'logo', array('width' => '77', 'height' => '19', 'class' => 'img-responsive')) }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{ Form::text('siebel', $skills->siebel, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                        {{ Form::text('siebel_rate', $skills->siebel_rate, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}                        
                     </div>
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/connectors/ms_crm.jpg', 'logo', array('width' => '120', 'height' => '25', 'class' => 'img-responsive')) }}
                        &nbsp;&nbsp;
                        {{ Form::text('ms_crm', $skills->ms_crm, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                        {{ Form::text('ms_crm_rate', $skills->ms_crm_rate, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}                        
                     </div>
                     <div class="pad-top">                        
                        {{ HTML::image('resources/img/skills-map/connectors/teleopti.jpg', 'logo', array('width' => '64', 'height' => '22', 'class' => 'img-responsive')) }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{ Form::text('teleopti', $skills->teleopti, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                        {{ Form::text('teleopti_rate', $skills->teleopti_rate, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}                       
                     </div>
                  </td>
                  <td>
                     Supervisor
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     {{ Form::text('supervisor', $skills->supervisor, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                     {{ Form::text('supervisor_rate', $skills->supervisor_rate, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                     <div class="pad-top">                        
                        Administrator
                        &nbsp;&nbsp;&nbsp;
                        {{ Form::text('administrator', $skills->administrator, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                        {{ Form::text('administrator_rate', $skills->administrator_rate, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}                      
                     </div>
                     <div class="pad-top">                        
                        Developer
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{ Form::text('developer', $skills->developer, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}
                        {{ Form::text('developer_rate', $skills->developer_rate, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}                        
                     </div>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
      <div class="span6">
         <div style="text-align: center; padding: 5px 0; color: #fff; background: #00649a;">
            <h4>Customer Experience</h4>
         </div>
         <table class="table table-striped table-bordered">
            <tbody>
               <tr>
                  <td>
                     Communication
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     {{ Form::text('communication', $skills->communication, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}                       
                     <div class="pad-top">                        
                        Commitment
                        &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                        {{ Form::text('commitment', $skills->commitment, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}                          
                     </div>
                     <div class="pad-top">                        
                        Analysis
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{ Form::text('analysis', $skills->analysis, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}                           
                     </div>
                     <div class="pad-top">                        
                        Quality of Delivery
                        &nbsp;&nbsp;
                        {{ Form::text('quality_of_delivery', $skills->quality_of_delivery, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}                          
                     </div>
                  </td>
                  <td>
                     Productivity
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     {{ Form::text('productivity', $skills->productivity, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}                      
                     <div class="pad-top">                        
                        Issues Fixing Quality
                        &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                        {{ Form::text('fixing', $skills->fixing, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}                         
                     </div>
                     <div class="pad-top">                        
                        Company Presentability
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{ Form::text('presentability', $skills->presentability, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}                           
                     </div>
                     <div class="pad-top">                        
                        Overall Recommendation
                        &nbsp;&nbsp;&nbsp;
                        {{ Form::text('recommendation', $skills->recommendation, array('style'=>'width: 10%;', 'maxlength'=>'2')) }}                           
                     </div>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
      <div class="span12" style="text-align: center; padding: 5px 0;">
         {{ Form::hidden('skill_id', $skills->id ) }}
         {{ Form::hidden('id', $_GET['id'] ) }}
         <input type="submit" class="btn btn-primary" id="submitForm" value="UPDATE SKILLS MAP">
         <a href="" class="btn btn-primary">REVERT CHANGES</a>
      </div>
      <?php
         ksort($core_rate); 
         unset($core_rate[0]); 
         ?>      
      <?php
         #echo '<pre>';     
         #print_r($core_rate);
         ?>
      <script type="text/javascript" src="https://www.google.com/jsapi"></script>
      <script>
         google.load('visualization', '1', {packages: ['corechart', 'bar']});
         google.setOnLoadCallback(drawMultSeries);
         google.setOnLoadCallback(drawMultSeriesAdvance);
         google.setOnLoadCallback(drawMultSeriesExperience);         
                  
         function drawMultSeries() {
            <?php            
               $core_skills = $skills->vbox.', '.$skills->alcatel.', '.$skills->avaya.', '.$skills->cisco.', '.$skills->sql_server.', '.$skills->oracle;
               $core_skills .= ', '.$skills->altitude_routing.', '.$skills->altitude_dialer;
               $core_skills .= ', '.$skills->altitude_voice.', '.$skills->altitude_email.', '.$skills->altitude_chat.', '.$skills->social;
               $core_skills .= ', '.$skills->altitude_desktop.', '.$skills->altitude_ivr.', '.$skills->altitude_express_routing.', '.$skills->altitude_integration.', '.$skills->altitude_workflow;
               $core_skills .= ', '.$skills->uci_installation.', '.$skills->uci_patch;
            ?>
           var data = google.visualization.arrayToDataTable([
            ['Total', 'altitude vBox', 'Alcatel-Lucent', 'AVAYA', 'CISCO', 'SQL Server', 'ORACLE', 'altitude unified routing', 'altitude unified dialer', 'altitude voice', 'altitude email', 'altitude chat', 'social media', 'altitude unified desktop', 'altitude ivr', 'altitude express routing', 'altitude integration', 'altitude workflow', 'altitude uCI New Installation', 'altitude uCI Patch update'],
            ['Rate', {{ $core_skills }}]
           ]);
            
           var options = {
            title: 'CORE SKILLS',
            height: 450,
            chartArea: { width: '50%' },
            hAxis: {
              title: 'Overall Rating',
              minValue: 0,
              maxValue: 3
            },
            vAxis: {
              title: 'Infrastructure / Pacing Mode / Channels / Development / Installation and Patch Upgrade'
            }
           };
         
           var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
           chart.draw(data, options);
         }

         function drawMultSeriesAdvance() {
            <?php
               $advance_skills = $skills->sap.', '.$skills->siebel.', '.$skills->ms_crm.', '.$skills->teleopti.', '.$skills->supervisor.', '.$skills->administrator.', '.$skills->developer;
            ?>
           var data2 = google.visualization.arrayToDataTable([
            ['Total', 'SAP', 'SIEBEL', 'MS Dynamics CRM', 'TELEOPTI', 'Supervisor', 'Administrator', 'Developer'],
            ['Rate', {{ $advance_skills }}]
           ]);
         
           var options2 = {
            title: 'ADVANCE SKILLS',
            height: 450,
            chartArea: { width: '50%' },
            hAxis: {
              title: 'Overall Rating',
              minValue: 0,
              maxValue: 3
            },
            vAxis: {
              title: 'Third Party / Connectors and Training'
            }
           };
         
           var chart2 = new google.visualization.BarChart(document.getElementById('chart_advance_div'));
           chart2.draw(data2, options2);
         }

         function drawMultSeriesExperience() {
            <?php
               $cust_exp = $skills->communication.', '.$skills->commitment.', '.$skills->analysis.', '.$skills->quality_of_delivery.', '.$skills->productivity.', '.$skills->fixing.', '.$skills->presentability.', '.$skills->recommendation;
            ?>
           var data3 = google.visualization.arrayToDataTable([
            ['Total', 'Communication', 'Commitment', 'Analysis', 'Quality of Delivery', 'Productivity', 'Issues Fixing Quality', 'Company Presentability', 'Overall Recommendation'],
            ['Rate', {{ $cust_exp }}]
           ]);
         
           var options3 = {
            title: 'FEEDBACK',
            height: 450,
            chartArea: { width: '50%' },
            hAxis: {
              title: 'Overall Rating',
              minValue: 0,
              maxValue: 3
            },
            vAxis: {
              title: 'Customer Experience'
            }
           };
         
           var chart3 = new google.visualization.BarChart(document.getElementById('chart_experience_div'));
           chart3.draw(data3, options3);
         }
      </script>
      <div class="span12">
         <div style="text-align: center; padding: 5px 0; color: #fff; background: #00649a;">
            <h4>Core Skills - Graphical Representation</h4>
         </div>
         <div id="chart_div"></div>
         <div style="text-align: center; padding: 5px 0; color: #fff; background: #00649a;">
            <h4>Advance Skills - Graphical Representation</h4>
         </div>
         <div id="chart_advance_div"></div>
         <div style="text-align: center; padding: 5px 0; color: #fff; background: #00649a;">
            <h4>Customer Experience - Graphical Representation</h4>
         </div>
         <div id="chart_experience_div"></div>
      </div>               
   </div>
   @else
      <div class="alert alert-info">
         <b>** Only Engineer user type are provided by skills map view. **</b>
      </div>
   @endif
</div>
<script type="text/javascript"><!--
   $(document).ready(function() {
      // Submit Form
       $('#submitForm').click(function() {
         $('#form-skills').submit();
       });
       
       $('#form-skills input').keydown(function(e) {
         if (e.keyCode == 13) {
            $('#form-skills').submit();
         }
      });
   });
   //--></script>