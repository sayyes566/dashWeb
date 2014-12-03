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
         <link rel="stylesheet" href="css/jqueryUI/smoothness/jquery-ui.css">

 <script type="text/javascript" src="js/jquery-mini.js"></script>
        
                <script type="text/javascript" src="js/jquery-ui.js"></script>

                <script src="js/exporting.js"></script>
                        <script type="text/javascript" src="js/jquery.csv.js"></script>
                <script type="text/javascript" src="js/highcharts.js"></script>
 
    </head>
    <script>
  $(function() {
     
    $( "#chart_trend_div_yield_" ).dialog({
      autoOpen: false,
       resizable: false,
       height:640,
       width:640,
       modal: true,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      }
    });
 
    $( "#opener" ).click(function() {
      $( "#chart_trend_div_yield_" ).dialog( "open" );
    });
    var html_str = "<fieldset id=\"yield\" style=\"width: 200px; height: 150px;\">",
            unit_str = "",
            format_str = "",
            point_str = "";

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
       var yaxis_max_var = 100,
                    yaxis_min_var = ((min_var - (max_var - min_var) * 0.1) > 0) ? (min_var - (max_var - min_var) * 0.1) : 0;
                   var max_var = 0,
            max_date = 0,
            min_var = 0,
            min_date = 0,
            yesterday_var = 0,
            today_var = 0;
         //    var chartYield;
                var real_data = [];
   url_string = "data/trend_full.php?item=yield&section=FATP&time=20141101";
  $.get(url_string,function(data) {
                      var parsed_data = $.csv.toObjects(data);
                
                for (var i = 0; i < parsed_data.length; i ++) {
                  var myDate = new Date(+(parsed_data[i].Date.substring(0,4)), +(parsed_data[i].Date.substring(4,6)) - 1, +(parsed_data[i].Date.substring(6,8)), 0, 0, 0, 0),
                      num_var = getVal("yield", parsed_data[i]);

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
               
    var  chartYield = new Highcharts.Chart({
               // $("#chart_trend_div_yield_").highcharts({
                  chart: {
                    renderTo: 'chart_trend_div_yield_',
                    type: 'line',
                    width: 500,
                    height: 200
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
              });
   });

        var filename_trend = "",
            file_dir = "../daily_data/stations/";

        var month_list = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
  </script>
    <body>
        <?php
        // put your code here
        ?>
        <div id="dialog" title="Basic dialog">
  <p>This is an animated dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.</p>
</div>
 
<button id="opener">Open Dialog</button>

  <div id="chart_trend_div_yield_" title="test" style="display:none">123</div>
    </body>
</html>
