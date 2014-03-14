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
                        <li><a href="songs.php">Songs</a></li>        
                    <?php } ?>
                    <?php if ($objLogIn->isMemberLogIn()==true){ ?>
                    <li><a href="add2Cart.php">Shopping Cart</a></li>
                    <?php } ?>
                </ul>    	
            </div><!-- end of templatemo_menu -->

            <div id="templatemo_banner">

                <div id="one" class="contentslider">
                    <div class="cs_wrapper">
                        <div class="cs_slider">

                            <div class="cs_article">
                                <div class="left">
                                    <h2>Mariah Carey - The Emancipation of Mimi</h2>
                                    <p>The Emancipation of Mimi is the tenth studio album by American singer and songwriter Mariah Carey, released in the United States on April 12, 2005, through Island Records</p>
                               	</div>
                                <div class="right">
                                    <a href="#"><img src="slideshow/mariah.png" alt="Template 1" /></a>
                                </div>
                            </div><!-- End cs_article -->

                            <div class="cs_article">

                                <div class="left">
                                    <h2>Monster - Eminem & Rihanna</h2>
                                    <p>"The Monster" is a song by American rapper Eminem, featuring guest vocals from Barbadian singer Rihanna, taken from Eminem's eighth studio album The Marshall Mathers LP 2.</p>
                               	</div>
                                <div class="right">
                                    <a href="#"><img src="slideshow/monster.png" alt="Template 1" /></a>
                                </div>

                            </div><!-- End cs_article -->

                            <div class="cs_article">
                                <div class="left">
                                    <h2>LMFAO - Party Rock Anthem</h2>
                                    <p>"Party Rock Anthem" is a song performed by American dance pop recording duo LMFAO, featuring British singer Lauren Bennett and GoonRock. It was released as the first single from their second album, Sorry for Party Rocking in 2011.</p>
                                </div>
                                <div class="right">
                                    <a href="#"><img src="slideshow/lmfao.png" alt="Template 1" /></a>
                                </div>
                            </div><!-- End cs_article -->
                            

                            <div class="cs_article">
                                <div class="left">
                                    <h2>Backstreet Boys - Millennium</h2>
                                    <p>Millennium is the third album (second in the United States) by American boy band Backstreet Boys. It was a highly anticipated follow-up to both their U.S. debut album, and their second internationally released album.</p>
                                </div>
                                <div class="right">
                                    <a href="#"><img src="slideshow/backstreet.png" alt="Template 1" /></a>
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
                <script type="text/javascript" src="js/moment-2.4.0.js"></script>
                <script type="text/javascript" src="js/bootstrap-datetimepicker.js"></script>
                <div class="cleaner"></div>

            </div>

        </div> <!-- end of header_wrapper -->

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