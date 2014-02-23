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
    </head>
    <body>
        <div id="templatemo_header_wrapper">

            <div id="templatemo_header">

                <div id="site_title">
                    <h1><a href="http://www.templatemo.com" target="_parent">
                            <img src="images/templatemo_logo.png" alt="Web Templates" />
                            <span>Online Music Store</span>
                        </a></h1>
                </div>

                <div id="search_box">
                    <form action="#" method="get">
                        <input type="text" value="" name="q" size="10" id="searchfield" title="searchfield" onfocus="clearText(this)" onblur="clearText(this)" />
                        <input type="submit" name="Search" value="Search" alt="Search" id="searchbutton" title="Search" />
                    </form>
                </div>

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
                    <?php if ($objLogIn->isAdminLogIn()==true){ ?>                    
                    <li><a href="songs.php">Songs</a></li>        
                    <?php } ?>
                    <li><a href="add2Cart.php">Shopping Cart</a></li>
                </ul>    	
            </div><!-- end of templatemo_menu -->

            <div id="templatemo_banner">

                <div id="one" class="contentslider">
                    <div class="cs_wrapper">
                        <div class="cs_slider">

                            <div class="cs_article">

                                <div class="left">
                                    <h2>Suspendisse sed odio ut mi auctor blandit</h2>
                                    <p>Aliquam erat volutpat. Maecenas eget nisl id nisi consequat ultrices et  eu nunc. Praesent ac leo vel dolor rutrum egestas. Aliquam suscipit  vulputate arcu, quis congue ipsum laoreet sed.</p>

                                    <div class="button"><a href="#">Read more</a></div>
                               	</div>
                                <div class="right">
                                    <a href="http://www.templatemo.com/page/1" target="_parent"><img src="images/slider/templatemo_slide02.jpg" alt="Template 1" /></a>
                                </div>

                            </div><!-- End cs_article -->

                            <div class="cs_article">
                                <div class="left">
                                    <h2>Suspendisse sed odio ut mi auctor blandit</h2>
                                    <p>Integer sed nisi sapien, ut gravida mauris. Nam et tellus libero. Cras purus libero, dapibus nec rutrum in, dapibus nec risus. Ut interdum mi sit amet magna feugiat auctor. </p>

                                    <div class="button"><a href="#">Read more</a></div>
                               	</div>
                                <div class="right">
                                    <a href="http://www.templatemo.com/page/2" target="_parent"><img src="images/slider/templatemo_slide01.jpg" alt="Template 2" /></a>
                                </div>
                            </div><!-- End cs_article -->

                            <div class="cs_article">
                                <div class="left">
                                    <h2>Suspendisse sed odio ut mi auctor blandit</h2>
                                    <p>Integer sed nisi sapien, ut gravida mauris. Nam et tellus libero. Cras purus libero, dapibus nec rutrum in, dapibus nec risus. Ut interdum mi sit amet magna feugiat auctor. </p>

                                    <div class="button"><a href="#">Read more</a></div>
                               	</div>
                                <div class="right">
                                    <a href="http://www.templatemo.com/page/3" target="_parent"><img src="images/slider/templatemo_slide03.jpg" alt="Template 3" /></a>
                                </div>
                            </div><!-- End cs_article -->

                            <div class="cs_article">
                                <div class="left">
                                    <h2>Suspendisse sed odio ut mi auctor blandit</h2>
                                    <p>Integer sed nisi sapien, ut gravida mauris. Nam et tellus libero. Cras purus libero, dapibus nec rutrum in, dapibus nec risus. Ut interdum mi sit amet magna feugiat auctor. </p>

                                    <div class="button"><a href="#">Read more</a></div>
                               	</div>
                                <div class="right">
                                    <a href="http://www.templatemo.com/page/4" target="_parent"><img src="images/slider/templatemo_slide04.jpg" alt="Template 4" /></a>
                                </div>
                            </div><!-- End cs_article -->

                        </div><!-- End cs_slider -->
                    </div><!-- End cs_wrapper -->
                </div><!-- End contentslider -->

                <!-- Site JavaScript -->
                <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
                <script type="text/javascript" src="js/jquery.validate.min.js"></script>
                <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
                <script type="text/javascript" src="js/jquery.ennui.contentslider.js"></script>
                <script type="text/javascript">
                    $(function() {
                        $('#one').ContentSlider({
                            width : '920px',
                            height : '200px',
                            speed : 800,
                            easing : 'easeInOutBack'
                        });
                    });
                </script>
<!--                <script src="js/jquery.chili-2.2.js" type="text/javascript"></script>
                <script src="js/chili/recipes.js" type="text/javascript"></script>-->
                <script src="js/chosen/chosen.jquery.min.js" type="text/javascript"></script>                                
                <script src="js/chosen/chosen.proto.min.js" type="text/javascript"></script>
                <script src="js/bootstrap.min.js" type="text/javascript"></script>                
                <div class="cleaner"></div>

            </div>

        </div> <!-- end of header_wrapper -->

        <div id="templatemo_content_wrapper_outer">
            <div id="templatemo_content_wrapper_inner">
                <div id="templatemo_content_wrapper">

                    <div id="templatemo_content">

                        <?php
                        $message = messageHelper::getMessage();

                        if (isset($message)) {
                            echo $message;
                            messageHelper::clearMessage();
                        }
                        ?>