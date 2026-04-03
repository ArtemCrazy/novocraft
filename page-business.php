<?php
/* Template Name: Для бизнеса */

get_header();

$u = esc_url( get_template_directory_uri() );
?>

<!-- ============ HERO ============ -->
<section class="biz-hero">
    <div class="container">
        <div class="biz-hero__inner">
            <div class="biz-hero__content">
                <div class="biz-hero__badge">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                    Решения для бизнеса
                </div>
                <h1 class="biz-hero__title">
                    От идеи до поставки —&nbsp;<span>мебель и&nbsp;оборудование</span> для вашего бизнеса
                </h1>
                <p class="biz-hero__sub">
                    Торговое оборудование, мебель на заказ, световой дизайн и дизайн интерьера — полный цикл для магазинов, офисов, ресторанов и гостиниц. Собственное производство в Нижнем Новгороде.
                </p>
                <div class="biz-hero__actions">
                    <button class="btn btn--primary btn--lg" onclick="openBizModal('biz-contact-modal')">
                        Получить коммерческое предложение
                    </button>
                    <a href="tel:+79160128777" class="btn btn--outline btn--lg" style="border-color: rgba(255,255,255,0.3); color: #fff;">
                        Позвонить нам
                    </a>
                </div>

                <div class="biz-stats">
                    <div>
                        <div class="biz-stat__num">30+</div>
                        <div class="biz-stat__label">лет опыта в производстве</div>
                    </div>
                    <div>
                        <div class="biz-stat__num">5 000+</div>
                        <div class="biz-stat__label">выполненных коммерческих объектов</div>
                    </div>
                    <div>
                        <div class="biz-stat__num">1 000+</div>
                        <div class="biz-stat__label">постоянных клиентов по России</div>
                    </div>
                    <div>
                        <div class="biz-stat__num">100%</div>
                        <div class="biz-stat__label">собственное производство</div>
                    </div>
                </div>
            </div>

            <div class="biz-hero__form-card">
                <h3>Бесплатный расчёт проекта</h3>
                <p>Оставьте заявку — менеджер свяжется в течение часа</p>
                <form onsubmit="handleBizHeroSubmit(event)">
                    <div class="form-group">
                        <label>Ваше имя</label>
                        <input type="text" placeholder="Иван Петров" required>
                    </div>
                    <div class="form-group">
                        <label>Телефон</label>
                        <input type="tel" placeholder="+7 (___) ___-__-__" required>
                    </div>
                    <div class="form-group">
                        <label>Тип объекта</label>
                        <select>
                            <option value="">Выберите тип</option>
                            <option>Магазин одежды / обуви</option>
                            <option>Аптека</option>
                            <option>Ресторан / кафе</option>
                            <option>Офис / бизнес-центр</option>
                            <option>Торговый центр</option>
                            <option>Гостиница / отель</option>
                            <option>Медицинская клиника</option>
                            <option>Другое</option>
                        </select>
                    </div>
                    <div class="form-consent">
                        <input type="checkbox" id="bizHeroConsent" required>
                        <label for="bizHeroConsent" style="color: rgba(255,255,255,0.55); font-size: 0.8rem;">Согласен на обработку персональных данных</label>
                    </div>
                    <button type="submit" class="btn btn--primary" style="width: 100%; margin-top: 10px;">
                        Получить КП бесплатно
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- ============ TABS (FILTER) ============ -->
<section class="section pb-0" style="padding-bottom: 0;">
    <div class="container">
        <div class="biz-tabs reveal">
            <button class="biz-tab active" onclick="filterBiz('all')">Все направления</button>
            <button class="biz-tab" onclick="filterBiz('trade')">Торговое оборудование</button>
            <button class="biz-tab" onclick="filterBiz('light')">Световой дизайн</button>
        </div>
    </div>
</section>

<!-- ============ TRADE EQUIPMENT ============ -->
<section class="section biz-category-section" id="section-trade">
    <div class="container">
        <h2 class="biz-category-section__title reveal">Торговое оборудование</h2>
        <p class="biz-category-section__sub reveal">Оборудование для розничных магазинов с учётом мерчандайзинга и фирменного стиля</p>
        <div class="biz-category-grid biz-category-grid--trade reveal">
            <?php
            $trade_items = [
                [ 'title' => 'Одежда',             'img' => 'torg/Максималист_ТЦ Индиго НН.jpg' ],
                [ 'title' => 'Обувь',              'img' => 'torg/Rieker_Арзамас2.jpg' ],
                [ 'title' => 'Галантерея',          'img' => 'torg/IMG_5628_ЦУМ_НН.jpg' ],
                [ 'title' => 'Спорт',              'img' => 'torg/Спортсмен ТЦ_Золотая миля_НН11.jpg' ],
                [ 'title' => 'Аптеки',             'img' => 'torg/Мировая оптика_Красногорск 0.jpg' ],
                [ 'title' => 'Оптики',             'img' => 'torg/М.оптика_Красногорск.jpg' ],
                [ 'title' => 'Ткани',              'img' => 'torg/Максималист_ТЦ Индиго НН13.jpg' ],
                [ 'title' => 'Часы',               'img' => 'torg/jeneva2_ТЦ7небоНН.jpg' ],
                [ 'title' => 'Книги',              'img' => 'torg/Феникс_Фантастика_14.06.18.jpg' ],
                [ 'title' => 'Электроника',         'img' => 'torg/Спортсмен ТЦ_Золотая миля_НН51.jpg' ],
                [ 'title' => 'Продукты',           'img' => 'torg/IMG_5630_ЦУМ_НН.jpg' ],
                [ 'title' => 'Украшения',          'img' => 'torg/shine_rostov1.jpg' ],
                [ 'title' => 'Сувениры',           'img' => 'torg/jeneva4_ТЦ7небоНН.jpg' ],
                [ 'title' => 'Парфюм и косметика', 'img' => 'torg/Мировая оптика_Красногорск (1).jpg' ],
            ];
            foreach ( $trade_items as $item ) :
            ?>
            <a href="#" class="biz-category-card-img" onclick="openBizModal('modal-trade'); return false;">
                <span class="biz-category-card-img__pic"><img src="<?php echo $u; ?>/img/<?php echo esc_attr( $item['img'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" loading="lazy"></span>
                <span class="biz-category-card-img__title"><?php echo esc_html( $item['title'] ); ?></span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============ LIGHT DESIGN ============ -->
