<?php
/**
 * Template Part: Home — Contact / CTA
 * Контактная информация и форма заявки. Статика — не выводится в Gutenberg.
 */
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
            <a href="tel:<?php echo esc_attr( nc_phone() ); ?>" class="contact__card">
              <div class="contact__card-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                </svg>
              </div>
              <div>
                <div class="contact__card-label">Телефон</div>
                <div class="contact__card-value"><?php echo esc_html( nc_phone_fmt() ); ?></div>
              </div>
              <svg class="contact__card-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>

            <?php if ( nc_telegram() ) : ?>
            <a href="https://t.me/<?php echo esc_attr( nc_telegram() ); ?>" target="_blank" rel="noopener" class="contact__card">
              <div class="contact__card-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M22 2L11 13"/>
                  <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                </svg>
              </div>
              <div>
                <div class="contact__card-label">Telegram</div>
                <div class="contact__card-value">@<?php echo esc_html( nc_telegram() ); ?></div>
              </div>
              <svg class="contact__card-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
            <?php endif; ?>

            <?php if ( nc_whatsapp() ) : ?>
            <a href="https://wa.me/<?php echo esc_attr( nc_whatsapp() ); ?>" target="_blank" rel="noopener" class="contact__card">
              <div class="contact__card-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
                </svg>
              </div>
              <div>
                <div class="contact__card-label">WhatsApp</div>
                <div class="contact__card-value">+<?php echo esc_html( nc_whatsapp() ); ?></div>
              </div>
              <svg class="contact__card-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
            <?php endif; ?>

            <div class="contact__card contact__card--addr">
              <div class="contact__card-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                  <circle cx="12" cy="10" r="3"/>
                </svg>
              </div>
              <div>
                <div class="contact__card-label">Производство и офис</div>
                <div class="contact__card-value"><?php echo nl2br( esc_html( nc_address() ) ); ?></div>
              </div>
            </div>
          </div>

          <div class="contact__hours">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            <?php echo esc_html( nc_hours() ); ?>
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
