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

      table {
        font-size: 14px;
      }

      td {
        text-align: center;
      }
    </style>
    <!--link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" /-->
    <!--  <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/jquery.csv.js"></script>
    <script type="text/javascript" src="js/highcharts.js"></script>-->
  </head>

  <body>
    <!---<div id="date_div"></div>--->
    <div id="chart_yield_by_line_more_div"></div>
    <div id="table_yield_by_line_more_div"></div>
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
            window.open("yield_by_line_more.html" + window.location.search.replace(new RegExp(getParameter("time"),"g"), time_tag.substring(0, 4) + time_tag.substring(5, 7) + time_tag.substring(8, 10)), "_self");
          else
            window.open("yield_by_line_more.html?time=" + time_tag.substring(0, 4) + time_tag.substring(5, 7) + time_tag.substring(8, 10) + "&project=Panda&section=FATP", "_self");
        }

        return;
      }
*/
      // chart input/output
      $(function initChartTrend() {
        var time_var = $.trim($("#time").text());
        var diff_var = 0;
        var project_var  = "Panda";
        var section_var  = "FATP";
        var url_string = "data/yield_by_line_more.php?time=" + time_var + "&project=" + project_var + "&section=" + section_var;
       // $("#testT").text(url_string);
        var magic_var,   max_var , min_var;
        magic_var = 88;
        if (magic_var == 0)
          magic_var = 88;

        $.get(url_string,
              function(data) {
                var parsed_data = $.csv.toObjects(data);

                chart_data = [];

                for (var i = 0; i < parsed_data.length; i++) {
                  if (parsed_data[i].Station != "")
                    continue;

                  if (chart_data.length == 0) {
                    max_var = +parsed_data[i].Yield;
                    min_var = +parsed_data[i].Yield;
                  }
                  else {
                    if (+parsed_data[i].Yield >= max_var)
                      max_var = +parsed_data[i].Yield;

                    if (+parsed_data[i].Yield <= min_var)
                      min_var = +parsed_data[i].Yield;
                  }

                  if ((+parsed_data[i].Yield > 90) && (+parsed_data[i].Yield < 91))
                    chart_data.push({name: parsed_data[i].Line,
                                     y: +parsed_data[i].Yield,
                                     color: "yellow"
                                    });
                  else if ((+parsed_data[i].Yield > magic_var) && (+parsed_data[i].Yield < 90))
                    chart_data.push({name: parsed_data[i].Line,
                                     y: +parsed_data[i].Yield,
                                     color: "orange"
                                    });
                  else if (+parsed_data[i].Yield < magic_var)
                    chart_data.push({name: parsed_data[i].Line,
                                     y: +parsed_data[i].Yield,
                                     color: "red"
                                    });
                  else
                    chart_data.push({name: parsed_data[i].Line,
                                     y: +parsed_data[i].Yield
                                    });

                  if (+parsed_data[i].Yield < magic_var)
                    table_data.push(parsed_data[i].Line);
                }

                var tr_data = [];

                for (var i = 0; i < table_data.length; i++) {
                  var counter = 0;

                  for (var j = 0; j < parsed_data.length; j++) {
                    if (parsed_data[j].Station == "")
                      continue;

                    if (parsed_data[j].Line == table_data[i])
                      counter++;
                  }

                  tr_data.push([table_data[i], counter]);
                }

                var yaxis_max_var = 100,
                    yaxis_min_var = ((min_var - (max_var - min_var) * 0.1) > 0) ? (min_var - (max_var - min_var) * 0.1) : 0;

                yaxis_min_var = (yaxis_min_var == 100) ? 0 : yaxis_min_var;
                    var chartYield = new Highcharts.Chart({
               // $("#chart_yield_by_line_more_div").highcharts({
                  chart: {
                    type: "column",
                      renderTo: 'chart_yield_by_line_more_div',
                    //width: 1200,
                    height: 300
                  },
                  credits: {
                    enabled: false
                  },
                  title: {
                    text: ""
                  },
                  tooltip: {
        	          pointFormat: "yield: <b>{point.y}%</b>"
                  },
                  xAxis: {
                    type: "category",
                    labels: {
                      formatter: function () {
                                   if (this.value == "5F14")
                                     return "<b>golden line</b>";
                                   else
                                     return this.value;
                                 },
                      rotation: -90
                    }
                  },
                  yAxis: {
                    title: {
                      text: "Yield (%)"
                    },
                    max: yaxis_max_var,
                    min: yaxis_min_var
                  },
                  legend: {
                    enabled: false
                  },
                  plotOptions: {
                    column: {
                      dataLabels: {
                        enabled: true,
                        rotation: -90,
                        x: 4.5,
                        y: 5,
                        color: '#FFFFFF',
                        align: 'right',
                        style: {
                          fontSize: '13px',
                          fontFamily: 'Verdana, sans-serif',
                          textShadow: '0 0 3px black'
                        },
                        crop: false
                      }
                      //dataLabels: {
                      //  enabled: true,
                      //  rotation: -90,
                      //  y: -25,
                      //  format: "{y}%",
                      //  crop: false
                      //}
                    },
                    series: {
                      pointPadding: -0.25
                    }
                  },
                  series: [{
                    data: chart_data
                  }]
                });

                var table_str = "<table border=\"1\" align=\"center\">"
                              + "<thead style=\"font-weight: bold;\">"
                              + "<tr>"
                              + "<td colspan=2 style= \"width: 250px; background-color: #ADFF2F;\">Line Yield < 88%</td>"
                              + "<td colspan=2 style= \"width: 350px; background-color: #EE82EE;\"> Station Yield < 98%</td>"
                              + "</tr>"
                              + "<tr>"
                              + "<td style= \"width: 100px; background-color: #ADFF2F;\">Line</td>"
                              + "<td style= \"width: 150px; background-color: #ADFF2F;\">Line Yield</td>"
                              + "<td style= \"width: 200px; background-color: #EE82EE;\">Station</td>"
                              + "<td style= \"width: 150px; background-color: #EE82EE;\">Station Yield</td>"
                              + "</tr>"
                              + "</thead>"
                              + "<tbody>";

                for (var i = 0; i < tr_data.length; i++) {
                  table_str += "<tr>";

                  if (tr_data[i][1] < 2) {
                    table_str += "<td>"
                               + tr_data[i][0]
                               + "</td>"
                               + "<td>";
                  }
                  else {
                    table_str += "<td rowspan=" + tr_data[i][1] + ">"
                               + tr_data[i][0]
                               + "</td>"
                               + "<td rowspan=" + tr_data[i][1] + ">";
                  }

                  for (var j = 0; j < chart_data.length; j++) {
                    if (tr_data[i][0] == chart_data[j].name) {
                      table_str += chart_data[j].y;

                      break;
                    }
                  }

                  table_str += "%</td>";

                  var bFound = false;

                  for (var j = 0; j < parsed_data.length; j++) {
                    if (parsed_data[j].Station == "")
                      continue;

                    if (parsed_data[j].Line == tr_data[i][0]) {
                      table_str += "<td>"
                                 + parsed_data[j].Station
                                 + "</td>"
                                 + "<td>"
                                 + parsed_data[j].Yield
                                 + "%</td>"
                                 + "</tr>";

                      bFound = true;
                    }
                  }

                  if (!bFound)
                    table_str += "<td>"
                               + "</td>"
                               + "<td>"
                               + "</td>"
                               + "</tr>";

                  table_str += "</tr>";
                }

                table_str += "</tbody>"
                           + "</table>";

                $("#table_yield_by_line_more_div").html(table_str);
              });
        });

     
        //  project_var = getParameter("project"),
       //   section_var = getParameter("section"),
      //    magic_var = getParameter("magic");

      var chart_data = [],
          table_data = [];
    </script>
      <div id="time" style="display:none"> <?php if(isset($_GET["time"]))echo $_GET["time"];else echo ""; ?></div>
      <div id="testT" ></div>
  </body>
</html>