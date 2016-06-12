<ol class="breadcrumb">
	@foreach ($breadcrumbs as $breadcrumb)
		<li class="{{ $breadcrumb['class'] }}"><a href="{{ $breadcrumb['href'] }}">{{ $breadcrumb['text'] }}</a></li>
   	@endforeach
</ol>
{{ Form::open(array('url'=>$url_search, 'class'=>'form', 'id'=>'form-users', 'role'=>'form', 'method' => 'get')) }}
<div class="widget">
	<div class="widget-header">
		<div class="widget-content">
			<div class="span3 search-span">
				<div class="search-div">
					<div class="search-label">Username:</div>
					<div class="search-field">
						{{ Form::text('filter_username', $filter_username, array('id'=>'filter_username', 'placeholder'=>'', 'maxlength'=>'100', 'style'=>'width: 150px;')) }}
					</div>
				</div>							
				<div class="search-div">
					<div class="search-label">First Name:</div>
					<div class="search-field">
						{{ Form::text('filter_first_name', $filter_first_name, array('id'=>'filter_first_name', 'placeholder'=>'', 'maxlength'=>'100', 'style'=>'width: 150px;')) }}
					</div>
				</div>	
			</div>
			<div class="span3 search-span">
				<div class="search-div">
					<div class="search-label">Primary Email:</div>
					<div class="search-field">
						{{ Form::text('filter_primary_email', $filter_primary_email, array('id'=>'filter_primary_email', 'placeholder'=>'', 'maxlength'=>'100', 'style'=>'width: 150px;')) }}
					</div>
				</div>							
				<div class="search-div">
					<div class="search-label">Last Name:</div>
					<div class="search-field">
						{{ Form::text('filter_last_name', $filter_last_name, array('id'=>'filter_last_name', 'placeholder'=>'', 'maxlength'=>'100', 'style'=>'width: 150px;')) }}
					</div>
				</div>
			</div>
			<div class="span3 search-span">
				<div class="search-div">
					<div class="search-label">User Type:</div>
					<div class="search-field">
						{{ Form::select('filter_user_type', $user_type_options, $filter_user_type, array('id' => 'filter_user_type', 'class' => 'select-width')) }}
					</div>
				</div>
				<!--
				<div class="search-div">
					<div class="search-label">Status</div>
					<div class="search-field">
						{{ Form::select('filter_status', $status_options, $filter_status, array('id' => 'filter_status', 'class' => 'select-width')) }}
					</div>
				</div>-->	
			</div>
			
			<div class="span12">
				<div style="padding-top: 10px; border-bottom: 1px solid #D5D5D5; width: 92%"></div>
				<div align="left" style="padding-top:20px;">
					<a class="btn btn-primary" id="submitForm">Search</a>
					<a class="btn" id="clearForm">Clear</a>
				</div>
			</div>
		</div>
	</div>
</div>
{{ Form::hidden('sort', $sort) }}
{{ Form::hidden('order', $order) }}

{{ Form::close() }}

<div align="left" style="padding-bottom: 15px;">
	<a href="{{ $url_insert }}" class="btn btn-primary">Add New User</a>
    <a href="#deleteModal" data-toggle="modal" class="btn btn-primary" id="confirmDelete">Delete Users</a>
</div>

