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
       
            <!-- zwraca link do strony głównej -->

        
        <nav>

            <div class="fixed-menu-container clearfix">
                <div class="container clearfix">
                    <div class="header-top clearfix">
                         <a class="logo" href="<?php echo home_url( '/' ); ?>">
                        <img class="logo" src="<?php echo get_template_directory_uri(); ?>/img/logo.png">
                        </a>

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
        

    </header>