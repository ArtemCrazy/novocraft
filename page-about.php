<?php
/* Template Name: О производстве */

get_header();

$u = esc_url( get_template_directory_uri() );

// Получаем контент страницы (редактируется в Gutenberg)
if ( have_posts() ) : the_post();
    $page_title   = get_the_title();
    $page_content = get_the_content();
endif;
?>

<!-- ============ PAGE HERO ============ -->
<section class="section" style="padding-bottom: 0; padding-top: 60px;">
    <div class="container">
        <h1 class="section-title" style="text-align: left; margin-bottom: 0;"><?php echo esc_html( $page_title ); ?></h1>
    </div>
</section>

<!-- ============ PRODUCTION TODAY ============ -->
<section class="section production-today">
    <div class="container">
        <div class="production-today__inner">

            <div class="production-today__media">
                <?php
                // Если у страницы есть featured image — используем его, иначе дефолт
                $thumb_id  = get_post_thumbnail_id();
                $thumb_url = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'large' ) : $u . '/img/production_hq.png';
                ?>
                <img src="<?php echo esc_url( $thumb_url ); ?>" alt="Производство Novacraft" class="production-today__img">
                <div class="production-today__media-caption"><?php echo esc_html( nc_address() ); ?></div>
            </div>

            <div class="production-today__text">
                <div class="production-today__label">Сегодня</div>
                <?php if ( $page_content ) : ?>
                    <?php echo apply_filters( 'the_content', $page_content ); ?>
                <?php else : ?>
                    <h2 class="production-today__title">Своё производство — наш главный актив</h2>
                    <p>Наш цех занимает более <strong>600 м²</strong> и оснащён современным форматно-раскроечным, кромкооблицовочным и присадочным оборудованием. Здесь работает слаженная команда мастеров — каждый знает своё дело до мелочей.</p>
                    <p>Мы не перекупаем готовую мебель и не отдаём заказы на субподряд. Весь цикл — от замера и проекта до производства и монтажа — проходит под одной крышей. Это даёт нам полный контроль качества и выдерживать точные сроки.</p>
                <?php endif; ?>
                <ul class="production-today__facts">
                    <li><span>600 м²</span> производственная площадь</li>
                    <li><span>30+ лет</span> работаем на рынке</li>
                    <li><span>5 000+</span> выполненных заказов</li>
                    <li><span>3 поколения</span> мастеров в команде</li>
                </ul>
            </div>

        </div>
    </div>
</section>

<!-- ============ TIMELINE INTRO ============ -->
<div class="timeline-intro">
    <div class="container">
        <div class="timeline-intro__inner">
            <div class="timeline-intro__line"></div>
            <div class="timeline-intro__content">
                <span class="timeline-intro__label">История компании</span>
                <h2 class="timeline-intro__title">А вот как всё начиналось...</h2>
                <p class="timeline-intro__text">С 1996 года — три десятилетия роста, кризисов, экспериментов и тысяч реализованных проектов. Листайте вниз, чтобы пройти этот путь вместе с нами.</p>
            </div>
            <div class="timeline-intro__line"></div>
        </div>
    </div>
</div>

<!-- ============ TIMELINE ============ -->
<section class="section">
    <div class="container">
        <div class="timeline">

            <?php
            $history = new WP_Query( [
                'post_type'      => 'novacraft_history',
                'posts_per_page' => -1,
                'meta_key'       => '_nc_history_year',
                'orderby'        => 'meta_value_num',
                'order'          => 'ASC',
                'post_status'    => 'publish',
            ] );

            if ( $history->have_posts() ) :
                while ( $history->have_posts() ) : $history->the_post();
                    $year      = get_post_meta( get_the_ID(), '_nc_history_year', true );
                    $has_thumb = has_post_thumbnail();
                    $desc      = get_the_content();
            ?>
            <div class="timeline__item reveal">
                <div class="timeline__year-bg"><?php echo esc_html( $year ?: get_the_date( 'Y' ) ); ?></div>
                <div class="timeline__content">
                    <h3 class="timeline__title"><?php the_title(); ?></h3>
                    <?php if ( $desc ) : ?>
                    <div class="timeline__text"><?php echo apply_filters( 'the_content', $desc ); ?></div>
                    <?php endif; ?>
                    <?php if ( $has_thumb ) : ?>
                    <?php the_post_thumbnail( 'large', [ 'class' => 'timeline__img', 'loading' => 'lazy' ] ); ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p style="text-align:center;color:var(--color-text-muted);padding:40px 0;">Записи истории не найдены. Добавьте их в WP Admin → История компании.</p>';
            endif;
            ?>

        </div>
    </div>
</section>

<?php get_template_part( 'template-parts/contact-section' ); ?>

<?php get_footer(); ?>
