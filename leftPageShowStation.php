<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="css/jqueryUI/smoothness/jquery-ui.css">
  <script src="js/jquery-mini.js"></script>
  <script src="js/jquery-ui.js"></script>
  <style>
      /*
 #stationWindow{float:top;width:450px;height:500px; overflow-x:hidden;overflow-y:scroll;overflow-style:marquee-block;}
  */
  </style>
  <script>
  $(function() {
  
             $( ".Station" ).hover(function() {
               $(this).css("color","#fff");
               $(this).siblings().css("color","#000");
           })
             $( "#Station" ).click(function() {
              var element = $(this).find('option:selected'); 
              var Condition = element.attr("id"); 
               var Station = $(this).val();
                  $(".selectSt").text(Station);
                  $(".selectStDel").show();
                   Station = Station.replace(/ /g, '\@');
                   Station = Station.replace(/&/g, 'aaa');
                   Station = Station.replace(/\+/g, 'ppp');
               $("#conditionBar").text(Condition+" and Station='"+Station+"'");
              // $( ".selectOk" ).show();
                 selected();
           })
        
  });
  </script>
</head>
<body>
    <div id="stationWindow">
   
      <select name="Station"  id="Station"> 
       <option  value="" selected="selected">Station</option>
        <?php 
        if(isset($_GET["Line"])&& isset($_GET["Condi"])&& isset($_GET["RownNme"]))
        {
        include_once 'data/dataLeftPage_showChild.php';
        $Line = trim($_GET["Line"]);
        $condition = $_GET["Condi"]."and Line='{$Line}'";
        $dt = new dataLeftPage_showChild("Station",$condition ); 
        ?> 
        <?php
        if(count($dt->arrKeyVa["Station"])>0)
        {
        foreach( $dt->arrKeyVa["Station"] as $key => $va)
        {?>
       <option  id="<?php echo $dt->arrKeyVaSql["Station"][$key];?>" value="<?php echo $va ;  ?>" >
  
         <?php
          echo $va ; 
        ?>
       </option>
         <?php }
        }else{echo "NO Data";}}?>
          </select>

 </div>
 
 
</body>
</html>