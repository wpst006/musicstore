<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Online Music Store</title>
        <link href="style.css" rel="stylesheet" type="text/css" />
        <link href="templatemo_style.css" rel="stylesheet" type="text/css" />
        <link href="css/jquery.ennui.contentslider.css" rel="stylesheet" type="text/css" media="screen,projection" />
        <link href="css/chosen.min.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
        <link href="css/custom-style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap-datetimepicker.min.css" />
        <link href="css/flexslider.css" rel="stylesheet" type="text/css" />        
    </head>
    <body>
        <div id="templatemo_header_wrapper">

            <div id="templatemo_header">

                <div id="site_title">
                    <h1><a href="index.php">Online Music Store</a></h1>
                </div>
                <!--
                                <div id="search_box">
                                    <form action="#" method="get">
                                        <input type="text" value="" name="q" size="10" id="searchfield" title="searchfield" onfocus="clearText(this)" onblur="clearText(this)" />
                                        <input type="submit" name="Search" value="Search" alt="Search" id="searchbutton" title="Search" />
                                    </form>
                                </div>-->

                <div class="cleaner"></div>
            </div><!-- end of header -->

            <div id="templatemo_menu">
                <ul>
                    <li><a href="index.php" class="current">Home</a></li>
                    <?php if ($isLoggedIn == false) { ?>
                        <li><a href="login.php">Log In</a></li>
                    <?php } else { ?>
                        <li><a href="logout.php">Log Out</a></li>
                    <?php } ?>
                    <li><a href="register.php">Register</a></li>
                    <?php if ($objLogIn->isAdminLogIn() == true) { ?>   
                        <li><a href="album.php">Album</a></li>                              
                    <?php } ?>
                    <?php if ($objLogIn->isMemberLogIn() == true) { ?>
                        <li><a href="add2Cart.php">Shopping Cart</a></li>
                    <?php } ?>
                </ul>    	
            </div><!-- end of templatemo_menu -->

            <div id="templatemo_banner">

                <div class="flexslider">
                    <ul class="slides">
                        <li>
                            <img src="slideshow/slide01.png" />
                        </li>
                        <li>
                            <img src="slideshow/slide02.png" />
                        </li>
                        <li>
                            <img src="slideshow/slide03.png" />
                        </li>
                    </ul>
                </div>

                <style>
                    .flexslider{
                        width:920px;
                        height:300px;
                        border:none !important;
                        margin:0px;
                        background:transparent;
                    }

                    .flexslider img{
                        width:920px;
                        height:300px;
                    }
                </style>


                <div class="cleaner"></div>

            </div>

        </div> <!-- end of header_wrapper -->

        <!-- Site JavaScript -->
        <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
        <script type="text/javascript" src="js/jquery.ennui.contentslider.js"></script>
<!--                <script src="js/jquery.chili-2.2.js" type="text/javascript"></script>
        <script src="js/chili/recipes.js" type="text/javascript"></script>-->
        <script src="js/chosen/chosen.jquery.min.js" type="text/javascript"></script>                                
        <script src="js/chosen/chosen.proto.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>      
        <script type="text/javascript" src="js/moment-2.4.0.js"></script>
        <script type="text/javascript" src="js/bootstrap-datetimepicker.js"></script>
        <script src="js/jquery.flexslider.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(window).load(function() {
                $('.flexslider').flexslider({
                    animation: "slide",
                    controlNav: false,
                    animationLoop: true,
                    slideshowSpeed: 5000,
                    pauseOnAction:false
                });
            });
        </script> 

        <div id="templatemo_content_wrapper_outer">
            <div id="templatemo_content_wrapper_inner">
                <div id="templatemo_content_wrapper">

                    <div id="templatemo_content">

                        <?php if (isset($pageTitle)) { ?>
                            <div class="my-page-heading"><?php echo $pageTitle; ?></div>
                        <?php } ?>

                        <?php
                        $message = messageHelper::getMessage();

                        if (isset($message)) {
                            echo $message;
                            messageHelper::clearMessage();
                        }
                        ?>