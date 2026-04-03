<?php
/**
 * Template Part: Home — Hero Banner
 * Структура: фоновое фото, квиз-карточка, SVG-преимущества.
 * Тексты — из post meta главной страницы (редактируются через Gutenberg sidebar).
 */
$u        = get_template_directory_uri();
$fid      = (int) get_option( 'page_on_front' );
$m        = function ( $key, $default ) use ( $fid ) {
    $v = get_post_meta( $fid, $key, true );
    return ( $v !== '' && $v !== false ) ? $v : $default;
};
?>
<section class="hero-banner" id="hero">
  <div class="container">
    <div class="hero-banner__grid">

      <!-- Главный баннер -->
      <div class="hero-banner__main">
        <div class="hero-banner__main-bg">
          <img src="<?php echo esc_url( $u ); ?>/img/kitchen_wood_autumn.jpg" alt="Современная кухня на заказ" loading="eager">
        </div>
        <div class="hero-banner__main-overlay"></div>
        <div class="hero-banner__main-content">
          <div class="hero-banner__badge"><?php echo esc_html( $m( '_nc_hero_badge', 'Собственное производство' ) ); ?></div>
          <h1 class="hero-banner__title"><?php echo esc_html( $m( '_nc_hero_title', 'Мебель на заказ' ) ); ?><br><span><?php echo esc_html( $m( '_nc_hero_title_em', 'с душой и характером' ) ); ?></span></h1>
          <p class="hero-banner__desc"><?php echo esc_html( $m( '_nc_hero_desc', 'Семейное производство с 1996 года — уже 3 поколения создают мебель, которой доверяют' ) ); ?></p>
          <div class="hero-banner__actions">
            <button class="btn btn--primary btn--lg" onclick="openModal()">
              Обратный звонок
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
              </svg>
            </button>
            <a href="<?php echo esc_url( home_url( '/catalog/' ) ); ?>" class="btn btn--white">Смотреть каталог</a>
          </div>
        </div>
      </div>

      <!-- Сайд-карточки -->
      <div class="hero-banner__side">
        <!-- Расчёт стоимости -->
        <div class="hero-banner__side-card" onclick="openQuizModal()" style="cursor:pointer;background-image:url('<?php echo esc_url( $u ); ?>/img/kitchen_dark_premium.jpg');background-size:cover;background-position:center;">
          <div class="hero-banner__side-overlay"></div>
          <div class="hero-banner__side-content">
            <div class="hero-banner__side-badge" style="background-color:var(--color-accent);">РАСЧЕТ СТОИМОСТИ</div>
            <div class="hero-banner__side-title">Пройдите короткий опрос</div>
            <p class="hero-banner__side-desc">Ответьте на 4 вопроса, чтобы мы подобрали материалы и рассчитали цену.</p>
            <span class="hero-banner__side-link">Начать расчет →</span>
          </div>
        </div>
        <!-- Преимущества в герое -->
        <div class="hero-banner__side-card hero-banner__side-card--benefits">
          <div class="hero-banner__benefits-heading">Почему выбирают нас</div>
          <div class="hero-banner__benefits-list">
            <div class="hero-banner__benefit-item">
              <div class="hero-banner__benefit-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none">
                  <rect x="9" y="7" width="30" height="34" rx="8" stroke="currentColor" stroke-width="2.4"/>
                  <path d="M24 15l8 3.3v6.1c0 5.1-3.1 9.7-8 11.4-4.9-1.7-8-6.3-8-11.4v-6.1L24 15z" stroke="currentColor" stroke-width="2.4" stroke-linejoin="round"/>
                  <path d="M20.5 24.2l2.5 2.6 4.8-5" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
              <div class="hero-banner__benefit-text">
                <strong><?php echo esc_html( $m( '_nc_hero_benefit_1_title', 'Гарантия на продукцию' ) ); ?></strong>
                <span><?php echo esc_html( $m( '_nc_hero_benefit_1_text', 'по индивидуальным условиям' ) ); ?></span>
              </div>
            </div>
            <div class="hero-banner__benefit-item">
              <div class="hero-banner__benefit-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none">
                  <rect x="8" y="10" width="32" height="28" rx="8" stroke="currentColor" stroke-width="2.4"/>
                  <path d="M16 7v6M32 7v6M8 18h32" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
                  <path d="M24 23v6l4 2.5" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                  <circle cx="24" cy="26" r="8" stroke="currentColor" stroke-width="2.4"/>
                </svg>
              </div>
              <div class="hero-banner__benefit-text">
                <strong><?php echo esc_html( $m( '_nc_hero_benefit_2_title', 'Сроки от 14 дней' ) ); ?></strong>
                <span><?php echo esc_html( $m( '_nc_hero_benefit_2_text', 'собственное производство' ) ); ?></span>
              </div>
            </div>
            <div class="hero-banner__benefit-item">
              <div class="hero-banner__benefit-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none">
                  <rect x="13" y="9" width="22" height="30" rx="6" stroke="currentColor" stroke-width="2.4"/>
                  <path d="M19 14h10M19 19h10M19 24h6" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
                  <path d="M9 35h30" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
                  <path d="M13 31l-4 4 4 4M35 31l4 4-4 4" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
              <div class="hero-banner__benefit-text">
                <strong><?php echo esc_html( $m( '_nc_hero_benefit_3_title', 'Точно по размерам' ) ); ?></strong>
                <span><?php echo esc_html( $m( '_nc_hero_benefit_3_text', 'опытные замерщики' ) ); ?></span>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
