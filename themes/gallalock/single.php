<?php get_header(); ?>

<section id="content" role="main">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div><?php the_title(); ?></div> <!-- zwraca nazwę strony (scr1.jpg) -->
        <div><?php the_post_thumbnail(); ?></div> <!-- zwraca obrazek (scr1.jpg) -->
        <div><?php the_content(); ?></div> <!-- zwraca tekst (scr1.jpg) -->
    <?php endwhile; endif; ?>
</section>

<?php get_footer(); ?>