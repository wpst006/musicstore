<?php include ('includes/includefiles.php'); ?>
<?php require_once ('includes/albumHelper.php'); ?>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'delete') {
        $packageTour_sql = "DELETE FROM albums WHERE album_id='" . $_GET['album_id'] . "'";

        mysql_query($packageTour_sql) or die(mysql_error());
        //*********************************************************************
        messageHelper::setMessage("You have successfully deleted a album.", MESSAGE_TYPE_SUCCESS);
        header("Location:albums-display.php");
        exit();
    }
}

if (isset($_POST['submitted'])) {

    if (isset($_POST['searchKey'])) {
        $searchKey = $_POST['searchKey'];
    }

    $albumData = albumHelper::searchAlbum($searchKey);
} else {
    $albumData = albumHelper::selectAll();
}
?>
<?php $pageTitle = "Albums Display"; ?>
<?php include ('includes/header.php'); ?>

<link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

<style>
    #album_table{
        width:100%;
        border-top: solid 2px #0075c5; 
    }

    #album_table tr td{
        /*border: solid 1px #0075c5;*/
        padding-bottom: 10px;
    }

    .album-item{
        width:33%;
        float:left;
        text-align: center;
    }

    .album-item .title{
        color: #0075c5;
        margin-bottom: 0px;
        padding-bottom: 0px;
    }
    
    .album-wrapper{
        border-bottom: solid 2px #0075c5;  
        padding-bottom:10px;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <form class="form-inline" id="search" name="search" action="albums-display.php" method="post" role="form" >
            <div class="form-group">
                <label class="sr-only" for="exampleInputEmail2">albums :</label>
                <input type="text" id="searchKey" name="searchKey" class="form-control" value="<?php echo isset($_POST['searchKey']) ? $_POST['searchKey'] : "" ?>" maxlength="30" placeholder="Search"/>
            </div>
            <div class="form-group btn-row">
                <button type="submit" name="submitted" class="btn btn-default btn-success my-btn">Search</button>
                <?php
                $link = "export-albums.php";

                if (isset($_POST['searchKey']) || isset($fromDate) || isset($toDate)) {
                    $link.="?searchKey=" . $_POST['searchKey'];
                }
                ?>
                <a href="<?php echo $link; ?>" target="_blank" class="btn btn-default btn-success my-btn">Print</a>
            </div>

        </form>
        <br/>

        <table id="album_table">
            <thead>
                <tr>
                    <th></th>                    
                </tr>
            </thead>
            <tbody>
                <?php $objLogIn = new logIn; ?>
                <?php for ($i = 0; $i < count($albumData); $i+=3) { ?>
                    <tr>
                        <td>
                            <div class="album-wrapper clearfix">
                                <?php for ($j = $i; $j < $i + 3; $j++) { ?>
                                    <div class="album-item">
                                        <?php if (array_key_exists($j, $albumData)) { ?>                                
                                            <p class="title"><?php echo $albumData[$j]['title']; ?></p>
                                            <img src="<?php echo 'files/images/' . $albumData[$j]['filename']; ?>" width="150" height="150"/><br/>
                                            <?php
                                            $link = '';

                                            if ($objLogIn->isAdminLogIn() == true) {
                                                ?>
                                                <a href="album.php?album_id=<?php echo $albumData[$j]['album_id']; ?>">Edit</a>&nbsp;
                                                <a href="albums-display.php?album_id=<?php echo $albumData[$j]['album_id']; ?>&action=delete" class="delete-link">Delete</a><br/>
                                                <a href="song-display.php?album_id=<?php echo $albumData[$j]['album_id']; ?>">View Song</a>
                                            <?php } else if ($objLogIn->isMemberLogIn()) { ?>
                                                <a href="song-display.php?album_id=<?php echo $albumData[$j]['album_id']; ?>">View Song</a>
                                            <?php }//end of outer for loop ?>
                                        <?php } //end of "if" ?>
                                    </div>
                                <?php }//end of inner for loop ?>                            
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-md-12 text-right">
        <a href="top10songs-display.php" class="btn btn-info btn-block">View Top 10 Songs</a>
        <?php if ($objLogIn->isAdminLogIn() == true) { ?>
            <a href="album.php" class="btn btn-primary btn-block">Add New Album</a>
        <?php } ?>        
    </div>
</div>

<script type="text/javascript" src="js/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        //        $('#album_table').dataTable( {
        //            //"sPaginationType": "bootstrap",
        //            "sPaginationType": "full_numbers",
        //            "bLengthChange": false,
        //            "bFilter": false,
        //            "bInfo": false,
        //        } );
        
        $( ".delete-link" ).click(function( event ) {
            if (window.confirm("Are you sure want to delete the album?")==true){
                return true;
            }else{
                event.preventDefault();
                return false;
            }
        });
    });
</script>

<?php include ('includes/footer.php'); ?>