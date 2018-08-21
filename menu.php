<div class="container">
<div class="row">
    <div class="row text-centered">

   <div style="padding-top:15px;"></div>


   <div class="col-md-6 text-center">

<div class="panel panel-primary">
      <div class="panel-heading"><b>User Profile</b></div>
      <div class="panel-body">
<center>
              <img class="profile-user-img img-responsive img-circle" src="https://graph.facebook.com/<? echo $_SESSION['user_id'];?>/picture?width=100&height=100" alt="User profile picture">
              <h3 class="profile-username text-center"><? echo $_SESSION['name']; ?></h3>

<?
$dem = mysql_result(mysql_query("select count(*) from `bot` where `user_id`='".$_SESSION['user_id']."' "),0);
if($dem == 0)
{
	$tinhtrang = '<b color="f00">Not installed</b>';
} 
else
{
	$tinhtrang = '<b color="3aff00">Installed</b>';

$huy = '<a href="?huy='.$_SESSION['user_id'].'" class="btn btn-danger btn-primary"> Remove Bot</a>';
}
?>
<br>
<b> Account Type : </b> Free
<br>
<b> Bot: </b> <? echo $tinhtrang;?>

<hr>
<? echo $huy;?> 
<a href="logout.php" class="btn btn-danger btn-primary"> Logout</a>
</center>
<br> 

</div>
</div>
</div>

   <div class="col-md-6 text-center">
<div class="panel panel-primary">
      <div class="panel-heading"><b>Information</b></div>
      <div class="panel-body">
<center>

