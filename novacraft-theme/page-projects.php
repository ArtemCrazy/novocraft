<?php
/* Template Name: Projects */
get_header();
?>
<main id="primary" class="site-main">

  <!-- ============ PROJECTS PAGE ============ -->
  <section class="projects-page">
    <div class="container">

      <div class="projects-page__header">
        <h1 class="projects-page__title">Реализованные проекты</h1>
        <p class="projects-page__sub">Выполненные работы нашего производства — от эскиза до монтажа</p>
      </div>

      <!-- Sort -->
      <div class="projects-sort">
        <span class="projects-sort__label">Сортировка:</span>
        <button class="projects-sort__btn active" data-sort="date" onclick="sortProjects('date', this)">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
          По дате
        </button>
        <button class="projects-sort__btn" data-sort="area" onclick="sortProjects('area', this)">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M3 3h18v18H3z"/><path d="M3 9h18M3 15h18M9 3v18M15 3v18"/></svg>
          По площади
        </button>

        <div class="projects-sort__sep"></div>

        <!-- Category filter -->
        <button class="projects-filter__tag active" data-cat="all" onclick="filterProjects('all', this)">Все</button>
        <button class="projects-filter__tag" data-cat="Кухня" onclick="filterProjects('Кухня', this)">Кухни</button>
        <button class="projects-filter__tag" data-cat="Спальня" onclick="filterProjects('Спальня', this)">Спальни</button>
        <button class="projects-filter__tag" data-cat="Гостиная" onclick="filterProjects('Гостиная', this)">Гостиные</button>
        <button class="projects-filter__tag" data-cat="Прихожая" onclick="filterProjects('Прихожая', this)">Прихожие</button>
        <button class="projects-filter__tag" data-cat="Гардеробная" onclick="filterProjects('Гардеробная', this)">Гардеробные</button>
        <button class="projects-filter__tag" data-cat="Детская" onclick="filterProjects('Детская', this)">Детские</button>
      </div>

<?php
$projects = get_posts(array('post_type' => 'project', 'posts_per_page' => -1));
$has_projects = !empty($projects);
$count = $has_projects ? count($projects) : 12;
?>
      <!-- Count -->
      <div class="projects-count" id="projectsCount"><span id="countNum"><?php echo $count; ?></span> проектов</div>

      <!-- Grid -->
      <div class="projects-grid" id="projectsGrid">

<?php if ($has_projects) :
  foreach($projects as $p):
    setup_postdata($p);
    $area      = get_post_meta($p->ID, 'p_area', true) ?: '0';
    $mat       = get_post_meta($p->ID, 'p_material', true) ?: 'ЛДСП';
    $sort_date = get_post_meta($p->ID, 'p_date', true) ?: '20250101';
    $text_date = get_post_meta($p->ID, 'p_date_text', true) ?: 'январь 2025';
    $cats      = get_the_terms($p->ID, 'project_cat');
    $cat_name  = ($cats && !is_wp_error($cats)) ? $cats[0]->name : 'Проект';
    $img       = get_the_post_thumbnail_url($p->ID, 'large');
    if (!$img) $img = get_template_directory_uri() . '/img/kitchen_wood_autumn.jpg';
?>
        <a class="proj-card" href="<?php echo get_permalink($p->ID); ?>" data-date="<?php echo esc_attr($sort_date); ?>" data-area="<?php echo esc_attr($area); ?>" data-material="<?php echo esc_attr($mat); ?>" data-cat="<?php echo esc_attr($cat_name); ?>">
          <div class="proj-card__image">
            <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr(get_the_title($p->ID)); ?>" loading="lazy">
            <span class="proj-card__tag"><?php echo esc_html($cat_name); ?></span>
          </div>
          <div class="proj-card__body">
            <h3 class="proj-card__title"><?php echo get_the_title($p->ID); ?></h3>
            <div class="proj-card__meta">
              <span class="proj-card__meta-item">
                <?php echo esc_html($area); ?> м²
              </span>
              <span class="proj-card__meta-sep"></span>
              <span class="proj-card__meta-item">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h8"/></svg>
                <?php echo esc_html($mat); ?>
              </span>
              <span class="proj-card__meta-sep"></span>
              <span class="proj-card__meta-item"><?php echo esc_html($text_date); ?></span>
            </div>
          </div>
        </a>
