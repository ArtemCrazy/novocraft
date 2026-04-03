<?php
/**
 * Novacraft — functions.php
 */

// ─── Theme Setup ───────────────────────────────────────────────────────────
function novacraft_setup(): void {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'gallery', 'caption', 'style', 'script' ] );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'responsive-embeds' );

    // Отключаем встроенные паттерны WP — используем только свои
    remove_theme_support( 'core-block-patterns' );

    // Регистрируем меню
    register_nav_menus( [
        'primary'  => 'Главное меню',
        'mobile'   => 'Мобильное меню',
        'footer'   => 'Футер',
    ] );

    // Размеры миниатюр
    add_image_size( 'card-thumb',    480, 360, true );
    add_image_size( 'project-hero',  1400, 700, true );
    add_image_size( 'gallery-large', 900, 600, true );
}
add_action( 'after_setup_theme', 'novacraft_setup' );

// ─── Enqueue ────────────────────────────────────────────────────────────────
function novacraft_scripts(): void {
    wp_enqueue_style(
        'novacraft-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap',
        [],
        null
    );
    wp_enqueue_style(
        'novacraft-main',
        get_template_directory_uri() . '/assets/css/main.css',
        [ 'novacraft-fonts' ],
        '1.0.0'
    );
    wp_enqueue_script(
        'novacraft-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        '1.0.0',
        true
    );
    wp_localize_script( 'novacraft-main', 'ncCatalog', [
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
    ] );

    // Стили страниц, подключаемые по условию
    if ( is_page_template( 'page-contacts.php' ) || is_page( 'contacts' ) ) {
        wp_enqueue_style(
            'novacraft-contacts',
            get_template_directory_uri() . '/assets/css/contacts.css',
            [ 'novacraft-main' ],
            '1.0.0'
        );
    }
    if ( is_page_template( 'page-projects.php' ) || is_page( 'projects' ) || is_post_type_archive( 'novacraft_project' ) ) {
        wp_enqueue_style(
            'novacraft-projects',
            get_template_directory_uri() . '/assets/css/projects.css',
            [ 'novacraft-main' ],
            '1.0.0'
        );
    }
    if ( is_page_template( 'page-business.php' ) || is_page( 'business' ) ) {
        wp_enqueue_style(
            'novacraft-business',
            get_template_directory_uri() . '/assets/css/business.css',
            [ 'novacraft-main' ],
            '1.0.0'
        );
    }
    if ( is_singular( 'novacraft_project' ) ) {
        wp_enqueue_style(
            'novacraft-single-project',
            get_template_directory_uri() . '/assets/css/single-project.css',
            [ 'novacraft-main' ],
            '1.0.0'
        );
    }
    if ( is_page_template( 'page-about.php' ) || is_page( 'about' ) ) {
        wp_enqueue_style(
            'novacraft-about',
            get_template_directory_uri() . '/assets/css/about.css',
            [ 'novacraft-main' ],
            '1.0.0'
        );
    }
}
add_action( 'wp_enqueue_scripts', 'novacraft_scripts' );

// ─── Block Pattern Category ─────────────────────────────────────────────────
function novacraft_register_pattern_category(): void {
    register_block_pattern_category( 'novacraft', [
        'label' => 'Novacraft',
    ] );
}
add_action( 'init', 'novacraft_register_pattern_category' );

// ─── Block Patterns ─────────────────────────────────────────────────────────
require_once get_template_directory() . '/inc/block-patterns.php';

// ─── Хелперы текстов главной (parse_blocks) ──────────────────────────────────
require_once get_template_directory() . '/inc/home-content.php';

// ─── Gutenberg Sidebar Panel: тексты главной страницы ────────────────────────
require_once get_template_directory() . '/inc/editor-sidebar.php';

// ─── Customizer: глобальные контакты ─────────────────────────────────────────
require_once get_template_directory() . '/inc/customizer.php';

// ─── Product meta boxes ───────────────────────────────────────────────────────
require_once get_template_directory() . '/inc/product-meta.php';


