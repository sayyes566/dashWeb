<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8" />
  <title>Yield trend</title>
    <link rel="stylesheet" href="../css/jquery-ui.css" />
    <style type="text/css">
      body {
        font-family: Verdana;
      }

      table {
        font-size: 14px;
      }

      td {
        text-align: center;
      }

      .no-close .ui-dialog-titlebar {
        display: none;
      }
    </style>
    <!--link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" /-->
   <!--   <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/jquery.csv.js"></script>
    <script type="text/javascript" src="js/highcharts.js"></script>-->
  </head>

  <body>
    <!-- <div id="date_div"></div>-->
    <h3 align="center">All lines bridge to 94%:</h3>
    <div id="table_yield_trend_more_all_div"></div>
    <h3 align="center">Golden line bridge to 94%:</h3>
    <div id="table_yield_trend_more_golden_div"></div>
    <div id="wait_dialog" >
        <p align="center" id="proc_info"></p>
    </div>
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

      function formatDate(str) {
        return str.substring(0, 4) + "-" + str.substring(4, 6) + "-" + str.substring(6, 8);
      }

      function selectDate() {
        var time_tag = $("#date_sel").val();

        if (time_tag == "")
          alert("Please pick a date!");
        else {
          if (getParameter("time") != "")
            window.open("yield_trend_more.html" + window.location.search.replace(new RegExp(getParameter("time"),"g"), time_tag.substring(0, 4) + time_tag.substring(5, 7) + time_tag.substring(8, 10)), "_self");
          else
            window.open("yield_trend_more.html?time=" + time_tag.substring(0, 4) + time_tag.substring(5, 7) + time_tag.substring(8, 10) + "&project=Panda&section=FATP", "_self");
            //window.open("yield_trend_more.html?time=" + time_tag.substring(0, 4) + time_tag.substring(5, 7) + time_tag.substring(8, 10) + "&project=" + project_var + "&section=" + section_var, "_self");
        }

        return;
      }
