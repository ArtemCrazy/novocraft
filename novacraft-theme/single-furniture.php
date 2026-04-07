<?php get_header(); ?>

<main id="primary" class="site-main">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post();

  $price    = get_post_meta( get_the_ID(), 'f_price',    true );
  $material = get_post_meta( get_the_ID(), 'f_material', true );
  $dims     = get_post_meta( get_the_ID(), 'f_dims',     true );
  $color    = get_post_meta( get_the_ID(), 'f_color',    true );
  $term_val = get_post_meta( get_the_ID(), 'f_term',     true );

  $cats     = get_the_terms( get_the_ID(), 'furniture_cat' );
  $cat_name = ( $cats && ! is_wp_error( $cats ) ) ? $cats[0]->name : '';
  $cat_link = ( $cats && ! is_wp_error( $cats ) ) ? get_term_link( $cats[0] ) : '';

  // Главное фото — «Изображение записи», fallback на f_img_url
  $main_img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
  if ( ! $main_img ) $main_img = get_post_meta( get_the_ID(), 'f_img_url', true );
  if ( ! $main_img ) $main_img = get_template_directory_uri() . '/img/kitchen_wood_autumn.jpg';

  /* Галерея: главное фото + дополнительные из f_gallery_json */
  $gallery_json = get_post_meta( get_the_ID(), 'f_gallery_json', true );
  $gallery_extra = $gallery_json ? array_filter( json_decode( $gallery_json, true ) ) : array();
  // Собираем: сначала главное, потом дополнительные (без дублей)
  $gallery_urls = array_values( array_unique( array_merge( array( $main_img ), $gallery_extra ) ) );

  $gallery_imgs = array();
  foreach ( $gallery_urls as $url ) {
      $gallery_imgs[] = array( 'thumb' => $url, 'full' => $url, 'alt' => get_the_title() );
  }

?>

<!-- ============ BREADCRUMB ============ -->
<nav class="pd-breadcrumb">
  <div class="container">
    <div class="pd-breadcrumb__inner">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
      <span class="pd-breadcrumb__sep">›</span>
      <a href="<?php echo esc_url( get_post_type_archive_link( 'furniture' ) ); ?>">Мебель для дома</a>
      <?php if ( $cat_name ) : ?>
      <span class="pd-breadcrumb__sep">›</span>
      <?php if ( $cat_link && ! is_wp_error( $cat_link ) ) : ?>
        <a href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_html( $cat_name ); ?></a>
      <?php else : ?>
        <span><?php echo esc_html( $cat_name ); ?></span>
      <?php endif; ?>
      <?php endif; ?>
      <span class="pd-breadcrumb__sep">›</span>
      <span class="pd-breadcrumb__current"><?php the_title(); ?></span>
    </div>
  </div>
</nav>

