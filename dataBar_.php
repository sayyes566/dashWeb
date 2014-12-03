<?php
require_once('connectDataBase.php');
//connectDB
$connectDataBase = new connectDataBase;
$connectDataBase->getConnLink();
//init variable
$result = array();
//echo "test";
//insert to array and expact convert to JSON
//----------------F3-------------------------
$sth = $connectDataBase->link->query("select Date, Factory, Yield from FactoryDaily where Section='FATP' and Factory = 'F3' and Date ='20141103'");
$rows = array();
$rows['name'] = 'F3';
$rows['color'] = 'red';
while($r = mysqli_fetch_array($sth)) {
    
     $rows['data'][] = (int)$r['Yield'];
    //$rows['lable'][] = $r['Date'];
}
array_push($result,$rows);

unset($rows);
//-----------------F4------------------------
$sth = $connectDataBase->link->query("select Date, Factory, Yield from FactoryDaily where Section='FATP' and Factory = 'F4'  and Date ='20141103'");
$rows = array();
$rows['name'] = 'F4';
while($r = mysqli_fetch_array($sth)) {
    
    $rows['data'][] = (int)$r['Yield'];
   // $rows['lable'][] = $r['Date'];
}
array_push($result,$rows);
unset($rows);
//-----------------F5------------------------
$sth = $connectDataBase->link->query("select Date, Factory, Yield from FactoryDaily where Section='FATP' and Factory = 'F5'   and Date = '20141103'");
$rows = array();
$rows['name'] = 'F5';
while($r = mysqli_fetch_array($sth)) {
    
    $rows['data'][] = (int)$r['Yield'];
    //$rows['lable'][] = $r['Date'];
}
array_push($result,$rows);

/*
unset($rows);
$rows = array();

$sth = $link->query("SELECT overhead FROM projections_sample");
$rows1 = array();
$rows1['name'] = 'Overhead';
while($rr = mysqli_fetch_assoc($sth)) {
    $rows1['data'][] = (int)$rr['overhead'];
}*/
//echo "1--<br />";
//print_r($rows);
//echo "2--<br />";
//print_r($rows1);


//array_push($result,$rows1);
//echo "3--<br />";
//print_r($result);
//echo "4--<br />";
//print json_encode($result, JSON_FORCE_OBJECT);
print json_encode($result);


mysqli_close($connectDataBase->link);

/*

 * select * from
(
select c.* ,d.Factory as d_Factory,d.Yield as d_Yield  from 
 (
	select a.Factory as a_Factory,a.Date,a.Yield as a_Yield,b.Factory as b_Factory,b.Yield as b_Yield from
	(SELECT Factory,Date, Yield from FactoryDaily where Section="FATP" and Factory = "F3") 
	 a join
	(SELECT  Factory,Date, Yield from FactoryDaily where Section="FATP" and Factory = "F5") 
	 b on a.Date = b.Date
 )
 c join
(SELECT  Factory,Date, Yield from FactoryDaily where Section="FATP" and Factory = "F4")
 d on c.Date = d.Date
) e
where  d_Factory = "F4"
 * 
 *  */
?>
