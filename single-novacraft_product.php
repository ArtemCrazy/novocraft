<?php
/**
 * Single Template: Product (novacraft_product CPT)
 *
 * @package Novacraft
 */

get_header();

$u = esc_url( get_template_directory_uri() );

while ( have_posts() ) : the_post();

$price       = get_post_meta( get_the_ID(), '_novacraft_price',        true );
$old_price   = get_post_meta( get_the_ID(), '_novacraft_old_price',    true );
$badge       = get_post_meta( get_the_ID(), '_novacraft_badge',        true );
$material    = get_post_meta( get_the_ID(), '_novacraft_material',     true );
$dimensions  = get_post_meta( get_the_ID(), '_novacraft_dimensions',   true );
$color       = get_post_meta( get_the_ID(), '_novacraft_color',        true );
$lead_time   = get_post_meta( get_the_ID(), '_novacraft_lead_time',    true );
$gallery     = get_post_meta( get_the_ID(), '_novacraft_gallery',      true );
$specs_raw   = get_post_meta( get_the_ID(), '_novacraft_specs',        true );
$specs       = $specs_raw ? json_decode( $specs_raw, true ) : [];
$delivery    = get_post_meta( get_the_ID(), '_novacraft_delivery_info', true );

$cat_label = '';
$cat_slug  = '';
$terms = get_the_terms( get_the_ID(), 'novacraft_product_cat' );
if ( $terms && ! is_wp_error( $terms ) ) {
    $cat_label = $terms[0]->name;
    $cat_slug  = $terms[0]->slug;
}

// Collect all images (featured + gallery)
$images = [];
if ( has_post_thumbnail() ) {
    $images[] = get_post_thumbnail_id();
}
if ( $gallery && is_array( $gallery ) ) {
    foreach ( $gallery as $gid ) {
        $gid = (int) $gid;
        if ( $gid && ! in_array( $gid, $images ) ) {
            $images[] = $gid;
        }
    }
}
?>

