<?php
include "control.php";
include "adminheader.php";
$action = $_POST["action"];
$show = "";
if ($action == "savesettings")
{
$adminuserid = $_POST["adminuseridp"];
$adminpassword = $_POST["adminpasswordp"];
$adminmemberuserid = $_POST["adminmemberuseridp"];
$adminname = $_POST["adminnamep"];
$domain = $_POST["domainp"];
$sitename = $_POST["sitenamep"];
$adminemail = $_POST["adminemailp"];

$update = mysql_query("update adminsettings set setting='$adminuserid' where name='adminuserid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$adminpassword' where name='adminpassword'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$adminmemberuserid' where name='adminmemberuserid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$adminname' where name='adminname'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$domain' where name='domain'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$sitename' where name='sitename'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$adminemail' where name='adminemail'") or die(mysql_error());

$_SESSION["loginusernameadmin"] = $adminuserid;
$_SESSION["loginpasswordadmin"] = $adminpassword;

$adminuserid = $adminuseridp;
$adminpassword = $adminpasswordp;

$show = "Your settings were updated!";
} # if ($action == "savesettings")
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Website&nbsp;Settings</div></td></tr>
<?php
if ($show != "")
{
?>
<tr><td align="center" colspan="2"><br><?php echo $show ?></td></tr>
<?php
}
?>
<tr><td align="center" colspan="2"><br>
<form action="sitecontrol.php" method="post">
<table width="600" border="0" cellpadding="2" cellspacing="2" bgcolor="#989898" align="center">
<tr bgcolor="#d3d3d3"><td colspan="2" align="center"><div class="heading">MAIN SETTINGS</div></td></tr>
<tr bgcolor="#eeeeee"><td>Admin Login ID:</td><td><input type="text" class="typein" name="adminuseridp" value="<?php echo $adminuserid ?>" class="typein" size="25" maxlength="255"></td></tr>
<tr bgcolor="#eeeeee"><td>Admin Login Password:</td><td><input type="text" class="typein" name="adminpasswordp" value="<?php echo $adminpassword ?>" class="typein" size="25" maxlength="255"></td></tr>
<tr bgcolor="#eeeeee"><td>Admin Site Member UserID:</td><td><input type="text" class="typein" name="adminmemberuseridp" value="<?php echo $adminmemberuserid ?>" class="typein" size="25" maxlength="255"></td></tr>
<tr bgcolor="#eeeeee"><td>Admin Name:</td><td><input type="text" class="typein" name="adminnamep" value="<?php echo $adminname ?>" class="typein" size="25" maxlength="255"></td></tr>
<tr bgcolor="#eeeeee"><td>Website Main Domain URL (with http:// and NO trailing slash):</td><td><input type="text" class="typein" name="domainp" value="<?php echo $domain ?>" class="typein" size="25" maxlength="255"></td></tr>
<tr bgcolor="#eeeeee"><td>Website Name:</td><td><input type="text" class="typein" name="sitenamep" value="<?php echo $sitename ?>" class="typein" size="25" maxlength="255"></td></tr>
<tr bgcolor="#eeeeee"><td>Admin Support Email:</td><td><input type="text" class="typein" name="adminemailp" value="<?php echo $adminemail ?>" class="typein" size="25" maxlength="255"></td></tr>

<tr bgcolor="#d3d3d3"><td colspan="2" align="center">
<input type="hidden" name="action" value="savesettings">
<input type="submit" name="submit" value="SAVE" class="sendit"></form>
</td></tr>
</table>

</td></tr>
</table>
<br><br>
<?php
include "adminfooter.php";
exit;
?>