<ol class="breadcrumb">
	@foreach ($breadcrumbs as $breadcrumb)
		<li class="{{ $breadcrumb['class'] }}"><a href="{{ $breadcrumb['href'] }}">{{ $breadcrumb['text'] }}</a></li>
   	@endforeach
</ol>

{{ Form::open(array('url'=>$url_search, 'class'=>'form', 'id'=>'form-manage-subject', 'role'=>'form', 'method' => 'get')) }}
<div class="widget-content">
	<div class="span3 search-span">
		<div class="search-div">
			<div class="search-label">Subject:</div>
			<div class="search-field">
				{{ Form::select('filter_subject', $subject_options, $filter_subject, array('id' => 'filter_subject', 'class' => 'select-width')) }}
			</div>
		</div>	
	</div>
	<div class="span3 search-span">
		<div class="search-div">
			<div class="search-label">Sections:</div>
			<div class="search-field">
				{{ Form::select('filter_section', $section_options, $filter_section, array('id' => 'filter_section', 'class' => 'select-width')) }}
			</div>
		</div>
	</div>
	<div class="span3 search-span">
		<div class="search-div">
			<div class="search-label">Group Code:</div>
			<div class="search-field">
				{{ Form::text('filter_group_code', $filter_group_code, array('id'=>'filter_group_code', 'placeholder'=>'', 'maxlength'=>'100', 'style'=>'width: 150px;')) }}
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
	<a href="{{ $url_insert }}" class="btn btn-primary">Add New Section Assignment</a>
    <a href="#deleteModal" data-toggle="modal" class="btn btn-primary" id="confirmDelete">Delete Section Assignments</a>
</div>

<div class="widget">
	<div class="widget-header">
		<i class="icon-list-alt"></i>
		<h3>Sections</h3>
		<span class="pagination-totalItems">Total: {{ $subjects_total }}</span>
	</div><!-- /widget-header -->

	<div class="widget-content">
		<div class="table-responsive">
		<table class="table table-condensed table-hover table-striped">
			<thead>
				<tr>
					<th class="align-center" style="width: 20px;"><input type="checkbox" id="main_checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></th>
					<th>
						<a href="{{ $sort_subject }}" class="@if ($sort=='subject') {{ strtolower($order) }} @endif">Subject</a>
					</th>
					<th>
						Section / Sem / S.Y.
					</th>
					<th>
						<a href="{{ $sort_group_code }}" class="@if ($sort=='group_code') {{ strtolower($order) }} @endif">Group Code</a>
					</th>
				</tr>
			</thead>
			
			<tbody>
				@if( CommonHelper::arrayHasValue($subjects) ) 
 				@foreach ($subjects as $subject)
				<tr>
					<td class="align-center">
						<input type="checkbox" class="checkbox" name="selected[]" value="{{ $subject->sub_sec_id }}" data-name="{{ $subject->code }} - {{ $subject->section_code }}" />
					</td>
					<td>{{ htmlentities($subject->code) }} - {{ htmlentities($subject->name) }}</td>
					<td>
						{{ htmlentities($subject->section_code) }}<br />
						<em>											
							{{ htmlentities($subject->sem_name) }} / S.Y. {{ htmlentities($subject->school_year_from) }} - {{ htmlentities($subject->school_year_to) }}
						</em>
					</td>
					<td>{{ htmlentities($subject->group_code) }}</td>
				</tr>
				@endforeach
				@else
				<tr>
					<td colspan="4" class="align-center" style="padding: 10px;">Empty Results</td>
				</tr>
				@endif
			</tbody>
        </table>
        </div>
        
        @if( CommonHelper::arrayHasValue($subjects) ) 
	    <h6 class="paginate">
			<span>{{ $subjects->appends($arrFilters)->links() }}</span>
		</h6>
		@endif
	</div><!-- /widget-content --> 
</div><!-- /widget -->				  	

<!--modal for delete -->
<div id="deleteModal" style="overflow-y: hidden;"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	{{ Form::open(array('url'=>$url_delete, 'class'=>'form-horizontal', 'role'=>'form', 'method' => 'post')) }}
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="myModalLabel">Delete Section Assignments</h3>
	</div>
	<div class="modal-body">
		<fieldset>
			<div class="control-group">											
				<label class="control-label" for="delete_list">Subject-Section:</label>
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
	// Submit Form
    $('#submitForm').click(function() {
    	$('#form-manage-subject').submit();
    });
    
    $('#form-manage-subject input').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#form-manage-subject').submit();
		}
	});
	
	// Clear Form
    $('#clearForm').click(function() {
    	location.href = "{{ URL::to('admin/manage_subject') }}";
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
			alert('Please select section assignments.');
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