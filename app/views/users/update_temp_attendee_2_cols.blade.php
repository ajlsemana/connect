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
    <div class="widget-header"> <i class="icon-user"></i>
    	<h3>View or Update Information</h3>
    </div>
    <!-- /widget-header -->
    
    <div class="widget-content">
    	{{ Form::model($attendees[0], array('url'=>'admin/attendees/temp-updateData', 'class'=>'form-horizontal', 'id'=>'form-users', 'role'=>'form', 'method' => 'post')) }}
    	<div class="container">
    		<div class="row">
				<div class="span6">
						<div class="control-group">											
							<label class="control-label" for="first_name">First Name:</label>
							<div class="controls">
								{{ Form::text('first_name', null, array('maxlength'=>'50')) }}
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->			

						<div class="control-group">											
							<label class="control-label" for="last_name">Last Name:</label>
							<div class="controls">
								{{ Form::text('last_name', null, array('maxlength'=>'50')) }}
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->

						<div class="control-group">											
							<label class="control-label" for="company">Company:</label>
							<div class="controls">
								{{ Form::text('company', null, array('maxlength'=>'100')) }}
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->

						<div class="control-group">											
							<label class="control-label">Email Address:</label>
							<div class="controls">
								{{ Form::text('email', null, array('maxlength'=>'100')) }}
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->	

						<div class="control-group">											
							<label class="control-label" for="number">Contact No.:</label>
							<div class="controls">
								{{ Form::text('contact_number', null, array('maxlength'=>'15')) }}
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->

						<div class="control-group">											
							<label class="control-label" for="status"><b>Attendance Status:</b></label>
							<div class="controls">
								{{ Form::select('attendance_status', $status_options, null, array('id'=>'status')) }}
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->

						<div class="control-group">											
							<label class="control-label" for="courses">Training Course:</label>
							<div class="controls">
								{{ Form::select('course', $course_options, null, array('id'=>'courses')) }}
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->				
						
						<div class="control-group">											
							<label class="control-label" for="remarks">Remarks:</label>
							<div class="controls">
								{{ Form::textarea('remarks', null, array('placeholder' => '', 'size' => '20x3', 'class' => 'form-control', 'maxlength' => 5000)) }}
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->
						<div class="row">
					    	<center>
								<a class="btn btn-primary submitForm">Update</a>
								<a class="btn" href="{{ $url_cancel }}">Cancel</a>
					    	</center>
					    </div>
		        </div>
		        <div class="span6">
		        	<h4><i class="icon-user"></i> For Admin Purposes</h4>
		        	<a href="{{ URL::to('admin/attendees/temp-listings-info/'.$attendees[0]->id) }}">[ Summary Report of {{ $attendees[0]->first_name.' '.$attendees[0]->last_name }} ]</a>
		        	<div class="control-group">											
						<label class="control-label" for="reference">Reference:</label>
						<div class="controls">
							{{ Form::textarea('reference', null, array('placeholder' => '', 'size' => '20x3', 'class' => 'form-control', 'maxlength' => 5000)) }}
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<hr>
					<b>Step 1:</b>
					<div class="control-group">											
						<label class="control-label">Amount:</label>
						<div class="controls">
							{{ Form::text('amount', null, array('maxlength'=>'100')) }}
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<div class="control-group">											
						<label class="control-label">% Discount:</label>
						<div class="controls">
							{{ Form::text('discount', null, array('maxlength'=>'100')) }}
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<div class="control-group">											
						<label class="control-label">P.O. (Sent/Not):</label>
						<div class="controls">
							{{ Form::select('proposal_status_sent', array('Not sent' => 'Not sent', 'Sent' => 'Sent'), null, array('id'=>'')) }}
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<div class="control-group">											
						<label class="control-label">Proposal Date Sent:</label>
						<div class="controls">
							<input type="date" value="{{ $attendees[0]->po_date_sent }}" name="po_date_sent">
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<div class="control-group">											
						<label class="control-label">P.O. (Received/Not):</label>
						<div class="controls">
							{{ Form::select('proposal_status_received', array('Not received' => 'Not received', 'Received' => 'Received'), null, array('id'=>'')) }}
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<div class="control-group">											
						<label class="control-label">P.O. Date Received:</label>
						<div class="controls">
							<input type="date" value="{{ $attendees[0]->po_date_received }}" name="po_date_received">
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<hr>
					<b>Step 2:</b>
					<div class="control-group">											
						<label class="control-label">Invoice:</label>
						<div class="controls">
							{{ Form::select('invoice', array('Not sent' => 'Not sent', 'Sent' => 'Sent'), null, array('id'=>'')) }}
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<div class="control-group">											
						<label class="control-label">Invoice Date Sent:</label>
						<div class="controls">
							<input type="date" value="{{ $attendees[0]->invoice_date_sent }}" name="invoice_date_sent">
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->

					<hr>
					<b>Step 3:</b>
					<div class="control-group">											
						<label class="control-label">Payment Status:</label>
						<div class="controls">
							{{ Form::select('payment_status', array('Not received' => 'Not received', 'Received' => 'Received'), null, array('id'=>'')) }}
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<div class="control-group">											
						<label class="control-label">Cash Received:</label>
						<div class="controls">
							{{ Form::text('cash_received', null, array('maxlength'=>'10')) }}
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<div class="row">
				    	<center>
							<a class="btn btn-primary submitForm">Update</a>
							<a class="btn" href="{{ $url_cancel }}">Cancel</a>
				    	</center>
				    </div>
					<hr>
					<i class="icon-small icon-plus"></i>
					<h4>COMPUTATION BREAKDOWN</h4>
					<i class="icon-small icon-minus"></i>
					<div class="control-group">											
						<label class="control-label">Original Amount <i>(Amount - Discount)</i>:</label>
						<div class="controls">
							<b>
							<?php
								echo number_format($attendees[0]->amount, 0);
							?>
							</b>
						</div> <!-- /controls -->
					</div>
					<div class="control-group">											
						<label class="control-label">Discount Percentage</i>:</label>
						<div class="controls">
							<b>
							<?php
								echo $attendees[0]->discount.'%';
							?>
							</b>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<div class="control-group">											
						<label class="control-label">Amount of Discount <i>(Amount x (Discount / 100)</i>:</label>
						<div class="controls">
							<br>
							<b>
							<?php
								$discount = 0;
								$discount = (double) $attendees[0]->amount * ((double) $attendees[0]->discount / 100);
								echo number_format($discount, 0);
							?>
							</b>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<div class="control-group">											
						<label class="control-label">Amount to be Paid <i>(Amount - Discount)</i>:</label>
						<div class="controls">
							<b>
							<?php
								$amount_be_paid =(double) $attendees[0]->amount - $discount;
								echo number_format($amount_be_paid, 0);
							?>
							</b>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<div class="control-group">											
						<label class="control-label">Remaining Balance <i>(Amount to be Paid - Cash Received)</i>:</label>
						<div class="controls">
							<br>
							<b>
							<?php
								echo number_format($amount_be_paid - (double) $attendees[0]->cash_received, 0);
							?>
							</b>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<a href="{{ URL::to('admin/attendees/temp-listings-info/'.$attendees[0]->id) }}">[ Summary Report of {{ $attendees[0]->first_name.' '.$attendees[0]->last_name }} ]</a>
		        </div>
		    </div>
		    <br>
    	</div>
        {{ Form::hidden('id', $attendees[0]->id) }}
        {{ Form::hidden('filter_company', $filter_company) }}
        {{ Form::hidden('filter_first_name', $filter_first_name) }}
        {{ Form::hidden('filter_last_name', $filter_last_name) }}
        {{ Form::hidden('filter_primary_email', $filter_primary_email) }}
        {{ Form::hidden('filter_courses', $filter_courses) }}
        {{ Form::hidden('filter_status', $filter_status) }}
        {{ Form::hidden('sort', $sort) }}
        {{ Form::hidden('order', $order) }}
        
		{{ Form::close() }}
	</div><!-- /widget-content --> 
</div><!-- /widget -->	

<script type="text/javascript">
$(document).ready(function() {
    // Submit Form
    $('.submitForm').click(function() {
    	$('#form-users').submit();
    });
    
    $('#form-users input').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#form-users').submit();
		}
	});
});	
</script>