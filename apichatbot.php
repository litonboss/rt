<?
include'inc/config.php';
$hoi = $_GET['text'];

if($_GET['id'] == '') {
$id = 10;
}else {
$id = $_GET['id'];
}

if($_GET['token'] == '') {
$token= 10;
}else {
$token= $_GET['token'];
}

if($hoi == 'tongthanhvien') {

$babygay = mysql_query ("SELECT name, COUNT(name) FROM user");
$robersgay = mysql_fetch_array($babygay);
$out = 'Đã có tất cả '.$robersgay['COUNT(name)'].' user trên hệ thống'; 
json($out);

//end

}else if($hoi == 'thanhvienmoi') {
$req = mysql_query("SELECT * FROM `user` LIMIT 0,2");
while($res = mysql_fetch_array($req)) 
{						
$out = ' '.$res['name'].' '; 
}
json($out);
//end

}else if($hoi == 'thongtin') {

$dem = mysql_result(mysql_query("select count(*) from `user` where `user_id`='".$id."'  "),0);
if($dem == 0)
{
	$out = 'ID '.$id.' chưa có trên hệ thống.';
} 
else
{
	$out = 'ID '.$id.' đã có trên hệ thống.';
}

json($out);

//end

}else if($hoi == 'checktoken') {

$tokenlive = json_decode(auto('https://graph.facebook.com/me?access_token='.$token),true);

if(!$tokenlive[id])
{
	$out = 'Token Die';
}
else
{
	$out = 'Token Sống | '.$tokenlive[name].' | '.$tokenlive[id].' | '.$tokenlive[birthday].' . Done!';
}

json($out);

//end


}else {
$out = 'Hiện tại hệ thống chưa hỗ trợ lệnh này -_-'; 
}

function json($out) {
echo '{ "messages": [ {"text": "'.$out.'"} ] }';
}
?>
<?php
function auto($url){
   $curl = curl_init();
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($curl, CURLOPT_URL, $url);
   $ch = curl_exec($curl);
   curl_close($curl);
   return $ch;
   }
?>