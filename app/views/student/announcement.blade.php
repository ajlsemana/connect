<h1 class="page-header">Announcements</h1>	
  <div class="col-sm-12">
   <div class="table-responsive">
      <table class="table table-striped">
         <tbody>            
            <?php		            	
            	$month_now = date('M');
            ?>                     
            @for($i = 12; $i >= 1; $i--)
            	<?php
            		if($i < 10) {
            			$i = '0'.$i;
            		}
            	?>
            	@if(array_key_exists($i, $announcement))            		
            		<?php $row_span = count($announcement[$i]); ?>		            	     			           
	            		@foreach($announcement[$i] as $key => $value)
	            		<?php $subStr = substr($value, 0, 3); ?>
	            		<?php $explode = explode('|', $value); ?>	            	
	            		<tr> 
	            			@if($key == 0)
	        					<td style="{{ ($subStr == $month_now ? 'color: #6ba3ff;' : '') }}" rowspan="{{ $row_span }}"><strong>{{ substr($explode[0], 0, 3) }}</strong></td>            			
	        				@endif	        				
	        				<td>{{ $explode[0] }}</td>
	        				<td>{{ $explode[1] }}</td>            			
	            		</tr>	            		
	            		@endforeach
            	@endif
            @endfor
         </tbody>
        </table>