<?php
include "control.php";
$userid = $_GET["userid"];
$code = $_GET["code"];
$action = $_POST["action"];
$show = "";
include "header.php";
if ((empty($userid)) or (empty($code)))
{
$show = "Invalid link";
}
$q = "select * from members where userid=\"$userid\"";
$r = mysql_query($q);
$rows = mysql_num_rows($r);
if ($rows < 1)
{
$show = "Invalid link";
}
if ($show != "")
{
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="100%">
<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
<tr><td align="center" colspan="2">
<?php
echo $show;
?>
</td></tr>
</table>
<br><br>
<?php
include "footer.php";
exit;
} # if ($show != "")
$password = mysql_result($r,0,"password");
if ($code == md5($password))
{
	if ($action == "delete")
	{
	mysql_query("delete from splashpages where userid='$delete_userid'");
	mysql_query("delete from members where userid='$delete_userid'");
	?>
	<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
	<tr><td align="center" colspan="2"><div class="heading">Account Deleted</div></td></tr>
	</table>
	<br><br>
	<?php
	include "footer.php";
	exit;
	} # if ($action == "delete")
	else
	{
	?>
	<form action="delete.php" method="post">
	<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
	<tr><td align="center" colspan="2"><div class="heading">Confirm</div></td></tr>
	<tr><td colspan="2"><br>Are you sure you want to cancel your <?php echo $sitename ?> account?</td></tr>
	<tr><td colspan="2" align="center"><br><input type="hidden" name="code" value="<?php echo md5($password); ?>"><input type="hidden" name="action" value="delete"><input type="submit" value="CONFIRM ACCOUNT DELETION" class="sendit"></form></td></tr>
	</table>
	<br><br>
	<?php
	include "footer.php";
	exit;
	} # else
} # if ($code == md5($password))
else
{
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="100%">
<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
<tr><td align="center" colspan="2">
Invalid link
</td></tr>
</table>
<br><br>
<?php
include "footer.php";
exit;
}
?>