<?php include('includes/includefiles.php'); ?>

<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = '';
}

$objShoppingCart = new ShoppingCart();
?>
<?php include('includes/header.php'); ?>

<link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    #templatemo_content{
        float:none;
        width:100%;
    }

    .dataTables_wrapper {
        margin: 0 auto;
        width: 860px;
    }

    #song_table .title-column{
        width:360px;
    }
    #song_table .artist-column{
        width:300px;
    }
    #song_table .price-column{
        width:50px;
    }

    #song_table .downloaded-count-column{
        width:100px;
    }

    #song_table .download-column{
        width:50px;
    }  
</style>

<div class="row">
    <div class="col-md-12">
        <table id="song_table">
            <thead>
                <tr>
                    <th class="title-column">Title</th>
                    <th class="artist-column">Artists</th>
                    <th class="download-column"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($objShoppingCart->getShoppingCart() as $row) { ?>
                    <tr id="<?php echo $row['song_id']; ?>">
                        <td class="title-column"><?php echo $row['title']; ?></td>
                        <td class="artist-column"><?php echo $row['artists']; ?></td>                               
                        <td class="download-column"><a href="downloadfile.php?filetype=song&file=<?php echo $row['filename']; ?>">download</a></td>
                    </tr>
                <?php } ?>                            
            </tbody>
        </table>
    </div>
</div>                        

<?php
//Clear the "ShoppingCart"
$objShoppingCart->clear();
?>

<?php include ('includes/footer.php'); ?>

<script type="text/javascript" src="js/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#song_table').dataTable( {
            //"sPaginationType": "bootstrap",
            //"sPaginationType": "full_numbers",
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
            "bPaginate": false
        } );
    });
</script>