<div class="container">
<div class="product-inner">

    <!-- Breadcrumbs -->
    <nav class="product-breadcrumbs" aria-label="Хлебные крошки">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
        <span class="product-breadcrumbs__sep">/</span>
        <a href="<?php echo esc_url( home_url( '/catalog/' ) ); ?>">Каталог</a>
        <?php if ( $cat_label ) : ?>
        <span class="product-breadcrumbs__sep">/</span>
        <a href="<?php echo esc_url( home_url( '/catalog/?category=' . $cat_slug ) ); ?>"><?php echo esc_html( $cat_label ); ?></a>
        <?php endif; ?>
        <span class="product-breadcrumbs__sep">/</span>
        <span class="product-breadcrumbs__current"><?php the_title(); ?></span>
    </nav>

    <!-- Title — full width above the two columns -->
    <h1 class="product-inner__title" style="margin-bottom:var(--space-lg);"><?php the_title(); ?></h1>

    <!-- Layout: gallery + side info -->
    <div class="product-inner__row">

        <!-- Gallery -->
        <div class="product-inner__gallery">
            <div class="product-inner__slider">
                <div class="product-inner__img-wrap">
                    <?php if ( ! empty( $images ) ) :
                        $main_url = wp_get_attachment_image_url( $images[0], 'large' );
                    ?>
                        <img class="product-inner__img"
                             src="<?php echo esc_url( $main_url ); ?>"
                             alt="<?php the_title_attribute(); ?>">
                    <?php else : ?>
                        <img class="product-inner__img" src="<?php echo $u; ?>/img/kitchen_010000.jpg" alt="<?php the_title_attribute(); ?>">
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Side info -->
        <div class="product-inner__side">

            <!-- Price -->
            <?php if ( $price ) : ?>
            <div class="product-inner__price-block" style="margin-bottom:var(--space-lg);">
                <span class="product-inner__price"><?php echo esc_html( $price ); ?></span>
                <?php if ( $old_price ) : ?>
                <span style="font-size:1rem;color:var(--color-text-muted);text-decoration:line-through;"><?php echo esc_html( $old_price ); ?></span>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <!-- Characteristics grid (2×2) — like reference -->
            <?php
            $pairs = [];
            if ( $material )   $pairs[] = [ 'Материал',  $material ];
            if ( $dimensions ) $pairs[] = [ 'Размеры',   $dimensions ];
            if ( $color )      $pairs[] = [ 'Цвет',      $color ];
            if ( $lead_time )  $pairs[] = [ 'Срок',      $lead_time ];
            ?>
            <?php if ( ! empty( $pairs ) ) : ?>
            <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:8px;margin-bottom:var(--space-lg);">
                <?php foreach ( $pairs as $pair ) : ?>
                <div style="border:1px solid var(--color-border);border-radius:var(--radius-sm);padding:12px 14px;">
                    <div style="font-size:0.7rem;font-weight:600;color:var(--color-text-muted);text-transform:uppercase;letter-spacing:0.06em;margin-bottom:6px;"><?php echo esc_html( $pair[0] ); ?></div>
                    <div style="font-size:0.95rem;font-weight:600;color:var(--color-text);line-height:1.3;"><?php echo esc_html( $pair[1] ); ?></div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- CTA -->
            <div class="product-inner__cta" style="margin-bottom:var(--space-md);">
                <div class="product-inner__cta-title">Нужен расчёт стоимости?</div>
                <p class="product-inner__cta-text">Оставьте заявку — мы подберём материалы и рассчитаем точную цену под ваши размеры.</p>
            </div>

            <div class="product-inner__actions">
                <button class="btn btn--primary product-inner__btn" onclick="openModal()">Заказать расчёт</button>
                <a href="tel:<?php echo esc_attr( nc_phone() ); ?>" class="btn product-inner__btn product-inner__btn--outline">Позвонить</a>
            </div>

        </div><!-- /.product-inner__side -->
    </div><!-- /.product-inner__row -->

    <!-- Tabs: description / specs / delivery -->
    <div>
        <div class="product-inner__tabs" id="productTabs">
            <button class="product-inner__tab product-inner__tab--active" onclick="switchProductTab('description', this)">Описание</button>
            <?php if ( ! empty( $specs ) ) : ?>
            <button class="product-inner__tab" onclick="switchProductTab('specs', this)">Характеристики</button>
            <?php endif; ?>
            <button class="product-inner__tab" onclick="switchProductTab('delivery', this)">Доставка и оплата</button>
        </div>

        <div class="product-inner__tab-panels">

            <div class="product-inner__tab-panel product-inner__tab-panel--active" id="tab-description">
                <?php the_content(); ?>
                <?php if ( ! get_the_content() ) : ?>
                <p style="color:var(--color-text-soft);">Подробное описание уточняйте у менеджера.</p>
                <?php endif; ?>
            </div>

            <?php if ( ! empty( $specs ) ) : ?>
            <div class="product-inner__tab-panel" id="tab-specs">
                <table style="width:100%;border-collapse:collapse;">
                    <tbody>
                    <?php foreach ( $specs as $spec ) : ?>
                    <tr style="border-bottom:1px solid var(--color-border);">
                        <td style="padding:10px 0;font-weight:600;color:var(--color-text);width:40%;font-size:0.9rem;"><?php echo esc_html( $spec[0] ); ?></td>
                        <td style="padding:10px 0;color:var(--color-text-soft);font-size:0.9rem;"><?php echo esc_html( $spec[1] ); ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>

            <div class="product-inner__tab-panel" id="tab-delivery">
                <?php if ( $delivery ) : ?>
                    <?php echo wp_kses_post( $delivery ); ?>
                <?php else : ?>
                <ul class="product-inner__payment-list">
                    <li class="product-inner__payment-item">
                        <span class="product-inner__payment-num">1</span>
                        <div class="product-inner__payment-content">
                            <span class="product-inner__payment-title">Доставка</span>
                            <p class="product-inner__payment-desc">По Нижнему Новгороду — бесплатно. По Москве и МО — от 2 000 руб. По России — транспортной компанией, стоимость рассчитывается индивидуально.</p>
                        </div>
                    </li>
                    <li class="product-inner__payment-item">
                        <span class="product-inner__payment-num">2</span>
                        <div class="product-inner__payment-content">
                            <span class="product-inner__payment-title">Оплата</span>
                            <p class="product-inner__payment-desc">Наличными или безналичный расчёт. Предоплата 50%, остаток — при доставке.</p>
                        </div>
                    </li>
                </ul>
                <?php endif; ?>
            </div>

        </div>
    </div>

</div><!-- /.product-inner -->
</div><!-- /.container -->

<script>
function switchProductTab(tabId, btn) {
    document.querySelectorAll('.product-inner__tab-panel').forEach(function(p) {
        p.classList.remove('product-inner__tab-panel--active');
    });
    document.querySelectorAll('.product-inner__tab').forEach(function(t) {
        t.classList.remove('product-inner__tab--active');
    });
    var panel = document.getElementById('tab-' + tabId);
    if (panel) panel.classList.add('product-inner__tab-panel--active');
    if (btn) btn.classList.add('product-inner__tab--active');
}
</script>

<?php endwhile; ?>

<?php get_template_part( 'template-parts/contact-section' ); ?>

<?php get_footer(); ?>
