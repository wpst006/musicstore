<?php include("includes/includefiles.php"); ?>    
<?php require_once("includes/authorHelper.php"); ?>    

<?php
$album_id =null;
$song_id=null;
$title = '';
$filename = '';
$unitprice = 0.0;
$artist_ids_string = '';
$author_ids_string = '';
$song_type_selected='';
$length = '';

if (isset($_POST['submitted'])) {
    if (isset($_POST['song_id'])) {
        updateSong($album_id);
    } else {
        saveNewSong($album_id);
    }
} else {

    $album_id=$_GET['album_id'];
    
    if (isset($_GET['song_id'])) {
        $song_id=$_GET['song_id'];
        fillDataForEditMode($song_id, $title, $length,$song_type,$unitprice, $filename, $artist_ids_string,$author_ids_string,$song_type_selected);
    }
}

function saveNewSong(&$song_id) {
    //Filling Data
    $song_id = autoID::getAutoID('songs', 'song_id', 'SNG_', 6);
    $album_id=$_POST['album_id'];
    $title = $_POST['title'];
    $length=$_POST['length'];
    $song_type=$_POST['song_type'];    
    $artist_id_Array = $_POST['artist_id'];
    $author_id_Array = $_POST['author_id'];
    $uploadedsong = $_POST['uploadedsong'];
    $unitprice = $_POST['unitprice'];
    //******************************************************************************************************************
    date_default_timezone_set(DEFAULT_TIMEZONE);
    //"songs" Table Insert
    $songInsert_sql = "INSERT INTO " .
            "`songs` (song_id,title,length,album_id,song_type,filename,unitprice,vote_count) " .
            "VALUES('$song_id','$title','$length','$album_id','$song_type','$uploadedsong',$unitprice,0)";

    mysql_query($songInsert_sql) or die(mysql_error());
    //******************************************************************************************************************
    //"artists_songs" Table Insert
    for ($i = 0; $i < count($artist_id_Array); $i++) {
        $artist_songs_Insert_sql = "INSERT INTO " .
                "`artists_songs`(artist_id,song_id) " .
                "VALUES('$artist_id_Array[$i]','$song_id')";

        mysql_query($artist_songs_Insert_sql) or die(mysql_error());
    }
    //******************************************************************************************************************
    //"authors_songs" Table Insert
    for ($i = 0; $i < count($author_id_Array); $i++) {
        $author_songs_Insert_sql = "INSERT INTO " .
                "`authors_songs`(author_id,song_id) " .
                "VALUES('$author_id_Array[$i]','$song_id')";

        mysql_query($author_songs_Insert_sql) or die(mysql_error());
    }
    //******************************************************************************************************************
    messageHelper::setMessage("Song is successfully saved with Song ID : " . $song_id, MESSAGE_TYPE_SUCCESS);
    header("Location:song-display.php?album_id=". $album_id);
    exit();
}

