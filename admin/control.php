<?php 
if(!isset($_SESSION))
{
session_start();
}
include "../db.php";
if (isset($_POST["loginusernameadmin"]))
{
$loginusernameadmin = $_POST["loginusernameadmin"];
$loginpasswordadmin = $_POST["loginpasswordadmin"];
$_SESSION['loginusernameadmin'] = $loginusernameadmin;
$_SESSION['loginpasswordadmin'] = $loginpasswordadmin;
}
	if(($_SESSION['loginusernameadmin'] != $adminuserid) or ($_SESSION['loginpasswordadmin'] != $adminpassword))
	{
	unset($_SESSION["loginusernameadmin"]);
	unset($_SESSION["loginpasswordadmin"]);
	$show = "<div class=\"message\">Incorrect Login</div>";
	@header("Location: " . $domain . "/admin/index.php?show=" . $show);
	exit;
	}
include "adminnav.php";
?>
