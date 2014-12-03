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
		<script type="text/javascript">
                    
$(function () {
    $.getJSON("data/dataPie.php", function(json) {
  //  chart = new Highcharts.Chart({

    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,//null,
            plotShadow: false
        },
        title: {
            text: 'Browser market shares at a specific website, 2014'
        },
        tooltip: {
        pointFormat: '{point.name}: <b>{point.percentage:.1f}%</b>'
    },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series:json/*[ [{
            type: 'pie',
            name: 'Browser share',
            data: 
                ['Firefox',   45.0],
                ['IE',       26.8],
                {
                    name: 'Chrome',
                    y: 12.8,
                    sliced: true,
                    selected: true
                },
                ['Safari',    8.5],
                ['Opera',     6.2],
                ['Others',   0.7]
            ]
        }]*/
    });
});
 });


		</script>
	</head>
<script src="js/highcharts.js"></script>
<script src="js/exporting.js"></script>

    <body>
 <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>       

        <?php
        // put your code here
        echo "HI";
        echo "HI";
        ?>

<pre id="tsv" style="display:none">Browser Version	Total Market Share
Microsoft Internet Explorer 8.0	26.61%
Microsoft Internet Explorer 9.0	16.96%
Chrome 18.0	8.01%
Chrome 19.0	7.73%
Firefox 12	6.72%
Microsoft Internet Explorer 6.0	6.40%
Firefox 11	4.72%
Microsoft Internet Explorer 7.0	3.55%
Safari 5.1	3.53%
Firefox 13	2.16%
Firefox 3.6	1.87%
Opera 11.x	1.30%
Chrome 17.0	1.13%
Firefox 10	0.90%
Safari 5.0	0.85%
Firefox 9.0	0.65%
Firefox 8.0	0.55%
Firefox 4.0	0.50%
Chrome 16.0	0.45%
Firefox 3.0	0.36%
Firefox 3.5	0.36%
Firefox 6.0	0.32%
Firefox 5.0	0.31%
Firefox 7.0	0.29%
Proprietary or Undetectable	0.29%
Chrome 18.0 - Maxthon Edition	0.26%
Chrome 14.0	0.25%
Chrome 20.0	0.24%
Chrome 15.0	0.18%
Chrome 12.0	0.16%
Opera 12.x	0.15%
Safari 4.0	0.14%
Chrome 13.0	0.13%
Safari 4.1	0.12%
Chrome 11.0	0.10%
Firefox 14	0.10%
Firefox 2.0	0.09%
Chrome 10.0	0.09%
Opera 10.x	0.09%
Microsoft Internet Explorer 8.0 - Tencent Traveler Edition	0.09%</pre>

    </body>
</html>
