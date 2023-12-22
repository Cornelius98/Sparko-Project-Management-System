<?php
session_start();
ini_set("zlib.output_compression", 9);
header("Cache-Control: private,no-cache,must-revalidate,must-understand,immutable,max-age=3600,stale-if-error=3600");
include_once "../../HEADER_FILES.php";
$AdminiSessionPush->access_permission();
$AdministratorActivity->register_activity();
$Utility->broadcast_timezone();
$adrSeck = null;
$params = null;
$o = null;
if(isset($_GET["pipe"]) && !empty($_GET["pipe"])){
    if($int = $NameSanitizer->is_whole_int($_GET["pipe"])){
        if($UserAccountPull->advertiser_exist($_GET["pipe"])){
            $adrSeck = $int;
            $o = $AdminiAccountPull->get_mirror_account_route_o($adrSeck);
            if(!is_array($o) || empty($o) || empty($o["adr_id"]))
                header("location:err_mirror_credentials");
            else {
                $params = 'pipe='.$_GET["pipe"].'&&pjr='.$_GET["pjr"];
                $ProductPush->view($_GET["pjr"],$_SESSION["aSessn"]["aSeck"]);
            }
        }else header("location:home?err_uthread_unexist");
    }else header("location:home?err_uthread_nn");
}else header("location:home?err_uthread_unset");

$projectContainer = $ProductPull->get_project($_GET["pjr"]);
?>
<!DOCTYPE html>
<html>
<head>
    <?php $AdminiUXTemplate->headers('Project Review');?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>
<body>
    <div class="dash-full-wrapper">
        <div class="container-fluid">
            <div id="post-wrapper">
                <div id="post-wrapper-fader">
                    <div class="row">
                        <aside class="col-sm-12 col-md-3 col-lg-3 col-xl-3 aside">
                            <?php $AdminiUXTemplate->side();?>
                        </aside>
                        <section class="col-sm-12 col-md-9 col-lg-9 col-xl-9 section">
                            <?php $AdminiUXTemplate->nav();?>
                            <hr>
                            <div class="projectioptions">
                                <a href="progress?<?php echo $params;?>" class="btn btn-dark btn-sm">Progress <i class="fa fa-snowflake"></i></a>
                                <a href="gallery?<?php echo $params.'&&gallery=1';?>" class="btn btn-dark btn-sm">Pictures <i class="fa fa-image"></i></a>
                                <a href="invite?<?php echo $params.'&&gallery=1';?>" class="btn btn-dark btn-sm">Invite <i class="fa fa-users"></i></a>
                                <a href="discuss?<?php echo $params.'&&gallery=1';?>" class="btn btn-dark btn-sm">Discuss <i class="fa fa-laptop"></i></a>
                                <a href="share?<?php echo $params.'&&gallery=1';?>" class="btn btn-dark btn-sm">Share <i class="fa fa-paper-plane"></i></a>
                            </div>
                            <div class="project-details">
                                <div class="tabs">
                                    <div class="tab">
                                        <div class="tab-header">
                                            <div class="wrap-notice">
                                                <i class="fa fa-paper-plane"></i>
                                            </div>
                                        </div>
                                        <div class="tab-body">
                                            <h5><strong>Project Name</strong></h5>
                                            <p>
                                                <?php 
                                                    if($projectContainer["name"]!=0)
                                                        echo $projectContainer["name"];
                                                    else 
                                                        echo "Unknown";
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="tab">
                                        <div class="tab-header">
                                            <div class="wrap-notice">
                                                <i class="fa fa-paper-plane"></i>
                                            </div>
                                        </div>
                                        <div class="tab-body">
                                            <h5><strong>Project Description</strong></h5>
                                            <p>
                                                <?php 
                                                    if($projectContainer["desc"])
                                                        echo $projectContainer["desc"];
                                                    else echo "unknown";
                                                ?>      
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tabs">
                                    <div class="tab">
                                        <div class="tab-header">
                                            <div class="wrap-notice">
                                                <i class="fa fa-clock"></i>
                                            </div>
                                        </div>
                                        <div class="tab-body">
                                            <h5><strong>Start Date</strong></h5>
                                            <p>
                                                <?php 
                                                    if($projectContainer["sdate"]!=0)
                                                        echo date("F,D Y",strtotime($projectContainer['sdate']));
                                                    else echo "unknown";
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="tab">
                                        <div class="tab-header">
                                            <div class="wrap-notice">
                                                <i class="fa fa-clock"></i>
                                            </div>
                                        </div>
                                        <div class="tab-body">
                                            <h5><strong>Completion Date</strong></h5>
                                            <p>
                                                <?php 
                                                    if($projectContainer["cdate"]!=0)
                                                        echo date("F,D Y",strtotime($projectContainer['cdate']));
                                                    else echo "Unknown";
                                                ?>      
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tabs">
                                    <div class="tab">
                                        <div class="tab-header">
                                            <div class="wrap-notice">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                        <div class="tab-body">
                                            <h5><strong>Coordinator Fullname</strong></h5>
                                            <p>
                                                <?php 
                                                    if($projectContainer["director"]!=0)
                                                        echo $projectContainer['director'];
                                                    else echo "unknown";
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="tab">
                                        <div class="tab-header">
                                            <div class="wrap-notice">
                                                <i class="fa fa-print"></i>
                                            </div>
                                        </div>
                                        <div class="tab-body">
                                            <h5><strong>Completion Date</strong></h5>
                                            <p>
                                                <?php 
                                                    if($projectContainer["cdate"]!=0)
                                                        echo date("F,D Y",strtotime($projectContainer['cdate']));
                                                    else echo "Unknown";
                                                ?>      
                                            </p>

                                        </div>
                                        <footer class="tab-footer">
                                            <a href="pdfGenerate?quarter=Third" class="btn btn-sm btn-danger">Print Report</a>
                                        </footer>
                                        
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $AdminiUXTemplate->headers_bottom();?>
</body>
</html>

 

