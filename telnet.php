<?php
$socket = fsockopen("cbhinhp.gov.in", "443", $errno, $errstr); 

if($socket) 
{ 
    echo "Connected on 443 <br /><br />"; 
} 
else 
{ 
    echo "Connection failed for 443!<br /><br />"; 
} 

$socket = fsockopen("cbhinhp.gov.in", "80", $errno, $errstr); 
if($socket) 
{ 
    echo "Connected on 80 <br /><br />"; 
} 
else 
{ 
    echo "Connection failed for 80!<br /><br />"; 
}

?> 