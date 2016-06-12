<ol class="breadcrumb">
	@foreach ($breadcrumbs as $breadcrumb)
		<li class="{{ $breadcrumb['class'] }}"><a href="{{ $breadcrumb['href'] }}">{{ $breadcrumb['text'] }}</a></li>
   	@endforeach
</ol>

{{ Form::open(array('url'=>$url_search, 'class'=>'form', 'id'=>'form-manage-faculty', 'role'=>'form', 'method' => 'get')) }}
<div class="widget-content">
	<div class="span3 search-span">
		<div class="search-div">
			<div class="search-label">Faculty:</div>
			<div class="search-field">
				{{ Form::select('filter_faculty', $faculty_options, $filter_faculty, array('id' => 'filter_faculty', 'class' => 'select-width')) }}
			</div>
		</div>	
	</div>
	<div class="span3 search-span">
		<div class="search-div">
			<div class="search-label">Subject:</div>
			<div class="search-field">
				{{ Form::select('filter_subject', $subject_options, $filter_subject, array('id' => 'filter_subject', 'class' => 'select-width')) }}
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
	<a href="{{ $url_insert }}" class="btn btn-primary">Add New Subject Assignment</a>
    <a href="#deleteModal" data-toggle="modal" class="btn btn-primary" id="confirmDelete">Delete Subject Assignments</a>
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
						<a href="{{ $sort_faculty }}" class="@if ($sort=='faculty') {{ strtolower($order) }} @endif">Faculty</a>
					</th>
					<th>
						<a href="{{ $sort_subject }}" class="@if ($sort=='subject') {{ strtolower($order) }} @endif">Subject</a>
					</th>
				</tr>
			</thead>
			
			<tbody>
				@if( CommonHelper::arrayHasValue($subjects) ) 
 				@foreach ($subjects as $subject)
				<tr>
					<td class="align-center">
						<input type="checkbox" class="checkbox" name="selected[]" value="{{ $subject->id }}" data-name="{{ $subject->first_name }} {{ $subject->last_name }} - {{ $subject->subject_code }} / {{ $subject->section_code }}" />
					</td>
					<td>{{ htmlentities($subject->first_name) }} {{ htmlentities($subject->last_name) }}</td>
					<td>
						{{ htmlentities($subject->subject_code) }} - {{ htmlentities($subject->subject_name) }}<br />
						<em>				
							{{ htmlentities($subject->section_code) }}
							/		
							{{ htmlentities($subject->sem_name) }}
							/
							{{ htmlentities($subject->school_year_from) }} - {{ htmlentities($subject->school_year_to) }}
						</em>
					</td>
				</tr>
				@endforeach
				@else
				<tr>
					<td colspan="3" class="align-center" style="padding: 10px;">Empty Results</td>
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
		<h3 id="myModalLabel">Delete Subject Assignments</h3>
	</div>
	<div class="modal-body">
		<fieldset>
			<div class="control-group">											
				<label class="control-label" for="delete_list">Faculty-Subject:</label>
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
    	$('#form-manage-faculty').submit();
    });
    
    $('#form-manage-faculty input').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#form-manage-faculty').submit();
		}
	});
	
	// Clear Form
    $('#clearForm').click(function() {
    	location.href = "{{ URL::to('admin/manage_faculty') }}";
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
			alert('Please select subject assignments.');
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