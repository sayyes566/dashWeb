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
       
       <!--  <div id="reload_bar">refresh</div>-->
      <div id="container_FailTrend_bar" style=" max-width: 80% ; min-width: 70%;  margin: auto;"></div>    

<!-- style="display:none"---->
<table id="datatable_failTrend">
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

  require_once('data/dataTrendBar2.php');
    $dt = new dataTrendYieldBar(); 
    $dt->getJsonData();

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
    
   
   var countSt = $("#Station").children().length;
   var  selectStation = $(".selectSt").text();
  // selectStation = "station";
   
       var chartBar1 = new Highcharts.Chart({

        data: {
        
            table: document.getElementById('datatable_failTrend')
        },
        chart: {
            renderTo: 'container_FailTrend_bar',
             height:countStion(selectStation,countSt),
            type: typeChart(selectStation)  //'column'
        },
        title: {
            text: 'Comparison Bar Chart'
        },
         xAxis: {
             categories:  this.x,
            labels: {
                
                rotation: 0,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'fail(units)'
            }
        },
         credits: {
      enabled: false
  },
        tooltip: {
            formatter: function () {
                return  this.series.name +': <b>' +  this.point.name.toLowerCase()+ '</b><br/>' +
                    this.point.y ;
            }
        }
    });
});
</script>
         
    </body>
</html>
