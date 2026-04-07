<?php
/* Template Name: Business */
get_header();

/* ----------------------------------------------------------------
 * Taxonomy: load biz_cat terms from DB (label + img from term meta)
 * Fallback images used only if admin hasn't set a photo yet.
 * ---------------------------------------------------------------- */
$_fallback_imgs = array(
    'office'     => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=200&q=70',
    'restaurant' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=200&q=70',
    'hotel'      => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=200&q=70',
    'retail'     => 'https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?w=200&q=70',
    'medical'    => 'https://images.unsplash.com/photo-1519494026892-476f9a9e6e21?w=200&q=70',
    'other'      => 'https://images.unsplash.com/photo-1560066984-138dadb4c035?w=200&q=70',
);
$_raw_terms = get_terms( array( 'taxonomy' => 'biz_cat', 'hide_empty' => false, 'orderby' => 'term_order', 'order' => 'ASC' ) );
$biz_cats = array();
if ( ! is_wp_error( $_raw_terms ) ) {
    foreach ( $_raw_terms as $_t ) {
        $img = get_term_meta( $_t->term_id, 'biz_cat_img', true );
        if ( ! $img ) $img = $_fallback_imgs[ $_t->slug ] ?? reset( $_fallback_imgs );
        $biz_cats[ $_t->slug ] = array( 'label' => $_t->name, 'img' => $img, 'term_id' => $_t->term_id );
    }
}
/* "Все" circle image = first category image */
$_all_img = $biz_cats ? reset( $biz_cats )['img'] : reset( $_fallback_imgs );

/* ----------------------------------------------------------------
 * Static fallback cards (shown when no WP posts exist)
 * Each card: cat slug, title, desc, price, term, type, warranty, img
 * ---------------------------------------------------------------- */
$fallback_cards = array(
    array(
        'cat' => 'office', 'title' => 'Рабочие зоны',
        'desc' => 'Рабочие столы, тумбы, системы хранения для сотрудников. Эргономика и единый корпоративный стиль.',
        'price' => 'от 25 000 руб.', 'term' => 'от 3 недель', 'type' => 'Офис', 'warranty' => '3 года',
        'img'  => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=800&q=80',
    ),
    array(
        'cat' => 'office', 'title' => 'Переговорные комнаты',
        'desc' => 'Столы для переговоров, кресла, тумбы, модульные стеллажи. Представительный интерьер под брендбук.',
        'price' => 'от 60 000 руб.', 'term' => 'от 4 недель', 'type' => 'Офис', 'warranty' => '3 года',
        'img'  => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&q=80',
    ),
    array(
        'cat' => 'office', 'title' => 'Ресепшн и лобби',
        'desc' => 'Стойка ресепшн, диваны и кресла для зон ожидания, декоративные панели. Первое впечатление о компании.',
        'price' => 'от 45 000 руб.', 'term' => 'от 3 недель', 'type' => 'Офис', 'warranty' => '3 года',
        'img'  => 'https://images.unsplash.com/photo-1568992687947-868a62a9f521?w=800&q=80',
    ),
    array(
        'cat' => 'restaurant', 'title' => 'Барные стойки',
        'desc' => 'Барные стойки из массива, МДФ или камня. Встроенное оборудование, мойки, полки под технику. Износостойкие покрытия.',
        'price' => 'от 55 000 руб.', 'term' => 'от 3 недель', 'type' => 'Ресторан / кафе', 'warranty' => '3 года',
        'img'  => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=800&q=80',
    ),
    array(
        'cat' => 'restaurant', 'title' => 'Столы и стулья для зала',
        'desc' => 'Обеденные столы и стулья для ресторанов и кафе. Любой стиль — от лофта до классики. Партии от 10 штук.',
        'price' => 'от 8 000 руб./шт.', 'term' => 'от 2 недель', 'type' => 'Ресторан / кафе', 'warranty' => '2 года',
        'img'  => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=800&q=80',
    ),
    array(
        'cat' => 'restaurant', 'title' => 'Кухонные блоки',
        'desc' => 'Профессиональные кухонные блоки: столы разделки, полки, стеллажи для посуды. Нержавеющая сталь и МДФ.',
        'price' => 'от 70 000 руб.', 'term' => 'от 4 недель', 'type' => 'Ресторан / кафе', 'warranty' => '3 года',
        'img'  => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=800&q=80',
    ),
    array(
        'cat' => 'hotel', 'title' => 'Номерной фонд',
        'desc' => 'Кровати, тумбы, шкафы, письменные столы для гостиничных номеров. От стандарта до люкса. Партии от 5 комплектов.',
        'price' => 'от 90 000 руб./номер', 'term' => 'от 5 недель', 'type' => 'Отель', 'warranty' => '3 года',
        'img'  => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
    ),
    array(
        'cat' => 'hotel', 'title' => 'Лобби и зоны отдыха',
        'desc' => 'Стойка ресепшн, декоративные панели, диваны, журнальные столики. Запоминающийся первый контакт с гостем.',
        'price' => 'от 120 000 руб.', 'term' => 'от 4 недель', 'type' => 'Отель', 'warranty' => '3 года',
        'img'  => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
    ),
    array(
        'cat' => 'retail', 'title' => 'Торговые стеллажи',
        'desc' => 'Стеллажи, торговые островки, подиумы и накопители. Любая конфигурация под фирменный стиль.',
        'price' => 'от 35 000 руб.', 'term' => 'от 3 недель', 'type' => 'Магазин / шоурум', 'warranty' => '2 года',
        'img'  => 'https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?w=800&q=80',
    ),
    array(
        'cat' => 'retail', 'title' => 'Витрины и кассовые зоны',
        'desc' => 'Витрины с подсветкой, кассовые стойки, стеллажи-накопители. МДФ, ЛДСП, стекло, металл.',
        'price' => 'от 28 000 руб.', 'term' => 'от 2 недель', 'type' => 'Магазин / шоурум', 'warranty' => '2 года',
        'img'  => 'https://images.unsplash.com/photo-1604719312566-8912e9227c6a?w=800&q=80',
    ),
    array(
        'cat' => 'medical', 'title' => 'Ресепшн клиники',
        'desc' => 'Стойки ресепшн с антибактериальным покрытием, модули для документов, информационные панели.',
        'price' => 'от 50 000 руб.', 'term' => 'от 3 недель', 'type' => 'Медицина', 'warranty' => '3 года',
        'img'  => 'https://images.unsplash.com/photo-1519494026892-476f9a9e6e21?w=800&q=80',
    ),
    array(
        'cat' => 'medical', 'title' => 'Зоны ожидания и кабинеты',
        'desc' => 'Кресла и диваны для зон ожидания, шкафы-картотеки, столы врача. Все требования СанПиН.',
        'price' => 'от 40 000 руб.', 'term' => 'от 4 недель', 'type' => 'Медицина', 'warranty' => '3 года',
        'img'  => 'https://images.unsplash.com/photo-1551601651-2a8555f1a136?w=800&q=80',
    ),
    array(
        'cat' => 'other', 'title' => 'Банки и финансовые офисы',
        'desc' => 'Кассовые узлы, перегородки, рабочие места операционистов. Представительный вид и надёжные конструкции.',
        'price' => 'по запросу', 'term' => 'от 5 недель', 'type' => 'Другое', 'warranty' => '3 года',
        'img'  => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=800&q=80',
    ),
    array(
        'cat' => 'other', 'title' => 'Салоны красоты и фитнес',
        'desc' => 'Ресепшн, стеллажи, кабины для процедур, раздевалки. Влагостойкие материалы, нестандартные размеры.',
        'price' => 'от 30 000 руб.', 'term' => 'от 3 недель', 'type' => 'Другое', 'warranty' => '3 года',
        'img'  => 'https://images.unsplash.com/photo-1560066984-138dadb4c035?w=800&q=80',
    ),
);

