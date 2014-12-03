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
        var $dataD;
        $.get( "dataBarDrilldown.php", function(data ) {
            $dataD =  $( "div" );
            $dataD.data("test", data );
         
            $( "#tsv" ).append( $dataD.data( "test" ) );
       
         if($dataD == null)
             $( "#divTest" ).append( "dataD" );
            else
            $( "#divTest" ).append( "noNull" );
    Highcharts.data({
        csv:    data,/* document.getElementById('tsv').innerHTML,*/
        itemDelimiter: '\t',
        parsed: function (columns) {

            var brands = {},
                brandsData = [],
                versions = {},
                drilldownSeries = [];

            // Parse percentage strings
            columns[1] = $.map(columns[1], function (value) {
                if (value.indexOf('u') === value.length - 1) {
                    value = parseFloat(value);
                }
                return value;
            });

            $.each(columns[0], function (i, name) {
                var brand,
                    version;

                if (i > 0) {

                    // Remove special edition notes
                    name = name.split(' -')[0];

                    // Split into brand and version
                    version = name.match(/([v]+[0-9]*)/);
                    /* version = name.match(/([0-9]+[\.0-9x]*)/);*/
                    
                    if (version) {
                        version = version[0];
                    }
                    brand = name.replace(version, '');

                    // Create the main data
                    if (!brands[brand]) {
                        brands[brand] = columns[1][i];
                    } else {
                        brands[brand] += columns[1][i];
                    }

                    // Create the version data
                    if (version !== null) {
                        if (!versions[brand]) {
                            versions[brand] = [];
                        }
                        versions[brand].push(['v' + version, columns[1][i]]);
                    }
                }

            });

            $.each(brands, function (name, y) {
                brandsData.push({
                    name: name,
                    y: y,
                    drilldown: versions[name] ? name : null
                });
            });
            $.each(versions, function (key, value) {
                drilldownSeries.push({
                    name: key,
                    id: key,
                    data: value
                });
            });
           
            // Create the chart
            $('#container').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Browser market shares. November, 2013'
                },
                subtitle: {
                    text: 'Click the columns to view versions. Source: netmarketshare.com.'
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Total percent market share'
                    }
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> of total<br/>'
                },

                series: [{
                    name: 'Brands',
                    colorByPoint: true,
                    data: brandsData
                }],
                drilldown: {
                    series: drilldownSeries
                }
            });
        }
    });
     } );
});

		</script>
	</head>
        <script src="js/highcharts.js"></script>
<script src="js/data.js"></script>
<script src="js/drilldown.js"></script>

    <body>
 <div id="container" style=" max-width: 600px ;min-width: 310px; height: 400px; margin: auto;"></div>    
 <div id="divTest"></div>
  
<pre id="tsv">
F4 v20140701	37u  
F3 v20140702	0u
F4 v20140701	37u  
F3 v20140702	2u    
</pre>




    </body>
</html>
