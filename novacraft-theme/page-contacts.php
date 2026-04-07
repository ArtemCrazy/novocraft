<?php
/* Template Name: Контакты */
get_header(); 
$c = novacraft_contacts();
?>

<!-- ============ PAGE HERO ============ -->
<section class="section" style="padding-bottom: 0; padding-top: 60px;">
    <div class="container">
        <h1 class="section-title" style="text-align: left; margin-bottom: 0;"><?php the_title(); ?></h1>
        <div style="margin-top: var(--space-md); font-size: 1rem; color: var(--color-text-soft); max-width: 640px; line-height: 1.7;">
            <?php 
            if ( have_posts() ) : 
                while ( have_posts() ) : the_post();
                    the_content();
                endwhile;
            endif;
            ?>
        </div>
    </div>
</section>

<!-- ============ CONTACTS INFO ============ -->
<section style="padding: 60px 0;">
    <div class="container">

        <div class="contacts-locations">

            <!-- Офис Москва -->
            <div class="contact-location-card">
                <div class="contact-location-info">
                    <div class="location-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                            <polyline points="9 22 9 12 15 12 15 22"/>
                        </svg>
                        Офис продаж
                    </div>
                    <h2>Москва</h2>

                    <div class="contact__detail">
                        <div class="contact__detail-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                        </div>
                        <div class="contact__detail-body">
                            <div class="contact__detail-label">Адрес</div>
                            <div class="contact__detail-value"><?php echo esc_html($c['address_msk_full']); ?></div>
                        </div>
                    </div>

                    <div class="contact__detail">
                        <div class="contact__detail-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                            </svg>
                        </div>
                        <div class="contact__detail-body">
                            <div class="contact__detail-label">Телефон для связи</div>
                            <div class="contact__detail-value">
                                <a href="tel:<?php echo esc_attr($c['phone_raw']); ?>"><?php echo esc_html($c['phone']); ?></a>
                            </div>
                        </div>
                    </div>

                    <div class="contact__detail">
                        <div class="contact__detail-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                        </div>
                        <div class="contact__detail-body">
                            <div class="contact__detail-label">Режим работы</div>
                            <div class="contact__detail-value">
                                <?php echo esc_html($c['work_hours']); ?>
                                <span class="hint">Посещение офиса по предварительной записи</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-location-map">
                    <iframe src="<?php echo esc_attr($c['map_url_msk']); ?>" width="100%" height="100%" frameborder="0" style="height:100%;min-height:380px;border:0;"></iframe>
                </div>
            </div>

            <!-- Производство -->
            <div class="contact-location-card">
                <div class="contact-location-info">
                    <div class="location-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"/>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                        </svg>
                        Производство
                    </div>
                    <h2>Нижний Новгород</h2>

                    <div class="contact__detail">
                        <div class="contact__detail-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                        </div>
                        <div class="contact__detail-body">
                            <div class="contact__detail-label">Адрес завода</div>
                            <div class="contact__detail-value"><?php echo esc_html($c['address_nn']); ?></div>
                        </div>
                    </div>

                    <div class="contact__detail">
                        <div class="contact__detail-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </div>
                        <div class="contact__detail-body">
                            <div class="contact__detail-label">Почта для эскизов и расчетов</div>
                            <div class="contact__detail-value">
                                <a href="mailto:<?php echo esc_attr($c['email']); ?>"><?php echo esc_html($c['email']); ?></a>
                            </div>
                        </div>
                    </div>

                    <div class="contact__detail">
                        <div class="contact__detail-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"/>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                            </svg>
                        </div>
                        <div class="contact__detail-body">
                            <div class="contact__detail-label">Экскурсия на производство</div>
                            <div class="contact__detail-value">
                                Хотите увидеть процесс своими глазами?
                                <span class="hint">Возможно по предварительному согласованию</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-location-map">
                    <iframe src="<?php echo esc_attr($c['map_url_nn']); ?>" width="100%" height="100%" frameborder="0" style="height:100%;min-height:380px;border:0;"></iframe>
                </div>
            </div>

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
