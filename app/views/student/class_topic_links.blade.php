{{ $header }}

<div class="tab-content">
	<div class="tab-pane active" id="topics">
		<div class="row">
	    	<div class="col-sm-12">
	    		<div align="left">
	    			<a href="{{ $url_back }}" class="btn btn-primary" title="Back to List">Back to List</a>
	    		</div>	    							    			   
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<br />				
				{{ @(isset($all_links) ? $all_links : 'No results found.') }}
			</div>
		</div>
	</div>
</div>