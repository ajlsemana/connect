<div class="h-sw js-sections-container">
   <div class="h-hprograms">
      <div class="h-hprograms__sec">
         <div class="h-section__header">
            <div class="row" id="message">
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
               <div class="large-12 columns" id="login">
                  <div class="login-block">
                     <h1>Login</h1>
                     {{ Form::open(array('url'=> 'trainee/login', 'class'=>'form-horizontal', 'autocomplete'=>'on', 'id'=>'form-login', 'role'=>'form', 'method' => 'post')) }}    
                     {{ Form::text('username', Input::old('username'), array('class' => 'form-control', 'placeholder' => '* Email', 'maxlength'=>'50', 'id' => 'uname')) }}
                     {{ Form::password('password', array('class' => 'form-control', 'placeholder' => '* Password', 'maxlength'=>'50', 'id' => 'password')) }}
                     {{ Form::hidden('user_type', '3') }}
                     <a class="button round" id="submitForm">Sign In</a>
                     {{ Form::close() }}
                     <center>
                        <a href="#" id="forgot" style="text-decoration: none;">Forgotten your password?</a>
                        {{ Form::open(array('url'=> 'forgot-password', 'class'=>'form-horizontal', 'autocomplete'=>'on', 'id'=>'form-forgot', 'role'=>'form', 'method' => 'post')) }}    
                        <div id="forgot-wrapper" style="display: none;">
                            Please enter your primary email and we will send you your new password afterwards.
                            <br>
                            {{ Form::text('primary_email_address', null, array('id' => 'primary_email_address','placeholder' => '* Primary Email Address')) }}<br>
                            {{ Form::submit('Generate New Password') }}
                        </div>
                        {{ Form::close() }}
                     </center>
                  </div>
               </div>                                
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function() {
        $('#forgot').click(function(e){
          e.preventDefault();
          $('#forgot-wrapper').toggle('slow');
          $('#primary_email_address').focus();
        });

        $('a[href^="#"]').on('click',function (e) {
            e.preventDefault();
   
            var target = this.hash;
            var $target = $(target);
   
            $('html, body').stop().animate({
                'scrollTop': $target.offset().top
            }, 900, 'swing', function () {
                window.location.hash = target;
            });
   
            $('#uname').focus();
        });
       // Submit Form
       $('#submitForm').click(function() {
         $('#form-login').submit();
       });
   
       $('#submitTrainer').click(function() {
         $('#form-trainer').submit();
       });
       
       $('#form-login input').keydown(function(e) {
         if (e.keyCode == 13) {
           $('#form-login').submit();
         }   
        });
   
       $('#form-trainer input').keydown(function(e) {
         if (e.keyCode == 13) {
           $('#form-trainer').submit();
         }   
        });
   }); 
</script>