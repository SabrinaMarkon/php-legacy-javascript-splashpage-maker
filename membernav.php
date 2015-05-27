<script src="<?php echo $domain ?>/jscripts/menu/jquery-1.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo $domain ?>/jscripts/menu/menu.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $domain ?>/jscripts/menu/style.css" />
<table  border="0" width="186" cellspacing="0" cellpadding="0" bgcolor="transparent" style="position:absolute; top: 40px; left: 40px;">
<tr>
<td  width="100%" bgcolor="transparent">
<ul id="menu">
<?php
$membernavq = "select * from membernavigation where membernavenabled=\"yes\" order by membernavsequence";
$membernavr = mysql_query($membernavq);
$membernavrows = mysql_num_rows($membernavr);
if ($membernavrows > 0)
{
while ($membernavrowz = mysql_fetch_array($membernavr))
	{
	$membernavtitle = $membernavrowz["membernavtitle"];
	$membernavurl = $membernavrowz["membernavurl"];
	$membernavwindow = $membernavrowz["membernavwindow"];
?>
<li><a href="<?php echo $membernavurl ?>" target="<?php echo $membernavwindow ?>"><?php echo $membernavtitle ?></a></li>
<?php
	} # while ($membernavrowz = mysql_fetch_array($membernavr))
} # if ($membernavrows > 0)
?>
</ul>
</td>
</tr>
</table>
