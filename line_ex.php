<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>
		
	<!---	---->
 <script type="text/javascript" src="js/jquery-mini.js"></script>
                <script src="js/highcharts.js"></script>
	</head>
	<body>
  <script src="js/exporting.js"></script>
   <div id="container_line" style=" max-width: 900px ;min-width: 410px; height: 300px; margin: auto;"></div>  
 <!--<div id="reload_line">refresh</div>-->
<div id="reload_line">refresh</div>
    <?php $parameter = "section=".$_GET["section"]."&" ;
          $parameter .= "factory=".$_GET["factory"]."&" ;
          $parameter .= "line=".$_GET["line"]."&" ;
          $parameter .= "station=".str_replace("@"," ",$_GET["station"])."&" ;
          $parameter .= "time=".$_GET["time"] ;
       //echo $parameter;
    ?>
 	<script type="text/javascript">
$(function () {
    var chartLine;
  //  $(document).ready(function() {
     // var condition =  $(".condi").text();
    //  var url = "data/dataLine.php?time=20141111&section=fatp&item=input";
       //    var url = "data/dataProjectLineLower.php?time=20141111&section=fatp&item=input";
       
       $.ajax({
 url : 'js/test.js',
 data : { param : "value" },
 dataType : 'text',
 type : 'get',
 success : function(text) {
   // called after the ajax has returned successful response
   alert( text ); // alerts the response
 }
});
    
});
		</script>
                <font class="condi" style="display:none;"><?php echo $parameter;?></font>
        
	</body>
</html>
