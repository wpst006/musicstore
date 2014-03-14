<?php include("includes/includefiles.php"); ?>
<?php
if (isset($_POST['submitted'])) {
    //**************************************************************************************
    //Filling Data
    $username = $_POST['username'];
    $password = $_POST['password'];
    //**************************************************************************************
    $objLogIn = new logIn;
    $logInOK = $objLogIn->isLogInOK($username, $password);

    if ($logInOK == false) {
        $error = true;
        messageHelper::setMessage("Invalid User Name and Password",MESSAGE_TYPE_ERROR);
    } else {
        messageHelper::setMessage("You have successfully logged in.",MESSAGE_TYPE_SUCCESS);
        exit();
    }
}
?>
<?php $pageTitle="Log In"; ?>
<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <form role="form" id="login" name="login" action="login.php" method="post" class="form-horizontal">

            <div class="form-group">
                <div class="col-sm-3 control-label">User Name :</div>
                <div class="col-sm-9">
                    <input type="text" id="username" name="username" class="form-control" value="" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Password :</div>
                <div class="col-sm-9">
                    <input type="password" id="password" name="password" class="form-control" value="" maxlength="30"/>
                </div>
            </div>                  

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" name="submitted" class="btn btn-default btn-primary">Log In</button>
                    <button type="reset" name="reset"  class="btn btn-default">Reset</button>

                </div>
            </div>
        </form> 
    </div>
</div>



<script type="text/javascript">
    $("#login").validate({
        rules: {
            username: 
                {
                required: true
            },
            password: 
                {
                required: true
            },            
        },
        //set messages to appear inline
        messages: 
            {
            username: "Please enter user name.",
            password: "Please enter a password.",                   
        }
    });
</script>

<?php include ('includes/footer.php'); ?>