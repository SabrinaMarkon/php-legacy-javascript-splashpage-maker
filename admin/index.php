<?php
session_start();
$action = $_GET["action"];
if ($action == "logout")
{
unset($_SESSION["loginusernameadmin"]);
unset($_SESSION["loginpasswordadmin"]);
session_destroy();
}
include "adminheader.php";
$show = $_GET["show"];
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="100%">
<tr><td align="center" colspan="2"><div class="heading">Admin Login</div></td></tr>
<?php
if ($show != "")
{
?>
<tr><td align="center" colspan="2"><br><?php echo $show ?></td></tr>
<?php
}
?>
<form action="controlpanel.php" method="post" target="_top">
<tr><td align="center" colspan="2">
<table cellpadding="2" cellspacing="2" border="0" align="center" width="40%">
<tr><td align="right">Admin UserID:</td><td><input type="text" name="loginusernameadmin" class="typein" maxlength="255" size="25" value="Admin"></td></tr><tr><td align="right">Admin Password:</td><td><input type="password" name="loginpasswordadmin" class="typein" maxlength="255" size="25" value="admin"></td></tr>
</table>
</td></tr>
<tr><td colspan="2" align="center"><br><input type="submit" value="LOGIN" class="sendit"></td></tr></form><tr><td colspan="2" align="center"><a href="lostloginadmin.php">LOST LOGIN</a></td></tr>
</table>
<br><br>
<?php
include "adminfooter.php";
exit;
?>