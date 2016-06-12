<ol class="breadcrumb">
	@foreach ($breadcrumbs as $breadcrumb)
		<li class="{{ $breadcrumb['class'] }}"><a href="{{ $breadcrumb['href'] }}">{{ $breadcrumb['text'] }}</a></li>
   	@endforeach
</ol>

{{ Form::open(array('url'=>$url_search, 'class'=>'form', 'id'=>'form-subjects', 'role'=>'form', 'method' => 'get')) }}
<div class="widget">
	<div class="widget-header">
		<div class="widget-content">
			<div class="span3 search-span">
				<div class="search-div">
					<div class="search-label">Course Name:</div>
					<div class="search-field">
						{{ Form::text('filter_name', $filter_name, array('id'=>'filter_name', 'placeholder'=>'', 'maxlength'=>'100', 'style'=>'width: 150px;')) }}
					</div>
				</div>	
			</div>
			<div class="span3 search-span">
				
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
<?php
	$status_array = array('Ended', 'Open');
?>
{{ Form::hidden('sort', $sort) }}
{{ Form::hidden('order', $order) }}

{{ Form::close() }}

<div align="left" style="padding-bottom: 15px;">
	<a href="{{ $url_insert }}" class="btn btn-primary">Add New Course</a>
    <a href="#deleteModal" data-toggle="modal" class="btn btn-primary" id="confirmDelete">Delete Courses</a>
</div>

<div class="widget">
	<div class="widget-header">
		<i class="icon-list-alt"></i>
		<h3>Training Courses</h3>
		<span class="pagination-totalItems">Total: {{ $course_total }}</span>
	</div><!-- /widget-header -->

	<div class="widget-content">
		<div class="table-responsive">
		<table class="table table-condensed table-hover table-striped">
			<thead>
				<tr>
					<th class="align-center" style="width: 20px;"><input type="checkbox" id="main_checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></th>
					<th>
						<a href="{{ $sort_name }}" class="@if ($sort=='name') {{ strtolower($order) }} @endif">Course Name</a>
					</th>					
					<th>Dates</th>
					<th>Duration</th>
					<th>Time</th>	
					<th>Status</th>					
					<th>Action</th>
				</tr>
			</thead>
			
			<tbody>
				@if( CommonHelper::arrayHasValue($courses) ) 
 				@foreach ($courses as $course)
				<tr align="center">
					<td class="align-center">
						<input type="checkbox" class="checkbox" name="selected[]" value="{{ $course->id }}" data-name="{{ $course->id }}" />
					</td>
					<td><a href="{{ $url_update . '&id=' . $course->id }}" title="View or Update">{{ htmlentities($course->name) }}</a></td>					
					<td>{{ htmlentities(date('d F Y', strtotime($course->date_from)).' up to '.date('d F Y', strtotime($course->date_to))) }}</td>
					<td>{{ htmlentities($course->duration) }} days</td>
					<td>{{ htmlentities($course->time) }}</td>
					<td>{{ htmlentities($status_array[$course->status]) }}</td>
					<td>
						<a href="{{ $url_update . '&id=' . $course->id }}" title="View or Update"><i class="icon-edit"></i></a>
						<a href="{{ URL::to('admin/training-courses/add-activity?id='.$course->id) }}" title="Calendar"><i class="icon-calendar"></i></a>
                    </td>
				</tr>
				@endforeach
				@else
				<tr>
					<td colspan="8" class="align-center" style="padding: 10px;">Empty Results</td>
				</tr>
				@endif
			</tbody>
        </table>
        </div>
        
        @if( CommonHelper::arrayHasValue($courses) ) 
	    <h6 class="paginate">
			<span>{{ $courses->appends($arrFilters)->links() }}</span>
		</h6>
		@endif
	</div><!-- /widget-content --> 
</div><!-- /widget -->				  	

<!--modal for delete -->
<div id="deleteModal" style="overflow-y: hidden;"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	{{ Form::open(array('url'=>$url_delete, 'class'=>'form-horizontal', 'role'=>'form', 'method' => 'post')) }}
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="myModalLabel">Delete Training Courses</h3>
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
    	$('#form-subjects').submit();
    });
    
    $('#form-subjects input').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#form-subjects').submit();
		}
	});
	
	// Clear Form
    $('#clearForm').click(function() {
    	location.href = "{{ URL::to('admin/training-courses') }}";
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
			alert('Please select training courses.');
			return false;
		}
    });
     
	$('.checkbox').click(function() {
		if (!$(this).is(':checked')) {
			$('#main_checkbox').attr('checked', false);
		}
	});
});
//--></script> 