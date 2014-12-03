function getCondition()
{
      //-------------------------------------------------------get option of tree and show in the chart
                   var condText =  $("#conditionBar").text();
                   var linkPara = condText.replace(/Date/g, "time");
                       linkPara = linkPara.replace(/ and/g, "&");
                       linkPara = linkPara.replace(/'and/g, "&");
                       linkPara = linkPara.replace(/Project/g, "project");
                       linkPara = linkPara.replace(/Section/g, "section");
                       linkPara = linkPara.replace(/Factory/g, "factory");
                       linkPara = linkPara.replace(/Line/g, "line");
                       linkPara = linkPara.replace(/Station/g, "station");
                       linkPara = linkPara.replace(/'/g, "");
                       linkPara = linkPara.replace(/\s/g, '');
                       linkPara = $.trim(linkPara);
                       return linkPara;
                       /*
                 if(linkPara.length != 0)
                 {
                  
                     var url = "trend_new.php?item=yield&"+linkPara;
                    $.get(url,function(data)
                     {
                    $( "#getTrendYield").html(data);
                    });
                //$("#getTrendYield").load("trend_new.php?item=yield&"+linkPara);
                 }*/
}
function Ajax(div,url)
{
      $.get(url,function(data)
       {
                 $( "#"+div).html(data);
       });
}
  $(function() {
      $( ".selectOk" ).click(function() {
            var linkPara =   getCondition();
            var tren_yield_url = "trend_Yield.php?item=yield&"+linkPara;
            var tren_input_url = "trend_Input.php?item=input&"+linkPara;
            var tren_retestRatio_url = "trend_Retest_Ratio.php?item=retest_ratio&"+linkPara;
            var tren_fail_url = "trend_Fail.php?item=fail&"+linkPara;
          //  $("#getTrendYield").text("trend_Yield.php?item=yield&"+linkPara);
          //  $("#getTrendInput").text("trend_Input.php?item=input&"+linkPara);
          //  Ajax("getTrendInput",tren_input_url);
            //Ajax("getTrendYield", tren_yield_url);
            $("#getTrendInput").load(tren_input_url);
            $("#getTrendYield").load(tren_yield_url);
            $("#getTrendRetestRatio").load(tren_retestRatio_url);
            $("#getTrendFail").load(tren_fail_url);
            $("#getLineInput").load("lineYield?"+linkPara);
            $("#getLineYield").load("lineInput?"+linkPara);
            $( ".selectOk" ).hide();
            
         
})
   //----------------------------------calendar
   $("#date_sel").datepicker({dateFormat:"yy-mm-dd", showMonthAfterYear: true});
  //----------------------------------------------------------slide windows
    // run the currently selected effect
    function runEffect() {
      // most effect types need no options passed by default
      var options = {};
      if (  $( "#optionBoard" ).css("display") == "none" ) {
        $( "#optionBoard" ).show( 'blind', options, 500 );
        $( "#btnOptBod" ).css( 'margin-top', '30px' );
        $("#content").css( 'margin-top', '50px' );
      } else {
        $( "#optionBoard" ).hide( 'blind', options, 500 );
         $( "#btnOptBod" ).css( 'margin-top', '0px' );
         $("#content").css( 'margin-top', '0px' );
      }
    };
    // set effect from select menu value
    $( "#btnOptBod" ).click(function() {
      runEffect();
           //-------------------------------------------------------get option of tree and show in the chart
        //   getCondition();
            //      else
           //     $("#getTrendInput").text("trend_new.php?item=yield&time=20140926&section=FATP");
     //-------------------------------------------------------get option of tree and show in the chart
    });
     $( "#optionBoard" ).hide();
     //-------------------------------------------------------slide windows#
    //---get today
    /*
    var d = new Date();
    var month = d.getMonth()+1;
    var day = d.getDate();
    var Today = d.getFullYear() + 
    (month<10 ? '0' : '') + month + 
    (day<10 ? '0' : '') + day;*/
    //---get today#
    //------------------------loding
   
      
   
                
    /*
                $("#getTrendYield").ready(function(){
                    /*
                 if(linkPara.length != 0)
                 $("#getTrendYield").load("trend_new.html?item=yield&"+linkPara);
                 else*/
              //   $("#getTrendYield").load("trend_new.html?item=yield&time=20140926&section=FATP");
                // $("#getTrendYield").text('555' );
                // })  
                /*
                $("#getTrendInput").ready(function(){
                 if(linkPara.length != 0)
                 $("#getTrendInput").load("trend_new.html?item=input&"+linkPara);
                 else
                 $("#getTrendInput").load("trend_new.html?item=input&time=20140926&section=FATP");
                })*/
  });
  
    
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
                 $( "#widthTree_PS").html(data);
            });
            $(".selectBartext").show();
         
        //  window.open(html_str, "_self");
        }

        return;
      }