function updateSong(&$song_id) {
    //Filling Data
    $song_id = $_POST['song_id'];
    $album_id=$_POST['album_id'];
    $title = $_POST['title'];
    $length=$_POST['length'];
    $song_type=$_POST['song_type'];  
    $artist_id_Array = $_POST['artist_id'];
    $author_id_Array = $_POST['author_id'];
    $unitprice = $_POST['unitprice'];       
    //******************************************************************************************************************
    //"songs" Table Update
    $songUpdate_sql = "UPDATE `songs` SET " .
            "title='" . $title . "'," .
            "length='" . $length . "'," .
            "song_type='" . $song_type . "'," .
            "unitprice=" . $unitprice . " " .
            "WHERE song_id='" . $song_id . "'";

    mysql_query($songUpdate_sql) or die(mysql_error());
    //******************************************************************************************************************
    //"artists_songs" Table Clear
    $artist_songs_Delete_sql = "DELETE FROM `artists_songs` " .
            "WHERE `song_id`='" . $song_id . "'";

    mysql_query($artist_songs_Delete_sql) or die(mysql_error());
    //"artists_songs" Table Insert
    for ($i = 0; $i < count($artist_id_Array); $i++) {
        $artist_songs_Insert_sql = "INSERT INTO " .
                "`artists_songs`(artist_id,song_id) " .
                "VALUES('$artist_id_Array[$i]','$song_id')";

        mysql_query($artist_songs_Insert_sql) or die(mysql_error());
    }
    //******************************************************************************************************************
    //"authors_songs" Table Clear
    $author_songs_Delete_sql = "DELETE FROM `authors_songs` " .
            "WHERE `song_id`='" . $song_id . "'";

    mysql_query($author_songs_Delete_sql) or die(mysql_error());
    //"authors_songs" Table Insert
    for ($i = 0; $i < count($author_id_Array); $i++) {
        $author_songs_Insert_sql = "INSERT INTO " .
                "`authors_songs`(author_id,song_id) " .
                "VALUES('$author_id_Array[$i]','$song_id')";

        mysql_query($author_songs_Insert_sql) or die(mysql_error());
    }
    //******************************************************************************************************************
    messageHelper::setMessage("Song is successfully saved with Song ID : " . $song_id, MESSAGE_TYPE_SUCCESS);
    header("Location:song-display.php?album_id=". $album_id);
    exit();
}

function fillDataForEditMode($song_id, &$title, &$length,&$song_type,&$unitprice, &$filename, &$artist_ids_string,&$author_ids_string,&$song_type_selected){

    $song_sql = "SELECT * FROM `songs` " .
            "WHERE song_id='" . $song_id . "'";
    $song_result = mysql_query($song_sql) or die(mysql_error());

    $song_noOfRow = mysql_num_rows($song_result);

    if ($song_noOfRow == 0) {
        die("There is no matching sound for Song ID : " . $song_id);
    }

    while ($song_row = mysql_fetch_array($song_result)) {
        $title = $song_row['title'];
        $length=$song_row['length'];
        $song_type_selected=$song_row['song_type'];
        $unitprice = $song_row['unitprice'];
        $filename = $song_row['filename'];        
    }
    //******************************************************************************************************************
    $artists_songs_sql = "SELECT * FROM `artists_songs` " .
            "WHERE song_id='" . $song_id . "'";
    $artists_songs_result = mysql_query($artists_songs_sql) or die(mysql_error());

    $artists_songs_noOfRow = mysql_num_rows($artists_songs_result);

    if ($artists_songs_noOfRow == 0) {
        die("There is no matching sound for Song ID : " . $song_id);
    }

    while ($artists_songs_row = mysql_fetch_array($artists_songs_result)) {
        $artist_ids_string .= $artists_songs_row['artist_id'] . ',';
    }
    //Remove last "comma" from the string
    $artist_ids_string = rtrim($artist_ids_string, ',');
    //******************************************************************************************************************
    $authors_songs_sql = "SELECT * FROM `authors_songs` " .
            "WHERE song_id='" . $song_id . "'";
    $authors_songs_result = mysql_query($authors_songs_sql) or die(mysql_error());

    $authors_songs_noOfRow = mysql_num_rows($authors_songs_result);

    if ($authors_songs_noOfRow == 0) {
        die("There is no matching sound for Song ID : " . $song_id);
    }
    
    while ($authors_songs_row = mysql_fetch_array($authors_songs_result)) {
        $author_ids_string .= $authors_songs_row['author_id'] . ',';
    }
    //Remove last "comma" from the string
    $author_ids_string = rtrim($author_ids_string, ',');
    //******************************************************************************************************************
}
?>

