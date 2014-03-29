<?php include("includes/includefiles.php"); ?>    
<?php require_once("includes/memberHelper.php"); ?>    

<?php
$member_id = null;
$username = '';
$password = '';
$email = '';
$firstname = '';
$lastname = '';
$DOB = '';
$contact_phone = '';
$country = '';
$zipcode = '';

if (isset($_POST['submitted'])) {
    if (isset($_POST['member_id'])) {
        $member_id=$_POST['member_id'];
        updateMember($member_id);
    } else {       
        saveNewMember($member_id);
    }
} else {

    if (isset($_GET['member_id'])) {
        $member_id = $_GET['member_id'];
        fillDataForEditMode($member_id, $username,$password,$email,$firstname,$lastname,$DOB,$contact_phone,$country,$zipcode);
    }
}

function saveNewMember(&$member_id) {
    //*********************************************************************
    //Filling Data
    $member_id = autoID::getAutoID('users', 'user_id', 'MEM_', 6);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $DOB = $_POST['DOB'];
    $contact_phone = $_POST['contact_phone'];
    $country = $_POST['country'];
    $zipcode = $_POST['zipcode'];
    //*********************************************************************
    //Check if the member name already exist
    $isUserNameAlreadyExist=  memberHelper::isUserNameAlreadyExist($username);
    
    if ($isUserNameAlreadyExist==true){
        messageHelper::setMessage("The user name <b>$username</b> already existed. Please try again", MESSAGE_TYPE_SUCCESS);
        header("Location:register.php");
        exit();
    }
    //*********************************************************************
    //"members" Table Insert
    $member_sql = "INSERT INTO " .
            "members(member_id,firstname,lastname,DOB,contact_phone,contact_email,country,zipcode) " .
            "VALUES('$member_id','$firstname','$lastname','$DOB','$contact_phone','$email','$country','$zipcode')";

    mysql_query($member_sql) or die(mysql_error());
    //*********************************************************************
    //User Table Insert
    $userInsert_sql = "INSERT INTO " .
            "`users`(user_id,username,email,password,role) " .
            "VALUES('$member_id','$username','$email','$password','member')";

    mysql_query($userInsert_sql) or die(mysql_error());
    //*********************************************************************
    messageHelper::setMessage("You have successfully registered. Please log in to continue.", MESSAGE_TYPE_SUCCESS);
    header("Location:login.php");
    exit();
    //*********************************************************************
}

function updateMember(&$member_id) {
    //*********************************************************************
    //Filling Data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $DOB = $_POST['DOB'];
    $contact_phone = $_POST['contact_phone'];
    $country = $_POST['country'];
    $zipcode = $_POST['zipcode'];
    //*********************************************************************
    //"members" Table Update
    $member_sql = "UPDATE members " .
            "SET " .
            "firstname='" . $firstname . "'," .
            "lastname='" . $lastname . "'," .
            "DOB='" . $DOB . "'," .
            "contact_phone='" . $contact_phone . "'," .
            "country='" . $country . "'," .
            "zipcode='" . $zipcode . "' " .
            "WHERE member_id='" . $member_id . "'";
            
    mysql_query($member_sql) or die(mysql_error());
    //*********************************************************************
    //User Table Update
    $userInsert_sql="UPDATE `users` " .
            "SET email='" . $email . "', " .
            "password='" . $password . "' " .
            "WHERE user_id='" . $member_id . "'";
    
    mysql_query($userInsert_sql) or die(mysql_error());
    //*********************************************************************
    messageHelper::setMessage("You have successfully updated your information.", MESSAGE_TYPE_SUCCESS);
    header("Location:register.php?member_id=" . $member_id);
    exit();
    //*********************************************************************
}

function fillDataForEditMode($member_id, &$username,&$password,&$email,&$firstname,&$lastname,&$DOB,&$contact_phone,&$country,&$zipcode) {
    $data = memberHelper::getMemberByMemberID($member_id);
    $member_id = $data[0]['member_id'];
    $username = $data[0]['username'];
    $password = $data[0]['password'];
    $email = $data[0]['email'];
    $firstname = $data[0]['firstname'];
    $lastname = $data[0]['lastname'];
    $DOB = $data[0]['DOB'];
    $contact_phone = $data[0]['contact_phone'];
    $country = $data[0]['country'];
    $zipcode = $data[0]['zipcode'];
}
?>

