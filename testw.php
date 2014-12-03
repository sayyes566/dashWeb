<!DOCTYPE html>
<html>
  <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Trend</title>
 
    <style type="text/css">
   
    </style>
    <!-- script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script-->

    <script type="text/javascript" src="js/jquery-1.9.1.js"></script>

  </head>

  <body>
    <div id="chart_trend">7</div>
    <script type="text/javascript">
         

               $(function() {
              $("#getTrendYield").ready(function(){
                 
                 $("#getTrendYield").load("trend_new.php?item=yield&time=20140926&section=FATP");
                 $("#getTrendInput").text("333333");
                 })   
                })  
    </script>
    <div id="getTrendYield">w</div>
  </body>
</html>