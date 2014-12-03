<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.

rmon/areaProjectLineLower.php?time=20141111&section=fatp&item=input&duration=5
-->
<html>
   <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>
<!------  <script src="js/data.js"></script>
 <script type="text/javascript" src="js/jquery-mini.js"></script>
                <script src="js/highcharts.js"></script>----->
	    <script type="text/javascript" src="js/jquery.csv.js"></script>
	</head>
        <style type="text/css">
            
            
              .content_chart_border{border:#4F4F4F 1px solid;}
        </style>

    <body>
        
        
     <div id="noData_ByLineLower" style="display:none">
        <img src="pic/noData/retestRatio.bmp" title="No Data on <?php echo $_GET["time"]; ?>" />
    </div>
       <!--  <div id="reload_bar">refresh</div>-->
      <div id="containerByLineLower" class="content_chart_border" style="  margin: auto;display:none;"></div>    
     <div id="check_ByLineLower" style="display:none" >
    <?php 
    
             require_once 'data/dataCheck.php';
             $dataCheck = new dataCheck;
             echo  $dataCheck->check($_GET["time"]);
            // echo "time:".$_GET["time"];
    ?>
    </div>
<!-- style="display:none"---->
<div id="conditionByLineLower"   style="display:none">
   <?php $parameter = "section=".$_GET["section"]."&" ;
          $parameter .= "item=".$_GET["item"]."&" ;
           $parameter .= "time=".$_GET["time"] ;
           echo $parameter;
    ?>
</div>

<div id='widthByLineLower'  style="display:none"><?php echo $_GET['width'];?></div>
<div id='heightByLineLower'  style="display:none"><?php echo $_GET['height'];?></div>
<script type="text/javascript">
    
function strReplaceYear(strDate)
{
    
    var res ="";
     var myDate ;

    for(var i=0 ; i < strDate.length ; i++)
    {
           myDate = new Date(+(strDate[i].substring(0, 4)), +(strDate[i].substring(4, 6)) - 1, +(strDate[i].substring(6, 8)));
            
            // res += strDate[i].substr(5)+',';
        res += myDate.getTime()+',';
    }
    
 //  alert(strDate[0]);//20141122
 res = res.substr(0,res.length - 1);
 //alert((strDate[0].substring(0, 4))+","+ (+strDate[0].substring(4, 6)-1) +","+ (strDate[0].substring(6, 8)));
  //alert(res);
 //  $("#testQ").text(res);
 //res = JSON.parse(res);
    return res.split(",");
}
function rotation(mode)
{
    if( mode == "all") return -40;
    else return -10;
}
function chartType(mode)
{
    if( mode == "all") return 'areaspline';
    else return 'line';
}
function createChart(url,render,mode)
{
    
        // var url = "data/dataProjectLineLower.php?"+condi+"&time="+time_var;
       // alert(url);
        //time=20141111&section=fatp&item=input&duration=10
       // var url = 'js/test.js';
  $("#containerByLineLower").css("max-width","100%");
  $("#containerByLineLower").css("height","200px");
   // $("#containerByLineLower").css("min-width","20%");

  $.getJSON(url, function(json) {
     //  var parsed_data = $.csv.toObjects(json);


         //  alert( json[0]['time']); 
              areaProjLiLow = new Highcharts.Chart({
   chart: {
            renderTo:render,
            type: chartType(mode),
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
            shared: false,
            valueSuffix: ' units',
            // xDateFormat: '{value:%Y-%m-%d}',
           formatter: function() {
          return '<b>'+ Highcharts.numberFormat(this.y, 0) +'</b><br/>'+
                    ' '+ Highcharts.dateFormat('%Y/%b/%e(%A)', this.x);
          //  return  Highcharts.dateFormat('%Y/%b/%e', this.x);
                 }
       
        },
        legend: {
series: [{
     showInLegend: true
     
}]
        },
        xAxis: {
            categories: strReplaceYear( json[0]['time']),
      
            type: 'datetime',
            dateTimeLabelFormats:{
            day: '%b/%e',
            week: '%b/%e'
          } ,
           labels: {
               formatter: function() {
                var day = Highcharts.dateFormat("%e",this.value); 
                var month = Highcharts.dateFormat("%b",this.value); 
                  if (mode== "few"){
                    return Highcharts.dateFormat("%b/%e",this.value); 
                }else if (mode== "all"){
                    if(day%2==0)  return Highcharts.dateFormat("%e",this.value); 
                    else  if(month==1)  return Highcharts.dateFormat("%Y/%b/%e",this.value); 
                    else  if(day==1)  return Highcharts.dateFormat("%b/%e",this.value); 
                    else return ""; 
                }else{
                    return Highcharts.dateFormat("%e",this.value); // just month
                }
            },         
                rotation:  rotation(mode),
                style: {
                    fontSize: '12px',
                    fontFamily: 'Arial, sans-serif'
                }
                /*
                 formatter: function() {
         
            return  Highcharts.dateFormat('%b/%e', this.value);
                 }*/
            }
        
        },
        yAxis: {
            title: {
                text: 'Input (units)'
            }
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

                    series: json,
                    

                });
         })      
}
     $(function () {
         
           var checkDate =  $.trim($("#check_ByLineLower").text());
     if (checkDate==0)
        {
          $("#noData_ByLineLower").show(); 
         
          
        }//check date
        else
        {
          $("#containerByLineLower").show(); 
       
        }
      
       var areaProjLiLow;
                      
      ///Tooltip always visialbe
         (function (H) {
    H.wrap(H.Tooltip.prototype,  'hide', function (defaultCallback) {
      
    });
    
}(Highcharts));
//var time_var = $.trim($("#time").text()),

         var condi = $("#conditionByLineLower").text();
        var url = "data/dataProjectLineLower.php?duration=4&"+condi;
        createChart(url,'containerByLineLower',"few");
         $( "#diagoByLineLower" ).dialog({
                         autoOpen: false,
                      //  resizable: false,
                        heigh:'80%',
                        width:'90%',
                       // modal: true,
                        show: {
                          effect: "blind",
                          duration: 1000
                        },
                        hide: {
                          effect: "explode",
                          duration: 1000
                        },
                         title: 'Input Trend of FATP',
                        position: { my: "center", at: "top", of:  window}
                      });

                       $( "#containerByLineLower" ).dblclick(function() {
                         $( "#diagoByLineLower" ).dialog( "open" );
                  
                    var url = "data/dataProjectLineLower.php?"+condi;
                         createChart(url,'diagoByLineLower_all',"all");
                        $("#diagoByLineLower_all").css("max-width","100%");
                        $("#diagoByLineLower_all").css("height","500px");
                    //alert(url);
                     // var aaa = $("#containerByLineLower").html();
                     //  $("#diagoByLineLower_all").html(aaa);
                      });
});


</script>
         
    </body>
</html>
