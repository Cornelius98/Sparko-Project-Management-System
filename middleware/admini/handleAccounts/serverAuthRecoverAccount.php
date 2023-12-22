<?php 
header("Content-Type: application/json");
require_once ('../../../HEADER_FILES.php');
$Response =[
    "unsetEmailAdress"=>1,
    "unsetPassword"=>1,
    "emptyPhoneNumber"=>1,
    "emptyPassword"=>1,
    "uunvalidEmail"=>1,
    "unexistEmail"=>1,
    "undispatchedEmail"=>1
];
!isset($_POST['data']['email'])? $Response['email'] =2:$Response['unsetEmailAddress'] =0;
empty($_POST['data']['email'])? $Response['emptyEmailAddress'] =2:$Response['emptyEmailAddress'] =0;

    $email = $_POST['data']['email'];
    $password = $_POST['data']['secretCode'];
    ($RecognizeNumberEmailSanitize->email_address($email))?$Response['unvalidEmail'] =0:$Response['unvalidEmail']=2;
    ($UserAccountPull->does_email_exist($email))?$Response['unexistEmail']=0:$Response['unexistEmail']=2;
        if(sendAdministratorForgotEmail($email,$name)){
        $Response['undispatchedEmail']=2;
    }else{ $Response['undispatchedEmail']=2;}
    echo json_encode($Response);
  ?>