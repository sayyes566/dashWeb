<?php
require_once('connectDataBase.php');
  date_default_timezone_set("Asia/Taipei");
/*
 *select * from (select Station, Detail, count(*) as top_fail from 
 * SNDetailDaily 
 * where Date='20141104' and Project='Panda' and Section='FATP' 
 * and Station='BURN-IN' 
 * group by Detail order by top_fail DESC LIMIT 3) t0 
 * union
 *  select * from (select Station, Detail, count(*) as top_fail 
 * from SNDetailDaily where
 *  Date='20141104' and Project='Panda' and Section='FATP' 
 * and Station='FACT 21 CAL&TEST' group by Detail order by top_fail DESC LIMIT 3) t1 
 * union select * from (select Station, Detail, count(*) as top_fail from SNDetailDaily 
 * where Date='20141104' and Project='Panda' and Section='FATP' and Station='SWDL1' group by Detail 
 * order by top_fail DESC LIMIT 3) t2 union 
 * select * from (select Station, Detail, count(*) as top_fail from SNDetailDaily 
 * where Date='20141104' and Project='Panda' and Section='FATP' and Station='SHIPPING SETTING' 
 * group by Detail order by top_fail DESC LIMIT 3) t3 union 
 * select * from (select Station, Detail, count(*) as top_fail from SNDetailDaily 
 * where Date='20141104' and Project='Panda' and Section='FATP' and Station='LCD UNIFORMITY' 
 * group by Detail order by top_fail DESC LIMIT 3) t4
 * 
 * 
 * select * from (select Station, Detail, count(*) as top_fail from SNDetailDaily where Date='20141104' and Project='Panda' and Section='FATP' and Station='BURN-IN' group by Detail order by top_fail DESC LIMIT 3) t0 union select * from (select Station, Detail, count(*) as top_fail from SNDetailDaily where Date='20141104' and Project='Panda' and Section='FATP' and Station='FACT 21 CAL&TEST' group by Detail order by top_fail DESC LIMIT 3) t1 union select * from (select Station, Detail, count(*) as top_fail from SNDetailDaily where Date='20141104' and Project='Panda' and Section='FATP' and Station='SWDL1' group by Detail order by top_fail DESC LIMIT 3) t2 union select * from (select Station, Detail, count(*) as top_fail from SNDetailDaily where Date='20141104' and Project='Panda' and Section='FATP' and Station='SHIPPING SETTING' group by Detail order by top_fail DESC LIMIT 3) t3 union select * from (select Station, Detail, count(*) as top_fail from SNDetailDaily where Date='20141104' and Project='Panda' and Section='FATP' and Station='LCD UNIFORMITY' group by Detail order by top_fail DESC LIMIT 3) t4
 * 
 *  */
  $time_var = $_GET["time"];
  $item_var = $_GET["item"];

  if (!empty($_GET["section"]))
    $section_var = $_GET["section"];

  if (!empty($_GET["factory"]))
    $factory_var = $_GET["factory"];

  if (!empty($_GET["line"]))
    $line_var = $_GET["line"];

  if (!empty($_GET["station"]))
    $station_var = $_GET["station"];

  if (!empty($_GET["station"])) {
    $echo_string = "IP," . ucfirst($item_var) .",Detail,Top" . ucfirst($item_var) . "\n";
    $query_cmd = "select IP, " . ucfirst($item_var) . " from StationIPDaily where Date='" . $time_var . "' and Fail!=0 and section='" . $section_var . "' and line='" . $line_var . "' and station='" . $station_var . "' order by " . ucfirst($item_var);
  }
  else if (!empty($_GET["line"])) {
    $echo_string = "Station," . ucfirst($item_var) .",Detail,Top" . ucfirst($item_var) . "\n";
    $query_cmd = "select Station, " . ucfirst($item_var) . " from StationDaily where Date='" . $time_var . "' and Fail!=0 and section='" . $section_var . "' and line='" . $line_var . "' order by " . ucfirst($item_var);
  }
  else if (!empty($_GET["factory"])) {
    $echo_string = "Station," . ucfirst($item_var) .",Detail,Top" . ucfirst($item_var) . "\n";

    if ($item_var == "fail")
      $query_cmd = "select Station, SUM(Fail) as Fail from StationDaily where Date='" . $time_var . "' and Fail!=0 and section='" . $section_var . "' and factory='" . $factory_var . "' group by Station order by Fail";
    else if ($item_var == "yield")
      //$query_cmd = "select Station, round(100 * (SUM(Input_Count) - SUM(Fail)) / SUM(Input_Count), 2) as Yield from StationDaily where Date='" . $time_var . "' and Fail!=0 and section='" . $section_var . "' and factory='" . $factory_var . "' group by Station order by Yield";
      $query_cmd = "select Station, round(100 * (SUM(Input_Count) - SUM(Fail)) / SUM(Input_Count), 2) as Yield from StationDaily where Date='" . $time_var . "' and Fail!=0 and section='" . $section_var . "' and factory='" . $factory_var . "' and station!='ASSY KP INPUT16' group by Station order by Yield";
  }
  else {
    $echo_string = "Station," . ucfirst($item_var) .",Detail,Top" . ucfirst($item_var) . "\n";
    $query_cmd = "select Station, " . ucfirst($item_var) . " from StationCrossLineDaily where Date='" . $time_var . "' and Fail!=0 and section='" . $section_var . "' order by " . ucfirst($item_var);
  }

  if ($item_var == "yield")
    $query_cmd .= " ASC, Fail DESC LIMIT 5";
  else if ($item_var == "fail")
    $query_cmd .= " DESC, Fail DESC LIMIT 5";

  //echo $query_cmd;

  // open connection to server
  //connectDB
