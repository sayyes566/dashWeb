<?php
class connectDataBase
{
var $servername = "172.28.138.62";
var $username = "kristen.lin";
var $password = "";
var $dbName = "rmon_daily";
var $link;

    function getConnLink()
    {
    $this -> link = mysqli_connect($this->servername,$this->username,$this->password,$this->dbName) or die("Error " . mysqli_error($link)); 
    }
}
?>