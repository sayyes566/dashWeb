<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
       <?php  date_default_timezone_set("Asia/Taipei");?>
        <title></title>
           
                <link rel="stylesheet" href="css/jqueryUI/smoothness/jquery-ui.css">
                <link rel="stylesheet" href="css/topPage.css" >
                <script type="text/javascript" src="js/jquery-mini.js"></script>
                <script type="text/javascript" src="js/jquery-ui.js"></script>
                <script type="text/javascript" src="js/topPage.js"></script>
                <script type="text/javascript"  src="js/exporting.js"></script>
                <script type="text/javascript" src="js/highcharts.js"></script>
   
 
               
		<style type="text/css">
               .content_chart{ float:left;margin-left:10px;width:280px; height:200px;display: inline-block;   cursor: pointer;}
               .content_chart2{float:left; margin-left:250px;}
             
               #reload_bar{display: inline-block;   cursor: pointer;}
               #reload_line{display: inline-block;   cursor: pointer;}
               #reload_table{display: inline-block;   cursor: pointer;}
               .selectOk{display: inline-block;   cursor: pointer; float:left; margin-left:10%; color:#fff; border:#fff 1px solid;}
               /*
               #getTable{float:left;margin-left: 20px; width:40%; height:350px ; }/*border:#0000FF 1px solid; padding: 20px;*/
              /* #getBar{ float:left;margin-left: 20px;width:40%; height:350px; }
               #getLine{ float:left;margin-left: 20px;width:40%; height:350px;}
              #getLineInput, #getLineInput1, #getLineInput2, #getLineInput3, #getLineInput4, #getLineInput5, #getLineInput6{ float:left; margin-left: 20px;width:40%; height:350px;}
              #getLineYield, #getLineYield1,#getLineYield2,#getLineYield3,#getLineYield4,#getLineYield5,#getLineYield6{ float:left; margin-left: 20px;width:40%; height:350px;}
               #getTrendYield{ float:left;margin-left: 20px;width:300px ; height:350px;}
               #getTrendInput{float:left;margin-left: 20px;width:300px ; height:350px;}*/
               #floor1{float:left;  width:100%; margin-top:-20px; }
               #floor2{float:left; top:100px;width:100%; margin-top:20px;}
               #reload{display: inline-block;   cursor: pointer; }
               #tabs{float:left; border-color: #fff;background-color: #fff; }
               #tabs ul{border-color: #fff;}
               #tabs ul li {background-color: #fff;border-color: #fff;}
               #leftPage{float:left; width: 10%; height:500px;}
		</style>
                
          
    </head>
    <body>
 <!--topPage-------------------------------------->
<div id="optionBoard" >
    <div id="selectBar"><font class="selectBartext" style="display:none;color:#fff;" >Selected:</font>
<font class="selectTitle" >
<font class="selectPr"></font> 
<font class="selectSeDel" style="display:none;">></font> <font class="selectSe"></font>
<font class="selectFaDel" style="display:none;">></font><font class="selectFa"></font> 
<font class="selectLiDel" style="display:none;">></font><font class="selectLi"></font>
<font class="selectStDel" style="display:none;">></font><font class="selectSt"></font>
</font>
  <div id="reload" title="refresh"> ☆</div>
    </div>
<div id="rmonWholeTreeBtn">
<input type="text" value="Please pick a date" id="date_sel" name="date" />
<button onclick="selectDate()" class="addColor">Go</button>
</div>
  <div id="widthTree_PS"></div> <div id="widthTree_Factory"></div> <div id="widthTree_Line"></div> <div id="widthTree_Station"></div>
<font class="selectOk" style="display:none;">OK</font>

</div>
<button id="btnOptBod" title="RMON OPTION"  ><img src="pic/css/up.png" width="10px" heigh="5px" /></button>
<div id="conditionBar" style="visibility: hidden;font-size: 0px;"></div>
<!--topPage-------------------------------------#-->   
<!--<div id="leftPage"></div> --#-->  
<div id="content">
     
   <!--- <center><h1> RMON REPORT <span></span></h1></center>#--> 
    <div id="floor1">
         <div id="getTrendGoLine" class="content_chart">Golden Line</div>
         <div id="getYieldbyLine" class="content_chart content_chart2">Yield by Line</div>
         <div id="getProjectLineLower" class="content_chart ">LineLower</div>
    </div>
    <div id="floor2">
        <div id="getTrendYield" class="content_chart">Yield</div>
        <div id="getTrendInput" class="content_chart">Input</div>
        <div id="getTrendRetestRatio" class="content_chart" condi="section=FATP">Retest Ratio</div>
        <div id="getTrendFail" class="content_chart">Fail</div>
        <div id="getFailFallOut" class="content_chart">Fail Fall Out</div>
        <div id="getYieldFallOut" class="content_chart ">Yield Fall Out</div>
     
    </div>
    
        
      
 <!---tab--
     <div id="tabs">
  <ul>
    <li style="margin-left: 200px"></li>
    <li><a href="#tabs-1">All</a></li>
    <li><a href="#tabs-2">Basic</a></li>
    <li><a href="#tabs-3">Anomaly</a></li>
    <li><a href="#tabs-4">Alert</a></li>
    <li><a href="#tabs-5">Summary</a></li>
  </ul>
  <div id="tabs-1">
        <div id="getTrendYield" class="content_chart">1</div>
        <div id="getTrendInput" class="content_chart">2</div>
        <div id="getTrendRetestRatio" class="content_chart">1</div>
        <div id="getTrendFail" class="content_chart">2</div>
          <div id="getTrendGoLine" class="content_chart">1</div>
  </div>
  <div id="tabs-2">
      <div id="getTable" class="content_chart"></div>
  </div>
  <div id="tabs-3">
      <div id="getTable" class="content_chart"></div>
  </div>
   <div id="tabs-4">
      <div id="getTable" class="content_chart"></div>
  </div>
  <div id="tabs-5">
     <div id="getLineYield" class="content_chart">yLine</div>
     <div id="getLineInput" class="content_chart">line</div>
  </div>
</div>
<!---tab#----->
      
      
        
       
        <div id="getBar"></div><br />
    
        <?php
        // put your code here
        ?>
         <script type="text/javascript">
             
             function getTodayDay()
             {
                 return   today = $("#date").text();
             }
             
                    /*
                    $(document).ready(function() {
                  
                $("#getTable").load("table");
                      });
                   $(document).ready(function() {
                  
                  $("#getBar").load("bar");
                      });
                        $(document).ready(function() {
                   $("#getLine").load("line");
                      });*/

               $(function() {
                           
                     
                 
                //show tab
               $( "#tabs" ).tabs();
               //get today's date
               var today = $("#date").text();
               $("#getTrendGoLine").ready(function(){
                $("#getTrendGoLine").load("trend_GoldenLine.php?ago=5&time="+today);
                }) 
                $("#getFailFallOut").ready(function(){
                $("#getFailFallOut").load("trend_FailFallOut.php?item=fail&time="+today);
                }) 
                 $("#getYieldFallOut").ready(function(){
                $("#getYieldFallOut").load("trend_YieldFallOut.php?item=yield&time="+today);
                }) 
                  $("#getYieldbyLine").ready(function(){
                $("#getYieldbyLine").load("trend_YieldbyLine.php?item=yield&time="+today);
                }) 
                 $("#getProjectLineLower").ready(function(){
                $("#getProjectLineLower").load("areaProjectLineLower.php?section=fatp&item=input&time="+today);
                }) 
                //areaProjectLineLower.php?item=input &section=fatp&duration=5&time="+today
                //areaProjectLineLower.php?time=20141111&section=fatp&item=input&duration=5
                $("#getTrendInput").ready(function(){
                $("#getTrendInput").load("trend_Input.php?item=input&section=FATP&time="+today);
                })  
                   $("#getTrendYield").ready(function(){
                $("#getTrendYield").load("trend_Yield.php?item=yield&section=FATP&time="+today);
                })  
              
                  $("#getTrendRetestRatio").ready(function(){
                $("#getTrendRetestRatio").load("trend_Retest_Ratio.php?time="+today);
                })  
                   $("#getTrendFail").ready(function(){
                $("#getTrendFail").load("trend_Fail.php?section=FATP&time="+today);
                })
                 
                   $("#getTable").ready(function(){
                $("#getTable").load("table");
                })  
                
               
                  $("#getLineInput").ready(function(){
                $("#getLineInput").load("lineInput?time=20140830&section=FATP");
                })
                   $("#getLineYield").ready(function(){
                $("#getLineYield").load("lineYield?time=20140830&section=FATP&factory=F4");
                })
                
         
                    /*
                  
                   $("#getTable").ready(function(){
                $("#getTable").load("table");
                })  
                 $("#getTrendYield").ready(function(){
                 
                  $("#getTrendYield").load("trend_new.php?item=yield&time=20140926&section=FATP");
             
                 }) 
                
              
                $.get("table",function(data)
                {
                       $("#getTable").html(data);
                   
                });
           /* 
                $(document).ready(function(){
                $("#getTable").load("table");
                })
                $(document).ready(function(){
                $("#getBar").load("bar");
                })
                $(document).ready(function(){
                $("#getLine").load("line");
                })*/
      
                $( ".content_chart" ).draggable({ scroll: true, scrollSpeed: 100 });
              //  $( "#chart_trend_div_yield_" ).draggable({ scroll: true, scrollSpeed: 100 });
                $( "#diago_inputTrend" ).draggable({ handle:'.header'});
                
        /*
                $( "#getTrendYield" ).draggable({ scroll: true, scrollSpeed: 100 });
                $( "#getTrendInput" ).draggable({ scroll: true, scrollSpeed: 100 });
                $( "#getTable" ).draggable({ scroll: true });
                $( "#getBar" ).draggable({ scroll: true, scrollSensitivity: 100 });
                $( "#getLine" ).draggable({ scroll: true, scrollSpeed: 100 });
                $( "#getLineInput" ).draggable({ scroll: true, scrollSpeed: 100 });
                $( "#getLineYield" ).draggable({ scroll: true, scrollSpeed: 100 });*/
                $( "#reload" ).click(function() {
                 //  location.reload();
                 selected();
                  /* $("#getBar").reload("bar");*/
                  });
                $( "#reload_bar" ).click(function() {
                   location.reload();
                  /* $("#getBar").reload("bar");*/
                  });
                  $( "#reload_table" ).click(function() {
                      $('#reload_line').hide();
                    // $('#container_table').show();
                  /* $("#getTable").reload("table");*/
                  });
                 $( "#reload_line" ).click(function() {
                   $("#getLine").reload("line");
                  });
                  
                  
 
                 });//end jquery function
                 
                 
                 
                </script>
   </div>
  <?php  $today = date("Ymd");?>
<div id="date" style="display:none"><?php echo $today; ?></div>
<!---
<div id="check" >
    <?php 
    
             require_once 'data/dataCheck.php';
             $dataCheck = new dataCheck;
             echo  $dataCheck->check($today);
            
    ?>

</div>--->
<!-----------Dialog---Windows----------->
  <!-------<button id="opener">Open Dialog</button>---------->
       <div id="diagoGoldenLine"  style="display:none;position:relative;"  >
        <div id="diagoGoldenLine_content" style=" max-width: 80% ;min-width: 70%; margin: auto;"></div> 
    </div>
       <div id="diagoByLineLower"  style="display:none;position:relative;"  >
        <div id="diagoByLineLower_all" style=" max-width: 80% ;min-width: 70%; margin: auto;"></div> 
    </div>
    <div id="chart_trend_div_yield_"  style="display:none;position:relative;"  >
        <div id="line_trend_div_yield" style=" max-width: 80% ;min-width: 70%; margin: auto;">please wait....no Data</div> 
        <hr />
        <div id="bar_trend_div_yield"  >ff</div>
    </div>
  <div id="diago_inputTrend"  style="display:none;"  >
        <div id="diago_inputTrend_line" style=" max-width: 80% ;min-width: 70%; margin: auto;">please wait....no Data</div> 
        <hr />
        <div id="diago_inputTrend_Bar"  >ff</div>
    </div>
  <div id="diago_failTrend"  style="display:none;"  >
        <div id="diago_failTrend_line" style=" max-width: 80% ;min-width: 70%; margin: auto;">please wait....no Data</div> 
        <hr />
        <div id="diago_failTrend_Bar"  >ff</div>
    </div>
    <div id="diago_retestTrend"  style="display:none;"  >
        <div id="diago_retestTrend_line" style=" max-width: 80% ;min-width: 70%; margin: auto;">please wait....no Data</div> 
        <hr />
        <div id="diago_retestTrend_Bar"  >ff</div>
    </div>
   <div id="diago_yieldbyLine"  style="display:none;"  >
        <div id="diago_yieldbyLine_content" style=" max-width: 80% ;min-width: 70%; margin: auto;">please wait....no Data</div> 
    </div>
     <div id="diago_FailFallOut"  style="display:none;"  >
        <div id="diago_FailFallOut_content" style=" max-width: 80% ;min-width: 70%; margin: auto;">please wait....no Data</div> 
    </div>
     <div id="diago_YieldFallOut"  style="display:none;"  >
        <div id="diago_YieldFallOut_content" style=" max-width: 80% ;min-width: 70%; margin: auto;">please wait....no Data</div> 
    </div>
  <!-----------Dialog------------#-->
    </body>
</html>
