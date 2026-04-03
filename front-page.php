<?php
/**
 * Template: Front Page
 * Все секции — статические template-parts.
 * Тексты Hero и About редактируются через Customizer (Внешний вид → Настроить).
 */
get_header();

get_template_part( 'template-parts/home', 'hero' );
get_template_part( 'template-parts/home', 'cat-icons' );
get_template_part( 'template-parts/home', 'popular-cats' );
get_template_part( 'template-parts/home', 'advantages' );
get_template_part( 'template-parts/home', 'projects' );
get_template_part( 'template-parts/home', 'about' );
get_template_part( 'template-parts/home', 'process' );
get_template_part( 'template-parts/home', 'contact' );

get_footer();
