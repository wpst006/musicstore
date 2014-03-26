<?php include("includes/includefiles.php"); ?>    
<?php require_once("includes/songHelper.php"); ?>    
<?php require_once("includes/voteHelper.php"); ?> 

<?php
if (isset($_POST['submitted'])) {
    $status = saveAward();

    if ($status == true) {
        messageHelper::setMessage("Your award has been saved.", MESSAGE_TYPE_SUCCESS);
        header("Location:award-display.php");
        exit();
    }
} else {

    if (isset($_GET['song_id'])) {
        $song_id = $_GET['song_id'];

        fillDataForEditMode($song_id, $title,$vote_count);
    }
}

function saveAward($member_id) {

    //  var_dump($_POST);exit();
    //Filling Data
    $award_id = autoID::getAutoID('awards', 'award_id', 'AWD_', 6);
    $award_year = $_POST['award_year'];
    $vote_count=$_POST['vote_count'];
    $song_id = $_POST['song_id'];
    //******************************************************************************************************************    
    //"awards" Table Insert
    $awardInsert_sql = "INSERT INTO " .
            "`awards` (award_id,award_year,vote_count,song_id) " .
            "VALUES('$award_id','$award_year','$vote_count','$song_id')";

    mysql_query($awardInsert_sql) or die(mysql_error());
    //******************************************************************************************************************

    return true;
}

function fillDataForEditMode($song_id, &$title,&$vote_count) {
    $songData = songHelper::getSongBySongID($song_id);
    $title = $songData[0]['title'];
    $vote_count=$songData[0]['vote_count'];
}
?>

<?php $pageTitle = "Awards" ?>
<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <form role="form" id="album" name="awards" action="awards.php" method="post" class="form-horizontal">

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
                    <p class="form-control-static"><?php echo $title; ?></p>  
                    <input type="hidden" id="title" name="title" value="<?php echo $title; ?>"/>
                </div>                            
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Vote Count :</label>
                <div class="col-sm-9">
                    <p class="form-control-static"><?php echo $vote_count; ?></p>  
                    <input type="hidden" id="vote_count" name="vote_count" value="<?php echo $vote_count; ?>"/>
                </div>                            
            </div>
            
            <div class="form-group">
                <div class="col-sm-3 control-label">Award Date :</div>
                <div class="col-sm-9">
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='text' id="award_year" name="award_year" class="form-control" data-format="YYYY-MM-DD" value="<?php echo date('Y-m-d', time()); ?>"/>
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
//    $(document).ready(function(){
//        $("#awards").validate({
//            rules: {
//                messagedetails: 
//                    {
//                    required: true
//                },                
//            },
//            //set messages to appear inline
//            messages: 
//                {
//                messagedetails: "Please enter message.",                
//            }
//        });
//    });          
</script>