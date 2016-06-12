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
			<div class="span3 search-span">
				<div class="search-div">
					<div class="search-label">Primary Email:</div>
					<div class="search-field">
						{{ Form::text('filter_primary_email', $filter_primary_email, array('id'=>'filter_primary_email', 'placeholder'=>'', 'maxlength'=>'100', 'style'=>'width: 150px;')) }}
					</div>
				</div>						
			</div>
			<div class="span3 search-span">
				<div class="search-div">
					<div class="search-label">Company:</div>
					<div class="search-field">						
						{{ Form::select('filter_company', $company_options, $filter_company, array('id' => 'filter_company', 'class' => 'select-width')) }}						
					</div>
				</div>						
			</div>
			<div class="span3 search-span">
				<div class="search-div">
					<div class="search-label">Certification:</div>
					<div class="search-field">				
						<!--<input type="checkbox" value="v7" @if(isset($_GET['filter_v7'])) checked @endif name="filter_v7"> uCI version 7.5<br>
						<input type="checkbox" value="v8" @if(isset($_GET['filter_v8'])) checked @endif name="filter_v8"> uCI version 8.5-->
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
</div>
{{ Form::hidden('sort', $sort) }}
{{ Form::hidden('order', $order) }}

{{ Form::close() }}
<?php
	$enrolled_array = array();
	$ended_array = array();
	
	if($enrolled_courses) {
		foreach($enrolled_courses as $row) {
			$enrolled_array[$row->uid][] = $row->name;
		}
	}
	
	if($ended_courses) {
		foreach($ended_courses as $row2) {
			$ended_array[$row2->uid][] = $row2->name;
		}
	}
