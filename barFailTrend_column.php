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
<!----------->
		<script type="text/javascript" src="js/jquery-mini.js"></script>
                                            <script type="text/javascript" src="js/jquery-ui.js"></script>
                                             <script src="js/highcharts.js"></script>
                                           
                                            <script src="js/exporting.js"></script>
	  <script src="js/data.js"></script>
	</head>


    <body>
       <div id="reload_bar">refresh</div>
       <!--  <div id="reload_bar">refresh</div>-->
      <div id="container_FailTrend_bar" style=" max-width: 80% ; min-width: 70%;  margin: auto;"></div>    
      <div id="conditionBar" style="visibility: hidden;font-size: 0px;">Date ='20141105' and Project = 'Panda' and Section='CG'</div>

<!-- style="display:none"---->
<table id="datatable_failTrend"   style="display:none">
    <?php
/*
if (isset($_GET['account'])) 
{
    $account = $_GET['account']; 
  
  
}
else 
{
     $account = "select  Factory, Yield,Date from FactoryDaily where Section='FATP' and Factory between 'F3' and 'F5' and Date ='20141104'"; 
}
  require_once('data/dataBar.php');
    $dt = new dataBar(); 
    $dt->getJsonData($account);*/
    /*
     echo "a".$_GET["time"]."<br>";
echo  "b".$_GET["section"]."<br>";
  echo     "c". $_GET["factory"]."<br>";
  echo     "d". $_GET["line"]."<br>";
 echo      "e". $_GET["station"]."<br>";*/
/*
  require_once('data/dataTrendBar.php');
   $dt = new dataTrendYieldBar(); 
    $dt->getJsonData();
 * 
*/
      require_once('data/dataTest.php');
?>
 
  
</table>
<script type="text/javascript">
        function typeChart( st)
    {
        var type='' ; 
        if(!st)
            type =  'column';
        else
            type =  'bar';
        
        return type;
    }
        function countStion(st,count)
    {
        var height;
        if(!st)
            height = 450;
        else if(count>30)
            height = 950;
        else if(count>25)
            height = 870;
       else if(count>20)
            height = 650;
        else    height = 550;
     
     //   alert(height);
          return height;
    
    }
$(function () {

 var    url_string =  'data/phpToJson.php';

 $.getJSON(url_string, function(json) {
       	    chartLineInput = new Highcharts.Chart({
	            chart: {
	                renderTo: "container_FailTrend_bar",
	                type: 'line',
	                marginRight: 130,
	                marginBottom: 25
	            },
	            title: {
	              //  text: '5-days '+json[0]['role']+' chart',
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
	             //   formatter: function() {
	            //            return '<b>'+ this.series.name +'</b><br/>'+
	           //             this.x +': '+ this.y;
	          //      }
	            },
	            legend: {
	                layout: 'vertical',
	                align: 'right',
	                verticalAlign: 'top',
	                x: -10,
	                y: 100,
	                borderWidth: 0
	            },
	         //   series:[{name :'aaa',data: [29.9, {y: 34.4, color: 'red'}, 106.4]}]
                                 // series:[{"data":[20,30,20,30],"name":"bar","lable":["w","q","d","s"]}]
                                   //  series:[{"data":[20,30,20,30]}]
                                   series:json
                                  // series :[{"name":"aaaa","data":[{"y":20,"color":"#ccc"},{"y":30,"color":"#000"},{"y":50,"color":"#eee"}],"lable":["c","b","d"]}]
	        });
                /*
                options.xAxis.categories = json[0]['lable'];
                options.series[0] = json[1];
                options.series[1] = json[2];
                chartLine = new Highcharts.Chart(options);*/
 });
    });

</script>
         
    </body>
</html>
