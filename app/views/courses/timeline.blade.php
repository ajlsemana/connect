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
<div class="row">
   <div class="span12">
      <div class="widget">
         <div class="widget-header">
            <i class="icon-comments"></i>
            <h3>{{ $course->name }} {{ $module }}</h3>
         </div>
         <div class="widget-content">
            <div class="tab-content">
               <div class="tab-pane active" id="wall">
                  <div class="row">
                     <div class="span12">                        
                        {{ $menu }}
                        <div class="table-responsive">                          
                          <div id="example5.1" style="height: 600px;"></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>