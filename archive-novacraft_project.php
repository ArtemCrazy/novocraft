<?php
/**
 * Archive Template: Projects (novacraft_project CPT)
 *
 * Uses the main WP loop for project archive pages.
 *
 * @package Novacraft
 */

get_header();

$u = esc_url( get_template_directory_uri() );
?>

<!-- ============ PROJECTS PAGE ============ -->
<section class="projects-page">
    <div class="container">

        <div class="projects-page__header">
            <h1 class="projects-page__title"><?php post_type_archive_title(); ?></h1>
            <p class="projects-page__sub">Выполненные работы нашего производства — от эскиза до монтажа</p>
        </div>

        <!-- Sort -->
        <div class="projects-sort">
            <span class="projects-sort__label">Сортировка:</span>
            <button class="projects-sort__btn active" data-sort="date" onclick="sortProjects('date', this)">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                По дате
            </button>
            <button class="projects-sort__btn" data-sort="area" onclick="sortProjects('area', this)">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M3 3h18v18H3z"/><path d="M3 9h18M3 15h18M9 3v18M15 3v18"/></svg>
                По площади
            </button>

            <div class="projects-sort__sep"></div>

            <!-- Category filter -->
            <?php
            $project_cats = get_terms( [
                'taxonomy'   => 'novacraft_project_cat',
                'hide_empty' => true,
            ] );
            ?>
            <button class="projects-filter__tag active" data-cat="all" onclick="filterProjects('all', this)">Все</button>
            <?php if ( $project_cats && ! is_wp_error( $project_cats ) ) :
                foreach ( $project_cats as $term ) :
            ?>
            <button class="projects-filter__tag" data-cat="<?php echo esc_attr( $term->name ); ?>" onclick="filterProjects('<?php echo esc_attr( $term->name ); ?>', this)"><?php echo esc_html( $term->name ); ?></button>
            <?php
                endforeach;
            endif;
            ?>
        </div>

        <!-- Count -->
        <div class="projects-count" id="projectsCount">
            <span id="countNum"><?php global $wp_query; echo esc_html( $wp_query->found_posts ); ?></span> проектов
        </div>

        <!-- Grid -->
        <div class="projects-grid" id="projectsGrid">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    $area      = get_post_meta( get_the_ID(), '_novacraft_area', true );
                    $material  = get_post_meta( get_the_ID(), '_novacraft_material', true );
                    $proj_date = get_post_meta( get_the_ID(), '_novacraft_date_label', true );
                    $cat_label = '';
                    $terms     = get_the_terms( get_the_ID(), 'novacraft_project_cat' );
                    if ( $terms && ! is_wp_error( $terms ) ) {
                        $cat_label = $terms[0]->name;
                    }
            ?>
            <a class="proj-card" href="<?php the_permalink(); ?>" data-date="<?php echo esc_attr( get_the_date( 'Ymd' ) ); ?>" data-area="<?php echo esc_attr( $area ); ?>" data-material="<?php echo esc_attr( $material ); ?>" data-cat="<?php echo esc_attr( $cat_label ); ?>">
                <div class="proj-card__image">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'medium_large', [ 'loading' => 'lazy', 'alt' => get_the_title() ] ); ?>
                    <?php endif; ?>
                    <?php if ( $cat_label ) : ?>
                        <span class="proj-card__tag"><?php echo esc_html( $cat_label ); ?></span>
                    <?php endif; ?>
                </div>
                <div class="proj-card__body">
                    <h3 class="proj-card__title"><?php the_title(); ?></h3>
                    <div class="proj-card__meta">
                        <?php if ( $area ) : ?>
                        <span class="proj-card__meta-item">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3h18v18H3z"/></svg>
                            <?php echo esc_html( $area ); ?> м²
                        </span>
                        <span class="proj-card__meta-sep"></span>
                        <?php endif; ?>
                        <?php if ( $material ) : ?>
                        <span class="proj-card__meta-item">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h8"/></svg>
                            <?php echo esc_html( $material ); ?>
                        </span>
                        <span class="proj-card__meta-sep"></span>
                        <?php endif; ?>
                        <?php if ( $proj_date ) : ?>
                        <span class="proj-card__meta-item"><?php echo esc_html( $proj_date ); ?></span>
                        <?php else : ?>
                        <span class="proj-card__meta-item"><?php echo esc_html( get_the_date( 'F Y' ) ); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
            <?php
                endwhile;
            else :
            ?>
            <div style="text-align:center;padding:var(--space-3xl) 0;color:var(--color-text-muted);grid-column:1/-1;">
                Проекты пока не добавлены.
            </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php if ( $wp_query->max_num_pages > 1 ) : ?>
        <div class="projects-pagination" style="margin-top:var(--space-2xl);text-align:center;">
            <?php
            echo paginate_links( [
                'mid_size'  => 2,
                'prev_text' => '&laquo; Назад',
                'next_text' => 'Далее &raquo;',
            ] );
            ?>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php get_template_part( 'template-parts/contact-section' ); ?>

<?php get_footer(); ?>
