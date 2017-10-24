<?php get_header(); ?>

    <section id="content" role="main">
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
        <div class="secondary-title-block">
            <div class="container">
                <h2> Traditional Expertise with Modern Technology</h2>
            </div>
        </div>


        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <!-- zwraca nazwę strony (scr1.jpg) -->
            <section class="cokolwiek">
                <?php the_post_thumbnail(); ?>
                    <!-- zwraca obrazek (scr1.jpg) -->
                    <div class="cos"></div>
                    <?php the_content(); ?>
                        <!-- zwraca tekst (scr1.jpg) -->
            </section>
            <?php endwhile; endif; ?>
    </section>

    <?php get_footer(); ?>