<?php $pageTitle="song"; ?>
<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <form role="form" id="songs" name="songs" action="songs.php" method="post" class="form-horizontal">

            <div class="form-group">
                <label class="col-sm-3 control-label">Album ID :</label>
                <div class="col-sm-9">
                    <p class="form-control-static"><?php echo $album_id; ?></p>                                    
                    <input type="hidden" id="album_id" name="album_id" value="<?php echo $album_id; ?>"/>
                </div>                            
            </div>

            <?php if (isset($song_id)) { ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Song ID :</label>
                    <div class="col-sm-9">
                        <p class="form-control-static"><?php echo $song_id; ?></p>                                    
                        <input type="hidden" id="song_id" name="song_id" value="<?php echo $song_id; ?>"/>
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
                <label class="col-sm-3 control-label">Length :</label>
                <div class="col-sm-9">
                    <input type="text" id="length" name="length" class="form-control" value="<?php echo $length; ?>" maxlength="30"/>
                </div>                        
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Song Type :</label>
                <div class="col-sm-9">                            
                    <select id="song_type" name="song_type" class="chosen-select" data-placeholder="Select Song Type ...">
                        <option>Rock</option>
                        <option>Pop</option>
                        <option>Rap</option>
                    </select>    
                    <input type="hidden" id="song_type_selected" name="song_type_selected" value="<?php echo $song_type_selected; ?>" />
                </div>                            
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Artist(s) :</label>
                <div class="col-sm-9">
                    <?php
                    $sql = "SELECT artist_id,title FROM artists " .
                            "ORDER BY title";
                    $result = mysql_query($sql) or die(mysql_error());
                    ?>
                    <select id="artist_id" name="artist_id[]" class="chosen-select" multiple="true" data-placeholder="Choose artist(s) ...">
                        <?php while ($row = mysql_fetch_array($result)) { ?>
                            <option value="<?php echo $row['artist_id']; ?>"><?php echo $row['title']; ?></option>
                        <?php } ?>
                    </select>
                    <input type="hidden" id="artist_ids_string" name="artist_ids_string" value="<?php echo $artist_ids_string; ?>" />
                </div>                            
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Author(s) :</label>
                <div class="col-sm-9">
                    <?php
                    $authorData = authorHelper::selectAll();
                    ?>
                    <select id="author_id" name="author_id[]" class="chosen-select" multiple="true" data-placeholder="Choose author(s) ...">
                        <?php foreach ($authorData as $row) { ?>
                            <option value="<?php echo $row['author_id']; ?>"><?php echo $row['authorname']; ?></option>
                        <?php } ?>
                    </select>
                    <input type="hidden" id="author_ids_string" name="author_ids_string" value="<?php echo $author_ids_string; ?>" />
                </div>                            
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">File :</label>
                <div class="col-sm-9">
                    <?php if (!isset($song_id)) { ?>
                        <img id="songpreview" src="" width="100px" height="100px" />
                        <label id="song_file_name"></label>
                        <!--<input type="file" id="song" name="song" size="40"/>-->
                        <button id="btn_upload_song" name="btn_upload_photo" class="btn btn-info">Upload Song</button>
                        <input type="hidden" name="uploadedsong" id="uploadedsong"></input>
                    <?php } else { ?>
                        <?php echo $filename; ?>
                    <?php } ?>
                </div>
            </div>      


            <!--                    <div class="form-group">
                                    <label></div>
                                    <div class="form-control">
                                        <img id="photopreview" src="" width="100px" height="100px" />
                                        <input type="file" id="photo" name="photo" size="40"/>
                                        <button id="btn_upload_photo" name="btn_upload_photo">Upload Photo</button>
                                        <input type="hidden" name="uploadedphoto" id="uploadedphoto"></input>
                                    </div>
                                </div>                  -->

            <div class="form-group">
                <label class="col-sm-3 control-label">Unit Price :</label>
                <div class="col-sm-9">
                    <input type="text" id="unitprice" name="unitprice" class="form-control" value="<?php echo $unitprice; ?>" maxlength="30"/>
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
        $(".chosen-select").chosen({width: "95%"}); 
        
        if ($('#song_id').length>0){
            var artist_ids_string=$('#artist_ids_string').val();
            var temp=artist_ids_string.split(",");
            var artistIDArray=new Array();
            
            for (var i=0;i<temp.length;i++){
                artistIDArray.push(temp[i]);
            }
            
            $('#artist_id').val(artistIDArray);
            $("#artist_id").trigger("chosen:updated");
            //******************************************************************************************************************
            var author_ids_string=$('#author_ids_string').val();
            var temp=author_ids_string.split(",");
            var authorIDArray=new Array();
            
            for (var i=0;i<temp.length;i++){
                authorIDArray.push(temp[i]);
            }
            
            $('#author_id').val(authorIDArray);
            $("#author_id").trigger("chosen:updated");
            
            $("#song_type").val($('#song_type_selected').val());
            $("#song_type").trigger("chosen:updated");
        }
    });
        
    function userInputValidate(){
        if (pluginValidation()==false){
            return false;
        }
        
        if ($('#artist_id').val()==null){
            alert("Please select the artist(s).");
            return false;
        }
        
        if ($('#author_id').val()==null){
            alert("Please select the author(s).");
            return false;
        }
        
        //Check only for "new" mode
        if ($('#song_id').length==0){
            if ($('#uploadedsong').val()==''){
                alert("Please upload the song.");
                return false;
            }
        }
        
        return true;
    }
    
    function pluginValidation(){
        $.validator.addMethod("priceCheck", function (value, element) {
        
            var price=$('#price').val();
        
            if (parseFloat(price)<=0){
                return false;
            }else{
                return true;
            }
        }, 'Price must be greater than 0.');
    
        $("#songs").validate({
            rules: {
                title: 
                    {
                    required: true
                },
                length: 
                    {
                    required: true
                },
                song_type: 
                    {
                    required: true
                },
                unitprice: 
                    {
                    required: true,
                    number: true,
                    priceCheck: true
                },
            },
            //set messages to appear inline
            messages: 
                {
                title: "Please enter song title.",
                length: "Please select length.",
                song_type: "Please select song type.",
                unitprice: 
                    {
                    required: "Please enter price.",
                    number: "Please enter valid number for price.",
                    priceCheck: "Please enter valid number for price.",
                },                      
            }
        });
        if ($('#songs').valid()){            
            return true;
        }else{
            return false;
        } 
    }        
    
    
