<ol class="breadcrumb">
	@foreach ($breadcrumbs as $breadcrumb)
		<li class="{{ $breadcrumb['class'] }}"><a href="{{ $breadcrumb['href'] }}">{{ $breadcrumb['text'] }}</a></li>
   	@endforeach
</ol>

@if( CommonHelper::arrayHasValue($error_date) )
    <div class="alert alert-error">
    	<button class="close" data-dismiss="alert" type="button">&times;</button>
    	{{ $error_date }}
    </div>
@endif

{{ Form::open(array('url'=>$url_search, 'class'=>'form', 'id'=>'form-sections', 'role'=>'form', 'method' => 'get')) }}
<div class="widget-content">
	<div class="span3 search-span">
		<div class="search-div">
			<div class="search-label">Code:</div>
			<div class="search-field">
				{{ Form::text('filter_code', $filter_code, array('id'=>'filter_code', 'placeholder'=>'', 'maxlength'=>'50', 'style'=>'width: 150px;')) }}
			</div>
		</div>	

		<div class="search-div" style="display: none;">
			<div class="search-label">Name:</div>
			<div class="search-field">
				{{ Form::text('filter_name', $filter_name, array('id'=>'filter_name', 'placeholder'=>'', 'maxlength'=>'100', 'style'=>'width: 150px;')) }}
			</div>
		</div>	
	</div>
	<div class="span3 search-span">
		<div class="search-div">
			<div class="search-label">School Year:</div>
			<div class="search-field">
				{{ Form::text('filter_date_from', $filter_date_from, array('id'=>'filter_date_from', 'class'=>'date', 'style'=>'width: 75px;')) }}&nbsp;&nbsp;-&nbsp;&nbsp;
				{{ Form::text('filter_date_to', $filter_date_to, array('id'=>'filter_date_to', 'class'=>'date', 'style'=>'width: 75px;')) }}
			</div>
		</div>
	</div>
	<div class="span3 search-span">
		<div class="search-div">
			<div class="search-label">Semester:</div>
			<div class="search-field">
				{{ Form::select('filter_semester', $semester_options, $filter_semester, array('id' => 'filter_semester', 'class' => 'select-width')) }}
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
{{ Form::hidden('sort', $sort) }}
{{ Form::hidden('order', $order) }}

{{ Form::close() }}

<div align="left" style="padding-bottom: 15px;">
	<a href="{{ $url_insert }}" class="btn btn-primary">Add New Section</a>
    <a href="#deleteModal" data-toggle="modal" class="btn btn-primary" id="confirmDelete">Delete Sections</a>
</div>

<div class="widget">
	<div class="widget-header">
		<i class="icon-th-large"></i>
		<h3>Sections</h3>
		<span class="pagination-totalItems">Total: {{ $sections_total }}</span>
	</div><!-- /widget-header -->

	<div class="widget-content">
		<div class="table-responsive">
		<table class="table table-condensed table-hover table-striped">
			<thead>
				<tr>
					<th class="align-center" style="width: 20px;"><input type="checkbox" id="main_checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></th>
					<th>
						<a href="{{ $sort_code }}" class="@if ($sort=='code') {{ strtolower($order) }} @endif">Code</a>
					</th>					
					<th>
						<a href="{{ $sort_school_year }}" class="@if ($sort=='school_year_from') {{ strtolower($order) }} @endif">School Year</a>
					</th>
					<th>
						<a href="{{ $sort_semester }}" class="@if ($sort=='semester') {{ strtolower($order) }} @endif">Semester</a>
					</th>
					<th>Action</th>
				</tr>
			</thead>
			
			<tbody>
				@if( CommonHelper::arrayHasValue($sections) ) 
 				@foreach ($sections as $section)
				<tr>
					<td class="align-center">
						<input type="checkbox" class="checkbox" name="selected[]" value="{{ $section->id }}" data-name="{{ $section->code }}" />
					</td>
					<td>{{ htmlentities($section->code) }}</td>					
					<td>{{ htmlentities($section->school_year_from) }} - {{ htmlentities($section->school_year_to) }}</td>
					<td>
						{{ htmlentities($section->sem_name) }}
					</td>
					<td>
						<a href="{{ $url_update . '&id=' . $section->id }}" title="Update">[ Update ]</a>
                    </td>
				</tr>
				@endforeach
				@else
				<tr>
					<td colspan="6" class="align-center" style="padding: 10px;">Empty Results</td>
				</tr>
				@endif
			</tbody>
        </table>
        </div>
        
        @if( CommonHelper::arrayHasValue($sections) ) 
	    <h6 class="paginate">
			<span>{{ $sections->appends($arrFilters)->links() }}</span>
		</h6>
		@endif
	</div><!-- /widget-content --> 
</div><!-- /widget -->				  	

<!--modal for delete -->
<div id="deleteModal" style="overflow-y: hidden;"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	{{ Form::open(array('url'=>$url_delete, 'class'=>'form-horizontal', 'role'=>'form', 'method' => 'post')) }}
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="myModalLabel">Delete Sections</h3>
	</div>
	<div class="modal-body">
		<fieldset>
			<div class="control-group">											
				<label class="control-label" for="delete_list">Code:</label>
				<div class="controls">
					<div id="delete_list" style="margin-top: 3px;"></div>
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->
		</fieldset>
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
	$(".date").datepicker( {
	    format: "yyyy",
	    viewMode: "years", 
	    minViewMode: "years"
	});

	// Submit Form
    $('#submitForm').click(function() {
    	$('#form-sections').submit();
    });
    
    $('#form-sections input').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#form-sections').submit();
		}
	});
	
	// Clear Form
    $('#clearForm').click(function() {
    	location.href = "{{ URL::to('admin/sections') }}";
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
			alert('Please select sections.');
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