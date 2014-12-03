<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8" />
  <title>Trend</title>
    <link rel="stylesheet" href="../css/jquery-ui.css" />
    <style type="text/css">
      body {
        font-family: Verdana;
      }

      .no-close .ui-dialog-titlebar {
        display: none;
      }
     
    </style>
    <!-- script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script
    <link rel="stylesheet" href="css/jqueryUI/smoothness/jquery-ui.css" />
    <script type="text/javascript" src="js/jquery.csv.js"></script>-->
  </head>

  

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
      function getVal(item_var, params) {
        var num_var = 0;
        item_var = $.trim(item_var);
        if (item_var == "input")
          num_var = params.Input_Count;
        else if (item_var == "fail")
          num_var = params.Fail;
        else if (item_var == "yield")
          num_var = params.Yield;
        else if (item_var == "retest")
          num_var = params.Retest;
        else if (item_var == "retest_ratio")
          num_var = params.Retest_Ratio;
        else if (item_var == "ra_count")
          num_var = params.Retest_Abnormal_Count;
        else if (item_var == "ra_ratio")
          num_var = params.Retest_Abnormal_Ratio;
        else if (item_var == "tr_count")
          num_var = params.TrueFail_Count;
        else if (item_var == "pi_count")
          num_var = params.ProcessIssue_Count;
        else if (item_var == "rohh_count")
          num_var = params.Retest_Over_HalfHour_Count;
        else if (item_var == "rohh_ratio")
          num_var = params.Retest_Over_HalfHour_Ratio;
        else if (item_var == "ostc_count")
          num_var = params.OverStayingTime_CulumativeCount;
        else if (item_var == "ngfaff_count")
          num_var = params.Not_Goto_FA_AfterFinalFail_Count;
        else if (item_var == "ngfaff_ratio")
          num_var = params.Not_Goto_FA_AfterFinalFail_Ratio;
        else if (item_var == "nqar_count")
          num_var = params.No_QT0_AfterRepair_Count;
        else if (item_var == "nqar_ratio")
          num_var = params.No_QT0_AfterRepair_Ratio;
        else if (item_var == "ip_count")
          num_var = params.Incomplete_Process_Count;
        else if (item_var == "ip_ratio")
          num_var = params.Incomplete_Process_Ratio;
        else if (item_var == "soo_count")
          num_var = params.Sequence_OutOfOrder_Count;
        else if (item_var == "soo_ratio")
          num_var = params.Sequence_OutOfOrder_Ratio;
        else if (item_var == "rp_count")
          num_var = params.Redundant_Pass_Count;
        else if (item_var == "rp_ratio")
          num_var = params.Redundant_Pass_Ratio;
        else if (item_var == "cl_count")
          num_var = params.CrossLine_Count;
        else if (item_var == "cl_ratio")
          num_var = params.CrossLine_Ratio;
        else if (item_var == "me_count")
          num_var = params.ManualEntry_Count;
        else if (item_var == "me_ratio")
          num_var = params.ManualEntry_Ratio;
        else if (item_var == "iof")
          num_var = params.Inconsistent_Overlay_Flag;
        else if (item_var == "or_count")
          num_var = params.OnlineRepair_Count;
        else if (item_var == "or_ratio")
          num_var = params.OnlineRepair_Ratio;
        else if (item_var == "uff")
          num_var = params.UnequalFixture_Flag;
        else if (item_var == "usf")
          num_var = params.UnequalSlot_Flag;
        else if (item_var == "ott_count")
          num_var = params.Over_TestTime_Count;
        else if (item_var == "ott_ratio")
          num_var = params.Over_TestTime_Ratio;
        else if (item_var == "osdmt_count")
          num_var = params.Over_StdDevMovingTime_Count;
        else if (item_var == "osdmt_ratio")
          num_var = params.Over_StdDevMovingTime_Ratio;
        else if (item_var == "avg_uph")
          num_var = params.AVG_UPH;
        else if (item_var == "max_uph")
          num_var = params.MAX_UPH;
        else if (item_var == "stddev_ct_p")
          num_var = params.StdDev_CT_Pass;
        else if (item_var == "avg_ct_p")
          num_var = params.Average_CT_Pass;
        else if (item_var == "min_ct_p")
          num_var = params.Min_CT_Pass;
        else if (item_var == "max_ct_p")
          num_var = params.Max_CT_Pass;
        else if (item_var == "stddev_ct_f")
          num_var = params.StdDev_CT_Fail;
        else if (item_var == "avg_ct_f")
          num_var = params.Average_CT_Fail;
        else if (item_var == "min_ct_f")
          num_var = params.Min_CT_Fail;
        else if (item_var == "max_ct_f")
          num_var = params.Max_CT_Fail;
        else
          num_var = "no such params"+num_var+".";

        return num_var;
      }

      function getItemString(item_var) {
        var item_string = "";

        if (item_var == "input")
          item_string = "Input";
        else if (item_var == "fail")
          item_string = "Fail";
        else if (item_var == "yield")
          item_string = "Yield Rate";
        else if (item_var == "retest")
          item_string = "Retest";
        else if (item_var == "retest_ratio")
          item_string = "Retest Ratio";
        else if (item_var == "ra_count")
          item_string = "Retest/Abnormal";
        else if (item_var == "ra_ratio")
          item_string = "Retest/Abnormal Ratio";
        else if (item_var == "tr_count")
          item_string = "True Fail";
        else if (item_var == "pi_count")
          item_string = "Process Issue";
        else if (item_var == "rohh_count")
          item_string = "Retest Over Half Hour";
        else if (item_var == "rohh_ratio")
          item_string = "Retest Over Half Hour Ratio";
        else if (item_var == "ostc_count")
          item_string = "Over Staying Time Culumative";
        else if (item_var == "ngfaff_count")
          item_string = "Not Goto FA After Final Fail";
        else if (item_var == "ngfaff_ratio")
          item_string = "Not Goto FA After Final Fail Ratio";
        else if (item_var == "nqar_count")
          item_string = "No QT0 After Repair";
        else if (item_var == "nqar_ratio")
          item_string = "No QT0 After Repair Ratio";
        else if (item_var == "ip_count")
          item_string = "Incomplete Process";
        else if (item_var == "ip_ratio")
          item_string = "Incomplete Process Ratio";
        else if (item_var == "soo_count")
          item_string = "Sequence Out Of Order";
        else if (item_var == "soo_ratio")
          item_string = "Sequence Out Of Order Ratio";
        else if (item_var == "rp_count")
          item_string = "Redundant Pass";
        else if (item_var == "rp_ratio")
          item_string = "Redundant Pass Ratio";
        else if (item_var == "cl_count")
          item_string = "Cross Line";
        else if (item_var == "cl_ratio")
          item_string = "Cross Line Ratio";
        else if (item_var == "me_count")
          item_string = "Manual Entry Count";
        else if (item_var == "me_ratio")
          item_string = "Manual Entry Ratio";
        else if (item_var == "iof")
          item_string = "Inconsistent Overlay Flag";
        else if (item_var == "or_count")
          item_string = "Online Repair";
        else if (item_var == "or_ratio")
          item_string = "Online Repair Ratio";
        else if (item_var == "uff")
          item_string = "Unequal Fixture Flag";
        else if (item_var == "usf")
          item_string = "Unequal Slot Flag";
        else if (item_var == "ott_count")
          item_string = "Over Test Time";
        else if (item_var == "ott_ratio")
          item_string = "Over Test Time Ratio";
        else if (item_var == "osdmt_count")
          item_string = "Over Stadard Develop Moving Time";
        else if (item_var == "osdmt_ratio")
          item_string = "Over Standard Develop Moving Time Ratio";
        else if (item_var == "avg_uph")
          item_string = "AVG UPH";
        else if (item_var == "max_uph")
          item_string = "MAX UPH";
        else if (item_var == "stddev_ct_p")
          item_string = "Standard Develop Cycle Time Pass";
        else if (item_var == "avg_ct_p")
          item_string = "Average Cycle Time Pass";
        else if (item_var == "min_ct_p")
          item_string = "Min Cycle Time Pass";
        else if (item_var == "max_ct_p")
          item_string = "Max Cycle Time Pass";
        else if (item_var == "stddev_ct_f")
          item_string = "Standard Develop Cycle Time Fail";
        else if (item_var == "avg_ct_f")
          item_string = "Average Cycle Time Fail";
        else if (item_var == "min_ct_f")
          item_string = "Min Cycle Time Fail";
        else if (item_var == "max_ct_f")
          item_string = "Max Cycle Time Fail";
         else
           item_string = "No such item"+item_var+".";

        return item_string;
      }

      function getLegendString(item_var, project_var, section_var, factory_var, line_var, station_var) {
        var html_str = "",
            item_string = getItemString(item_var);

     	  if (station_var != "")
          html_str = "<legend>&nbsp;&nbsp;<b>" + item_string + "</b> trend of Station <b>" + station_var + "</b>&nbsp;&nbsp;</legend>";
     	  else if (line_var != "")
          html_str = "<legend>&nbsp;&nbsp;<b>" + item_string + "</b> trend of Line <b>" + line_var + "</b>&nbsp;&nbsp;</legend>";
     	  else if (factory_var != "")
     	    html_str = "<legend>&nbsp;&nbsp;<b>" + item_string + "</b> trend of Factory <b>" + factory_var + "</b>&nbsp;&nbsp;</legend>";
     	  else if (project_var != "")
     	    html_str = "<legend>&nbsp;&nbsp;<b>" + item_string + "</b> trend of Project <b>" + project_var + "</b>, Section <b>" + section_var + "</b>&nbsp;&nbsp;</legend>";

        return html_str;
      }

      function formatStationName(string) {
          //$("testT").text("aaa"+string);
        return string.search("&") != -1 ? string.replace(/&/g, "%26") : string;
       // return string.search("@") != -1 ? string.replace(/@/g, "%26") : string;
      }

      function formatDate(str) {
        return str.substring(0, 4) + "-" + str.substring(4, 6) + "-" + str.substring(6, 8);
      }

      function formatNumber(str) {
        var pattern = /(-?\d+)(\d{3})/;

        while (pattern.test(str))
          str = str.replace(pattern, "$1,$2");

        return str;
      }
      /*
        function getNumberSize(str) {
           var size = str.length;
           var px = 90;
         if( size > 6 ) //6
         return px*0.1;
         else if( size > 5 ) //5
         return px*0.25;
         else if( size > 4 )
         return px*0.35;
         else if( size > 3 )
         return px*0.3;
         else if( size > 2 )
         return px*0.4;
         else if( size > 1 )
         return px*0.4;
        
      }*/

      // chart input/output
      $(function initChartTrend() {
          /*
      	var time_var = getParameter("time"),
            project_var = getParameter("project"),
            section_var = getParameter("section"),
            factory_var = getParameter("factory"),
      	    line_var = getParameter("line"),
      	    station_var = getParameter("station").replace(/%20/g, " ").replace(/%26/g, "&"),
      	    item_var = getParameter("item");
*/
      var checkDate =  $.trim($("#check_input").text());

        if (checkDate==0)
        {
          $("#noData_input").show(); 
        }//check date
        else
        {
          $("#chart_trend_input").show(); 
         
        }

        var time_var = $.trim($("#time").text()),
            project_var =  $.trim($(".selectPr").text()),
            section_var =  $.trim($(".selectSe").text()),
            factory_var =  $.trim($(".selectFa").text()),
      	    line_var =  $.trim($(".selectLi").text()),
      	    station_var = $.trim($(".selectSt").text()),
      	   // item_var = $.trim($("#item").text());
             item_var ="input";
        //   $("#testT").text("okok"+item_var+ getItemString(item_var) );
        var html_str = "<fieldset  id=\"input\" style=\"width: 200px; height: 150px;\">",
            unit_str = "",
            format_str = "",
            point_str = "";

        var height_var = 80,
            rotate_var = 0,
            y_padding_var = 0;

        var real_data = [];
        var condition = $("#conditionBar").text();
        condition = condition.replace(/\anda/g,"\#").replace(/\and/g,"&").replace(/ /g,"").replace(/'/g,"").replace(/\#/g,"anda").replace(/\Date/g,"time");
        condition =  condition.toLowerCase();
          if(condition=="")
          //  var url_string = "data/trend_full.php?item=" + item_var +"&section=FATP";
            var url_string = "data/trend_full.php?time="+time_var+"&item=" + item_var +"&section=FATP";
       else
            var url_string = "data/trend_full.php?item=" + item_var +"&"+condition;
          
          ///diago

           var dialog_title_yield_trend = condition.replace(/&nbsp;/g," ");
                dialog_title_yield_trend = dialog_title_yield_trend.replace(/\=/g,": ");
                dialog_title_yield_trend = dialog_title_yield_trend.replace(/\&/g,", ");
            //loading line chart in the middle of window
        
           $( "#diago_inputTrend" ).dialog({
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
                         title: 'Chart of  Input  Trend<' + dialog_title_yield_trend + '>'
                      });

                        $( "#getTrendInput" ).dblclick(function() {
                         $( "#diago_inputTrend" ).dialog( "open" );
                        var bar_url_string;
                        var condition = $("#conditionBar").text();
                        condition = condition.replace(/\anda/g,"\#").replace(/\and/g,"&").replace(/ /g,"").replace(/'/g,"").replace(/\#/g,"anda").replace(/\Date/g,"time");
                        condition =  condition.toLowerCase();
                        var item_var = 'input_count';//fixed
                        
                        if(condition=="")
                      bar_url_string = "barInputTrend?time="+time_var+"&item=" + item_var +"&section=FATP";
                      else
                      bar_url_string = "barInputTrend.php?item=" + item_var +"&"+condition;
                       $("#diago_inputTrend_Bar").load(bar_url_string);
                      });
                  
          
          
        var max_var = 0,
            max_date = 0,
            min_var = 0,
            min_date = 0,
            yesterday_var = 0,
            today_var = 0;
 var chartInput;
        $.get(url_string,function(data) {
                 
                var parsed_data = $.csv.toObjects(data);

                for (var i = 0; i < parsed_data.length; i ++) {
                  var myDate = new Date(+(parsed_data[i].Date.substring(0,4)), +(parsed_data[i].Date.substring(4,6)) - 1, +(parsed_data[i].Date.substring(6,8)), 0, 0, 0, 0),
                      num_var = getVal(item_var, parsed_data[i]);

                  if (real_data.length == 0) {
                    max_var = +num_var;
                    min_var = +num_var;
                    max_date = parsed_data[i].Date;
                    min_date = parsed_data[i].Date;
                  }
                  else {
                    if (+num_var >= max_var) {
                      max_var = +num_var;
                      max_date = parsed_data[i].Date;
                    }

                    if (+num_var <= min_var) {
                      min_var = +num_var;
                      min_date = parsed_data[i].Date;
                    }
                  }

                  //if (+num_var > 0)
                    real_data.push([myDate.getTime(),
          	                        +num_var]);
                                //    $("#testTT").text("real_data"+url_string+"<br />"+real_data);
          	      //else
                  //  real_data.push([myDate.getTime(),
          	      //                  null]);
                }

                if (parsed_data.length > 1)
                  yesterday_var = getVal(item_var, parsed_data[parsed_data.length - 2]);

                today_var = getVal(item_var, parsed_data[parsed_data.length - 1]);

                // legend tag and string tag for highcharts                
               // html_str += getLegendString(item_var, project_var, section_var, factory_var, line_var, station_var);

                if ((item_var == "yield") || (item_var.substr(-1, 6) == "_ratio")) {
                  unit_str = "Percentage (%)";
                  format_str = "{y}%";
                  point_str = getItemString(item_var) + ": <b>{point.y}%</b>";
                }
                else {
              	  unit_str = "Units";
                  format_str = "{y}";
                  point_str = getItemString(item_var) + ": <b>{point.y}</b>";
                }

                html_str += "<table  style=\"height: 150px;\">"
                          + "<tr>";

                if ((item_var == "yield") || (item_var.substr(-1, 6) == "_ratio"))
                  html_str += "<td style=\"width: 250px;\">";
                else
                  html_str += "<td style=\"width: 100%;\">";
                    var title = "";
                     title += time_var+",";
                     title += project_var!=""?project_var+",":"";
                     title += section_var!=""?section_var+",":"";
                     title += factory_var!=""?factory_var+",":"";
                     title += line_var!=""?line_var+",":"";
                     title += station_var!=""?station_var+",":"";
                     title = title.substring(0,title.length - 1);
                     title = title.replace(/\ppp/g,"+");
                     title = title.replace(/\aaa/g,"&");
                html_str += "<table  style=\"width: 100%;\">"
                          + "<tr>"
                          + "<td valign=\"top\">"
                          + "<b>"+item_var+"</b><br/>"
                      //    + "<b>Date:"+time_var+"</b><br/>"
                          + "</td>"
                          + "</tr>"
                          + "<tr>"
                          + "<td valign=\"top\"  align=\"center\" title=\""+title+"\">"
                          + "<p style=\"font-size: "+getNumberSize(today_var)+"px; font-weight: 600;\">" + formatNumber(today_var);
    
                if ((item_var == "yield") || (item_var.substr(-1, 6) == "_ratio"))
                  html_str += "<span style=\"font-size: 30px;\">&nbsp;%</span>";

                html_str += "</p>"
                          + "</td>"
                          + "<td>";
                  var up_down="";
               if (+today_var > +yesterday_var)
                {
                  html_str += "<img src=\"pic/patterns/arrow_up_green.png\">";
                  up_down="+";
                }
                else if(+today_var == +yesterday_var)
                {

                 html_str += "<img src=\"pic/patterns/arrow_equal.png\">";
                }
                else
                {
                 html_str += "<img src=\"pic/patterns/arrow_down_red.png\">";

                }
                 html_str +="<br />"+up_down;
                 html_str += ""+(Math.round((today_var-yesterday_var) * 100) / 100 );
                 html_str += "</td>"
                          + "</tr>"
                          + "</table>"
                          + "</td>"
                          + "<td style=\"width: 150px;\">";

                if ((item_var == "yield") || (item_var.substr(-1, 6) == "_ratio"))
                  html_str += "<table  style=\"width: 100%; height:100%;\">"
                            + "<tr>"
                            + "<td valign=\"top\">"
                            + "High:"
                            + "</td>"
                            + "</tr>"
                            + "<tr>"
                            + "<td valign=\"top\" align=\"center\">"
                            + "<h1>" + max_var + "<span style=\"font-size: 15px;\">&nbsp;%</span></h1>"
                            + "<div align=\"right\" style=\"font-size: 5px;\">(" + formatDate(max_date) + ")</span></div>"
                            + "</td>"
                            + "</tr>"
                            + "<tr>"
                            + "<td valign=\"top\">"
                            + "Low:"
                            + "</td>"
                            + "</tr>"
                            + "<td valign=\"top\" align=\"center\">"
                            + "<h1>" + min_var + "<span style=\"font-size: 15px;\">&nbsp;%</span></h1>"
                            + "<div align=\"right\" style=\"font-size: 5px;\">(" + formatDate(min_date) + ")</div>"
                            + "</td>"
                            + "</tr>"
                            + "</table>";

                html_str += "</td>"
                          + "</tr>"
                          + "</table>"
                          + "<div id=\"chart_trend_div_input\"></div>"
                          + "</fieldset>";
 
                $("#chart_trend_input").html(html_str);

                Highcharts.setOptions({
              	  global : {
                    useUTC : false
                  },
              	  lang: {
              		  shortMonths: month_list
              	  }
                });

                var yaxis_max_var = 100,
                    yaxis_min_var = ((min_var - (max_var - min_var) * 0.1) > 0) ? (min_var - (max_var - min_var) * 0.1) : 0;

                yaxis_min_var = (yaxis_min_var == 100) ? 0 : yaxis_min_var;
                
                    chartInput = new Highcharts.Chart({
           //     $("#chart_trend_div_input").highcharts({
                chart: {
                    renderTo:'diago_inputTrend_line',
                    type: 'line'
                 //   width: 600,
                 //   height: height_var
                  },
                  credits: {
                    enabled: false
                  },
                  title: {
                    text:  ' 5-Days  Trend Chart ',
                      x: -20 //center
                  },
                  tooltip: {
                	  dateTimeLabelFormats: {
                      day: '%A, %Y-%b-%e',
                      week: '%Y-%b-%e'
                    },
      	            pointFormat: point_str
                  },
                  xAxis: {
                    labels: {
                      enabled: true
                    },
                    type: 'datetime',
                    dateTimeLabelFormats: {
                      day: '%b/%e',
                      week: '%b/%e'
                    },
                    startOfWeek: 0, // Sunday
                    minTickInterval: 24 * 3600 * 1000 // one day
                  },
                  yAxis: {
                    labels: {
                      enabled: true
                    },
                    title: {
//                        text: unit_str
                      text: 'input (units)'
                    },
                    plotLines: [{
                      value: 0,
                      width: 1,
                      color: '#808080'
                    }]
                   //  ceiling: yaxis_max_var,
                //   floor: yaxis_min_var
                  },
                  legend: {
                    enabled: false
                  },
                  plotOptions: {
                    area: {
                      marker: {
                        enabled: false,
                        symbol: 'circle',
                        radius: 2,
                        states: {
                          hover: {
                            enabled: true
                          }
                        }
                      }
                    }
                  },
                  series: [{
                    data: real_data
                  }]
                });
                
              });
        });

        var filename_trend = "",
            file_dir = "../daily_data/stations/";

        var month_list = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
    </script>
    <body>
    
    <div id="noData_input" style="display:none">
        <img src="pic/noData/retestRatio.bmp" title="No Data on <?php echo $_GET["time"]; ?>" />
    </div>
    <div id="chart_trend_input" style="display:none"></div>
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
     <div id="check_input"  style="display:none">
    <?php 
    
             require_once 'data/dataCheck.php';
             $dataCheck = new dataCheck;
             echo  $dataCheck->check($_GET["time"]);
    ?>
    </div>
  
   <!--- <div id="test" style="display:none" ></div>
    <div id="test2" style="display:none"></div>---->
 
  </body>
</html>