</script>

<script type="text/javascript" src="js/ajaxupload.js"></script>
<script type="text/javascript">
        
    $(document).ready(function(){
        //        var photoPreview = $('#photopreview'); //id of the preview image
        //        new AjaxUpload('btn_upload_photo', {
        //            action: 'savefile.php?filetype=image', //the php script that receives and saves the image
        //            name: 'image', //The saveimagephp will find the image info in the variable $_FILES['image']
        //            onSubmit: function(file, extension) {
        //                photoPreview.attr('src', 'ajaxSpinner.gif'); //replace the image SRC with an animated GIF with a 'loading...' message 
        //            },
        //            onComplete: function(file, response) {
        //                photoPreview.load(function(){
        //                    photoPreview.unbind();
        //                });
        //                photoPreview.attr('src','files/images/' +  response); //make the preview image display the uploaded file
        //                $('#uploadedphoto').val(response); //drop the path to the file into the hidden field
        //            }
        //        });                       
        
        //Work only in "new" mode
        if ($('#song_id').length==0){            
            var songPreview = $('#songpreview'); //id of the preview image
            new AjaxUpload('btn_upload_song', {
                action: 'savefile.php?filetype=song', //the php script that receives and saves the image
                name: 'song', //The saveimagephp will find the image info in the variable $_FILES['image']
                onSubmit: function(file, extension) {
                    songPreview.show();
                    songPreview.attr('src', 'ajaxSpinner.gif'); //replace the image SRC with an animated GIF with a 'loading...' message 
                },
                onComplete: function(file, response) {
                    songPreview.load(function(){
                        songPreview.unbind();
                    });
                    songPreview.hide();
                    //photoPreview.attr('src', response); //make the preview image display the uploaded file
                    $('#song_file_name').html(response);
                    $('#uploadedsong').val(response); //drop the path to the file into the hidden field
                }
            }); 
        }                     
    });
</script>