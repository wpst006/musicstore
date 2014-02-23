<?php include('includes/header.php'); ?>

<div id="templatemo_content_wrapper_outer">
    <div id="templatemo_content_wrapper_inner">
        <div id="templatemo_content_wrapper">

            <div id="templatemo_content">                

                <form action="submit.php" method="post">
                    <img id="preview" src="" width="100px" height="100px" />
                    <label>Upload a picture: <input id="imageUpload" type="file" name="image"/></label>
                    <input type="hidden" name="uploadedImg" id="uploadedimg"></input>
                    <input type="submit" value="Save the picture"/>
                </form>

            </div> <!-- end of templatemo_content -->                

            <?php include('includes/sidebar.php'); ?>

            <div class="cleaner"></div>
        </div>
    </div>
</div>       

<?php include ('includes/footer.php'); ?>
<script type="text/javascript" src="js/ajaxupload.js"></script>
<script type="text/javascript">
        
    $(document).ready(function(){
        var preview = $('#preview'); //id of the preview image
        new AjaxUpload('imageUpload', {
            action: 'saveimage.php', //the php script that receives and saves the image
            name: 'image', //The saveimagephp will find the image info in the variable $_FILES['image']
            onSubmit: function(file, extension) {
                preview.attr('src', 'ajaxSpinner.gif'); //replace the image SRC with an animated GIF with a 'loading...' message 
            },
            onComplete: function(file, response) {
                preview.load(function(){
                    preview.unbind();
                });
                //console.log(response);
                preview.attr('src', response); //make the preview image display the uploaded file
                $('#uploadedimg').val(response); //drop the path to the file into the hidden field
            }
        }); 
    });
   
</script>