<!-- ============ PRODUCT PAGE ============ -->
<section class="pd-wrap">
  <div class="container">
    <div class="pd-grid">

      <!-- LEFT: photos -->
      <div class="pd-photo">
        <div class="pd-photo__main" id="pdMainPhoto">
          <img src="<?php echo esc_url( $gallery_imgs[0]['full'] ); ?>"
               alt="<?php echo esc_attr( $gallery_imgs[0]['alt'] ); ?>"
               id="pdMainImg">

          <?php if ( count( $gallery_imgs ) > 1 ) : ?>
          <!-- Стрелки слайдера -->
          <button class="pd-photo__arrow pd-photo__arrow--prev" id="pdPrev" aria-label="Предыдущее фото">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M15 18l-6-6 6-6"/></svg>
          </button>
          <button class="pd-photo__arrow pd-photo__arrow--next" id="pdNext" aria-label="Следующее фото">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M9 18l6-6-6-6"/></svg>
          </button>
          <!-- Счётчик -->
          <div class="pd-photo__counter"><span id="pdCur">1</span> / <span id="pdTotal"><?php echo count( $gallery_imgs ); ?></span></div>
          <?php endif; ?>
        </div>

        <!-- Миниатюры — всегда показываем если > 1 -->
        <?php if ( count( $gallery_imgs ) > 1 ) : ?>
        <div class="pd-photo__thumbs" id="pdThumbs">
          <?php foreach ( $gallery_imgs as $i => $img ) : ?>
          <button class="pd-photo__thumb <?php echo $i === 0 ? 'pd-photo__thumb--active' : ''; ?>"
                  data-full="<?php echo esc_url( $img['full'] ); ?>"
                  data-idx="<?php echo $i; ?>">
            <img src="<?php echo esc_url( $img['thumb'] ); ?>" alt="<?php echo esc_attr( $img['alt'] ); ?>">
          </button>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- DESCRIPTION — left column -->
        <?php if ( get_the_content() ) : ?>
        <div class="pd-desc">
          <div class="pd-desc__block">
            <h2 class="pd-desc__heading">Описание</h2>
            <div class="pd-desc__text"><?php the_content(); ?></div>
          </div>
        </div>
        <?php endif; ?>
      </div>

      <!-- RIGHT: info (sticky) -->
      <aside class="pd-info">

        <?php if ( $cat_name ) : ?>
        <span class="pd-info__cat"><?php echo esc_html( $cat_name ); ?></span>
        <?php endif; ?>

        <h1 class="pd-info__title"><?php the_title(); ?></h1>

        <?php if ( $price ) : ?>
        <div class="pd-info__price-row">
          <span class="pd-info__price-label">Цена:</span>
          <span class="pd-info__price"><?php echo esc_html( $price ); ?></span>
        </div>
        <?php endif; ?>

        <div class="pd-info__cta-row">
          <a href="#contact" class="btn btn--primary pd-info__cta">Рассчитать стоимость</a>
          <button class="pd-fav-btn pd-fav-btn--inline" id="pdFavBtn"
                  data-id="<?php echo get_the_ID(); ?>"
                  data-title="<?php the_title_attribute(); ?>"
                  data-img="<?php echo esc_attr( $main_img ); ?>"
                  data-price="<?php echo esc_attr( $price ); ?>"
                  aria-pressed="false"
                  aria-label="В избранное">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
              <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
          </button>
        </div>

        <!-- Спеки — в правой панели -->
        <?php if ( $material || $term_val || $color || $dims ) : ?>
        <div class="pd-specs-group">

          <!-- Материал / Срок / Цвет -->
          <?php if ( $material || $term_val || $color ) : ?>
          <div class="pd-key-specs">
            <?php if ( $material ) : ?>
            <div class="pd-key-spec"><strong>Материал:</strong> <?php echo esc_html( $material ); ?></div>
            <?php endif; ?>
            <?php if ( $term_val ) : ?>
            <div class="pd-key-spec"><strong>Срок изготовления:</strong> <?php echo esc_html( $term_val ); ?></div>
            <?php endif; ?>
            <?php if ( $color ) : ?>
            <div class="pd-key-spec"><strong>Цвет:</strong> <?php echo esc_html( $color ); ?></div>
            <?php endif; ?>
          </div>
          <?php endif; ?>

          <!-- Габариты -->
          <?php if ( $dims ) :
            $dims_parts = array_values( array_filter( array_map('trim',
              preg_split('/[×x×\s]+/', preg_replace('/[^0-9×x×\s]/u', '', $dims))
            ) ) );
          ?>
          <div class="pd-dims">
            <div class="pd-dims__row">
              <?php if ( isset( $dims_parts[0] ) ) : ?>
              <div class="pd-dim">
                <span class="pd-dim__name">ширина</span>
                <span class="pd-dim__val"><?php echo esc_html( $dims_parts[0] ); ?> мм</span>
              </div>
              <span class="pd-dims__x">×</span>
              <?php endif; ?>
              <?php if ( isset( $dims_parts[2] ) ) : ?>
              <div class="pd-dim">
                <span class="pd-dim__name">высота</span>
                <span class="pd-dim__val"><?php echo esc_html( $dims_parts[2] ); ?> мм</span>
              </div>
              <span class="pd-dims__x">×</span>
              <?php endif; ?>
              <?php if ( isset( $dims_parts[1] ) ) : ?>
              <div class="pd-dim">
                <span class="pd-dim__name">глубина</span>
                <span class="pd-dim__val"><?php echo esc_html( $dims_parts[1] ); ?> мм</span>
              </div>
              <?php endif; ?>
            </div>
          </div>
          <?php endif; ?>


        </div><!-- /.pd-specs-group -->
        <?php endif; ?>

      </aside>

    </div><!-- /.pd-grid -->

  </div>
</section>

<!-- ============ CONTACT ============ -->
<?php get_template_part( 'template-parts/contact-section' ); ?>

