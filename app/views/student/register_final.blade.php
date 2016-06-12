<h2 class="page-header">
<i class="fa fa-group"></i> We always want the best for YOU
</h2>	
{{ Form::open(array('url'=>'student/register-final-step', 'class'=>'form-horizontal', 'autocomplete'=>'off', 'id'=>'form', 'role'=>'form', 'method' => 'post')) }}
<div class="row">
	<?php foreach($courses as $key => $value): ?>
		<h3><i class="fa fa-comment-o"></i> {{ $value }}</h3>
		<div class="col-lg-12" style="margin-bottom: 12px;">
			{{ Form::textarea('post_msg['.$value.']', null, array('placeholder' => 'Type your learning expectations here...(optional)', 'size' => '30x7', 'class' => 'form-control', 'maxlength' => 5000)) }}			
			{{ Form::hidden('cid['.$value.']', $key) }}
		</div>
	<?php endforeach; ?>
	<input type="submit" class="btn btn-primary" id="submitForm" value="REGISTER - FINAL STEP">
</div>