<?php include('includes/includefiles.php'); ?>
<?php require_once('includes/albumHelper.php'); ?>

<link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    #templatemo_content{
        float:none;
        width:100% !important;
    }

    .dataTables_wrapper {
        margin: 0 auto;
        width: 100%;
    }    
    
    .action-column{
        width:200px;
    }
</style>

<?php

if (isset($_GET['action'])){
    if ($_GET['action']=='delete'){
        $sql="DELETE FROM `albums` WHERE album_id='" . $_GET['album_id'] . "'";
        
        mysql_query($sql) or die(mysql_error());
        
        messageHelper::setMessage("Album is successfully deleted.", MESSAGE_TYPE_SUCCESS);
        header("Location:albums-display.php");
        exit();
    }
}
?>

<?php include('includes/header.php'); ?>               

<div class="row">
    <div class="col-md-12">

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
                <?php $albumData = albumHelper::selectAll(); ?>
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

<br/>

<?php if ($objLogIn->isAdminLogIn() == true) { ?>
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="album.php" class="btn btn-primary">Add New Album</a>
        </div>
    </div>
<?php } ?>

<?php include ('includes/footer.php'); ?>

<script type="text/javascript" src="js/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#album_table').dataTable( {
            //"sPaginationType": "bootstrap",
            "sPaginationType": "full_numbers",
            "bLengthChange": false,
            "bFilter": true,
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