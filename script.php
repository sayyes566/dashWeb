<?php

if (isset($_GET['account'])) 
{
    $account = $_GET['account']; 
    require_once('data/dataBar.php');
    $dt = new dataBar(); 
    $dt->getJsonData($account);
    echo "~~~~~~~~";  
}
else 
{
     $account = "None"; 
}

//echo "~".$account;  



?>