<section class="section section--alt biz-category-section" id="section-light">
    <div class="container">
        <h2 class="biz-category-section__title reveal">Световой дизайн</h2>
        <p class="biz-category-section__sub reveal">Проектирование освещения для интерьеров, торговых зон и городской среды</p>
        <div class="biz-category-grid biz-category-grid--trade reveal">
            <?php
            $light_items = [
                [ 'title' => 'Световой аудит',               'img' => 'light/light_audit_1774709284920.png' ],
                [ 'title' => 'Световое мастер-планирование',  'img' => 'light/light_plan_1774709298962.png' ],
                [ 'title' => 'Городская среда',               'img' => 'light/urban_light_1774709315627.png' ],
                [ 'title' => 'Частные сады',                  'img' => 'light/garden_light_1774709334640.png' ],
                [ 'title' => 'Общественные интерьеры',        'img' => 'light/public_interior_1774709347263.png' ],
                [ 'title' => 'Жилые интерьеры',               'img' => 'light/residential_light_1774709363265.png' ],
                [ 'title' => 'Освещение мебели',              'img' => 'light/furniture_light_1774709380614.png' ],
                [ 'title' => 'Дизайн светильников',           'img' => 'light/fixture_design_1774709398559.png' ],
                [ 'title' => 'Световые инсталляции',          'img' => 'light/light_install_1774709411850.png' ],
                [ 'title' => 'События',                       'img' => 'light/event_light_1774709427785.png' ],
                [ 'title' => 'Курсы светодизайна',            'img' => 'light/light_course_1774709444573.png' ],
            ];
            foreach ( $light_items as $item ) :
            ?>
            <a href="#" class="biz-category-card-img" onclick="openBizModal('modal-light'); return false;">
                <span class="biz-category-card-img__pic"><img src="<?php echo $u; ?>/img/<?php echo esc_attr( $item['img'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" loading="lazy"></span>
                <span class="biz-category-card-img__title"><?php echo esc_html( $item['title'] ); ?></span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============ GUARANTEES ============ -->
<section class="section section--alt">
    <div class="container">
        <div class="section__header reveal">
            <div class="section__eyebrow">Наши принципы</div>
            <h2 class="section__title">Мы гарантируем</h2>
        </div>

        <div class="biz-guarantee-grid reveal">
            <?php
            $guarantees = [
                [ 'num' => '01', 'title' => 'Инновационные решения', 'text' => 'Следим за трендами и внедряем современные технологии производства. Ваш объект будет выглядеть актуально ещё долгие годы.' ],
                [ 'num' => '02', 'title' => 'Соблюдение сроков', 'text' => 'Фиксируем сроки в договоре и неукоснительно их соблюдаем. Задержка сдачи объекта означает для нас финансовую ответственность.' ],
                [ 'num' => '03', 'title' => 'Собственное производство', 'text' => 'Полный контроль качества на каждом этапе. Без посредников — вы получаете оптовые цены и гарантию соответствия заявленным характеристикам.' ],
                [ 'num' => '04', 'title' => 'Комплексный подход', 'text' => 'Оборудование + дизайн + освещение + производство + монтаж — всё в одном месте. Минимум координации, максимум результата.' ],
                [ 'num' => '05', 'title' => 'Индивидуальный подход', 'text' => 'Каждый проект уникален. Учитываем ваш бренд, концепцию, целевую аудиторию и особенности помещения — никаких шаблонных решений.' ],
                [ 'num' => '06', 'title' => 'Опыт и профессионализм', 'text' => 'Команда сертифицированных специалистов: дизайнеры, технологи, монтажники. Высокий уровень качества подтверждён тысячами реализованных проектов.' ],
            ];
            foreach ( $guarantees as $g ) :
            ?>
            <div class="biz-guarantee-item">
                <div class="biz-guarantee-item__num"><?php echo esc_html( $g['num'] ); ?></div>
                <div>
                    <div class="biz-guarantee-item__title"><?php echo esc_html( $g['title'] ); ?></div>
                    <p class="biz-guarantee-item__text"><?php echo esc_html( $g['text'] ); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php get_template_part( 'template-parts/contact-section' ); ?>

<?php get_footer(); ?>
