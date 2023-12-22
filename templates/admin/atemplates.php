<?php 
namespace TemplateManager\AdminiTemplates;
use AccountsManager\UserAccountPull;
class AdminiTemplate extends UserAccountPull{
    public function nav()
    {
        echo '<nav class="navbar navbar-expand-sm navbar-dark">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="fa fa-bars">
                            <span class="slide-menu-text">Menu</span>
                        </span>
                    </button>
                    <span class="slide-menu"><i class="fa fa-bars"></i></span>
                    <a class="navbar-brand" href="home" style="text-transform:uppercase;">
                        <span class="m-name">
                            <i class="fa fa-briefcase" 
                                style="padding:10px;
                                    color:white;
                                    border-radius: 125px;">
                            </i>
                        </span>
                    </a>
                    <div id="navbarCollapse" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"><a href="create" class="nav-link">START</a></li>
                            <li class="nav-item"><a href="projects" class="nav-link">PROJECTS</a></li>
                            <li class="nav-item"><a href="settings" class="nav-link">SETTINGS</a></li>
                            <li class="nav-item"><a href="discussed" class="nav-link">DISCUSSIONS</a></li>
                            <li class="nav-item"><a href="settings_timeline" class="nav-link">TIMELINE</a></li>
                            <li class="nav-item"><a href="settings_password" class="nav-link">PASSWORD</a></li>
                        </ul>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0"></ul>
                    </div>
                    <a href="logout" class="sign-out-circle shadow"><i class="fa fa-key"></i></a>
                </div>
            </nav>';
    }
    public function side(){
        echo '<div>
                <div class="user-details">
                    <h5><i class="fa fa-users"></i> '.$_SESSION['aSessn']['aName'].'<br>
                    </h5>
                </div>
                <br>
                <hr>
                <ul>
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="home">Home</a>
                    </li>
                    <li>
                        <i class="fa fa-envelope"></i>
                        <a href="create">Project</a>
                    </li>
                    <li>
                        <i class="fa fa-list"></i>
                        <a href="projects">Projects</a>
                    </li>
                    <li>
                        <i class="fa fa-user"></i>
                        <a href="discussed">Discussions</a>
                    </li>
                    <li>
                        <i class="fa fa-gear"></i>
                        <a href="settings">Settings</a>
                    </li>
                    <li>
                        <i class="fa fa-key"></i>
                        <a href="logout">Logout</a>
                    </li>
                </ul
            </div>';
    }
    public function pagination($num_pages,$page,$current_page){
        if(($num_pages>=1)&&($num_pages<=$num_pages)){
            echo '<div class="pagination-wrap">';
                    if(($page<=$num_pages) && ($page>=1)){
                           
                        echo '<div class="pagination-items">
                                <div class="prev-nex-btns">
                                    <a href="'.$current_page.'?page='.($page-1).'" class="btn btn-sm"><i class="fa fa-arrow-left"></i></a>
                                    <a href="'.$current_page.'?page='.($page+1).'" class="btn btn-sm "><i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="pagination-pages">
                                <div class="count-pages">&nbsp; | &nbsp;<strong>Page '.$num_pages.'</strong></div>
                            </div>
                    </div>';
                }
        }
    }
    public function pagination_params($num_pages,$page,$current_page,$params){
        if(($num_pages>=1)&&($num_pages<=$num_pages)){
            echo '<div class="pagination-wrap">';
                if(($page<=$num_pages) && ($page>=1)){
                    echo '<div class="container">
                            <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-left">
                                    <div class="prev-nex-btns">
                                        <a href="'.$current_page.'?page='.($page-1).'&&'.$params.'" class="btn btn-sm">Prev</a>
                                        <a href="'.$current_page.'?page='.($page+1).'&&'.$params.'" class="btn btn-sm ">Next</a>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-right">
                                    <span class="count-pages">'.$page.'&nbsp; | &nbsp;<strong>'.$num_pages.'</strong></span>
                                </div>
                            </div>
                    </div>';
                }
        }
    }
    public function pagination_params_II($num_pages,$page,$current_page,$params){
        if(($num_pages>=1)&&($num_pages<=$num_pages)){
            echo '<div class="pagination-wrap">';
                    if(($page<=$num_pages) && ($page>=1)){
                           
                        echo '<div class="pagination-items">
                                <div class="prev-nex-btns">
                                    <a href="'.$current_page.'?page='.($page-1).'" class="btn btn-sm"><i class="fa fa-arrow-left"></i></a>
                                    <a href="'.$current_page.'?page='.($page+1).'" class="btn btn-sm "><i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="pagination-pages">
                                <div class="count-pages">&nbsp; | &nbsp;<strong> Page'.$num_pages.'</strong></div>
                            </div>
                    </div>';
                }
        }
    }
    public function vw_project_card($productsContainer){
        if(is_array($productsContainer) && !empty($productsContainer)){
            foreach($productsContainer AS $product){
                if(key_exists("pj_id",$product)){
                    echo '<div class="advertised shadow">
                            <div class="advertised-details">
                                <h5>'.$product["name"].'</h5>';
                                echo '<small class="pj-desc">'.date("d /m /Y",strtotime($product["p_date"])).'</small>';
                            echo '</div>
                            <div class="advertised-menu">';
                                if(($product["mute"]==1) && $product["adr_id"]==$_SESSION["aSessn"]["aSeck"])
                                    echo '<a>Closed</a>|<a href="project?pipe='.$_SESSION["aSessn"]["aSeck"].'&&pjr='.$product["pj_id"].'">Open Now</a>';
                                elseif(($product["mute"]==1) && $product["adr_id"]!=$_SESSION["aSessn"]["aSeck"])
                                    echo '<a>Closed</a>';
                                else 
                                    echo '<a href="project?pipe='.$_SESSION["aSessn"]["aSeck"].'&&pjr='.$product["pj_id"].'">View</a>';

    
                            echo '</div>
                        </div>';
                }else continue;
            }
        }else{
            echo '<h5 class="err_products">
                    <i class="fa fa-robot"></i>
                    <br>
                    Projects Not Found
                </h5>';
        }
    }
    public function vw_card_user($product){
        echo '<div class="advertised shadow">
                <img src="'.str_replace("./","../../",$product['adr_icon_url']).$product["adr_icon_name"].'" alt="avatar">
                <div class="advertised-details">
                    <h5>'.$product["adr_code"].'</h5>';
                    if($product["fname"]!=0)
                        echo '<small>'.$product["fname"].' '.$product["sname"].'</small>';
                    else
                        echo '<small>Annonymous</small>';
                echo '</div>
                <div class="advertised-menu">';
                    if($product["adr_block"]==0 || $product["adv_block"]==0 || $product["masterblock"]==0)
                        echo '<span class="active">
                                <i class="fa fa-eye"></i> Active
                            </span>';
                    else 
                        echo '<span class="inactive">
                                <i class="fa fa-eye-slash"></i> Inactive
                            </span>';
                    
                    echo '<a href="user_menu?traffic='.rand(1,PHP_INT_MAX).'&&controller='.rand(1,PHP_INT_MAX).'&&seck='.$product["adr_id"].'">Mirror</a> 
                </div>
            </div>';
    }
    public function spinAnime(){
        echo ' <div class="spin-wrap">
                <span class="spin-circle"></span>
            </div>';
    }
    public function headers($title){
        echo '<title>'.$title.'</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0" />
        <link rel="shortcut icon" href="../../assets/favicon.png" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
        <link rel="stylesheet" type="text/css" href="../../libraries/styles/css/app/anime.css">
        <link rel="stylesheet" type="text/css" href="./dash.css">'; 
    }
    public function headers_bottom(){
        echo '<script src="../../libraries/js/jquery.js" type="text/javascript"></script>
        <script src="../../libraries/js/admin/autilsJQ.js"></script>
            <script src="../../libraries/js/anime.js" type="text/javascript"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>';
    }
    public function vw_user($productsContainer){
        if(is_array($productsContainer) && !empty($productsContainer)){
            foreach($productsContainer As $user){
                $params = 'thread='.rand(1024,PHP_INT_MAX).'&&controller='.rand(1,PHP_INT_MAX).'&&process='.rand(6242523,PHP_INT_MAX).'&&scx='.rand(896725425,PHP_INT_MAX).'&&seck='.$user["adr_id"];
                echo '<div class="user-go-slide ads-desc">
                        <div class="user-go-prop-key">
                            <div class="go-icon">
                                <i class="fa fa-user orders-basket"></i>
                            </div>
                            <div class="go-name">
                                <span>'.$user["fname"].' '.$user["sname"].'</span>
                                <br>
                                <span class="go-go-date">'.date("d/m/Y",strtotime($user["time_joined"])).'</span>
                            </div> 
                        </div>
                        <div class="user-go-prop-value">
                            <a href="user_menu?'.$params.'" class="order-items">
                                <i class="fa fa-arrow-right"></i>
                            </a>
                            <br/>
                        </div>
                </div>';
            }
        }else {
            echo '<h5 class="err_products">
                <i class="fa fa-robot"></i>
                <br>
                Users Not Found
            </h5>';
        }
    }
    public function vw_loggs($productsContainer){
        if(is_array($productsContainer) && !empty($productsContainer)){
            foreach($productsContainer As $log){
                if(array_key_exists("lgi_id",$log)){
                    $params = 'thread='.rand(1024,PHP_INT_MAX).'&&controller='.rand(1,PHP_INT_MAX).'&&process='.rand(6242523,PHP_INT_MAX).'&&scx='.rand(896725425,PHP_INT_MAX).'&&seck='.$log["uni_id"].'&&ogg='.$log["lgi_id"].'&&pipe='.$log["uni_id"];
                    echo '<div class="user-go-slide ads-desc">
                            <div class="user-go-prop-key">
                                <div class="go-icon">
                                    <i class="fa fa-user orders-basket"></i>
                                </div>
                                <div class="go-name">
                                    <span>'.$log["fname"].' '.$log["sname"].'</span>
                                    <br>
                                    <span class="go-go-date">'.date("d/m/Y",strtotime($log["logged_in"])).'</span>
                                    <br/>
                                    <br/>
                                    <span class="go-go-date">:Hash: '.$log["sessn_hash"].'</span><br>
                                    <span class="go-go-date">Start: '.date("F d, Y   @H:m:i:s",strtotime($log["logged_in"])).'</span><br>
                                    <span class="go-go-date">Close: '.date("F d, Y   @H:m:i:s",strtotime($log["logged_out"])).'</span>
                                </div> 
                            </div>
                            <div class="user-go-prop-value">
                                <a href="mirror_loggins_renew?'.$params.'" class="order-items">
                                    <i class="fa fa-arrow-right"></i>
                                </a>
                                <br/>
                            </div>
                    </div>';
                }
            }
        }else {
            echo '<h5 class="err_products">
                <i class="fa fa-robot"></i>
                <br>
                User Loggs Not Found
            </h5>';
        }
    }
    public function vw_activities($productsContainer){
        if(is_array($productsContainer) && !empty($productsContainer)){
            foreach($productsContainer As $activity){
                if(array_key_exists("actvt_id",$activity)){
                    echo '<div class="user-go-slide ads-desc">
                            <div class="user-go-prop-key">
                                <div class="go-icon">
                                    <i class="fa fa-user orders-basket"></i>
                                </div>
                                <div class="go-name">
                                    <span>'.$activity["fname"].' '.$activity["sname"].'</span>
                                    <br>
                                    <span class="go-go-date">'.date("F d, Y",strtotime($activity["actvt_date"])).'</span>
                                    <br/>
                                    <br/>
                                    <span class="go-go-date">Action: '.$activity["actn_name"].'</span><br>
                                    <span class="go-go-date">Script: <span style="text-transform:lowercase;">'.$activity["scr_name"].'</span></span><br>
                                    <span class="go-go-date">Visit: <a href="'.$activity["scr_url"].'"><i class="fa fa-arrow-right"></i></a></span>
                                    <br>
                                    <br>
                                    <span class="go-go-date"><i class="fa fa-calendar"></i> '.date("F d, Y",strtotime($activity["actvt_date"])).'</span> &nbsp;&nbsp;
                                    <span class="go-go-date"><i class="fa fa-clock"></i> '.date("H:m: A",strtotime($activity["actvt_time"])).'</span>
                                </div> 
                            </div>
                            <div class="user-go-prop-value">
                                <br/>
                            </div>
                    </div>';
                }
            }
        }else {
            echo '<h5 class="err_products">
                <i class="fa fa-robot"></i>
                <br>
                Loggs Not Found
            </h5>';
        }
    }
    private function vw_project_gallery_picture($productsContainer,$Utility,$params){
        if(is_array($productsContainer) && !empty($productsContainer)){
            foreach($productsContainer AS $product){
                if(!isset($product["total_gallery"])){
                    echo '<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 shadow gallery-card" style="height:270px;padding:0;">
                            <img src="'.str_ireplace("./","../../",$product["store_url"])."/".$product["pc_name"].'" style="width:100%;height: 100%;" alt="img-name"/>
                            <div class="gallery-details">
                                <a href="'.str_ireplace("./","../../",$product["store_url"])."/".$product["pc_name"].'" download>
                                    <span class="f-download"><i class="fa fa-download"></i></span>
                                    <a href="../../middleware/admini/handleAdvert/mw_project_gallery_delete?'.$params.'&&fs_name='.$product["pc_name"].'&&fs_id='.$product["pc_id"].'" class="f-download">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </a>
                            </div>
                        </div>';
                }else continue;
            }
        }else{
            echo '<h5 class="err_products">
                    <i class="fa fa-robot"></i>
                    <br>
                    Project Photos Not Found
                </h5>';
        }
    }
    private function vw_project_gallery_document($productsContainer,$Utility,$params){
        if(is_array($productsContainer) && !empty($productsContainer)){
            foreach($productsContainer AS $product){
                if(!isset($product["total_gallery"])){
                    echo '<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 shadow gallery-card gallery-document" style="height:270px;padding:0;">
                            <div class="gallery-icon-wrap">
                                <i class="fa fa-file-pdf fa-3x"></i>
                            </div>
                            <div class="gallery-details">
                                <a href="'.str_ireplace("./","../../",$product["store_url"])."/".$product["dc_name"].'" download>
                                    <span class="f-download"><i class="fa fa-download"></i></span>
                                    <span class="f-size f-size-2">'.$Utility->filesize_to_mb($product["dc_size"]).'</span>
                                    <span class="f-document f-document-2">Document</span>
                                    <a href="../../middleware/admini/handleAdvert/mw_project_gallery_delete?'.$params.'&&fs_name='.$product["dc_name"].'&&fs_id='.$product["dc_id"].'" class="f-download"><i class="fa fa-trash"></i></a>
                                </a>
                            </div>
                        </div>';
                }else continue;
            }
        }else{
            echo '<h5 class="err_products">
                    <i class="fa fa-robot"></i>
                    <br>
                    Project Documents Not Found
                </h5>';
        }
    }
    private function vw_project_gallery_file($productsContainer,$Utility,$params){
        if(is_array($productsContainer) && !empty($productsContainer)){
            foreach($productsContainer AS $product){
                if(!isset($product["total_gallery"])){
                    echo '<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 shadow gallery-card gallery-document" style="height:270px;padding:0;">
                            <div class="gallery-icon-wrap">
                                <i class="fa fa-file fa-3x"></i>
                            </div>
                            <div class="gallery-details">
                                <a href="'.str_ireplace("./","../../",$product["store_url"])."/".$product["fs_name"].'" download>
                                    <span class="f-download"><i class="fa fa-download"></i></span>
                                    <span class="f-size f-size-2">'.$Utility->filesize_to_mb($product["fs_size"]).'</span>
                                    <span class="f-file f-file-2">File</span>
                                    <a href="../../middleware/admini/handleAdvert/mw_project_gallery_delete?'.$params.'&&fs_name='.$product["fs_name"].'&&fs_id='.$product["fs_id"].'" class="f-download"><i class="fa fa-trash"></i></a>
                                </a>
                            </div>
                        </div>';
                }else continue;
            }
        }else{
            echo '<h5 class="err_products">
                    <i class="fa fa-robot"></i>
                    <br>
                    Project Files Not Found
                </h5>';
        }
    }
    public function vw_project_gallery($gallery_type,$o,$Utility,$params){
        switch($gallery_type){
            case 1:
                $this->vw_project_gallery_picture($o,$Utility,$params);
                break;
            case 2:
                $this->vw_project_gallery_document($o,$Utility,$params);
                break;
            case 3:
                $this->vw_project_gallery_file($o,$Utility,$params);
                break;
        }
    }
    public function generatePDFReport($quarter){
        $html = '<div style="color:#0000;background-color:white;font-family:arial;">
                <div style="color:#0000">
                    <div style="color:#0000;border-bottom:1px solid rgb(67,103,132);line-height:14px;">
                        <br/>
                        <small style="color:#0000;text-align:right;font-size:25px;text-transform:uppercase;"><b>Theophilus Project Manager Report</b></small>
                        <br/>
                        <br/>
                        <small style="text-align:right;">Official Director Report</small><br/>
                        <small style="text-align:right;">Date: '.date("d F,Y").'</small><br/>
                        <small style="text-align:right;">Manager #No: '.$_SESSION['aSessn']['aCode'].'</small>
                        <br/>
                        <br/>
                    </div>
                    <div>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been 
                        the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley 
                        of type and scrambled it to make a type specimen book. It has survived not only five centuries, 
                        but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised 
                        in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently 
                        with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </div>
                    <div>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been 
                        the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley 
                        of type and scrambled it to make a type specimen book. It has survived not only five centuries, 
                        but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised 
                        in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently 
                        with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </div>
                    <div>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been 
                        the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley 
                        of type and scrambled it to make a type specimen book. It has survived not only five centuries, 
                        but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised 
                        in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently 
                        with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </div>
                    <div>
                    </div>
                <div>
                </div>
                <footer style="background-color:white;margin-top:10%;text-align:center;color:lightgray;">
                <h6 style="background-color:white;text-align:center;font-size:x-small;line-height:13px;">
                <span style="font-size:xx-small;color:lightgray;">Thank you for your business!</span><br/>
                <span style="font-size:xx-small;color:lightgray;">Along Shantumbu Road, Chalala, ICU Zambia</span><br/>
                <span style="font-size:xx-small;color:lightgray;">&copy; 2022</span>
                </h6>
                </footer></div></div>';
                return $html;
    }
    private function vw_discussion_even($discussion){
        echo '<div class="even-discuss">
                <div class="even-discuss-owner">
                    <span class="contributor-name">'.$discussion["fname"].' '.$discussion["sname"].'</span>
                </div>
                <div class="contributor-text">'.$discussion["suggestion"].'</div>
                <div class="contributor-timestamp">
                    <i class="fa fa-check"></i>
                    <i class="fa fa-check"></i>
                </div>
            </div>';
    }
    private function vw_discussion_odd($discussion){
        echo '<div class="odd-discuss-wrap">
                <div class="odd-discuss">
                    <div class="old-discuss-owner">
                        <span class="contributor-name">'.$discussion["fname"].' '.$discussion["sname"].'</span>
                    </div>
                    <div class="contributor-text">'.$discussion["suggestion"].'</div>
                    <div class="contributor-timestamp"><i class="fa fa-check"></i></div>
                </div>
            </div>';
    }
    public function vw_discussion($productsContainer){
        if(is_array($productsContainer) && !empty($productsContainer)){
            foreach($productsContainer As $discussion){
                if(($discussion["dsc_id"]%2)==0)
                    $this->vw_discussion_even($discussion);
                else 
                    $this->vw_discussion_odd($discussion);
            }
        }else {
            echo '<h5 class="err_products">
                <i class="fa fa-robot"></i>
                <br>
                Project Discussions Not Found
            </h5>';
        }
    }
    public function vw_invitees($productsContainer){
        if(is_array($productsContainer) && !empty($productsContainer)){
            foreach($productsContainer As $invitess){
                echo '<tr>
                    <td  class="ads-prop-key">'.$invitess["fname"].' '.$invitess["sname"].'</td>
                    <td  class="ads-prop-value"><input type="checkbox" name="invitee[]" id="invitee" value="'.$invitess["adr_id"].'"></td>
                </tr>';
            }
        }else {
            echo '<h5 class="err_products">
                <i class="fa fa-robot"></i>
                <br>
                User Invitees Not Found
            </h5>';
        }
    }
    public function vw_invited($productsContainer){
        if(is_array($productsContainer) && !empty($productsContainer)){
            foreach($productsContainer As $invitess){
                echo '<tr>
                    <td  class="ads-prop-key">'.$invitess["name"].'</td>
                    <td  class="ads-prop-value"><a href="../../middleware/admini/handleAdvert/mw_project_accept_invite?status=1&&inv='.$invitess["inv_id"].'" class="btn btn-sm btn-primary">Accept</a> <a href="../../middleware/admini/handleAdvert/mw_project_accept_invite?status=0&&inv='.$invitess["inv_id"].'" class="btn btn-sm btn-danger">Deny</td>
                </tr>';
            }
        }else {
            echo '<h5 class="err_products">
                <i class="fa fa-robot"></i>
                <br>
                Invitations Not Found
            </h5>';
        }
    }
    public function vw_inviting($productsContainer){
        if(is_array($productsContainer) && !empty($productsContainer)){
            foreach($productsContainer As $invitess){
                echo '<tr>
                    <td  class="ads-prop-key">'.$invitess["name"].'</td>
                    <td  class="ads-prop-value">';
                        if($invitess["status"]==1)
                            echo '<a class="btn btn-sm"><i class="fa fa-check"></i></a>';
                        else 
                            echo '<a class="btn btn-sm btn-outline-danger">Pending</a> <a href="../../middleware/admini/handleAdvert/mw_project_accept_inviting?status=0&&inv='.$invitess["inv_id"].'" class="btn btn-sm btn-danger">Remove</a>';
                    
                echo '</td></tr>';
            }
        }else {
            echo '<h5 class="err_products">
                <i class="fa fa-robot"></i>
                <br>
                Invitations Not Found
            </h5>';
        }
    }
    private function vw_icon_sharing($key){
        $icon = "";
        switch($key){
            case 1:
                $icon = '<i class="fab fa-facebook"></i>';
                break;
            case 2:
                $icon = '<i class="fab fa-whatsapp"></i>';
                break;
            case 3:
                $icon = '<i class="fab fa-twitter"></i>';
                break;
            case 4:
                $icon = '<i class="fab fa-instagram"></i>';
                break;
            case 5:
                $icon = '<i class="fa fa-envelope"></i>';
                break;
            default:
                $icon = '<i class="fa fa-users"></i>';
        }   

        return $icon;
    }
    public function vw_sharing_platforms($productsContainer,$pj_id){
        if(is_array($productsContainer) && !empty($productsContainer)){
            foreach($productsContainer As $share){
                echo '<div class="tab share-tab">
                        <div class="tab-header">
                            <div class="wrap-notice">
                                '.$this->vw_icon_sharing($share["shc_id"]).'
                            </div>
                        </div>
                        <div class="tab-body">
                            <h5><strong>'.$share["shc_name"].'</strong></h5>
                            <p>Share on '.$share["shc_name"].'</p>
                        </div>
                        <footer class="tab-footer">
                            <a onclick="unicastPlatformShare('.$_SESSION["aSessn"]["aSeck"].','.$share["shc_id"].','.$pj_id.');" target="_blank" href="'.$share["official_link"].'" ><button class="btn btn-sm btn-success">Share Now</button></a>
                        </footer>
                </div>';
            }
        }else {
            echo '<h5 class="err_products">
                <br>
                User Sharing Events Not Found
            </h5>';
        }
    }
    public function vw_network($productsContainer){
        if(is_array($productsContainer) && !empty($productsContainer)){
            foreach($productsContainer As $network){
                if(array_key_exists("inv_id",$network)){
                    echo '<div class="user-go-slide ads-desc">
                            <div class="user-go-prop-key">
                                <div class="go-icon">
                                    <i class="fa fa-user orders-basket"></i>
                                </div>
                                <div class="go-name">
                                    <span>'.$network["fname"].' '.$network["sname"].'</span>
                                    <br>
                                    <span class="go-go-date">networked</span>
                                    <br/>
                                    <br/>
                                    <span class="go-go-date">Project: '.$network["name"].'</span><br>
                                    <span class="go-go-date">Creator: '.$network["fname"].' '.$network["sname"].'</span><br>
                                    <span class="go-go-date">Status: '.($network["status"]?"Online":"Offline").'</span>
                                    <br>
                                    <br>
                                    <span class="go-go-date"><i class="fa fa-calendar"></i> '.date("F d, Y",strtotime($network["inv_date"])).'</span>
                                    &nbsp;
                                    &nbsp;
                                    <span class="go-go-date"><i class="fa fa-clock"></i> '.date("h:i A",strtotime($network["inv_time"])).'</span>
                                </div> 
                            </div>
                            <div class="user-go-prop-value">
                                <br/>
                            </div>
                    </div>';
                }
            }
        }else {
            echo '<h5 class="err_products">
                <i class="fa fa-robot"></i>
                <br>
                Network Not Found
            </h5>';
        }
    }
}
?>