*/
      // chart input/output
      $(function initChartTrend() {
          /*
      	var time_var = getParameter("time"),
            date_div_str = "<p>Please pick a date: "
                         + "<input type=\"text\" id=\"date_sel\" name=\"date\" />"
                         + "<button onclick=\"selectDate()\">Go</button>";

        $("#date_div").html(date_div_str);
        $("#date_sel").datepicker({dateFormat:"yy-mm-dd", showMonthAfterYear: true});*/
     var time_var = $.trim($("#time").text());
      //time_var ='20141111';
        if (time_var != "") {
      //    $("#date_sel").val(formatDate(time_var));

        //  $("#wait_dialog").dialog({height: 90, dialogClass: "no-close", modal: true, resizable: false, draggable: false});

          drawChartTable();
        }
      });

      function drawChartTable() {
           var time_var = $.trim($("#time").text()),
            project_var =  $.trim($(".selectPr").text()),
            section_var =  $.trim($(".selectSe").text()),
            factory_var =  $.trim($(".selectFa").text()),
      	    line_var =  $.trim($(".selectLi").text()),
      	    station_var = $.trim($(".selectSt").text()),
            item_var = $.trim($("#item").text());
        //time_var ='20141111';
      //  project_var = 'Panda';
        section_var = 'fatp';
        var url_string = "data/dataTrend_GoldenLine_more.php?time=" + time_var + "&project=" + project_var + "&section=" + section_var;

        $.get(url_string,
              function(data) {
                var parsed_data = $.csv.toObjects(data);

                if (parsed_data.length == 0) {
                  alert("No data!");

                  return;
                }

                var all_tr_data = [],
                    all_td_data = [],
                    all_date = [],
                    golden_tr_data = [],
                    golden_td_data = [],
                    golden_date = [];

                var name_station = "",
                    name_issue = "",
                    counter_station = 0,
                    bGolden = false;

                for (var i = 0; i < parsed_data.length; i++) {
                  if (parsed_data[i].Line == "") {
                    var value = +parsed_data[i].Input != 0 ? (100 * +parsed_data[i].Fail / +parsed_data[i].Input).toFixed(2) : "0.00";

                    all_td_data.push([parsed_data[i].Station, parsed_data[i].Detail, parsed_data[i].Date, value]);

                    if (all_date.indexOf(parsed_data[i].Date) == -1)
                      all_date.push(parsed_data[i].Date);

                    if (name_station != parsed_data[i].Station) {
                      if (i == 0) {
                        name_station = parsed_data[i].Station;
                        name_issue = parsed_data[i].Detail;

                        counter_station++;
                      }
                      else {
                        all_tr_data.push([name_station, counter_station]);

                        name_station = parsed_data[i].Station;
                        name_issue = parsed_data[i].Detail;

                        counter_station = 1;
                      }
                    }
                    else {
                      if (name_issue != parsed_data[i].Detail) {
                        name_issue = parsed_data[i].Detail;

                        counter_station++;
                      }
                    }
                  }
                  else if (parsed_data[i].Line == "5F14") {
                    var value = +parsed_data[i].Input != 0 ? (100 * +parsed_data[i].Fail / +parsed_data[i].Input).toFixed(2) : "0.00";

                    golden_td_data.push([parsed_data[i].Station, parsed_data[i].Detail, parsed_data[i].Date, value]);

                    if (golden_date.indexOf(parsed_data[i].Date) == -1)
                      golden_date.push(parsed_data[i].Date);

                    if (name_station != parsed_data[i].Station) {
                      if (i == 0) {
                        name_station = parsed_data[i].Station;
                        name_issue = parsed_data[i].Detail;

                        counter_station++;
                      }
                      else {
                        if (!bGolden) {
                          all_tr_data.push([name_station, counter_station]);

                          name_station = parsed_data[i].Station;
                          name_issue = parsed_data[i].Detail;

                          counter_station = 1;

                          bGolden = true;
                        }
                        else {
                          golden_tr_data.push([name_station, counter_station]);

                          name_station = parsed_data[i].Station;
                          name_issue = parsed_data[i].Detail;

                          counter_station = 1;
                        }
                      }
                    }
                    else {
                      if (name_issue != parsed_data[i].Detail) {
                        name_issue = parsed_data[i].Detail;

                        counter_station++;
                      }
                    }
                  }
                  else
                    alert("what is it?");
                }

                if (!bGolden)
                  all_tr_data.push([name_station, counter_station]);

                golden_tr_data.push([name_station, counter_station]);

                var table_str = "<table border=\"1\" align=\"center\">"
                              + "<thead style=\"font-weight: bold;\">"
                              + "<tr>"
                              + "<td style=\"background-color: #EE82EE;\">Station</td>"
                              + "<td style=\"background-color: #EE82EE;\">Top Item</td>";

                for (var i = 0; i < all_date.length; i++)
                  table_str += "<td style=\"width: 100px; background-color: #EE82EE;\">" + all_date[i].substring(4, 6) + "/" + all_date[i].substring(6, 8) + "</td>"

                table_str += "</tr>"
                           + "</thead>"
                           + "<tbody>";

                for (var i = 0; i < all_tr_data.length; i++) {
                  if (i % 2)
                    table_str += "<tr style=\"background-color: #ECECEC;\">";
                  else
                    table_str += "<tr>";

                  if (all_tr_data[i][1] < 2) {
                    table_str += "<td>"
                               + all_tr_data[i][0]
                               + "</td>";
                  }
                  else {
                    table_str += "<td rowspan=" + all_tr_data[i][1] + ">"
                               + all_tr_data[i][0]
                               + "</td>";
                  }

                  var bFoundDetail = false;
                  var countDetail = 0;
                  var date_idx = 0;

                  for (var j = 0; j < all_td_data.length; j++) {
                    if (all_tr_data[i][0] == all_td_data[j][0]) {
                      if (!bFoundDetail) {
                        if (i % 2)
                          table_str += "<td style=\"text-align: left; background-color: #ECECEC;\">" + all_td_data[j][1] + "</td>";
                        else
                          table_str += "<td style=\"text-align: left\">" + all_td_data[j][1] + "</td>";

                        countDetail++;
                      }

                      var k = 0;

                      for (k = 0; k < all_date.length; k++) {
                        if (all_td_data[j][2] == all_date[k]) {
                          for (var x = date_idx; x < k; x++) {
                            if (i % 2)
                              table_str += "<td style=\"background-color: #ECECEC;\"></td>";
                            else
                              table_str += "<td></td>";

                            date_idx++;
                          }
                          
                          if (i % 2)
                            table_str += "<td style=\"background-color: #ECECEC;\">" + all_td_data[j][3] + "%</td>";
                          else
                            table_str += "<td>" + all_td_data[j][3] + "%</td>";

                          bFoundDetail = true;

                          date_idx++;

                          break;
                        }
                        else {
                          if (!bFoundDetail) {
                            if (i % 2)
                              table_str += "<td style=\"background-color: #ECECEC;\"></td>";
                            else
                              table_str += "<td></td>";

                            date_idx++;
                          }
                        }
                      }

                      if (k == all_date.length - 1) {
                        bFoundDetail = false;
                        date_idx = 0;

                        table_str += "</tr>";

                        if (countDetail == all_tr_data[i][1])
                          break;
                      }
                    }
                    else
                      continue;
                  }
                }

                table_str += "</tbody>"
                           + "</table>";

                $("#table_yield_trend_more_all_div").html(table_str);

                table_str = "<table border=\"1\" align=\"center\">"
                          + "<thead style=\"font-weight: bold;\">"
                          + "<tr>"
                          + "<td style=\"background-color: #EE82EE;\">Station</td>"
                          + "<td style=\"background-color: #EE82EE;\">Top Item</td>";

                for (var i = 0; i < golden_date.length; i++)
                  table_str += "<td style=\"width: 100px; background-color: #EE82EE;\">" + golden_date[i].substring(4, 6) + "/" + golden_date[i].substring(6, 8) + "</td>"

                table_str += "</tr>"
                           + "</thead>"
                           + "<tbody>";

                for (var i = 0; i < golden_tr_data.length; i++) {
                  if (i % 2)
                    table_str += "<tr style=\"background-color: #ECECEC;\">";
                  else
                    table_str += "<tr>";

                  if (golden_tr_data[i][1] < 2) {
                    table_str += "<td style=\"width: 100px; \">"
                               + golden_tr_data[i][0]
                               + "</td>";
                  }
                  else {
        
                table_str += "<td rowspan=" + golden_tr_data[i][1] + ">"
     //                         table_str += "<td  style=\"width: 100px; \">"
                               + golden_tr_data[i][0]
                               + "</td>";
                  }

                  bFoundDetail = false;
                  countDetail = 0;
                  date_idx = 0;

                  for (var j = 0; j < golden_td_data.length; j++) {
                    if (golden_tr_data[i][0] == golden_td_data[j][0]) {
                      if (!bFoundDetail) {
                        if (i % 2)
                          table_str += "<td style=\"text-align: left; background-color: #ECECEC;\">" + golden_td_data[j][1] + "</td>";
                        else
                          table_str += "<td style=\"text-align: left\">" + golden_td_data[j][1] + "</td>";

                        countDetail++;
                      }

                      var k = 0;

                      for (k = 0; k < golden_date.length; k++) {
                        if (golden_td_data[j][2] == golden_date[k]) {
                          for (var x = date_idx; x < k; x++) {
                            if (i % 2)
                              table_str += "<td style=\"background-color: #ECECEC;\"></td>";
                            else
                              table_str += "<td></td>";

                            date_idx++;
                          }
                          
                          if (i % 2)
                            table_str += "<td style=\"background-color: #ECECEC;\">" + golden_td_data[j][3] + "%</td>";
                          else
                            table_str += "<td>" + golden_td_data[j][3] + "%</td>";

                          bFoundDetail = true;

                          date_idx++;

                          break;
                        }
                        else {
                          if (!bFoundDetail) {
                            if (i % 2)
                              table_str += "<td style=\"background-color: #ECECEC;\"></td>";
                            else
                              table_str += "<td></td>";

                            date_idx++;
                          }
                        }
                      }

                      if (k == golden_date.length - 1) {
                        bFoundDetail = false;
                        date_idx = 0;

                        table_str += "</tr>";

                        if (countDetail == golden_tr_data[i][1])
                          break;
                      }
                    }
                    else
                      continue;
                  }
                }

                table_str += "</tbody>"
                           + "</table>";

                $("#table_yield_trend_more_golden_div").html(table_str);
              })
         .always(function() {
             //    $("#wait_dialog").dialog("open");
                 })
         .done(function() {
                 $("#wait_dialog").dialog("close");
               })
         .fail(function() {
              

                 $("#proc_info").html("No data!");

              //  $("#wait_dialog").dialog({height: "auto", dialogClass: "", close: function(event, ui) { window.history.back(); }});
            //     $("#wait_dialog").dialog("open");
                  $("#wait_dialog").dialog("close");
               });
      }

      var time_var = getParameter("time"),
          project_var = getParameter("project"),
          section_var = getParameter("section");

      var table_data = [];
    </script>
  </body>
</html>