// ─── Custom Post Types ──────────────────────────────────────────────────────
function novacraft_register_cpt(): void {
    // Проекты
    register_post_type( 'novacraft_project', [
        'labels' => [
            'name'               => 'Проекты',
            'singular_name'      => 'Проект',
            'add_new'            => 'Добавить проект',
            'add_new_item'       => 'Новый проект',
            'edit_item'          => 'Редактировать проект',
            'all_items'          => 'Все проекты',
            'search_items'       => 'Найти проект',
            'not_found'          => 'Проектов не найдено',
        ],
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => [ 'slug' => 'projects' ],
        'menu_icon'    => 'dashicons-portfolio',
        'supports'     => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ],
        'show_in_rest' => true,
    ] );

    // Таксономия для проектов
    register_taxonomy( 'novacraft_project_cat', 'novacraft_project', [
        'labels' => [
            'name'          => 'Категории проектов',
            'singular_name' => 'Категория проекта',
            'add_new_item'  => 'Добавить категорию',
        ],
        'hierarchical'  => true,
        'rewrite'       => [ 'slug' => 'project-category' ],
        'show_in_rest'  => true,
    ] );

    // Продукция
    register_post_type( 'novacraft_product', [
        'labels' => [
            'name'               => 'Мебель для дома',
            'singular_name'      => 'Товар',
            'add_new'            => 'Добавить товар',
            'add_new_item'       => 'Новый товар',
            'edit_item'          => 'Редактировать товар',
            'all_items'          => 'Вся мебель',
            'search_items'       => 'Найти товар',
            'not_found'          => 'Товаров не найдено',
        ],
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => [ 'slug' => 'catalog' ],
        'menu_icon'    => 'dashicons-admin-home',
        'supports'     => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ],
        'show_in_rest' => true,
    ] );

    // Таксономия для продукции
    register_taxonomy( 'novacraft_product_cat', 'novacraft_product', [
        'labels' => [
            'name'          => 'Категории мебели',
            'singular_name' => 'Категория мебели',
            'add_new_item'  => 'Добавить категорию',
        ],
        'hierarchical'  => true,
        'rewrite'       => [ 'slug' => 'furniture-category' ],
        'show_in_rest'  => true,
    ] );
}
add_action( 'init', 'novacraft_register_cpt' );

// ─── Template part: Contact section ─────────────────────────────────────────
function novacraft_contact_section(): void {
    get_template_part( 'template-parts/contact-section' );
}

// ─── AJAX: фильтрация каталога продукции ────────────────────────────────────
function nc_catalog_filter_ajax() {
    $cat = isset( $_POST['category'] ) ? sanitize_text_field( $_POST['category'] ) : 'all';
    $u   = get_template_directory_uri();

    $tax_query = [];
    if ( $cat && $cat !== 'all' ) {
        $tax_query[] = [
            'taxonomy' => 'novacraft_product_cat',
            'field'    => 'slug',
            'terms'    => $cat,
        ];
    }

    $products = new WP_Query( [
        'post_type'      => 'novacraft_product',
        'posts_per_page' => 24,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'tax_query'      => $tax_query,
    ] );

    ob_start();
    if ( $products->have_posts() ) {
        while ( $products->have_posts() ) {
            $products->the_post();
            $pid   = get_the_ID();
            $price = get_post_meta( $pid, '_novacraft_price',      true );
            $badge = get_post_meta( $pid, '_novacraft_badge',      true );
            $mat   = get_post_meta( $pid, '_novacraft_material',   true );
            $dims  = get_post_meta( $pid, '_novacraft_dimensions', true );
            $terms = get_the_terms( $pid, 'novacraft_product_cat' );
            $cat_s = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->slug : '';
            ?>
            <a href="<?php the_permalink(); ?>" class="catalog-card" data-cat="<?php echo esc_attr( $cat_s ); ?>">
                <div class="catalog-card__img">
                    <?php if ( has_post_thumbnail() ) :
                        the_post_thumbnail( 'medium_large', [ 'loading' => 'lazy', 'alt' => get_the_title() ] );
                    else : ?>
                        <img src="<?php echo esc_url( $u ); ?>/img/kitchen_010000.jpg" alt="<?php the_title_attribute(); ?>" loading="lazy">
                    <?php endif; ?>
                    <?php if ( $badge ) : ?>
                        <span style="position:absolute;top:var(--space-sm);left:var(--space-sm);padding:4px 10px;font-size:0.72rem;font-weight:700;color:#fff;background:var(--color-accent);border-radius:20px;z-index:2;"><?php echo esc_html( $badge ); ?></span>
                    <?php endif; ?>
                </div>
                <div class="catalog-card__body">
                    <h3 class="catalog-card__title"><?php the_title(); ?></h3>
                    <?php $excerpt = get_the_excerpt(); if ( $excerpt ) : ?>
                    <p class="catalog-card__desc"><?php echo esc_html( $excerpt ); ?></p>
                    <?php endif; ?>
                    <?php if ( $mat || $dims ) : ?>
                    <div class="catalog-card__dims">
                        <?php if ( $mat ) : ?><span><strong>Материал: </strong><?php echo esc_html( $mat ); ?></span><?php endif; ?>
                        <?php if ( $dims ) : ?><span><strong>Размеры: </strong><?php echo esc_html( $dims ); ?></span><?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <?php if ( $price ) : ?>
                    <div class="catalog-card__price-row">
                        <span class="catalog-card__price"><?php echo esc_html( $price ); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="catalog-card__hover">
                    <button class="catalog-card__hover-btn" type="button">Подробнее</button>
                </div>
            </a>
            <?php
        }
        wp_reset_postdata();
    } else {
        echo '<div style="grid-column:1/-1;text-align:center;padding:var(--space-3xl) 0;color:var(--color-text-muted);">По вашему запросу ничего не найдено.</div>';
    }
    $html = ob_get_clean();

    wp_send_json_success( [ 'html' => $html ] );
}
add_action( 'wp_ajax_nopriv_nc_catalog_filter', 'nc_catalog_filter_ajax' );
add_action( 'wp_ajax_nc_catalog_filter', 'nc_catalog_filter_ajax' );
