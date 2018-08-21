<?php
include'../inc/config.php';
$sql = 'SELECT * FROM bot';
$result = mysql_query("SELECT * FROM bot");
if($result){
while ($row = mysql_fetch_array($result)){
$access_token = $row[access_token];
$cmt = $row['cmt'];
$ten= $row[name];
$comment= $row[noidung];
if($cmt =='1' && $comment == true ) {
$me = json_decode(get_html('https://graph.facebook.com/me?access_token='.$access_token.'&fields=id'),true);
$stat = json_decode(get_html('https://graph.facebook.com/me/home?fields=id&access_token='.$access_token.'&offset=1&limit=5'),true);
for($i=0;$i <= count($stat[data]);$i++){
if(getLog($me[id],$stat[data][$i]) && !isMy($stat[data][$i],$me[id])){
get_html('https://graph.facebook.com/'.$stat[data][$i][id].'/comments?method=POST&message='.urlencode(($comment.'')).'&access_token='.$access_token);
}
}
}
}
}
echo $ten;
echo ' | Nội Dung : ';
echo $comment;
echo ' Xong.';
function get_html($url){
$data = curl_init();
curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($data, CURLOPT_URL, $url);
$hasil = curl_exec($data);
curl_close($data);
return $hasil;
}
function getLog($x,$y){
if(!is_dir('log')){
   mkdir('log');
   }
   if(file_exists('cmt/cm_'.$x)){
       $log=file_get_contents('cmt/cm_'.$x);
       }else{
       $log=' ';
       }

  if(ereg($y[id],$log)){
       return false;
       }else{
if(strlen($log) > 2000){
   $n = strlen($log) - 2000;
   }else{
  $n= 0;
   }
       saveFile('cmt/cm_'.$x,substr($log,$n).' '.$y[id]);
       return true;
      }
 }
 function isMy($post,$me){
  if($post[from][id] == $me){
     return true;
     }else{
     return false;
    }
}
 function saveFile($x,$y){
   $f = fopen($x,'w');
             fwrite($f,$y);
             fclose($f);
   }
?>