<?php
session_start();
ini_set("zlib.output_compression", 9);
header("Cache-Control: private,no-cache,must-revalidate,must-understand,immutable,max-age=3600,stale-if-error=3600");
include_once "../../HEADER_FILES.php";
$AdminiSessionPush->access_permission();
$AdministratorActivity->register_activity();
?>
<!DOCTYPE html>
<html>
<head>
    <?php $AdminiUXTemplate->headers('Project Area');?>
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
                        <section class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-9 section">
                            <?php $AdminiUXTemplate->nav();?>
                            <hr>
                            <div class="form-wrap">
                                <div class="error-display"></div>
                                <form>
                                    <div class="form-grouped">
                                        <label for="form-section" class="form-section">Project Details</label>
                                        <div class="form-group-even">
                                            <input type="text" name="name" id="name" placeholder="Enter Name..." />
                                            <input type="text" name="desc" id="desc" placeholder="Enter Description..."/>
                                        </div>
                                    </div>
                                    <div class="form-grouped">
                                        <label for="form-section" class="form-section"> Start And Completion Dates</label>
                                        <div class="form-group-even">
                                        <input type="date" name="sdate" id="sdate" />
                                        <input type="date" name="cdate" id="cdate" />
                                        </div>
                                    </div>
                                    <div class="form-grouped">
                                        <label for="form-section" class="form-section">Project Coordinator</label>
                                        <div class="form-group-even">
                                            <input type="text" name="director" id="director" placeholder="Enter Fullname ..." />
                                        </div>
                                    </div>
                                    <div class="form-grouped">
                                        <div class="song-files">
                                            <div class="sub-form-group">
                                                    <label for="pictures" class="cover">
                                                        <i class="fa fa-image fa-3x"></i><br>
                                                        Select Pictures ....
                                                    </label>
                                                    <input type="file" 
                                                            id="pictures" 
                                                            class="form-control" 
                                                            name="pictures"
                                                            accept="image/png, image/jpeg, image/jpg, image/jfif, image/gif"
                                                            multiple/>
                                            </div>
                                        </div>
                                        <div>
                                            <button type="button" 
                                                    class="btn 
                                                            btn-sm 
                                                            submit-btn 
                                                            form-control"
                                                    id="migrateAdd">
                                                    <strong>RESGISTER PROJECT</strong> 
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <?php $AdminiUXTemplate->spinAnime();?>
    <?php $AdminiUXTemplate->headers_bottom();?>
    <script>
        function processFilesFromForms(formData,input,fileSave,err){
            let artwork = document.getElementById(input),
                    artworkFileList = artwork.files,
                    artworkListLength = artworkFileList.length
                    i = 0;
                    if(artworkListLength > 0){
                        while(i<=artworkListLength){
                            formData.append(fileSave,artworkFileList[i]);
                            i++;
                        }
                    }else $(".error-display").html('<div class="e-notice">'+err+'</div>');
        }
        function errorDisplayAssistant(errCode,errFlaggs){
            if((errCode==404)||(errCode==505)){
                (".error-display").html('<div class="e-notice">'+errFlaggs+'</div>');
            }
        }
        $("#migrateAdd").click(function(evt){
            evt.preventDefault();
            let formData = new FormData(),
                name = ($("#name").val()!="")?$("#name").val():$(".error-display").html('<div class="e-notice">Enter Project Name</div>'),
                desc = ($("#desc").val()!="")?$("#desc").val():0,
                sdate = ($("#sdate").val()!="")?$("#sdate").val():0,
                cdate = ($("#cdate").val()!="")?$("#cdate").val():0,
                director = ($("#director").val()!="")?$("#director").val():0;
               
                formData.append("name",name);
                formData.append("desc",desc);
                formData.append("sdate",sdate);
                formData.append("cdate",cdate);
                formData.append("director",director);
              
                let pictures = document.getElementById("pictures"),
                picturesFileList = pictures.files,
                picturesListLength = picturesFileList.length,
                j = 0;
                if(picturesListLength > 0){
                    while(j<=picturesListLength){
                        formData.append("pictures[]",picturesFileList[j]);
                        j++;
                    }
                }
                $.ajax({
                    type: 'POST',
                    url: '../../middleware/admini/handleAdvert/mw_project_push',
                    processData: false,
                    contentType: false,
                    async: true,
                    data:formData,
                    beforeSend:function(){
                        $(".spin-wrap").css("display","flex");
                        $(".dash-full-wrapper").css("animation","waterWaveFade 2s infinite");
                    },
                    success:function(q,status,settings){
                        let s = JSON.parse(q);
                        scrollTo(0,0);
                        $(".spin-wrap").css("display","none");
                        $(".dash-full-wrapper").css("animation","none");
                        if(s["status"]==200){
                            $(".error-display").html('<div class="e-success">Project Created</div>');
                        }else $(".error-display").html('<div class="e-notice">Operation Failed, Try Again</div>');
                    }
                });
        });
    </script>
</body>
</html>
 