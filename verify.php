<?php
include "db.php";
$userid = $_GET["userid"];
$email = $_GET["email"];
$show = "";
if ((empty($userid)) or (empty($email)))
{
$show = "Invalid link";
}
$q = "select * from members where userid=\"$userid\" and email=\"$email\"";
$r = mysql_query($q);
$rows = mysql_num_rows($r);
if ($rows < 1)
{
$show = "Invalid link";
}
if ($show != "")
{
include "header.php";
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
}
$password = mysql_result($r,0,"password");
$q2 = "update members set verified=\"yes\",verifieddate=NOW() where userid=\"$userid\"";
$r2 = mysql_query($q2);
@header("Location: " . $domain . "/members.php?loginusername=" . $userid . "&loginpassword=" . $password . "&newlogin=1");
exit;
?>