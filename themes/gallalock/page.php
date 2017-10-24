<?php get_header(); ?>

<section id="content" role="main">
    
    
    
    
    
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <h1><?php the_title(); ?></h1> <!-- zwraca nazwę strony (scr1.jpg) -->
    <section class="cokolwiek">
        <?php the_post_thumbnail(); ?> <!-- zwraca obrazek (scr1.jpg) -->
        <div class="cos">Mogę sobie dodać co chcę. Ale będzie to widoczne na każdej stronie dodaniej w panelu! (to jest teksty z page.php)</div>
        <?php the_content(); ?> <!-- zwraca tekst (scr1.jpg) -->
    </section>
    <?php endwhile; endif; ?>
</section>

<?php get_footer(); ?>