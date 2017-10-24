<?php get_header(); ?>

<section>
  

        <div class="secondary-title-block">
            <div class="container">
                <h2>Traditional Expertise with Modern Technology</h2>
            </div>
        
        </div>

    <h3>To jest strona główna. Domyslnie wyświetla listę postów. Wszystkie posty które dodasz w panelu są poniżej w skróconej wersji</h3> <!-- jeżeli chcesz ustawić inną stronę jako główną patrz (scr3.jpg) -->
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="post">
            <?php the_post_thumbnail('thumbnail'); ?> <!-- zwraca obrazek posta w rozmiarze 'thumbnail'. Możesz 'thumbnail zmienić na 'medium', 'large' lub 'full'.  -->
            <a href="<?php the_permalink(); ?>"> <!-- zwraca link do danego posta/strony -->
                <?php the_title(); ?> <!-- zwraca nazwę posta (scr1.jpg) -->
            </a>
        </div>
    <?php endwhile; endif; ?>
</section>

<?php get_footer(); ?>