<?php endforeach; wp_reset_postdata();
else: /* No WP projects — show demo cards */ ?>

        <a class="proj-card" href="#" data-date="20260201" data-area="22" data-material="МДФ" data-cat="Кухня">
          <div class="proj-card__image">
            <img src="<?php echo get_template_directory_uri(); ?>/img/kitchen_wood_autumn.jpg" alt="Кухня в природных тонах" loading="lazy">
            <span class="proj-card__tag">Кухня</span>
          </div>
          <div class="proj-card__body">
            <h3 class="proj-card__title">Кухня в природных тонах с деревянным фасадом</h3>
            <div class="proj-card__meta">
              <span class="proj-card__meta-item">
                22 м²
              </span>
              <span class="proj-card__meta-sep"></span>
              <span class="proj-card__meta-item">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h8"/></svg>
                ЛДСП / МДФ
              </span>
              <span class="proj-card__meta-sep"></span>
              <span class="proj-card__meta-item">февраль 2026</span>
            </div>
          </div>
        </a>

        <a class="proj-card" href="#" data-date="20260115" data-area="28" data-material="МДФ" data-cat="Кухня">
          <div class="proj-card__image">
            <img src="<?php echo get_template_directory_uri(); ?>/img/kitchen_dark_premium.jpg" alt="Тёмная кухня премиум" loading="lazy">
            <span class="proj-card__tag">Кухня</span>
          </div>
          <div class="proj-card__body">
            <h3 class="proj-card__title">Тёмная кухня с каменной столешницей</h3>
            <div class="proj-card__meta">
              <span class="proj-card__meta-item">
                28 м²
              </span>
              <span class="proj-card__meta-sep"></span>
              <span class="proj-card__meta-item">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h8"/></svg>
                МДФ / Камень
              </span>
              <span class="proj-card__meta-sep"></span>
              <span class="proj-card__meta-item">январь 2026</span>
            </div>
          </div>
        </a>

        <a class="proj-card" href="#" data-date="20251220" data-area="8" data-material="ЛДСП" data-cat="Гардеробная">
          <div class="proj-card__image">
            <img src="<?php echo get_template_directory_uri(); ?>/img/wardrobe_sliding_wood.jpg" alt="Гардеробная с раздвижными дверями" loading="lazy">
            <span class="proj-card__tag">Гардеробная</span>
          </div>
          <div class="proj-card__body">
            <h3 class="proj-card__title">Гардеробная с раздвижными деревянными панелями</h3>
            <div class="proj-card__meta">
              <span class="proj-card__meta-item">
                8 м²
              </span>
              <span class="proj-card__meta-sep"></span>
              <span class="proj-card__meta-item">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h8"/></svg>
                ЛДСП
              </span>
              <span class="proj-card__meta-sep"></span>
              <span class="proj-card__meta-item">декабрь 2025</span>
            </div>
          </div>
        </a>

        <a class="proj-card" href="#" data-date="20251205" data-area="18" data-material="ЛДСП" data-cat="Спальня">
          <div class="proj-card__image">
            <img src="<?php echo get_template_directory_uri(); ?>/img/bedroom_white_storage.jpg" alt="Спальня с системой хранения" loading="lazy">
            <span class="proj-card__tag">Спальня</span>
          </div>
          <div class="proj-card__body">
            <h3 class="proj-card__title">Встроенная система хранения в спальне</h3>
            <div class="proj-card__meta">
              <span class="proj-card__meta-item">
                18 м²
              </span>
              <span class="proj-card__meta-sep"></span>
              <span class="proj-card__meta-item">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h8"/></svg>
                ЛДСП
              </span>
              <span class="proj-card__meta-sep"></span>
              <span class="proj-card__meta-item">декабрь 2025</span>
            </div>
          </div>
        </a>

        <a class="proj-card" href="#" data-date="20251118" data-area="32" data-material="МДФ" data-cat="Гостиная">
          <div class="proj-card__image">
            <img src="<?php echo get_template_directory_uri(); ?>/img/living_room_dark_accent.jpg" alt="Гостиная с тёмным акцентом" loading="lazy">
            <span class="proj-card__tag">Гостиная</span>
          </div>
          <div class="proj-card__body">
            <h3 class="proj-card__title">Гостиная с тёмной акцентной стеной и стеллажом</h3>
            <div class="proj-card__meta">
              <span class="proj-card__meta-item">
                32 м²
              </span>
              <span class="proj-card__meta-sep"></span>
              <span class="proj-card__meta-item">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h8"/></svg>
                МДФ
              </span>
              <span class="proj-card__meta-sep"></span>
              <span class="proj-card__meta-item">ноябрь 2025</span>
            </div>
          </div>
        </a>

        <a class="proj-card" href="#" data-date="20251105" data-area="6" data-material="ЛДСП" data-cat="Прихожая">
          <div class="proj-card__image">
            <img src="<?php echo get_template_directory_uri(); ?>/img/hallway_compact_hooks.jpg" alt="Компактная прихожая" loading="lazy">
            <span class="proj-card__tag">Прихожая</span>
          </div>
          <div class="proj-card__body">
            <h3 class="proj-card__title">Компактная прихожая с системой крючков</h3>
            <div class="proj-card__meta">
              <span class="proj-card__meta-item">
                6 м²
              </span>
              <span class="proj-card__meta-sep"></span>
              <span class="proj-card__meta-item">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h8"/></svg>
                ЛДСП
              </span>
              <span class="proj-card__meta-sep"></span>
              <span class="proj-card__meta-item">ноябрь 2025</span>
            </div>
          </div>
        </a>

        <a class="proj-card" href="#" data-date="20251022" data-area="20" data-material="МДФ" data-cat="Кухня">
          <div class="proj-card__image">
            <img src="<?php echo get_template_directory_uri(); ?>/img/kitchen_grey_marble.jpg" alt="Серая кухня под мрамор" loading="lazy">
            <span class="proj-card__tag">Кухня</span>
          </div>
          <div class="proj-card__body">
            <h3 class="proj-card__title">Кухня серый базальт с мраморной столешницей</h3>
            <div class="proj-card__meta">
              <span class="proj-card__meta-item">
                20 м²
              </span>
              <span class="proj-card__meta-sep"></span>
              <span class="proj-card__meta-item">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h8"/></svg>
                МДФ / Камень
              </span>
              <span class="proj-card__meta-sep"></span>
              <span class="proj-card__meta-item">октябрь 2025</span>
            </div>
          </div>
        </a>

        <a class="proj-card" href="#" data-date="20251010" data-area="14" data-material="ЛДСП" data-cat="Детская">
          <div class="proj-card__image">
            <img src="<?php echo get_template_directory_uri(); ?>/img/childroom_neutral_study.jpg" alt="Детская с рабочей зоной" loading="lazy">
            <span class="proj-card__tag">Детская</span>
          </div>
          <div class="proj-card__body">
            <h3 class="proj-card__title">Детская с рабочей зоной и системой хранения</h3>
            <div class="proj-card__meta">
              <span class="proj-card__meta-item">
                14 м²
              </span>
              <span class="proj-card__meta-sep"></span>
              <span class="proj-card__meta-item">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h8"/></svg>
                ЛДСП
              </span>
              <span class="proj-card__meta-sep"></span>
              <span class="proj-card__meta-item">октябрь 2025</span>
            </div>
          </div>
        </a>

        <a class="proj-card" href="#" data-date="20250918" data-area="30" data-material="МДФ" data-cat="Гостиная">
          <div class="proj-card__image">
            <img src="<?php echo get_template_directory_uri(); ?>/img/living_room_tv_console.jpg" alt="Гостиная стенка под ТВ" loading="lazy">
            <span class="proj-card__tag">Гостиная</span>
          </div>
          <div class="proj-card__body">
            <h3 class="proj-card__title">Стенка под телевизор с открытыми полками</h3>
            <div class="proj-card__meta">
              <span class="proj-card__meta-item">
                30 м²
              </span>
              <span class="proj-card__meta-sep"></span>
              <span class="proj-card__meta-item">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h8"/></svg>
                МДФ
              </span>
              <span class="proj-card__meta-sep"></span>
              <span class="proj-card__meta-item">сентябрь 2025</span>
            </div>
          </div>
        </a>

        <a class="proj-card" href="#" data-date="20250830" data-area="9" data-material="ЛДСП" data-cat="Прихожая">
          <div class="proj-card__image">
            <img src="<?php echo get_template_directory_uri(); ?>/img/hallway_built_in_wardrobe.jpg" alt="Встроенный шкаф прихожая" loading="lazy">
            <span class="proj-card__tag">Прихожая</span>
          </div>
          <div class="proj-card__body">
            <h3 class="proj-card__title">Встроенный шкаф-купе в прихожей</h3>
            <div class="proj-card__meta">
              <span class="proj-card__meta-item">
                9 м²
              </span>
              <span class="proj-card__meta-sep"></span>
              <span class="proj-card__meta-item">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h8"/></svg>
                ЛДСП
              </span>
              <span class="proj-card__meta-sep"></span>
              <span class="proj-card__meta-item">август 2025</span>
            </div>
          </div>
        </a>

        <a class="proj-card" href="#" data-date="20250814" data-area="25" data-material="МДФ" data-cat="Спальня">
          <div class="proj-card__image">
            <img src="<?php echo get_template_directory_uri(); ?>/img/bedroom_modern_dark.jpg" alt="Тёмная современная спальня" loading="lazy">
            <span class="proj-card__tag">Спальня</span>
          </div>
          <div class="proj-card__body">
            <h3 class="proj-card__title">Тёмная спальня с мягкими фасадами</h3>
            <div class="proj-card__meta">
              <span class="proj-card__meta-item">
                25 м²
              </span>
              <span class="proj-card__meta-sep"></span>
              <span class="proj-card__meta-item">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h8"/></svg>
                МДФ
              </span>
              <span class="proj-card__meta-sep"></span>
              <span class="proj-card__meta-item">август 2025</span>
            </div>
          </div>
        </a>

        <a class="proj-card" href="#" data-date="20250720" data-area="5" data-material="ЛДСП" data-cat="Гардеробная">
          <div class="proj-card__image">
            <img src="<?php echo get_template_directory_uri(); ?>/img/wardrobe_built_in_white.jpg" alt="Белый встроенный шкаф" loading="lazy">
            <span class="proj-card__tag">Гардеробная</span>
          </div>
          <div class="proj-card__body">
            <h3 class="proj-card__title">Встроенный белый шкаф-купе с зеркалом</h3>
            <div class="proj-card__meta">
              <span class="proj-card__meta-item">
                5 м²
              </span>
              <span class="proj-card__meta-sep"></span>
              <span class="proj-card__meta-item">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h8"/></svg>
                ЛДСП
              </span>
              <span class="proj-card__meta-sep"></span>
              <span class="proj-card__meta-item">июль 2025</span>
            </div>
          </div>
        </a>

