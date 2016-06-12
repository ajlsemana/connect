<ol class="breadcrumb">
	@foreach ($breadcrumbs as $breadcrumb)
		<li class="{{ $breadcrumb['class'] }}"><a href="{{ $breadcrumb['href'] }}">{{ $breadcrumb['text'] }}</a></li>
   	@endforeach
</ol>

@if( $errors->all() )
    <div class="alert alert-error">
    	<button class="close" data-dismiss="alert" type="button">&times;</button>
    	{{ HTML::ul($errors->all()) }}
    </div>
@endif
<div class="widget">
    <div class="widget-header"> <i class="icon-list-alt"></i>
    	<h3>Training Activity Calendar</h3>
    </div>
    <!-- /widget-header -->
    
    <div class="widget-content">
		<div class="span2">&nbsp;</div>
		<div class="span8">
			<fieldset>				
				<div class="control-group">											
					<label class="control-label" for="name"><b>Course Name:</b> {{ $courses->name }}</label>
					<div class="controls">						
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->

				<div class="control-group">											
					<label class="control-label" for=""><b>Date From:</b> {{ htmlentities(date('d F Y', strtotime($courses->date_from))) }}</label>
					<div class="controls">						
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->

				<div class="control-group">											
					<label class="control-label" for=""><b>Date To:</b> {{ htmlentities(date('d F Y', strtotime($courses->date_to))) }}</label>
					<div class="controls">						
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
				<?php $time_explode = explode('-', $courses->time); ?>
				<div class="control-group">											
					<label class="control-label" for=""><b>Time:</b> {{ $time_explode[0] }} AM - {{ $time_explode[1] }} PM</label>
					<div class="controls">												
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->

				<div class="control-group">											
					<label class="control-label" for=""><b>Duration:</b> {{ $courses->duration }} days</label>
					<div class="controls">						
						<div>
						<?php if($activity): ?>			
						<div class="widget widget-nopad">
				            <div class="widget-header"> <i class="icon-list-alt"></i>
				              <h3> Activities | <a href="{{ URL::to('admin/training-courses/view-timeline/'.$activity[0]->cid ) }}">Timeline View</a></h3>
				            </div>
				            <style>
				            	.day1 {
				            		color: #ff0000;
				            		font-weight: 700;
				            	}

				            	.day2 {
				            		color: #dd00ed;
				            		font-weight: 700;
				            	}

				            	.day3 {
				            		color: #009e0a;
				            		font-weight: 700;
				            	}

				            	.day4 {
				            		color: #00c1b1;
				            		font-weight: 700;
				            	}

				            	.day5 {
				            		color: #ff5405;
				            		font-weight: 700;
				            	}
				            </style>
				            	<!-- /widget-header -->
<div class="widget-content">
  <ul class="news-items">
	<?php							
		foreach($activity as $activities) {
		?>
			<li class="li-day-{{ $activities->days }} li-days">				                  
			  <div class="news-item-date"> <span class="news-item-day day{{ $activities->days }}">{{ $activities->days }}</span> <span class="news-item-month">Day</span> </div>
			  <div class="news-item-detail"> {{ $activities->time_from }} - {{ $activities->time_to }}
				<p class="news-item-preview"> {{ $activities->agenda }} <a href="#" data-id="{{ $activities->id }}" title="remove" class="a-remove"><h4><i class="icon-large icon-trash"></i></h4></a></p>
			  </div>						                  
			</li>	
			<?php
		}
	?>				               			               
  </ul>
</div>
<!-- /widget-content --> 				            
				          </div>
				      	<?php endif; ?>
						<h3>Training Schedule</h3>	
						{{ Form::open(array('url'=>'admin/training-courses/insert-activity', 'class'=>'form-horizontals', 'autocomplete'=>'off', 'id'=>'', 'role'=>'form', 'method' => 'post')) }}								
							Day
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<select name="day" id="dd-day" required>
								<option value="">- Please Select -</option>
							<?php
							for($i = 1; $i <= $courses->duration; $i++) {
								?>
								<option value="{{ $i }}">{{ $i }}</option>	
								<?php								
							}
							?>
							</select>
							<br> {{ timeFromTo(9, 17) }}<br>
							{{ Form::hidden('cid', $courses->id, array('id' => 'cid')) }}			
							<input type="submit" class="btn btn-primary" value="Add Activity">
							{{ Form::close() }}

						<?php						
							function timeFromTo($from, $to) {
								$html = '';								
								$html .= 'From&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
								//FROM hours
								$html .= '<select name="hours-from" style="width: 50px;">';

								$from = substr($from, 0, 2);
								$to = substr($to, 0, 2);
								if($from != '10') {
									$from = str_replace('0', '', $from);
								}	

								if($to != '10') {
									$to = str_replace('0', '', $to);
								}															
												
								for($i = $from; $i <= $to; $i++) {
									$hr = ($i < 10 ? '0'.$i : $i);
									$html .= '<option value="'.$hr.'">'.$hr.'</option>';
								}								

								$html .= '</select>';

								//FROM minutes
								$html .= ' : <select name="minutes-from" style="width: 50px;">';
								$html .= '<option value="00">00</option>';
								$html .= '<option value="15">15</option>';
								$html .= '<option value="30">30</option>';
								$html .= '<option value="45">45</option>';								
								$html .= '</select>';
								//FROM ends here

								//TO starts here
								$html .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;up to &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
								//To hours
								$html .= '<select name="hours-to" style="width: 50px;">';

								$from = substr($from, 0, 2);
								$to = substr($to, 0, 2);
								if($from != '10') {
									$from = str_replace('0', '', $from);
								}	

								if($to != '10') {
									$to = str_replace('0', '', $to);
								}															
												
								for($i = $from; $i <= $to; $i++) {
									$hr = ($i < 10 ? '0'.$i : $i);
									$html .= '<option value="'.$hr.'">'.$hr.'</option>';
								}								

								$html .= '</select>';

								//To minutes
								$html .= ' : <select name="minutes-to" style="width: 50px;">';
								$html .= '<option value="00">00</option>';
								$html .= '<option value="15">15</option>';
								$html .= '<option value="30">30</option>';
								$html .= '<option value="45">45</option>';								
								$html .= '</select><br>';

								$html .= 'Activity &nbsp;<input type="text" name="activity" style="width: 600px;" required>';
								return $html;
							}
						?>									
				      </div>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->															
			</fieldset>
        </div>
        <div class="span2">&nbsp;</div>
     
	</div><!-- /widget-content --> 
</div><!-- /widget -->	

<script type="text/javascript">
$(document).ready(function() {
	// Submit Form
    $('#submitForm').click(function() {
    	$('#form-courses').submit();
    });
    
    $('#form-courses input').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#form-courses').submit();
		}
	});

    $('#dd-day').change(function() {
    	var val = $(this).val();

    	if(val != '') {
	    	$('.li-days').hide();
	    	$('.li-day-'+val).show();
	    } else {
	    	$('.li-days').show();
	    }
    });

	$('.a-remove').click(function(e) {
		e.preventDefault();
		var id = $(this).attr('data-id');
		var cid = $('#cid').val();

		if(confirm('Are you sure you want to delete this activity?')) {			
    		window.location.href = "{{ URL::to('admin/training-courses/delete-activity') }}/"+cid+'/'+id;
    	}
    });
});	
</script>