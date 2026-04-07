<?php
/* Template Name: О производстве */
get_header();
$c = novacraft_contacts();

// ---- Fallback: факты ----
$default_facts = array(
    array('fact_value' => '600 м²',      'fact_label' => 'производственная площадь'),
    array('fact_value' => '30+ лет',     'fact_label' => 'работаем на рынке'),
    array('fact_value' => '5 000+',      'fact_label' => 'выполненных заказов'),
    array('fact_value' => '3 поколения', 'fact_label' => 'мастеров в команде'),
);

$pid = get_the_ID();
$d   = novacraft_about_defaults();

// ---- Данные из post meta, фолбэк на дефолты ----
$prod_image   = get_post_meta($pid, '_about_prod_image', true) ?: $d['prod_image'];
$prod_label   = get_post_meta($pid, '_about_prod_label', true) ?: $d['prod_label'];
$prod_title   = get_post_meta($pid, '_about_prod_title', true) ?: $d['prod_title'];
$prod_text    = get_post_meta($pid, '_about_prod_text',  true) ?: $d['prod_text'];
$facts_raw    = get_post_meta($pid, '_about_prod_facts', true);
$prod_facts   = $facts_raw ? json_decode($facts_raw, true) : $d['prod_facts'];

$tl_intro_title = get_post_meta($pid, '_about_tl_intro_title', true) ?: $d['tl_intro_title'];
$tl_intro_text  = get_post_meta($pid, '_about_tl_intro_text',  true) ?: $d['tl_intro_text'];
$tl_raw         = get_post_meta($pid, '_about_timeline', true);
$timeline_items = ($tl_raw ? json_decode($tl_raw, true) : false) ?: $d['timeline'];
?>

<!-- ============ PAGE HERO ============ -->
<section class="section" style="padding-bottom: 0; padding-top: 60px;">
    <div class="container">
        <h1 class="section-title" style="text-align: left; margin-bottom: 0;"><?php the_title(); ?></h1>
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                $content = get_the_content();
                if (!empty($content)) {
                    echo '<div style="margin-top: var(--space-md); font-size: 1rem; color: var(--color-text-soft); max-width: 640px; line-height: 1.7;">';
                    echo '<div style="margin-top: 15px;">';
                    the_content();
                    echo '</div></div>';
                }
            endwhile;
        endif;
        ?>
    </div>
</section>

<!-- ============ PRODUCTION TODAY ============ -->
<section class="section production-today">
    <div class="container">
        <div class="production-today__inner">

            <div class="production-today__media">
                <img src="<?php echo esc_url($prod_image); ?>" alt="Производство Novacraft" class="production-today__img">
                <div class="production-today__media-caption"><?php echo esc_html($c['address_nn']); ?></div>
            </div>

            <div class="production-today__text">
                <div class="production-today__label"><?php echo esc_html($prod_label); ?></div>
                <h2 class="wp-block-heading"><?php echo esc_html($prod_title); ?></h2>
                <div class="production-today__desc"><?php echo wp_kses_post($prod_text); ?></div>
                <?php if (!empty($prod_facts)) : ?>
                <ul class="production-today__facts">
                    <?php foreach ($prod_facts as $fact) : ?>
                    <li><span><?php echo esc_html($fact['v'] ?? $fact['fact_value'] ?? ''); ?></span> <?php echo esc_html($fact['l'] ?? $fact['fact_label'] ?? ''); ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>

<!-- ============ TIMELINE INTRO ============ -->
<div class="timeline-intro">
    <div class="container">
        <div class="timeline-intro__inner">
            <div class="timeline-intro__line"></div>
            <div class="timeline-intro__content">
                <span class="timeline-intro__label">История компании</span>
                <h2 class="timeline-intro__title"><?php echo esc_html($tl_intro_title); ?></h2>
                <p class="timeline-intro__text"><?php echo esc_html($tl_intro_text); ?></p>
            </div>
            <div class="timeline-intro__line"></div>
        </div>
    </div>
</div>

<!-- ============ TIMELINE ============ -->
<section class="section">
    <div class="container">
        <div class="timeline">
            <?php foreach ($timeline_items as $item) :
                $year    = esc_html($item['year']  ?? '');
                $title   = esc_html($item['title'] ?? '');
                $text    = esc_html($item['text']  ?? '');
                $img_url = !empty($item['image']) ? esc_url($item['image']) : '';
                $img_alt = esc_attr($title);
            ?>
            <div class="timeline__item reveal">
                <div class="timeline__year-bg"><?php echo $year; ?></div>
                <div class="timeline__content">
                    <h3 class="timeline__title"><?php echo $title; ?></h3>
                    <div class="timeline__text"><p><?php echo $text; ?></p></div>
                    <?php if ($img_url) : ?>
                    <img src="<?php echo $img_url; ?>" alt="<?php echo $img_alt; ?>" class="timeline__img" loading="lazy">
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============ CONTACT FORM ============ -->
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
          <button type="submit" class="btn btn--primary btn--lg" style="width:100%;margin-top:var(--space-md);">
            Отправить заявку
          </button>
        </form>
      </div>

    </div>
  </div>
</section>

<?php get_footer(); ?>
