<?php include("includes/includefiles.php"); ?>    
<?php require_once("includes/songHelper.php"); ?>    
<?php require_once("includes/voteHelper.php"); ?> 

<?php
$album_id = null;
$title = '';

$objLogIn = new logIn;
$loggedInData = $objLogIn->getLoggedInData();
$member_id = $loggedInData['user_id'];


if (isset($_POST['submitted'])) {
    $status = saveVote($member_id);

    if ($status == true) {
        messageHelper::setMessage("You voted for : " . $_POST['title'], MESSAGE_TYPE_SUCCESS);
        header("Location:song-display.php?album_id=" . $_POST['album_id']);
        exit();
    }
} else {

    if (isset($_GET['song_id'])) {
        $song_id = $_GET['song_id'];
        $album_id = $_GET['album_id'];

        if (voteHelper::isMemberAlreadyVote($song_id, $member_id) == true) {
            messageHelper::setMessage("You already voted for the song.", MESSAGE_TYPE_INFO);
            header("Location:song-display.php?album_id=" . $album_id);
            exit();
        }

        fillDataForEditMode($song_id, $title);
    }
}

function saveVote($member_id) {

    //  var_dump($_POST);exit();
    //Filling Data
    $vote_id = autoID::getAutoID('votes', 'vote_id', 'VOT_', 6);
    $vote_date = $_POST['vote_date'];

    $song_id = $_POST['song_id'];
    $messagedetails = $_POST['messagedetails'];
    //******************************************************************************************************************    
    //"votes" Table Insert
    $voteInsert_sql = "INSERT INTO " .
            "`votes` (vote_id,vote_date,member_id,song_id,messagedetails) " .
            "VALUES('$vote_id','$vote_date','$member_id','$song_id','$messagedetails')";

    mysql_query($voteInsert_sql) or die(mysql_error());
    //******************************************************************************************************************
    //"songs" Table Update
    $songUpdate_sql = "Update " .
            "`songs` " .
            "SET vote_count=vote_count+1 " .
            "WHERE song_id='" . $song_id . "'";

    mysql_query($songUpdate_sql) or die(mysql_error());
    //******************************************************************************************************************

    return true;
}

function fillDataForEditMode($song_id, &$title) {
    $songData = songHelper::getSongBySongID($song_id);
    $title = $songData[0]['title'];
}
?>

<?php $pageTitle = "Vote" ?>
<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <form role="form" id="album" name="vote" action="votes.php" method="post" class="form-horizontal">

            <?php if (isset($song_id)) { ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Song ID :</label>
                    <div class="col-sm-9">
                        <p class="form-control-static"><?php echo $song_id; ?></p>                                    
                        <input type="hidden" id="song_id" name="song_id" value="<?php echo $song_id; ?>"/>
                        <input type="hidden" id="album_id" name="album_id" value="<?php echo $album_id; ?>"/>
                    </div>                            
                </div>
            <?php } ?>

            <div class="form-group">
                <label class="col-sm-3 control-label">Title :</label>
                <div class="col-sm-9">
                    <p class="form-control-static"><?php echo $title; ?></p>  
                    <input type="hidden" id="title" name="title" value="<?php echo $title; ?>"/>
                </div>                            
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Vote Date :</div>
                <div class="col-sm-9">
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='text' id="vote_date" name="vote_date" class="form-control" data-format="YYYY-MM-DD" value="<?php echo date('Y-m-d', time()); ?>"/>
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
                <label class="col-sm-3 control-label">Message Details :</label>
                <div class="col-sm-9">
                    <textarea cols="40" rows="5" name="messagedetails" id="messagedetails">
                    </textarea>
                </div>                        
            </div>            

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" name="submitted" class="btn btn-default btn-primary" onclick="return userInputValidate();">Vote</button>
                    <button type="reset" name="reset"  class="btn btn-default">Reset</button>
                </div>
            </div>

        </form>
    </div> 
</div>                    

<?php include ('includes/footer.php'); ?>

<script type="text/javascript">
    $(document).ready(function(){
        $("#vote").validate({
            rules: {
                messagedetails: 
                    {
                    required: true
                },                
            },
            //set messages to appear inline
            messages: 
                {
                messagedetails: "Please enter message.",                
            }
        });
    });          
</script>