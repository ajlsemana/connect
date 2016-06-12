<h1 class="page-header">Join Group</h1>		

{{ Form::open(array('url'=>'student/class/joinGroup', 'class'=>'form-horizontal', 'id'=>'form', 'role'=>'form', 'method' => 'post')) }}	
<div class="form-group">
	<label for="group_code" class="col-sm-2 control-label">Group Code:</label>
	<div class="col-sm-4">
		{{ Form::text('group_code', Input::old('group_code'), array('class' => 'form-control','maxlength'=>'50')) }}
	</div>
</div>

<div class="form-group">
	<label for="" class="col-sm-2 control-label"></label>
	<div class="col-sm-4">
		<a class="btn btn-sm btn-primary" id="submitForm">Send Request</a>		
	</div>
</div>
{{ Form::close() }}		

<br />
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>
					<a href="{{ $sort_group_code }}" class="@if ($sort=='group_code') {{ strtolower($order) }} @endif">Group Code</a>
				</th>
				<th>
					<a href="{{ $sort_subject }}" class="@if ($sort=='subject') {{ strtolower($order) }} @endif">Subject</a>
				</th>
				<th>
					<a href="{{ $sort_section }}" class="@if ($sort=='section') {{ strtolower($order) }} @endif">Section</a>
				</th>
				<th>
					<a href="{{ $sort_status }}" class="@if ($sort=='status') {{ strtolower($order) }} @endif">Status</a>
				</th>
			</tr>
		</thead>
		
		<tbody>
			@if( CommonHelper::arrayHasValue($classes) ) 
				@foreach ($classes as $class)
			<tr>
				<td>{{ $class->group_code }}</td>
				<td>{{ $class->code }} - {{ $class->name }}</td>
				<td>
					{{ $class->section_code }} - {{ $class->section_name }}<br />
					<em>				
						@if ($class->semester == 1) 1st Semester
						@elseif ($class->semester == 2) 2nd Semester
						@elseif ($class->semester == 3) 3rd Semester
						@endif
						/
						{{ $class->school_year_from }} - {{ $class->school_year_to }}
					</em>
				</td>
				<td>
					@if ($class->class_status == 0)
						Pending
					@elseif ($class->class_status == 1)
						Active
					@endif
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

@if( CommonHelper::arrayHasValue($classes) ) 
<h6 class="paginate">
	<span>{{ $classes->appends($arrFilters)->links() }}</span>
</h6>
@endif						

<script type="text/javascript">
$(document).ready(function() {	
    // Submit Form
    $('#submitForm').click(function() {
    	$('#form').submit();
    });
    
    $('#form input').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#form').submit();
		}
	});
});	
</script>