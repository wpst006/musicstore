<?php include("includes/includefiles.php"); ?>    
<?php require_once("includes/albumHelper.php"); ?>    

<?php
$album_id = null;
$title = '';
$publishing_date = '';
$publisher = '';
$gender = '';
$filename = '';

if (isset($_POST['submitted'])) {
    if (isset($_POST['album_id'])) {
        $status = updateAlbum($album_id);
    } else {
        $status = saveNewAlbum($album_id);
    }

    if ($status == true) {
        messageHelper::setMessage("Album is successfully saved with Album ID : " . $album_id, MESSAGE_TYPE_SUCCESS);
        header("Location:albums-display.php");
        exit();
    }
} else {

    if (isset($_GET['album_id'])) {
        $album_id = $_GET['album_id'];
        fillDataForEditMode($album_id, $title, $publishing_date, $publisher, $gender, $filename);
    }
}

function saveNewAlbum(&$album_id) {
    //Filling Data
    $album_id = autoID::getAutoID('albums', 'album_id', 'ALM_', 6);
    $title = $_POST['title'];
    $publishing_date = $_POST['publishing_date'];
    $publisher = $_POST['publisher'];
    $cd_dvd = $_POST['cd_dvd'];
    $filename = $_POST['uploadedalbum'];
    //******************************************************************************************************************    
    //"albums" Table Insert
    $albumInsert_sql = "INSERT INTO " .
            "`albums` (album_id,title,publishing_date,publisher,cd_dvd,filename) " .
            "VALUES('$album_id','$title','$publishing_date','$publisher','$cd_dvd','$filename')";

    mysql_query($albumInsert_sql) or die(mysql_error());
    //******************************************************************************************************************

    return true;
}

function updateAlbum(&$album_id) {
    //Filling Data
    $album_id = $_POST['album_id'];
    $title = $_POST['title'];
    $publishing_date = $_POST['publishing_date'];
    $publisher = $_POST['publisher'];
    $cd_dvd = $_POST['cd_dvd'];
    $filename = $_POST['uploadedalbum'];
    //******************************************************************************************************************
    //"ablums" Table Update
    $albumUpdate_sql = "UPDATE `albums` SET " .
            "title='" . $title . "'," .
            "publishing_date='" . $publishing_date . "', " .
            "publisher='" . $publisher . "', " .
            "cd_dvd='" . $cd_dvd . "', " .
            "filename='" . $filename . "' " .
            "WHERE album_id='" . $album_id . "'";

    mysql_query($albumUpdate_sql) or die(mysql_error());
    //******************************************************************************************************************    

    return true;
}

function fillDataForEditMode($album_id, &$title, &$publishing_date, &$publisher, &$cd_dvd, &$filename) {
    $alblumData = albumHelper::getAlbumByAlbumID($album_id);
    $album_id = $alblumData[0]['album_id'];
    $title = $alblumData[0]['title'];
    $publishing_date = $alblumData[0]['publishing_date'];
    $publisher = $alblumData[0]['publisher'];
    $cd_dvd = $alblumData[0]['cd_dvd'];
    $filename = $alblumData[0]['filename'];
}
?>

<?php $pageTitle = "album" ?>
<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <form role="form" id="album" name="album" action="album.php" method="post" class="form-horizontal">

            <?php if (isset($album_id)) { ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Album ID :</label>
                    <div class="col-sm-9">
                        <p class="form-control-static"><?php echo $album_id; ?></p>                                    
                        <input type="hidden" id="album_id" name="album_id" value="<?php echo $album_id; ?>"/>
                    </div>                            
                </div>
            <?php } ?>

            <div class="form-group">
                <label class="col-sm-3 control-label">Title :</label>
                <div class="col-sm-9">
                    <input type="text" id="title" name="title" class="form-control" value="<?php echo $title; ?>" maxlength="30"/>
                </div>                        
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Publishing Date :</div>
                <div class="col-sm-9">
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='text' id="publishing_date" name="publishing_date" class="form-control" data-format="YYYY-MM-DD" value="<?php echo date('Y-m-d', time()); ?>"/>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(function () {
                    $('#datetimepicker1').datetimepicker({
                        pickTime: false
                    });
                });
            </script>

            <div class="form-group">
                <label class="col-sm-3 control-label">Publisher :</label>
                <div class="col-sm-9">
                    <input type="text" id="publisher" name="publisher" class="form-control" value="<?php echo $publisher; ?>" maxlength="30"/>
                </div>                        
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label"></div>
                <div class="col-sm-9">

                    <?php
                    $male_checked = "";
                    $female_checked = '';

                    if ($gender == 'DVD') {
                        $female_checked = "checked";
                    } else {
                        $male_checked = "checked";
                    }
                    ?>
                    <div class="radio-inline">
                        <label>
                            <input type="radio" name="cd_dvd" id="optcd" value="CD" <?php echo $male_checked; ?>>
                            CD
                        </label>
                    </div>
                    <div class="radio-inline">
                        <label>
                            <input type="radio" name="cd_dvd" id="optdvd" value="DVD" <?php echo $female_checked; ?>>
                            DVD
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">File :</label>
                <div class="col-sm-9">
                    <img id="albumpreview" src="<?php echo "files/images/" . $filename; ?>" width="100px" height="100px" />
                    <label id="album_file_name"></label>
                    <!--<input type="file" id="album" name="album" size="40"/>-->
                    <br/><br/>
                    <button id="btn_upload_album" name="btn_upload_photo" class="btn btn-info">Upload album cover</button>
                    <input type="hidden" name="uploadedalbum" id="uploadedalbum" value="<?php echo $filename; ?>"></input>
                </div>
            </div>      

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" name="submitted" class="btn btn-default btn-primary" onclick="return userInputValidate();">Save</button>
                    <button type="reset" name="reset"  class="btn btn-default">Reset</button>
                </div>
            </div>

        </form>
    </div> 
</div>                    

<?php include ('includes/footer.php'); ?>

<script type="text/javascript">
    $(document).ready(function(){
        $("#album").validate({
            rules: {
                title: 
                    {
                    required: true
                },
                publisher: 
                    {
                    required: true
                },                
            },
            //set messages to appear inline
            messages: 
                {
                title: "Please enter album title.",
                publisher: "Please enter publisher(s).",                  
            }
        });
    });          
</script>

<script type="text/javascript" src="js/ajaxupload.js"></script>
<script type="text/javascript">
        
    $(document).ready(function(){                          
        //Work only in "new" mode           
        var albumPreview = $('#albumpreview'); //id of the preview image
        new AjaxUpload('btn_upload_album', {
            action: 'savefile.php?filetype=image', //the php script that receives and saves the image
            name: 'image', //The saveimagephp will find the image info in the variable $_FILES['image']
            onSubmit: function(file, extension) {
                albumPreview.show();
                albumPreview.attr('src', 'ajaxSpinner.gif'); //replace the image SRC with an animated GIF with a 'loading...' message 
            },
            onComplete: function(file, response) {
                albumPreview.load(function(){
                    albumPreview.unbind();
                });
                //albumPreview.hide();
                //photoPreview.attr('src', response); //make the preview image display the uploaded file
                $('#album_file_name').html(response);
                $('#albumpreview').attr('src','files/images/' + response);
                $('#uploadedalbum').val(response); //drop the path to the file into the hidden field
            }
        }); 
                 
    });
</script>