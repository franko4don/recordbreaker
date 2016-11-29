<?php
include 'classes.php';
/**echo "*.*<br>";
mysql_connect("localhost", "franko4don","") or die(mysql_error()); 
//mysql_select_db("investor") or die(mysql_error());
$query1="CREATE USER 'admin'@'localhost' IDENTIFIED BY '***'";
$query2="GRANT SELECT ON *.* TO 'admin'@'localhost' IDENTIFIED BY '***' WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0";
$query3="REVOKE GRANT OPTION ON *.* FROM 'admin'@'localhost'";
mysql_query($query1) or die(mysql_error());
mysql_query($query2) or die(mysql_error());
mysql_query($query3) or die(mysql_error());*/
$dbhandle=new DBHandler;
$dbhandle->createUserInvestor("franky", "chuky4don");
//$dbhandle->selectData();
$array=array("Name"=>"Nwanze Franklin","age"=>"23","Skill"=>"Programming", "username"=>"chuky", "email"=>"franko4don");
$dbhandle->insertDataIntoInvestor($array,"data");
?>
