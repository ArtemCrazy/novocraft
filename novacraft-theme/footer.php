<?php $c = novacraft_contacts(); ?>
<footer class="footer">
    <div class="container">
      <div class="footer__grid">
        <div class="footer__brand">
          <div class="footer__logo">Nova<span>craft</span></div>
          <p>Изготовление мебели на заказ с собственным производством в Нижнем Новгороде. Работаем по всей России.</p>
        </div>

        <div>
          <div class="footer__title">Каталог</div>
          <div class="footer__links">
            <a href="<?php echo get_post_type_archive_link('furniture'); ?>">Кухни</a>
            <a href="<?php echo get_post_type_archive_link('furniture'); ?>">Шкафы и шкафы-купе</a>
            <a href="<?php echo get_post_type_archive_link('furniture'); ?>">Гардеробные</a>
            <a href="<?php echo get_post_type_archive_link('furniture'); ?>">Системы хранения</a>
            <a href="<?php echo get_post_type_archive_link('furniture'); ?>">Стенки и стеллажи</a>
          </div>
        </div>

        <div>
          <div class="footer__title">Компания</div>
          <div class="footer__links">
            <a href="<?php echo home_url('/about'); ?>">О производстве</a>
            <a href="<?php echo get_post_type_archive_link('project'); ?>">Наши проекты</a>
            <a href="<?php echo home_url('/contacts'); ?>">Контакты</a>
          </div>
        </div>

        <div>
          <div class="footer__title">Контакты</div>
          <div class="footer__contact-item">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
              stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path
                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
            </svg>
            <a href="tel:<?php echo esc_attr($c['phone_raw']); ?>"><?php echo esc_html($c['phone']); ?></a>
          </div>
          <div class="footer__contact-item">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
              stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
              <polyline points="22,6 12,13 2,6" />
            </svg>
            <a href="mailto:<?php echo esc_attr($c['email']); ?>"><?php echo esc_html($c['email']); ?></a>
          </div>
          <div class="footer__contact-item">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
              stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M22 2L11 13" />
                <polygon points="22 2 15 22 11 13 2 9 22 2" />
            </svg>
            <a href="<?php echo esc_url($c['telegram']); ?>" target="_blank">Telegram</a>
          </div>
          <div class="footer__contact-item" style="margin-top: var(--space-sm); align-items: flex-start;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
              stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
              <circle cx="12" cy="10" r="3" />
            </svg>
            <div style="line-height: 1.4;">
              <?php echo esc_html($c['address_nn']); ?><br>
              <span style="font-size: 0.85em; opacity: 0.7;">Работаем: Москва, МО, Н.Новгород</span>
            </div>
          </div>
        </div>
      </div>

      <div class="footer__bottom">
        <span>&copy; <?php echo date('Y'); ?> Novacraft. Все права защищены.</span>
        <div class="footer__socials">
          <?php if($c['whatsapp']): ?>
          <a href="<?php echo esc_url($c['whatsapp']); ?>" target="_blank" aria-label="WhatsApp">
            <img src="<?php echo site_url('../icons/'); ?>whatsapp-2 2.png" alt="WhatsApp">
          </a>
          <?php endif; ?>
          <?php if($c['telegram']): ?>
          <a href="<?php echo esc_url($c['telegram']); ?>" target="_blank" aria-label="Telegram">
            <img src="<?php echo site_url('../icons/'); ?>Vector.png" alt="Telegram">
          </a>
          <?php endif; ?>
          <?php if($c['max']): ?>
          <a href="<?php echo esc_url($c['max']); ?>" target="_blank" aria-label="MAX" class="footer__social-max">
            <img src="<?php echo site_url('../icons/'); ?>max.png" alt="MAX">
          </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </footer>

  <!-- ============ QUIZ MODAL ============ -->
  <div class="modal-overlay" id="quizModalOverlay">
    <div class="modal modal--quiz">
      <button class="modal__close" onclick="closeQuizModal()" aria-label="Закрыть">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18" />
          <line x1="6" y1="6" x2="18" y2="18" />
        </svg>
      </button>

      <div class="quiz-container">
        <!-- Progress Bar -->
        <div class="quiz__progress">
          <div class="quiz__progress-text">Шаг <span id="quizCurrentStep">1</span> из 4</div>
          <div class="quiz__progress-bar">
            <div class="quiz__progress-fill" id="quizProgressFill" style="width: 25%;"></div>
          </div>
        </div>

        <form id="quizForm" onsubmit="handleQuizSubmit(event)">
          <!-- Step 1 -->
          <div class="quiz-step active" id="quizStep1">
            <h3 class="quiz__title">Какая мебель вас интересует?</h3>
            <div class="quiz__options">
              <label class="quiz__option">
                <input type="radio" name="quiz_type" value="kitchen" required>
                <div class="quiz__option-card">
                  <div class="quiz__option-icon">🍽️</div>
                  <div class="quiz__option-label">Кухня</div>
                </div>
              </label>
              <label class="quiz__option">
                <input type="radio" name="quiz_type" value="wardrobe">
                <div class="quiz__option-card">
                  <div class="quiz__option-icon">🚪</div>
                  <div class="quiz__option-label">Шкаф / Шкаф-купе</div>
                </div>
              </label>
              <label class="quiz__option">
                <input type="radio" name="quiz_type" value="closet">
                <div class="quiz__option-card">
                  <div class="quiz__option-icon">👗</div>
                  <div class="quiz__option-label">Гардеробная</div>
                </div>
              </label>
              <label class="quiz__option">
                <input type="radio" name="quiz_type" value="other">
                <div class="quiz__option-card">
                  <div class="quiz__option-icon">🪑</div>
                  <div class="quiz__option-label">Другая мебель</div>
                </div>
              </label>
            </div>
          </div>

          <!-- Step 2 -->
          <div class="quiz-step" id="quizStep2">
            <h3 class="quiz__title">Какой стиль вам ближе?</h3>
            <div class="quiz__options quiz__options--grid2">
              <label class="quiz__option">
                <input type="radio" name="quiz_style" value="modern">
                <div class="quiz__option-card">
                  <div class="quiz__option-label">Современный (Модерн)</div>
                </div>
              </label>
              <label class="quiz__option">
                <input type="radio" name="quiz_style" value="classic">
                <div class="quiz__option-card">
                  <div class="quiz__option-label">Классика / Неоклассика</div>
                </div>
              </label>
              <label class="quiz__option">
                <input type="radio" name="quiz_style" value="loft">
                <div class="quiz__option-card">
                  <div class="quiz__option-label">Лофт</div>
                </div>
              </label>
              <label class="quiz__option">
                <input type="radio" name="quiz_style" value="minimalism">
                <div class="quiz__option-card">
                  <div class="quiz__option-label">Минимализм / Сканди</div>
                </div>
              </label>
            </div>
          </div>

          <!-- Step 3 -->
          <div class="quiz-step" id="quizStep3">
            <h3 class="quiz__title">Где будет находиться объект?</h3>
            <div class="quiz__options quiz__options--grid2">
              <label class="quiz__option">
                <input type="radio" name="quiz_region" value="moscow">
                <div class="quiz__option-card">
                  <div class="quiz__option-label">Москва и область</div>
                </div>
              </label>
              <label class="quiz__option">
                <input type="radio" name="quiz_region" value="nn">
                <div class="quiz__option-card">
                  <div class="quiz__option-label">Нижний Новгород и область</div>
                </div>
              </label>
            </div>
            <div class="form-group" style="margin-top: 15px;">
              <label for="quizTime">Когда планируете установку?</label>
              <select id="quizTime" name="quiz_time">
                <option value="asap">Как можно скорее</option>
                <option value="1month">В течение месяца</option>
                <option value="3months">Через 2-3 месяца</option>
                <option value="not_sure">Пока просто прицениваюсь</option>
              </select>
            </div>
          </div>

          <!-- Step 4 (Final) -->
          <div class="quiz-step quiz-step--final" id="quizStep4">
            <h3 class="quiz__title">Отлично! Оставьте контакты</h3>
            <p class="quiz__subtitle">Мы рассчитаем примерную стоимость и свяжемся с вами за 15 минут.</p>

            <div class="form-group">
              <label for="quizName">Имя *</label>
              <input type="text" id="quizName" name="name" placeholder="Как к вам обращаться?" required>
            </div>
            <div class="form-group">
              <label for="quizPhone">Телефон *</label>
              <input type="tel" id="quizPhone" name="phone" placeholder="+7 (___) ___-__-__" required>
            </div>
            <div class="form-consent">
              <input type="checkbox" id="quizConsent" required>
              <label for="quizConsent">Согласен на обработку персональных данных</label>
            </div>
          </div>

          <!-- Quiz Navigation -->
          <div class="quiz__nav">
            <button type="button" class="btn btn--outline" id="quizPrevBtn" onclick="prevQuizStep()"
              style="display: none;">Назад</button>
            <button type="button" class="btn btn--primary" id="quizNextBtn" onclick="nextQuizStep()"
              disabled>Далее</button>
            <button type="submit" class="btn btn--primary" id="quizSubmitBtn" style="display: none;">Получить
              расчёт</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- ============ MODAL ============ -->
  <div class="modal-overlay" id="modalOverlay">
    <div class="modal">
      <button class="modal__close" onclick="closeModal()" aria-label="Закрыть">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18" />
          <line x1="6" y1="6" x2="18" y2="18" />
        </svg>
      </button>
      <h3 class="contact__form-title">Оставить заявку</h3>
      <p class="contact__form-subtitle">Мы подготовим расчёт стоимости проекта в течение 2 рабочих дней</p>
      <form id="modalForm" onsubmit="handleModalSubmit(event)">
        <div class="form-group">
          <label for="modalName">Имя *</label>
          <input type="text" id="modalName" name="name" placeholder="Как к вам обращаться?" required>
        </div>
        <div class="form-group">
          <label for="modalPhone">Телефон *</label>
          <input type="tel" id="modalPhone" name="phone" placeholder="+7 (___) ___-__-__" required>
        </div>
        <div class="form-group">
          <label for="modalService">Что вас интересует?</label>
          <select id="modalService" name="service">
            <option value="">Выберите услугу</option>
            <option value="kitchen">Кухня на заказ</option>
            <option value="wardrobe">Шкаф / Шкаф-купе</option>
            <option value="closet">Гардеробная</option>
            <option value="storage">Системы хранения</option>
            <option value="tvunit">Стенка под телевизор</option>
            <option value="other">Другое</option>
          </select>
        </div>
        <div class="form-consent">
          <input type="checkbox" id="modalConsent" required>
          <label for="modalConsent">Согласен на обработку персональных данных</label>
        </div>
        <button type="submit" class="btn btn--primary btn--lg" style="width:100%; margin-top: var(--space-md);">
          Заказать звонок
        </button>
      </form>
    </div>
  </div>

  <!-- ============ SCROLL TO TOP ============ -->
  <button class="scroll-top" id="scrollTop" onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
    aria-label="Наверх">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
      stroke-linecap="round" stroke-linejoin="round">
      <polyline points="18 15 12 9 6 15" />
    </svg>
  </button>

  
<?php wp_footer(); ?>
</body>

</html>
