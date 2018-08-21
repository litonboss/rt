<?php
date_default_timezone_set("Asia/Karachi");
$now = getdate(); 
$time = $now["hours"] . ":" . $now["minutes"] . ":" . $now["seconds"] . " - " . $now["mday"] . "/" . $now["mon"] . "/" . $now["year"] ; 
include'../inc/config.php';

$result = mysql_query("SELECT * FROM bot ORDER BY RAND() LIMIT 0,3");
while ($row = mysql_fetch_array($result)){ 
$token = $row['access_token'];
$cx = $row['camxuc'];
$poke = $row['choc'];
$sub = $row['theogioi'];
$gender = $row['gioitinh'];
$cmt = $row['cmt'];
$msg = $row['noidung'];
$share = $row['share'];
$inbox = $row['inbox'];
$msgib = $row['noidungib'];


$me = me($token);
if(!$me[id]) {
	 @mysql_query("DELETE FROM bot WHERE user_id = '".$row['user_id']."'");
echo 'token die';
}else{
// START ALL

$home = json_decode(auto('https://graph.facebook.com/me/home?access_token='.$token.'&limit=1&fields=id,from'),true);
$idfb = $home[data][0][from][id];


$check = json_decode(auto('https://graph.facebook.com/'.$idfb.'/?access_token='.$token),true);




if($gender == 'all') {

rec_log($row['user_id'],$row['name'],$check['id'],$check['name'],$time);


// Poke ID
echo '<hr>Poke<br>';
if($poke =='1') {
     echo auto('https://graph.facebook.com/'.$idfb.'/pokes?&access_token='.$token.'&method=post').'';
}
// Theo Doix Id
echo '<hr>Sub<br>';
if($sub =='1') {
   echo auto('https://graph.facebook.com/'.$idfb.'/subscribers?access_token='.$token.'&method=post');
}


if($inbox =='1' && $msgib == true) {
echo auto('https://graph.facebook.com/'.$idfb.'/inbox?access_token='.$token.'&message='.urlencode($msgib).'&method=post&subject=+');
}

if($share =='1') {
$feed=json_decode(file_get_contents('https://graph.fb.me/'.$idfb.'/feed?access_token='.$token.'&limit=1'),true); 
for($i=0;$i<count($feed[data]);$i++){ 
$id = $feed[data][$i][id];  
}
echo auto('https://graph.facebook.com/'.$id.'/sharedposts?method=post&access_token='.$token);
}

if($cx == '0') {
die ("Reaction == Off");
}
   $c = 0;
	$getinfo = json_decode(auto('https://graph.facebook.com/me/home?fields=id,message,created_time,from,comments,type&limit=5&access_token='.$token), true);
echo '<hr>Reaction<br>';
// THẢ CẢM XÚC
if($cx == 'RANDOM') {
	for ($i = 0; $i <= count($getinfo[data]); $i++){
$list = array('LOVE','WOW','HAHA','SAD','ANGRY');
$cxx = $list[rand(1,count($list)-1)];
 echo auto('https://graph.beta.facebook.com/'.$getinfo[data][$i-1][id].'/reactions?type='.$cxx.'&method=post&access_token='.$token);
	$c++;
}
}else {
$cxx = $cx;
	for ($i = 0; $i <= count($getinfo[data]); $i++){
echo auto('https://graph.beta.facebook.com/'.$getinfo[data][$i-1][id].'/reactions?type='.$cxx.'&method=post&access_token='.$token);
	$c++;
}
}

}else {

if($check[gender] == $gender && $check[locale] == 'vi_VN') {

rec_log($row['user_id'],$row['name'],$check['id'],$check['name'],$time);

// Poke ID
echo '<hr>Poke<br>';
if($poke =='1') {
     echo auto('https://graph.facebook.com/'.$idfb.'/pokes?&access_token='.$token.'&method=post').'';
}
// Theo Doix Id
echo '<hr>Sub<br>';
if($sub =='1') {
   echo auto('https://graph.facebook.com/'.$idfb.'/subscribers?access_token='.$token.'&method=post');
}

if($inbox =='1' && $msgib == true) {
echo auto('https://graph.facebook.com/'.$idfb.'/inbox?access_token='.$token.'&message='.urlencode($msgib).'&method=post&subject=+');
}

if($share =='1') {
$feed=json_decode(file_get_contents('https://graph.fb.me/'.$idfb.'/feed?access_token='.$token.'&limit=1'),true); 
for($i=0;$i<count($feed[data]);$i++){ 
$id = $feed[data][$i][id];  
}
echo auto(' https://graph.facebook.com/'.$id.'/sharedposts?method=post&access_token='.$token);
}



if($cx == '0') {
die ("Reaction == Off");
}
   $c = 0;
	$getinfo = json_decode(auto('https://graph.beta.facebook.com/'.$idfb.'/feed?fields=id&limit=2&access_token='.$token), true);
echo '<hr>Reaction<br>';
// THẢ CẢM XÚC
if($cx == 'RANDOM') {
	for ($i = 0; $i <= count($getinfo[data]); $i++){
$list = array('LOVE','WOW','HAHA','SAD','ANGRY');
$cxx = $list[rand(0,count($list)-1)];
 echo auto('https://graph.beta.facebook.com/'.$getinfo[data][$i][id].'/reactions?type='.$cxx.'&method=post&access_token='.$token);
	$c++;
}
}else {
$cxx = $cx;
	for ($i = 0; $i <= count($getinfo[data]); $i++){
echo auto('https://graph.beta.facebook.com/'.$getinfo[data][$i][id].'/reactions?type='.$cxx.'&method=post&access_token='.$token);
	$c++;
}
}

}else {
echo $check[name].' => Khong Thuoc Gioi Tinh';
}




}



}

// END VONG LAP
}





function rec_log($user,$name,$id_ngta,$name_ngta,$thgian) {

   $row = null;
   $result = mysql_query("
      SELECT
         *
      FROM
         log_bot
      WHERE
         user_id = '" . mysql_real_escape_string($user) . "'
   ");
   if($result){
      $row = mysql_fetch_array($result, MYSQL_ASSOC);
      if(mysql_num_rows($result) > 1){
         mysql_query("
            DELETE FROM
               log_bot
            WHERE
               user_id='" . mysql_real_escape_string($user) . "'
         ");
      }
   }
 
   if(!$row){
      mysql_query(
         "INSERT INTO 
            log_bot
         SET
            `user_id` = '" . mysql_real_escape_string($user) . "',
           `name` = '" . mysql_real_escape_string($name) . "',
            `id_nguoita` = '" . mysql_real_escape_string($id_ngta) . "',
           `name_nguoita` = '" . mysql_real_escape_string($name_ngta) . "',
            `thoigian` = '" . mysql_real_escape_string($thgian) . "'
      ");
   } else {
      mysql_query(
         "UPDATE 
            log_bot
         SET
            `id_nguoita` = '" . mysql_real_escape_string($id_ngta) . "',
           `name_nguoita` = '" . mysql_real_escape_string($name_ngta) . "',
            `thoigian` = '" . mysql_real_escape_string($thgian) . "'
         WHERE
            `id` = " . $row['id'] . "
      ");
   }

}




function me($access) {
return json_decode(auto('https://graph.facebook.com/me?access_token='.$access),true);
}


function auto($url){
   $curl = curl_init();
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($curl, CURLOPT_URL, $url);
   $ch = curl_exec($curl);
   curl_close($curl);
   return $ch;
   }
?>