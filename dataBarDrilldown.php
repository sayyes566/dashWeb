<?php
/*
$servername = "localhost";
$username = "root";
$password = "2823";
$dbName = "newschema";
*/
require_once('connectDataBase.php');
class DrillData extends connectDataBase
{
    /*
$servername = "172.28.138.62";
$username = "kristen.lin";
$password = "";
$dbName = "test";
$link = mysqli_connect($servername,$username,$password,$dbName) or die("Error " . mysqli_error($link)); 
*/
function getDrillData()
{
 $connectDataBase = new connectDataBase;
 $connectDataBase->getConnLink();
$sth = mysqli_query($connectDataBase->link,"select Factory,Date,Yield from FactoryDaily where Section='FATP'") or die (mysqli_error());  
echo "<pre>";
$total=0;
while($r = mysqli_fetch_array($sth)) {
  echo $r['Factory']." v".$r['Date']."\t".$r['Yield']."u";
  break;
 // $total += (int)$r['Yield'];
}
echo "</pre>";
mysqli_close($connectDataBase->link);
}

}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
        <body>
          
<?php
        require_once('dataBarDrilldown.php');
        $dataD = new DrillData;
        $dataD->getDrillData();
    // put your code here
    //echo "HI";
    //echo "HI";
   
/*
 *
 [
    {
	"type":"pie",
	"name":"Revenue",
	"data":[
		[23987,24784,25899,25569,25897,25668,24114,23899,24987,25111,25899,23221],
                [21990,22365,21987,22369,22558,22987,23521,23003,22756,23112,22987,22897]
		]
    }	
]
 * 
 * 
 *  */
?>

        </body>
</html>
