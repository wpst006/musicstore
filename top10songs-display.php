<?php include ('includes/includefiles.php'); ?>
<?php require_once ('includes/songHelper.php'); ?>

<?php
$songData = songHelper::getTop10Songs();
?>
<?php $pageTitle = "Top 10 Songs Display"; ?>
<?php include ('includes/header.php'); ?>

<link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

<div class="row">
    <div class="col-md-12">        

       <table id="song_table">
            <thead>
                <tr>
                    <th class="title-column">song ID</th>
                    <th class="song-column">Title</th>
                    <th class="downloaded-count-column">Artists</th>
                    <th class="downloaded-count-column">Song Type</th>
                    <th class="downloaded-count-column">Unit Price</th>
                    <th class="downloaded-count-column">Purchase Count</th>                    
                </tr>
            </thead>
            <tbody>
                <?php $objLogIn = new logIn; ?>
                <?php foreach ($songData as $row) { ?>
                    <tr>
                        <td class="title-column"><?php echo $row['song_id']; ?></td>
                        <td class="title-column"><?php echo $row['title']; ?></td>
                        <td class="price-column"><?php echo $row['artists']; ?></td>  
                        <td class="title-column"><?php echo $row['song_type']; ?></td>
                        <td class="title-column"><?php echo $row['unitprice']; ?></td>
                        <td class="price-column"><?php echo $row['purchase_count']; ?></td>        
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<script type="text/javascript" src="js/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#song_table').dataTable( {
            //"sPaginationType": "bootstrap",
            "sPaginationType": "full_numbers",
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
            "bSort":false
        } );
    });
</script>

<?php include('includes/footer.php'); ?>