<?php
/**
 * Novacraft — Block Patterns
 *
 * Каждая секция главной страницы — отдельный паттерн Гутенберга.
 * Вставляются через редактор: кнопка «+» → вкладка «Паттерны» → Novacraft.
 */

function novacraft_register_block_patterns(): void {
    $u = get_template_directory_uri();

    // ═══════════════════════════════════════════════════════════
    // 1. HERO BANNER
    // ═══════════════════════════════════════════════════════════
    ob_start(); ?>
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
          <div class="hero-banner__badge">Собственное производство</div>
          <h1 class="hero-banner__title">Мебель на заказ<br>с душой и <span>характером</span></h1>
          <p class="hero-banner__desc">Семейное производство с 1996 года — уже 3 поколения создают мебель, которой доверяют</p>
          <div class="hero-banner__actions">
            <button class="btn btn--primary btn--lg" onclick="openModal()">
              Обратный звонок
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
              </svg>
            </button>
            <a href="/catalog/" class="btn btn--white">Смотреть каталог</a>
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
        <!-- Преимущества -->
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
                <strong>Гарантия на продукцию</strong>
                <span>по индивидуальным условиям</span>
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
                <strong>Сроки от 14 дней</strong>
                <span>собственное производство</span>
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
                <strong>Точно по размерам</strong>
                <span>опытные замерщики</span>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
    <?php
    register_block_pattern( 'novacraft/hero', [
        'title'       => 'Hero Баннер',
        'description' => 'Главный баннер с CTA, калькулятором и преимуществами',
        'categories'  => [ 'novacraft' ],
        'content'     => '<!-- wp:html -->' . ob_get_clean() . '<!-- /wp:html -->',
    ] );

    // ═══════════════════════════════════════════════════════════
    // 2. ИКОНКИ КАТЕГОРИЙ
    // ═══════════════════════════════════════════════════════════
    ob_start(); ?>
<section class="cat-icons" id="categories">
  <div class="container">
    <div class="cat-icons__row">

      <a href="/catalog/?category=kitchen" class="cat-icon-item">
        <div class="cat-icon-item__icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
            <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
            <rect x="16" y="18" width="32" height="24" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/>
            <rect x="18" y="20" width="13" height="8" rx="2" fill="#37B7AB" opacity="0.16"/>
            <rect x="33" y="20" width="13" height="8" rx="2" fill="#37B7AB" opacity="0.16"/>
            <rect x="18" y="30" width="13" height="10" rx="2" fill="white" stroke="#6F706E" stroke-width="2"/>
            <rect x="33" y="30" width="13" height="10" rx="2" fill="white" stroke="#6F706E" stroke-width="2"/>
            <circle cx="29" cy="35" r="1.2" fill="#6F706E"/><circle cx="35" cy="35" r="1.2" fill="#6F706E"/>
            <rect x="22" y="44" width="20" height="2.5" rx="1.25" fill="#6F706E" opacity="0.65"/>
          </svg>
        </div>
        <span>Кухни</span>
      </a>

      <a href="/catalog/?category=wardrobe" class="cat-icon-item">
        <div class="cat-icon-item__icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
            <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
            <rect x="18" y="16" width="28" height="30" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/>
            <path d="M32 16V46" stroke="#6F706E" stroke-width="2"/>
            <circle cx="29" cy="31" r="1.2" fill="#6F706E"/><circle cx="35" cy="31" r="1.2" fill="#6F706E"/>
            <rect x="22" y="20" width="8" height="4" rx="2" fill="#37B7AB" opacity="0.18"/>
            <rect x="34" y="20" width="8" height="4" rx="2" fill="#37B7AB" opacity="0.18"/>
          </svg>
        </div>
        <span>Шкафы</span>
      </a>

      <a href="/catalog/?category=wardrobe" class="cat-icon-item">
        <div class="cat-icon-item__icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
            <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
            <path d="M18 44V22a4 4 0 0 1 4-4h20a4 4 0 0 1 4 4v22" stroke="#6F706E" stroke-width="2" fill="white"/>
            <path d="M24 22V44M40 22V44" stroke="#6F706E" stroke-width="2"/>
            <rect x="26.5" y="27" width="11" height="13" rx="2" fill="#37B7AB" opacity="0.18"/>
            <path d="M28 24h8" stroke="#6F706E" stroke-width="2" stroke-linecap="round"/>
            <path d="M22 46h20" stroke="#6F706E" stroke-width="2.5" stroke-linecap="round"/>
          </svg>
        </div>
        <span>Гардеробные</span>
      </a>

      <a href="/catalog/?category=bedroom" class="cat-icon-item">
        <div class="cat-icon-item__icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
            <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
            <rect x="18" y="28" width="28" height="12" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/>
            <rect x="20" y="24" width="10" height="7" rx="2" fill="#37B7AB" opacity="0.18"/>
            <rect x="16" y="22" width="4" height="22" rx="2" fill="#6F706E"/>
            <rect x="44" y="26" width="4" height="18" rx="2" fill="#6F706E"/>
            <rect x="20" y="40" width="3" height="6" rx="1.5" fill="#6F706E"/>
            <rect x="41" y="40" width="3" height="6" rx="1.5" fill="#6F706E"/>
          </svg>
        </div>
        <span>Кровати</span>
      </a>

      <a href="/catalog/?category=dresser" class="cat-icon-item">
        <div class="cat-icon-item__icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
            <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
            <rect x="19" y="18" width="26" height="26" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/>
            <path d="M19 27H45M19 35H45" stroke="#6F706E" stroke-width="2"/>
            <rect x="23" y="21" width="18" height="3" rx="1.5" fill="#37B7AB" opacity="0.18"/>
            <circle cx="32" cy="31" r="1.2" fill="#6F706E"/><circle cx="32" cy="39" r="1.2" fill="#6F706E"/>
            <rect x="23" y="44" width="18" height="2.5" rx="1.25" fill="#6F706E" opacity="0.65"/>
          </svg>
        </div>
        <span>Комоды</span>
      </a>

      <a href="/catalog/?category=storage" class="cat-icon-item">
        <div class="cat-icon-item__icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
            <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
            <rect x="18" y="18" width="28" height="24" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/>
            <path d="M18 30H46M24 24h16M24 36h16" stroke="#6F706E" stroke-width="2" stroke-linecap="round"/>
            <path d="M22 47c4-4 16-4 20 0" stroke="#37B7AB" stroke-width="3" stroke-linecap="round" opacity="0.8"/>
          </svg>
        </div>
        <span>Обувницы</span>
      </a>

      <a href="/catalog/?category=dresser" class="cat-icon-item">
        <div class="cat-icon-item__icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
            <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
            <rect x="20" y="22" width="24" height="18" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/>
            <path d="M20 31H44" stroke="#6F706E" stroke-width="2"/>
            <circle cx="32" cy="27" r="1.2" fill="#6F706E"/><circle cx="32" cy="35" r="1.2" fill="#6F706E"/>
            <rect x="24" y="40" width="3" height="7" rx="1.5" fill="#6F706E"/>
            <rect x="37" y="40" width="3" height="7" rx="1.5" fill="#6F706E"/>
            <rect x="24" y="18" width="16" height="3" rx="1.5" fill="#37B7AB" opacity="0.18"/>
          </svg>
        </div>
        <span>Тумбы</span>
      </a>

      <a href="/catalog/?category=storage" class="cat-icon-item">
        <div class="cat-icon-item__icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
            <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
            <rect x="18" y="18" width="28" height="28" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/>
            <path d="M32 18V46M18 32H46" stroke="#6F706E" stroke-width="2"/>
            <rect x="22" y="22" width="8" height="8" rx="2" fill="#37B7AB" opacity="0.18"/>
            <rect x="34" y="34" width="8" height="8" rx="2" fill="#37B7AB" opacity="0.18"/>
          </svg>
        </div>
        <span>Стеллажи</span>
      </a>

      <a href="/catalog/?category=storage" class="cat-icon-item">
        <div class="cat-icon-item__icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
            <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
            <rect x="18" y="22" width="28" height="7" rx="3.5" fill="white" stroke="#6F706E" stroke-width="2"/>
            <path d="M24 29V44M40 29V44" stroke="#6F706E" stroke-width="2.5" stroke-linecap="round"/>
            <path d="M20 44H28M36 44H44" stroke="#6F706E" stroke-width="2.5" stroke-linecap="round"/>
            <rect x="24" y="18" width="16" height="3" rx="1.5" fill="#37B7AB" opacity="0.18"/>
          </svg>
        </div>
        <span>Столы</span>
      </a>

    </div>
  </div>
</section>
    <?php
    register_block_pattern( 'novacraft/category-icons', [
        'title'       => 'Иконки категорий',
        'description' => 'Горизонтальный ряд иконок категорий мебели',
        'categories'  => [ 'novacraft' ],
        'content'     => '<!-- wp:html -->' . ob_get_clean() . '<!-- /wp:html -->',
    ] );

    // ═══════════════════════════════════════════════════════════
    // 3. ПОПУЛЯРНЫЕ КАТЕГОРИИ (с фото)
    // ═══════════════════════════════════════════════════════════
    ob_start(); ?>
<section class="section" id="catalog">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title reveal">Популярные категории</h2>
      <a href="/catalog/" class="section-link reveal">Все категории →</a>
    </div>
    <div class="pop-categories__grid reveal">

      <a href="/catalog/?category=kitchen" class="pop-cat-card pop-cat-card--large">
        <div class="pop-cat-card__img">
          <img src="<?php echo esc_url( $u ); ?>/img/kitchen_linear_herringbone.jpg" alt="Кухни на заказ" loading="lazy">
        </div>
        <div class="pop-cat-card__overlay"></div>
        <div class="pop-cat-card__content">
          <div class="pop-cat-card__name">Кухни</div>
          <div class="pop-cat-card__price">от 85 000 ₽</div>
        </div>
      </a>

      <a href="/catalog/?category=wardrobe" class="pop-cat-card">
        <div class="pop-cat-card__img">
          <img src="<?php echo esc_url( $u ); ?>/img/wardrobe_sliding_wood.jpg" alt="Шкафы и гардеробные" loading="lazy">
        </div>
        <div class="pop-cat-card__overlay"></div>
        <div class="pop-cat-card__content">
          <div class="pop-cat-card__name">Шкафы</div>
          <div class="pop-cat-card__price">от 45 000 ₽</div>
        </div>
      </a>

      <a href="/catalog/?category=storage" class="pop-cat-card">
        <div class="pop-cat-card__img">
          <img src="<?php echo esc_url( $u ); ?>/img/hallway_built_in_wardrobe.jpg" alt="Системы хранения" loading="lazy">
        </div>
        <div class="pop-cat-card__overlay"></div>
        <div class="pop-cat-card__content">
          <div class="pop-cat-card__name">Системы хранения</div>
          <div class="pop-cat-card__price">от 35 000 ₽</div>
        </div>
      </a>

      <a href="/catalog/?category=bedroom" class="pop-cat-card">
        <div class="pop-cat-card__img">
          <img src="<?php echo esc_url( $u ); ?>/img/bedroom_modern_dark.jpg" alt="Спальни" loading="lazy">
        </div>
        <div class="pop-cat-card__overlay"></div>
        <div class="pop-cat-card__content">
          <div class="pop-cat-card__name">Спальни</div>
          <div class="pop-cat-card__price">от 55 000 ₽</div>
        </div>
      </a>

      <a href="/catalog/?category=living" class="pop-cat-card">
        <div class="pop-cat-card__img">
          <img src="<?php echo esc_url( $u ); ?>/img/living_room_wide_cabinet.jpg" alt="Гостиные" loading="lazy">
        </div>
        <div class="pop-cat-card__overlay"></div>
        <div class="pop-cat-card__content">
          <div class="pop-cat-card__name">Гостиные</div>
          <div class="pop-cat-card__price">от 40 000 ₽</div>
        </div>
      </a>

    </div>
  </div>
</section>
    <?php
    register_block_pattern( 'novacraft/popular-categories', [
        'title'       => 'Популярные категории',
        'description' => 'Сетка из 5 карточек категорий с фотографиями и ценами',
        'categories'  => [ 'novacraft' ],
        'content'     => '<!-- wp:html -->' . ob_get_clean() . '<!-- /wp:html -->',
    ] );

    // ═══════════════════════════════════════════════════════════
    // 4. ПРЕИМУЩЕСТВА
    // ═══════════════════════════════════════════════════════════
    ob_start(); ?>
<section class="advantages">
  <div class="container">
    <div class="advantages__grid">

      <div class="advantage-card reveal">
        <div class="advantage-card__icon" style="background:transparent;width:64px;height:64px;margin-left:-8px;margin-top:-8px;">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none" style="width:64px;height:64px;">
            <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
            <path d="M16 46L16 26L26 20L26 28L36 22L36 30L46 24L46 46Z" fill="white" stroke="#6F706E" stroke-width="2" stroke-linejoin="round"/>
            <rect x="20" y="34" width="4" height="6" rx="1" fill="#37B7AB" opacity="0.3"/>
            <rect x="28" y="34" width="4" height="6" rx="1" fill="#37B7AB" opacity="0.3"/>
            <rect x="36" y="34" width="4" height="6" rx="1" fill="#37B7AB" opacity="0.3"/>
            <rect x="40" y="16" width="4" height="8" fill="white" stroke="#6F706E" stroke-width="2" stroke-linejoin="round"/>
            <circle cx="42" cy="11" r="2" fill="#6F706E" opacity="0.6"/>
            <circle cx="45" cy="7" r="1.5" fill="#6F706E" opacity="0.4"/>
          </svg>
        </div>
        <div>
          <div class="advantage-card__title">Собственное производство</div>
          <div class="advantage-card__text">Полный цикл — от дизайна до установки. Контроль качества на каждом этапе.</div>
        </div>
      </div>

      <div class="advantage-card reveal reveal-delay-1">
        <div class="advantage-card__icon" style="background:transparent;width:64px;height:64px;margin-left:-8px;margin-top:-8px;">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none" style="width:64px;height:64px;">
            <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
            <rect x="20" y="24" width="20" height="20" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/>
            <circle cx="30" cy="34" r="6" fill="#37B7AB" opacity="0.25"/>
            <circle cx="30" cy="34" r="3" fill="#6F706E"/>
            <path d="M40 38H52V42H40" fill="white" stroke="#6F706E" stroke-width="2"/>
            <path d="M52 38V44" stroke="#6F706E" stroke-width="2" stroke-linecap="round"/>
            <line x1="44" y1="38" x2="44" y2="40" stroke="#6F706E" stroke-width="1.5"/>
            <line x1="48" y1="38" x2="48" y2="40" stroke="#6F706E" stroke-width="1.5"/>
          </svg>
        </div>
        <div>
          <div class="advantage-card__title">Выезд и замер в зачёт заказа</div>
          <div class="advantage-card__text">Стоимость выезда полностью засчитывается в сумму заказа при оформлении договора.</div>
        </div>
      </div>

      <div class="advantage-card reveal reveal-delay-2">
        <div class="advantage-card__icon" style="background:transparent;width:64px;height:64px;margin-left:-8px;margin-top:-8px;">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none" style="width:64px;height:64px;">
            <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
            <rect x="20" y="22" width="24" height="24" rx="3" fill="white" stroke="#6F706E" stroke-width="2"/>
            <path d="M20 30H44" stroke="#6F706E" stroke-width="2"/>
            <rect x="24" y="18" width="2" height="6" rx="1" fill="#37B7AB" stroke="#6F706E" stroke-width="1.5"/>
            <rect x="38" y="18" width="2" height="6" rx="1" fill="#37B7AB" stroke="#6F706E" stroke-width="1.5"/>
            <rect x="24" y="34" width="6" height="4" rx="1" fill="#37B7AB" opacity="0.25"/>
            <rect x="34" y="34" width="6" height="4" rx="1" fill="#37B7AB" opacity="0.25"/>
            <rect x="24" y="40" width="6" height="4" rx="1" fill="#37B7AB" opacity="0.25"/>
            <circle cx="42" cy="42" r="8" fill="white" stroke="#6F706E" stroke-width="2"/>
            <path d="M42 39V42L44 44" stroke="#6F706E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
        <div>
          <div class="advantage-card__title">Сроки от 14 дней</div>
          <div class="advantage-card__text">Изготовление в кратчайшие сроки без потери качества.</div>
        </div>
      </div>

      <div class="advantage-card reveal reveal-delay-3">
        <div class="advantage-card__icon" style="background:transparent;width:64px;height:64px;margin-left:-8px;margin-top:-8px;">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none" style="width:64px;height:64px;">
            <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
            <path d="M32 18L20 22V32C20 40 25 46 32 50C39 46 44 40 44 32V22L32 18Z" fill="white" stroke="#6F706E" stroke-width="2" stroke-linejoin="round"/>
            <path d="M32 24L24 27V34C24 39 27 43 32 46C37 43 40 39 40 34V27L32 24Z" fill="#37B7AB" opacity="0.2"/>
            <path d="M26 34L30 38L38 28" stroke="#6F706E" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
        <div>
          <div class="advantage-card__title">Гарантия на продукцию</div>
          <div class="advantage-card__text">Уверены в качестве — предоставляем гарантию по индивидуальным условиям на всю мебель и фурнитуру.</div>
        </div>
      </div>

    </div>
  </div>
</section>
    <?php
    register_block_pattern( 'novacraft/advantages', [
        'title'       => 'Преимущества',
        'description' => '4 карточки с иконками и текстом преимуществ',
        'categories'  => [ 'novacraft' ],
        'content'     => '<!-- wp:html -->' . ob_get_clean() . '<!-- /wp:html -->',
    ] );

    // ═══════════════════════════════════════════════════════════
    // 5. РЕАЛИЗОВАННЫЕ ПРОЕКТЫ
    // ═══════════════════════════════════════════════════════════
    ob_start(); ?>
<section class="section" id="projects">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title reveal">Реализованные проекты</h2>
      <a href="/projects/" class="section-link reveal">Все проекты →</a>
    </div>
    <div class="projects__grid">

      <div class="project-card reveal reveal-delay-1">
        <div class="project-card__image">
          <img src="<?php echo esc_url( $u ); ?>/img/bedroom_white_storage.jpg" alt="Спальня в современном стиле" loading="lazy">
        </div>
        <div class="project-card__body">
          <span class="project-card__tag">Спальня</span>
          <h3 class="project-card__title">Встроенная система хранения</h3>
          <p class="project-card__meta">Москва · Шкаф-купе + тумбы · 18 дней</p>
        </div>
      </div>

      <div class="project-card reveal reveal-delay-2">
        <div class="project-card__image">
          <img src="<?php echo esc_url( $u ); ?>/img/living_room_tv_console.jpg" alt="Гостиная с мебелью Novacraft" loading="lazy">
        </div>
        <div class="project-card__body">
          <span class="project-card__tag">Гостиная</span>
          <h3 class="project-card__title">Стенка под телевизор и стеллаж</h3>
          <p class="project-card__meta">Нижний Новгород · Корпусная мебель · 14 дней</p>
        </div>
      </div>

      <div class="project-card reveal reveal-delay-3">
        <div class="project-card__image">
          <img src="<?php echo esc_url( $u ); ?>/img/hallway_compact_hooks.jpg" alt="Прихожая на заказ" loading="lazy">
        </div>
        <div class="project-card__body">
          <span class="project-card__tag">Прихожая</span>
          <h3 class="project-card__title">Компактная система для прихожей</h3>
          <p class="project-card__meta">Московская область · Шкаф + обувница · 12 дней</p>
        </div>
      </div>

      <div class="project-card reveal reveal-delay-4">
        <div class="project-card__image">
          <img src="<?php echo esc_url( $u ); ?>/img/kitchen_green_classic.jpg" alt="Кухня на заказ" loading="lazy">
        </div>
        <div class="project-card__body">
          <span class="project-card__tag">Кухня</span>
          <h3 class="project-card__title">Кухонный гарнитур с островом</h3>
          <p class="project-card__meta">Москва · Кухня + остров · 21 день</p>
        </div>
      </div>

    </div>
  </div>
</section>
    <?php
    register_block_pattern( 'novacraft/projects', [
        'title'       => 'Реализованные проекты',
        'description' => 'Сетка из 4 карточек проектов с фото, тегом и метой',
        'categories'  => [ 'novacraft' ],
        'content'     => '<!-- wp:html -->' . ob_get_clean() . '<!-- /wp:html -->',
    ] );

    // ═══════════════════════════════════════════════════════════
    // 6. О ПРОИЗВОДСТВЕ
    // ═══════════════════════════════════════════════════════════
    ob_start(); ?>
<section class="section section--alt" id="about">
  <div class="container">
    <div class="about__grid">

      <div class="about__image reveal">
        <img src="<?php echo esc_url( $u ); ?>/img/living_room_tv_bookshelf.jpg" alt="Производство мебели Novacraft" loading="lazy">
        <div class="about__image-badge">
          <strong>с 1996</strong>
          <span>года<br>на рынке</span>
        </div>
      </div>

      <div class="about__text reveal reveal-delay-1">
        <h2 class="section-title">О нашем производстве</h2>
        <p>
          Novacraft — семейное дело, которым занимаются уже 3 поколения — с 1996 года. За это время мы реализовали более
          <strong>5 000 заказов</strong> для <strong>более 1 000 клиентов</strong> по всей России.
        </p>
        <p>
          Каждый проект — индивидуальный. Мы работаем на современном оборудовании и контролируем каждый этап: от замера и дизайна до
          изготовления и установки. Берёмся за самые сложные задачи.
        </p>

        <div class="about__features">
          <div class="about__feature">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            Каркасы: ЛДСП 16/25мм, ЛМДФ
          </div>
          <div class="about__feature">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            Столешницы: постформинг, пластик, МДФ, камень (спецзаказ)
          </div>
          <div class="about__feature">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            Кромка: ПВХ и АБС — надёжное оформление торцов
          </div>
          <div class="about__feature">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            Гарантия на продукцию
          </div>
        </div>

        <div style="display:flex;gap:var(--space-xl);margin-top:var(--space-xl);padding-top:var(--space-lg);border-top:1px solid var(--color-border-light);">
          <div>
            <div style="font-size:1.75rem;font-weight:700;color:var(--color-accent);line-height:1;">5 000+</div>
            <div style="font-size:0.8rem;color:var(--color-text-soft);margin-top:4px;">выполненных заказов</div>
          </div>
          <div style="width:1px;background:var(--color-border);"></div>
          <div>
            <div style="font-size:1.75rem;font-weight:700;color:var(--color-accent);line-height:1;">1 000+</div>
            <div style="font-size:0.8rem;color:var(--color-text-soft);margin-top:4px;">довольных клиентов</div>
          </div>
          <div style="width:1px;background:var(--color-border);"></div>
          <div>
            <div style="font-size:1.75rem;font-weight:700;color:var(--color-accent);line-height:1;">с 1996</div>
            <div style="font-size:0.8rem;color:var(--color-text-soft);margin-top:4px;">3 поколения семьи</div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
    <?php
    register_block_pattern( 'novacraft/about', [
        'title'       => 'О производстве',
        'description' => 'Секция с фото, текстом об истории компании и статистикой',
        'categories'  => [ 'novacraft' ],
        'content'     => '<!-- wp:html -->' . ob_get_clean() . '<!-- /wp:html -->',
    ] );

    // ═══════════════════════════════════════════════════════════
    // 7. КАК МЫ РАБОТАЕМ
    // ═══════════════════════════════════════════════════════════
    ob_start(); ?>
<section class="section hww" id="process">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title reveal">Как мы работаем</h2>
      <p class="section-subtitle reveal">От первого звонка — до мебели, которой вы довольны</p>
    </div>
    <div class="hww__steps">

      <div class="hww__step reveal reveal-delay-1">
        <div class="hww__step-top">
          <div class="hww__icon-wrap">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
              <line x1="9" y1="10" x2="15" y2="10"/><line x1="9" y1="14" x2="13" y2="14"/>
            </svg>
          </div>
        </div>
        <div class="hww__step-num">01</div>
        <h3 class="hww__step-title">Заявка и&nbsp;консультация</h3>
        <p class="hww__step-text">Позвоните или оставьте заявку онлайн — ответим в течение 15 минут, обсудим пожелания и назначим удобное время.</p>
      </div>

      <div class="hww__step reveal reveal-delay-2">
        <div class="hww__step-top">
          <div class="hww__icon-wrap">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21.3 8.7 8.7 21.3c-.99.99-2.59.99-3.58 0l-2.42-2.42c-.99-.99-.99-2.59 0-3.58L15.3 2.7c.99-.99 2.59-.99 3.58 0l2.42 2.42c.99.99.99 2.59 0 3.58z"/>
              <path d="m7.5 10.5 2 2"/><path d="m10.5 7.5 2 2"/><path d="m13.5 4.5 2 2"/><path d="m4.5 13.5 2 2"/>
            </svg>
          </div>
        </div>
        <div class="hww__step-num">02</div>
        <h3 class="hww__step-title">Замер и&nbsp;дизайн-проект</h3>
        <p class="hww__step-text">Замерщик приедет в удобное время, снимет точные размеры и подготовит детальный 3D-проект вашей мебели.</p>
      </div>

      <div class="hww__step reveal reveal-delay-3">
        <div class="hww__step-top">
          <div class="hww__icon-wrap">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
              <polyline points="14 2 14 8 20 8"/><polyline points="9 13 11 15 15 11"/>
            </svg>
          </div>
        </div>
        <div class="hww__step-num">03</div>
        <h3 class="hww__step-title">Согласование и&nbsp;договор</h3>
        <p class="hww__step-text">Вместе вносим правки, фиксируем всё в договоре: материалы, сроки, стоимость — без скрытых доплат.</p>
      </div>

      <div class="hww__step reveal reveal-delay-4">
        <div class="hww__step-top">
          <div class="hww__icon-wrap">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"/>
              <path d="M12 14a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
              <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/>
            </svg>
          </div>
        </div>
        <div class="hww__step-num">04</div>
        <h3 class="hww__step-title">Производство</h3>
        <p class="hww__step-text">Запускаем изготовление на собственном производстве. Сроки — от 14 дней, за ходом можно следить онлайн.</p>
      </div>

      <div class="hww__step reveal reveal-delay-5">
        <div class="hww__step-top">
          <div class="hww__icon-wrap">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
              <polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
        </div>
        <div class="hww__step-num">05</div>
        <h3 class="hww__step-title">Доставка и&nbsp;сборка</h3>
        <p class="hww__step-text">Доставим и соберём мебель в удобное время. Уберём мусор, проверим каждый элемент — и только потом уйдём.</p>
      </div>

    </div>
  </div>
</section>
    <?php
    register_block_pattern( 'novacraft/process', [
        'title'       => 'Как мы работаем',
        'description' => '5 шагов рабочего процесса с иконками и описаниями',
        'categories'  => [ 'novacraft' ],
        'content'     => '<!-- wp:html -->' . ob_get_clean() . '<!-- /wp:html -->',
    ] );

    // ═══════════════════════════════════════════════════════════
    // 8. КОНТАКТЫ / CTA
    // ═══════════════════════════════════════════════════════════
    ob_start(); ?>
<section class="section section--contact" id="contact">
  <div class="container">
    <div class="contact__bg-word">NOVACRAFT</div>
    <div class="contact__grid">

      <div class="contact__info reveal">
        <div class="contact__info-body">
          <p class="contact__info-eyebrow">Мы на связи</p>
          <h2 class="contact__info-title">Поможем выбрать<br>и&nbsp;рассчитаем стоимость</h2>
          <p class="contact__info-sub">Ответим на все вопросы и подготовим предварительный расчёт стоимости проекта.</p>

          <div class="contact__cards">
            <a href="tel:+79160128777" class="contact__card">
              <div class="contact__card-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                </svg>
              </div>
              <div>
                <div class="contact__card-label">Телефон</div>
                <div class="contact__card-value">+7 (916) 012-87-77</div>
              </div>
              <svg class="contact__card-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>

            <a href="https://t.me/novikov8777" target="_blank" class="contact__card">
              <div class="contact__card-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M22 2L11 13"/>
                  <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                </svg>
              </div>
              <div>
                <div class="contact__card-label">Telegram</div>
                <div class="contact__card-value">@novikov8777</div>
              </div>
              <svg class="contact__card-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>

            <div class="contact__card contact__card--addr">
              <div class="contact__card-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                  <circle cx="12" cy="10" r="3"/>
                </svg>
              </div>
              <div>
                <div class="contact__card-label">Производство и офис</div>
                <div class="contact__card-value">г. Нижний Новгород,<br>ул. Маршала Воронова, 11</div>
              </div>
            </div>
          </div>

          <div class="contact__hours">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            Ежедневно с 9:00 до 21:00
          </div>
        </div>
      </div>

      <div class="contact__form-wrapper reveal reveal-delay-1">
        <h3 class="contact__form-title">Оставить заявку</h3>
        <p class="contact__form-subtitle">Заполните форму и мы свяжемся с вами в течение часа</p>
        <form id="contactForm" onsubmit="handleSubmit(event)">
          <div class="form-row">
            <div class="form-group">
              <label for="contactName">Имя *</label>
              <input type="text" id="contactName" name="name" placeholder="Антон" required>
            </div>
            <div class="form-group">
              <label for="contactPhone">Телефон *</label>
              <input type="tel" id="contactPhone" name="phone" placeholder="+7 (___) ___-__-__" required>
            </div>
          </div>
          <div class="form-group">
            <label for="contactService">Что вас интересует?</label>
            <select id="contactService" name="service">
              <option value="">Выберите услугу</option>
              <option value="kitchen">Кухня на заказ</option>
              <option value="wardrobe">Шкаф / Шкаф-купе</option>
              <option value="closet">Гардеробная</option>
              <option value="storage">Системы хранения</option>
              <option value="tvunit">Стенка под телевизор</option>
              <option value="other">Другое</option>
            </select>
          </div>
          <div class="form-group">
            <label for="contactMessage">Комментарий</label>
            <textarea id="contactMessage" name="message" placeholder="Опишите ваш проект — размеры, материалы, пожелания..."></textarea>
          </div>
          <div class="form-consent">
            <input type="checkbox" id="contactConsent" required>
            <label for="contactConsent">Нажимая кнопку, вы соглашаетесь на обработку персональных данных</label>
          </div>
          <button type="submit" class="btn btn--primary btn--lg" style="width:100%;margin-top:var(--space-md);">
            Отправить заявку
          </button>
        </form>
      </div>

    </div>
  </div>
</section>
    <?php
    register_block_pattern( 'novacraft/contact', [
        'title'       => 'Контакты и форма заявки',
        'description' => 'Секция с контактами и формой обратной связи',
        'categories'  => [ 'novacraft' ],
        'content'     => '<!-- wp:html -->' . ob_get_clean() . '<!-- /wp:html -->',
    ] );
}
add_action( 'init', 'novacraft_register_block_patterns' );
