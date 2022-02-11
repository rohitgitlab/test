<?php
ob_start();
session_start();
$userid=$_POST["email"];
$password=$_POST["password"];
echo $userid;
require 'vendor/autoload.php';
$client = new MongoDB\Client;
$crowdsourcing = $client->crowdsourcing;
$usercollection=$crowdsourcing->usercollection;
$finduser=$usercollection->findOne(
['_id'=>$userid, 'password'=>$password],
['projection' => ['name'=>1,'division'=>1,'role'=>1,'technology'=>1]]
);

//logging user activity
$log  = "User: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
        "Attempt: ".$_POST["email"].PHP_EOL.
        "User: "."-------------------------".PHP_EOL;
//Save string to log, use FILE_APPEND to append.
file_put_contents('./log_'.date("j.n.Y").'.log', $log, FILE_APPEND);

//

if(!$finduser)
{
	header("Location:index.php");
}
else
{
	$log  = "User: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a")." "."Attempt: ".$_POST["email"]." Success".PHP_EOL;
//Save string to log, use FILE_APPEND to append.
	file_put_contents('./log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
	// unset($_SESSION['loggedout']);
	$_SESSION['status']="Active";
	$_SESSION['email']=$userid;
	$_SESSION['name']=$finduser->name;
	$_SESSION['division']=$finduser->division;
	$_SESSION['role']=$finduser->role;
	$_SESSION['technology']=$finduser->technology;
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	if($_SESSION['role'] == "admin")
		header("Location:admin_section/adminhome.php");	
	else
		header("Location:home.php");	
}
//$data=iterator_to_array($finduser);
//var_dump($data)
//echo $finduser->name.' '.$finduser->division;
//$finduserlist=$usercollection->find();
/*foreach($finduserlist as $user)
{
	var_dump($user);
} */
/* $finduser = $usercollection->findOne(
['_id' => '1']
); 
var_dump($finduser);*/
/*
$usercollection=$client->userdb->usercollection;
$result=$usercollection->find(array());
$data=iterator_to_array($result);
//var_dump($data);
foreach($data[0] as $key=>$value)
	echo $key.'   ';
printf("\n");
 foreach($data as $entry)
	foreach($entry as $key=>$value)
		echo $value. '    ';
	echo "\n";
*/
?>