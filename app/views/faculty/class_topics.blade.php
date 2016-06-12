{{ $header }}

<div class="tab-content">
	<div class="tab-pane active" id="topics">
		<div class="row">
	    	<div class="col-sm-12">
	    		<div align="left">
	    			<a href="{{ $url_insert }}" class="btn btn-primary" title="Add New Topic">Add New Topic</a>
	    		</div>
	    		<br />

				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>
									<a href="{{ $sort_topics }}" class="@if ($sort=='topic_name') {{ strtolower($order) }} @endif">Topics</a>
								</th>
								<th>
									<a href="{{ $sort_week_from }}" class="@if ($sort=='week_from') {{ strtolower($order) }} @endif">Week From</a>
								</th>
								<th>
									<a href="{{ $sort_week_to }}" class="@if ($sort=='week_to') {{ strtolower($order) }} @endif">Week To</a>
								</th>
								<th>
									<a href="{{ $sort_search_query }}" class="@if ($sort=='search_query') {{ strtolower($order) }} @endif">Search Query</a>
								</th>
								<th>
									Links
								</th>																
								<th>Action</th>
							</tr>
						</thead>
						
						<tbody>
							@if( CommonHelper::arrayHasValue($topics) ) 
			 				@foreach ($topics as $topic_value)
							<tr>
								<td>{{ $topic_value->topic_name }}</td>
								<td>{{ $topic_value->week_from }}</td>								
								<td>{{ ($topic_value->week_to == $topic_value->week_from ? 'n/a': $topic_value->week_to) }}</td>
								<td>{{ $topic_value->search_query }}</td>
								<td>																		
									<a href="{{ $url_class . '/topics/getLinks?id='.urlencode($topic_value->id).'&search_qry='.urlencode($topic_value->search_query) }}" title="see related links">See Related Links...</a>
								</td>					
								<td>
									<a data-toggle="modal" data-target="#viewModal" data-id="{{ $topic_value->id }}" class="view glyphicon glyphicon-search" style="cursor: pointer;" title="View Details"></a>&nbsp;								
									<a href="{{ $url_class . '/topics/update?id=' . $topic_value->id }}" class="glyphicon glyphicon-pencil" title="Edit"></a>&nbsp;
									<a href="#" data-id="{{ $topic_value->id }}" class="delete glyphicon glyphicon-trash" title="Delete"></a>&nbsp;&nbsp;																		
								</td>
							</tr>
							<input type="hidden" value="{{ htmlspecialchars($topic_value->search_query) }}" id="h-search-{{ $topic_value->id }}" />
							@endforeach
							@else
							<tr>
								<td colspan="5" class="align-center" style="padding: 10px;">Empty Results</td>
							</tr>
							@endif
						</tbody>
					</table>
				</div>

				@if( CommonHelper::arrayHasValue($topics) ) 
			    <h6 class="paginate">
					<span>{{ $topics->appends($arrFilters)->links() }}</span>
				</h6>
				@endif
			</div>
		</div>
	</div>
</div>

<!--modal for view -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Topic Detail</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(array('url'=>'', 'class'=>'form-horizontal', 'role'=>'form', 'method' => 'post')) }}
		<div class="form-group">
			<label for="Topic" class="col-sm-4 control-label">Topic:</label>
			<div class="col-sm-7 modal_details" id="d_topic"></div>
		</div>

		<div class="form-group">
			<label for="week_from" class="col-sm-4 control-label">Week From:</label>
			<div class="col-sm-7 modal_details" id="d_from"></div>
		</div>

		<div class="form-group">
			<label for="week_to" class="col-sm-4 control-label">Week To:</label>
			<div class="col-sm-7 modal_details" id="d_to"></div>
		</div>

		<div class="form-group">
			<label for="search_query" class="col-sm-4 control-label">Search Query:</label>
			<div class="col-sm-7 modal_details" id="d_search"></div>
		</div>			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!--modal for view search-->
<div class="modal fade" id="viewModalSearch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Related Links</h4>
      </div> 
      <div class="form-group">			
			<div class="col-sm-7 modal_details" id="d_links"></div>
		</div>     
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
{{ Form::close() }}
<!-- end of modal for view -->

<script type="text/javascript">
$(document).ready(function() {
	$(function () {
	    $('#myTab').tab();
	})

	// Delete
	$('.delete').click(function() {
		if (confirm('Delete Topic?')) {
			var id = $(this).data('id');

			location.href = "{{ $url_class . '/topics/delete?id=' }}" + id;
		} else {
			return false;
		}
	});

	// View
    $('.view').click(function() {
    	$('#d_topic').html('');
    	$('#d_search').html('');    
    	
    	$.ajax({
			url: '{{ $url_class . '/topics/getDetails' }}',
			type: 'GET',
			dataType: 'json',
			data: 'id=' + $(this).data('id'),
			beforeSend: function() {
			},
			success: function(output_string) {
				if (output_string) {					
					var to = output_string.week_to;					
					$('#d_topic').html(output_string.topic_name);
					$('#d_from').html(output_string.week_from);
					
					if(output_string.week_to == output_string.week_from) {
						to = 'n/a';
					}

					$('#d_to').html(to);
			    	$('#d_search').html(output_string.search_query);			    	
				} else {
					location.href = '{{ $url_class . '/topics' }}';
				}
			},
			error: function() {
				location.href = '{{ $url_class . '/topics' }}';
			}
		}); 
	});

	// View
    $('.viewSearch_').click(function() {
    	var id = $(this).attr('data-id');
    	var search_qry = $('#h-search-'+id).val();
    	$('#d_links').html('');    	
    	
    	$.ajax({
			url: '{{ $url_class . '/topics/getLinks' }}',
			type: 'GET',
			dataType: 'json',
			data: 'id=' + id + '&search_qry=' + search_qry,
			beforeSend: function() {
			},
			success: function(output_string) {
				console.log('Trap: '+output_string);
				if (output_string) {					
					$('#d_links').html(output_string.rel_links);												   
				} else {
					//location.href = '{{ $url_class . '/topics' }}';
				}
			},
			error: function() {
				//location.href = '{{ $url_class . '/topics' }}';
			}
		}); 
	});
});
</script>