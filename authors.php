<?php include("includes/includefiles.php"); ?>    
<?php require_once("includes/authorHelper.php"); ?>    

<?php
$author_id = null;
$authorname = '';
$gender = '';

if (isset($_POST['submitted'])) {
    if (isset($_POST['author_id'])) {        
        $status = updateAuthor($author_id);
    } else {
        $status = saveNewAuthor($author_id);
    }

    if ($status == true) {
        messageHelper::setMessage("Author is successfully saved with Author ID : " . $author_id, MESSAGE_TYPE_SUCCESS);
        header("Location:authors-display.php");
        exit();
    }
} else {

    if (isset($_GET['author_id'])) {
        $author_id=$_GET['author_id'];
        fillDataForEditMode($author_id,$authorname,$gender) ;
    }
}

function saveNewAuthor(&$author_id) {
    //Filling Data
    $author_id = autoID::getAutoID('authors', 'author_id', 'AUT_', 6);
    $authorname = $_POST['authorname'];
    $gender = $_POST['gender'];
    //******************************************************************************************************************    
    $sql = "INSERT INTO " .
            "`authors` (author_id,authorname,gender) " .
            "VALUES('$author_id','$authorname','$gender')";

    mysql_query($sql) or die(mysql_error());
    //******************************************************************************************************************
    
    return true;
}

function updateAuthor(&$author_id) {
    //Filling Data
    $author_id = $_POST['author_id'];
    $authorname = $_POST['authorname'];
    $gender = $_POST['gender'];
    //******************************************************************************************************************
    $sql = "UPDATE `authors` SET " .
            "authorname='" . $authorname . "'," .
            "gender='" . $gender . "' " .
            "WHERE author_id='" . $author_id . "'";

    mysql_query($sql) or die(mysql_error());
    //******************************************************************************************************************    

    return true;
}

function fillDataForEditMode($author_id,&$authorname,&$gender) {
    $data=  authorHelper::getAuthorByAuthorID($author_id);
    $author_id=$data[0]['author_id'];
    $authorname=$data[0]['authorname'];
    $gender=$data[0]['gender'];
}
?>

<?php $pageTitle="Author" ?>
<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <form role="form" id="authors" name="authors" action="authors.php" method="post" class="form-horizontal">

            <?php if (isset($author_id)) { ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Author ID :</label>
                    <div class="col-sm-9">
                        <p class="form-control-static"><?php echo $author_id; ?></p>                                    
                        <input type="hidden" id="author_id" name="author_id" value="<?php echo $author_id; ?>"/>
                    </div>                            
                </div>
            <?php } ?>

            <div class="form-group">
                <label class="col-sm-3 control-label">Author Name :</label>
                <div class="col-sm-9">
                    <input type="text" id="authorname" name="authorname" class="form-control" value="<?php echo $authorname; ?>" maxlength="30"/>
                </div>                        
            </div>            

            <div class="form-group">
                <div class="col-sm-3 control-label"></div>
                <div class="col-sm-9">
                    
                    <?php 
                    $male_checked="";
                    $female_checked='';
                    
                    if ($gender=='F'){ 
                          $female_checked="checked";
                    }else{
                        $male_checked="checked";
                    }
                    ?>
                    <div class="radio-inline">
                        <label>
                            <input type="radio" name="gender" id="optcd" value="M" <?php echo $male_checked; ?>>
                            Male
                        </label>
                    </div>
                    <div class="radio-inline">
                        <label>
                            <input type="radio" name="gender" id="optdvd" value="F" <?php echo $female_checked; ?>>
                            Female
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" name="submitted" class="btn btn-default btn-primary" onclick="return userInputValidate();">Save</button>
                    <button type="reset" name="reset"  class="btn btn-default">Reset</button>
                </div>
            </div>

        </form>
    </div> 
</div>                    

<?php include ('includes/footer.php'); ?>

<script type="text/javascript">
    $(document).ready(function(){
        $("#authors").validate({
            rules: {
                authorname: 
                    {
                    required: true
                },               
            },
            //set messages to appear inline
            messages: 
                {
                authorname: "Please enter author name.",
            }
        });
    });          
</script>