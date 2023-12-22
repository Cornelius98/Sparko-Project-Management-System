<?php 
session_start();
ini_set("zlib.output_compression", 9);
header("Cache-Control: private,no-cache,must-revalidate,must-understand,immutable,max-age=3600,stale-if-error=3600");
include_once "../../HEADER_FILES.php";
$AdminiSessionPush->access_permission();
$AdministratorActivity->register_activity();
$Utility->broadcast_timezone();
$current_user = $_SESSION["aSessn"]["aSeck"];
$notifications = $ProductPull->notifications($current_user);
?>
<!DOCTYPE html>
<html>
<head>
    <?php $AdminiUXTemplate->headers('Home');?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>
<body>
    <div class="dash-full-wrapper">
        <div class="container-fluid">
            <div id="post-wrapper">
                <div id="post-wrapper-fader">
                    <div class="row">
                        <aside class="col-sm-12 col-md-3 col-lg-3 col-xl-3 aside">
                            <?php $AdminiUXTemplate->side($notifications);?>
                        </aside>
                        <section class="col-sm-12 col-md-9 col-lg-9 col-xl-9 section">
                            <?php $AdminiUXTemplate->nav();?>
                            <div>
                                <?php $UserErrorsPool->error("err_gallery_key","Gallery Requested To Display Is Not Recognized");?>
                                <?php $UserErrorsPool->error("err_pjr_key","Project Requested To Display Is Not Recognized");?>
                                <?php $UserErrorsPool->error("err_pjr_int","Project Id is not interger");?>
                                <?php $UserErrorsPool->error("err_pjr","Project Identifier Is Not Set");?>
                                <?php $UserErrorsPool->error("err_pipe","Project Creator Is Not Found");?>
                                <?php $UserErrorsPool->error("err_pjr_empty","Project Container Not Found");?>
                                <?php $UserErrorsPool->error("err_empty_rinvite","Invitations Not Found");?>
                            </div>
                            <div class="tabs">
                                <div class="tab">
                                    <div class="tab-header">
                                        <div class="wrap-notice">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                    <div class="tab-body">
                                        <h5><strong>Start Project</strong></h5>
                                        <p>Begin working on project.</p>
                                    </div>
                                    <footer class="tab-footer">
                                        <a href="create"><i class="fa fa-arrow-right"></i></a>
                                    </footer>
                                </div>
                                <div class="tab">
                                    <div class="tab-header">
                                        <div class="wrap-notice">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                    <div class="tab-body">
                                        <h5><strong>All Projects</strong></h5>
                                        <p>Look through all projects.</p>
                                    </div>
                                    <footer class="tab-footer">
                                        <a href="projects"><i class="fa fa-arrow-right"></i></a>
                                    </footer>
                                </div>
                            </div>
                            <div class="tabs">
                                <div class="tab">
                                    <div class="tab-header">
                                        <div class="wrap-notice">
                                            <i class="fa fa-briefcase"></i>
                                        </div>
                                    </div>
                                    <div class="tab-body">
                                        <h5><strong>Unlimited Project</strong></h5>
                                        <p>Create as many as you wish.</p>
                                    </div>
                                </div>
                                <div class="tab">
                                    <div class="tab-header">
                                        <div class="wrap-notice">
                                            <i class="fa fa-briefcase"></i>
                                        </div>
                                    </div>
                                    <div class="tab-body">
                                        <h5><strong>Projects</strong></h5>
                                        <p>Browse through your projects catalogue.</p>
                                    </div>
                                </div>
                                <div class="tab">
                                    <div class="tab-header">
                                        <div class="wrap-notice">
                                            <i class="fa fa-bell"></i>
                                        </div>
                                    </div>
                                    <div class="tab-body">
                                        <h5><strong>Backups</strong></h5>
                                        <p>All your work is instantly save for future use.</p>
                                    </div>
                                </div>
                                <div class="tab">
                                    <div class="tab-header">
                                        <div class="wrap-notice">
                                            <i class="fa fa-users"></i>
                                        </div>
                                    </div>
                                    <div class="tab-body">
                                        <h5><strong>100% <br>Discussed</strong></h5>
                                        <p>All projects are for invited team network to discuss.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tabs">
                                <div class="tab">
                                    <div class="tab-header">
                                        <div class="wrap-notice">
                                            <i class="fa fa-gear"></i>
                                        </div>
                                    </div>
                                    <div class="tab-body">
                                        <h5><strong>Settings</strong></h5>
                                        <p>Make some chnages.</p>
                                    </div>
                                    <footer class="tab-footer">
                                        <a href="settings"><i class="fa fa-arrow-right"></i></a>
                                    </footer>
                                </div>
                                <div class="tab">
                                    <div class="tab-header">
                                        <div class="wrap-notice">
                                            <i class="fa fa-users"></i>
                                        </div>
                                    </div>
                                    <div class="tab-body">
                                        <h5><strong>Discussions On Projects</strong></h5>
                                        <p>Read through discussions.</p>
                                    </div>
                                    <footer class="tab-footer">
                                        <a href="discussed"><i class="fa fa-arrow-right"></i></a>
                                    </footer>
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