/* ----------------------------------------------------------------
 * Query real WP posts
 * ---------------------------------------------------------------- */
$wp_query = new WP_Query( array(
    'post_type'      => 'furniture_biz',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
) );

$use_wp_data = $wp_query->have_posts();
?>
<main id="primary" class="site-main">

    <!-- ============ PAGE TITLE ============ -->
    <section class="catalog-page-title">
        <div class="container">
            <h1 class="catalog-page-title__h">Мебель <span>для бизнеса</span></h1>
            <p class="catalog-page-title__sub">Офисы, рестораны, отели, магазины — изготовление на собственном производстве</p>
        </div>
    </section>

    <!-- ============ CATEGORY CIRCLES ============ -->
    <section class="cat-circle-section">
        <div class="container">
            <div class="cat-circle-row" id="bizCircleRow">
                <button class="cat-circle-item cat-circle-item--active" data-cat="all">
                    <div class="cat-circle-item__img">
                        <img src="<?php echo esc_url( $_all_img ); ?>" alt="Все" onerror="this.src='<?php echo get_template_directory_uri(); ?>/img/kitchen_wood_autumn.jpg'">
                    </div>
                    <span>Все</span>
                </button>
                <?php foreach ( $biz_cats as $slug => $info ) : ?>
                <button class="cat-circle-item" data-cat="<?php echo esc_attr( $slug ); ?>">
                    <div class="cat-circle-item__img">
                        <img src="<?php echo esc_url( $info['img'] ); ?>" alt="<?php echo esc_attr( $info['label'] ); ?>" onerror="this.src='<?php echo get_template_directory_uri(); ?>/img/kitchen_wood_autumn.jpg'">
                    </div>
                    <span><?php echo esc_html( $info['label'] ); ?></span>
                </button>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ============ CATALOG GRID ============ -->
    <section class="catalog-section" style="padding: var(--space-2xl) 0 var(--space-4xl);">
        <div class="container">
            <div class="catalog-grid" id="bizGrid">

            <?php if ( $use_wp_data ) :
                /* --- Dynamic cards from WP --- */
                while ( $wp_query->have_posts() ) : $wp_query->the_post();
                    $img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                    if ( ! $img ) $img = get_post_meta( get_the_ID(), '_biz_img_url', true );
                    if ( ! $img ) $img = 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=800&q=80';
                    $price    = get_post_meta( get_the_ID(), 'biz_price',    true ) ?: 'по запросу';
                    $term     = get_post_meta( get_the_ID(), 'biz_term',     true ) ?: '—';
                    $type     = get_post_meta( get_the_ID(), 'biz_type',     true ) ?: '—';
                    $warranty = get_post_meta( get_the_ID(), 'biz_warranty', true ) ?: '—';
                    $desc     = get_post_meta( get_the_ID(), 'biz_desc',     true );
                    if ( ! $desc ) $desc = get_the_excerpt();
                    $cats     = get_the_terms( get_the_ID(), 'biz_cat' );
                    $cat_slug = ( $cats && ! is_wp_error( $cats ) ) ? $cats[0]->slug : 'other';
            ?>
                <a href="#contact" class="catalog-card" data-cat="<?php echo esc_attr( $cat_slug ); ?>">
                    <div class="catalog-card__img">
                        <img src="<?php echo esc_url( $img ); ?>" alt="<?php the_title_attribute(); ?>" onerror="this.src='<?php echo get_template_directory_uri(); ?>/img/kitchen_wood_autumn.jpg'">
                    </div>
                    <div class="catalog-card__body">
                        <h3 class="catalog-card__title"><?php the_title(); ?></h3>
                        <?php if ( $desc ) : ?><p class="catalog-card__desc"><?php echo esc_html( $desc ); ?></p><?php endif; ?>
                        <div class="catalog-card__price-row">
                            <span class="catalog-card__price"><?php echo esc_html( $price ); ?></span>
                        </div>
                    </div>
                    <div class="catalog-card__hover">
                        <button type="button" class="catalog-card__hover-btn"
                            onclick="event.preventDefault();event.stopPropagation();document.getElementById('contact')&&document.getElementById('contact').scrollIntoView({behavior:'smooth'});">
                            Обсудить проект
                        </button>
                    </div>
                </a>
            <?php endwhile; wp_reset_postdata();
            else :
                /* --- Static fallback cards --- */
                foreach ( $fallback_cards as $card ) : ?>
                <a href="#contact" class="catalog-card" data-cat="<?php echo esc_attr( $card['cat'] ); ?>">
                    <div class="catalog-card__img">
                        <img src="<?php echo esc_url( $card['img'] ); ?>" alt="<?php echo esc_attr( $card['title'] ); ?>" onerror="this.src='<?php echo get_template_directory_uri(); ?>/img/kitchen_wood_autumn.jpg'">
                    </div>
                    <div class="catalog-card__body">
                        <h3 class="catalog-card__title"><?php echo esc_html( $card['title'] ); ?></h3>
                        <p class="catalog-card__desc"><?php echo esc_html( $card['desc'] ); ?></p>
                        <div class="catalog-card__price-row">
                            <span class="catalog-card__price"><?php echo esc_html( $card['price'] ); ?></span>
                        </div>
                    </div>
                    <div class="catalog-card__hover">
                        <button type="button" class="catalog-card__hover-btn"
                            onclick="event.preventDefault();event.stopPropagation();document.getElementById('contact')&&document.getElementById('contact').scrollIntoView({behavior:'smooth'});">
                            Обсудить проект
                        </button>
                    </div>
                </a>
                <?php endforeach;
            endif; ?>

            </div>

            <div id="bizEmpty" style="display:none; text-align:center; padding: var(--space-3xl) 0; color: var(--color-text-muted);">
                По данной категории пока нет позиций — напишите нам, обсудим ваш проект.
            </div>
        </div>
    </section>

    <!-- ============ CONTACT ============ -->
    <?php get_template_part( 'template-parts/contact-section' ); ?>

</main>

<script>
(function () {
    var row   = document.getElementById('bizCircleRow');
    var grid  = document.getElementById('bizGrid');
    var empty = document.getElementById('bizEmpty');
    if (!row || !grid) return;

    function filter(cat) {
        var cards = grid.querySelectorAll('.catalog-card');
        var visible = 0;
        cards.forEach(function (card) {
            var show = (cat === 'all' || card.dataset.cat === cat);
            card.style.display = show ? '' : 'none';
            if (show) visible++;
        });
        empty.style.display = visible === 0 ? 'block' : 'none';
    }

    row.querySelectorAll('.cat-circle-item').forEach(function (btn) {
        btn.addEventListener('click', function () {
            row.querySelectorAll('.cat-circle-item').forEach(function (b) { b.classList.remove('cat-circle-item--active'); });
            btn.classList.add('cat-circle-item--active');
            filter(btn.dataset.cat);
        });
    });

    // Apply from URL param
    var urlCat = new URLSearchParams(window.location.search).get('category');
    if (urlCat) {
        var btn = row.querySelector('[data-cat="' + urlCat + '"]');
        if (btn) { btn.click(); }
    }
})();
</script>

<?php get_footer(); ?>
