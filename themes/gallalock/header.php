<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/main.css" />
    <!-- zwraca katalog thema -->
    <?php wp_head(); ?>
</head>

<body>
    <header class="clearfix">
        <a class="logo" href="<?php echo home_url( '/' ); ?>">
            <!-- zwraca link do strony głównej -->

        </a>
        <nav>

            <div class="fixed-menu-container clearfix">
                <div class="container clearfix">
                    <div class="header-top clearfix">
                        <img class="logo" src="<?php echo get_template_directory_uri(); ?>/img/logo.png">

                        <div class="to-right">
                            <a href="tel:02084447350" class="tel">0208 442 2953</a>
                            <h1>GALLALOCK LOCKSMITHS INSLIGTON</h1>
                        </div>
                    </div>
                </div>



                <div class="nav-menu">
                    <div class="container">
                        <?php wp_nav_menu("primary menu"); ?>
                            <!-- zwraca menu (scr5.jpg), zobacz w inspectorze bo od razu są dodane classy do elementów -->
                    </div>
                </div>


            </div>
        </nav>
        <div class="header-bottom">
            <div class="container clearfix">
                <div class="col-2">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/angel-featured2.jpg">
                </div>
                <div class="col-1">

                    The multi-locksmiths serving The Angel, Islington. Our highly experienced locksmiths have worked hard to build up a fantastic reputation over the 30 years we have been in operational in North London and have many testimonies from happy customers as evidence for the good work they do. As our base is in North London,&nbsp;we guarantee a swift response time&nbsp;once we receive your phone call. From letting you into your homes to repairing your car keys, Gallalock Locksmiths Angel&nbsp;ensure each job is done to an impeccably high standard with the benefits of competitive labour charges and swift response times. Also, we are unique in that we do not charge a callout fee meaning you can book an appointment for us to come out to you and offer a free quotation on any work required at&nbsp;your property. </div>
            </div>



        </div>
        <div class="title-block" style="background-position: 50% -90px;">
            <div class="container">
                <h2>Locksmiths Serving Islington</h2>
            </div>
        </div>
        <div class="about clearfix">
            <div class="container clearfix">
                <div class="item blue">
                    <div class="title-wrapper">
                        <h5 class="title">Key Cutting</h5></div>
                    <div class="imgage-wrapper">
                        <?php echo do_shortcode('[ichcpt id="136"]'); ?>
                    </div>
                </div>
                <div class="item blue">
                    <div class="title-wrapper">
                        <h5 class="title">Contact Us</h5></div>
                    <div class="imgage-wrapper">
                        <?php echo do_shortcode('[ichcpt id="136"]'); ?>
                    </div>
                </div>
                <div class="item blue">
                    <div class="title-wrapper">
                        <h5 class="title">Car Keys</h5></div>
                    <div class="imgage-wrapper">
                        <?php echo do_shortcode('[ichcpt id="136"]'); ?>
                    </div>
                </div>
                <div class="item blue">
                    <div class="title-wrapper">
                        <h5 class="title">What We Do at Gallalock Locksmiths Insligton</h5></div>
                    <div class="imgage-wrapper">
                        <?php echo do_shortcode('[ichcpt id="136"]'); ?>
                    </div>
                </div>
                <div class="item blue">
                    <div class="title-wrapper">
                        <h5 class="title">About Us/Our Team</h5></div>
                    <div class="imgage-wrapper">
                        <?php echo do_shortcode('[ichcpt id="136"]'); ?>
                    </div>
                </div>
                <div class="item blue">
                    <div class="title-wrapper">
                        <h5 class="title">Trustworthy Locksmiths in Insligton</h5></div>
                    <div class="imgage-wrapper">
                        <?php echo do_shortcode('[ichcpt id="136"]'); ?>
                    </div>
                </div>

            </div>
        </div>



    </header>