<?php endif; ?>

      </div>
    </div>
  </section>

  <!-- ============ CONTACT ============ -->
  <?php
  $c = novacraft_contacts();
  ?>
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
              <a href="tel:<?php echo esc_attr($c['phone_raw']); ?>" class="contact__card">
                <div class="contact__card-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                  </svg>
                </div>
                <div>
                  <div class="contact__card-label">Телефон</div>
                  <div class="contact__card-value"><?php echo esc_html($c['phone']); ?></div>
                </div>
                <svg class="contact__card-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </a>

              <a href="<?php echo esc_url($c['telegram']); ?>" target="_blank" class="contact__card">
                <div class="contact__card-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 2L11 13"/>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                  </svg>
                </div>
                <div>
                  <div class="contact__card-label">Telegram</div>
                  <div class="contact__card-value"><?php echo esc_html($c['tg_username']); ?></div>
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
                  <div class="contact__card-value"><?php echo str_replace(', ', ',<br>', esc_html($c['address_nn'])); ?></div>
                </div>
              </div>
            </div>

            <div class="contact__hours">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              <?php echo esc_html($c['work_hours']); ?>
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
            <button type="submit" class="btn btn--primary btn--lg" style="width:100%; margin-top: var(--space-md);">
              Отправить заявку
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

</main>
<?php get_footer(); ?>
