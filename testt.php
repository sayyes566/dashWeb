<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript" src="js/jquery-mini.js"></script>
                <script type="text/javascript" src="js/jquery-ui.js"></script>
             <style>
      
 .toggler{
    width:100%;  
    background-color:#8B795E;
   }
  #rmonOption {
    padding: .3em 1em;
    text-decoration: none;
  }
  #optionBoard {
    position: relative;
    width:100%;  
    height: 600px;
    padding: 0.4em;
    background-color:#8B795E;
  }
  #optionBoard h3 {
    margin: 0;
    padding: 0.4em;
    text-align: center;
    
  }
  #widthTree{float:left; width:10%;height:500px auto;}
  #widthTree_Factory{float:left;margin-left:10px; }
  #treeBtn{float:top; }
  .Project{margin-left:0px;  width:100%;display: inline-block; cursor: pointer; float:top;background-color:#8B7E66;}
  .Section{float:top; margin-left:4px;  width:100%;display: inline-block; cursor: pointer; float:top; background-color:#8B7E66;}
  .Factory{float:top; width:100%;margin-left:8px; display: inline-block; cursor: pointer; float:top; background-color:#8B7E66;}
  //.Line{float:top; width:100%;margin-left:8px; display: inline-block; cursor: pointer;  background-color:#e0eee0;}
  #selectBar{margin-left:4px;width:100%;background-color:#D2B48C;}
  .selectPr,.selectSe,.selectFa,.selectLi,.selectSt{margin-left:6px;width:5%;background-color:#fff;font-text:16px; }
      
  </style>
                   <script>
                        function selectDate() {
        var time_tag = $("#date_sel").val();

        if (time_tag == "")
          alert("Please pick a date!");
        else {
          var selectTime = time_tag.substring(0, 4) + time_tag.substring(5, 7) + time_tag.substring(8, 10);
          var url = "leftPageShowProject.php?time=" + selectTime;
          $("#date_sel").text(selectTime);
            $.get(url,function(data)
            {
                 $( "#rmonLine3F").html(data);
            });
        //  window.open(html_str, "_self");
        }

        return;
      }
            $(function() {
         $("#date_sel").datepicker({dateFormat:"yy-mm-dd", showMonthAfterYear: true});
            var state = true;
    // run the currently selected effect
    function runEffect() {
      // most effect types need no options passed by default
      var options = {};
      if ( state ) {
        $( "#optionBoard" ).show( 'slide', options, 500 );
        state = !state;
      } else {
        $( "#optionBoard" ).hide( 'slide', options, 500 );
        state = !state;
      }
    };
    // set effect from select menu value
    $( "#btnOptBod" ).click(function() {
      runEffect();
    });
     $( "#optionBoard" ).hide();
            })
               </script>

 
    </head>
    <body>
        <!--leftPage--->
<button id="btnOptBod" title="RMON OPTION"> 》</button>
<div class="toggler">
<div id="optionBoard" >
<div id="selectBar">
<font class="selectPr"></font> <font class="selectSe"></font><font class="selectFa"></font><font class="selectLi"></font><font class="selectSt"></font>
</div>
<input type="text" value="Please pick a date" id="date_sel" name="date" />
<button onclick="selectDate()">Go</button>
<div id="rmonLine3F"></div>
</div>
</div>

    </body>
</html>
