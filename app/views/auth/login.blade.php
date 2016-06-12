{{ HTML::style('resources/css/pages/signin.css') }}
<div class="account-container">
	<div class="content clearfix">
		{{ Form::open(array('url'=>'auth/login', 'class'=>'form-signin', 'role'=>'form', 'autocomplete' => 'off')) }}
			<h1>Admin Login</h1>		
			
			<div class="login-fields">
				<p style="padding-bottom: 10px;">Login with your account</p>
				
				<div class="field">
					<label for="username">Email</label>
					{{ Form::text('username', null, array('class'=>'login username-field', 'maxlength'=>'50', 'placeholder'=>'Email', 'autocomplete'=>'off')) }}
				</div> <!-- /field -->
				
				<div class="field">
					<label for="password">Password</label>
					{{ Form::password('password', array('class'=>'login password-field', 'maxlength'=>'50', 'placeholder'=>'Password', 'autocomplete'=>'off')) }}
				</div> <!-- /password -->
			</div> 
			<!-- /login-fields -->
			
			<div class="login-actions">
				{{ Form::submit('Sign In', array('class'=>'button btn btn-large'))}}
			</div> 
			<!-- .actions -->
		{{ Form::close() }}	
	</div> <!-- /content -->	
</div> <!-- /account-container -->
<br /><br /><br /><br /><br />