<?php include ('includes/includefiles.php'); ?>
<?php require_once ('includes/awardHelper.php'); ?>

<style>
    #templatemo_sidebar{
        display:none;
    }

    #templatemo_content {
        width: 100% !important;
    }
</style>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'delete') {
        $packageTour_sql = "DELETE FROM awards WHERE award_id='" . $_GET['award_id'] . "'";

        mysql_query($packageTour_sql) or die(mysql_error());
        //*********************************************************************
        messageHelper::setMessage("You have successfully deleted the award.", MESSAGE_TYPE_SUCCESS);
        header("Location:award-display.php");
        exit();
    }
}

//if (isset($_POST['submitted'])) {
//
//    if (isset($_POST['searchKey'])) {
//        $searchKey = $_POST['searchKey'];
//    }
//
//    $data = memberHelper::searchmember($searchKey);
//} else {
//    $data = memberHelper::selectAll();
//}

$data = awardHelper::selectAll();
?>
<?php $pageTitle = "Award Display"; ?>
<?php include ('includes/header.php'); ?>

<link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

<div class="row">
    <div class="col-md-12">     
        <table id="award-table">
            <thead>
            <th>Award ID</th>
            <th>Award Year</th>
            <th>Vote Count</th>
            <th>Song ID</th>
            <th>Title</th>
            <th></th>
            </thead>
            <tbody>
                <?php foreach ($data as $row) { ?>
                    <tr>
                        <td><?php echo $row['award_id']; ?></td>
                        <td><?php echo $row['award_year']; ?></td>                        
                        <td><?php echo $row['vote_count']; ?></td>
                        <td><?php echo $row['song_id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td class="text-right">
                            <a href="award-display.php?award_id=<?php echo $row['award_id']; ?>&action=delete" class="delete-link">Delete</a>
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
        $('#award-table').dataTable( {
            //"sPaginationType": "bootstrap",
            "sPaginationType": "full_numbers",
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
        });

        $( ".delete-link" ).click(function( event ) {
            if (window.confirm("Are you sure want to delete the award?")==true){
                return true;
            }else{
                event.preventDefault();
                return false;
            }
        });
    });
</script>

<?php include ('includes/footer.php'); ?>