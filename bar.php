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
<!------
		<script type="text/javascript" src="js/jquery-mini.js"></script>
                                            <script type="text/javascript" src="js/jquery-ui.js"></script>
                                             <script src="js/highcharts.js"></script>
                                           
                                            <script src="js/exporting.js"></script>----->
	  <script src="js/data.js"></script>
	</head>


    <body>
       
       <!--  <div id="reload_bar">refresh</div>-->
      <div id="container_bar" style=" max-width: 80% ; min-width: 70%;  margin: auto;">1234</div>    

<!-- style="display:none"---->
<table id="datatable"   style="display:none">
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
  require_once('data/dataTrendYieldBar.php');
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
     
$(function () {
    
   
   
   var  selectStation = $(".selectSt").text();
  // selectStation = "station";
   
       var chartBar1 = new Highcharts.Chart({
        data: {
        
            table: document.getElementById('datatable')
        },
        chart: {
            renderTo: 'container_bar',
            type: typeChart(selectStation)  //'column'
        },
        title: {
            text: ''
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Yield(%)'
            }
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
