<style>
   .pad {
   margin-top: 5px;
   }
</style>
<?php
   $countries = array(
   	'' => '- Select Country -',
   	'Afghanistan'   =>   'Afghanistan',
   	'Albania'    =>   'Albania',
   	'Algeria'    =>   'Algeria',
   	'Andorra'    =>   'Andorra',
   	'Angola'  =>   'Angola',
   	'Antigua & Deps'   =>   'Antigua & Deps',
   	'Argentina'  =>   'Argentina',
   	'Armenia'    =>   'Armenia',
   	'Australia'  =>   'Australia',
   	'Austria'    =>   'Austria',
   	'Azerbaijan'    =>   'Azerbaijan',
   	'Bahamas'    =>   'Bahamas',
   	'Bahrain'    =>   'Bahrain',
   	'Bangladesh'    =>   'Bangladesh',
   	'Barbados'   =>   'Barbados',
   	'Belarus'    =>   'Belarus',
   	'Belgium'    =>   'Belgium',
   	'Belize'  =>   'Belize',
   	'Benin'   =>   'Benin',
   	'Bhutan'  =>   'Bhutan',
   	'Bolivia'    =>   'Bolivia',
   	'Bosnia Herzegovina'  =>   'Bosnia Herzegovina',
   	'Botswana'   =>   'Botswana',
   	'Brazil'  =>   'Brazil',
   	'Brunei'  =>   'Brunei',
   	'Bulgaria'   =>   'Bulgaria',
   	'Burkina'    =>   'Burkina',
   	'Burundi'    =>   'Burundi',
   	'Cambodia'   =>   'Cambodia',
   	'Cameroon'   =>   'Cameroon',
   	'Canada'  =>   'Canada',
   	'Cape Verde'    =>   'Cape Verde',
   	'Central African Rep'    =>   'Central African Rep',
   	'Chad'    =>   'Chad',
   	'Chile'   =>   'Chile',
   	'China'   =>   'China',
   	'Colombia'   =>   'Colombia',
   	'Comoros'    =>   'Comoros',
   	'Congo'   =>   'Congo',
   	'Congo {Democratic Rep}'    =>   'Congo {Democratic Rep}',
   	'Costa Rica'    =>   'Costa Rica',
   	'Croatia'    =>   'Croatia',
   	'Cuba'    =>   'Cuba',
   	'Cyprus'  =>   'Cyprus',
   	'Czech Republic'   =>   'Czech Republic',
   	'Denmark'    =>   'Denmark',
   	'Djibouti'   =>   'Djibouti',
   	'Dominica'   =>   'Dominica',
   	'Dominican Republic'  =>   'Dominican Republic',
   	'East Timor'    =>   'East Timor',
   	'Ecuador'    =>   'Ecuador',
   	'Egypt'   =>   'Egypt',
   	'El Salvador'   =>   'El Salvador',
   	'Equatorial Guinea'   =>   'Equatorial Guinea',
   	'Eritrea'    =>   'Eritrea',
   	'Estonia'    =>   'Estonia',
   	'Ethiopia'   =>   'Ethiopia',
   	'Fiji'    =>   'Fiji',
   	'Finland'    =>   'Finland',
   	'France'  =>   'France',
   	'Gabon'   =>   'Gabon',
   	'Gambia'  =>   'Gambia',
   	'Germany'    =>   'Germany',
   	'Ghana'   =>   'Ghana',
   	'Greece'  =>   'Greece',
   	'Grenada'    =>   'Grenada',
   	'Guatemala'  =>   'Guatemala',
   	'Guinea'  =>   'Guinea',
   	'Guinea-Bissau'    =>   'Guinea-Bissau',
   	'Guyana'  =>   'Guyana',
   	'Haiti'   =>   'Haiti',
   	'Honduras'   =>   'Honduras',
   	'Hungary'    =>   'Hungary',
   	'Iceland'    =>   'Iceland',
   	'India'   =>   'India',
   	'Indonesia'  =>   'Indonesia',
   	'Iran'    =>   'Iran',
   	'Iraq'    =>   'Iraq',
   	'Ireland {Republic}'  =>   'Ireland {Republic}',
   	'Israel'  =>   'Israel',
   	'Italy'   =>   'Italy',
   	'Ivory Coast'   =>   'Ivory Coast',
   	'Jamaica'    =>   'Jamaica',
   	'Japan'   =>   'Japan',
   	'Jordan'  =>   'Jordan',
   	'Kazakhstan'    =>   'Kazakhstan',
   	'Kenya'   =>   'Kenya',
   	'Kiribati'   =>   'Kiribati',
   	'Korea North'   =>   'Korea North',
   	'Korea South'   =>   'Korea South',
   	'Kosovo'  =>   'Kosovo',
   	'Kuwait'  =>   'Kuwait',
   	'Kyrgyzstan'    =>   'Kyrgyzstan',
   	'Laos'    =>   'Laos',
   	'Latvia'  =>   'Latvia',
   	'Lebanon'    =>   'Lebanon',
   	'Lesotho'    =>   'Lesotho',
   	'Liberia'    =>   'Liberia',
   	'Libya'   =>   'Libya',
   	'Liechtenstein'    =>   'Liechtenstein',
   	'Lithuania'  =>   'Lithuania',
   	'Luxembourg'    =>   'Luxembourg',
   	'Macedonia'  =>   'Macedonia',
   	'Madagascar'    =>   'Madagascar',
   	'Malawi'  =>   'Malawi',
   	'Malaysia'   =>   'Malaysia',
   	'Maldives'   =>   'Maldives',
   	'Mali'    =>   'Mali',
   	'Malta'   =>   'Malta',
   	'Marshall Islands'    =>   'Marshall Islands',
   	'Mauritania'    =>   'Mauritania',
   	'Mauritius'  =>   'Mauritius',
   	'Mexico'  =>   'Mexico',
   	'Micronesia'    =>   'Micronesia',
   	'Moldova'    =>   'Moldova',
   	'Monaco'  =>   'Monaco',
   	'Mongolia'   =>   'Mongolia',
   	'Montenegro'    =>   'Montenegro',
   	'Morocco'    =>   'Morocco',
   	'Mozambique'    =>   'Mozambique',
   	'Myanmar, {Burma}'    =>   'Myanmar, {Burma}',
   	'Namibia'    =>   'Namibia',
   	'Nauru'   =>   'Nauru',
   	'Nepal'   =>   'Nepal',
   	'Netherlands'   =>   'Netherlands',
   	'New Zealand'   =>   'New Zealand',
   	'Nicaragua'  =>   'Nicaragua',
   	'Niger'   =>   'Niger',
   	'Nigeria'    =>   'Nigeria',
   	'Norway'  =>   'Norway',
   	'Oman'    =>   'Oman',
   	'Pakistan'   =>   'Pakistan',
   	'Palau'   =>   'Palau',
   	'Panama'   =>   'Panama',
   	'Papua New Guinea'    =>   'Papua New Guinea',
   	'Paraguay'   =>   'Paraguay',
   	'Peru'    =>   'Peru',
   	'Philippines'   =>   'Philippines',
   	'Poland'  =>   'Poland',
   	'Portugal'   =>   'Portugal',
   	'Qatar'   =>   'Qatar',
   	'Romania'    =>   'Romania',
   	'Russian Federation'  =>   'Russian Federation',
   	'Rwanda'  =>   'Rwanda',
   	'St Kitts & Nevis'    =>   'St Kitts & Nevis',
   	'St Lucia'   =>   'St Lucia',
   	'Saint Vincent & the Grenadines'  =>   'Saint Vincent & the Grenadines',
   	'Samoa'   =>   'Samoa',
   	'San Marino'    =>   'San Marino',
   	'Sao Tome & Principe'    =>   'Sao Tome & Principe',
   	'Saudi Arabia'  =>   'Saudi Arabia',
   	'Senegal'    =>   'Senegal',
   	'Serbia'  =>   'Serbia',
   	'Seychelles'    =>   'Seychelles',
   	'Sierra Leone'  =>   'Sierra Leone',
   	'Singapore'  =>   'Singapore',
   	'Slovakia'   =>   'Slovakia',
   	'Slovenia'   =>   'Slovenia',
   	'Solomon Islands'  =>   'Solomon Islands',
   	'Somalia'    =>   'Somalia',
   	'South Africa'  =>   'South Africa',
   	'South Sudan'   =>   'South Sudan',
   	'Spain'   =>   'Spain',
   	'Sri Lanka'  =>   'Sri Lanka',
   	'Sudan'   =>   'Sudan',
   	'Suriname'   =>   'Suriname',
   	'Swaziland'  =>   'Swaziland',
   	'Sweden'  =>   'Sweden',
   	'Switzerland'   =>   'Switzerland',
   	'Syria'   =>   'Syria',
   	'Taiwan'  =>   'Taiwan',
   	'Tajikistan'    =>   'Tajikistan',
   	'Tanzania'   =>   'Tanzania',
   	'Thailand'   =>   'Thailand',
   	'Togo'    =>   'Togo',
   	'Tonga'   =>   'Tonga',
   	'Trinidad & Tobago'   =>   'Trinidad & Tobago',
   	'Tunisia'    =>   'Tunisia',
   	'Turkey'  =>   'Turkey',
   	'Turkmenistan'  =>   'Turkmenistan',
   	'Tuvalu'  =>   'Tuvalu',
   	'Uganda'  =>   'Uganda',
   	'Ukraine'    =>   'Ukraine',
   	'United Arab Emirates'   =>   'United Arab Emirates',
   	'United Kingdom'   =>   'United Kingdom',
   	'United States'    =>   'United States',
   	'Uruguay'    =>   'Uruguay',
   	'Uzbekistan'    =>   'Uzbekistan',
   	'Vanuatu'    =>   'Vanuatu',
   	'Vatican City'  =>   'Vatican City',
   	'Venezuela'  =>   'Venezuela',
   	'Vietnam'    =>   'Vietnam',
   	'Yemen'   =>   'Yemen',
   	'Zambia'  =>   'Zambia',
   	'Zimbabwe'   =>   'Zimbabwe'
   );
   ?>
