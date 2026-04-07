<?php get_header(); ?>

<main id="primary" class="site-main">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post();

  $area      = get_post_meta( get_the_ID(), 'p_area',      true );
  $material  = get_post_meta( get_the_ID(), 'p_material',  true );
  $date_text = get_post_meta( get_the_ID(), 'p_date_text', true );
  $location  = get_post_meta( get_the_ID(), 'p_location',  true );
  $duration  = get_post_meta( get_the_ID(), 'p_duration',  true );
  $style     = get_post_meta( get_the_ID(), 'p_style',     true );
  $items     = get_post_meta( get_the_ID(), 'p_items_count', true );

  $cats     = get_the_terms( get_the_ID(), 'project_cat' );
  $cat_name = ( $cats && ! is_wp_error( $cats ) ) ? $cats[0]->name : '';

  $main_img = get_the_post_thumbnail_url( get_the_ID(), 'full' );
  if ( ! $main_img ) $main_img = get_template_directory_uri() . '/img/kitchen_wood_autumn.jpg';

  /* Gallery: all images attached to this post */
  $thumb_id = get_post_thumbnail_id( get_the_ID() );
  $attached = get_attached_media( 'image', get_the_ID() );
  $gallery = [];
  if ( $thumb_id ) {
    $gallery[] = $thumb_id;
  }
  foreach ( $attached as $att ) {
    if ( $att->ID !== (int) $thumb_id ) {
      $gallery[] = $att->ID;
    }
  }
  $has_gallery = count( $gallery ) > 1;

?>

<!-- ============ HERO ============ -->
<section class="sp-hero">
  <div class="sp-hero__bg" style="background-image:url('<?php echo esc_url( $main_img ); ?>')"></div>
  <div class="sp-hero__overlay"></div>
  <div class="sp-hero__content">
    <div class="container">
      <h1 class="sp-hero__title"><?php the_title(); ?></h1>
      <div class="sp-hero__actions">
        <a href="#contact" class="btn btn--primary">Рассчитать стоимость</a>
        <?php if ( $has_gallery ) : ?>
        <a href="#sp-gallery" class="sp-hero__photo-link">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
          Смотреть фото
        </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- ============ GALLERY STRIP ============ -->
<?php if ( $has_gallery ) : $total = count( $gallery ); ?>
<section class="sp-gallery" id="sp-gallery">
  <div class="sp-gallery__wrap">
    <div class="sp-gallery__track" id="spTrack">
      <?php foreach ( $gallery as $img_id ) :
        $src  = wp_get_attachment_image_url( $img_id, 'large' );
        $full = wp_get_attachment_image_url( $img_id, 'full' );
        $alt  = get_post_meta( $img_id, '_wp_attachment_image_alt', true );
        if ( ! $alt ) $alt = get_the_title();
      ?>
      <div class="sp-gallery__slide" data-full="<?php echo esc_url( $full ); ?>">
        <img src="<?php echo esc_url( $src ); ?>" alt="<?php echo esc_attr( $alt ); ?>" loading="lazy">
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="sp-gallery__footer">
    <div class="sp-gallery__nav">
      <button class="sp-gallery__arrow" id="spPrev" aria-label="Назад">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
      </button>
      <span class="sp-gallery__counter"><span id="spCur">1</span>&nbsp;—&nbsp;<span id="spTotal"><?php echo $total; ?></span></span>
      <button class="sp-gallery__arrow" id="spNext" aria-label="Вперёд">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
      </button>
    </div>
    <a href="#contact" class="sp-gallery__cta">
      Собрать проект под вас
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
    </a>
  </div>
</section>
<?php endif; ?>

<!-- ============ BREADCRUMB ============ -->
<nav class="pd-breadcrumb">
  <div class="container">
    <div class="pd-breadcrumb__inner">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
      <span class="pd-breadcrumb__sep">›</span>
      <?php
        $projects_page = get_page_by_path( 'проекты' );
        if ( ! $projects_page ) $projects_page = get_page_by_path( 'projects' );
        $projects_url  = $projects_page ? get_permalink( $projects_page ) : home_url( '/projects/' );
      ?>
      <a href="<?php echo esc_url( $projects_url ); ?>">Проекты</a>
      <span class="pd-breadcrumb__sep">›</span>
      <span class="pd-breadcrumb__current"><?php the_title(); ?></span>
    </div>
  </div>
</nav>

<!-- ============ О ПРОЕКТЕ ============ -->
<?php
  $solution  = get_post_meta( get_the_ID(), 'p_solution', true );
  $photo2    = isset( $gallery[1] ) ? wp_get_attachment_image_url( $gallery[1], 'large' ) : '';
  $photo3    = isset( $gallery[2] ) ? wp_get_attachment_image_url( $gallery[2], 'large' ) : '';
