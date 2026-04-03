<?php
/**
 * Single Template: Project (novacraft_project CPT)
 *
 * @package Novacraft
 */

get_header();

$u = esc_url( get_template_directory_uri() );

while ( have_posts() ) : the_post();

// Post meta (ACF-ready field names)
$area       = get_post_meta( get_the_ID(), '_novacraft_area', true );
$material   = get_post_meta( get_the_ID(), '_novacraft_material', true );
$date_label = get_post_meta( get_the_ID(), '_novacraft_date_label', true );
$duration   = get_post_meta( get_the_ID(), '_novacraft_duration', true );
$city       = get_post_meta( get_the_ID(), '_novacraft_city', true );
$style      = get_post_meta( get_the_ID(), '_novacraft_style', true );
$items_count = get_post_meta( get_the_ID(), '_novacraft_items_count', true );
$gallery    = get_post_meta( get_the_ID(), '_novacraft_gallery', true ); // array of image IDs
$tasks      = get_post_meta( get_the_ID(), '_novacraft_tasks', true );   // array of task arrays

// Taxonomy
$cat_label = '';
$terms = get_the_terms( get_the_ID(), 'novacraft_project_cat' );
if ( $terms && ! is_wp_error( $terms ) ) {
    $cat_label = $terms[0]->name;
}

// Featured image URL
$hero_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
if ( ! $hero_url ) {
    $hero_url = $u . '/img/kitchen_wood_autumn.jpg';
}
?>

<!-- ============ HERO ============ -->
<section class="pd-hero">
    <img class="pd-hero__img" src="<?php echo esc_url( $hero_url ); ?>" alt="<?php the_title_attribute(); ?>">
    <div class="pd-hero__overlay"></div>
    <div class="pd-hero__content">
        <div class="container">
            <?php if ( $cat_label ) : ?>
            <span class="pd-hero__category">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                <?php echo esc_html( $cat_label ); ?>
            </span>
            <?php endif; ?>
            <h1 class="pd-hero__title"><?php the_title(); ?></h1>
            <?php if ( has_excerpt() ) : ?>
            <p class="pd-hero__subtitle"><?php echo esc_html( get_the_excerpt() ); ?></p>
            <?php endif; ?>
            <div class="pd-hero__badges">
                <?php if ( $area ) : ?>
                <span class="pd-hero__badge">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3h18v18H3z"/></svg>
                    <?php echo esc_html( $area ); ?> м²
                </span>
                <?php endif; ?>
                <?php if ( $material ) : ?>
                <span class="pd-hero__badge">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h8"/></svg>
                    <?php echo esc_html( $material ); ?>
                </span>
                <?php endif; ?>
                <?php if ( $date_label ) : ?>
                <span class="pd-hero__badge">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    <?php echo esc_html( $date_label ); ?>
                </span>
                <?php endif; ?>
                <?php if ( $city ) : ?>
                <span class="pd-hero__badge">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <?php echo esc_html( $city ); ?>
                </span>
                <?php endif; ?>
                <?php if ( $duration ) : ?>
                <span class="pd-hero__badge">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                    <?php echo esc_html( $duration ); ?>
                </span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- ============ BREADCRUMB ============ -->
<nav class="pd-breadcrumb">
    <div class="container">
        <div class="pd-breadcrumb__inner">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
            <span class="pd-breadcrumb__sep">></span>
            <a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>">Проекты</a>
            <span class="pd-breadcrumb__sep">></span>
            <span class="pd-breadcrumb__current"><?php the_title(); ?></span>
        </div>
    </div>
</nav>

<!-- ============ MAIN BODY ============ -->
<section class="pd-body">
    <div class="container">
        <div class="pd-layout">

            <!-- LEFT: description + tasks -->
            <div>
                <!-- Description -->
                <div class="pd-description">
                    <span class="pd-section-label">Описание</span>
                    <div class="pd-description__text">
                        <?php the_content(); ?>
                    </div>
                </div>

                <!-- Tasks -->
                <?php if ( $tasks && is_array( $tasks ) ) : ?>
                <div class="pd-tasks">
                    <h2 class="pd-tasks__title">
                        <span class="pd-section-label">Задачи и решения</span>
                    </h2>

                    <?php foreach ( $tasks as $i => $task ) :
                        $num     = str_pad( $i + 1, 2, '0', STR_PAD_LEFT );
                        $reverse = ( $i % 2 === 1 ) ? ' pd-task--reverse' : '';
                        $t_title = isset( $task['title'] ) ? $task['title'] : '';
                        $t_text  = isset( $task['text'] ) ? $task['text'] : '';
                        $t_img   = isset( $task['image'] ) ? $task['image'] : '';
                    ?>
                    <div class="pd-task<?php echo esc_attr( $reverse ); ?>">
                        <div class="pd-task__content">
                            <span class="pd-task__number"><?php echo esc_html( $num ); ?></span>
                            <h3 class="pd-task__title"><?php echo esc_html( $t_title ); ?></h3>
                            <p class="pd-task__text"><?php echo esc_html( $t_text ); ?></p>
                        </div>
                        <div class="pd-task__img-wrap">
                            <?php if ( $t_img ) : ?>
                            <img src="<?php echo esc_url( wp_get_attachment_url( $t_img ) ); ?>" alt="<?php echo esc_attr( $t_title ); ?>" loading="lazy">
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- RIGHT: info card -->
            <aside>
                <div class="pd-info-card">
                    <div class="pd-info-card__head">
                        <div class="pd-info-card__head-title">Проект</div>
                        <div class="pd-info-card__head-value"><?php the_title(); ?></div>
                    </div>
                    <div class="pd-info-card__body">
                        <?php if ( $area ) : ?>
                        <div class="pd-info-row">
                            <div class="pd-info-row__icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3h18v18H3z"/></svg>
                            </div>
                            <div>
                                <div class="pd-info-row__label">Площадь</div>
                                <div class="pd-info-row__val"><?php echo esc_html( $area ); ?> м²</div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if ( $material ) : ?>
                        <div class="pd-info-row">
                            <div class="pd-info-row__icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h8"/></svg>
                            </div>
                            <div>
                                <div class="pd-info-row__label">Материалы</div>
                                <div class="pd-info-row__val"><?php echo esc_html( $material ); ?></div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if ( $date_label ) : ?>
                        <div class="pd-info-row">
                            <div class="pd-info-row__icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                            </div>
                            <div>
                                <div class="pd-info-row__label">Дата сдачи</div>
                                <div class="pd-info-row__val"><?php echo esc_html( $date_label ); ?></div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if ( $duration ) : ?>
                        <div class="pd-info-row">
                            <div class="pd-info-row__icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                            </div>
                            <div>
                                <div class="pd-info-row__label">Срок производства</div>
                                <div class="pd-info-row__val"><?php echo esc_html( $duration ); ?></div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if ( $city ) : ?>
                        <div class="pd-info-row">
                            <div class="pd-info-row__icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <div>
                                <div class="pd-info-row__label">Город</div>
                                <div class="pd-info-row__val"><?php echo esc_html( $city ); ?></div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if ( $style ) : ?>
                        <div class="pd-info-row">
                            <div class="pd-info-row__icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            </div>
                            <div>
                                <div class="pd-info-row__label">Стиль</div>
                                <div class="pd-info-row__val"><?php echo esc_html( $style ); ?></div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if ( $items_count ) : ?>
                        <div class="pd-info-row">
                            <div class="pd-info-row__icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            </div>
                            <div>
                                <div class="pd-info-row__label">Изделий</div>
                                <div class="pd-info-row__val"><?php echo esc_html( $items_count ); ?></div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="pd-info-card__cta">
                        <button class="btn btn--primary" onclick="openModal()">Хочу такой же проект</button>
                    </div>
                </div>
            </aside>

        </div>
    </div>
