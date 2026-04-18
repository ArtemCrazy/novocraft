<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Novacraft — Мебель на заказ | Собственное производство</title>
  <meta name="description"
    content="Novacraft — изготовление мебели на заказ в Москве и Нижнем Новгороде. Кухни, шкафы, гардеробные. Собственное производство, опыт 30+ лет. Выезд замерщика.">
  <meta name="keywords"
    content="мебель на заказ, кухня на заказ, шкаф-купе, гардеробная, мебель Москва, мебель Нижний Новгород">
  
  <link rel="icon" type="image/png" href="<?php echo esc_url(get_template_directory_uri() . '/img/Logo.png'); ?>" sizes="32x32">
  <link rel="shortcut icon" type="image/png" href="<?php echo esc_url(get_template_directory_uri() . '/img/Logo.png'); ?>">
  <link rel="apple-touch-icon" href="<?php echo esc_url(get_template_directory_uri() . '/img/Logo.png'); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

  <!-- ============ TOP BAR ============ -->
  <?php $c = novacraft_contacts(); ?>
  <div class="topbar">
    <div class="container topbar__inner">
      <div class="topbar__left"><span><?php echo esc_html($c['address'] ?: 'г. Москва, МО, Нижний Новгород'); ?></span><span class="topbar__sep">|</span><span><?php echo esc_html($c['work_hours'] ?: 'Ежедневно 9:00–21:00'); ?></span></div>
      <div class="topbar__right">
        <?php $email = $c['email'] ?: '9160128777@mail.ru'; ?>
        <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
        <span class="topbar__sep">|</span>
        <?php if($c['whatsapp']): ?>
        <a href="<?php echo esc_url($c['whatsapp']); ?>" target="_blank" class="topbar__messenger"><img src="<?php echo site_url('/wp-content/themes/novocraft/icons/'); ?>whatsapp-2 2.png" alt="WhatsApp"></a>
        <?php endif; ?>
        <?php if($c['telegram']): ?>
        <a href="<?php echo esc_url($c['telegram']); ?>" target="_blank" class="topbar__messenger"><img src="<?php echo site_url('/wp-content/themes/novocraft/icons/'); ?>Vector.png" alt="Telegram"></a>
        <?php endif; ?>
        <?php if($c['max']): ?>
        <a href="<?php echo esc_url($c['max']); ?>" target="_blank" class="topbar__messenger"><img src="<?php echo site_url('/wp-content/themes/novocraft/icons/'); ?>max.png" alt="MAX"></a>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- ============ HEADER ============ -->
  <header class="header" id="header">
    <div class="container header__inner">
      <a href="<?php echo home_url('/'); ?>" class="header__logo">
        <img src="<?php echo get_template_directory_uri(); ?>/img/Logo.png" alt="Novocraft" class="header__logo-img">
        <div>
          <div class="header__logo-text">Nova<span>craft</span></div>
          <div class="header__logo-sub">мебель на заказ</div>
        </div>
      </a>

      <nav class="header__nav" id="mainNav">
        <div class="dropdown">
          <a href="<?php echo get_post_type_archive_link('furniture'); ?>" class="dropdown__toggle nav-audience">
            Для дома
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              style="margin-left: 2px; transition: transform 0.2s;">
              <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
          </a>
          <div class="dropdown__menu dropdown__menu--mega">
            <div class="megamenu__header">
              <span class="megamenu__title">Мебель на заказ</span>
              <a href="<?php echo get_post_type_archive_link('furniture'); ?>" class="megamenu__all">Весь каталог →</a>
            </div>
            <div class="megamenu__grid">

              <a href="<?php echo get_post_type_archive_link('furniture'); ?>?category=kitchen" class="megamenu__item">
                <div class="megamenu__icon">
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

              <a href="<?php echo get_post_type_archive_link('furniture'); ?>?category=wardrobe" class="megamenu__item">
                <div class="megamenu__icon">
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

              <a href="<?php echo get_post_type_archive_link('furniture'); ?>?category=wardrobe" class="megamenu__item">
                <div class="megamenu__icon">
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

              <a href="<?php echo get_post_type_archive_link('furniture'); ?>?category=bedroom" class="megamenu__item">
                <div class="megamenu__icon">
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

              <a href="<?php echo get_post_type_archive_link('furniture'); ?>?category=dresser" class="megamenu__item">
                <div class="megamenu__icon">
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

              <a href="<?php echo get_post_type_archive_link('furniture'); ?>?category=storage" class="megamenu__item">
                <div class="megamenu__icon">
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

              <a href="<?php echo get_post_type_archive_link('furniture'); ?>?category=hallway" class="megamenu__item">
                <div class="megamenu__icon">
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

              <a href="<?php echo get_post_type_archive_link('furniture'); ?>?category=office" class="megamenu__item">
                <div class="megamenu__icon">
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

              <a href="<?php echo get_post_type_archive_link('furniture'); ?>?category=bedside" class="megamenu__item">
                <div class="megamenu__icon">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
                    <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
                    <rect x="20" y="20" width="24" height="22" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/>
                    <path d="M20 31h24" stroke="#6F706E" stroke-width="2"/>
                    <circle cx="32" cy="26" r="1.5" fill="#6F706E"/>
                    <circle cx="32" cy="36.5" r="1.5" fill="#6F706E"/>
                    <rect x="22" y="22" width="20" height="4" rx="1" fill="#37B7AB" opacity="0.18"/>
                    <path d="M24 42v4M40 42v4" stroke="#6F706E" stroke-width="2" stroke-linecap="round"/>
                  </svg>
                </div>
                <span>Тумбы</span>
              </a>


            </div>
          </div>
        </div>
        <div class="dropdown">
          <a href="<?php echo home_url('/business'); ?>" class="dropdown__toggle nav-audience">
            Для бизнеса
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              style="margin-left: 2px; transition: transform 0.2s;">
              <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
          </a>
          <div class="dropdown__menu dropdown__menu--mega" style="min-width: 420px;">
            <div class="megamenu__header">
              <span class="megamenu__title">Решения для бизнеса</span>
              <a href="<?php echo home_url('/business'); ?>" class="megamenu__all">Все услуги →</a>
            </div>
            <div class="megamenu__grid" style="grid-template-columns: repeat(2, 1fr);">
              <a href="<?php echo home_url('/business'); ?>" class="megamenu__item">
                <div class="megamenu__icon">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
                    <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
                    <rect x="16" y="14" width="32" height="6" rx="2" fill="white" stroke="#6F706E" stroke-width="2"/>
                    <rect x="16" y="24" width="32" height="6" rx="2" fill="white" stroke="#6F706E" stroke-width="2"/>
                    <rect x="16" y="34" width="32" height="6" rx="2" fill="white" stroke="#6F706E" stroke-width="2"/>
                    <rect x="18" y="16" width="10" height="2" rx="1" fill="#37B7AB" opacity="0.35"/>
                    <rect x="18" y="26" width="14" height="2" rx="1" fill="#37B7AB" opacity="0.35"/>
                    <rect x="18" y="36" width="8" height="2" rx="1" fill="#37B7AB" opacity="0.35"/>
                    <path d="M16 44h32" stroke="#6F706E" stroke-width="2.5" stroke-linecap="round"/>
                    <path d="M20 44v4M44 44v4" stroke="#6F706E" stroke-width="2" stroke-linecap="round"/>
                  </svg>
                </div>
                <span>Торговое оборудование</span>
              </a>
              <a href="<?php echo home_url('/business'); ?>" class="megamenu__item">
                <div class="megamenu__icon">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
                    <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
                    <path d="M32 14c-7.2 0-13 5.8-13 13 0 4.6 2.4 8.6 6 10.9V44h14v-6.1c3.6-2.3 6-6.3 6-10.9 0-7.2-5.8-13-13-13z" fill="white" stroke="#6F706E" stroke-width="2"/>
                    <rect x="25" y="44" width="14" height="3" rx="1.5" fill="#6F706E" opacity="0.7"/>
                    <rect x="27" y="47" width="10" height="3" rx="1.5" fill="#6F706E" opacity="0.5"/>
                    <circle cx="32" cy="27" r="4" fill="#37B7AB" opacity="0.3"/>
                    <circle cx="32" cy="27" r="2" fill="#37B7AB" opacity="0.6"/>
                    <path d="M32 18v3M32 36v3M23 27h3M38 27h3" stroke="#37B7AB" stroke-width="1.5" stroke-linecap="round" opacity="0.5"/>
                  </svg>
                </div>
                <span>Световой дизайн</span>
              </a>
            </div>
          </div>
        </div>
        <a href="<?php echo get_post_type_archive_link('project'); ?>">Проекты</a>
        <a href="<?php echo home_url('/about'); ?>">О производстве</a>
        <a href="<?php echo home_url('/contacts'); ?>">Контакты</a>
      </nav>

      <div class="header__actions">
        <?php $c = novacraft_contacts(); ?>
        <a href="tel:<?php echo esc_attr($c['phone_raw']); ?>" class="header__phone">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path
              d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
          </svg>
          <?php echo esc_html($c['phone']); ?>
        </a>
        <button class="btn btn--primary btn--sm" id="headerCta" onclick="openModal()">
          Обратный звонок
        </button>
        <!-- Избранное -->
        <button class="fav-btn" id="favBtn" aria-label="Избранное" title="Избранное">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
          </svg>
          <span class="fav-badge" id="favBadge" style="display:none">0</span>
        </button>
      </div>

      <button class="header__burger" id="burgerBtn" aria-label="Открыть меню">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>

    <!-- Mobile nav -->
    <nav class="header__nav--mobile" id="mobileNav" style="display:none;">
      <a href="<?php echo get_post_type_archive_link('furniture'); ?>" onclick="closeMobileMenu()" class="nav-audience">Для дома</a>
      <a href="<?php echo home_url('/business'); ?>" onclick="closeMobileMenu()" class="nav-audience">Для бизнеса</a>
      <a href="<?php echo get_post_type_archive_link('project'); ?>" onclick="closeMobileMenu()">Проекты</a>
      <a href="<?php echo home_url('/about'); ?>" onclick="closeMobileMenu()">О производстве</a>
      <a href="<?php echo home_url('/contacts'); ?>" onclick="closeMobileMenu()">Контакты</a>
      <a href="tel:<?php echo esc_attr($c['phone_raw']); ?>" class="header__phone" style="display:flex; color:var(--color-accent);">
        <?php echo esc_html($c['phone']); ?>
      </a>
      <button class="btn btn--primary" onclick="openModal(); closeMobileMenu();">Обратный звонок</button>
    </nav>
  </header>