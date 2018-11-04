<?php

$array = array("firstname"=>"",
              "name"=>"",
              "email"=> "",
              "phone"=> "",
              "message"=> "",
              "firstnameError"=> "",
               "nameError"=>"",
               "emailError"=> "",
               "phoneError"=> "",
               "messageError"=>"",
               "issuccess" => false
              );


$emailTo = "tanougha2013@gmail.com";

if($_POST){
    $array["firstname"] = verifyInput($_POST['firstname']);
    $array["name"] = verifyInput($_POST['name']);
    $array["email"] = verifyInput($_POST['email']);
    $array["phone"] = verifyInput($_POST['phone']);
    $array["message"] = verifyInput($_POST['message']);
    
    
    $array["issuccess"] = true;
    $emailText ="";
    
    if(empty($array["firstname"])){
      $array["firstnameError"]  ='Je veux connaitre ton prénom';
        
       $array["issuccess"]  = false;
    }
    else
    {
        $emailText .="Firstname : {$array["firstname"]}\n";
    }
        
        
    if(empty($array["name"])){
        $array["nameError"]='Je veux connaitre ton nom';
        
        $array["issuccess"] = false;
    }
    else
    {
        $emailText .="Name : {$array["name"]}\n";
    }
    
    if(empty($array["message"])){
        $array["messageError"]='Je veux connaitre ton message';
        
        $array["issuccess"] = false;
    }
    else
    {
        $emailText .="Message : {$array["message"]}\n";
    }
    if(!isEmail($array["email"])){
       $array["emailError"] ="C'est pas un email correct";
    
       $array["issuccess"] = false;
    }
    else
    {
        $emailText .="Email : {$array["email"]}\n";
    }
    if(!isPhone($array["phone"])){
       $array["phoneError"] ="Que des chiffres et des espaces stp!!";
        
        $array["issuccess"] = false;
    }
    else
    {
        $emailText .="Phone : {$array["phone"]}\n";
    }
    if($array["issuccess"]){
        $headers = "From {$array["firstname"]} {$array["name"]} <{$array["email"]}>\r\nReplay-To: {$array["email"]}";
        
        mail($emailTo,"Un email de votre site",$emailText,$headers);
        
        $firstname = $name = $email = $phone = $message = "";
    }
    echo json_encode($array);
}
function verifyInput($var){
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);
    return $var;
}
function isEmail($var){
   
    return filter_var($var,FILTER_VALIDATE_EMAIL);
}
function isPhone($var){
    return preg_match("/^[0-9 ]*$/",$var);
}

?>