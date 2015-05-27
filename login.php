<?php
include "db.php";
include "header.php";
$show = $_GET["show"];
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="100%">
<tr><td align="center" colspan="2"><div class="heading">Member Login</div></td></tr>
<?php
if ($show != "")
{
?>
<tr><td align="center" colspan="2"><br><?php echo $show ?></td></tr>
<?php
}
?>
<tr><td align="center" colspan="2">
<table cellpadding="2" cellspacing="2" border="0" align="center" width="100%">
<tr><td>
<div style="text-align: center;">
<?php
$q = "select * from pages where name='Login Page'";
$r = mysql_query($q);
$rowz = mysql_fetch_array($r);
$htmlcode = $rowz["htmlcode"];
echo $htmlcode;
?>
</div>
</td></tr>
</table>
</td></tr>

<form action="members.php" method="post" target="_top">
<tr><td align="center" colspan="2">
<table cellpadding="2" cellspacing="2" border="0" align="center" width="50%">
<tr><td align="right">UserID:</td><td><input type="text" name="loginusername" class="typein" maxlength="255" size="25" value="demomember"></td></tr><tr><td align="right">Password:</td><td><input type="password" name="loginpassword" class="typein" maxlength="255" size="25" value="demopass"></td></tr>
</table>
</td></tr>
<tr><td colspan="2" align="center"><br><input type="hidden" name="newlogin" value="1"><input type="hidden" name="referid" value="<?php echo $referid ?>"><input type="submit" value="LOGIN" class="sendit"></td></tr></form><tr><td colspan="2" align="center"><a href="lostlogin.php?referid=<?php echo $referid ?>">LOST LOGIN</a></td></tr>
</table>
<br><br>
<?php
include "footer.php";
exit;
?>