<br /><br /><br />
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4">
  	{{ Form::open(array('url'=>'student/login', 'class'=>'form', 'role'=>'form', 'autocomplete' => 'off')) }}
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Student Login</h3>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label for="username">Username</label>
				{{ Form::text('username', null, array('class'=>'form-control', 'maxlength'=>'50', 'placeholder'=>'', 'autocomplete'=>'off')) }}
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				{{ Form::password('password', array('class'=>'form-control', 'maxlength'=>'50', 'placeholder'=>'', 'autocomplete'=>'off')) }}
			</div>
			{{ Form::submit('Sign In', array('class'=>'btn btn-default'))}}
		</div>
	</div>	
  	{{ Form::close() }}	
  </div>
  <div class="col-md-4"></div>
</div>