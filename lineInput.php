<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>
		
	<!---	
 <script type="text/javascript" src="js/jquery-mini.js"></script>
                <script src="js/highcharts.js"></script>

  <script src="js/exporting.js"></script> ---->
	</head>
	<body>
    <div id="lineInput"></div>
   <div id="container_lineInput" style=" max-width: 900px ;min-width: 410px; height: 300px; margin: auto;"></div>  
 <!--<div id="reload_line">refresh</div>-->

    <?php $parameter = "section=".$_GET["section"]."&" ;
          $parameter .= "factory=".$_GET["factory"]."&" ;
          $parameter .= "line=".$_GET["line"]."&" ;
          $parameter .= "station=".str_replace("@"," ",$_GET["station"])."&" ;
          $parameter .= "time=".$_GET["time"] ;
       //echo $parameter;
    ?>
 	<script type="text/javascript">
$(function () {
    var chartLineInput;
    $(document).ready(function() {
      var condition =  $(".condi").text();

      var url = "data/dataLine.php?item=input_count&"+ condition;
        $.getJSON(url, function(json) {
	    
		    chartLineInput = new Highcharts.Chart({
	            chart: {
	                renderTo: "lineInput",
	                type: 'line',
	                marginRight: 130,
	                marginBottom: 25
	            },
	            title: {
	                text: '5-days '+json[0]['role']+' chart',
	                x: -20 //center
	            },
	            subtitle: {
	                text: '',
	                x: -20
	            },
	            xAxis: {
	                categories: json[0]['lable']
	            },
	            yAxis: {
	                title: {
	                    text: 'Input()'
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
                /*
                options.xAxis.categories = json[0]['lable'];
                options.series[0] = json[1];
                options.series[1] = json[2];
                chartLine = new Highcharts.Chart(options);*/
	    });
    
    });
    
});
		</script>
                <font class="condi" divN="<?php echo $_GET["divName"];?>" style="display:none;"><?php echo $parameter;?></font>
        
	</body>
</html>
