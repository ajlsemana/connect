@if( $errors->all() )
    <div class="alert alert-error">
      <button class="close" data-dismiss="alert" type="button">&times;</button>
      {{ HTML::ul($errors->all()) }}
    </div>
@endif
<div class="row">
   <div class="span12">
      <div class="widget">
         <div class="widget-header">
            <i class="icon-key"></i>
            <h3>Update Profile</h3>
         </div>
         <div class="widget-content">
            &nbsp;&nbsp;&nbsp;{{ Form::model($user, array('url'=>'trainer/updateProfile', 'files' => true, 'class'=>'form-horizontal', 'id'=>'form', 'role'=>'form', 'method' => 'post')) }} 
            <div class="control-group">
               <label for="profile_pic" class="col-sm-2 control-label">Browse New Photo</label>
               <div class="col-sm-4">
                  <?php
                     $pic = 'no-photo.jpg';
                     $destinationPath = Config::get('app.url_storage') . '/profile_pic/'.$pic;                       
                  ?>       
                  @if(! empty($user->profile_pic))
                  <?php $pic = $user->profile_pic; ?>
                  <?php $destinationPath = Config::get('app.url_storage') . '/profile_pic/'.$pic; ?>           
                  @endif   
                  &nbsp;&nbsp;&nbsp;      
                  <img height="240" width="240" alt="profile picture" class="img-responsives" src="{{ $destinationPath }}" />        
                  <br /><br />
                  &nbsp;&nbsp;&nbsp;{{ Form::file('image') }}  
               </div>
            </div>
            <!-- /row -->
            <div class="control-group">
               <label for="first_name" class="col-sm-2 control-label">First Name</label>
               <div class="col-sm-4">
                  &nbsp;&nbsp;&nbsp;{{ Form::text('first_name', $user->first_name, array('class' => 'form-control','maxlength'=>'50')) }}
               </div>
            </div>
            <div class="control-group">
               <label for="middle_name" class="col-sm-2 control-label">Middle Name</label>
               <div class="col-sm-4">
                  &nbsp;&nbsp;&nbsp;{{ Form::text('middle_name', $user->middle_name, array('class' => 'form-control','maxlength'=>'50')) }}
                  &nbsp;&nbsp;&nbsp;{{ Form::hidden('profile_pic', $pic) }}
               </div>
            </div>
            <div class="control-group">
               <label for="last_name" class="col-sm-2 control-label">Last Name</label>
               <div class="col-sm-4">
                  &nbsp;&nbsp;&nbsp;{{ Form::text('last_name', $user->last_name, array('class' => 'form-control','maxlength'=>'50')) }}
               </div>
            </div>
            <div class="control-group">
               <label for="email_address" class="col-sm-2 control-label">Primary Email</label>
               <div class="col-sm-4">
                  &nbsp;&nbsp;&nbsp;{{ Form::text('primary_email_address', $user->primary_email_address, array('class' => 'form-control','maxlength'=>'50')) }}
               </div>
            </div>
            <div class="control-group">
               <label for="email_address" class="col-sm-2 control-label">Secondary Email</label>
               <div class="col-sm-4">
                  &nbsp;&nbsp;&nbsp;{{ Form::text('secondary_email', $user->secondary_email, array('class' => 'form-control','maxlength'=>'50')) }}
               </div>
            </div>
            <div class="control-group">
               <label for="email_address" class="col-sm-2 control-label">Contact No.</label>
               <div class="col-sm-4">
                  &nbsp;&nbsp;&nbsp;{{ Form::text('contact_number', $user->contact_number, array('class' => 'form-control','maxlength'=>'50')) }}
               </div>
            </div>
            <div class="control-group">
               <label for="email_address" class="col-sm-2 control-label">Company</label>
               <div class="col-sm-4">
                  &nbsp;&nbsp;&nbsp;
                  @if(Auth::user()->user_type == 5 || Auth::user()->skills_map == 1)
                     <input type="text" readonly value="{{ $companies[$user->company] }}">
                     {{ Form::hidden('company', $user->company) }}
                     <i>(Note: Kindly inform the admin if you want to update your company.)</i>                     
                  @else
                     {{ Form::text('company', $user->company, array('class' => 'form-control','maxlength'=>'50')) }}
                  @endif
               </div>
            </div>
            <div class="control-group">
               <label for="email_address" class="col-sm-2 control-label">Position</label>
               <div class="col-sm-4">
                  &nbsp;&nbsp;&nbsp;{{ Form::text('position', $user->position, array('class' => 'form-control','maxlength'=>'50')) }}
               </div>
            </div>
            <div class="control-group">
               <label for="" class="col-sm-2 control-label"></label>
               <div class="col-sm-4">
                  &nbsp;&nbsp;&nbsp;<a class="btn btn-sm btn-primary" id="submitForm">Submit</a>
                  <a class="btn btn-sm btn-default" href="{{ $url_cancel }}">Cancel</a>      
               </div>
            </div>
            &nbsp;&nbsp;&nbsp;{{ Form::close() }}                       
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