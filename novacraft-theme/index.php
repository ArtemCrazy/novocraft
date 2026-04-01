<?php get_header(); ?>
<main class="container section">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            the_content();
        endwhile;
    else :
        echo "<p>Не найдено</p>";
    endif;
    ?>
</main>
<?php get_footer(); ?>