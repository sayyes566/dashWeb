<?php session_start(); ?>

<!DOCTYPE html>
<html>
	<head>
    <meta charset="utf-8" />
    <title>Top 5 Fallout Table more</title>
    <!----
    <link rel="stylesheet" type="text/css" href="../css/dropdown.css" />
    <link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css" />
    <link rel="stylesheet" type="text/css" href="../css/dataTables.colVis.css" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    ---->
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
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/jquery.csv.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="js/dataTables.fixedColumns.js"></script>
    <script type="text/javascript" src="js/dataTables.colVis.js"></script>
            ---->
	</head>
	<body>
    <div id="date_div"></div>
    <div id="mode_sel"></div>
    <h4 id="name_tag"></h4>
    <div id="table_YieldFallOut_more"></div>
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
            window.open("top5_more.html" + window.location.search.replace(new RegExp(getParameter("time"),"g"), time_tag.substring(0, 4) + time_tag.substring(5, 7) + time_tag.substring(8, 10)), "_self");
          else
            window.open("top5_more.html?item=" + item_var + "&time=" + time_tag.substring(0, 4) + time_tag.substring(5, 7) + time_tag.substring(8, 10) + "&project=" + project_var + "&sectiont=" + section_var, "_self");
        }

        return;
      }
*/
      function formatStationName(string) {
        return string.search("&") != -1 ? string.replace(/&/g, "%26"): string;
      }
/*
      var filename_station = "",
          project_var = getParameter("project"),
          section_var = getParameter("section"),
          factory_var = getParameter("factory"),
          line_var = getParameter("line"),
          station_var = getParameter("station").replace(/%20/g, " ").replace(/%26/g, "&"),
          time_var = getParameter("time"),
          item_var = getParameter("item");*/
    var time_var = $.trim($("#time").text()),
            project_var =  $.trim($(".selectPr").text()),
            section_var =  $.trim($(".selectSe").text()),
            factory_var =  $.trim($(".selectFa").text()),
           line_var =  $.trim($(".selectLi").text()),
           station_var = $.trim($(".selectSt").text()),
              item_var = 'yield';
   /*   var div_str = "<p>Please pick a date: "
                  + "<input type=\"text\" id=\"date_sel\" name=\"date\" />"
                  + "<button onclick=\"selectDate()\">Go</button>";*/

    //  $("#date_div").html(div_str);
  //    $("#date_sel").datepicker({dateFormat:"yy-mm-dd", showMonthAfterYear: true});

      if (time_var != "") {
        $("#date_sel").val(time_var.substring(0, 4) + "-" + time_var.substring(4, 6) + "-" + time_var.substring(6, 8));

        var div_str = "<table  border=\"1\" align=\"center\">"
                    + "<thead style=\"font-weight: bold;\">"
                    + "<tr>";

        if (station_var != "")
	        div_str += "<td style=\"width: 200px; background-color: #EE82EE;\">IP</td>";
        else
	        div_str += "<td style=\"width: 200px; background-color: #EE82EE;\">Station</td>";

        if (item_var == "yield")
	        div_str += "<td style=\"width: 100px; background-color: #EE82EE;\">Yield</td>";
        else if (item_var == "fail")
	        div_str += "<td style=\"width: 100px; background-color: #EE82EE;\">Fail</td>";
        else
	        alert("what is it?");

	      div_str += "<td style=\"background-color: #EE82EE;\">Top 3 fail issue</td>"
                 + "</tr>"
	               + "</thead>"
	               + "<tbody>";


 
        var url_string = "data/dataFail_fallout_more.php?item=" + item_var + "&time=" + time_var + "&project=" + project_var + "&section=" + section_var;

        if (factory_var != "")
          url_string += "&factory=" + factory_var;

        if (line_var != "")
          url_string += "&line=" + line_var;

        if (station_var != "")
          url_string += "&station=" + formatStationName(station_var);

	      $(function initTable() {
	        $.get(url_string,
	              function(data) {
	              	var datatmp = $.csv.toObjects(data);

                  if (datatmp.length == 0) {
                    alert("No data!");

                    return;
                  }

                  var tr_data = [];

	                for (var i = 0; i < datatmp.length; i++) {
                    if (item_var == "yield") {
	                    if (datatmp[i].Yield == "")
                        continue;
                    }
                    else if (item_var == "fail") {
	                    if (datatmp[i].Fail == "")
                        continue;
                    }
                    else
	                    alert("what is it?");

                    if (station_var != "") {
                      if (item_var == "yield")
	                      tr_data.push([datatmp[i].IP, datatmp[i].Yield]);
                      else if (item_var == "fail")
	                      tr_data.push([datatmp[i].IP, datatmp[i].Fail]);
                      else
	                      alert("what is it?");
                    }
                    else {
                      if (item_var == "yield")
	                      tr_data.push([datatmp[i].Station, datatmp[i].Yield]);
                      else if (item_var == "fail")
	                      tr_data.push([datatmp[i].Station, datatmp[i].Fail]);
                      else
	                      alert("what is it?");
                    }
	                }

                  for (var i = 0; i < tr_data.length; i++) {
	                  // list stations
	                  div_str += "<tr>"
                             + "<td rowspan=3>" + tr_data[i][0] + "</td>"
                             + "<td rowspan=3>" + tr_data[i][1];

                    if (item_var == "yield")
                      div_str += "%</td>";
                    else if (item_var == "fail")
                      div_str += "</td>";
                    else
	                    alert("what is it?");

                    var count = 0;

                    for (var j = 0; j < datatmp.length; j++) {
                      if (station_var != "") {
	                      if (datatmp[j].IP != tr_data[i][0])
                          continue;
                      }
                      else {
	                      if (datatmp[j].Station != tr_data[i][0])
                          continue;
                      }

                      if (item_var == "yield") {
                        if (datatmp[j].TopYield != "") {
                          if (count == 0)
	                          div_str += "<td style=\"text-align: left;\">" + datatmp[j].Detail + "</td>";
                          else
	                          div_str += "<tr><td style=\"text-align: left;\">" + datatmp[j].Detail + "</td></tr>";

                          count++;
	                      }
                      }
                      else if (item_var == "fail") {
                        if (datatmp[j].TopFail != "") {
                          if (count == 0)
	                          div_str += "<td style=\"text-align: left;\">" + datatmp[j].Detail + "</td>";
                          else
	                          div_str += "<tr><td style=\"text-align: left;\">" + datatmp[j].Detail + "</td></tr>";

                          count++;
	                      }
                      }
                      else
	                      alert("what is it?");
	                  }

                    if (count == 0) {
	                    div_str += "<td></td>";

                      count++;
                    }

	                  div_str += "</tr>";

                    for (var j = 0; j < 3 - count; j++)
	                    div_str += "<tr><td></td></tr>";
	                }

                  div_str += "</tbody>"
	                         + "</table>";

	                $("#table_YieldFallOut_more").html(div_str);
	              });
	      });
      }
    </script>
  </body>
</html>