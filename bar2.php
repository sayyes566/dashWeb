<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
   <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="js/jquery-mini.js"></script>
		<style type="text/css">
               
		</style>
	
	</head>
        <script src="js/highcharts.js"></script>
<script src="js/data.js"></script>
<script src="js/exporting.js"></script>

    <body>
       <!--  <div id="reload_bar">refresh</div>-->
 <div id="container_bar" style=" max-width: 900px ;min-width: 410px; height: 300px; margin: auto;"></div>    

  

        <?php
        // put your code here

        ?>
<!-- style="display:none"---->
<table id="datatable" style="display:none" >
    
     <?php include_once 'dataBar_.php'; ?>
  <!--  
	<thead>
		<tr>
                   
			<th></th>
			<th>Jane</th>
			<th>John</th>
		</tr>
	</thead>
	<tbody>
		<tr>
		<th>Apples</th>
			<td>3</td>
			<td>4</td>
		</tr>
		<tr>
			<th>Pears</th>
			<td>2</td>
			<td>0</td>
		</tr>
		<tr>
			<th>Plums</th>
			<td>5</td>
			<td>11</td>
		</tr>
		<tr>
			<th>Bananas</th>
			<td>1</td>
			<td>1</td>
		</tr>
		<tr>
			<th>Oranges</th>
			<td>2</td>
			<td>4</td>
		</tr>
	</tbody>
   ------> 
</table>
	<script type="text/javascript">
$(function () {
    $('#container_bar').highcharts({
        data: {
            table: document.getElementById('datatable')
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Yield by 20140930'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Yield(%)'
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' ' + this.point.name.toLowerCase();
            }
        }
    });
});
		</script>
    </body>
</html>
