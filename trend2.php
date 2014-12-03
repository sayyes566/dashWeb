<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8" />
  <title>Trend</title>
    <link rel="stylesheet" href="css/jquery-ui.css" />
    <link rel="stylesheet" href="../patterns/jstree/themes/default/style.css" />
    <style type="text/css">
      body {
        font-family: Verdana;
      }

      .no-close .ui-dialog-titlebar {
        display: none;
      }
    </style>
    <!-- script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script-->
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/jquery.csv.js"></script>
    <script type="text/javascript" src="js/jstree.js"></script>
    <script type="text/javascript" src="js/highcharts.js"></script>
  </head>

  <body>
    <div id="date_div"></div>
    <table style="width: 100%;">
      <tr>
        <td style="width: 30%;" valign="top">
          <div id="tree_div"></div>
        </td>
        <td>
          <div id="chart_trend">
          </div>
        </td>
      </tr>
    </table>
    <script type="text/javascript">
          //   $("#testT").text("section_var");
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
      }*/

      function getVal(item_var, params) {
        var num_var = 0;

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
        return string.search("&") != -1 ? string.replace(/&/g, "%26") : string;
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

      function selectDate() {
        var time_tag = $("#date_sel").val();

        if (time_tag == "")
          alert("Please pick a date!");
        else {
          if ($.trim($("#time").text()) != "")
            window.open("trend.html" + window.location.search.replace(new RegExp($.trim($("#time").text()),"g"), time_tag.substring(0, 4) + time_tag.substring(5, 7) + time_tag.substring(8, 10)), "_self");
          else
            window.open("trend.html?time=" + time_tag.substring(0, 4) + time_tag.substring(5, 7) + time_tag.substring(8, 10) + "&project=Panda", "_self");
        }

        return;
      }

      // chart input/output
      $(function initChartTrend() {
      	var time_var = $.trim($("#time").text()),
            date_div_str = "<p>Please pick a date: "
                         + "<input type=\"text\" id=\"date_sel\" name=\"date\" />"
                         + "<button onclick=\"selectDate()\">Go</button>";

        $("#date_div").html(date_div_str);
        $("#date_sel").datepicker({dateFormat:"yy-mm-dd", showMonthAfterYear: true});

        if (time_var != "") {
          $("#date_sel").val(time_var.substring(0, 4) + "-" + time_var.substring(4, 6) + "-" + time_var.substring(6, 8));
       
        //  drawTree();
          drawCharts();
        }
      });

      function drawTree() {
         
        var html_str = "<ul>"
                     + "<li>Summary</li>"
                     + "<li>FATP"
                     + "<ul>"
                     + "<li>F3</li>"
                     + "<li>F4</li>"
                     + "<li>F5</li>"
                     + "</ul>"
                     + "</li>"
                     + "<li>HSG</li>"
                     + "<li>CG</li>"
                     + "</ul>";

        $("#tree_div").html(html_str);
        $("#tree_div").jstree();
      }

      function drawCharts() {
             $("#testT").text("time_var");
          /*
      	var time_var = getParameter("time"),
            project_var = getParameter("project"),
            section_var = getParameter("section"),
            factory_var = getParameter("factory"),
      	    line_var = getParameter("line"),
      	    station_var = getParameter("station").replace(/%20/g, " ").replace(/%26/g, "&"),
      	    item_var = "";//getParameter("item");

*/
   
            var time_var = $.trim($("#time").text()),
            project_var =  $.trim($("#project").text()),
            section_var =  $.trim($("#section").text()),
            factory_var =  $.trim($("#factory").text()),
      	    line_var =  $.trim($("#line").text()),
      	    station_var = $.trim($("#station").text()).replace("@", " ").replace(/%20/g, " ").replace(/%26/g, "&"),
      	    item_var = $.trim($("#item").text());
           
            // item_var ="";
        var html_str = "",
            unit_str = "",
            format_str = "",
            point_str = "";

        var height_var = 150,
            rotate_var = 0,
            y_padding_var = 0;

        var chart_array = [];

        chart_array.push("input");
        chart_array.push("yield");

        var url_string = "trend_full.php?time=" + time_var + "&project=Panda";

        if (section_var != "")
          url_string += "&section=" + section_var;

        if (factory_var != "")
          url_string += "&factory=" + factory_var;

        if (line_var != "")
          url_string += "&line=" + line_var;

        if (station_var != "")
          url_string += "&station=" + formatStationName(station_var);
       
        $.get(url_string,
              function(data) {
                var parsed_data = $.csv.toObjects(data);

                var charts_html_var = "";

                for (var chart_num = 0; chart_num < chart_array.length; chart_num++)
                  charts_html_var += "<div id=\"chart_trend_" + chart_array[chart_num] + "\"></div>";

                $("#chart_trend").html(charts_html_var);

                for (var chart_num = 0; chart_num < chart_array.length; chart_num++) {
                  var real_data = [],
                      max_var = 0,
                      max_date = 0,
                      min_var = 0,
                      min_date = 0,
                      yesterday_var = 0,
                      today_var = 0;

                  item_var = chart_array[chart_num];

                  for (var i = 0; i < parsed_data.length; i ++) {
                    var myDate = new Date(+(parsed_data[i].Date.substring(0, 4)), +(parsed_data[i].Date.substring(4, 6)) - 1, +(parsed_data[i].Date.substring(6, 8)), 0, 0, 0, 0),
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
            	      //else
                    //  real_data.push([myDate.getTime(),
            	      //                  null]);
                  }

                  if (parsed_data.length > 1)
                    yesterday_var = getVal(item_var, parsed_data[parsed_data.length - 2]);

                  today_var = getVal(item_var, parsed_data[parsed_data.length - 1]);

                  // legend tag and string tag for highcharts                
                  html_str = "<fieldset style=\"width: 600px; height: 500px;\">"
                           + getLegendString(item_var, project_var, section_var, factory_var, line_var, station_var);

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

                  html_str += "<table style=\"height: 250px;\">"
                            + "<tr>";

                  if ((item_var == "yield") || (item_var.substr(-1, 6) == "_ratio"))
                    html_str += "<td style=\"width: 450px;\">";
                  else
                    html_str += "<td style=\"width: 100%;\">";

                  html_str += "<table style=\"width: 100%;\">"
                            + "<tr>"
                            + "<td valign=\"top\">"
                            + "Today:"
                            + "</td>"
                            + "</tr>"
                            + "<tr>"
                            + "<td valign=\"top\" align=\"center\">"
                            + "<p style=\"font-size: 90px; font-weight: 600;\">" + formatNumber(today_var);

                  if ((item_var == "yield") || (item_var.substr(-1, 6) == "_ratio"))
                    html_str += "<span style=\"font-size: 30px;\">&nbsp;%</span>";

                  html_str += "</p>"
                            + "</td>"
                            + "<td>";

                  if (+today_var > +yesterday_var)
                    html_str += "<img src=\"../patterns/arrow_up.png\">";
                  else if (+today_var == +yesterday_var)
                    html_str += "<img src=\"../patterns/arrow_same.png\">";
                  else
                    html_str += "<img src=\"../patterns/arrow_down.png\">";

                  html_str += "</td>"
                            + "</tr>"
                            + "</table>"
                            + "</td>"
                            + "<td style=\"width: 150px;\">";

                  if ((item_var == "yield") || (item_var.substr(-1, 6) == "_ratio"))
                    html_str += "<table style=\"width: 100%; height:100%;\">"
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
                            + "<div id=\"chart_trend_" + item_var + "_div\" style=\"position:relative;\">321123</div>"
                            + "</fieldset>";
                 
                  $("#chart_trend_" + item_var).html(html_str);

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

                  $("#chart_trend_" + item_var + "_div").highcharts({
                    chart: {
                      type: 'area',
                      width: 600,
                      height: height_var
                    },
                    credits: {
                      enabled: false
                    },
                    title: {
                      text: '',
                        x: -20 //center
                    },
                    tooltip: {
                      enabled: false,
                  	  dateTimeLabelFormats: {
                        day: '%A, %Y-%b-%e',
                        week: '%Y-%b-%e'
                      },
        	            pointFormat: point_str
                    },
                    xAxis: {
                      labels: {
                        enabled: false
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
                        enabled: false
                      },
                      title: {
//                        text: unit_str
                        text: null
                      },
                      plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                      }],
                      ceiling: yaxis_max_var,
                      floor: yaxis_min_var
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
                }
              });
        }

        var filename_trend = "",
            file_dir = "../daily_data/stations/";

        var month_list = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
    </script>
    <div id="chart_trend_input_div"></div>
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
   <!--- <div id="test" style="display:none" ></div>
    <div id="test2" style="display:none"></div>---->
    <div id="testT"  >333</div>
  </body>
</html>