<?php
include "control.php";
include "adminheader.php";
$action = $_POST["action"];
$show = "";
if ($action == "saveadminnotes")
{
$q = "update adminnotes set htmlcode='".$htmlcode."'";
$r = mysql_query($q);
$show = "Admin Notes Saved";
} # if ($action == "saveadminnotes")
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="100%">
<tr><td align="center" colspan="2"><div class="heading">Welcome <?php echo $adminname ?> To Your Admin Panel</div></td></tr>
<?php
if ($show != "")
{
?>
<tr><td align="center" colspan="2"><br><?php echo $show ?></td></tr>
<?php
}
$q = "select * from adminnotes where name='Admin Notes'";
$r = mysql_query($q);
$rowz = mysql_fetch_array($r);
$htmlcode = $rowz["htmlcode"];
?>
<form action="controlpanel.php" method="post">
<tr><td align="center" colspan="2"><textarea rows="10" cols="75" name="htmlcode"><?php echo $htmlcode ?></textarea></td></tr>
<tr><td align="center" colspan="2"><br><input type="hidden" name="action" value="saveadminnotes"><input type="submit" value="SAVE" class="sendit">
</form></td></tr>

</table>
<br><br>
<?php
include "adminfooter.php";
exit;
?>