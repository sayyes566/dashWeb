<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8" />
  <title>Line Yield below</title>
    <link rel="stylesheet" href="../css/jquery-ui.css" />
    <style type="text/css">
      body {
        font-family: Verdana;
      }

      .no-close .ui-dialog-titlebar {
        display: none;
      }
    </style>
    <!-----
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script type="text/javascript" src="../js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="../js/jquery-ui.js"></script>
    <script type="text/javascript" src="../js/jquery.csv.js"></script>--->
  </head>

  <body>
      <!----
    <div id="date_div"></div>
    <div id="chart_yield_by_line"></div>--->
    <script type="text/javascript">
        /*
      function getParameter(param) {
        var query = window.location.search;
        var iLen = param.length;
        var iStart = query.indexOf(param);

        if (iStart == -1)
          return "";

        iStart += iLen + 1;

        var iEnd = query.indexOf("&", iStart);

        if (iEnd == -1)
          return query.substring(iStart);

        return query.substring(iStart, iEnd);
      }
*/
      function formatDate(str) {
        return str.substring(0, 4) + "-" + str.substring(4, 6) + "-" + str.substring(6, 8);
      }
/*
      function selectDate() {
        var time_tag = $("#date_sel").val();

        if (time_tag == "")
          alert("Please pick a date!");
        else {
          if (getParameter("time") != "")
            window.open("yield_by_line.html" + window.location.search.replace(new RegExp(getParameter("time"),"g"), time_tag.substring(0, 4) + time_tag.substring(5, 7) + time_tag.substring(8, 10)), "_self");
          else
            window.open("yield_by_line.html?time=" + time_tag.substring(0, 4) + time_tag.substring(5, 7) + time_tag.substring(8, 10) + "&project=Panda&section=FATP", "_self");
        }

        return;
      }*/

      // chart input/output   
     /*
      $(function initChartTrend() {
       
      	var time_var = getParameter("time"),
            date_div_str = "<p>Please pick a date: "
                         + "<input type=\"text\" id=\"date_sel\" name=\"date\" />"
                         + "<button onclick=\"selectDate()\">Go</button>";

        $("#date_div").html(date_div_str);
        $("#date_sel").datepicker({dateFormat:"yy-mm-dd", showMonthAfterYear: true});

        if (time_var != "") {
          $("#date_sel").val(time_var.substring(0, 4) + "-" + time_var.substring(4, 6) + "-" + time_var.substring(6, 8));

          drawCharts();
        }
      });*/