<div class="widget">
	<div class="widget-header">
		<i class="icon-user"></i>
		<h3>Users</h3>
		<span class="pagination-totalItems">Total: {{ $users_total }}</span>
	</div><!-- /widget-header -->

	<div class="widget-content">
		<div class="table-responsive">
		<table class="table table-condensed table-hover table-striped">
			<thead>
				<tr>
					<th class="align-center" style="width: 20px;"><input type="checkbox" id="main_checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></th>
					<th>
						Photo
					</th>
					<th>
						<a href="{{ $sort_username }}" class="@if ($sort=='username') {{ strtolower($order) }} @endif">Username</a>
					</th>
					<th>
						<a href="{{ $sort_first_name }}" class="@if ($sort=='first_name') {{ strtolower($order) }} @endif">Full Name</a>
					</th>					
					<!--<th>
						<a href="{{ $sort_primary_email }}" class="@if ($sort=='primary_email_address') {{ strtolower($order) }} @endif">Primary Email</a>
					</th>
					<th>
						Secondary Email
					</th>-->
					<th>
						<a href="{{ $sort_user_type }}" class="@if ($sort=='user_type') {{ strtolower($order) }} @endif">User Type</a>
					</th>
					<th>
						<a href="{{ $sort_date_added }}" class="@if ($sort=='created_at') {{ strtolower($order) }} @endif">Date Created</a>
					</th>
					<th>Action</th>
				</tr>
			</thead>
			
			<tbody>
				@if( CommonHelper::arrayHasValue($users) ) 
 				@foreach ($users as $user)
				<tr align="center">
					<td class="align-center">
						<input type="checkbox" class="checkbox" name="selected[]" value="{{ $user->id }}" data-name="{{ $user->username }}" />
					</td>
					<td>
					<?php
	                     $pic = 'no-photo.jpg';
	                     $destinationPath = Config::get('app.url_storage') . '/profile_pic/'.$pic;                       
                     ?>       
	                  @if(! empty($user->profile_pic))
	                  <?php $pic = $user->profile_pic; ?>
	                  <?php $destinationPath = Config::get('app.url_storage') . '/profile_pic/'.$pic; ?>           
	                  @endif                  
                  {{ HTML::image($destinationPath, 'logo', array('width' => '40', 'height' => '40', 'title' => 'photo', 'class' => 'img-responsive')) }}
					</td>
					<td><a href="{{ $url_update . '&id=' . $user->id }}" title="view or update">{{ $user->username }}</a></td>
					<td>{{ wordwrap($user->first_name.' '.$user->last_name, 100, "<br />\n", true) }}</td>				
					<!--<td>{{ $user->primary_email_address }} <input type="hidden" value="{{ $user->primary_email_address }}" id="email-{{ $user->id }}"></td>
					<td>{{ $user->secondary_email }} <input type="hidden" value="{{ $user->secondary_email }}" id="secondary_email-{{ $user->id }}"></td>-->
					<td>
						<?php
							if ($user->user_type == 3) {
								if($user->skills_map) {
									echo 'Engineer';
								} else {
									echo 'Trainee';
								}
							}														 
						?>
						@if ($user->user_type == 1) Admin
						@elseif ($user->user_type == 2) Trainer		
						@elseif ($user->user_type == 5) Resource Manager
						@endif
					</td>					
					<td>{{ $user->created_at }}</td>
					<td>
						<a href="{{ $url_update . '&id=' . $user->id }}" title="Update"><i class="icon-edit"></i></a>
                    	&nbsp;<a href="#passwordModal" data-toggle="modal" class="changePassword" data-id="{{ $user->id }}" data-name="{{ $user->username }}" title="Edit Password"><i class="icon-key"></i></a>						
                    </td>
				</tr>
				@endforeach
				@else
				<tr>
					<td colspan="10" class="align-center" style="padding: 10px;">Empty Results</td>
				</tr>
				@endif
			</tbody>
        </table>
        </div>
        
        @if( CommonHelper::arrayHasValue($users) ) 
	    <h6 class="paginate">
			<span>{{ $users->appends($arrFilters)->links() }}</span>
		</h6>
		@endif
	</div><!-- /widget-content --> 
</div><!-- /widget -->				  	

<!--modal for delete -->
<div id="deleteModal" style="overflow-y: hidden;"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	{{ Form::open(array('url'=>$url_delete, 'class'=>'form-horizontal', 'role'=>'form', 'method' => 'post')) }}
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="myModalLabel">Delete Users</h3>
	</div>
	<div class="modal-body">
		<fieldset>
			<div class="control-group">											
				<label class="control-label" for="delete_list">Username:</label>
				<div class="controls">
					<div id="delete_list" style="margin-top: 3px;"></div>
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->
		</fieldset>
		<font color="#ff1d00">
			<b>Please take note that once you delete any users all his comments, registration records, certificates, or even skills map will be deleted as well for good.</b>
		</font>
	</div>
	<div class="modal-footer" style="margin-bottom: -16px; ">
		<button class="btn btn-primary" id="btn-delete" type="submit">Submit</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
	</div>
	{{ Form::close() }}
</div>
<!-- end of modal for delete -->

<!--modal for password -->
<div id="passwordModal" style="overflow-y: hidden;"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	{{ Form::open(array('url'=>$url_change_password, 'class'=>'form-horizontal', 'role'=>'form', 'method' => 'post')) }}
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="myModalLabel">Change Password</h3>
	</div>
	<div class="modal-body">
		<fieldset>
			<div class="control-group">											
				<label class="control-label" for="pw_list">Username:</label>
				<div class="controls">
					<div id="pw_list" style="margin-top: 3px;"></div>
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->
		</fieldset>
		<span style="font-size: 11px;">
			*Password will be sent to the primary email address.
		</span>		
	</div>
	<div class="modal-footer" style="margin-bottom: -16px; ">
		<button class="btn btn-primary" id="btn-password" type="submit">Submit</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
	</div>
	{{ Form::hidden('id', '', array('id' => 'pw_id')) }}
	{{ Form::close() }}
</div>
<!-- end of modal for password -->

<script type="text/javascript"><!--
$(document).ready(function() {
	// Submit Form
    $('#submitForm').click(function() {
    	$('#form-users').submit();
    });
    
    $('#form-users input').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#form-users').submit();
		}
	});
	
	// Clear Form
    $('#clearForm').click(function() {
    	location.href = "{{ URL::to('admin/users') }}";
    });
    
    // Delete
    $('#confirmDelete').click(function() {
    	var count = $("[name='selected[]']:checked").length;
		
		if (count>0) {
			var items = new Array();
			var del_items = '';
			
			$("[name='selected[]']:checked").each(function() {
				items.push($(this).data('name'));
				del_items += '<input type="hidden" name="selected[]" value="'+ $(this).val() +'" />';
			});
			
			$('#delete_list').html(items.join('<br />') + del_items);
		} else {
			alert('Please select users.');
			return false;
		}
    });
    
    // Change Password
    $('.changePassword').click(function() {
    	$('#pw_list').html($(this).data('name'));
    	$('#pw_id').val($(this).data('id'));
	});
 
	$('.checkbox').click(function() {
		if (!$(this).is(':checked')) {
			$('#main_checkbox').attr('checked', false);
		}
	});
});
//--></script> 