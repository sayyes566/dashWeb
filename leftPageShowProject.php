<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>jQuery UI Effects - Toggle Demo</title>
  <link rel="stylesheet" href="css/jqueryUI/smoothness/jquery-ui.css">
  <script src="js/jquery-mini.js"></script>
  <script src="js/jquery-ui.js"></script>
  <style>

  </style>
  <script>
function Ajax(div,url)
{
      $.get(url,function(data)
       {
                 $( "#"+div).html(data);
       });
}
  $(function() {

     $( "#Project" ).change(function() {
           var Project = $(this).val();
            var element = $(this).find('option:selected'); 
           var Condition = element.attr("id"); 
           $(".selectPr").text(Project);
           $("#conditionBar").text(Condition+" and Section=FATP");
           $(".selectSe").text("FATP"); //default FATP
           $(".selectSeDel").show();
           $(".selectFa").text("");
           $(".selectFaDel").hide();
           $(".selectLi").text("");
           $(".selectLiDel").hide();
           $(".selectSt").text("");
           $(".selectStDel").hide();
           selected();

       })
       $( ".Section" ).hover(function() {
               $(this).css("color","#fff");
               $(this).siblings().css("color","#000");
        })
        

       $( "#sSection" ).change(function() {
           var element = $(this).find('option:selected'); 
           var Condition = element.attr("id"); 
           var Section = $(this).val();
           $(".selectSe").text(Section);
           $(".selectSeDel").show();
           $("#conditionBar").text(Condition+" and Section='"+Section+"'");
           $(".selectFa").text("");
           $(".selectFaDel").hide();
           $(".selectLi").text("");
           $(".selectLiDel").hide();
           $(".selectSt").text("");
           $(".selectStDel").hide();
           
           var url = "leftPageShowFactory.php?RownNme=Factory&Condi="+Condition+"&Section="+Section;
            Ajax("widthTree_Factory",url);
          //  $( ".selectOk" ).show();
           selected();
            /*
            $.get(url,function(data)
            {
                 $( "#widthTree_Factory").html(data);
            });
          
           var url = "trend_new.php?item=yield&"+linkPara;
           $.get(url,function(data)
            {
                $( "#getTrendYield").html(data);
            });*/
        });
         
        
  });

  </script>
</head>
<body>
 
    
  
   
   
        <?php 
        include_once 'data/dataLeftPage.php';
     
        if(isset($_GET['time'])){$strDate = $_GET['time'];}
   
        $dt = new dataLeftPage($strDate); 
       // echo $strDate;
        
      
        $dt->getSQLData("Project");
        if(count($dt->arrKeyVa["Project"])>0)
        {
        ?> 
   <div id="widthTree_Project"> 
    <select name="Project"  id="Project"> 
    <option  value=""  selected="selected" >Project</option>
        <?php
        
        foreach( $dt->arrKeyVa["Project"] as $key => $va)
        {?>
        <option  id="<?php echo $dt->arrKeyVaSql["Project"][$key];?>" value="<?php echo $va ;  ?>" >
         <?php
          echo $va ;  ?>
            </option>
      
        <?php
        }}  ?> </select>
        <?php
          if(count($dt->arrKeyVa["Section"])>0)
        {
        ?>  </div> <div id="widthTree_Section"> <select name="Section"  id="sSection"> 
          <option  value="">Section</option>
         <?php
        foreach( $dt->arrKeyVa["Section"] as $key => $va)
        { ?>
        <option  id="<?php echo $dt->arrKeyVaSql["Section"][$key];?>" value="<?php echo $va ;  ?>">
        <?php
          echo $va ;  ?>
       </option>
         <?php
        }}?> 
    </select></div>
         
         
 
 


 
 
</body>
</html>