function getLink(url)
{
         var time_var = $.trim($("#time").text()),
        project_var =  $.trim($(".selectPr").text()),
        section_var = "FATP";
        if(project_var=="")project_var="Panda";
           var url_string = url+"?time=" + time_var + "&project=" + project_var + "&section=" + section_var;
           return url_string;
     //   var magic_var = 88;//getparameter;
}


       $(function () {
       var time_var = $.trim($("#time").text()),
            project_var =  $.trim($(".selectPr").text()),
            section_var =  $.trim($("#section").text());
            if(project_var=="")project_var="Panda";
     var checkDate =  $.trim($("#check_YieldbyLine").text());

        if (checkDate==0)
        {
          $("#noData_YieldbyLine").show(); 
         
          
        }//check date
        else
        {
          $("#table_YieldbyLine").show(); 
       
        }
      var diff_var = 0;
        var section_var = "FATP";
        var url_string = "data/dataTrend_YieldbyLine.php?time=" + time_var + "&project=" + project_var + "&section=" + section_var;
        var magic_var = 88;//getparameter;
        if (magic_var != 0)
            url_string += "&magic=" + magic_var;
        else
        {
            magic_var = 88;
            url_string += "&magic=" + magic_var;
         }
                 var title = "";
                     title += time_var+",";
                     title += project_var!=""?project_var+",":"";
                     title += section_var!=""?section_var+",":"";
                     title += "Yield<"+ magic_var;
        $.get(url_string,
              function(data) {
                var parsed_data = $.csv.toObjects(data);

                diff_var = +parsed_data[1].total - +parsed_data[0].total;

                // legend tag and string tag for highcharts                
                html_str = "<fieldset style=\"width: 150px; height: 183px;\">"
                         + "<table>"
                         + "<tr>"
                         + "<td style=\"width: 80%;\">"
                         + "<table style=\"width: 100%;\" >"
                         + "<tr>"
                         + "<td valign=\"top\" style=\"font-size:14px;\">"
                         + "Lines lower than "
                         + magic_var
                         + "%:</td>"
                         + "</tr>"
                         + "<tr align=\"middle\">"
                         + "<td valign=\"top\" title=\""+title+"\">"
                         + "<p style=\"font-size: 40px; font-weight: 600;\">" + +parsed_data[1].total
                         + "</p>"
                         + "</td>"
                         + "<td >";

                  if (diff_var > 0)
                    html_str += "<img src=\"pic/patterns/arrow_up_red.png\" style=\"margin-left:-30px;\">";
                  else if (diff_var == 0)
                    html_str += "<img src=\"pic/patterns/arrow_equal.png\" style=\"margin-left:-30px;\">";
                  else
                    html_str += "<img src=\"pic/patterns/arrow_down_green.png\" style=\"margin-left:-20px;\">";

                  html_str += "</td>"
                            + "</tr>"
                            + "</table>"
                            + "</td>"
                            + "<td style=\"width: 5px;\">"
                            + "</td>"
                            + "</tr>"
                            + "</table>"
                            + "</fieldset>";

                  $("#table_YieldbyLine").html(html_str);
              });
              
                 //loading line chart in the middle of window
         //   if(project_var!=null && project_var!="")
         //   {
           $( "#diago_yieldbyLine" ).dialog({
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
                         title: 'Chart of  Yield  Trend(' + title + '% )',
                         position: { my: "center", at: "top", of:  window}
                      });

                       $( "#getYieldbyLine" ).dblclick(function() {
                         $( "#diago_yieldbyLine" ).dialog( "open" );
                      var yieldbyLine_string =  getLink("yield_by_line_more.php");
                    
                       $("#diago_yieldbyLine_content").load(yieldbyLine_string);
                      });
                      //}
        });

          //  factory_var =  $.trim($(".selectFa").text()),
      	  //  line_var =  $.trim($(".selectLi").text()),
      	  //  station_var = $.trim($(".selectSt").text()),
         //   magic_var =;
            /*
      var time_var = getParameter("time"),
          project_var = getParameter("project"),
          section_var = getParameter("section"),
          magic_var = getParameter("magic");*/
    </script>
      <!--<div id="testT2"></div>---> 
     <div id="noData_YieldbyLine" style="display:none">
        <img src="pic/noData/retestRatio.bmp" title="No Data on <?php echo $_GET["time"]; ?>" />
    </div>
    <div id="table_YieldbyLine"  style="display:none"></div>
   
    <div id="item" style="display:none"> <?php if(isset($_GET["item"]))echo $_GET["item"];else echo ""; ?></div>
    <div id="time" style="display:none"> <?php if(isset($_GET["time"]))echo $_GET["time"];else echo ""; ?></div>
    <div id="section" style="display:none"> <?php if(isset($_GET["section"]))echo $_GET["section"];else echo ""; ?></div>
    <div id="factory" style="display:none"> <?php if(isset($_GET["factory"]))echo $_GET["factory"];else echo ""; ?></div>
    <div id="line" style="display:none"> <?php if(isset($_GET["line"]))echo $_GET["line"];else echo ""; ?></div>
    <div id="station"  style="display:none">
  <?php 
        if(isset($_GET["station"]))
        {
            $_GET["station"] = str_replace("@" , " ",$_GET["station"] ) ;
           echo $_GET["station"];
        }
        else echo ""; 
        ?>
    
    </div>
    <div id="check_YieldbyLine" style="display:none" >
    <?php 
    
             require_once 'data/dataCheck.php';
             $dataCheck = new dataCheck;
             echo  $dataCheck->check($_GET["time"]);
            // echo "time:".$_GET["time"];
    ?>
    </div>
  </body>
</html>