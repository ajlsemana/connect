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
					<div class="search-label">Training Courses:</div>
					<div class="search-field">
						{{ Form::select('filter_courses', $course_options, $filter_courses, array('id' => 'filter_courses', 'class' => 'select-width')) }}						
					</div>					
				</div>
				<div class="search-div">
					<div class="search-label">Attendance Status:</div>
					<div class="search-field">
						{{ Form::select('filter_status', $status_options, $filter_status, array('id' => 'filter_status', 'class' => 'select-width')) }}
					</div>
				</div>													
			</div>
			<div class="span3 search-span">
				<!--<div class="search-div">
					<div class="search-label">Company:</div>
					<div class="search-field">									
						{{ Form::select('filter_company', $company_options, $filter_company, array('id' => 'filter_company', 'class' => 'select-width')) }}
					</div>
				</div>-->
				<div class="search-div">
					<div class="search-label">First Name:</div>
					<div class="search-field">
						{{ Form::text('filter_first_name', $filter_first_name, array('id'=>'filter_first_name', 'placeholder'=>'', 'maxlength'=>'100', 'style'=>'width: 150px;')) }}
					</div>
				</div>												
			</div>
			<div class="span3 search-span">
				<div class="search-div">
					<div class="search-label">Last Name:</div>
					<div class="search-field">
						{{ Form::text('filter_last_name', $filter_last_name, array('id'=>'filter_last_name', 'placeholder'=>'', 'maxlength'=>'100', 'style'=>'width: 150px;')) }}
					</div>
				</div>								
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

@if(Auth::user()->username == 'mich' || Auth::user()->username == 'ahmer')
<div align="left" style="padding-bottom: 15px;">
	<a href="{{ $url_insert }}" class="btn btn-primary">Add New Attendee</a>	
    <!--<a href="#deleteModal" data-toggle="modal" class="btn btn-primary" id="confirmDelete">Delete Attendees</a>
    <a href="#" class="btn btn-primary"><i id="export" title="export table" class="icon-large icon-share"></i></a>-->
</div>
@endif

<div class="widget">
	<div class="widget-header">
		<i class="icon-user"></i>
		<h3>Attendees</h3>
		<span class="pagination-totalItems">Total: {{ $users_total }}</span>
	</div><!-- /widget-header -->

	<div class="widget-content">
		<div id="div-reports" class="table-responsive">
		<table id="tbl-reports" class="table table-condensed table-hover table-striped">
			<thead>
				<tr>
					<!--<th class="align-center" style="width: 20px;"><input type="checkbox" id="main_checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></th>-->
					<th>
						<a href="{{ $sort_first_name }}" class="@if ($sort=='first_name') {{ strtolower($order) }} @endif">Full Name</a>
					</th>
					<th>
						<a href="{{ $sort_company }}" class="@if ($sort=='company') {{ strtolower($order) }} @endif">Company</a>
					</th>
					<th>
						<a href="{{ $sort_primary_email }}" class="@if ($sort=='email') {{ strtolower($order) }} @endif">Email</a>
					</th>	
					<th>
						Contact No.
					</th>
					<th>
						Profile
					</th>
					<th>
						<a href="{{ $sort_courses }}" class="@if ($sort=='course') {{ strtolower($order) }} @endif">Training Course</a>
					</th>
					<th>
						Schedules
					</th>
					<th>
						<a href="{{ $sort_status }}" class="@if ($sort=='attendance_status') {{ strtolower($order) }} @endif">Status</a>
					</th>															
					<th>Action</th>					
				</tr>
			</thead>
			
			<tbody>
				@if( CommonHelper::arrayHasValue($users) ) 
 				@foreach ($users as $user)
				<tr align="center">
					<!--<td class="align-center">
						<input type="checkbox" class="checkbox" name="selected[]" value="{{ $user->id }}" data-name="{{ $user->id }}" />
					</td>-->		
					<!--{{ URL::to('admin/attendees/temp-listings-info/'.$user->id) }}-->							
					<td><a href="{{ $url_update . '&id=' . $user->rid }}" title="view or update">{{ wordwrap($user->first_name.' '.$user->last_name, 100, "<br />\n", true) }}</a></td>
					<td>{{ (array_key_exists($user->company, $company) ? $company[$user->company] : $user->company) }}</td>
					<td>{{ $user->primary_email_address }} <input type="hidden" value="{{ $user->primary_email_address }}" id="email-{{ $user->id }}"></td>					
					<td>{{ $user->contact_number }}</td>
					<td>{{ ($user->profiling ? '<i class="icon-large icon-check"></i>' : '<i class="icon-large icon-remove"></i>') }}</td>											
					<td>{{ strtoupper($user->name) }}</td>	
					<?php
						$date_from = substr(date('d M Y', strtotime($user->date_from)), 3);
						$date_to = substr(date('d M Y', strtotime($user->date_to)), 3);
						$training_date = date('d M Y', strtotime($user->date_from)).' - '.date('d M Y', strtotime($user->date_to));
						if($date_from == $date_to) {
							$training_date = substr(date('d M Y', strtotime($user->date_from)), 0, 2).' - '.date('d M Y', strtotime($user->date_to));
						}
					?>		
					<td>{{ strtoupper($training_date) }}</td>			
					<td><span style="font-weight: 900; color: #0052A1;">{{ strtoupper(($user->status == 0 ? 'CONFIRMED <font color="#ff0000" size="1">(ENDED)</font>' : ($user->change_status == '' ? 'New' : $user->change_status))) }}</span></td>                  
					<td>
						<a href="{{ $url_update . '&id=' . $user->rid }}" title="view or update"><i class="icon-large icon-edit"></i></a>                    	
						<a href="{{ $url_upload_cert . '&id=' . $user->rid }}" title="upload certificate"><i class="icon-large icon-certificate"></i></a>
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

<div id="deleteModal" style="overflow-y: hidden;"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	{{ Form::open(array('url'=>$url_delete, 'class'=>'form-horizontal', 'role'=>'form', 'method' => 'post')) }}
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="myModalLabel">Delete Training Attendees</h3>
	</div>
	<div class="modal-body">
		Are you sure you want to delete all checked items?
		<div id="delete_list" style="display: none;"></div>
	</div>
	<div class="modal-footer" style="margin-bottom: -16px; ">
		<button class="btn btn-primary" id="btn-delete" type="submit">Submit</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
	</div>
	{{ Form::close() }}
</div>
<!-- end of modal for delete -->

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
	
	$("#export").click(function (e) {
	    alert('Export: Under construction...');
	});

	// Clear Form
    $('#clearForm').click(function() {
    	location.href = "{{ URL::to('admin/attendees') }}";
    });
    
    // Delete
    // Delete
    $('#confirmDelete').click(function() {
    	var count = $("[name='selected[]']:checked").length;
		
		if (count > 0) {
			var items = new Array();
			var del_items = '';
			
			$("[name='selected[]']:checked").each(function() {
				items.push($(this).data('name'));
				del_items += '<input type="hidden" name="selected[]" value="'+ $(this).val() +'" />';
			});
			
			$('#delete_list').html(items.join('<br />') + del_items);
		} else {
			alert('Please select attendees.');
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