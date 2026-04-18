<?php
/**
 * Front page template — hardcoded sections mirroring the original design.
 * Avoids post_content entirely (content was corrupted by a KSES pass during
 * migration). Icons are verbatim from the original template; text uses ACF
 * overrides where available, with sensible defaults.
 */
get_header();

$get_f = function($k, $d) {
    if (function_exists('get_field')) {
        $v = get_field($k);
        if ($v) return $v;
    }
    return $d;
};

$h_bg       = $get_f('h_bg', get_template_directory_uri() . '/img/kitchen_wood_autumn.jpg');
$h_badge    = $get_f('h_badge', 'Собственное производство');
$h_title    = $get_f('h_title', 'Мебель на заказ<br>с душой и <span>характером</span>');
$h_desc     = $get_f('h_desc', 'Семейное производство с 1996 года — уже 3 поколения создают мебель, которой доверяют');
$h_btn_text = $get_f('h_btn_text', 'Смотреть каталог');
$h_btn_link = $get_f('h_btn_link', get_post_type_archive_link('furniture'));

$hq_bg    = $get_f('hq_bg', get_template_directory_uri() . '/img/kitchen_dark_premium.jpg');
$hq_badge = $get_f('hq_badge', 'РАСЧЁТ СТОИМОСТИ');
$hq_title = $get_f('hq_title', 'Пройдите короткий опрос');
$hq_desc  = $get_f('hq_desc', 'Ответьте на 4 вопроса, чтобы мы подобрали материалы и рассчитали цену.');
$hq_link  = $get_f('hq_link', 'Начать расчёт &rarr;');
$hb_title = $get_f('hb_title', 'Почему выбирают нас');
?>