</section>

<!-- ============ GALLERY ============ -->
<?php if ( $gallery && is_array( $gallery ) ) : ?>
<section class="pd-gallery">
    <div class="container">
        <div class="pd-gallery__header">
            <h2 class="pd-gallery__title">
                <span class="pd-section-label">Фотогалерея</span>
            </h2>
            <span style="font-size:0.8rem;color:var(--color-text-muted)">Нажмите для увеличения</span>
        </div>
        <div class="pd-gallery__grid" id="galleryGrid">
            <?php foreach ( $gallery as $i => $img_id ) :
                $img_url = wp_get_attachment_url( $img_id );
                $img_alt = get_post_meta( $img_id, '_wp_attachment_image_alt', true );
                $class   = '';
                if ( $i === 0 ) {
                    $class = ' pd-gallery__item--wide-tall';
                }
            ?>
            <div class="pd-gallery__item<?php echo esc_attr( $class ); ?>" onclick="openLightbox(<?php echo (int) $i; ?>)">
                <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" loading="lazy">
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ============ PREV / NEXT ============ -->
<section class="pd-nav">
    <div class="container">
        <div class="pd-nav__inner">
            <?php
            $prev = get_previous_post();
            $next = get_next_post();
            ?>
            <?php if ( $prev ) : ?>
            <a href="<?php echo esc_url( get_permalink( $prev ) ); ?>" class="pd-nav__item">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;opacity:.5"><polyline points="15 18 9 12 15 6"/></svg>
                <div>
                    <div class="pd-nav__direction">Предыдущий</div>
                    <div class="pd-nav__name"><?php echo esc_html( $prev->post_title ); ?></div>
                </div>
                <?php if ( has_post_thumbnail( $prev ) ) : ?>
                    <img class="pd-nav__img" src="<?php echo esc_url( get_the_post_thumbnail_url( $prev, 'thumbnail' ) ); ?>" alt="<?php echo esc_attr( $prev->post_title ); ?>">
                <?php endif; ?>
            </a>
            <?php else : ?>
            <a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>" class="pd-nav__item">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;opacity:.5"><polyline points="15 18 9 12 15 6"/></svg>
                <div>
                    <div class="pd-nav__direction">Назад</div>
                    <div class="pd-nav__name">Все проекты</div>
                </div>
            </a>
            <?php endif; ?>

            <?php if ( $next ) : ?>
            <a href="<?php echo esc_url( get_permalink( $next ) ); ?>" class="pd-nav__item pd-nav__item--next">
                <div>
                    <div class="pd-nav__direction">Следующий</div>
                    <div class="pd-nav__name"><?php echo esc_html( $next->post_title ); ?></div>
                </div>
                <?php if ( has_post_thumbnail( $next ) ) : ?>
                    <img class="pd-nav__img" src="<?php echo esc_url( get_the_post_thumbnail_url( $next, 'thumbnail' ) ); ?>" alt="<?php echo esc_attr( $next->post_title ); ?>">
                <?php endif; ?>
            </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section section--alt" style="padding:var(--space-2xl) 0;">
    <div class="container" style="text-align:center;">
        <h2 style="font-size:1.6rem;font-weight:700;margin-bottom:10px;">Хотите такой же результат?</h2>
        <p style="color:var(--color-text-soft);margin-bottom:var(--space-lg);">Оставьте заявку — замерщик приедет бесплатно в удобное время</p>
        <button class="btn btn--primary btn--lg" onclick="openModal()">Бесплатный замер</button>
    </div>
</section>

<?php endwhile; ?>

<?php get_template_part( 'template-parts/contact-section' ); ?>

<?php get_footer(); ?>