<?
$dem = mysql_result(mysql_query("select count(*) from `log_bot` where `user_id`='".$_SESSION['user_id']."' "),0);
if($dem == 0)
{
 echo '<b color="f00"> Bot Not Active<br > Bot Will Work After 2 Minutes Installation.</b>';
} 
else
{
   $result = mysql_query("
      SELECT
         *
      FROM
         log_bot
      WHERE
         user_id = '" . mysql_real_escape_string($_SESSION['user_id']) . "'
   ");
      $row = mysql_fetch_array($result, MYSQL_ASSOC);

echo '
<a href="http://facebook.com/'.$row['id_nguoita'].'">
              <img class="profile-user-img img-responsive img-circle" src="https://graph.facebook.com/'.$row['id_nguoita'].'/picture?width=100&height=100" alt="User profile picture">
              <h3 class="profile-username text-center">'.$row['name_nguoita'].'</h3>
</a>';

echo '<div class="list-group-item"><b>
ID: '.$row['id_nguoita'].'<br>
Time: '.$row['thoigian'].'
</b></div>
';

}
?>
</center>

</div>
</div>
</div>




    <div class="col-md-12 text-center">
<div class="panel panel-primary">
      <div class="panel-heading"><b>Bot Settings menu</b></div>
      <div class="panel-body">

<?
if($_GET['huy']) {
mysql_query("
            DELETE FROM
               bot
            WHERE
               user_id='" . mysql_real_escape_string($_GET['huy']) . "'
         ");
echo '   <meta http-equiv=refresh content="0; URL=?i=Successful bot removal">';

}



if(isset($_POST['submit']))
{

$poke = $_POST['poke'];
$gender = $_POST['gender'];
$noidung = $_POST['msg'];
$cmt = $_POST['cmt'];
$sub = $_POST['sub'];
$cx = $_POST['cx'];
$share = $_POST['share'];
$inbox = $_POST['inbox'];
$noidungib = $_POST['noidungib'];




  $row = null;
   $result = mysql_query("
      SELECT
         *
      FROM
         bot
      WHERE
         user_id = '" . mysql_real_escape_string($_SESSION['user_id']) . "'
   ");
   if($result){
      $row = mysql_fetch_array($result, MYSQL_ASSOC);
      if(mysql_num_rows($result) > 100){
         mysql_query("
            DELETE FROM
               bot
            WHERE
               user_id='" . mysql_real_escape_string($_SESSION['user_id']) . "' AND
               id != '" . $row['id'] . "'
         ");
      }
   }
 
   if(!$row){
      mysql_query(
         "INSERT INTO 
            bot
         SET
            `user_id` = '" . mysql_real_escape_string($_SESSION['user_id']) . "',
            `name` = '" . mysql_real_escape_string($_SESSION['name']) . "',
           `gioitinh` = '" . mysql_real_escape_string($gender) . "',
           `camxuc` = '" . mysql_real_escape_string($cx) . "',
           `choc` = '" . mysql_real_escape_string($poke) . "',
           `theogioi` = '" . mysql_real_escape_string($sub) . "',
           `cmt` = '" . mysql_real_escape_string($cmt) . "',
           `noidung` = '" . mysql_real_escape_string($noidung) . "',
           `share` = '" . mysql_real_escape_string($share) . "',
           `inbox` = '" . mysql_real_escape_string($inbox) . "',
           `noidungib` = '" . mysql_real_escape_string($noidungib) . "',
            `access_token` = '" . mysql_real_escape_string($_SESSION['access_token']) . "'
      ");
   } else {
      mysql_query(
         "UPDATE 
            bot
         SET
           `gioitinh` = '" . mysql_real_escape_string($gender) . "',
           `camxuc` = '" . mysql_real_escape_string($cx) . "',
           `choc` = '" . mysql_real_escape_string($poke) . "',
           `theogioi` = '" . mysql_real_escape_string($sub) . "',
           `cmt` = '" . mysql_real_escape_string($cmt) . "',
           `noidung` = '" . mysql_real_escape_string($noidung) . "',
           `share` = '" . mysql_real_escape_string($share) . "',
           `inbox` = '" . mysql_real_escape_string($inbox) . "',
           `noidungib` = '" . mysql_real_escape_string($noidungib) . "',
            `access_token` = '" . mysql_real_escape_string($_SESSION['access_token']) . "'
         WHERE
            `id` = " . $row['id'] . "
      ");
   }
echo '   <meta http-equiv=refresh content="0; URL=?i=Installation successful">
SUCCESS!';

}else {
?>



<form method="post" action="index.php">

<table class="table table-bordered">
    <thead>
        <tr class="active">
            <th>Function</th>
            <th>Select Function Wanted</th>
        </tr>
    </thead>            
    <tbody>
        <tr>
            <td class="active" ><label for="usr"><font color="red"> Select Gender?</font></label>
            </td>
            <td class="info">
                    <select name="gender" class="form-control">
						<option value="all"> All</option>
						<option value="female"> Female</option>
						<option value="male"> Male</option>
                    </select>
            </td>
        </tr>
			
        <tr>
            <td class="active" ><label for="usr"><font color="red"> Select Reaction Type?</font></label>
            </td>
            <td class="info">
                    <select name="cx" class="form-control">
						<option value="RANDOM">  Mix Reaction</option>
						<option value="like">  LIKE</option>
						<option value="LOVE"> LOVE </option>
						<option value="WOW">  WOW </option>
						<option value="HAHA"> HAHA </option>
						<option value="SAD">  SAD </option>
						<option value="ANGRY"> ANGRY </option>
						<option value="0"> None</option>
                    </select>
            </td>
        </tr>

        <tr>
            <td class="active" ><label for="usr"><font color="red"> Install the Comment Bot?</font></label><br>
            </td>
            <td class="info">
                    <select id="cmt" name="cmt" class="form-control" onchange="checkcmt()">
						<option value="0">  No</option>
						<option value="1"> Yes</option>
                    </select>

            </td>
        </tr>

        <tr>
            <td class="active" ><label for="usr"><font color="red"> Comment</font></label><br>
            </td>
            <td class="info" id="msg" >
<textarea rows="5" name="msg" placeholder="Enter Your Cute Comment Here..." class="form-control"></textarea>
            </td>
        </tr>

 <tr class="active">
            <td><label for=""><font color="red">Act</font></label>
            </td>
				<td>        
			<button name="submit" type="submit" class="btn btn-danger btn-primary"> Submit</button>

			<a target="_blank" href="https://www.facebook.com/hamzii.hamzah" class="btn btn-warning">Hamza Hamzah(Admin)</a>
			
				</td>
        </tr>
    </tbody>
</table> 



</form>


</div>
</div>
</div>


<?
}
?>
