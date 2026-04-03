<?php
/* Template Name: О производстве */

get_header();

$u = esc_url( get_template_directory_uri() );
?>

<!-- ============ PAGE HERO ============ -->
<section class="section" style="padding-bottom: 0; padding-top: 60px;">
    <div class="container">
        <h1 class="section-title" style="text-align: left; margin-bottom: 0;">О производстве</h1>
    </div>
</section>

<!-- ============ PRODUCTION TODAY ============ -->
<section class="section production-today">
    <div class="container">
        <div class="production-today__inner">

            <div class="production-today__media">
                <img src="<?php echo $u; ?>/img/production_hq.png" alt="Производство Novacraft сегодня" class="production-today__img">
                <div class="production-today__media-caption">Наш цех в Нижнем Новгороде, ул. Маршала Воронова, 11</div>
            </div>

            <div class="production-today__text">
                <div class="production-today__label">Сегодня</div>
                <h2 class="production-today__title">Своё производство — наш главный актив</h2>
                <p>Наш цех занимает более <strong>600 м²</strong> и оснащён современным форматно-раскроечным, кромкооблицовочным и присадочным оборудованием. Здесь работает слаженная команда мастеров — каждый знает своё дело до мелочей.</p>
                <p>Мы не перекупаем готовую мебель и не отдаём заказы на субподряд. Весь цикл — от замера и проекта до производства и монтажа — проходит под одной крышей. Это даёт нам полный контроль качества и выдерживать точные сроки.</p>
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
            // Timeline data - years and stories
            $timeline = [
                [ 'year' => '1996', 'title' => 'Первые самостоятельные шаги', 'img' => '1996_Интерьер банка Гарантия_Первые самостоятельные шаги.jpg' ],
                [ 'year' => '1997', 'title' => 'Мы пойдем другим путем!', 'img' => '1997_Автозаводский универсам_Мы пойдем другим путем.jpg' ],
                [ 'year' => '1998', 'title' => 'Юрченский милан', 'img' => '1998_Центральный универмаг_Юрченский милан.jpg' ],
                [ 'year' => '1999', 'title' => 'Полосатый рейс за экономпанелями', 'img' => '1999_Магазин Фортуна на ул Горького_Полосатый рейс за экономпанелями.jpg' ],
                [ 'year' => '2000', 'title' => 'Кодекс чести мебельщика', 'img' => '2000_Универмаг в Ардатове_Кодекс чести мебельщика.jpg' ],
                [ 'year' => '2001', 'title' => 'Heavy metal forever!', 'img' => '2001_ТЦ Сормовские зори_Heavy Metal Forever.jpg' ],
                [ 'year' => '2002', 'title' => 'Думай глобально, действуй локально', 'img' => '2002_ТЦ Алексеевский пассаж_Думай глобально действуй локально.jpg' ],
                [ 'year' => '2003', 'title' => 'Луч света в темном царстве', 'img' => '2003_ТЦ Этажи_Луч света в темном царстве.jpg' ],
                [ 'year' => '2004', 'title' => 'Импровизации в стиле фьюжн', 'img' => '2004_Магазин Мама+Я_Импровизации в стиле фьюжн.jpg' ],
                [ 'year' => '2005', 'title' => 'Подходи, не скупись: покупай Neofix', 'img' => '2005_ТЦ Республика_Подходи не скупись покупай NeoFix.jpg' ],
                [ 'year' => '2006', 'title' => 'Город Солнца', 'img' => '2006_Дзержинский ЦУМ_Город солнца.jpg' ],
                [ 'year' => '2007', 'title' => 'Чем пахнет ваш магазин?', 'img' => '2007_Дзержинский ЦУМ_Чем пахнет ваш магазин.jpg' ],
                [ 'year' => '2008', 'title' => 'Такого кризиса еще не видел свет...', 'img' => '2008_ТЦ Фантастика_Такого кризиса еще не видел свет.jpg' ],
                [ 'year' => '2009', 'title' => 'Маркетинговый подход', 'img' => '2009_ТЦ Этажи_Маркетинговый подход.jpg' ],
                [ 'year' => '2010', 'title' => 'В новом свете', 'img' => '2010_ТЦ Мега Ростов-на-Дону_В новом свете.jpg' ],
                [ 'year' => '2011', 'title' => 'От Москвы до самых до окраин', 'img' => '2011_Магазин Тофа Электросталь_От Москвы до самых до окраин.jpg' ],
                [ 'year' => '2012', 'title' => 'Днем согнем', 'img' => '2012_Промостойка Toshiba_Днем согнем.jpg' ],
                [ 'year' => '2013', 'title' => 'Полистилизм', 'img' => '2013_Аптека 83_Полистилизм.jpg' ],
                [ 'year' => '2014', 'title' => 'Вспомнить все', 'img' => '2014_Музей федерального ядерного центра_Вспомнить все.jpg' ],
                [ 'year' => '2015', 'title' => 'Заходите к нам на огонек', 'img' => '2015_Шоу-рум Студии Ю_Заходите к нам на огонек.jpg' ],
            ];

            foreach ( $timeline as $item ) :
                // Text content is stored in the WP page content or loaded dynamically.
                // For static HTML template, we output placeholders for the descriptions.
            ?>
            <div class="timeline__item reveal">
                <div class="timeline__year-bg"><?php echo esc_html( $item['year'] ); ?></div>
                <div class="timeline__content">
                    <h3 class="timeline__title"><?php echo esc_html( $item['title'] ); ?></h3>
                    <p class="timeline__text"><?php
                        // Timeline text can be managed via custom fields or the_content().
                        // Placeholder: output from post meta or hardcoded content.
                    ?></p>
                    <img src="<?php echo $u; ?>/img/about/<?php echo esc_attr( $item['img'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" class="timeline__img" loading="lazy">
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>

<?php get_template_part( 'template-parts/contact-section' ); ?>

<?php get_footer(); ?>
