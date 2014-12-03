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
      #FacTemp{float:left;margin-left:0px;}
      #widthTree_Line{float:left;margin-left:20px; width:150px;height:500px auto; }
      .Line{float:top; width:100%;margin-left:8px; display: inline-block; cursor: pointer;  background-color:#8B7E66;}
   */
  </style>
  <script>
  $(function() {
           $( ".Factory" ).hover(function() {
               $(this).css("color","#fff");
               $(this).siblings().css("color","#000");
           })
           $( "#Factory" ).change(function() {
           var element = $(this).find('option:selected'); 
           var Condition = element.attr("id"); 
           var Factory = $(this).val();
           $("#conditionBar").text(Condition+" and Factory='"+Factory+"'");
           $(".selectFa").text(Factory);
           $(".selectFaDel").show();
           $(".selectLi").text("");
           $(".selectLiDel").hide();
           $(".selectSt").text("");
           $(".selectStDel").hide();
          var url = "leftPageShowLine.php?RownNme=Line&Condi="+Condition+"&Factory="+Factory;
            $(this).siblings().children().hide();
       
            $.get(url,function(data)
            {
                 $( "#widthTree_Line").html(data);
                // $( ".selectOk" ).show();
                   selected();
            });
          
        });
      
        
  });
  </script>
</head>
<body>
    <div id="FacTemp">
        <select name="Factory"  id="Factory"> 
        <option  value="" selected="selected">Factory</option>
        <?php 
        if(isset($_GET["Section"])&& isset($_GET["Condi"])&& isset($_GET["RownNme"]))
        {
        include_once 'data/dataLeftPage_showChild.php';
        $Section = trim($_GET["Section"]);
        $condition = $_GET["Condi"]."and Section='{$Section}'";
        $dt = new dataLeftPage_showChild("Factory",$condition ); 
        ?>
        <?php
        if($dt->arrKeyVa["Factory"]!=NULL)
        {
        foreach( $dt->arrKeyVa["Factory"] as $key => $va)
        {?>
       <option  id="<?php echo $dt->arrKeyVaSql["Factory"][$key];?>" value="<?php echo $va ;  ?>" >
      
         <?php
          echo $va ; 
        ?>
       </option>
         <?php }
        }else
        {?>
       <option>  <?php echo "NO Data";?>  </option>
        <?php
        }
        
        }?>
           
         </select>
        </div>
      

 
 
</body>
</html>