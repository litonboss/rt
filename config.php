<?php
$dm = 'http://yoursite.com'; // không có / ở cuối

$host = "localhost";
$username = "username";
$password = "password";
$dbname = "database";
$connection = mysql_connect($host,$username,$password);
if (!$connection)
{
die('Không Thể Kết Nối Tới CSDL => Config CSDL Sai Rồi');
}
mysql_select_db($dbname) or die('Không Kết Nối Được Tới Database => Config Sai Database');
mysql_query("SET NAMES utf8");
?>