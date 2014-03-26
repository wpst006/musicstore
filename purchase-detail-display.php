<?php include('includes/includefiles.php'); ?>
<?php require_once('includes/purchaseHelper.php'); ?>

<?php $pageTitle = "Purchase Detail Display"; ?>

<?php include('includes/header.php'); ?>

<link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

<div class="row">
    <div class="col-md-12">
        <form role="form" id="seat_setup" name="seat_setup" action="seat-setup.php" method="post" class="form-horizontal">

            <?php
            $purchase_id = $_GET['purchase_id'];
            $purchaseData = purchaseHelper::getPurchaseByPurchaseID($purchase_id);
            $purchaseDetailData = purchaseHelper::getPurchasedetailsByPurchaseID($purchase_id);
            ?>

            <div class="form-group">
                <label class="col-sm-3 control-label">purchase ID</label>
                <div class="col-sm-9">
                    <p id="title" class="form-control-static"><?php echo $purchaseData[0]['purchase_id']; ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">purchase Date</label>
                <div class="col-sm-9">
                    <p id="title" class="form-control-static"><?php echo $purchaseData[0]['purchasedate']; ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Member ID</label>
                <div class="col-sm-9">
                    <p id="title" class="form-control-static"><?php echo $purchaseData[0]['member_id']; ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">First Name</label>
                <div class="col-sm-9">
                    <p id="title" class="form-control-static"><?php echo $purchaseData[0]['firstname']; ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Last Name</label>
                <div class="col-sm-9">
                    <p id="title" class="form-control-static"><?php echo $purchaseData[0]['lastname']; ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Total</label>
                <div class="col-sm-9">
                    <p id="title" class="form-control-static"><?php echo $purchaseData[0]['total']; ?></p>
                </div>
            </div>

        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <table id="purchase-table">
            <thead>
            <th>Song ID</th>
            <th>Title</th>
            <th>Length</th>
            <th>Song Type</th>
            <th>Price</th>
            </thead>
            <tbody>
                <?php foreach ($purchaseDetailData as $row) { ?>
                    <tr>
                        <td><?php echo $row['song_id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['length']; ?></td>
                        <td><?php echo $row['song_type']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <br/>
        <a href="export-purchase-detail.php?purchase_id=<?php echo $_GET['purchase_id']; ?>" class="btn btn-default btn-info my-btn pull-right btn-block">Print</a>
    </div>
</div>

<script type="text/javascript" src="js/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#purchase-table').dataTable( {
            //"sPaginationType": "bootstrap",
            //"sPaginationType": "full_numbers",
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
        } );

    });
</script>

<?php include('includes/footer.php'); ?>
