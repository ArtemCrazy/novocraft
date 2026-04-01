<?php
get_header(); ?>


  <!-- ============ HERO ============ -->
  <section class="pd-hero">
    <img class="pd-hero__img" src="<?php echo site_url('../img/'); ?>"kitchen_wood_autumn.jpg" alt="Кухня в природных тонах">
    <div class="pd-hero__overlay"></div>
    <div class="pd-hero__content">
      <div class="container">
        <span class="pd-hero__category">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
          Кухня
        </span>
        <h1 class="pd-hero__title">Кухня в природных тонах<br>с деревянным фасадом</h1>
        <p class="pd-hero__subtitle">Тёплая скандинавская кухня с массивными деревянными фасадами, открытыми полками и интегрированной техникой — под индивидуальный проект заказчика.</p>
        <div class="pd-hero__badges">
          <span class="pd-hero__badge">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3h18v18H3z"/></svg>
            22 м²
          </span>
          <span class="pd-hero__badge">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h8"/></svg>
            ЛДСП + МДФ
          </span>
          <span class="pd-hero__badge">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
            февраль 2026
          </span>
          <span class="pd-hero__badge">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            Москва
          </span>
          <span class="pd-hero__badge">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            28 дней
          </span>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ BREADCRUMB ============ -->
  <nav class="pd-breadcrumb">
    <div class="container">
      <div class="pd-breadcrumb__inner">
        <a href="<?php echo home_url('/'); ?>">Главная</a>
        <span class="pd-breadcrumb__sep">›</span>
        <a href="<?php echo get_post_type_archive_link('project'); ?>">Проекты</a>
        <span class="pd-breadcrumb__sep">›</span>
        <span class="pd-breadcrumb__current">Кухня в природных тонах</span>
      </div>
    </div>
  </nav>

  <!-- ============ MAIN BODY ============ -->
  <section class="pd-body">
    <div class="container">
      <div class="pd-layout">

        <!-- LEFT: description + tasks -->
        <div>
          <!-- Description -->
          <div class="pd-description">
            <span class="pd-section-label">Описание</span>
            <div class="pd-description__text">
              <p>Проект реализован в новом ЖК Подмосковья. Перед нами стояла задача — сделать кухню, которая ощущается как продолжение природы: тёплые текстуры, массивное дерево, мягкий свет. Заказчик принёс готовый дизайн-проект от студии.</p>
              <p>Фасады выполнены из МДФ с плёнкой под шпон ясеня. Столешница — кварцевый агломерат с матовой поверхностью. Верхние шкафы заменены открытыми полками — это даёт ощущение простора и лёгкости. Ниши подсвечены светодиодными лентами в теплом оттенке 2700K.</p>
              <p>Всего изготовлено 14 единиц мебели: нижняя тумбовая группа из 8 секций, пенал, угловой шкаф, 4 открытых полочных модуля. Вся техника интегрирована: духовой шкаф, посудомойка, холодильник встроены заподлицо с фасадами.</p>
            </div>
          </div>

          <!-- Tasks -->
          <div class="pd-tasks">
            <h2 class="pd-tasks__title">
              <span class="pd-section-label">Задачи и решения</span>
            </h2>

            <!-- Task 1 -->
            <div class="pd-task">
              <div class="pd-task__content">
                <span class="pd-task__number">01</span>
                <h3 class="pd-task__title">Угловая секция без «мёртвого» пространства</h3>
                <p class="pd-task__text">Заказчик терял около 40% объёма в угловом шкафу из-за отсутствия правильного механизма. Мы установили карусельный механизм Hafele Tandem с плавным выдвижением — теперь весь угол доступен. Нагрузка на полку — до 15 кг, срок службы механизма — 50 000 циклов.</p>
              </div>
              <div class="pd-task__img-wrap">
                <img src="<?php echo site_url('../img/'); ?>"kitchen_olive_modern.jpg" alt="Угловая секция кухни" loading="lazy">
              </div>
            </div>

            <!-- Task 2 (reverse) -->
            <div class="pd-task pd-task--reverse">
              <div class="pd-task__content">
                <span class="pd-task__number">02</span>
                <h3 class="pd-task__title">Интеграция вытяжки в потолочную нишу</h3>
                <p class="pd-task__text">Стена, над которой располагалась рабочая зона, была несущей — выводить воздуховод через неё нельзя. Решение: встроенная купольная вытяжка с режимом рециркуляции. Мы скрыли её в нише из гипсокартона, декорированной деревянными рейками в тон фасадам. Выглядит как дизайнерский элемент.</p>
              </div>
              <div class="pd-task__img-wrap">
                <img src="<?php echo site_url('../img/'); ?>"kitchen_green_classic.jpg" alt="Нища для вытяжки" loading="lazy">
              </div>
            </div>

            <!-- Task 3 -->
            <div class="pd-task">
              <div class="pd-task__content">
                <span class="pd-task__number">03</span>
                <h3 class="pd-task__title">Открытые полки с подсветкой</h3>
                <p class="pd-task__text">Верхний ярус — открытые полки из массива ясеня на скрытых кронштейнах. Нагрузка распределена через анкеры в несущую стену. Светодиодная лента Osram 2700K спрятана за фиксирующим буртиком полки — свет мягкий, источника не видно, рабочая поверхность освещена равномерно.</p>
              </div>
              <div class="pd-task__img-wrap">
                <img src="<?php echo site_url('../img/'); ?>"kitchen_beige_compact.jpg" alt="Открытые полки с подсветкой" loading="lazy">
              </div>
            </div>
          </div>
        </div>

        <!-- RIGHT: info card -->
        <aside>
          <div class="pd-info-card">
            <div class="pd-info-card__head">
              <div class="pd-info-card__head-title">Проект</div>
              <div class="pd-info-card__head-value">Кухня в природных тонах</div>
            </div>
            <div class="pd-info-card__body">
              <div class="pd-info-row">
                <div class="pd-info-row__icon">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3h18v18H3z"/></svg>
                </div>
                <div>
                  <div class="pd-info-row__label">Площадь кухни</div>
                  <div class="pd-info-row__val">22 м²</div>
                </div>
              </div>
              <div class="pd-info-row">
                <div class="pd-info-row__icon">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h8"/></svg>
                </div>
                <div>
                  <div class="pd-info-row__label">Материалы</div>
                  <div class="pd-info-row__val">ЛДСП Egger + МДФ шпон ясеня</div>
                </div>
              </div>
              <div class="pd-info-row">
                <div class="pd-info-row__icon">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                </div>
                <div>
                  <div class="pd-info-row__label">Дата сдачи</div>
                  <div class="pd-info-row__val">Февраль 2026</div>
                </div>
              </div>
              <div class="pd-info-row">
                <div class="pd-info-row__icon">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                </div>
                <div>
                  <div class="pd-info-row__label">Срок производства</div>
                  <div class="pd-info-row__val">28 рабочих дней</div>
                </div>
              </div>
              <div class="pd-info-row">
                <div class="pd-info-row__icon">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                </div>
                <div>
                  <div class="pd-info-row__label">Город</div>
                  <div class="pd-info-row__val">Москва, МО</div>
                </div>
              </div>
              <div class="pd-info-row">
                <div class="pd-info-row__icon">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                </div>
                <div>
                  <div class="pd-info-row__label">Стиль</div>
                  <div class="pd-info-row__val">Скандинавский / эко</div>
                </div>
              </div>
              <div class="pd-info-row">
                <div class="pd-info-row__icon">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                </div>
                <div>
                  <div class="pd-info-row__label">Изделий</div>
                  <div class="pd-info-row__val">14 единиц мебели</div>
                </div>
              </div>
            </div>
            <div class="pd-info-card__cta">
              <button class="btn btn--primary" onclick="openModal()">Хочу такой же проект</button>
            </div>
          </div>
        </aside>

      </div>
    </div>
  </section>

  <!-- ============ GALLERY ============ -->
  <section class="pd-gallery">
    <div class="container">
      <div class="pd-gallery__header">
        <h2 class="pd-gallery__title">
          <span class="pd-section-label">Фотогалерея</span>
        </h2>
        <span style="font-size:0.8rem;color:var(--color-text-muted)">Нажмите для увеличения</span>
      </div>
      <div class="pd-gallery__grid" id="galleryGrid">
        <div class="pd-gallery__item pd-gallery__item--wide-tall" onclick="openLightbox(0)">
          <img src="<?php echo site_url('../img/'); ?>"kitchen_wood_autumn.jpg" alt="Общий вид — осенняя кухня" loading="lazy">
        </div>
        <div class="pd-gallery__item" onclick="openLightbox(1)">
          <img src="<?php echo site_url('../img/'); ?>"kitchen_olive_modern.jpg" alt="Угловая секция" loading="lazy">
        </div>
        <div class="pd-gallery__item" onclick="openLightbox(2)">
          <img src="<?php echo site_url('../img/'); ?>"kitchen_green_classic.jpg" alt="Рабочая зона" loading="lazy">
        </div>
        <div class="pd-gallery__item pd-gallery__item--wide" onclick="openLightbox(3)">
          <img src="<?php echo site_url('../img/'); ?>"kitchen_beige_compact.jpg" alt="Открытые полки с подсветкой" loading="lazy">
        </div>
        <div class="pd-gallery__item" onclick="openLightbox(4)">
          <img src="<?php echo site_url('../img/'); ?>"kitchen_grey_marble.jpg" alt="Столешница из кварцита" loading="lazy">
        </div>
        <div class="pd-gallery__item" onclick="openLightbox(5)">
          <img src="<?php echo site_url('../img/'); ?>"kitchen_mauve_classic.jpg" alt="Фасады крупным планом" loading="lazy">
        </div>
        <div class="pd-gallery__item" onclick="openLightbox(6)">
          <img src="<?php echo site_url('../img/'); ?>"kitchen_dark_premium.jpg" alt="Ниша под вытяжку" loading="lazy">
        </div>
      </div>
    </div>
  </section>

  <!-- ============ PREV / NEXT ============ -->
  <section class="pd-nav">
    <div class="container">
      <div class="pd-nav__inner">
        <a href="<?php echo get_post_type_archive_link('project'); ?>" class="pd-nav__item">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;opacity:.5"><polyline points="15 18 9 12 15 6"/></svg>
          <div>
            <div class="pd-nav__direction">Назад</div>
            <div class="pd-nav__name">Все проекты</div>
          </div>
        </a>
        <a href="project-kitchen-dark.html" class="pd-nav__item pd-nav__item--next">
          <div>
            <div class="pd-nav__direction">Следующий</div>
            <div class="pd-nav__name">Тёмная кухня с каменной столешницей</div>
          </div>
          <img class="pd-nav__img" src="<?php echo site_url('../img/'); ?>"kitchen_dark_premium.jpg" alt="Следующий проект">
        </a>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="section section--alt" style="padding:var(--space-2xl) 0;">
    <div class="container" style="text-align:center;">
      <h2 style="font-size:1.6rem;font-weight:700;margin-bottom:10px;">Хотите такой же результат?</h2>
      <p style="color:var(--color-text-soft);margin-bottom:var(--space-lg);">Оставьте заявку — замерщик приедет бесплатно в удобное время</p>
      <button class="btn btn--primary btn--lg" onclick="openModal()">Бесплатный замер</button>
    </div>
  </section>

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
