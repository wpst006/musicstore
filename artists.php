<?php include("includes/includefiles.php"); ?>    
<?php require_once("includes/artistHelper.php"); ?>    

<?php
$artist_id = null;
$artistname = '';
$gender = '';

if (isset($_POST['submitted'])) {
    if (isset($_POST['artist_id'])) {        
        $status = updateArtist($artist_id);
    } else {
        $status = saveNewArtist($artist_id);
    }

    if ($status == true) {
        messageHelper::setMessage("Artist is successfully saved with Artist ID : " . $artist_id, MESSAGE_TYPE_SUCCESS);
        header("Location:artists-display.php");
        exit();
    }
} else {

    if (isset($_GET['artist_id'])) {
        $artist_id=$_GET['artist_id'];
        fillDataForEditMode($artist_id,$artistname,$gender) ;
    }
}

function saveNewArtist(&$artist_id) {
    //Filling Data
    $artist_id = autoID::getAutoID('artists', 'artist_id', 'ART_', 6);
    $artistname = $_POST['artistname'];
    $gender = $_POST['gender'];
    //******************************************************************************************************************    
    $sql = "INSERT INTO " .
            "`artists` (artist_id,artistname,gender) " .
            "VALUES('$artist_id','$artistname','$gender')";

    mysql_query($sql) or die(mysql_error());
    //******************************************************************************************************************
    
    return true;
}

function updateArtist(&$artist_id) {
    //Filling Data
    $artist_id = $_POST['artist_id'];
    $artistname = $_POST['artistname'];
    $gender = $_POST['gender'];
    //******************************************************************************************************************
    $sql = "UPDATE `artists` SET " .
            "artistname='" . $artistname . "'," .
            "gender='" . $gender . "' " .
            "WHERE artist_id='" . $artist_id . "'";

    mysql_query($sql) or die(mysql_error());
    //******************************************************************************************************************    

    return true;
}

function fillDataForEditMode($artist_id,&$artistname,&$gender) {
    $data=  artistHelper::getArtistByArtistID($artist_id);
    $artist_id=$data[0]['artist_id'];
    $artistname=$data[0]['artistname'];
    $gender=$data[0]['gender'];
}
?>

<?php $pageTitle="Artist" ?>
<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <form role="form" id="artists" name="artists" action="artists.php" method="post" class="form-horizontal">

            <?php if (isset($artist_id)) { ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Artist ID :</label>
                    <div class="col-sm-9">
                        <p class="form-control-static"><?php echo $artist_id; ?></p>                                    
                        <input type="hidden" id="artist_id" name="artist_id" value="<?php echo $artist_id; ?>"/>
                    </div>                            
                </div>
            <?php } ?>

            <div class="form-group">
                <label class="col-sm-3 control-label">Artist Name :</label>
                <div class="col-sm-9">
                    <input type="text" id="artistname" name="artistname" class="form-control" value="<?php echo $artistname; ?>" maxlength="30"/>
                </div>                        
            </div>            

            <div class="form-group">
                <div class="col-sm-3 control-label"></div>
                <div class="col-sm-9">
                    
                    <?php 
                    $male_checked="";
                    $female_checked='';
                    
                    if ($gender=='F'){ 
                          $female_checked="checked";
                    }else{
                        $male_checked="checked";
                    }
                    ?>
                    <div class="radio-inline">
                        <label>
                            <input type="radio" name="gender" id="optcd" value="M" <?php echo $male_checked; ?>>
                            Male
                        </label>
                    </div>
                    <div class="radio-inline">
                        <label>
                            <input type="radio" name="gender" id="optdvd" value="F" <?php echo $female_checked; ?>>
                            Female
                        </label>
                    </div>
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
        $("#artists").validate({
            rules: {
                artistname: 
                    {
                    required: true
                },               
            },
            //set messages to appear inline
            messages: 
                {
                artistname: "Please enter artist name.",
            }
        });
    });          
</script>