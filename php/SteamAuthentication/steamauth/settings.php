<?php

require 'steamauth/steamauth.php';

?>
<?php
if(!isset($_SESSION['steamid'])) {

    $vars = array('foo' => 'bar', 'some' => 'thing');
    echo steamlogin($vars); //login button

}  else {

    include ('steamauth/userInfo.php'); //To access the $steamprofile array
    //Protected content

    echo $_GET['foo']; //Outputs bar
    echo $_GET['some']; //Outputs thing

    logoutbutton(); //Logout Button
}     
?>
<?php
$fileLoc = $_SERVER['DOCUMENT_ROOT'] . '/../passwords.txt';
if (file_exists($fileLoc)) {
	$fh = fopen($fileLoc, 'r');
	$jsonStr = fgets($fh);
	$arr = json_decode($jsonStr, true);
	$apiKey = $arr['steamAPIKey'];
	fclose($fh);
} else {
	die('no file found');
}

$steamauth['apikey'] = $apiKey; // Your Steam WebAPI-Key found at http://steamcommunity.com/dev/apikey
$steamauth['domainname'] = "http://amenoammo.github.io/raffle/"; // The main URL of your website displayed in the login page
$steamauth['buttonstyle'] = "large_no"; // Style of the login button [small|large_no|large]
$steamauth['logoutpage'] = "../example.php"; // Page to redirect to after a successfull logout (from the directory the SteamAuth-folder is located in) - NO slash at the beginning!
$steamauth['loginpage'] = "../example.php"; // Page to redirect to after a successfull login (from the directory the SteamAuth-folder is located in) - NO slash at the beginning!

// System stuff
if (empty($steamauth['apikey'])) {die("<div style='display: block; width: 100%; background-color: red; text-align: center;'>SteamAuth:<br>Please supply an API-Key!</div>");}
if (empty($steamauth['domainname'])) {$steamauth['domainname'] = "localhost";}
if ($steamauth['buttonstyle'] != "small" and $steamauth['buttonstyle'] != "large") {$steamauth['buttonstyle'] = "large_no";}
?>
