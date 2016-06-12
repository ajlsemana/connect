<div class="row">
   <div class="span12">
      <div class="widget">
         <div class="widget-header">
            <i class="icon-key"></i>
            <h3>Update Password</h3>
         </div>
         <div class="widget-content">
            {{ Form::open(array('url'=>'trainer/updatePassword', 'class'=>'form-horizontal', 'autocomplete'=>'off', 'id'=>'form', 'role'=>'form', 'method' => 'post')) }}		
            <div class="control-group">
               <div class="span12">
                  <label for="old_password" class="col-sm-2 control-label">Old Password</label>&nbsp;
                  {{ Form::password('old_password', array('class' => 'form-control', 'id' => 'old_password', 'maxlength' => 50)) }}
               </div>
            </div>
            
            <div class="control-group">
               <div class="span12">
                  <label for="new_password" class="col-sm-2 control-label">New Password</label>&nbsp;
                  {{ Form::password('new_password', array('class' => 'form-control', 'id'=> 'new_password', 'maxlength' => 50)) }}
               </div>
            </div>
            
            <div class="control-group">
               <div class="span12">
                  <label for="password_confirmation" class="col-sm-2 control-label">Confirm Password</label>&nbsp;
                  {{ Form::password('password_confirmation', array('class' => 'form-control', 'id'=> 'password_confirmation', 'maxlength' => 50)) }}
               </div>
            </div>
            <div class="span12">
               <label for="" class="col-sm-2 control-label"></label>
               <div class="span12">
                  <a class="btn btn-sm btn-primary" id="submitForm">Submit</a>
                  <a class="btn btn-sm btn-default" href="{{ $url_cancel }}">Cancel</a>
               </div>
            </div>
            {{ Form::close() }}		
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function() {
       // Submit Form
       $('#submitForm').click(function() {
       	$('#form').submit();
       });
       
       $('#form input').keydown(function(e) {
   		if (e.keyCode == 13) {
   			$('#form').submit();
   		}
   	});
   });
</script>