<!-- ============ LIGHTBOX ============ -->
<?php if ( count( $gallery_imgs ) > 0 ) : ?>
<div class="sp-lightbox" id="spLightbox" role="dialog" aria-modal="true" hidden>
  <button class="sp-lightbox__close" id="spLbClose" aria-label="Закрыть">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
  </button>
  <button class="sp-lightbox__arrow sp-lightbox__arrow--prev" id="spLbPrev" aria-label="Назад">
    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
  </button>
  <div class="sp-lightbox__img-wrap">
    <img class="sp-lightbox__img" id="spLbImg" src="" alt="">
  </div>
  <button class="sp-lightbox__arrow sp-lightbox__arrow--next" id="spLbNext" aria-label="Вперёд">
    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
  </button>
</div>

<script>
(function(){
  var imgs = <?php echo json_encode( array_column( $gallery_imgs, 'full' ) ); ?>;
  var cur  = 0;
  var total = imgs.length;

  var mainImg   = document.getElementById('pdMainImg');
  var curEl     = document.getElementById('pdCur');
  var thumbs    = document.querySelectorAll('.pd-photo__thumb');

  function goTo(i) {
    cur = (i + total) % total;
    if (mainImg) {
      mainImg.style.opacity = '0';
      setTimeout(function(){ mainImg.src = imgs[cur]; mainImg.style.opacity = '1'; }, 150);
    }
    if (curEl) curEl.textContent = cur + 1;
    thumbs.forEach(function(b){ b.classList.remove('pd-photo__thumb--active'); });
    if (thumbs[cur]) {
      thumbs[cur].classList.add('pd-photo__thumb--active');
      thumbs[cur].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
    }
  }

  /* Кнопки стрелок */
  var btnPrev = document.getElementById('pdPrev');
  var btnNext = document.getElementById('pdNext');
  if (btnPrev) btnPrev.addEventListener('click', function(e){ e.stopPropagation(); goTo(cur - 1); });
  if (btnNext) btnNext.addEventListener('click', function(e){ e.stopPropagation(); goTo(cur + 1); });

  /* Миниатюры */
  thumbs.forEach(function(btn){
    btn.addEventListener('click', function(e){
      e.stopPropagation();
      goTo(parseInt(btn.dataset.idx, 10));
    });
  });

  /* Свайп на главном фото */
  var mainPhoto = document.getElementById('pdMainPhoto');
  var touchStartX = 0;
  if (mainPhoto) {
    mainPhoto.addEventListener('touchstart', function(e){ touchStartX = e.touches[0].clientX; }, {passive:true});
    mainPhoto.addEventListener('touchend', function(e){
      var dx = e.changedTouches[0].clientX - touchStartX;
      if (Math.abs(dx) > 40) goTo(dx < 0 ? cur + 1 : cur - 1);
    });
  }

  /* Lightbox */
  var lb     = document.getElementById('spLightbox');
  var lbImg  = document.getElementById('spLbImg');
  var lbClose= document.getElementById('spLbClose');
  var lbPrev = document.getElementById('spLbPrev');
  var lbNext = document.getElementById('spLbNext');
  var lbCur  = 0;
  if (!lb) return;

  function lbOpen(i) {
    lbCur = (i + total) % total;
    lbImg.src = imgs[lbCur];
    lb.hidden = false;
    document.body.style.overflow = 'hidden';
  }
  function lbClose2() { lb.hidden = true; document.body.style.overflow = ''; }

  /* Открыть лайтбокс по клику на главное фото */
  if (mainPhoto) mainPhoto.addEventListener('click', function(){ if(total > 1) lbOpen(cur); });

  /* Open on zoom button */
  var zoom = document.getElementById('pdZoom');
  if (zoom) zoom.addEventListener('click', function(e){ e.stopPropagation(); lbOpen(cur); });

  if (lbClose) lbClose.addEventListener('click', lbClose2);
  lb.addEventListener('click', function(e){ if (e.target === lb) lbClose2(); });
  if (lbPrev) lbPrev.addEventListener('click', function(){ lbOpen(lbCur - 1); });
  if (lbNext) lbNext.addEventListener('click', function(){ lbOpen(lbCur + 1); });
  document.addEventListener('keydown', function(e){
    if (lb.hidden) return;
    if (e.key === 'Escape')      lbClose2();
    if (e.key === 'ArrowLeft')   lbOpen(lbCur - 1);
    if (e.key === 'ArrowRight')  lbOpen(lbCur + 1);
  });
})();
</script>
<?php endif; ?>

<?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>
