<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-EN">
<head>
	<script src="<?php echo $domain ?>/jscripts/menu/jquery-1.2.1.min.js" type="text/javascript"></script>
	<script src="<?php echo $domain ?>/jscripts/menu/menu.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo $domain ?>/jscripts/menu/style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<!--[if lt IE 8]>
   <style type="text/css">
   li a {display:inline-block;}
   li a {display:block;}
   </style>
   <![endif]-->
</head>
<body>

<table  border="0" width="186" cellspacing="0" cellpadding="0" bgcolor="transparent" style="position:absolute; top: 40px; left: 40px;">
<tr>
<td  width="100%" bgcolor="transparent">
<ul id="menu">
<?php
$adminnavq = "select * from adminnavigation where adminnavenabled=\"yes\" order by adminnavsequence";
$adminnavr = mysql_query($adminnavq);
$adminnavrows = mysql_num_rows($adminnavr);
if ($adminnavrows > 0)
{
while ($adminnavrowz = mysql_fetch_array($adminnavr))
	{
	$adminnavtitle = $adminnavrowz["adminnavtitle"];
	$adminnavurl = $adminnavrowz["adminnavurl"];
	$adminnavwindow = $adminnavrowz["adminnavwindow"];
?>
<li><a href="<?php echo $adminnavurl ?>" target="<?php echo $adminnavwindow ?>"><?php echo $adminnavtitle ?></a></li>
<?php
	} # while ($adminnavrowz = mysql_fetch_array($adminnavr))
} # if ($adminnavrows > 0)
?>
</ul>
</td>
</tr>
</table>
<!--END OF EDIT-->

</body>
</html>