?>
<div class="widget">
	<div class="widget-header">
		<i class="icon-bar-chart"></i>
		<h3>Engineer Profiles</h3>		
		<!--<strong>
			<?php $route = Route::getCurrentRoute()->getPath(); ?>
			<a href="{{ URL::to('admin/skills-map-v7') }}" class="btn" @if($route == 'admin/skills-map-v7') style="color: #fff; background: #1E8C0E;" @endif>Skills Map v7</a>&nbsp;
			<a href="{{ URL::to('admin/skills-map') }}" class="btn" @if($route == 'admin/skills-map') style="color: #fff; background: #1E8C0E;" @endif>Skills Map v8</a>
		</strong>-->
		<span class="pagination-totalItems">Total: {{ $users_total }}</span>
	</div><!-- /widget-header -->

	<div class="widget-content">
		<div class="table-responsive">
		<table class="table table-condensed">
			<thead>
				<tr align="left">	
					<th>&nbsp;</th>
					<th>
						<a href="{{ $sort_first_name }}" class="@if ($sort=='first_name') {{ strtolower($order) }} @endif">Full Name</a>
					</th>					
					<th>
						Company
					</th>
					<th>
						Type
					</th>
					<th>
						<a href="{{ $sort_primary_email }}" class="@if ($sort=='primary_email_address') {{ strtolower($order) }} @endif">Email</a>
					</th>
					<th>
						Courses
					</th>
					<th>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;						
						{{ HTML::image('resources/img/uCI_v7.jpg', 'uCI version', array('style' => '', 'class' => 'version-photo')) }}  
					</th>
					<th>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						{{ HTML::image('resources/img/uCI_v8.jpg', 'uCI version', array('style' => '', 'class' => 'version-photo')) }}  
					</th>					
				</tr>
			</thead>
			
			<tbody>
				@if( CommonHelper::arrayHasValue($users) ) 
				<?php $i = 0; ?>
 				@foreach ($users as $user)
				<?php
					$color = '#EDF3FE';
					if(($i % 2) == 0) {
						$color = '#FFFFFF';
					}
				?>
				<tr align="left" style="background: ;">								
						<?php
	                     $pic = 'no-photo.jpg';
	                     $destinationPath = Config::get('app.url_storage') . '/profile_pic/'.$pic;                       
                     ?>       
	                  @if(! empty($user->profile_pic))
	                  <?php $pic = $user->profile_pic; ?>
	                  <?php $destinationPath = Config::get('app.url_storage') . '/profile_pic/'.$pic; ?>           
	                  @endif            
					<td>
						{{ HTML::image($destinationPath, 'picture', array('width' => '120', 'height' => '120', 'title' => 'photo', 'class' => 'img-responsive img-circle', 'style' => 'height: 120px !important; border: 1px solid #f2f2f2;')) }}
					</td>
					<td>	
						{{ wordwrap($user->first_name.' '.$user->last_name, 100, "<br />\n", true) }}
					</td>				
					<td>{{ wordwrap($company[$user->company], 100, "<br />\n", true) }}</td>
					<td>
						@if($user->user_type == 5) Resource Manager @else Engineer @endif
					</td>
					<td>{{ $user->primary_email_address }} <input type="hidden" value="{{ $user->primary_email_address }}" id="email-{{ $user->id }}"></td>
					<td align="center">
						<a href="#view_courses_modal{{ $user->id }}" role="button" data-toggle="modal" title="view courses"><i class="icon-sitemap"></i></a>
						<div id="view_courses_modal{{ $user->id }}" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
						  <div class="modal-header">
							 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							 <h3 id="myModalLabel">Courses</h3>
						  </div>
						  <div class="modal-body">
							 <table class="table table-striped table-bordered">
								<thead>
								   <tr>
									  <th> Enrolled Training </th>
									  <th> Attended Training</th>									  
								   </tr>
								</thead>
								<tbody>
								   <?php if(TRUE): ?>									 
									  <tr align="center">
										 <td>
											<?php 
												if(isset($enrolled_array[$user->id])) {
													foreach($enrolled_array[$user->id] as $value_enrolled)
													echo $value_enrolled.'<br><br>';
												} else {
													echo 'n/a';
												}
											?>
										 </td>
										 <td>
											<?php 
												if(isset($ended_array[$user->id])) {
													foreach($ended_array[$user->id] as $value_ended)
													echo $value_ended.'<br><br>';
												} else {
													echo 'n/a';
												}
											?>
										 </td>
									  </tr>
								   <?php
									  else:
										 ?>
										 <tr align="center">
											<td colspan="2">Empty Results</td>
										 </tr>
										 <?php
									  endif;                           
									  ?> 
								</tbody>
							 </table>
						  </div>
						  <div class="modal-footer">
							 <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>                    
						  </div>
					   </div>
					</td>
					<td>					
						<div id="v7_divProgress{{ $user->id }}" class="divProgress" data-id="{{ $user->status_rate_v7 }}"></div>
						<script>
							var id = '{{ $user->id }}';	
							var val = $("#v7_divProgress"+id).attr('data-id');
							var pcolor;
							
							if(val > 0 && val < 100) {
								pcolor = '#ff671c';
							} else if(val == 100) {
								pcolor = '#30CD74';
							}
							$("#v7_divProgress"+id).circularloader({		
								progressPercent: val,
								progressBarColor: pcolor,								
								progressBarBackground: "#CDCDCD",                
								fontSize: "18px",
								progressBarWidth: 15,
								radius: 40
							 });
						</script>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{{ $url_update_v7 . '&id=' . $user->id }}" style="color: #08659B; font-weight: 700;">
							@if($user->status_rate_v7 == 0)
								Not Started
							@elseif($user->status_rate_v7 >= 1 AND $user->status_rate_v7 <= 99)
								In Progress
							@elseif($user->status_rate_v7 == 100)
								Completed						
							@endif
						</a>
					</td>
					<td>
						<div id="v8_divProgress{{ $user->id }}" class="divProgress" data-id="{{ $user->status_rate }}"></div>
						<script>
							var id = '{{ $user->id }}';	
							var val = $("#v8_divProgress"+id).attr('data-id');
							var pcolor;
							if(val > 0 && val < 100) {
								pcolor = '#ff671c';
							} else if(val == 100) {
								pcolor = '#30CD74';
							}
							$("#v8_divProgress"+id).circularloader({		
								progressPercent: val,
								progressBarColor: pcolor,								
								progressBarBackground: "#CDCDCD",                
								fontSize: "18px",
								progressBarWidth: 15,
								radius: 40
							 });
						</script>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;					
						<a href="{{ $url_update . '&id=' . $user->id }}" style="color: #08659B; font-weight: 700;">
							@if($user->status_rate == 0)
								Not Started
							@elseif($user->status_rate >= 1 AND $user->status_rate <= 99)
								In Progress
							@elseif($user->status_rate == 100)
								Completed						
							@endif
						</a>
					</td>			
				</tr>
					<?php $i++; ?>
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
    	location.href = "{{ URL::to('admin/skills-map') }}";
    });
});
//--></script> 