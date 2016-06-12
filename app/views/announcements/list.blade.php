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

{{ Form::open(array('url'=>$url_search, 'class'=>'form', 'id'=>'form-announcements', 'role'=>'form', 'method' => 'get')) }}
<div class="widget">
	<div class="widget-header">
		<div class="widget-content">
			<div class="span3 search-span">
				<div class="search-div">
					<div class="search-label">Title:</div>
					<div class="search-field">
						{{ Form::text('filter_title', $filter_title, array('id'=>'filter_title', 'placeholder'=>'', 'maxlength'=>'255', 'style'=>'width: 150px;')) }}
					</div>
				</div>	
			</div>
			<div class="span3 search-span">
				<div class="search-div">
					<!--<div class="search-label">Date:</div>
					<div class="search-field">
						{{ Form::text('filter_date_from', $filter_date_from, array('id'=>'filter_date_from', 'class'=>'date', 'style'=>'width: 75px;')) }}&nbsp;&nbsp;-&nbsp;&nbsp;
						{{ Form::text('filter_date_to', $filter_date_to, array('id'=>'filter_date_to', 'class'=>'date', 'style'=>'width: 75px;')) }}
					</div>-->
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
{{ Form::hidden('sort', $sort) }}
{{ Form::hidden('order', $order) }}

{{ Form::close() }}

<div align="left" style="padding-bottom: 15px;">
	<a href="{{ $url_insert }}" class="btn btn-primary">Add New Announcement</a>
    <a href="#deleteModal" data-toggle="modal" class="btn btn-primary" id="confirmDelete">Delete Announcements</a>
</div>

<div class="widget">
	<div class="widget-header">
		<i class="icon-bullhorn"></i>
		<h3>Announcements</h3>
		<span class="pagination-totalItems">Total: {{ $announcements_total }}</span>
	</div><!-- /widget-header -->

	<div class="widget-content">
		<div class="table-responsive">
		<table class="table table-condensed table-hover table-striped">
			<thead>
				<tr>
					<th class="align-center" style="width: 20px;"><input type="checkbox" id="main_checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></th>
					<th>
						<a href="{{ $sort_title }}" class="@if ($sort=='title') {{ strtolower($order) }} @endif">Title</a>
					</th>
					<th>
						<a href="{{ $sort_date_from }}" class="@if ($sort=='date_from') {{ strtolower($order) }} @endif">Date</a>
					</th>
					<th>
						Description
					</th>
					<th>Action</th>
				</tr>
			</thead>
			
			<tbody>
				@if( CommonHelper::arrayHasValue($announcements) ) 
 				@foreach ($announcements as $announcement)
				<tr align="center">
					<td class="align-center">
						<input type="checkbox" class="checkbox" name="selected[]" value="{{ $announcement->id }}" data-name="{{ $announcement->title }}" />
					</td>
					<td><a href="{{ $url_update . '&id=' . $announcement->id }}" title="view or update">{{ htmlentities($announcement->title) }}</a></td>
					<td>{{ date('d F Y', strtotime($announcement->date_from)) }} to {{ date('d F Y', strtotime($announcement->date_to)) }}</td>
					<td>{{ wordwrap(htmlentities($announcement->content), 60,'<br />') }}</td>
					<td>
						<a href="{{ $url_update . '&id=' . $announcement->id }}" title="Update"><i class="icon-edit"></i></a>
                    </td>
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
        
        @if( CommonHelper::arrayHasValue($announcements) ) 
	    <h6 class="paginate">
			<span>{{ $announcements->appends($arrFilters)->links() }}</span>
		</h6>
		@endif
	</div><!-- /widget-content --> 
</div><!-- /widget -->				  	

<!--modal for delete -->
<div id="deleteModal" style="overflow-y: hidden;"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	{{ Form::open(array('url'=>$url_delete, 'class'=>'form-horizontal', 'role'=>'form', 'method' => 'post')) }}
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="myModalLabel">Delete Announcements</h3>
	</div>
	<div class="modal-body">
		<fieldset>
			<div class="control-group">											
				<label class="control-label" for="delete_list">Title:</label>
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
	$('.date').datepicker({
      format: 'yyyy-mm-dd'
    });

	// Submit Form
    $('#submitForm').click(function() {
    	$('#form-announcements').submit();
    });
    
    $('#form-announcements input').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#form-announcements').submit();
		}
	});
	
	// Clear Form
    $('#clearForm').click(function() {
    	location.href = "{{ URL::to('admin/announcements') }}";
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
			alert('Please select announcements.');
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