$connectDataBase = new connectDataBase;
$connectDataBase->getConnLink();


/*
  if (!$conn)
    die("Could not connect: " . mysql_error());

  // open database
  mysqli_select_db("rmon_daily", $conn);

  if (!$conn)
    die("Could not connect database: " . mysqli_error());
*/
  // sql query
$result = @$connectDataBase->link->query($query_cmd);
  //$result = mysqli_query($query_cmd);

  $bData = false;

  while ($row = mysqli_fetch_array($result)) {
    if (!empty($_GET["station"])) {
      $echo_string .= $row["IP"];

      $fail_array[] = $row["IP"];
    }
    else {
      $echo_string .= $row["Station"];

      $fail_array[] = $row["Station"];
    }

    $echo_string .= "," . $row[ucfirst($item_var)] . ",,\n";

    $bData = true;
  }

  if (!$bData) {
    echo $echo_string;

    return;
  }

  //echo $echo_string;

  $query_cmd = "select Input_Count from ProjectDaily where Date='" . $time_var . "' and Project='Panda' and Section='" . $section_var . "'";

  //echo $query_cmd;

  // sql query
  $result = @$connectDataBase->link->query($query_cmd);
  //$result = mysqli_query($query_cmd);

  while ($row = mysqli_fetch_array($result)) {
    $input_var = $row["Input_Count"];
  }

  //echo $input_var;

  $query_cmd = "";

  for ($i = 0; $i < sizeof($fail_array); $i++) {
    if ($i == 0) {
      if ($item_var == "yield") {
        if (!empty($_GET["station"]))
          $query_cmd = "select * from (select IP, Detail, round(100 * count(*) / " . $input_var . ", 2) as top_yield from SNDetailDaily where Date='" . $time_var . "' and Project='Panda'";
        else
          $query_cmd = "select * from (select Station, Detail, round(100 * count(*) / " . $input_var . ", 2) as top_yield from SNDetailDaily where Date='" . $time_var . "' and Project='Panda'";
      }
      else if ($item_var == "fail") {
        if (!empty($_GET["station"]))
          $query_cmd = "select * from (select IP, Detail, count(*) as top_fail from SNDetailDaily where Date='" . $time_var . "' and Project='Panda'";
        else
          $query_cmd = "select * from (select Station, Detail, count(*) as top_fail from SNDetailDaily where Date='" . $time_var . "' and Project='Panda'";
      }
    }
    else {
      if ($item_var == "yield") {
        if (!empty($_GET["station"]))
          $query_cmd .= " union select * from (select IP, Detail, round(100 * count(*) / " . $input_var . ", 2) as top_yield from SNDetailDaily where Date='" . $time_var . "' and Project='Panda'";
        else
          $query_cmd .= " union select * from (select Station, Detail, round(100 * count(*) / " . $input_var . ", 2) as top_yield from SNDetailDaily where Date='" . $time_var . "' and Project='Panda'";
      }
      else if ($item_var == "fail") {
        if (!empty($_GET["station"]))
          $query_cmd .= " union select * from (select IP, Detail, count(*) as top_fail from SNDetailDaily where Date='" . $time_var . "' and Project='Panda'";
        else
          $query_cmd .= " union select * from (select Station, Detail, count(*) as top_fail from SNDetailDaily where Date='" . $time_var . "' and Project='Panda'";
      }
    }

    if (!empty($_GET["section"]))
      $query_cmd .= " and Section='" . $section_var . "'";

    if (!empty($_GET["factory"]))
      $query_cmd .= " and Factory='" . $factory_var . "'";

    if (!empty($_GET["line"]))
      $query_cmd .= " and Line='" . $line_var . "'";

    if (!empty($_GET["station"]))
      $query_cmd .= " and Station='" . $station_var . "' and IP='" . $fail_array[$i] . "'";
    else
      $query_cmd .= " and Station='" . $fail_array[$i] . "'";

    $query_cmd .= " group by Detail order by";

    if ($item_var == "yield")
      $query_cmd .= " top_yield";
    else if ($item_var == "fail")
      $query_cmd .= " top_fail";

    $query_cmd .= " DESC LIMIT 3) t" . $i;
  }

 // echo $query_cmd.'<br />';

  // sql query
  $result = @$connectDataBase->link->query($query_cmd);
 // $result = mysqli_query($query_cmd);

  while ($row = mysqli_fetch_array($result)) {
    if ($item_var == "yield") {
      if (!empty($_GET["station"]))
        $echo_string .= $row["IP"] . ",," . $row["Detail"] . "," . $row["top_yield"] . "\n";
      else
        $echo_string .= $row["Station"] . ",," . $row["Detail"] . "," . $row["top_yield"] . "\n";
    }
    else if ($item_var == "fail") {
      if (!empty($_GET["station"]))
        $echo_string .= $row["IP"] . ",," . $row["Detail"] . "," . $row["top_fail"] . "\n";
      else
        $echo_string .= $row["Station"] . ",," . $row["Detail"] . "," . $row["top_fail"] . "\n";
    }
  }

  echo $echo_string;
?>