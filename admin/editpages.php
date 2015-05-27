<?php
include "control.php";
include "adminheader.php";
$action = $_POST["action"];
$show = "";
if ($action == "savesetting")
{
$saveeditpageshtmleditor = $_POST["saveeditpageshtmleditor"];
$q = "update adminsettings set setting=\"$saveeditpageshtmleditor\" where name=\"editpageshtmleditor\"";
$r = mysql_query($q);
$show = "Setting was saved!";
$editpageshtmleditor = $saveeditpageshtmleditor;
}
if ($action == "edit")
{
$pageid = $_POST["pageid"];
$pagename = $_POST["pagename"];
$htmlcode = $_POST["htmlcode"];
$htmlcode = stripslashes($htmlcode);
$htmlcode = str_replace('\\', '', $htmlcode); 
$htmlcode = mysql_real_escape_string($htmlcode);

$q = "update pages set htmlcode='$htmlcode' where id=".$pageid;
$r = mysql_query($q) or die(mysql_error());
$show = "The \"" . $pagename . "\" page was edited.";
} # if ($action == "edit")
if ($editpageshtmleditor == "yes")
{
?>
<script type="text/javascript">
function changeHiddenInput(objDropDown)
{
	var pagedata=objDropDown.value.split("||");
	var pageid=pagedata[0];
	if (pageid)
	{	
		var pagename=pagedata[1];
		var pagehtmlcode=pagedata[2];
		var objpageid = document.getElementById("pageid");
		var objpagename = document.getElementById("pagename");
		objpageid.value = pageid;
		objpagename.value = pagename;
		tinyMCE.execCommand('mceSetContent',false,pagehtmlcode);
	}
	else
	{
		var objpageid = document.getElementById("pageid");
		var objpagename = document.getElementById("pagename");
		objpageid.value = "";
		objpagename.value = "";
		tinyMCE.execCommand('mceSetContent',false,'');
	}
}
</script> 
<!-- tinyMCE -->
<script language="javascript" type="text/javascript" src="../jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
theme : "advanced",
mode : "textareas",
//save_callback : "customSave",
content_css : "../jscripts/tiny_mce/advanced.css",
extended_valid_elements : "a[href|target|name],font[face|size|color|style],span[class|align|style]",
theme_advanced_toolbar_location : "top",
plugins : "table",
theme_advanced_buttons3_add_before : "tablecontrols,separator",
//invalid_elements : "a",
relative_urls : false,
theme_advanced_styles : "Header 1=header1;Header 2=header2;Header 3=header3;Table Row=tableRow1", // Theme specific setting CSS classes
debug : false,
verify_html : false
});
</script>
<!-- /tinyMCE --> 
<?php
} # if ($editpageshtmleditor == "yes")
if ($editpageshtmleditor != "yes")
{
?>
<script type="text/javascript">
function changeHiddenInput(objDropDown)
{
	var pagedata=objDropDown.value.split("||");
	var pageid=pagedata[0];
	if (pageid)
	{	
		var pagename=pagedata[1];
		var pagehtmlcode=pagedata[2];
		var objpageid = document.getElementById("pageid");
		var objpagename = document.getElementById("pagename");
		var objpagehtmlcode = document.getElementById("htmlcode");
		objpageid.value = pageid;
		objpagename.value = pagename;
		objpagehtmlcode.value = pagehtmlcode;
	}
	else
	{
		var objpageid = document.getElementById("pageid");
		var objpagename = document.getElementById("pagename");
		var objpagehtmlcode = document.getElementById("htmlcode");
		objpageid.value = "";
		objpagename.value = "";
		objpagehtmlcode.value = "";
	}
}
</script> 
<?php
} # if ($editpageshtmleditor != "yes")
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Edit&nbsp;Page&nbsp;HTML</div></td></tr>
<?php
if ($show != "")
{
?>
<tr><td align="center" colspan="2"><br><?php echo $show ?></td></tr>
<?php
}
?>
<tr><td align="center" colspan="2"><br><br>
<form action="editpages.php" method="post">
Do you want to use the HTML Editor?:&nbsp;<select name="saveeditpageshtmleditor">
<option value="yes" <?php if ($editpageshtmleditor == "yes") { echo "selected"; } ?>>YES</option>
<option value="no" <?php if ($editpageshtmleditor != "yes") { echo "selected"; } ?>>NO</option>
</select>
<input type="hidden" name="action" value="savesetting">
&nbsp;&nbsp;<input type="submit" value="SAVE SETTING">
</form>
</td></tr>
<?php
$query = "select * from pages order by name";
$result = mysql_query($query);
$rows = mysql_num_rows($result);
if ($rows > 0)
{
?>
<tr><td align="center" colspan="2"><br><br>
<form action="editpages.php" method="post">
<table width="600" border="0" cellpadding="2" cellspacing="2" class="sabrinatable" align="center">
<tr class="sabrinatrdark"><td align="center">
<select name="pagenamechoice" id="pagenamechoice" onchange="changeHiddenInput(this)">
<option value=""> - Select Page To Edit - </option>
<?php
while ($rowz = mysql_fetch_array($result))
	{
	$pageid = $rowz["id"];
	$pagename = $rowz["name"];
	$pagehtmlcode = $rowz["htmlcode"];
	$pagehtmlcode = stripslashes($pagehtmlcode);
	$pagehtmlcode = str_replace('\\', '', $pagehtmlcode);
	$pagehtmlcode = htmlentities($pagehtmlcode, ENT_COMPAT, "ISO-8859-1");
?>
<option value="<?php echo $pageid ?>||<?php echo $pagename ?>||<?php echo $pagehtmlcode ?>"><?php echo $pagename ?></option>
<?php
	}
?>
</select></form></td></tr>
<tr class="sabrinatrlight">
<td align="center"><textarea name="htmlcode" id="htmlcode" rows="20" cols="70"></textarea></td></tr>
<tr class="sabrinatrdark"><td align="center">
<input type="hidden" name="pageid" id="pageid" value="">
<input type="hidden" name="pagename" id="pagename" value="">
<input type="hidden" name="action" value="edit">
<input type="submit" value="SAVE" class="sendit"></form>
</td></tr>

</table>
</td></tr>
<?php
}
?>
</table>
<br><br>
<?php
include "adminfooter.php";
exit;
?>