?>
<section class="sp-detail">
  <div class="container">
    <div class="sp-detail__grid">

      <!-- LEFT: task + photos + solution -->
      <div class="sp-content">

        <!-- ЗАДАЧА -->
        <?php
          $task = get_post_meta( get_the_ID(), 'p_task', true );
          if ( $task ) :
        ?>
        <div class="sp-content__block">
          <span class="sp-section-label">Задача</span>
          <div class="sp-content__text">
            <?php echo wp_kses_post( apply_filters( 'the_content', $task ) ); ?>
          </div>
        </div>
        <?php endif; ?>

        <!-- Фото после задачи -->
        <?php if ( $photo2 ) : ?>
        <div class="sp-content__photo">
          <img src="<?php echo esc_url( $photo2 ); ?>" alt="<?php the_title_attribute(); ?>">
        </div>
        <?php endif; ?>

        <!-- РЕШЕНИЕ (wp_editor) -->
        <?php if ( $solution ) : ?>
        <div class="sp-content__block">
          <span class="sp-section-label">Решение</span>
          <div class="sp-content__text">
            <?php echo wp_kses_post( apply_filters( 'the_content', $solution ) ); ?>
          </div>
        </div>
        <?php endif; ?>

        <!-- Фото после решения -->
        <?php if ( $photo3 ) : ?>
        <div class="sp-content__photo">
          <img src="<?php echo esc_url( $photo3 ); ?>" alt="<?php the_title_attribute(); ?>">
        </div>
        <?php endif; ?>

      </div>

      <!-- RIGHT: specs + CTA -->
      <aside class="sp-specs">
        <?php
          $specs = [];
          if ( $area )      $specs[] = [ 'Площадь',     $area . ' м²' ];
          if ( $material )  $specs[] = [ 'Материал',    $material ];
          if ( $style )     $specs[] = [ 'Стиль',       $style ];
          if ( $location )  $specs[] = [ 'Город',       $location ];
          if ( $duration )  $specs[] = [ 'Срок работ',  $duration ];
          if ( $date_text ) $specs[] = [ 'Дата сдачи',  $date_text ];
          if ( $items )     $specs[] = [ 'Изготовлено', $items ];
        ?>
        <?php foreach ( $specs as $s ) : ?>
        <div class="sp-spec">
          <span class="sp-spec__label"><?php echo esc_html( $s[0] ); ?></span>
          <span class="sp-spec__dots"></span>
          <span class="sp-spec__val"><?php echo esc_html( $s[1] ); ?></span>
        </div>
        <?php endforeach; ?>

        <div class="sp-specs__cta">
          <a href="#contact" class="btn btn--primary">Хочу такой же</a>
        </div>
      </aside>

    </div>
  </div>
</section>

<!-- ============ PREV / NEXT ============ -->
<?php
  $prev = get_adjacent_post( false, '', true,  'project_cat' );
  $next = get_adjacent_post( false, '', false, 'project_cat' );
  if ( $prev || $next ) :
?>
<div class="pd-nav">
  <div class="container">
    <div class="pd-nav__inner">
      <?php if ( $prev ) :
        $prev_img = get_the_post_thumbnail_url( $prev->ID, 'thumbnail' );
        if ( ! $prev_img ) $prev_img = get_template_directory_uri() . '/img/kitchen_wood_autumn.jpg';
      ?>
      <a href="<?php echo esc_url( get_permalink( $prev->ID ) ); ?>" class="pd-nav__item">
        <img src="<?php echo esc_url( $prev_img ); ?>" alt="<?php echo esc_attr( $prev->post_title ); ?>" class="pd-nav__img">
        <div>
          <div class="pd-nav__direction">← Предыдущий</div>
          <div class="pd-nav__name"><?php echo esc_html( $prev->post_title ); ?></div>
        </div>
      </a>
      <?php endif; ?>
      <?php if ( $next ) :
        $next_img = get_the_post_thumbnail_url( $next->ID, 'thumbnail' );
        if ( ! $next_img ) $next_img = get_template_directory_uri() . '/img/kitchen_wood_autumn.jpg';
      ?>
      <a href="<?php echo esc_url( get_permalink( $next->ID ) ); ?>" class="pd-nav__item pd-nav__item--next">
        <img src="<?php echo esc_url( $next_img ); ?>" alt="<?php echo esc_attr( $next->post_title ); ?>" class="pd-nav__img">
        <div>
          <div class="pd-nav__direction">Следующий →</div>
          <div class="pd-nav__name"><?php echo esc_html( $next->post_title ); ?></div>
        </div>
      </a>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php endif; ?>

<!-- ============ CONTACT ============ -->
<?php get_template_part( 'template-parts/contact-section' ); ?>

<!-- ============ GALLERY LIGHTBOX ============ -->
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
  /* --- Gallery strip --- */
  var track = document.getElementById('spTrack');
  if (track) {
    var slides = track.querySelectorAll('.sp-gallery__slide');
    var total  = slides.length;
    var cur    = 0;

    function goTo(i) {
      cur = (i + total) % total;
      slides[cur].scrollIntoView({behavior:'smooth', block:'nearest', inline:'start'});
      document.getElementById('spCur').textContent = cur + 1;
    }

    var prev = document.getElementById('spPrev');
    var next = document.getElementById('spNext');
    if (prev) prev.addEventListener('click', function(){ goTo(cur - 1); });
    if (next) next.addEventListener('click', function(){ goTo(cur + 1); });
  }

  /* --- Lightbox --- */
  var lb      = document.getElementById('spLightbox');
  var lbImg   = document.getElementById('spLbImg');
  var lbClose = document.getElementById('spLbClose');
  var lbPrev  = document.getElementById('spLbPrev');
  var lbNext  = document.getElementById('spLbNext');
  var lbCur   = 0;
  var lbSlides = document.querySelectorAll('.sp-gallery__slide');
  var lbTotal  = lbSlides.length;

  if (lbTotal === 0 || !lb) return;

  function lbOpen(i) {
    lbCur = (i + lbTotal) % lbTotal;
    lbImg.src = lbSlides[lbCur].dataset.full;
    lb.hidden = false;
    document.body.style.overflow = 'hidden';
  }
  function lbClose2() {
    lb.hidden = true;
    document.body.style.overflow = '';
  }

  lbSlides.forEach(function(s, i){ s.addEventListener('click', function(){ lbOpen(i); }); });
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

<?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>
