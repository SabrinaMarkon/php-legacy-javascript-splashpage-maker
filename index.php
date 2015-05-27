<?php
include "db.php";
include "header.php";
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="100%">
<tr><td align="center" colspan="2">
<table cellpadding="2" cellspacing="2" border="0" align="center" width="100%">

<tr><td>
<div style="text-align: center;">
<?php
$q = "select * from pages where name='Home Page'";
$r = mysql_query($q);
$rowz = mysql_fetch_array($r);
$htmlcode = $rowz["htmlcode"];
echo $htmlcode;
?>

<!-- DELETE BELOW -->
<script type="text/javascript">
function ajaxFunction(){
    var ajaxRequest;  // The variable that makes Ajax possible!
   
    try{
        // Opera 8.0+, Firefox, Safari
        ajaxRequest = new XMLHttpRequest();
    } catch (e){
        // Internet Explorer Browsers
        try{
            ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try{
                ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e){
                // Something went wrong
                alert("Your browser broke!");
                return false;
            }
        }
    }
    // Create a function that will receive data sent from the server
    ajaxRequest.onreadystatechange = function(){
        if(ajaxRequest.readyState == 4){
            var ajaxDisplay = document.getElementById('ajaxDiv');
            ajaxDisplay.innerHTML = ajaxRequest.responseText;
        }
    }
    var order_domain_name = document.getElementById('order_domain_name').value;
    var order_domain_extension = document.getElementById('order_domain_extension').value;
   
    var queryString = "?order_domain_name=" + order_domain_name + "&order_domain_extension=" + order_domain_extension;
    ajaxRequest.open("GET", "script_domain_checker.php" + queryString, true);
    ajaxRequest.send(null);
}
</script>
<br>
<a href="http://demosplashpagesite.phpsitescripts.com/admin" target="_blank"><img src="http://phpsitescripts.com/images/demo.png" border="0"></a>
<br><br><br>
Please check out our interactive DEMO of the Splashpage Creator and Management Script as an admin <a href="http://demosplashpagesite.phpsitescripts.com/admin" target="_blank">HERE</a> (admin login details are already in the login form for you). <br><br>Examine our DEMO site as a member <a href="http://demosplashpagesite.phpsitescripts.com/login.php" target="_blank">HERE</a> (demo member details are already in the login form)</b><br><br>
<div style="text-align:left;padding-left:100px;">SCRIPT REQUIREMENTS:<br>
<ul>
<li>Unix/Linux (CentOS most CPanel servers run is good)</li>
<li>PHP 5.2 or Greater Version</li>
<li>MySQL Database Support</li>
<li>Ioncube Loader</li>
<li>GD Library</li>
<li>cURL</li>
</ul>
</div>
<br><br>
<table cellpadding="10" cellspacing="2" border="0" align="center" width="600" style="border:2px dashed #f00;background:#fff;">
<tr><td colspan="2" align="center"><br><font size="6" color="ff0000">Buy This Splashpage Creator and Management Script Now For Only $79.00!</font></td</tr>
<form action="http://phpsitescripts.com/sales_order.php" method="post">
<tr><td align="right">Licence:</td><td>Single Site License for Splashpage Creator and Management Script</td></tr>
<tr><td align="right">URL of Premade Site you want to adopt:<br>(or leave blank)</td><td valign="top"><input type="text" name="order_premadesiteurl" size="50" maxlength="500"></td></tr>
<tr><td align="right">Register Domain for your site's License URL:<br>(or leave blank)</td><td style="width:350px;" valign="top"><input type="text" name="order_domain_name" id="order_domain_name" size="25" maxlength="500" style="font-size:12px;">
<select name="order_domain_extension" id="order_domain_extension" onchange="javascript:document.getElementById('ajaxDiv').innerHTML=''" style="font-size:12px;">
<option value="info">.info - FREE FOREVER!</option>
<option value="com">.com - 8.00/year</option>
<option value="us">.us - 8.00/year</option>
<option value="net">.net - 8.00/year</option>
<option value="biz">.biz - 8.00/year</option>
<option value="org">.org - 8.00/year</option>
<option value="me">.me - 8.00/year</option>
<option value="ws">.ws - 8.00/year</option>
<option value="co">.co - 8.00/year</option>
<option value="ca">.ca - 8.00/year</option>
</select>
<input type="button" value="Check Availability (may take a moment)" onclick="ajaxFunction()" style="font-size:12px;"><br><span id="ajaxDiv"></span>
<span id="domain_price"></span>
</td></tr>
<tr><td align="right">License Key URL:<br>(exact url where you will install the script. If registering a new domain, this should match the url in that field)</td><td valign="top"><input type="text" name="order_licenseurl" size="50" maxlength="500"></td></tr>

<tr><td align="right">Order Hosting for your Script:<br>(kindly allow time for setup after purchase)</td><td valign="top">
<select name="order_hosting" style="font-size:12px;width:322px;">
<option value="No Hosting Needed (zipped script or premade site only)">No Hosting Needed (zipped script or premade site only)</option>
<option value="Shared Hosting for ONE domain - adds 9.99/month to order">Shared Hosting for ONE domain - adds 9.99/month to order</option>
<option value="Dedicated VPS Hosting 4 GB RAM - adds 99.99/month to order">Dedicated VPS Hosting 4 GB RAM - adds 99.99/month to order</option>
</select>
</td></tr>

<tr><td align="right">UserID:</td><td><input type="text" name="userid" size="50" maxlength="255"></td></tr>
<tr><td align="right">Password:</td><td><input type="text" name="password" size="50" maxlength="255"></td></tr>
<tr><td align="right">First Name:</td><td><input type="text" name="firstname" size="50" maxlength="255"></td></tr>
<tr><td align="right">Last Name:</td><td><input type="text" name="lastname" size="50" maxlength="255"></td></tr>
<tr><td align="right">Email:</td><td><input type="text" name="email" size="50" maxlength="255"></td></tr>
<?php
$cq = "select * from countries order by country_id";
$cr = mysql_query($cq);
$crows = mysql_num_rows($cr);
if ($crows > 0)
{
?>
<tr><td align="right">Country:</td><td><select name="country" style="width:322px;" class="pickone">
<?php
	while ($crowz = mysql_fetch_array($cr))
	{
	$country_name = $crowz["country_name"];
?>
<option value="<?php echo $country_name ?>" <?php if ($country_name == "United States") { echo "selected"; } ?>><?php echo $country_name ?></option>
<?php
	}
?>
</select>
</td></tr>
<?php
}
?>
<tr><td align="right">Your Sponsor:</td><td><?php echo $referid ?></td></tr>
<tr><td colspan="2" align="center">
<input type="hidden" name="order_script" value="splashpage_maker_site_v2.6">
<input type="hidden" name="referid" value="<?php echo $referid ?>">
<input type="image" src="http://phpsitescripts.com/images/btn.png" border="0" name="submit" alt="Order!">
</form><br>&nbsp;
</td></tr>
</table>

<br>
<font color="#ff0000" style="background:#ff0;">IMPORTANT:</font> After payment please allow us up to 24 hours to process your order. Please whitelist sabrina@phpsitescripts.com.
<!-- DELETE ABOVE -->



</div>
</td></tr>
</table>
</td></tr>

</table>
<br><br>
<?php
include "footer.php";
exit;
?>