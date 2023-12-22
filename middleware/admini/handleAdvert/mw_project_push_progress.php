<?php 
session_start();
require_once ('../../../HEADER_FILES.php');
$response = [
    "set" =>[ 
        "isNameSet" =>0,
        "isPicturesSet"=>0
    ],
    "void" =>[ 
        "isNameEmpty" =>0,
        "isPicturesEmpty"=>0
    ],
    "sanitized" =>[
        "isNameSanitized" =>0
    ],
    "pushedToServer" =>[
        "isDetailsPushed"=>0,
        "isPicturesPushed"=>0,
    ],
    "success" =>[
        "status" =>0
    ]
];

isset($_POST["name"])?$response["set"]["isNameSet"]=200:$response["set"]["isNameSet"]=404;
isset($_FILES["pictures"])?$response["set"]["isPicturesSet"]=200:$response["set"]["isPicturesSet"]=404;

!empty($_POST["name"])?$response["void"]["isNameEmpty"]=200:$response["void"]["isNameEmpty"]=404;
!empty($_FILES["pictures"])?$response["void"]["isPicturesEmpty"]=200:$response["void"]["isPicturesEmpty"]=404;

$o = [];
$o["rand_id"] = uniqid().substr(random_int(1,PHP_INT_MAX),0,3);
$o["store_url"] = "./store/";
$o['d'] = date("d");
$o['m'] = date("m");
$o['y'] = date("Y");
$o['pj_id'] = $_POST["hashPjr"];
$o["tname"] = 0;
$o["desc"] = 0;
$o["summary"] = 0;

$o["uni_id"] = null;
if(isset($_SESSION["aSessn"]["aSeck"]) && !empty($_SESSION["aSessn"]["aSeck"]) && $NameSanitizer->code($_SESSION["aSessn"]["aSeck"])){
    $response["sanitized"]["isCreatorSanitized"]=200;
    $response["sanitized"]["isCreatorLoggedIn"]=200;
    $o["uni_id"] = $_SESSION["aSessn"]["aSeck"];
    $k = $AdminiAccountPull->get_mirror_account_route_o($o["uni_id"]);
    if(is_array($k)&&!empty($k)){
        $response["sanitized"]["isUserSanitized"]=200;
        $o["s_name"] = $k["fname"]." ".$k["sname"];
        $o["s_seck"] = $k["adr_id"];
        $o["s_code"] = $k["adr_code"];
        $o["s_mobile"] = $k["adr_mobile"];
        $o["s_email"] = $k["email"];
    }else $response["sanitized"]["isUserSanitized"]=404;

}else {
    $response["sanitized"]["isAdvertiserSanitized"]=404;
    $response["sanitized"]["isAdvertiserLoggedIn"]=404;
}

$o["name"] = null;
if($NameSanitizer->artist_name($_POST["name"])){
    $o["name"] = $NameSanitizer->artist_name($_POST["name"]);
    $response["sanitized"]["isNameSanitized"]=200;
}else {
    $response["sanitized"]["isNameSanitized"]=404;
    $o["name"] = "Unamed";
}

if($ProductPush->progress($o))
    $response["pushedToServer"]["isDetailsPushed"] = 200;
else $response["pushedToServer"]["isDetailsPushed"] = 404;

if(is_array($_FILES) && count($_FILES)>0 && is_array($_FILES["pictures"]) && is_array($_FILES["pictures"]["type"]) && count($_FILES["pictures"]["type"])>0){
    $FileUploadHandler->updateUploadLocation("../../../store/");
    if($FileUploadHandler->filesPushRemote($_FILES,"pictures","PICTURES",1,$o,$ProductPush))
        $response["pushedToServer"]["isPicturesPushed"] = 200;
    else $response["pushedToServer"]["isPicturesPushed"] = 404;
}else $response["pushedToServer"]["isPicturesPushed"] = 202;

if($response["pushedToServer"]["isDetailsPushed"] == 200 &&
    ($response["pushedToServer"]["isPicturesPushed"] ==200 || $response["pushedToServer"]["isPicturesPushed"] == 202)
)$response["success"]["status"] = 200;
else $response["success"]["status"] = 404;
echo json_encode($response["success"]);
?>