<?php $pageTitle = "Register" ?>
<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <form role="form" id="register" name="register" action="register.php" method="post" class="form-horizontal">

            <?php if (isset($member_id)) { ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Member ID :</label>
                    <div class="col-sm-9">
                        <p class="form-control-static"><?php echo $member_id; ?></p>                                    
                        <input type="hidden" id="member_id" name="member_id" value="<?php echo $member_id; ?>"/>
                    </div>                            
                </div>
            <?php } ?>

            <div class="form-group">
                <div class="col-sm-3 control-label">User Name :</div>
                <div class="col-sm-9">
                    <?php if (isset($member_id)){?>
                    <p class="form-control-static"><?php echo $username; ?></p>      
                    <input type="hidden" id="username" name="username" value="<?php echo $username; ?>"/>
                    <?php }else{ ?>
                    <input type="text" id="username" name="username" class="form-control" value="<?php echo $username; ?>" maxlength="30"/>
                    <?php } ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Password :</div>
                <div class="col-sm-9">
                    <input type="password" id="password" name="password" class="form-control" value="<?php echo $password; ?>" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label" style="font-size:10pt;">Confirm Password :</div>
                <div class="col-sm-9">
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" value="<?php echo $password; ?>" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Email :</div>
                <div class="col-sm-9">
                    <input type="text" id="email" name="email" class="form-control" value="<?php echo $email; ?>" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">First Name :</div>
                <div class="col-sm-9">
                    <input type="text" id="firstname" name="firstname" class="form-control" value="<?php echo $firstname; ?>" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Last Name :</div>
                <div class="col-sm-9">
                    <input type="text" id="lastname" name="lastname" class="form-control" value="<?php echo $lastname; ?>" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">DOB :</div>
                <div class="col-sm-9">
                    <div class='input-group date' id='datetimepicker1'>
                        <?php
                            $DOB_value=empty($DOB) ? date('Y-m-d', time()) : $DOB;
                        ?>
                        <input type='text' id="DOB" name="DOB" class="form-control" data-format="YYYY-MM-DD" value="<?php echo $DOB_value; ?>"/>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(function () {
                    $('#datetimepicker1').datetimepicker({
                        pickTime: false
                    });
                });
            </script>

            <div class="form-group">
                <div class="col-sm-3 control-label">Contact Phone:</div>
                <div class="col-sm-9">
                    <input type="text" id="contact_phone" name="contact_phone" class="form-control" value="<?php echo $contact_phone; ?>" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Country :</div>
                <div class="col-sm-9">
                    <input type="text" id="country" name="country" class="form-control" value="<?php echo $country; ?>" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Zip Code :</div>
                <div class="col-sm-9">
                    <input type="text" id="zipcode" name="zipcode" class="form-control" value="<?php echo $zipcode; ?>" maxlength="30"/>
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
    $("#register").validate({
        rules: {
            username: 
                {
                required: true
            },
            password: 
                {
                required: true
            },
            confirm_password: 
                {
                required:true,
                equalTo: "#password"
            },
            email: 
                {
                required: true,
                email: true
            },
            firstname: 
                {
                required: true
            },
            lastname: 
                {
                required: true
            },
            contact_phone: 
                {
                required: true
            },
            country: 
                {
                required: true
            },
            zipcode: 
                {
                required: true
            },
        },
        //set messages to appear inline
        messages: 
            {
            username: "Please enter user name.",
            password: "Please enter a password.",
            confirm_password: 
                {
                required: "Please enter a confirm password.",
                equalTo: "Password and Confirm Password not match."
            },
            email: 
                { 
                required: "Please enter a E-Mail address.",
                email: "Please enter a valid E-Mail address."
            },
            firstname: "Please enter first name.",
            lastname: "Please enter last name.",  
            contact_phone: "Please enter phone no.",   
            country: "Please enter country.",
            zipcode: "Please enter zip code.",  
        }
    });
</script>