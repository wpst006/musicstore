<?php include('includes/includefiles.php'); ?>
<?php $pageTitle = "Purchase Display"; ?>
<?php include('includes/header.php'); ?>
<?php require_once ('includes/purchaseHelper.php'); ?>

<link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

<style>
    .my-search-panel{

    }    

    .my-btn{
        width:150px;
    }    

    .form-inline .form-group{
        margin-bottom:10px;
    }

    .btn-row{
        clear: both;
        margin-top: 10px;
        width: 100%;
    }
</style>

<?php
$member = null;
$fromDate = null;
$toDate = null;

if (isset($_POST['submitted'])) {

    if (isset($_POST['chkMemberFilter'])) {
        if (isset($_POST['member'])) {
            $member = $_POST['member'];
        }
    }

    if (isset($_POST['chkDateFilter'])) {
        $fromDate = $_POST['fromDate'];
        $toDate = $_POST['toDate'];
    }

    $purchaseData = purchaseHelper::getPurchase($fromDate, $toDate, $member);
} else {
    $purchaseData = purchaseHelper::getPurchase();
}
?>

<div class="row">
    <div class="col-md-12">
        <form class="form-inline" id="search" name="search" action="purchase-display.php" method="post" role="form" >
            <div class="form-group">
                <label class="" for="">From Date</label>
                <div class='input-group date' id='datetimepicker1'>                   
                    <input type='text' id="fromDate" name="fromDate" class="form-control" data-format="YYYY-MM-DD" value="<?php echo (isset($fromDate)) ? $fromDate : date('Y-m-d', time()); ?>"/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>                        
                </div>
            </div>
            <div class="form-group">
                <label class="" for="">To Date</label>
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' id="toDate" name="toDate" class="form-control" data-format="YYYY-MM-DD" value="<?php echo (isset($toDate)) ? $toDate : date('Y-m-d', time()); ?>"/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            <script type="text/javascript">
                $(function () {
                    $('#fromDate').datetimepicker({
                        pickTime: false
                    });
                    $('#toDate').datetimepicker({
                        pickTime: false
                    });
                });
            </script>
            <div class="form-group">
                <label class="" for="exampleInputEmail2">member :</label>
                <input type="text" id="member" name="member" class="form-control" value="<?php echo (isset($_POST['chkMemberFilter']) && isset($_POST['member'])) ? $_POST['member'] : "" ?>" maxlength="30"/>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="chkDateFilter" name="chkDateFilter" <?php echo (isset($_POST['chkDateFilter'])) ? "checked" : "" ?>> Apply Date Filter
                </label>
                <label>
                    <input type="checkbox" id="chkMemberFilter" name="chkMemberFilter" <?php echo (isset($_POST['chkMemberFilter'])) ? "checked" : "" ?>> Apply member Filter
                </label>
            </div>
            <div class="form-group btn-row">
                <button type="submit" name="submitted" class="btn btn-default btn-primary my-btn">Search</button>        
                <?php
                $link = "export-purchase.php";

                if (isset($member) || isset($fromDate) || isset($toDate)) {
                    $link.="?";
                }

                if (isset($member)) {

                    $link.="member=" . $member;
                }

                if (isset($fromDate) && isset($toDate)) {
                    if ($link[strlen($link) - 1] != "?") {
                        $link.="&";
                    }
                    $link.="fromDate=" . $fromDate . "&toDate=" . $toDate;
                }
                ?>
                <a href="<?php echo $link; ?>" target="_blank" class="btn btn-default btn-info my-btn">Print</a>
            </div>

        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <table id="member-table">
            <thead>
            <th>Purchase ID</th>
            <th>Date</th>
            <th>member ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Total</th>            
            <th></th>
            </thead>
            <tbody>
                <?php foreach ($purchaseData as $row) { ?>
                    <tr>                        
                        <td><?php echo $row['purchase_id']; ?></td>
                        <td><?php echo $row['purchasedate']; ?></td>
                        <td><?php echo $row['member_id']; ?></td>
                        <td><?php echo $row['firstname']; ?></td>
                        <td><?php echo $row['lastname']; ?></td>
                        <td><?php echo $row['total']; ?></td>                       
                        <td class="action-column"><a href="purchase-detail-display.php?purchase_id=<?php echo $row['purchase_id']; ?>">Details</a></td>
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
    });
</script>

<?php include('includes/footer.php'); ?>