<div class="h-sw js-sections-container">
   <div class="h-hprograms">
      <div class="h-hprograms__sec">
         <div class="h-section__header">
            <div class="row">
               <div class="column">
                  <h4 class="title"><i class="step fi-telephone-accessible size-21"></i> Get in touch with us</h4>
                  <p>Please provide the following information about your business needs to help us serve you better. This information will enable us to route your request to the appropriate person.</p>
                  <div class="row">
                     @if(Session::has('message'))
                     <div data-alert class="alert-box info radius">                        
                        {{ Session::get('message') }}
                     </div>
                     @endif
                     @if(Session::has('success'))
                     <div data-alert class="alert-box success radius">                        
                        {{ Session::get('success') }}
                     </div>
                     @endif
                     @if(Session::has('error'))
                     <div data-alert class="alert-box alert radius">                         
                        {{ Session::get('error') }}
                     </div>
                     @endif
                     @if( $errors->all() )   
                     <div data-alert class="alert-box alert radius">                      
                        {{ HTML::ul($errors->all()) }}
                     </div>
                     @endif           
                  </div>
                  <div class="row">
                     {{ Form::open(array('url'=> 'contact_send', 'class'=>'form-horizontal', 'autocomplete'=>'on', 'id'=>'form-contact', 'role'=>'form', 'method' => 'post')) }}                 
                     {{ Form::text('first_name', Input::old('first_name'), array('class' => 'pad form-control', 'placeholder' => '* First Name', 'maxlength'=>'50')) }}
                     {{ Form::text('last_name', Input::old('last_name'), array('class' => 'pad form-control', 'placeholder' => '* Last Name', 'maxlength'=>'50')) }}
                     {{ Form::text('company', Input::old('company'), array('class' => 'pad form-control', 'placeholder' => '* Company', 'maxlength'=>'50')) }}
                     {{ Form::text('email', Input::old('email'), array('class' => 'pad form-control', 'placeholder' => '* Email', 'maxlength'=>'50')) }} 
                     {{ Form::text('phone_number', Input::old('phone_number'), array('class' => 'pad form-control', 'placeholder' => '* Phone Number', 'maxlength'=>'50')) }}
                     {{ Form::select('country', $countries, Input::old('country'), array('class' => 'pad form-control','id'=>'subject_id')) }}
                     {{ Form::textarea('message', null, array('placeholder' => 'Type your message here...', 'size' => '30x7', 'class' => 'pad form-control', 'id'=> 'post_msg')) }}  
                     <center><a role="button" class="button round" id="submitForm">Send Message</a></center>
                  </div>
               </div>
               <div class="row">
                  <div class="large-6 columns">
                     <h4 class="title">Blue Mena Group FZ-LLC</h4>
                     Dubai Internet City<br>
                     Building 1 - Office 215<br>
                     Po Box 500071<br>
                     Dubai - UAE.<br><br>
                     <b>Tel:</b> +971 4 391 20 40<br>
                     <b>Fax:</b> +971 4 391 88 81<br>
                     <b>Email:</b> <a href="mailto:info@bluemena.com">info@bluemena.com</a>  
					<br><br>
					</div>
					<div class="large-6 columns">
                     <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="300" height="240" src="https://maps.google.com/maps?hl=en&amp;q=Dubai Internet City  Building 1 - Office 215&amp;ie=UTF8&amp;t=m&amp;z=16&amp;iwloc=B&amp;output=embed"></iframe>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function() {
       // Submit Form
       $('#submitForm').click(function() {
         $('#form-contact').submit();
       });
       
       $('#form-contact input').keydown(function(e) {
       if (e.keyCode == 13) {
         $('#form-contact').submit();
       }
     });
   }); 
</script>