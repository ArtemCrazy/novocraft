<?php
get_header(); ?>


  <!-- ============ HERO BANNER ============ -->
  <section class="hero-banner" id="hero">
    <div class="container">
      <div class="hero-banner__grid">
        <!-- Main banner -->
        <div class="hero-banner__main">
          <div class="hero-banner__main-bg">
  <?php
    $h_bg = function_exists('get_field') ? get_field('h_bg') : false;
    $h_bg = $h_bg ?: get_template_directory_uri() . '/img/kitchen_wood_autumn.jpg';
    
    $get_f = function($k, $d) { 
        if (function_exists('get_field') && get_field($k)) return get_field($k);
        $val = get_post_meta(get_the_ID(), $k, true);
        return $val ? $val : $d;
    };

    $h_badge = $get_f('h_badge', 'Собственное производство');
    $h_title = $get_f('h_title', 'Мебель на заказ<br>с душой и <span>характером</span>');
    $h_desc = $get_f('h_desc', 'Семейное производство с 1996 года — уже 3 поколения создают мебель, которой доверяют');
    $h_btn_text = $get_f('h_btn_text', 'Смотреть каталог');
    $h_btn_link = $get_f('h_btn_link', get_post_type_archive_link('furniture'));

    $hq_bg = $get_f('hq_bg', get_template_directory_uri() . '/img/kitchen_dark_premium.jpg');
    $hq_badge = $get_f('hq_badge', 'РАСЧЕТ СТОИМОСТИ');
    $hq_title = $get_f('hq_title', 'Пройдите короткий опрос');
    $hq_desc = $get_f('hq_desc', 'Ответьте на 4 вопроса, чтобы мы подобрали материалы и рассчитали цену.');
    $hq_link = $get_f('hq_link', 'Начать расчет &rarr;');
  ?>
            <img src="<?php echo esc_url($h_bg); ?>" alt="<?php echo esc_attr(strip_tags($h_title)); ?>" loading="eager">
          </div>
          <div class="hero-banner__main-overlay"></div>
          <div class="hero-banner__main-content">
            <div class="hero-banner__badge"><?php echo esc_html($h_badge); ?></div>
            <h1 class="hero-banner__title"><?php echo wp_kses_post($h_title); ?></h1>
            <p class="hero-banner__desc"><?php echo esc_html($h_desc); ?></p>
            <div class="hero-banner__actions">
              <button class="btn btn--primary btn--lg" onclick="openModal()">
                Обратный звонок
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="5" y1="12" x2="19" y2="12" />
                  <polyline points="12 5 19 12 12 19" />
                </svg>
              </button>
              <a href="<?php echo esc_url($h_btn_link); ?>" class="btn btn--white"><?php echo esc_html($h_btn_text); ?></a>
            </div>
          </div>
        </div>
        <!-- Side banners -->
        <div class="hero-banner__side">
          <div class="hero-banner__side-card" onclick="openQuizModal()" style="cursor: pointer; background-image: url('<?php echo esc_url($hq_bg); ?>'); background-size: cover; background-position: center;">
            <div class="hero-banner__side-overlay"></div>
            <div class="hero-banner__side-content">
              <div class="hero-banner__side-badge" style="background-color: var(--color-accent);"><?php echo esc_html($hq_badge); ?></div>
              <div class="hero-banner__side-title"><?php echo esc_html($hq_title); ?></div>
              <p class="hero-banner__side-desc"><?php echo esc_html($hq_desc); ?></p>
              <span class="hero-banner__side-link"><?php echo wp_kses_post($hq_link); ?></span>
            </div>
          </div>
          <div class="hero-banner__side-card hero-banner__side-card--benefits reveal reveal-delay-3">
            <?php $hb_title = (function_exists('get_field') && get_field('hb_title')) ? get_field('hb_title') : 'Почему выбирают нас'; ?>
            <div class="hero-banner__benefits-heading"><?php echo esc_html($hb_title); ?></div>
            <div class="hero-banner__benefits-list">
              <?php if( function_exists('have_rows') && have_rows('hb_list') ): ?>
                <?php while( have_rows('hb_list') ): the_row(); 
                  $icon = get_sub_field('icon');
                  $title = get_sub_field('title');
                  $desc = get_sub_field('desc');
                ?>
                <div class="hero-banner__benefit-item">
                  <div class="hero-banner__benefit-icon"><?php echo $icon; ?></div>
                  <div class="hero-banner__benefit-text">
                    <strong><?php echo esc_html($title); ?></strong>
                    <span><?php echo esc_html($desc); ?></span>
                  </div>
                </div>
                <?php endwhile; ?>
              <?php else: ?>
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
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ CATEGORY ICONS ROW ============ -->
  <section class="cat-icons" id="categories">
    <div class="container">
      <div class="cat-icons__row">
        <a href="<?php echo get_post_type_archive_link('furniture'); ?>?category=kitchen" class="cat-icon-item">
          <div class="cat-icon-item__icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
              <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
              <rect x="16" y="18" width="32" height="24" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/>
              <rect x="18" y="20" width="13" height="8" rx="2" fill="#37B7AB" opacity="0.16"/>
              <rect x="33" y="20" width="13" height="8" rx="2" fill="#37B7AB" opacity="0.16"/>
              <rect x="18" y="30" width="13" height="10" rx="2" fill="white" stroke="#6F706E" stroke-width="2"/>
              <rect x="33" y="30" width="13" height="10" rx="2" fill="white" stroke="#6F706E" stroke-width="2"/>
              <circle cx="29" cy="35" r="1.2" fill="#6F706E"/>
              <circle cx="35" cy="35" r="1.2" fill="#6F706E"/>
              <rect x="22" y="44" width="20" height="2.5" rx="1.25" fill="#6F706E" opacity="0.65"/>
            </svg>
          </div>
          <span>Кухни</span>
        </a>
        <a href="<?php echo get_post_type_archive_link('furniture'); ?>?category=wardrobe" class="cat-icon-item">
          <div class="cat-icon-item__icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
              <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
              <rect x="18" y="16" width="28" height="30" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/>
              <path d="M32 16V46" stroke="#6F706E" stroke-width="2"/>
              <circle cx="29" cy="31" r="1.2" fill="#6F706E"/>
              <circle cx="35" cy="31" r="1.2" fill="#6F706E"/>
              <rect x="22" y="20" width="8" height="4" rx="2" fill="#37B7AB" opacity="0.18"/>
              <rect x="34" y="20" width="8" height="4" rx="2" fill="#37B7AB" opacity="0.18"/>
            </svg>
          </div>
          <span>Шкафы</span>
        </a>
        <a href="<?php echo get_post_type_archive_link('furniture'); ?>?category=wardrobe" class="cat-icon-item">
          <div class="cat-icon-item__icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
              <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
              <path d="M18 44V22a4 4 0 0 1 4-4h20a4 4 0 0 1 4 4v22" stroke="#6F706E" stroke-width="2" fill="white"/>
              <path d="M24 22V44" stroke="#6F706E" stroke-width="2"/>
              <path d="M40 22V44" stroke="#6F706E" stroke-width="2"/>
              <rect x="26.5" y="27" width="11" height="13" rx="2" fill="#37B7AB" opacity="0.18"/>
              <path d="M28 24h8" stroke="#6F706E" stroke-width="2" stroke-linecap="round"/>
              <path d="M22 46h20" stroke="#6F706E" stroke-width="2.5" stroke-linecap="round"/>
            </svg>
          </div>
          <span>Гардеробные</span>
        </a>
        <a href="<?php echo get_post_type_archive_link('furniture'); ?>?category=dresser" class="cat-icon-item">
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
        <a href="<?php echo get_post_type_archive_link('furniture'); ?>?category=dresser" class="cat-icon-item">
          <div class="cat-icon-item__icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
              <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
              <rect x="19" y="18" width="26" height="26" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/>
              <path d="M19 27H45" stroke="#6F706E" stroke-width="2"/>
              <path d="M19 35H45" stroke="#6F706E" stroke-width="2"/>
              <rect x="23" y="21" width="18" height="3" rx="1.5" fill="#37B7AB" opacity="0.18"/>
              <circle cx="32" cy="31" r="1.2" fill="#6F706E"/>
              <circle cx="32" cy="39" r="1.2" fill="#6F706E"/>
              <rect x="23" y="44" width="18" height="2.5" rx="1.25" fill="#6F706E" opacity="0.65"/>
            </svg>
          </div>
          <span>Комоды</span>
        </a>
        <a href="<?php echo get_post_type_archive_link('furniture'); ?>?category=storage" class="cat-icon-item">
          <div class="cat-icon-item__icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
              <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
              <rect x="18" y="18" width="28" height="24" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/>
              <path d="M18 30H46" stroke="#6F706E" stroke-width="2"/>
              <path d="M24 24h16" stroke="#6F706E" stroke-width="2" stroke-linecap="round"/>
              <path d="M24 36h16" stroke="#6F706E" stroke-width="2" stroke-linecap="round"/>
              <path d="M22 47c4-4 16-4 20 0" stroke="#37B7AB" stroke-width="3" stroke-linecap="round" opacity="0.8"/>
            </svg>
          </div>
          <span>Обувницы</span>
        </a>
        <a href="<?php echo get_post_type_archive_link('furniture'); ?>?category=dresser" class="cat-icon-item">
          <div class="cat-icon-item__icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
              <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
              <rect x="20" y="22" width="24" height="18" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/>
              <path d="M20 31H44" stroke="#6F706E" stroke-width="2"/>
              <circle cx="32" cy="27" r="1.2" fill="#6F706E"/>
              <circle cx="32" cy="35" r="1.2" fill="#6F706E"/>
              <rect x="24" y="40" width="3" height="7" rx="1.5" fill="#6F706E"/>
              <rect x="37" y="40" width="3" height="7" rx="1.5" fill="#6F706E"/>
              <rect x="24" y="18" width="16" height="3" rx="1.5" fill="#37B7AB" opacity="0.18"/>
            </svg>
          </div>
          <span>Тумбы</span>
        </a>
        <a href="<?php echo get_post_type_archive_link('furniture'); ?>?category=storage" class="cat-icon-item">
          <div class="cat-icon-item__icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
              <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
              <rect x="18" y="18" width="28" height="28" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/>
              <path d="M32 18V46" stroke="#6F706E" stroke-width="2"/>
              <path d="M18 32H46" stroke="#6F706E" stroke-width="2"/>
              <rect x="22" y="22" width="8" height="8" rx="2" fill="#37B7AB" opacity="0.18"/>
              <rect x="34" y="34" width="8" height="8" rx="2" fill="#37B7AB" opacity="0.18"/>
            </svg>
          </div>
          <span>Стеллажи</span>
        </a>
        <a href="<?php echo get_post_type_archive_link('furniture'); ?>?category=storage" class="cat-icon-item">
          <div class="cat-icon-item__icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
              <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
              <rect x="18" y="22" width="28" height="7" rx="3.5" fill="white" stroke="#6F706E" stroke-width="2"/>
              <path d="M24 29V44" stroke="#6F706E" stroke-width="2.5" stroke-linecap="round"/>
              <path d="M40 29V44" stroke="#6F706E" stroke-width="2.5" stroke-linecap="round"/>
              <path d="M20 44H28" stroke="#6F706E" stroke-width="2.5" stroke-linecap="round"/>
              <path d="M36 44H44" stroke="#6F706E" stroke-width="2.5" stroke-linecap="round"/>
              <rect x="24" y="18" width="16" height="3" rx="1.5" fill="#37B7AB" opacity="0.18"/>
            </svg>
          </div>
          <span>Столы</span>
        </a>
      </div>
    </div>
  </section>

  <!-- ============ ADVANTAGES ============ -->
  <section class="advantages">
    <div class="container">
      <div class="advantages__grid">
        <div class="advantage-card reveal">
          <div class="advantage-card__icon" style="background: transparent; width: 64px; height: 64px; margin-left: -8px; margin-top: -8px;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none" style="width: 64px; height: 64px;">
              <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
              <!-- Building -->
              <path d="M 16 46 L 16 26 L 26 20 L 26 28 L 36 22 L 36 30 L 46 24 L 46 46 Z" fill="white" stroke="#6F706E" stroke-width="2" stroke-linejoin="round"/>
              <!-- Windows -->
              <rect x="20" y="34" width="4" height="6" rx="1" fill="#37B7AB" opacity="0.3"/>
              <rect x="28" y="34" width="4" height="6" rx="1" fill="#37B7AB" opacity="0.3"/>
              <rect x="36" y="34" width="4" height="6" rx="1" fill="#37B7AB" opacity="0.3"/>
              <!-- Chimney -->
              <rect x="40" y="16" width="4" height="8" fill="white" stroke="#6F706E" stroke-width="2" stroke-linejoin="round"/>
              <!-- Smoke -->
              <circle cx="42" cy="11" r="2" fill="#6F706E" opacity="0.6"/>
              <circle cx="45" cy="7" r="1.5" fill="#6F706E" opacity="0.4"/>
            </svg>
          </div>
          <div>
            <div class="advantage-card__title">Собственное производство</div>
            <div class="advantage-card__text">Полный цикл — от дизайна до установки. Контроль качества на каждом этапе.
            </div>
          </div>
        </div>
        <div class="advantage-card reveal reveal-delay-1">
          <div class="advantage-card__icon" style="background: transparent; width: 64px; height: 64px; margin-left: -8px; margin-top: -8px;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none" style="width: 64px; height: 64px;">
              <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
              <!-- Tape measure body -->
              <rect x="20" y="24" width="20" height="20" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/>
              <circle cx="30" cy="34" r="6" fill="#37B7AB" opacity="0.25"/>
              <circle cx="30" cy="34" r="3" fill="#6F706E"/>
              <!-- Tape stretching out -->
              <path d="M40 38 H 52 V 42 H 40" fill="white" stroke="#6F706E" stroke-width="2"/>
              <!-- Tape hook -->
              <path d="M52 38 V 44" stroke="#6F706E" stroke-width="2" stroke-linecap="round"/>
              <!-- Marks on tape -->
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
          <div class="advantage-card__icon" style="background: transparent; width: 64px; height: 64px; margin-left: -8px; margin-top: -8px;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none" style="width: 64px; height: 64px;">
              <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
              <!-- Calendar Body -->
              <rect x="20" y="22" width="24" height="24" rx="3" fill="white" stroke="#6F706E" stroke-width="2"/>
              <!-- Calendar Top bar -->
              <path d="M20 30 H 44" stroke="#6F706E" stroke-width="2"/>
              <!-- Calendar Rings -->
              <rect x="24" y="18" width="2" height="6" rx="1" fill="#37B7AB" stroke="#6F706E" stroke-width="1.5"/>
              <rect x="38" y="18" width="2" height="6" rx="1" fill="#37B7AB" stroke="#6F706E" stroke-width="1.5"/>
              <!-- Accent squares -->
              <rect x="24" y="34" width="6" height="4" rx="1" fill="#37B7AB" opacity="0.25"/>
              <rect x="34" y="34" width="6" height="4" rx="1" fill="#37B7AB" opacity="0.25"/>
              <rect x="24" y="40" width="6" height="4" rx="1" fill="#37B7AB" opacity="0.25"/>
              <!-- Clock in corner overlapping -->
              <circle cx="42" cy="42" r="8" fill="white" stroke="#6F706E" stroke-width="2"/>
              <path d="M42 39 V 42 L 44 44" stroke="#6F706E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <div>
            <div class="advantage-card__title">Сроки от 14 дней</div>
            <div class="advantage-card__text">Изготовление в кратчайшие сроки без потери качества.</div>
          </div>
        </div>
        <div class="advantage-card reveal reveal-delay-3">
          <div class="advantage-card__icon" style="background: transparent; width: 64px; height: 64px; margin-left: -8px; margin-top: -8px;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none" style="width: 64px; height: 64px;">
              <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
              <!-- Shield -->
              <path d="M32 18 L20 22 V32 C20 40 25 46 32 50 C39 46 44 40 44 32 V22 L32 18 Z" fill="white" stroke="#6F706E" stroke-width="2" stroke-linejoin="round"/>
              <!-- Accent shape inside shield -->
              <path d="M32 24 L24 27 V34 C24 39 27 43 32 46 C37 43 40 39 40 34 V27 L32 24 Z" fill="#37B7AB" opacity="0.2"/>
              <!-- Checkmark -->
              <path d="M26 34 L30 38 L38 28" stroke="#6F706E" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
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

  <!-- ============ PROJECTS (Products-like grid) ============ -->
  <section class="section" id="projects">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title reveal">Реализованные проекты</h2>
        <a href="<?php echo get_post_type_archive_link('project'); ?>" class="section-link reveal">Все проекты →</a>
      </div>

      <div class="projects__grid">
        <div class="project-card reveal reveal-delay-1">
          <div class="project-card__image">
            <img src="<?php echo get_template_directory_uri(); ?>/img/bedroom_white_storage.jpg" alt="Спальня в современном стиле" loading="lazy">
          </div>
          <div class="project-card__body">
            <span class="project-card__tag">Спальня</span>
            <h3 class="project-card__title">Встроенная система хранения</h3>
            <p class="project-card__meta">Москва · Шкаф-купе + тумбы · 18 дней</p>
          </div>
        </div>

        <div class="project-card reveal reveal-delay-2">
          <div class="project-card__image">
            <img src="<?php echo get_template_directory_uri(); ?>/img/living_room_tv_console.jpg" alt="Гостиная с мебелью Novacraft" loading="lazy">
          </div>
          <div class="project-card__body">
            <span class="project-card__tag">Гостиная</span>
            <h3 class="project-card__title">Стенка под телевизор и стеллаж</h3>
            <p class="project-card__meta">Нижний Новгород · Корпусная мебель · 14 дней</p>
          </div>
        </div>

        <div class="project-card reveal reveal-delay-3">
          <div class="project-card__image">
            <img src="<?php echo get_template_directory_uri(); ?>/img/hallway_compact_hooks.jpg" alt="Прихожая на заказ" loading="lazy">
          </div>
          <div class="project-card__body">
            <span class="project-card__tag">Прихожая</span>
            <h3 class="project-card__title">Компактная система для прихожей</h3>
            <p class="project-card__meta">Московская область · Шкаф + обувница · 12 дней</p>
          </div>
        </div>

        <div class="project-card reveal reveal-delay-4">
          <div class="project-card__image">
            <img src="<?php echo get_template_directory_uri(); ?>/img/kitchen_green_classic.jpg" alt="Кухня на заказ" loading="lazy">
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

  <!-- ============ ABOUT ============ -->
  <section class="section section--alt" id="about">
    <div class="container">
      <div class="about__grid">
        <div class="about__image reveal">
          <img src="<?php echo get_template_directory_uri(); ?>/img/living_room_tv_bookshelf.jpg" alt="Производство мебели Novacraft" loading="lazy">
          <div class="about__image-badge">
            <strong>с 1996</strong>
            <span>года<br>на рынке</span>
          </div>
        </div>
        <div class="about__text reveal reveal-delay-1">
          <h2 class="section-title">О нашем производстве</h2>
          <p>
            Novacraft — семейное дело, которым занимаются уже 3 поколения — с 1996 года. За это время мы реализовали более
            <strong>5 000 заказов</strong> для <strong>более 1 000 клиентов</strong> по всей России.
          </p>
          <p>
            Каждый проект — индивидуальный. Мы работаем на современном оборудовании и контролируем каждый этап: от замера и дизайна до
            изготовления и установки. Берёмся за самые сложные задачи.
          </p>

          <div class="about__features">
            <div class="about__feature">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12" />
              </svg>
              Каркасы: ЛДСП 16/25мм, ЛМДФ
            </div>
            <div class="about__feature">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12" />
              </svg>
              Столешницы: постформинг, пластик, МДФ, камень (спецзаказ)
            </div>
            <div class="about__feature">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12" />
              </svg>
              Кромка: ПВХ и АБС — надёжное оформление торцов
            </div>
            <div class="about__feature">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12" />
              </svg>
              Гарантия на продукцию
            </div>
          </div>

          <div class="about__stats">
            <div class="about__stat-item">
              <div class="about__stat-value">5 000+</div>
              <div class="about__stat-label">выполненных заказов</div>
            </div>
            <div class="about__stats-divider"></div>
            <div class="about__stat-item">
              <div class="about__stat-value">1 000+</div>
              <div class="about__stat-label">довольных клиентов</div>
            </div>
            <div class="about__stats-divider"></div>
            <div class="about__stat-item">
              <div class="about__stat-value">с 1996</div>
              <div class="about__stat-label">3 поколения семьи</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ PROCESS ============ -->
  <section class="section hww" id="process">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title reveal">Как мы работаем</h2>
        <p class="section-subtitle reveal">От первого звонка — до мебели, которой вы довольны</p>
      </div>

      <div class="hww__steps">

        <!-- Step 1 -->
        <div class="hww__step reveal reveal-delay-1">
          <div class="hww__step-top">
            <div class="hww__icon-wrap">
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                <line x1="9" y1="10" x2="15" y2="10"/>
                <line x1="9" y1="14" x2="13" y2="14"/>
              </svg>
            </div>
          </div>
          <div class="hww__step-num">01</div>
          <h3 class="hww__step-title">Заявка и&nbsp;консультация</h3>
          <p class="hww__step-text">Позвоните или оставьте заявку онлайн — ответим в течение 15 минут, обсудим пожелания и назначим удобное время.</p>
        </div>

        <!-- Step 2 -->
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

        <!-- Step 3 -->
        <div class="hww__step reveal reveal-delay-3">
          <div class="hww__step-top">
            <div class="hww__icon-wrap">
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                <polyline points="14 2 14 8 20 8"/>
                <polyline points="9 13 11 15 15 11"/>
              </svg>
            </div>
          </div>
          <div class="hww__step-num">03</div>
          <h3 class="hww__step-title">Согласование и&nbsp;договор</h3>
          <p class="hww__step-text">Вместе вносим правки, фиксируем всё в договоре: материалы, сроки, стоимость — без скрытых доплат.</p>
        </div>

        <!-- Step 4 -->
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

        <!-- Step 5 -->
        <div class="hww__step reveal reveal-delay-5">
          <div class="hww__step-top">
            <div class="hww__icon-wrap">
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                <polyline points="9 22 9 12 15 12 15 22"/>
                <polyline points="7 9 12 5 17 9"/>
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

  <?php get_template_part('template-parts/contact-section'); ?>

<?php get_footer(); ?>
