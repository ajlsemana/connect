<h1 class="page-header">Upcoming Trainings</h1>	
<div class="panel panel-default">
	<!-- /.panel-heading -->
	<div class="panel-body">
		<div class="table-responsive">
			<div id="error"></div>
			{{ Form::open(array('url'=>'student/learning-expectations', 'class'=>'form-horizontal', 'autocomplete'=>'off', 'id'=>'form', 'role'=>'form', 'method' => 'post')) }}
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th width="10px"><input type="checkbox" title="check all" class="cb-parent" id="cb-parent"></th>
						<th>Courses</th>
						<th>Date From</th>
						<th>Date To</th>
						<th>Duration</th>
						<th>Time</th>
						<th>Registration Status</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$reg_courses = array();
						$reg_status = array();

						foreach($attendees as $value) {
							$reg_courses[] = $value->courses;
							$reg_status[$value->courses] = $value->attendance_status;
						}
					?>
					@foreach($courses as $course)
					<?php
						$array_time = array(
							'12' => '12',
							'13' => '01',
							'14' => '02',
							'15' => '03',
							'16' => '04',
							'17' => '05',
							'18' => '06',
							'19' => '07',
							'20' => '08',
							'21' => '09',
							'22' => '10',
							'23' => '11',
							'00' => '12'
						);
						$explode_time = explode(':', $course->time);
						$explode_noon_time = explode('-', $explode_time[1]);
					
						$noon_time = $explode_time[2].':'.$explode_noon_time[1].' AM';
						if($explode_noon_time[1] > 11) {
							$noon_time = $array_time[$explode_noon_time[1]].':'.$explode_time[2].' PM';
						}
						$time =  $explode_time[0].':'.$explode_noon_time[0].' AM to '.$noon_time;						
					?>
					<tr>
						<td width="10px">
							@if(! in_array($course->id, $reg_courses))
							<input type="checkbox" name="courses[{{ $course->id }}]" value="{{ $course->name }}" class="cb-child">
							@endif
						</td>
						<td>{{ $course->name }}</td>
						<td>{{ date('d F Y', strtotime($course->date_from)) }}</td>
						<td>{{ date('d F Y', strtotime($course->date_to)) }}</td>
						<td>{{ $course->duration }} days</td>
						<td>{{ $time }}</td>
						<td>
							@if(in_array($course->id, $reg_courses))
								{{ strtoupper($reg_status[$course->id]) }}
							@else
								REGISTER NOW
							@endif
						</td>
					</tr>
					@endForeach					
				</tbody>
			</table>
			<input type="submit" class="btn btn-primary" id="submitForm" value="REGISTER - STEP ONE">
		</div>
		<!-- /.table-responsive -->
	</div>
	<!-- /.panel-body -->
</div>
<script>
	$('#cb-parent').click(function() {	
		if($(this).is(':checked')) {
			$('.cb-child').prop('checked', 'checked');
		} else {
			$('.cb-child').removeAttr('checked');
		}
	});
	
	$('.cb-child').click(function() {	
		if(! $(this).is(':checked')) {		
			$('#cb-parent').removeAttr('checked');
		}
	});

	$('form').submit(function() {
		var r = true;

		if($("input:checkbox:checked").length == 0) {
			r = false;
			$('#error').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>You need to check at least one of the given courses.</div>');
		}

		return r;
	});
</script>