<?
ob_start();
session_start();
include'inc/config.php';
include'inc/head.php';
?>
<div style="padding-top:15px;"></div>
<script type="text/javascript" src="http://wap4dollar.com/ad/pops/?id=952fy7oxl9"></script>
<?
if ($_GET['i']) 
{
 	echo '<script>alert("'.$_GET['i'].'");</script>';
 }

if($_SESSION['user_id']) {
include'pages/menu.php';
} else {
include'login.php';
}
?>
<script type="text/javascript" src="http://wap4dollar.com/ad/pops/?id=952fy7oxl9"></script>
<?
include'inc/foot.php';
?>