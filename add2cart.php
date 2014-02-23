<?php include('includes/header.php'); ?>

<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = '';
}

$objShoppingCart = new ShoppingCart();
$message = '';

if ($action == 'add2cart') {
    $song_id = $_GET['song_id'];
    $title = $_GET['title'];
    $artists = $_GET['artists'];
    $price = $_GET['price'];

    if ($objShoppingCart->insert($song_id, $title, $artists, $price) == 1) {
        $message = messageHelper::showSuccessMessage('Song is successfully added to the shopping cart.');
    } else {
        $message = messageHelper::showErrorMessage('Song is already in the shopping cart.');
    }
}

if ($action == 'clear') {
    $objShoppingCart->clear();
    $message = messageHelper::showInfoMessage('Shopping Cart is cleared.');
}

if ($action == 'remove') {
    $song_id = $_GET['song_id'];
    $objShoppingCart->remove($song_id);
    $message = messageHelper::showInfoMessage('Song is successfully removed from the shopping cart.');
}
?>

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

<div id="templatemo_content_wrapper_outer">
    <div id="templatemo_content_wrapper_inner">
        <div id="templatemo_content_wrapper">

            <div id="templatemo_content">                
                <?php
                echo $message;
                ?>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a href="song-display.php" class="btn btn-warning">Go to Home Page</a>
                        <a href="checkout.php" class="btn btn-primary">Check Out</a>
                        <a href="add2cart.php?action=clear" class="btn btn-danger">Clear</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table id="song_table">
                    <thead>
                        <tr>
                            <th class="title-column">Title</th>
                            <th class="artist-column">Artists</th>
                            <th class="price-column">Price</th>
                            <th class="download-column"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($objShoppingCart->getShoppingCart() as $row) { ?>
                            <tr id="<?php echo $row['song_id']; ?>">
                                <td class="title-column"><?php echo $row['title']; ?></td>
                                <td class="artist-column"><?php echo $row['artists']; ?></td>
                                <td class="price-column"><?php echo $row['price']; ?></td>                                
                                <td class="remove-column">
                                    <a href="add2cart.php?song_id=<?php echo $row['song_id']; ?>&action=remove"><span class="glyphicon glyphicon-trash"></span></a>
                                </td>
                            </tr>
                        <?php } ?>                            
                    </tbody>
                </table>
                    </div>
                </div>                

                <div class="row">
                    <div class="col-md-12 text-right">
                        <p><b>Sub Total : </b><?php echo $objShoppingCart->getSubTotal(); ?></p>
                    </div>
                </div>

            </div> <!-- end of templatemo_content -->                

            <div class="cleaner"></div>
        </div>
    </div>
</div>       

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