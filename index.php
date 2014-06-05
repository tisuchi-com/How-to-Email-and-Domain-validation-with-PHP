<?php


include 'emailvaldation.php';




// creating new object
$obj = new EmailValdation;


//declaring email address
$obj->email = 'suchi@tisuchi.com'; 

//declaring domain name
$myDomain = 'tisuchi.com';




//checking values
if($obj->checkDomain() == 0) { 
    
    echo 'Invalid Domain <br />'; 

} else {
    
    echo 'Valid Domain <br />'; 
    
    //printing IP Address
    echo 'IP address of '.$myDomain.' domain is '.$obj->getIP($myDomain); 

} 
