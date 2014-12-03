<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>
	<!---	<script type="text/javascript" src="js/jquery-mini.js"></script>
                <script src="js/highcharts.js"></script>---->
	</head>
	<body>
 
  <script src="js/exporting.js"></script>
 <!--<div id="reload_line">refresh</div>-->
 <div id="container_line" style=" max-width: 900px ;min-width: 410px; height: 300px; margin: auto;"></div>  
<?php ?>
 	<script type="text/javascript">
$(function () {
    var chartLine;
    $(document).ready(function() {
        $.getJSON("data/dataLine.php", function(json) {
	    
		    chartLine = new Highcharts.Chart({
	            chart: {
	                renderTo: 'container_line',
	                type: 'line',
	                marginRight: 130,
	                marginBottom: 25
	            },
	            title: {
	                text: '5-days trend chart',
	                x: -20 //center
	            },
	            subtitle: {
	                text: '',
	                x: -20
	            },
	            xAxis: {
	                categories: ['20140924', '20140925', '20140926', '20140927', '20140930']
	            },
	            yAxis: {
	                title: {
	                    text: 'percentage(%)'
	                },
	                plotLines: [{
	                    value: 0,
	                    width: 1,
	                    color: '#808080'
	                }]
	            },
	            tooltip: {
	                formatter: function() {
	                        return '<b>'+ this.series.name +'</b><br/>'+
	                        this.x +': '+ this.y;
	                }
	            },
	            legend: {
	                layout: 'vertical',
	                align: 'right',
	                verticalAlign: 'top',
	                x: -10,
	                y: 100,
	                borderWidth: 0
	            },
	            series: json
	        });
                options.xAxis.categories = json[0]['lable'];
                options.series[0] = json[1];
                options.series[1] = json[2];
                chartLine = new Highcharts.Chart(options);
	    });
    
    });
    
});
		</script>
	</body>
</html>
