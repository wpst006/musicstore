<?php include ('includes/includefiles.php'); ?>
<?php require_once ('includes/albumHelper.php'); ?>

<style>

</style>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'delete') {
        $packageTour_sql = "DELETE FROM albums WHERE albums_id='" . $_GET['member_id'] . "'";

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
<?php $pageTitle = "albums Display"; ?>
<?php include ('includes/header.php'); ?>

<link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

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
                    <th class="title-column">Album ID</th>
                    <th class="artist-column">Title</th>
                    <th class="price-column">Publishing Date</th>
                    <th class="downloaded-count-column">Publisher</th>
                    <th class="downloaded-count-column">Type</th>
                    <th class="action-column"></th>
                </tr>
            </thead>
            <tbody>
                <?php $objLogIn = new logIn; ?>
                <?php foreach ($albumData as $row) { ?>
                    <tr>
                        <td class="title-column"><?php echo $row['album_id']; ?></td>
                        <td class="title-column"><?php echo $row['title']; ?></td>
                        <td class="artist-column"><?php echo $row['publishing_date']; ?></td>
                        <td class="price-column"><?php echo $row['publisher']; ?></td>
                        <td class="price-column"><?php echo $row['cd_dvd']; ?></td>
                        <td class="action-column">
                            <?php
                            $link = '';

                            if ($objLogIn->isAdminLogIn() == true) {
                            ?>
                            <a href="album.php?album_id=<?php echo $row['album_id']; ?>">Edit</a>&nbsp;
                            <a href="albums-display.php?album_id=<?php echo $row['album_id']; ?>&action=delete" class="delete-link">Delete</a>&nbsp;
                            <a href="song-display.php?album_id=<?php echo $row['album_id']; ?>">View Song</a>
                            <?php }else if ($objLogIn->isMemberLogIn()){ ?>
                                <a href="song-display.php?album_id=<?php echo $row['album_id']; ?>">View Song</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript" src="js/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#album_table').dataTable( {
            //"sPaginationType": "bootstrap",
            "sPaginationType": "full_numbers",
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
        } );
        
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