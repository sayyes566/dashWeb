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
       #LineTemp{float:left;margin-left:0px;}
      #widthTree_Station{float:top;margin-left:180px; width:150px;height:500px;}
      .Station{float:left; width:100%;margin-left:20px; display: inline-block; cursor: pointer;  background-color:#8B7E66;}
  */
  </style>
  <script>
  $(function() {
           $( ".Line" ).hover(function() {
                $(this).css("color","#fff");
               $(this).siblings().css("color","#000");
           })
           $( "#Line" ).click(function() {
           var element = $(this).find('option:selected'); 
           var Condition = element.attr("id"); 
           var Line = $(this).val();
           $("#conditionBar").text(Condition+" and Line='"+Line+"'");
           $(".selectLi").text(Line);
           $(".selectLiDel").show();
           $(".selectSt").text("");
           $(".selectStDel").hide();
           var url = "leftPageShowStation.php?RownNme=Station&Condi="+Condition+"&Line="+Line;
            
                $.get(url,function(data)
                {
                       $("#widthTree_Station").html(data);
                      // $( ".selectOk" ).show();
                         selected();
                });
          
        
          // $("#test").load("leftPageShowLine.php?RownNme=Line&Factory="+Factory+"&Condi="+Condition);
          // $("#test").load("leftPageShowLine.php"{RownNme=Line&Factory="+Factory+"&Condi="+Condition+""});
        });
      
        
  });
  </script>
</head>
<body>   
 
    <div id="LineTemp">
          <select name="Line"  id="Line"> 
          <option  value="" selected="selected">Line</option >
        <?php 
        include_once 'data/dataLeftPage_showChild.php';
        
        $Factory = trim($_GET["Factory"]);
        
        $condition = $_GET["Condi"]."and Factory='{$Factory}'";
       /*
        echo "RownNme".$_GET["RownNme"]."<br />";
         echo "Factory".$_GET["Factory"]."<br />";
        echo "Condi".$_GET["Condi"]."<br />";
        echo "R".$Factory;*/
        $dt = new dataLeftPage_showChild("Line",$condition ); 
   
       // print_r($dt->arrKeyVa);
        ?> 
        <?php
        // echo 44;
        //print_r($dt->arrKeyVaSql["Line"]);
        if(count($dt->arrKeyVa["Line"])>0)
        {
        foreach( $dt->arrKeyVa["Line"] as $key => $va)
        {?>
       <option  id="<?php echo $dt->arrKeyVaSql["Line"][$key];?>" value="<?php echo $va ;  ?>" >
   
         <?php
          echo $va ; 
          
        ?>    </option>
        
        <?php  }}else{echo "NO Data";} ?>
          </select>
        </div>
     
 
 
</body>
</html>