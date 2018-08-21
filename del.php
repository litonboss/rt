<?php
include './inc/config.php';
$gettoken = mysql_query("SELECT * FROM `user` LIMIT 0,500");
  while ($get = mysql_fetch_array($gettoken)){
  $token = $get['access_token'];
$check = json_decode(auto('https://graph.facebook.com/me?access_token='.$token),true);
if(!$check['id']){
@mysql_query("DELETE FROM user WHERE token ='".$token."'");
continue;
}}
echo 'Delete Token Done';
function auto($url) {
   $ch = curl_init();
   curl_setopt_array($ch, array(
      CURLOPT_CONNECTTIMEOUT => 5,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_URL            => $url,
      )
   );
   $result = curl_exec($ch);
   curl_close($ch);
   return $result;
}
?>