<main id="primary" class="site-main">

  <!-- ============ HERO BANNER ============ -->
  <section class="hero-banner" id="hero">
    <div class="container">
      <div class="hero-banner__grid">
        <div class="hero-banner__main">
          <div class="hero-banner__main-bg">
            <img src="<?php echo esc_url($h_bg); ?>" alt="<?php echo esc_attr(wp_strip_all_tags($h_title)); ?>" loading="eager">
          </div>
          <div class="hero-banner__main-overlay"></div>
          <div class="hero-banner__main-content">
            <div class="hero-banner__badge"><?php echo esc_html($h_badge); ?></div>
            <h1 class="hero-banner__title"><?php echo wp_kses_post($h_title); ?></h1>
            <p class="hero-banner__desc"><?php echo esc_html($h_desc); ?></p>
            <div class="hero-banner__actions">
              <button class="btn btn--primary btn--lg" onclick="openModal()">
                Обратный звонок
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="5" y1="12" x2="19" y2="12"/>
                  <polyline points="12 5 19 12 12 19"/>
                </svg>
              </button>
              <a href="<?php echo esc_url($h_btn_link); ?>" class="btn btn--white"><?php echo esc_html($h_btn_text); ?></a>
            </div>
          </div>
        </div>
        <div class="hero-banner__side">
          <div class="hero-banner__side-card" onclick="openQuizModal()" style="cursor:pointer;background-image:url('<?php echo esc_url($hq_bg); ?>');background-size:cover;background-position:center;">
            <div class="hero-banner__side-overlay"></div>
            <div class="hero-banner__side-content">
              <div class="hero-banner__side-badge" style="background-color: var(--color-accent);"><?php echo esc_html($hq_badge); ?></div>
              <div class="hero-banner__side-title"><?php echo esc_html($hq_title); ?></div>
              <p class="hero-banner__side-desc"><?php echo esc_html($hq_desc); ?></p>
              <span class="hero-banner__side-link"><?php echo wp_kses_post($hq_link); ?></span>
            </div>
          </div>
          <div class="hero-banner__side-card hero-banner__side-card--benefits reveal reveal-delay-3">
            <div class="hero-banner__benefits-heading"><?php echo esc_html($hb_title); ?></div>
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

  <!-- ============ CATEGORY ICONS ROW ============ -->
  <section class="cat-icons" id="categories">
    <div class="container">
      <div class="cat-icons__row">
        <?php
        $furniture_archive = get_post_type_archive_link('furniture');
        $cats = array(
          array('kitchen',  'Кухни',       '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none"><rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/><rect x="16" y="18" width="32" height="24" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/><rect x="18" y="20" width="13" height="8" rx="2" fill="#37B7AB" opacity="0.16"/><rect x="33" y="20" width="13" height="8" rx="2" fill="#37B7AB" opacity="0.16"/><rect x="18" y="30" width="13" height="10" rx="2" fill="white" stroke="#6F706E" stroke-width="2"/><rect x="33" y="30" width="13" height="10" rx="2" fill="white" stroke="#6F706E" stroke-width="2"/><circle cx="29" cy="35" r="1.2" fill="#6F706E"/><circle cx="35" cy="35" r="1.2" fill="#6F706E"/><rect x="22" y="44" width="20" height="2.5" rx="1.25" fill="#6F706E" opacity="0.65"/></svg>'),
          array('wardrobe', 'Шкафы',       '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none"><rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/><rect x="18" y="16" width="28" height="30" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/><path d="M32 16V46" stroke="#6F706E" stroke-width="2"/><circle cx="29" cy="31" r="1.2" fill="#6F706E"/><circle cx="35" cy="31" r="1.2" fill="#6F706E"/><rect x="22" y="20" width="8" height="4" rx="2" fill="#37B7AB" opacity="0.18"/><rect x="34" y="20" width="8" height="4" rx="2" fill="#37B7AB" opacity="0.18"/></svg>'),
          array('wardrobe', 'Гардеробные', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none"><rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/><path d="M18 44V22a4 4 0 0 1 4-4h20a4 4 0 0 1 4 4v22" stroke="#6F706E" stroke-width="2" fill="white"/><path d="M24 22V44" stroke="#6F706E" stroke-width="2"/><path d="M40 22V44" stroke="#6F706E" stroke-width="2"/><rect x="26.5" y="27" width="11" height="13" rx="2" fill="#37B7AB" opacity="0.18"/><path d="M28 24h8" stroke="#6F706E" stroke-width="2" stroke-linecap="round"/><path d="M22 46h20" stroke="#6F706E" stroke-width="2.5" stroke-linecap="round"/></svg>'),
          array('dresser',  'Кровати',     '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none"><rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/><rect x="18" y="28" width="28" height="12" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/><rect x="20" y="24" width="10" height="7" rx="2" fill="#37B7AB" opacity="0.18"/><rect x="16" y="22" width="4" height="22" rx="2" fill="#6F706E"/><rect x="44" y="26" width="4" height="18" rx="2" fill="#6F706E"/><rect x="20" y="40" width="3" height="6" rx="1.5" fill="#6F706E"/><rect x="41" y="40" width="3" height="6" rx="1.5" fill="#6F706E"/></svg>'),
          array('dresser',  'Комоды',      '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none"><rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/><rect x="19" y="18" width="26" height="26" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/><path d="M19 27H45" stroke="#6F706E" stroke-width="2"/><path d="M19 35H45" stroke="#6F706E" stroke-width="2"/><rect x="23" y="21" width="18" height="3" rx="1.5" fill="#37B7AB" opacity="0.18"/><circle cx="32" cy="31" r="1.2" fill="#6F706E"/><circle cx="32" cy="39" r="1.2" fill="#6F706E"/><rect x="23" y="44" width="18" height="2.5" rx="1.25" fill="#6F706E" opacity="0.65"/></svg>'),
          array('storage',  'Обувницы',    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none"><rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/><rect x="18" y="18" width="28" height="24" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/><path d="M18 30H46" stroke="#6F706E" stroke-width="2"/><path d="M24 24h16" stroke="#6F706E" stroke-width="2" stroke-linecap="round"/><path d="M24 36h16" stroke="#6F706E" stroke-width="2" stroke-linecap="round"/><path d="M22 47c4-4 16-4 20 0" stroke="#37B7AB" stroke-width="3" stroke-linecap="round" opacity="0.8"/></svg>'),
          array('dresser',  'Тумбы',       '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none"><rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/><rect x="20" y="22" width="24" height="18" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/><path d="M20 31H44" stroke="#6F706E" stroke-width="2"/><circle cx="32" cy="27" r="1.2" fill="#6F706E"/><circle cx="32" cy="35" r="1.2" fill="#6F706E"/><rect x="24" y="40" width="3" height="7" rx="1.5" fill="#6F706E"/><rect x="37" y="40" width="3" height="7" rx="1.5" fill="#6F706E"/><rect x="24" y="18" width="16" height="3" rx="1.5" fill="#37B7AB" opacity="0.18"/></svg>'),
          array('storage',  'Стеллажи',    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none"><rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/><rect x="18" y="18" width="28" height="28" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/><path d="M32 18V46" stroke="#6F706E" stroke-width="2"/><path d="M18 32H46" stroke="#6F706E" stroke-width="2"/><rect x="22" y="22" width="8" height="8" rx="2" fill="#37B7AB" opacity="0.18"/><rect x="34" y="34" width="8" height="8" rx="2" fill="#37B7AB" opacity="0.18"/></svg>'),
          array('storage',  'Столы',       '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none"><rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/><rect x="18" y="22" width="28" height="7" rx="3.5" fill="white" stroke="#6F706E" stroke-width="2"/><path d="M24 29V44" stroke="#6F706E" stroke-width="2.5" stroke-linecap="round"/><path d="M40 29V44" stroke="#6F706E" stroke-width="2.5" stroke-linecap="round"/><path d="M20 44H28" stroke="#6F706E" stroke-width="2.5" stroke-linecap="round"/><path d="M36 44H44" stroke="#6F706E" stroke-width="2.5" stroke-linecap="round"/><rect x="24" y="18" width="16" height="3" rx="1.5" fill="#37B7AB" opacity="0.18"/></svg>'),
        );
        foreach ($cats as $cat) :
          list($slug, $label, $svg) = $cat;
        ?>
        <a href="<?php echo esc_url(add_query_arg('category', $slug, $furniture_archive)); ?>" class="cat-icon-item">
          <div class="cat-icon-item__icon"><?php echo $svg; ?></div>
          <span><?php echo esc_html($label); ?></span>
        </a>
        <?php endforeach; ?>
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
              <path d="M 16 46 L 16 26 L 26 20 L 26 28 L 36 22 L 36 30 L 46 24 L 46 46 Z" fill="white" stroke="#6F706E" stroke-width="2" stroke-linejoin="round"/>
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
          <div class="advantage-card__icon" style="background: transparent; width: 64px; height: 64px; margin-left: -8px; margin-top: -8px;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none" style="width: 64px; height: 64px;">
              <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
              <rect x="20" y="24" width="20" height="20" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/>
              <circle cx="30" cy="34" r="6" fill="#37B7AB" opacity="0.25"/>
              <circle cx="30" cy="34" r="3" fill="#6F706E"/>
              <path d="M40 38 H 52 V 42 H 40" fill="white" stroke="#6F706E" stroke-width="2"/>
              <path d="M52 38 V 44" stroke="#6F706E" stroke-width="2" stroke-linecap="round"/>
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
              <rect x="20" y="22" width="24" height="24" rx="3" fill="white" stroke="#6F706E" stroke-width="2"/>
              <path d="M20 30 H 44" stroke="#6F706E" stroke-width="2"/>
              <rect x="24" y="18" width="2" height="6" rx="1" fill="#37B7AB" stroke="#6F706E" stroke-width="1.5"/>
              <rect x="38" y="18" width="2" height="6" rx="1" fill="#37B7AB" stroke="#6F706E" stroke-width="1.5"/>
              <rect x="24" y="34" width="6" height="4" rx="1" fill="#37B7AB" opacity="0.25"/>
              <rect x="34" y="34" width="6" height="4" rx="1" fill="#37B7AB" opacity="0.25"/>
              <rect x="24" y="40" width="6" height="4" rx="1" fill="#37B7AB" opacity="0.25"/>
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
              <path d="M32 18 L20 22 V32 C20 40 25 46 32 50 C39 46 44 40 44 32 V22 L32 18 Z" fill="white" stroke="#6F706E" stroke-width="2" stroke-linejoin="round"/>
              <path d="M32 24 L24 27 V34 C24 39 27 43 32 46 C37 43 40 39 40 34 V27 L32 24 Z" fill="#37B7AB" opacity="0.2"/>
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

  <!-- ============ PROJECTS ============ -->
  <section class="section" id="projects">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title reveal">Реализованные проекты</h2>
        <a href="<?php echo esc_url(get_post_type_archive_link('project')); ?>" class="section-link reveal">Все проекты &rarr;</a>
      </div>

      <div class="projects__grid">
        <?php
        $projects = new WP_Query(array(
            'post_type'      => 'project',
            'posts_per_page' => 4,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        ));
        if ($projects->have_posts()) :
            $delay = 1;
            while ($projects->have_posts()) : $projects->the_post();
                $thumb   = get_the_post_thumbnail_url(get_the_ID(), 'large');
                $tag     = function_exists('get_field') ? get_field('project_tag') : '';
                $meta    = function_exists('get_field') ? get_field('project_meta') : '';
        ?>
        <a class="project-card reveal reveal-delay-<?php echo (int)$delay; ?>" href="<?php the_permalink(); ?>">
          <div class="project-card__image">
            <?php if ($thumb) : ?>
              <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy">
            <?php else : ?>
              <div class="project-card__placeholder" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
                  <rect width="64" height="64" fill="#F6F4F1"/>
                  <rect x="14" y="20" width="36" height="26" rx="3" fill="white" stroke="#6F706E" stroke-width="1.8"/>
                  <path d="M14 32H50" stroke="#6F706E" stroke-width="1.8"/>
                  <rect x="18" y="24" width="12" height="5" rx="1.5" fill="#37B7AB" opacity="0.2"/>
                  <rect x="34" y="24" width="12" height="5" rx="1.5" fill="#37B7AB" opacity="0.2"/>
                  <rect x="18" y="35" width="12" height="8" rx="1.5" fill="white" stroke="#6F706E" stroke-width="1.6"/>
                  <rect x="34" y="35" width="12" height="8" rx="1.5" fill="white" stroke="#6F706E" stroke-width="1.6"/>
                  <circle cx="27" cy="39" r="0.9" fill="#6F706E"/>
                  <circle cx="37" cy="39" r="0.9" fill="#6F706E"/>
                </svg>
              </div>
            <?php endif; ?>
          </div>
          <div class="project-card__body">
            <?php if ($tag) : ?><span class="project-card__tag"><?php echo esc_html($tag); ?></span><?php endif; ?>
            <h3 class="project-card__title"><?php the_title(); ?></h3>
            <?php if ($meta) : ?><p class="project-card__meta"><?php echo esc_html($meta); ?></p><?php endif; ?>
          </div>
        </a>
        <?php
                $delay++;
            endwhile;
            wp_reset_postdata();
        else :
            $fallbacks = array(
                array('bedroom_white_storage.jpg',   'Спальня',  'Встроенная система хранения',   'Москва · Шкаф-купе + тумбы · 18 дней'),
                array('living_room_tv_console.jpg',  'Гостиная', 'Стенка под телевизор и стеллаж', 'Нижний Новгород · Корпусная мебель · 14 дней'),
                array('hallway_compact_hooks.jpg',   'Прихожая', 'Компактная система для прихожей', 'Московская область · Шкаф + обувница · 12 дней'),
                array('kitchen_green_classic.jpg',   'Кухня',    'Кухонный гарнитур с островом',   'Москва · Кухня + остров · 21 день'),
            );
            $delay = 1;
            foreach ($fallbacks as $fb) :
                list($img, $tag, $title, $meta) = $fb;
        ?>
        <div class="project-card reveal reveal-delay-<?php echo (int)$delay; ?>">
          <div class="project-card__image">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/' . $img); ?>" alt="<?php echo esc_attr($title); ?>" loading="lazy">
          </div>
          <div class="project-card__body">
            <span class="project-card__tag"><?php echo esc_html($tag); ?></span>
            <h3 class="project-card__title"><?php echo esc_html($title); ?></h3>
            <p class="project-card__meta"><?php echo esc_html($meta); ?></p>
          </div>
        </div>
        <?php
                $delay++;
            endforeach;
        endif;
        ?>
      </div>
    </div>
  </section>

  <!-- ============ ABOUT ============ -->
  <section class="section section--alt" id="about">
    <div class="container">
      <div class="about__grid">
        <div class="about__image reveal">
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/living_room_tv_bookshelf.jpg'); ?>" alt="Производство мебели Novacraft" loading="lazy">
          <div class="about__image-badge">
            <strong>с 1996</strong>
            <span>года<br>на&nbsp;рынке</span>
          </div>
        </div>
        <div class="about__text reveal reveal-delay-1">
          <h2 class="section-title">О нашем производстве</h2>
          <p>Novacraft — семейное дело, которым занимаются уже 3 поколения — с 1996 года. За это время мы реализовали более <strong>5 000 заказов</strong> для <strong>более 1 000 клиентов</strong> по всей России.</p>
          <p>Каждый проект — индивидуальный. Мы работаем на современном оборудовании и контролируем каждый этап: от замера и дизайна до изготовления и установки. Берёмся за самые сложные задачи.</p>

          <div class="about__features">
            <?php
            $features = array(
              'Каркасы: ЛДСП 16/25мм, ЛМДФ',
              'Столешницы: постформинг, пластик, МДФ, камень (спецзаказ)',
              'Кромка: ПВХ и АБС — надёжное оформление торцов',
              'Гарантия на продукцию',
            );
            foreach ($features as $feat) :
            ?>
            <div class="about__feature">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"/>
              </svg>
              <?php echo esc_html($feat); ?>
            </div>
            <?php endforeach; ?>
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
                <polyline points="14 2 14 8 20 8"/>
                <polyline points="9 13 11 15 15 11"/>
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

</main>

<?php get_footer(); ?>
