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
      <div id="container_RetestTrend_bar" style=" max-width: 80% ; min-width: 70%;  margin: auto;"></div>    

<!-- style="display:none"---->
<table id="datatable_retestTrend"   style="display:none">
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

  require_once('data/dataTrendBar.php');
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
     function getUrl(item,url)
    {
        var time_var = $.trim($("#time").text());
          
       // var    item_var = $.trim($("#item").text());
       var     item_var = 'retest_ratio';
          //  time_var = '20141104';
         var condition = $("#conditionBar").text();
        condition = condition.replace(/\anda/g,"\#").replace(/\and/g,"&").replace(/ /g,"").replace(/'/g,"").replace(/\#/g,"anda").replace(/\Date/g,"time");
        condition =  condition.toLowerCase();
        var url_string;
         if(condition=="")
             url_string = url+"?time="+time_var+"&item=" + item_var +"&section=FATP";
       else
             url_string = url+"?item=" + item  +"&"+condition;
        
        return url_string;
    }
    function createChart(url,render)
{
      var countSt = $("#Station").children().length;
     var  selectStation = $(".selectSt").text();
  $.getJSON(url, function(json) {
   // $("#reload_bar").text(json);

      var areaProjLiLow = new Highcharts.Chart({
   chart: {
            renderTo:render,
            height:countStion(selectStation,countSt),
             type: typeChart(selectStation) ,
            zoomType:'xy'
          
        },
        title: {
            text: 'Input Trend of FATP ',
            style: {
                    fontSize: '14px',
                    fontFamily: 'Verdana, sans-serif'
                }
        },
        
         tooltip: {
            shared: false

        },
        legend: {
series: [{
     showInLegend: true
     
}]
        },
        xAxis: {
            categories:  json[0]['lable']
        },
        yAxis: {
            title: {
                text: 'retest_ratio (%)'
            },
            ceiling:   json[0]['max'][0],
            floor:   json[0]['min'][0]
        },
       
        credits: {
            enabled: false
        },
        plotOptions: {
             areaspline: {
              
                  fillOpacity: 0.7,
                lineWidth: 4,
                states: {
                    hover: {
                        lineWidth: 5
                    }
                },
       
                marker: {
               
                    enabled: false
                }              
            }
        },

                  series: json
                    

                });
               });   
       
}
$(function () {
   //   y_itemName();
   var countSt = $("#Station").children().length;
   var  selectStation = $(".selectSt").text();
  // selectStation = "station";
  var item ='retest_ratio';
  var url = 'data/dataTrendBarJson.php';
  url =  getUrl(item,url);
  createChart(url,'container_RetestTrend_bar');
  
    
});
</script>
         
    </body>
</html>
