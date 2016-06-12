<ol class="breadcrumb">
   @foreach ($breadcrumbs as $breadcrumb)
   <li class="{{ $breadcrumb['class'] }}"><a href="{{ $breadcrumb['href'] }}">{{ $breadcrumb['text'] }}</a></li>
   @endforeach
</ol>
{{ Form::open(array('url'=>$url_search, 'class'=>'form', 'id'=>'form-announcements', 'role'=>'form', 'method' => 'get')) }}
<div class="widget">
   <div class="widget-header">
      <div class="widget-content">
         <div class="span3 search-span">
            <div class="search-div">
               <div class="search-label">Service Provider:</div>
               <div class="search-field">
					{{ Form::select('filter_company', $company_options, $filter_company, array('id' => 'filter_company', 'class' => 'select-width')) }}						
                  <!--{{ Form::text('filter_company', $filter_company , array('id'=>'filter_company ', 'placeholder'=>'', 'maxlength'=>'255', 'style'=>'width: 150px;')) }}-->
               </div>
            </div>
         </div>
         <div class="span3 search-span">
            <div class="search-div">					
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
   <a href="{{ $url_insert }}" class="btn btn-primary">Add New Service Provider</a>
   <a href="#deleteModal" data-toggle="modal" class="btn btn-primary" id="confirmDelete">Delete Service Providers</a>
</div>
<div class="row">
   @if( CommonHelper::arrayHasValue($companies) ) 	
   <?php
					function getAllEngr($all_engineers, $id) {					
						$html = '';
						if(array_key_exists($id, $all_engineers)) {
							foreach($all_engineers[$id] as $row) {
								$html .= '
									<span style="margin: 3px;">									
										'.$row.'							
									</span>';
							}
						}
						
						return $html;
					}
				?>
<style>
	.image-oval {            
   /* width has to be 70% of height */
   /* could use width:70%; in a square container */      
      border: 1px solid #e0e0e0;

   /* beware that Safari needs actual
    px for border radius (bug) */
      -webkit-border-radius:63px 63px 63px 63px/
      108px 108px 72px 72px;
      /* fails in Safari, but overwrites in Chrome */
      border-radius: 50%;
   } 
</style>
<div class="widget">
	<div class="widget-header">
		<i class="icon-truck"></i>
		<h3>Service Providers</h3>
		<span class="pagination-totalItems">Total: {{ $company_total }}</span>
	</div><!-- /widget-header -->	
	<div class="widget-content">
		<div class="table-responsive">	   
		   <table class="table">
					<thead>
						<tr>	
							<th>&nbsp;</th>		
							<th>&nbsp;</th>													
							<th align="left">										
								Engineers
							</th>							
							<th>Action</th>						
						</tr>
					</thead>
					
					<tbody>
					   @foreach ($companies as $company)							
							<tr>
								<td>
									<input type="checkbox" class="checkbox" name="selected[]" value="{{ $company->id }}" data-name="{{ $company->company }}">
								</td>						
								<td>
									<a href="{{ URL::to('admin/skills-map?filter_company='.$company->id) }}" title="company">
									   @if($company->logo != '')					   
									   {{ HTML::image(Config::get('app.url_storage') . '/company_logo/'.$company->logo, 'logo', array('style' => 'width: 120px;', 'class' => '')) }}  
									   @else						
									   {{ HTML::image(Config::get('app.url_storage') . '/profile_pic/no-photo.jpg', 'logo', array('style' => 'width: 100px; height: 100px;', 'class' => '')) }}
									   @endif
									 <br>
									 {{ $company->company }}
									 </a>
								</td>								
								<td>									
									<?php
										echo getAllEngr($all_engineers, $company->id);
									?>
								</td>
								<td align="center">
									<a href="{{ $url_update . '?id=' . $company->id }}" title="Update">
										<i class="icon-pencil"></i>
									</a>
								</td>
							</tr>
					   @endforeach
					</tbody>
				</table>				
			</div>
			@if( CommonHelper::arrayHasValue($companies) ) 
			<h6 class="paginate">
				<span>{{ $companies->appends($arrFilters)->links() }}</span>
			</h6>
			@endif
		</div>
	</div>
   @else
	<div class="alert alert-info" style="text-align: center;">
	  <strong>Empty Results</strong>
   </div>   
   @endif
</div>
<!--modal for delete -->
<div id="deleteModal" style="overflow-y: hidden;"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   {{ Form::open(array('url'=>$url_delete, 'class'=>'form-horizontal', 'role'=>'form', 'method' => 'post')) }}
   <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h3 id="myModalLabel">Delete Companies</h3>
   </div>
   <div class="modal-body">
      <fieldset>
         <div class="control-group">
            <label class="control-label" for="delete_list">Companies:</label>
            <div class="controls">
               <div id="delete_list" style="margin-top: 3px;"></div>
            </div>
            <!-- /controls -->				
         </div>
         <!-- /control-group -->
      </fieldset>
      <font color="#ff1d00">
      <b>Please take note that once you delete any service provider it will also affect those engineers, resource managers and trainers who belongs to this group. It will probably cause system error.<br>Make sure you will also delete those users who belongs to this service provider.</b>
      </font>
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
   	$( "div.stat" ).hover(function() {
   	  var val = $( this ).attr('title');
   	  var id = $( this ).attr('data-id');
   	  $('#stat-box-'+id).html('<strong style="color: ;">'+val.toUpperCase()+'</strong>');
   	},
   	   function() {
		   var id = $( this ).attr('data-id');
		   var str = 'No. of Engineers Completed v7, No. of Engineers Completed v8 and Total Engineers';
   		   $('#stat-box-'+id).html('');
   	   }
   	);
   
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
       	location.href = "{{ URL::to('admin/company') }}";
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
   			alert('Please select service providers.');
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