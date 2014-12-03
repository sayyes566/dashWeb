<?php session_start(); ?>

<!DOCTYPE html>
<html>
	<head>
    <meta charset="utf-8" />
    <title>Top 5 Fallout Table</title>
    <link rel="stylesheet" type="text/css" href="../css/dropdown.css" />
    <link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css" />
    <link rel="stylesheet" type="text/css" href="../css/dataTables.colVis.css" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <style type="text/css">
      body {
        font-family: Verdana;
      }

      table {
        font-size: 14px;
       
      }
      .displayTable  {
           border:#ccc solid 1px;
      }
      .displayTable td {
           border:#ccc solid 1px;
        
      }


      td {
        text-align: center;
      }

      td.station {
        text-align: left;
      }

      td.autonewline {
        text-align: left;
        word-break: break-all;
      }

      a.link {
      	text-decoration: none;
      }

      div.link {
      	height: 100%;
      	width: 100%;
      }

      th, td {
        white-space: nowrap;
      }
    </style>
     <!----
    <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>----->
    <script type="text/javascript" src="js/jquery.csv.js"></script>
   
   
	</head>
	<body>
            <!----
    <div id="date_div"></div>
    <div id="mode_sel"></div>
    <h4 id="name_tag"></h4>
    <div id="table_div"></div>----->
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
      }*/
