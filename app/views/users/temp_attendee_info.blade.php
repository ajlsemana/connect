<ol class="breadcrumb">
	@foreach ($breadcrumbs as $breadcrumb)
		<li class="{{ $breadcrumb['class'] }}"><a href="{{ $breadcrumb['href'] }}">{{ $breadcrumb['text'] }}</a></li>
   	@endforeach
</ol>

<div class="widget">
	<div class="widget-header">
		<i class="icon-user"></i>
		<h3>{{ $user->course }} - {{ $user->first_name.' '.$user->last_name }}</h3>
		<span class="pagination-totalItems">Total: 1</span>
	</div><!-- /widget-header -->

	<div class="widget-content">
		<div id="div-reports" class="table-responsive">
		<table id="tbl-reports" class="table table-condensed table-hover table-striped">
			<thead>
				<tr>
					<th>Proposal</th>
					<th>Date</th>

					<th>P.O.</th>
					<th>Date</th>
					<th>Invoice</th>
					<th>Date</th>

					<th>Payment</th>
					<th>Unit <br>Price</th>
					<th>Discount (%)</th>
					<th>Total <br>Discount</th>
					<th>Payment <br>Received</th>
					<th>Balance</th>
				</tr>
			</thead>
			
			<tbody>
				@if( CommonHelper::arrayHasValue($user) ) 
				<?php $amount = (double) $user->amount; ?>
				<tr style="text-transform: uppercase;">								
					<td>{{ $user->proposal_status_sent }}</td>
					<td>{{ $user->po_date_sent }}</td>

					<td>{{ $user->proposal_status_received }}</td>
					<td>{{ $user->po_date_received }}</td>
					<td>{{ $user->invoice }}</td>
					<td>{{ $user->invoice_date_sent }}</td>

					<td>{{ $user->payment_status }}</td>
					<td>{{ number_format($amount, 0) }}</td>
					<td>{{ $user->discount }}</td>
					<td>{{ number_format(($amount * ((double) $user->discount / 100)), 0) }}</td>
					<td>{{ number_format($user->cash_received, 0) }}</td>
					<td>
						<?php
							$diff = 0;
							$diff = ($amount - ($amount * ((double) $user->discount / 100))) - (double) $user->cash_received;
							echo number_format($diff, 0);
						?>
					</td>
				</tr>
				@else
				<tr>
					<td colspan="12" class="align-center" style="padding: 10px;">Empty Results</td>
				</tr>
				@endif
			</tbody>
        </table>
        <center><a href="javascript:window.history.back();">[ Go Back ]</a></center>
        </div>
	</div><!-- /widget-content --> 
</div><!-- /widget -->