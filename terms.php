<?php
## website terms and conditions of becoming a member.
include "db.php";
include "header.php";
if (isset($_GET["referid"]))
{
$referid = $_GET["referid"];
}
?>
<table cellpadding="0" cellspacing="0" border="0" align="center" width="90%">
<tr><td align="center" colspan="2"><div class="heading">Terms and Conditions</div></td></tr>
<tr><td colspan="2"><br>
<div style="text-align: center;">
<?php
$query1 = "select * from pages where name='Terms'";
$result1 = mysql_query($query1);
$line1 = mysql_fetch_array($result1);
$htmlcode = $line1["htmlcode"];
echo $htmlcode;
?>
</div> 
</td></tr>
</table>
<?php
include "footer.php";
?>
