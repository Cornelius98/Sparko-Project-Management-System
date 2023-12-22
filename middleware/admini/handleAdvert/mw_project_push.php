<?php 
session_start();
require_once ('../../../HEADER_FILES.php');
$response = [
    "set" =>[ 
        "isNameSet" =>0,
        "isDescSet" =>0,
        "isSdateSet" =>0,
        "isCdateSet" =>0,
        "isDirectorSet" =>0,
        "isPicturesSet"=>0
    ],
    "void" =>[ 
        "isNameEmpty" =>0,
        "isDescEmpty" =>0,
        "isSdateEmpty" =>0,
        "isCdateEmpty" =>0,
        "isDirectorEmpty" =>0,
        "isPicturesEmpty"=>0
    ],
    "sanitized" =>[
        "isNameSanitized" =>0,
        "isDescSanitized" =>0,
        "isSdateSanitized" =>0,
        "isCdateSanitized" =>0,
        "isDirectorSanitized" =>0,
        "isCreatorSanitized"=>0,
        "isCreatorLoggedIn"=>0,
        "isUserSanitized"=>0
    ],
    "pushedToServer" =>[
        "isDetailsPushed"=>0,
        "isPicturesPushed"=>0
    ],
    "success" =>[
        "status" =>0
    ]
];

isset($_POST["name"])?$response["set"]["isNameSet"]=200:$response["set"]["isNameSet"]=404;
isset($_POST["desc"])?$response["set"]["isDescSet"]=200:$response["set"]["isDescSet"]=404;
isset($_POST["sdate"])?$response["set"]["isSdateSet"]=200:$response["set"]["isSdateSet"]=404;
isset($_POST["cdate"])?$response["set"]["isCdateSet"]=200:$response["set"]["isCdateSet"]=404;
isset($_POST["director"])?$response["set"]["isDirectorSet"]=200:$response["set"]["isDirectorSet"]=404;
isset($_FILES["pictures"])?$response["set"]["isPicturesSet"]=200:$response["set"]["isPicturesSet"]=404;

!empty($_POST["name"])?$response["void"]["isNameEmpty"]=200:$response["void"]["isNameEmpty"]=404;
!empty($_POST["desc"])?$response["void"]["isDescEmpty"]=200:$response["void"]["isDescEmpty"]=404;
!empty($_POST["sdate"])?$response["void"]["isSdateEmpty"]=200:$response["void"]["isSdateEmpty"]=404;
!empty($_POST["cdate"])?$response["void"]["isCdateEmpty"]=200:$response["void"]["isCdateEmpty"]=404;
!empty($_POST["director"])?$response["void"]["isDirectorEmpty"]=200:$response["void"]["isDirectorEmpty"]=404;
!empty($_FILES["pictures"])?$response["void"]["isPicturesEmpty"]=200:$response["void"]["isPicturesEmpty"]=404;

$o = [];
$o["rand_id"] = uniqid().substr(random_int(1,PHP_INT_MAX),0,3);
$o["store_url"] = "./store/";
$o['d'] = date("d");
$o['m'] = date("m");
$o['y'] = date("Y");
$o["tname"] = 0;
$o["summary"] = 0;
$o["uni_id"] = 0;
$o["aims"] = 0;
$o["objectives"] = 0;
$o["hypothesis"] = 0;
$o["conclusion"] = 0;
$o["mdate"] = 0;
$o["duration"] = 0;
$o["manager"] = 0;
$o["supervisor"] = 0;
$o["wforce"] = 0;
$o["input"] = 0;
$o["pyield"] = 0;
$o["loss"] = 0;
$o["profit"] = 0;
$o["sprocedure"] = 0;
$o["mprocedure"] = 0;
$o["yprocedure"] = 0;
$o["rprocedure"] = 0;

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
$o["desc"] = null;
if($DescriptionSanitize->description($_POST["desc"])){
    $o["desc"] = $DescriptionSanitize->description($_POST["desc"]);
    $response["sanitized"]["isDescSanitized"]=200;
}else $response["sanitized"]["isDescSanitized"]=404;

if(!empty($o["sdate"]))
    $o["sdate"] = $_POST["sdate"];
else $o["sdate"] = 0;

if(!empty($o["cdate"]))
    $o["cdate"] = $_POST["cdate"];
else $o["cdate"] = 0;

$o["director"] = null;
if($NameSanitizer->artist_name($_POST["director"])){
    $o["director"] = $NameSanitizer->artist_name($_POST["director"]);
    $response["sanitized"]["isDirectorSanitized"]=200;
}else {
    $response["sanitized"]["isDirectorSanitized"]=404;
    $o["director"] = 0;
}

if($o["pj_id"] = $ProductPush->project($o))
    $response["pushedToServer"]["isDetailsPushed"] = 200;
else $response["pushedToServer"]["isDetailsPushed"] = 404;

if(is_array($_FILES["pictures"]["type"]) && is_array($_FILES["pictures"]) && is_array($_FILES) && count($_FILES["pictures"]["type"])>0){
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