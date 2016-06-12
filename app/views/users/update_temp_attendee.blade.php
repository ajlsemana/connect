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
				<div class="span4">
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
		        <div class="span4">
		        	<h4><i class="icon-user"></i> For Admin Purposes</h4>
		        	<a href="{{ URL::to('admin/attendees/temp-listings-info/'.$attendees[0]->id) }}">[ Summary Report of {{ $attendees[0]->first_name.' '.$attendees[0]->last_name }} ]</a>
		        	<div class="control-group">											
						<label class="control-label" for="status"><b>Payment Status:</b></label>
						<div class="controls">
							{{ Form::text('attendance_status', null, array('readonly', 'maxlength'=>'100')) }}						
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->

		        	<div class="control-group">											
						<label class="control-label" for="reference">Reference:</label>
						<div class="controls">
							{{ Form::select('reference', array('POP' => 'POP', 'with PO' => 'with PO'), null, array('id'=>'reference')) }}
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->

					<div class="control-group">											
						<label class="control-label" for="reference">Confirmed Date:</label>
						<div class="controls">
							<?php
								$training_dates = array();
								switch($attendees[0]->course):
									case 'Technical Administration': 
	
										$training_dates = array(
											'' => '- Please Select -',
											'06 - 10 MARCH 2016' => '06 - 10 MARCH 2016',
											'01 - 05 NOVEMBER 2015' => '01 - 05 NOVEMBER 2015'
										);
									break;
									case 'Script Development': 
										$training_dates = array(
											'' => '- Please Select -',
											'06 - 10 MARCH 2016' => '06 - 10 MARCH 2016',
											'08 - 12 NOVEMBER 2015' => '08 - 12 NOVEMBER 2015'
										);
									break;
									case 'Inbound Floor Operations': 
										$training_dates = array(
											'' => '- Please Select -',											
											'08 - 10 DECEMBER 2015' => '08 - 10 DECEMBER 2015'
										);
									break;
									case 'Outbound Floor Operations': 
										$training_dates = array(
											'' => '- Please Select -',
											'15 - 17 DECEMBER 2015' => '15 - 17 DECEMBER 2015'
										);
									break;										
								endswitch;																			
							?>							
							{{ Form::select('confirmed_date', $training_dates, null, array('id'=>'training_dates')) }}
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->

					<div class="control-group">											
						<label class="control-label" for="reference">Attendance Status:</label>
						<div class="controls">
							{{ Form::select('change_status', array('' => '- Please Select -', 'Confirmed' => 'Confirmed', 'Reschedule' => 'Reschedule', 'Cancelled' => 'Cancelled'), null, array('id'=>'attendance_status')) }}
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->

					<div class="control-group">											
						<label class="control-label" for="reference">Profile:</label>
						<div class="controls">
							{{ Form::checkbox('profiling', '1', true) }}
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->					
					<?php
						$disabled = ($attendees[0]->reference == 'POP' ? 'disabled' : '');
					?>
					<hr>
					<b>Step 1:</b>
					<div class="control-group">											
						<label class="control-label">Amount:</label>
						<div class="controls">
							{{ Form::text('amount', null, array('maxlength'=>'100')) }}
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<div class="control-group">											
						<label class="control-label">Discount ( % ):</label>
						<div class="controls">
							{{ Form::text('discount', null, array($disabled, 'maxlength'=>'100')) }}
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<div class="control-group">											
						<label class="control-label">Proposal:</label>
						<div class="controls">
							{{ Form::select('proposal_status_sent', array('Not sent' => 'Not sent', 'Sent' => 'Sent'), null, array($disabled, 'id'=>'')) }}
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<div class="control-group">											
						<label class="control-label">Proposal Date:</label>
						<div class="controls">
							<input type="date" {{ $disabled }} value="{{ $attendees[0]->po_date_sent }}" name="po_date_sent">
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<div class="control-group">											
						<label class="control-label">P.O.:</label>
						<div class="controls">
							{{ Form::select('proposal_status_received', array('Not received' => 'Not received', 'Received' => 'Received'), null, array($disabled, 'id'=>'')) }}
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<div class="control-group">											
						<label class="control-label">P.O. Date:</label>
						<div class="controls">
							<input type="date" {{ $disabled }} value="{{ $attendees[0]->po_date_received }}" name="po_date_received">
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<hr>
					<b>Step 2:</b>
					<div class="control-group">											
						<label class="control-label">Invoice:</label>
						<div class="controls">
							{{ Form::select('invoice', array('Not sent' => 'Not sent', 'Sent' => 'Sent'), null, array($disabled, 'id'=>'')) }}
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<div class="control-group">											
						<label class="control-label">Invoice Date:</label>
						<div class="controls">
							<input type="date" {{ $disabled }} value="{{ $attendees[0]->invoice_date_sent }}" name="invoice_date_sent">
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->

					<hr>
					<b>Step 3:</b>
					<div class="control-group">											
						<label class="control-label">Payment Status:</label>
						<div class="controls">
							{{ Form::select('payment_status', array('Not received' => 'Not received', 'Partial' => 'Partial', 'Full' => 'Full'), null, array($disabled, 'id'=>'')) }}
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<div class="control-group">											
						<label class="control-label">Payment Received:</label>
						<div class="controls">
							{{ Form::text('cash_received', null, array($disabled, 'maxlength'=>'10')) }}
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
				    <a href="{{ URL::to('admin/attendees/temp-listings-info/'.$attendees[0]->id) }}">[ Summary Report of {{ $attendees[0]->first_name.' '.$attendees[0]->last_name }} ]</a>
					<div class="row">
				    	<center>
							<a class="btn btn-primary submitForm">Update</a>
							<a class="btn" href="{{ $url_cancel }}">Cancel</a>
				    	</center>
				    </div>
		        </div>
		        <div class="span4">
					<h4>BILLING CALCULATOR</h4>
		        	<a href="{{ URL::to('admin/attendees/temp-listings-info/'.$attendees[0]->id) }}">[ Summary Report of {{ $attendees[0]->first_name.' '.$attendees[0]->last_name }} ]</a>
					<div class="control-group">											
						<label class="control-label">Original Amt. <i>(Amt. - Discount)</i>:</label>
						<div class="controls">
							<b>
							<?php
								echo number_format($attendees[0]->amount, 0);
							?>
							</b>
						</div> <!-- /controls -->
					</div>
					<div class="control-group">											
						<label class="control-label">Discount ( % )</i>:</label>
						<div class="controls">
							<b>
							<?php
								echo $attendees[0]->discount;
							?>
							</b>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<div class="control-group">											
						<label class="control-label">Amt. of Discount <i>(Amt. x (Discount / 100)</i>:</label>
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
					<br>
					<div class="control-group">											
						<label class="control-label">Amt. to be Paid <i>(Amt. - Discount)</i>:</label>
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
						<label class="control-label">Cash Received:</label>
						<div class="controls">
							<b>
							<?php
								echo number_format($attendees[0]->cash_received, 0);
							?>
							</b>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<hr>
					<div class="control-group" style="background: #f5f900;">											
						<label class="control-label">Remaining Balance <i>(Amt. to be Paid - Cash Received)</i>:</label>
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
		        </span>
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


	$('#attendance_status').change(function() {
		var v = $(this).val();

		if(v == 'Reschedule') {
			alert('If you choose to RESCHEDULE you also need to change the TRAINING DATE.');
		}
	});
});	
</script>