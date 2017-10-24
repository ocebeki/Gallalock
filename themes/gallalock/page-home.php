<?php get_header(); ?>

<section id="content" role="main">
    
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
   <!-- zwraca nazwę strony (scr1.jpg) -->
    <section class="cokolwiek">
        <?php the_post_thumbnail(); ?> <!-- zwraca obrazek (scr1.jpg) -->
        <div class="cos"></div>
        <?php the_content(); ?> <!-- zwraca tekst (scr1.jpg) -->
    </section>
    <?php endwhile; endif; ?>
</section>

<?php get_footer(); ?>