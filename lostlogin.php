<?php
include "db.php";
include "header.php";
$action = $_POST["action"];
$show = "";
if ($action == "retrieve")
{
$searchfor = $_POST["searchfor"];
if ($searchfor == "")
	{
	$show = "The form field was left blank";
	}
if ($searchfor != "")
	{
	$lostquery = "select * from members where userid=\"$searchfor\" or email=\"$searchfor\"";
	$lostresult = mysql_query($lostquery);
	$lostrow = mysql_num_rows($lostresult);
	if ($lostrow < 1)
		{
		$show = "Sorry, " . $searchfor . " was not found in the database for any userid or email address. Please try again or <a href=\"mailto:" . $adminemail . "\">Contact Us</a> for assistance.";
		}
	if ($lostrow > 0)
		{
		$userid = mysql_result($lostresult,0,"userid");
		$password = mysql_result($lostresult,0,"password");
		$to = mysql_result($lostresult,0,"email");
		$headers .= "From: $sitename<$adminemail>\n";
		$headers .= "Reply-To: <$adminemail>\n";
		$headers .= "X-Sender: <$adminemail>\n";
		$headers .= "X-Mailer: PHP5\n";
		$headers .= "X-Priority: 3\n";
		$headers .= "Return-Path: <$adminemail>\n";	
		$message .= "Here's the information you requested\n\nYour UserId: ".$userid."\nYour Password: ".$password."\n\n";
		$message .= "Log into your members area\n".$domain."/login.php\n\n\n$sitename Admin\n$adminemail\n";
		
		@mail($to, "Your ".$sitename." Login Details", $message,$headers, "-f$adminemail");
		$show = "Your login details were sent to the email address we have on file for you.";
		} # if ($lostrow > 0)
	}
} # if ($action == "retrieve")
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="100%">
<tr><td align="center" colspan="2"><div class="heading">Recover Login Details</div></td></tr>
<?php
if ($show != "")
{
?>
<tr><td align="center" colspan="2"><br><?php echo $show ?></td></tr>
<?php
}
?>
<form action="lostlogin.php" method="post" target="_top">
<tr><td align="center" colspan="2"><br>
<table cellpadding="2" cellspacing="2" border="0" align="center" width="40%">
<tr><td align="right">Your UserID or Email: </td><td><input type="text" name="searchfor" class="typein" maxlength="255" size="25"></td></tr>
</table>
</td></tr>
<tr><td colspan="2" align="center"><br><input type="hidden" name="action" value="retrieve"><input type="hidden" name="referid" value="<?php echo $referid ?>"><input type="submit" value="EMAIL LOGIN" class="sendit"></td></tr></form><tr><td colspan="2" align="center"><a href="login.php">CANCEL</a></td></tr>
</table>
<br><br>
<?php
include "footer.php";
exit;
?>