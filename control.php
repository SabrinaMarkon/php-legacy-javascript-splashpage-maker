<?php 
if(!isset($_SESSION))
{
session_start();
}
include "db.php";
if (isset($_REQUEST["loginusername"]))
{
$loginusername = $_REQUEST["loginusername"];
$loginpassword = $_REQUEST["loginpassword"];
$_SESSION["loginusername"] = $loginusername;
$_SESSION["loginpassword"] = $loginpassword;
}
$loginq = "select * from members where userid=\"".$_SESSION['loginusername']."\" and password=\"".$_SESSION['loginpassword']."\"";
$loginr = mysql_query($loginq);
$loginrows = mysql_num_rows($loginr);
	if ($loginrows < 1)
	{
	unset($_SESSION["loginusername"]);
	unset($_SESSION["loginpassword"]);
	$show = "<div class=\"message\">Incorrect Login</div>";
	@header("Location: " . $domain . "/login.php?show=" . $show);
	exit;
	}
	if ($loginrows > 0)
	{
	$userid = mysql_result($loginr,0,"userid");
	$password = mysql_result($loginr,0,"password");
	$referid = mysql_result($loginr,0,"referid");
	$firstname = mysql_result($loginr,0,"firstname");
	$lastname = mysql_result($loginr,0,"lastname");
	$fullname = $firstname . " " . $lastname;
	$email = mysql_result($loginr,0,"email");
	$signupdate = mysql_result($loginr,0,"signupdate");
	$signupip = mysql_result($loginr,0,"signupip");
	$verified = mysql_result($loginr,0,"verified");
	}
include "membernav.php";
extract($_REQUEST);
?>