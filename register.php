<?php
include "db.php";
include "header.php";
$referid = $_REQUEST["referid"];
if ($referid == "")
{
	if ($adminmemberuserid != "")
	{
	$referid = $adminmemberuserid;
	}
	if ($adminmemberuserid == "")
	{
	$referid = "admin";
	}
}
###########
$action = $_POST["action"];
if ($action == "join")
{
$userid = $_POST["userid"];
$password = $_POST["password"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$signupip = $_SERVER["REMOTE_ADDR"];

	if (!$userid)
	{
	$error = "<div>Please return and enter a userid.</div>";
	}
	if(!$password)
	{
	$error .= "<div>Please return and enter a password.</div>";
	}
	if(!$firstname)
	{
	$error .= "<div>Please return and enter your first name.</div>";
	}
	if(!$lastname)
	{
	$error .= "<div>Please return and enter your last name.</div>";
	}
	if(!$email)
	{
	$error .= "<div>Please return and enter your email address.</div>";
	}
	$dupq = "select * from members where userid=\"$userid\" or email=\"$email\"";
	$dupr = mysql_query($dupq);
	$duprows = mysql_num_rows($dupr);
	if ($duprows > 0)
	{
	$error .= "<div>The userid or email address you chose is already registered.</div>";
	}
	if(!$error == "")
	{
	?>
	<table cellpadding="4" cellspacing="4" border="0" align="center" width="50%">
	<tr><td align="center" colspan="2"><b>Signup Error</b></td></tr>
	<tr><td colspan="2"><br><?php echo $error ?></td></tr>
	<tr><td colspan="2" align="center"><br><a href="javascript: history.back()">RETURN</a></td></tr>
	</table>
	<br><br>
	<?php
	include "footer.php";
	exit;
	}
#############################
$freeq = "insert into members (userid,password,firstname,lastname,email,signupdate,signupip,referid) values (\"$userid\",\"$password\",\"$firstname\",\"$lastname\",\"$email\",NOW(),\"$signupip\",\"$referid\")";
$freer = mysql_query($freeq);

					$tomember = $email;
					$headersmember .= "From: $sitename <$adminemail>\n";
					$headersmember .= "Reply-To: <$adminemail>\n";
					$headersmember .= "X-Sender: <$adminemail>\n";
					$headersmember .= "X-Mailer: PHP5\n";
					$headersmember .= "X-Priority: 3\n";
					$headersmember .= "Return-Path: <$adminemail>\n";
					$subjectmember = "Welcome to " . $sitename;
					$messagemember = "Dear ".$firstname." ".$lastname.",\n\nThank you for signing up for ".$sitename.".\nYour account details are below:\n\n"
					   ."Userid: ".$userid."\nPassword: ".$password."\n\n"
					   ."Please verify your email address by clicking this link ".$domain."/verify.php?userid=".$userid."&email=".$email."\n\n"
					   ."Your unique affiliate URL is: ".$domain."/index.php?referid=".$userid ."\n\n"
					   ."Your login URL is: ".$domain."\n\n"
					   ."Thank you!\n\n\n"
					   .$sitename." Admin\n"
					   .$adminemail."\n\n\n\n";
					@mail($tomember, $subjectmember, wordwrap(stripslashes($messagemember)),$headersmember, "-f$adminemail");

					$toadmin = $adminemail;
					$headersadmin .= "From: $sitename <$adminemail>\n";
					$headersadmin .= "Reply-To: <$adminemail>\n";
					$headersadmin .= "X-Sender: <$adminemail>\n";
					$headersadmin .= "X-Mailer: PHP5\n";
					$headersadmin .= "X-Priority: 3\n";
					$headersadmin .= "Return-Path: <$adminemail>\n";
					$subjectadmin = "New Member In " . $sitename;
					$messageadmin = "This is a notification that a new member just joined $sitename:\n\n
					UserID: $userid\n
					Sponsor: $referid\n
					Email: $email\n
					IP: $signupip\n\n
					$sitename\n
					$domain
					";
					@mail($toadmin, $subjectadmin, wordwrap(stripslashes($messageadmin)),$headersadmin, "-f$adminemail");
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="100%">
<tr><td align="center" colspan="2"><div class="heading">Signup Successful!</div></td></tr>

<tr><td align="center" colspan="2">
<table cellpadding="2" cellspacing="2" border="0" align="center" width="100%">
<tr><td>
<div style="text-align: center;">
<?php
$q = "select * from pages where name='Thank You Page - New Member Signup'";
$r = mysql_query($q);
$rowz = mysql_fetch_array($r);
$htmlcode = $rowz["htmlcode"];
echo $htmlcode;
?>
</div>
</td></tr>
</table>
</td></tr>

</table>
<br><br>
<?php
include "footer.php";
exit;
} # if ($action == "join")
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="100%">
<tr><td align="center" colspan="2"><div class="heading">Register</div></td></tr>
<tr><td align="center" colspan="2">
<table cellpadding="2" cellspacing="2" border="0" align="center" width="100%">
<tr><td>
<div style="text-align: center;">
<?php
$q = "select * from pages where name='Registration Page'";
$r = mysql_query($q);
$rowz = mysql_fetch_array($r);
$htmlcode = $rowz["htmlcode"];
echo $htmlcode;
?>
</div>
</td></tr>
</table>
</td></tr>

<tr><td align="center" colspan="2" valign="top">
<table width="550px"><tr><td>
<table  id="" cellpadding="2" cellspacing="1" border="0" align="center" bgcolor="#989898">
<form action="register.php" method="post">
<tr bgcolor="#eeeeee"><td>UserID:</td><td><input type="text" name="userid" size="35" maxlength="255"></td></tr>
<tr bgcolor="#eeeeee"><td>Password:</td><td><input type="text" name="password" size="35" maxlength="255"></td></tr>
<tr bgcolor="#eeeeee"><td>First Name:</td><td><input type="text" name="firstname" size="35" maxlength="255"></td></tr>
<tr bgcolor="#eeeeee"><td>Last Name:</td><td><input type="text" name="lastname" size="35" maxlength="255"></td></tr>
<tr bgcolor="#eeeeee"><td>Email:</td><td><input type="text" name="email" size="35" maxlength="255"></td></tr>
<tr bgcolor="#eeeeee"><td>Your Sponsor:</td><td><?php echo $referid ?></td></tr>
<tr bgcolor="#d3d3d3"><td colspan="2" align="center"><input type="hidden" name="referid" value="<?php echo $referid ?>">
<input type="hidden" name="action" value="join">
<input type="submit" value="JOIN!">
</form></td></tr>
</table><center>
<br>By signing up, you agree to our <a href="terms.php?referid=<?php echo $referid ?>" target=_"blank">Terms & Conditions.</a>
<br>
</td></tr></table>
<br><br>
<?php
include "footer.php";
exit;
?>