<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8" />
  <title>Trend</title>
   <?php  date_default_timezone_set("Asia/Taipei"); ?>
   <link rel="stylesheet" href="css/jqueryUI/smoothness/jquery-ui.css" />
    <style type="text/css">
 #chart_yield_trend_divg{border:#000 solid 1px;  width: 500px;}
      body {
        font-family: Verdana;
      }

      .no-close .ui-dialog-titlebar {
        display: none;
      }
    </style>
    <!-- script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script-->
      <!--   <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/highcharts.js"></script> 
     -->
    <script type="text/javascript" src="js/jquery.csv.js"></script>
  </head>

  

    <script type="text/javascript">
      

      /*
        function getNumberSize(str) {
           var size = str.length;
           var px = 90;
         if( size > 6 ) //6
         return px*0.1;
         else if( size > 5 ) //5
         return px*0.25;
         else if( size > 4 )
         return px*0.37;
         else if( size > 3 )
         return px*0.43;
         else if( size > 2 )
         return px*0.75;
         else if( size > 1 )
         return px*0.8;
        
      }*/

      // chart input/output
       $(function initChartTrend() {
         
      	var time_var =  $.trim($("#time").text());
          /*
            date_div_str = "<p>Please pick a date: "
                         + "<input type=\"text\" id=\"date_sel\" name=\"date\" />"
                         + "<button onclick=\"selectDate()\">Go</button>";

        $("#date_div").html(date_div_str);
        $("#date_sel").datepicker({dateFormat:"yy-mm-dd", showMonthAfterYear: true});
*/
             var checkDate = $("#check").text();
            if (time_var != "" && checkDate!=0) {
                      
                 drawGoldenCharts();

                }else
                {
                   showNoData();  

              }
        
      
       // $("#wait_dialog").dialog({height: "auto", dialogClass: "", close: function(event, ui) { window.history.back(); }});
                 $( "#diagoGoldenLine" ).dialog({
                        autoOpen: false,
                        heigh:'90%',
                        width:'90%',
                        modal: true,
                        show: {
                          effect: "blind",
                          duration: 1000
                        },
                        hide: {
                          effect: "explode",
                          duration: 1000
                        },
                         title: 'All lines bridge to 94%',
                         position: { my: "center", at: "top", of:  window}
                      });
                       
                         $( "#getTrendGoLine" ).dblclick(function() {
                           //  alert(time_var+","+checkDate);
                               if (time_var != "" && checkDate!=0) {
                                  //  alert('ok1');
                                //  $("#date_sel").val(time_var.substring(0, 4) + "-" + time_var.substring(4, 6) + "-" + time_var.substring(6, 8));
                                // $("#wait_dialog").dialog("open");
                            
                              
                               //  $("#wait_dialog").dialog("close");
                              var bar_url_string = "trend_GoldenLine_more.php";
                               $("#diagoGoldenLine_content").load(bar_url_string);
                                  // alert('ok2');
                              $( "#diagoGoldenLine" ).dialog( "open" );
                                   //   alert('ok');
                                }
                      
                        
                      });
         
            
      });
      function showNoData() {
          $("#noData").show();
            }
      function drawGoldenCharts() {
         var  time_var =  $.trim($("#time").text()),
              ago_var =  $.trim($("#ago").text());
         var chartGolden;

        var height_var = 200,
            rotate_var = 0,
            y_padding_var = 0;

        var url_string = "data/dataTrend_GoldenLine.php?time=" + time_var + "&ago=" + ago_var;

        $.get(url_string,
              function(data) {
                var parsed_data = $.csv.toObjects(data);

                var charts_html_var = "<div id=\"chart_yield_trendg\"></div>";

                $("#chart_trend_goldenLine").html(charts_html_var);

                var golden_data = [],
                    all_data = [],
                    max_var = 0,
                    min_var = 0;

                for (var i = 0; i < parsed_data.length; i ++) {
                  var myDate = new Date(+(parsed_data[i].Date.substring(0, 4)), +(parsed_data[i].Date.substring(4, 6)) - 1, +(parsed_data[i].Date.substring(6, 8)), 0, 0, 0, 0),
                      num_var = parsed_data[i].Yield;


                  if (i == 0) {
                    max_var = +num_var;
                    min_var = +num_var;
                  }
                  else {
                    if (+num_var >= max_var) {
                      max_var = +num_var;
                    }

                    if (+num_var <= min_var) {
                      min_var = +num_var;
                    }
                  }

                  if (parsed_data[i].Line == "5F14")
                      golden_data.push([myDate.getTime(),
            	                          +num_var]);
            	    else
                      all_data.push([myDate.getTime(),
            	                       +num_var]);
                }
               

                var html_str = "<div id=\"chart_yield_trend_divg\"></div>"
                             + "</fieldset>";

                $("#chart_yield_trendg").html(html_str);

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
                    chartGolden = new Highcharts.Chart({
                    chart: {
                      renderTo: 'chart_yield_trend_divg',
                      type: 'line',
                      width: 480,
                      height: height_var,
                      marginRight: 30
                    },
                    credits: {
                      enabled: false
                    },
                    title: {
                      text: '',
                        x: -20 //center
                    },
                    tooltip: {
                  	  dateTimeLabelFormats: {
                        day: '%A, %Y-%b-%e',
                        week: '%Y-%b-%e'
                      },
        	            pointFormat: "<b>{point.series.name}</b> yield: <b>{point.y}%</b>"
                    },
                    xAxis: {
                      type: 'datetime',
                      dateTimeLabelFormats: {
                        day: '%b/%e',
                        week: '%b/%e'
                      },
                      startOfWeek: 0, // Sunday
                      minTickInterval: 24 * 3600 * 1000 // one day
                    },
                    yAxis: {
                      title: {
                        text: "Percentage (%)"
                      },
                      plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                      }],
                      ceiling: yaxis_max_var,
                      floor: yaxis_min_var
                    },
                    plotOptions: {
                      line: {
                      }
                    },
                    plotOptions: {
                      line: {
                        dataLabels: {
                          format: "{y}%",
                          enabled: true,
                          align: "left",
                          style: {
                            fontWeight: "bold"
                          },
                          crop: false
                        },
                        marker: {
                          enabled: true,
                          symbol: 'circle',
                           lineWidth: 2,
                          radius: 8,
                          states: {
                            hover: {
                              enabled: true
                            }
                          }
                        }
                      }
                    },
                    series: [
                      {name: "golden line",
                       data: golden_data,
                       color: "red",
                       marker: marker_t,
                       tooltip: {
             	           style: {
                           fontWeight: "bold"
                         }
                       }
                      },
                      {name: "all line",
                       data: all_data,
                       color: "blue",
                       marker: marker_t,
                       tooltip: {
             	           style: {
                           fontWeight: "bold"
                         }
                       }
                      }
                    ]
                  });
              })
           

                 
              
              
              
        }

        var filename_trend = "",
            file_dir = "../daily_data/stations/";

        var month_list = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
        var ago_var = 5;
        var marker_t = {fillColor: "#fff",
                        lineWidth: 2,
                        lineColor: null,
                      	radius: 2,
                        symbol: "circle"
                       };
    </script>
    <body>
     
   <!---   <div id="date_div"></div>--->
   <div id="chart_trend_goldenLine"></div>
   <div id="ago" style="display:none"> <?php if(isset($_GET["ago"]))echo $_GET["ago"];else echo ""; ?></div>
   <div id="time" style="display:none"> <?php if(isset($_GET["time"]))echo $_GET["time"];else echo ""; ?></div>
 <div id="check"  style="display:none">
    <?php 
    
             require_once 'data/dataCheck.php';
             $dataCheck = new dataCheck;
             echo  $dataCheck->check($_GET["time"]);
    ?>

</div>
   <div id="noData"  style="display:none"><img src="pic/noData/goldenLine.png" title="No Data on <?php echo $_GET["time"]; ?>" /></div>
   <!--- <div id="test" style="display:none" ></div>
    <div id="test2" style="display:none"></div>
    <div id="testT"  ></div>---->
  </body>
</html>