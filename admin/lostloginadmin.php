<?php
include "../db.php";
include "adminheader.php";
$headers .= "From: $sitename<$adminemail>\n";
$headers .= "Reply-To: <$adminemail>\n";
$headers .= "X-Sender: <$adminemail>\n";
$headers .= "X-Mailer: PHP5\n";
$headers .= "X-Priority: 3\n";
$headers .= "Return-Path: <$adminemail>\n";	
$message .= $sitename . " Login Details:\n\nAdmin UserId: ".$adminuserid."\nAdmin Password: ".$adminpassword."\n\n";
$message .= "Login URL: ".$domain."/admin\n";
@mail($adminemail, "Your ".$sitename." Admin Details", $message,$headers, "-f$adminemail");
?>
<br><br>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="100%">
<tr><td align="center" colspan="2"><div class="heading">Admin Login Details Sent</div></td></tr>
<tr><td align="center" colspan="2"><br>Your login details were sent to your support email address.</td></tr>
</table>
<br><br>
<?php
include "adminfooter.php";
exit;
?>