/*
      function selectDate() {
        var time_tag = $("#date_sel").val();

        if (time_tag == "")
          alert("Please pick a date!");
        else {
          if (getParameter("time") != "")
            window.open("top5.html" + window.location.search.replace(new RegExp(getParameter("time"),"g"), time_tag.substring(0, 4) + time_tag.substring(5, 7) + time_tag.substring(8, 10)), "_self");
          else
            window.open("top5.html?item=" + item_var + "&time=" + time_tag.substring(0, 4) + time_tag.substring(5, 7) + time_tag.substring(8, 10) + "&project=" + project_var + "&sectiont=" + section_var, "_self");
        }

        return;
      }*/

      function formatStationName(string) {
        return string.search("&") != -1 ? string.replace(/&/g, "%26"): string;
      }
   $(function initTable() {

        var checkDate =  $.trim($("#check_FailFall").text());
 // $("#testT").text("okok"+checkDate );
        if (checkDate==0)
        {
          $("#noData_FailFallOut").show(); 
         
        }//check date
        else
        {
          $("#table_FailFallOut").show(); 
         
        }
              
   /*   var filename_station = "",
          project_var = getParameter("project"),
          section_var = getParameter("section"),
          factory_var = getParameter("factory"),
          line_var = getParameter("line"),
          station_var = getParameter("station").replace(/%20/g, " ").replace(/%26/g, "&"),
          time_var = getParameter("time"),
          item_var = getParameter("item");*/
       var time_var = $.trim($("#time").text()),
            project_var =  $.trim($(".selectPr").text()),
            section_var =  $.trim($("#section").text()),
            factory_var =  $.trim($(".selectFa").text()),
      	    line_var =  $.trim($(".selectLi").text()),
      	    station_var = $.trim($(".selectSt").text()),
            item_var ="fail";
            
	   
                  
/*
      var div_str = "<p>Please pick a date: "
                  + "<input type=\"text\" id=\"date_sel\" name=\"date\" />"
                  + "<button onclick=\"selectDate()\">Go</button>";
*/
     // $("#date_div").html(div_str);
   //   $("#date_sel").datepicker({dateFormat:"yy-mm-dd", showMonthAfterYear: true});
/*
      if (time_var != "") {
        $("#date_sel").val(time_var.substring(0, 4) + "-" + time_var.substring(4, 6) + "-" + time_var.substring(6, 8));
*/
        var div_str = "<table id=\"table_id\" class=\"displayTable\">"
                    + "<thead style=\"font-weight: bold;\">"
                    + "<tr>";

        if (station_var != "")
	        div_str += "<td>IP</td>";
        else
	        div_str += "<td>Station</td>";

        if (item_var == "yield")
	        div_str += "<td>Yield</td>";
        else if (item_var == "fail")
	        div_str += "<td>Fail</td>";
        else
	        alert("what is it?");

	      div_str += "</tr>"
	               + "</thead>"
	               + "<tbody>";
    var condition = $("#conditionBar").text();
        condition = condition.replace(/\anda/g,"\#").replace(/\and/g,"&").replace(/ /g,"").replace(/'/g,"").replace(/\#/g,"anda").replace(/\Date/g,"time");
        condition =  condition.toLowerCase();
        //var url_string = "data/trend_full.php?item=" + item_var + "&condi="+condition;
      
       if(condition=="")
            var url_string = "data/dataTrend_FailFallOut.php?item=" + item_var + "&time=" + time_var + "&project=Panda&section=FATP";
       else
            var url_string = "data/dataTrend_FailFallOut.php?item=" + item_var + "&time=" + time_var +  "&" + condition;
       // $("#testT").text(" fff "+url_string);
        if (factory_var != "")
          url_string += "&factory=" + factory_var;

        if (line_var != "")
          url_string += "&line=" + line_var;

        if (station_var != "")
          url_string += "&station=" + formatStationName(station_var);

	        $.get(url_string,
	              function(data) {
	              	var datatmp = $.csv.toObjects(data);

	                for (var i = 0; i < datatmp.length; i++) {
	                  // list stations
	                  div_str += "<tr>";

                    if (station_var != "")
	                    div_str += "<td class=\"station\">" + datatmp[i].IP + "</td>";
                    else
	                    div_str += "<td class=\"station\">" + datatmp[i].Station + "</td>";

                    if (item_var == "yield")
	                    div_str += "<td>" + datatmp[i].Yield + "%</td>";
                    else if (item_var == "fail")
	                    div_str += "<td>" + datatmp[i].Fail + "</td>";
                    else
	                    alert("what is it?");

	                  div_str += "</tr>";
	                }

                  div_str += "</tbody>"
	                         + "</table>";

	                $("#table_FailFallOut").html(div_str);
	
	                var table = $("#table_id").DataTable({"paging": false,
                                                        "ordering": false,
                                                        "info": false,
                                                        "searching": false
	                                                     });
	              },
	              "text");
                  
                 
  
           $( "#diago_FailFallOut" ).dialog({
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
                         title: 'Top 3 Fail Issue',
                         position: { my: "center", at: "top", of:  window}
                      });
               
                    $( "#table_FailFallOut").dblclick(function() {
                         $( "#diago_FailFallOut" ).dialog( "open" );
                         $("#diago_FailFallOut_content").load('trend_FailFallOut_more.php');
                        // $("#ch").text('456');
                         /*
                         var bar_url_string;
                        var condition = $("#conditionBar").text();
                        condition = condition.replace(/\anda/g,"\#").replace(/\and/g,"&").replace(/ /g,"").replace(/'/g,"").replace(/\#/g,"anda").replace(/\Date/g,"time");
                        condition =  condition.toLowerCase();
                        var item_var = 'input_count';//fixed
                        if(condition=="")
                       bar_url_string = "barInputTrend.php?item=" + item_var +"&section=FATP";
                      else
                      bar_url_string = "barInputTrend.php?item=" + item_var +"&"+condition;
                       */
                      });
                      
                  
	      });
      
    </script>
   <!---- <div id="testT"></div>---->
    <div id="noData_FailFallOut" style="display:none">
        <img src="pic/noData/retestRatio.bmp" title="No Data on <?php echo $_GET["time"]; ?>" />
    </div>
    <div id="table_FailFallOut"  style="display:none"></div>
   
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
    <div id="check_FailFall" style="display:none" >
    <?php 
    
             require_once 'data/dataCheck.php';
             $dataCheck = new dataCheck;
             echo  $dataCheck->check($_GET["time"]);
           //  echo $_GET["time"];
    ?>
    </div>
   
  </body>
</html>