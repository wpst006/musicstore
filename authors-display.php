<?php include ('includes/includefiles.php'); ?>
<?php require_once ('includes/authorHelper.php'); ?>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'delete') {
        $packageTour_sql = "DELETE FROM authors WHERE author_id='" . $_GET['author_id'] . "'";

        mysql_query($packageTour_sql) or die(mysql_error());
        //*********************************************************************
        messageHelper::setMessage("You have successfully deleted a author.", MESSAGE_TYPE_SUCCESS);
    }
}

if (isset($_POST['submitted'])) {

    if (isset($_POST['searchKey'])) {
        $searchKey = $_POST['searchKey'];
    }

    $authorData = authorHelper::searchAuthor($searchKey);
} else {
    $authorData = authorHelper::selectAll();
}
?>
<?php $pageTitle = "Authors Display"; ?>
<?php include ('includes/header.php'); ?>

<link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

<div class="row">
    <div class="col-md-12">
        <form class="form-inline" id="search" name="search" action="authors-display.php" method="post" role="form" >
            <div class="form-group">
                <label class="sr-only" for="exampleInputEmail2">Authors :</label>
                <input type="text" id="searchKey" name="searchKey" class="form-control" value="<?php echo isset($_POST['searchKey']) ? $_POST['searchKey'] : "" ?>" maxlength="30" placeholder="Search"/>
            </div>
            <div class="form-group btn-row">
                <button type="submit" name="submitted" class="btn btn-default btn-success my-btn">Search</button>
                <?php
                $link = "export-authors.php";

                if (isset($_POST['searchKey']) || isset($fromDate) || isset($toDate)) {
                    $link.="?searchKey=" . $_POST['searchKey'];
                }
                ?>
                <a href="<?php echo $link; ?>" target="_blank" class="btn btn-default btn-success my-btn">Print</a>
            </div>

        </form>
        <br/>

       <table id="author_table">
            <thead>
                <tr>
                    <th class="title-column">author ID</th>
                    <th class="author-column">Name</th>
                    <th class="downloaded-count-column">Gender</th>
                    <th class="action-column"></th>
                </tr>
            </thead>
            <tbody>
                <?php $objLogIn = new logIn; ?>
                <?php foreach ($authorData as $row) { ?>
                    <tr>
                        <td class="title-column"><?php echo $row['author_id']; ?></td>
                        <td class="title-column"><?php echo $row['authorname']; ?></td>
                        <td class="price-column"><?php echo $row['gender']; ?></td>
                        <td class="action-column">
                            <?php
                            $link = '';

                            if ($objLogIn->isAdminLogIn() == true) {
                            ?>
                            <a href="authors.php?author_id=<?php echo $row['author_id']; ?>">Edit</a>&nbsp;
                            <a href="authors-display.php?author_id=<?php echo $row['author_id']; ?>&action=delete" class="delete-link">Delete</a>&nbsp;                            
                            <?php } ?>
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
        <?php if ($objLogIn->isAdminLogIn() == true) { ?>
            <a href="authors.php" class="btn btn-primary btn-block">Add New author</a>
        <?php } ?>        
    </div>
</div>

<script type="text/javascript" src="js/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#author_table').dataTable( {
            //"sPaginationType": "bootstrap",
            "sPaginationType": "full_numbers",
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false
        } );
        
        $( ".delete-link" ).click(function( event ) {
            if (window.confirm("Are you sure want to delete the author?")==true){
                return true;
            }else{
                event.preventDefault();
                return false;
            }
        });
    });
</script>

<?php include('includes/footer.php'); ?>