<ol class="breadcrumb">
	@foreach ($breadcrumbs as $breadcrumb)
		<li class="{{ $breadcrumb['class'] }}"><a href="{{ $breadcrumb['href'] }}">{{ $breadcrumb['text'] }}</a></li>
   	@endforeach
</ol>
<div class="widget">
	<div class="widget-header">
		<i class="icon-user"></i>
		<h3>Business Report for <u>{{ strtoupper($full_course) }}</u></h3>		
	</div><!-- /widget-header -->

	<div class="widget-content">
		<div id="div-reports" class="table-responsive">
		<table id="tbl-reports" class="table table-condensed table-hover table-striped">
			<thead>
				<tr>
					<th>Total<br>Attendees</th>
					<th>PO</th>
					<th>POP</th>
					<th>Billed<br>Amount</th>
					<th>Unbilled<br>Amount</th>
					<th>Total Amount<br>(Billed + Unbilled)</th>
					<th>Payment<br>Received</th>
					<th>Cost</th>
					<th>Proposed<br>Revenue</th>	
					<th>Actual<br>Revenue</th>				
					<th>Balance</th>
				</tr>
			</thead>
			
			<tbody>
				@if( CommonHelper::arrayHasValue($users) ) 
				<tr>
					<td>{{ $total }}</td>
					<td>{{ $reference['with_po_count'] }}</td>
					<td>{{ $reference['pop_count'] }}</td>
					<td>{{ number_format($reference['billed_amount_po']->billed_amount, 0) }}</td>
					<td>{{ number_format($reference['unbilled_amount_pop'], 0) }}</td>
					<td>{{ number_format($reference['billed_amount_po']->billed_amount + $reference['unbilled_amount_pop'], 0) }}</td>
					<td>{{ number_format($reference['payment_received'], 0) }}</td>
					<td><a title="training cost" target="_blank" href="{{ URL::to('admin/attendees/add-cost/'.Input::segment(4)) }}">{{ number_format($reference['training_cost']->cost, 2) }}</a></td>
					<td>{{ number_format(($reference['billed_amount_po']->billed_amount + $reference['unbilled_amount_pop']) - $reference['training_cost']->cost, 0) }}</td>
					<td>{{ number_format($reference['billed_amount_po']->billed_amount - $reference['training_cost']->cost, 0) }}</td>
					<td>{{ number_format($reference['billed_amount_po']->billed_amount - $reference['payment_received'], 0) }}</td>
				</tr>
				@else
				<tr>
					<td colspan="10" class="align-center" style="padding: 10px;">Empty Results</td>
				</tr>
				@endif
			</tbody>
        </table>
        </div>
	</div><!-- /widget-content --> 
</div><!-- /widget -->				  	