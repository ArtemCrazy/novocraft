<?php
get_header(); ?>


    <!-- ============ PRODUCT (внутренняя карточка) ============ -->
    <main class="container" style="padding-top: var(--space-xl);">
        <nav class="product-breadcrumbs" aria-label="Хлебные крошки">
            <a href="<?php echo home_url('/'); ?>">Главная</a>
            <span class="product-breadcrumbs__sep">/</span>
            <a href="<?php echo get_post_type_archive_link('furniture'); ?>">Каталог</a>
            <span class="product-breadcrumbs__sep">/</span>
            <span class="product-breadcrumbs__current" id="productBreadcrumbCurrent">Товар</span>
        </nav>
        <div id="productRoot">
            <!-- Контент подставляется product.js по id из URL -->
            <p style="color: var(--color-text-muted);">Загрузка…</p>
        </div>
    </main>

    <!-- ============ CONTACT ============ -->
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
                    <path d="M22 2L11 13" />
                <polygon points="22 2 15 22 11 13 2 9 22 2" />
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
              <textarea id="contactMessage" name="message"
                placeholder="Опишите ваш проект — размеры, материалы, пожелания..."></textarea>
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

  <!-- ============ FOOTER ============ -->
  
<?php get_footer(); ?>
