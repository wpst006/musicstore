<?php include ('includes/includefiles.php'); ?>
<?php require_once ('includes/memberHelper.php'); ?>

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
        $packageTour_sql = "DELETE FROM members WHERE member_id='" . $_GET['member_id'] . "'";

        mysql_query($packageTour_sql) or die(mysql_error());
        //*********************************************************************
        messageHelper::setMessage("You have successfully deleted a member.", MESSAGE_TYPE_SUCCESS);
        header("Location:member-display.php");
        exit();
    }
}

if (isset($_POST['submitted'])) {

    if (isset($_POST['searchKey'])) {
        $searchKey = $_POST['searchKey'];
    }

    $data = memberHelper::searchmember($searchKey);
} else {
    $data = memberHelper::selectAll();
}
?>
<?php $pageTitle = "Member Display"; ?>
<?php include ('includes/header.php'); ?>

<link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

<div class="row">
    <div class="col-md-12">
        <form class="form-inline" id="search" name="search" action="member-display.php" method="post" role="form" >
            <div class="form-group">
                <label class="sr-only" for="exampleInputEmail2">member :</label>
                <input type="text" id="searchKey" name="searchKey" class="form-control" value="<?php echo isset($_POST['searchKey']) ? $_POST['searchKey'] : "" ?>" maxlength="30" placeholder="Search"/>
            </div>
            <div class="form-group btn-row">
                <button type="submit" name="submitted" class="btn btn-default btn-success my-btn">Search</button>
                <?php
                $link = "export-member.php";

                if (isset($_POST['searchKey']) || isset($fromDate) || isset($toDate)) {
                    $link.="?searchKey=" . $_POST['searchKey'];
                }
                ?>
                <a href="<?php echo $link; ?>" target="_blank" class="btn btn-default btn-success my-btn">Print</a>
            </div>

        </form>
        <br/>

        <table id="member-table">
            <thead>
            <th>member ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>DOB</th>
            <th>Phone No</th>
            <th>Contact Email</th>
            <th>Country</th>
            <th>Zip Code</th>
            <th></th>
            </thead>
            <tbody>
                <?php foreach ($data as $row) { ?>
                    <tr>
                        <td><?php echo $row['member_id']; ?></td>
                        <td><?php echo $row['firstname']; ?></td>                        
                        <td><?php echo $row['lastname']; ?></td>
                        <td><?php echo $row['DOB']; ?></td>
                        <td><?php echo $row['contact_phone']; ?></td>
                        <td><?php echo $row['contact_email']; ?></td>
                        <td><?php echo $row['country']; ?></td>
                        <td><?php echo $row['zipcode']; ?></td>
                        <td class="text-right">
                            <a href="member-display.php?member_id=<?php echo $row['member_id']; ?>&action=delete" class="delete-link">Delete</a>
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
        $('#member-table').dataTable( {
            //"sPaginationType": "bootstrap",
            "sPaginationType": "full_numbers",
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
        });

        $( ".delete-link" ).click(function( event ) {
            if (window.confirm("Are you sure want to delete the member?")==true){
                return true;
            }else{
                event.preventDefault();
                return false;
            }
        });
    });
</script>

<?php include ('includes/footer.php'); ?>