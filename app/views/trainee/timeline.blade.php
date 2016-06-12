<script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization',
   'version':'1','packages':['timeline']}]}"></script>
<script type="text/javascript">
   google.setOnLoadCallback(drawChart);
   function drawChart() {
   
   var container = document.getElementById('example5.1');
   var chart = new google.visualization.Timeline(container);
   var dataTable = new google.visualization.DataTable();
   dataTable.addColumn({ type: 'string', id: 'Room' });
   dataTable.addColumn({ type: 'string', id: 'Name' });
   dataTable.addColumn({ type: 'date', id: 'Start' });
   dataTable.addColumn({ type: 'date', id: 'End' });
   dataTable.addRows([
        {{ $results }}
     ]);
   
   var options = {
     timeline: { colorByRowLabel: true }
   };
   
   chart.draw(dataTable, options);
   }
     
</script>
<center><a href="javascript:window.history.back();">[ Go Back ]</a></center>
<div id="example5.1" style="height: 600px;"></div>