/* Страница товара — внутренняя карточка по референсу */

function escapeHtml(s) {
    if (s == null) return '';
    var div = document.createElement('div');
    div.textContent = s;
    return div.innerHTML;
}

var TAB_TEXTS = {
    description: '<h3>О модели</h3><p>Модель изготавливается на заказ по вашим размерам и пожеланиям. Мы используем качественные материалы: ЛДСП и МДФ российских и европейских производителей, массив дуба и бука при необходимости, надёжную фурнитуру Blum, Hettich, Boyard. Покрытия выбираются из каталога RAL и образцов шпона — вы можете приехать в наш шоурум и подобрать цвет и фактуру.</p><p>Конструкция предусматривает регулировку по высоте там, где это нужно, и возможность доукомплектации выдвижными системами, подсветкой, стеклянными фасадами. Все кромки обрабатываются на профессиональном оборудовании, что обеспечивает аккуратный вид и долгий срок службы.</p><h3>Особенности</h3><ul><li>Изготовление по индивидуальным размерам с точностью до миллиметра</li><li>Широкий выбор материалов, цветов и фурнитуры</li><li>Собственное производство в Нижнем Новгороде, контроль на каждом этапе</li><li>Возможность интеграции подсветки, розеток и выдвижных систем</li></ul><p>Срок изготовления зависит от сложности и загрузки производства; ориентировочно от 2 до 6 недель. Точные сроки и стоимость уточняются после замера и согласования проекта.</p>',
    payment: '<h3>Способы оплаты</h3><ol class="product-inner__payment-list">' +
        '<li class="product-inner__payment-item"><span class="product-inner__payment-num">1</span><div class="product-inner__payment-content"><strong class="product-inner__payment-title">Наличный расчёт</strong><p class="product-inner__payment-desc">Вы можете рассчитаться наличными на дому (при выезде сотрудника для заключения договора) или в офисе компании по адресу: г. Нижний Новгород, ул. Маршала Воронова, 11.</p></div></li>' +
        '<li class="product-inner__payment-item"><span class="product-inner__payment-num">2</span><div class="product-inner__payment-content"><strong class="product-inner__payment-title">Оплата по картам через эквайринг</strong><p class="product-inner__payment-desc">Вы можете оплатить онлайн по ссылке или QR-коду, через терминал (при выезде сотрудника для заключения договора) или в офисе компании по адресу: г. Нижний Новгород, ул. Маршала Воронова, 11.</p></div></li>' +
        '<li class="product-inner__payment-item"><span class="product-inner__payment-num">3</span><div class="product-inner__payment-content"><strong class="product-inner__payment-title">Безналичный расчёт</strong><p class="product-inner__payment-desc">Принимаем оплату по безналичному расчёту от юридических лиц с предоставлением всех закрывающих документов.</p></div></li>' +
        '</ol>',
    warranty: '<h3>Гарантия</h3><p>На всю изготовленную мебель распространяется гарантия 24 месяца с момента передачи заказа клиенту. Гарантия покрывает дефекты материалов и изготовления: расслоение, деформацию, неработоспособность фурнитуры при соблюдении условий эксплуатации.</p><p>Гарантия не распространяется на повреждения, возникшие по вине заказчика (механические удары, затопление, неправильная сборка не нашими специалистами), а также на естественное изменение оттенка материалов под воздействием света.</p><h3>Возврат</h3><p>Мебель изготавливается по индивидуальным размерам под конкретный заказ, поэтому возврат как в обычном магазине не предусмотрен. В случае существенного несоответствия договору (ошибка по нашим замерам, брак) мы устраняем недостатки за свой счёт или пересчитываем стоимость.</p><p>Все претензии принимаются в письменном виде в течение 7 дней с момента доставки и сборки. Мы обязуемся рассмотреть обращение в течение 10 рабочих дней и предложить решение в соответствии с законом о защите прав потребителей.</p>',
    delivery: '<h3>Доставка</h3><p>Доставляем мебель по Нижнему Новгороду, Москве, Московской области и в регионы России. Стоимость и сроки зависят от габаритов заказа и адреса.</p><ul><li><strong>Нижний Новгород и область</strong> — доставка нашим транспортом, подъём на этаж (при наличии лифта — бесплатно, без лифта — уточняется). Срок доставки согласовывается после готовности заказа, обычно в течение 3–5 рабочих дней.</li><li><strong>Москва и МО</strong> — доставка транспортом партнёров или нашей машиной. Подъём и занос обсуждаются отдельно. Сроки — от 5 до 14 дней с момента готовности в зависимости от загрузки.</li><li><strong>Регионы РФ</strong> — отправка транспортными компаниями (КИТ, Деловые Линии, ЖелДорЭкспедиция и др.) до терминала в вашем городе. Доставка от терминала до двери при необходимости заказывается отдельно. Сроки — от 3 до 14 дней в пути в зависимости от направления.</li></ul><h3>Сборка</h3><p>Сборку выполняют наши специалисты: аккуратно, с проверкой всех механизмов и регулировок. Сборка оплачивается отдельно и включается в смету при согласовании заказа. Время на сборку зависит от сложности: от нескольких часов для простого шкафа до одного–двух дней для большой кухни или гардеробной.</p><p>После сборки вы подписываете акт приёмки. Рекомендуем проверить внешний вид и работу фурнитуры в момент приёмки — так проще зафиксировать возможные замечания.</p>'
};

document.addEventListener('DOMContentLoaded', function () {
    var id = new URLSearchParams(window.location.search).get('id');
    var products = window.mockProducts;
    var getProductDisplay = window.getProductDisplay;

    if (!products || !getProductDisplay || !id) {
        window.location.href = 'catalog.html';
        return;
    }

    var p = products.find(function (x) { return x.id == id; });
    if (!p) {
        window.location.href = 'catalog.html';
        return;
    }

    var disp = getProductDisplay(p);
    var root = document.getElementById('productRoot');
    if (!root) return;

    var nameEsc = escapeHtml(p.name);
    var priceEsc = escapeHtml(disp.priceStr);
    var descEsc = escapeHtml(disp.desc);
    var thumbEsc = escapeHtml(p.thumb);
    var wVal = disp.w ? (disp.w + '\u00A0мм') : '—';
    var hVal = disp.h ? (disp.h + '\u00A0мм') : '—';
    var depthVal = disp.depth ? (disp.depth + '\u00A0мм') : '—';

    var galleryImages = [p.thumb, 'img/wardrobe_020000.jpg', 'img/kitchen_010000.jpg', 'img/wardrobe_010000.jpg', 'img/hero_secondary.png'];
    var thumbEscList = galleryImages.map(function (url) { return escapeHtml(url); });

    var thumbsHtml = thumbEscList.map(function (src, i) {
        return '<button type="button" class="product-inner__thumb' + (i === 0 ? ' product-inner__thumb--active' : '') + '" data-index="' + i + '" aria-label="Фото ' + (i + 1) + '"><img src="' + src + '" alt="" onerror="this.src=\'img/hero_secondary.png\'"></button>';
    }).join('');

    root.innerHTML = '<div class="product-inner">' +
        '<div class="product-inner__top">' +
            '<h1 class="product-inner__title">' + nameEsc + '</h1>' +
            '<div class="product-inner__price-block">' +
                '<span class="product-inner__price">' + priceEsc + '</span>' +
                '<span class="product-inner__price-tooltip" aria-label="Стоимость зависит от габаритов, внутреннего наполнения и материалов. Оставьте заявку на расчёт со своими пожеланиями — мы предложим оптимальное решение без навязывания лишнего.">' +
                    '<span class="product-inner__price-tooltip-icon">?</span>' +
                    '<span class="product-inner__price-tooltip-text">Стоимость зависит от габаритов, внутреннего наполнения и материалов. Оставьте заявку на расчёт со своими пожеланиями — мы предложим оптимальное решение без навязывания лишнего.</span>' +
                '</span>' +
            '</div>' +
        '</div>' +
        '<div class="product-inner__row">' +
            '<div class="product-inner__gallery">' +
                '<div class="product-inner__slider">' +
                    '<div class="product-inner__img-wrap">' +
                        '<img src="' + thumbEscList[0] + '" alt="' + nameEsc + '" class="product-inner__img" id="productMainImg" onerror="this.src=\'img/hero_secondary.png\'">' +
                    '</div>' +
                    '<div class="product-inner__thumbs">' + thumbsHtml + '</div>' +
                '</div>' +
            '</div>' +
            '<div class="product-inner__side">' +
                '<div class="product-inner__cta">' +
                    '<div class="product-inner__cta-title">Есть дизайн-проект?</div>' +
                    '<p class="product-inner__cta-text">Оставьте заявку на <a href="#" class="product-inner__cta-link" onclick="openCalculationModal(); return false;">расчёт</a> — мы подготовим предложение под ваши размеры и свяжемся с вами.</p>' +
                '</div>' +
                '<div class="product-inner__actions">' +
                    '<button type="button" class="btn btn--primary product-inner__btn" onclick="openModal()">Расчет проекта</button>' +
                    '<a href="https://t.me/novikov8777" target="_blank" rel="noopener" class="btn product-inner__btn product-inner__btn--outline product-inner__btn--telegram"><span class="product-inner__btn-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg></span>Написать нам</a>' +
                '</div>' +
                '<div class="product-inner__dims">' +
                    '<div class="product-inner__dims-title">Габариты</div>' +
                    '<div class="product-inner__dims-grid">' +
                        '<div class="product-inner__dim-item"><span class="product-inner__dim-label">Ширина</span><span class="product-inner__dim-value">' + wVal + '</span></div>' +
                        '<div class="product-inner__dim-item"><span class="product-inner__dim-label">Высота</span><span class="product-inner__dim-value">' + hVal + '</span></div>' +
                        '<div class="product-inner__dim-item"><span class="product-inner__dim-label">Глубина</span><span class="product-inner__dim-value">' + depthVal + '</span></div>' +
                    '</div>' +
                '</div>' +
            '</div>' +
        '</div>' +
        '<div class="product-inner__tabs">' +
            '<button type="button" class="product-inner__tab product-inner__tab--active" data-tab="description">Описание модели</button>' +
            '<button type="button" class="product-inner__tab" data-tab="payment">Способы оплаты</button>' +
            '<button type="button" class="product-inner__tab" data-tab="warranty">Гарантия и возврат</button>' +
            '<button type="button" class="product-inner__tab" data-tab="delivery">Доставка и сборка</button>' +
        '</div>' +
        '<div class="product-inner__tab-panels">' +
            '<div class="product-inner__tab-panel product-inner__tab-panel--active" data-panel="description">' + TAB_TEXTS.description + '</div>' +
            '<div class="product-inner__tab-panel" data-panel="payment">' + TAB_TEXTS.payment + '</div>' +
            '<div class="product-inner__tab-panel" data-panel="warranty">' + TAB_TEXTS.warranty + '</div>' +
            '<div class="product-inner__tab-panel" data-panel="delivery">' + TAB_TEXTS.delivery + '</div>' +
        '</div>' +
    '</div>';

    document.title = p.name + ' — Novacraft';

    var breadcrumbCurrent = document.getElementById('productBreadcrumbCurrent');
    if (breadcrumbCurrent) breadcrumbCurrent.textContent = p.name;

    // Переключение вкладок
    root.querySelectorAll('.product-inner__tab').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var tab = btn.getAttribute('data-tab');
            if (!tab) return;
            root.querySelectorAll('.product-inner__tab').forEach(function (b) { b.classList.remove('product-inner__tab--active'); });
            root.querySelectorAll('.product-inner__tab-panel').forEach(function (panel) {
                panel.classList.toggle('product-inner__tab-panel--active', panel.getAttribute('data-panel') === tab);
            });
            btn.classList.add('product-inner__tab--active');
        });
    });

    // Слайдер галереи: клик по миниатюре меняет основное фото
    var mainImg = root.querySelector('#productMainImg');
    if (mainImg) {
        root.querySelectorAll('.product-inner__thumb').forEach(function (thumbBtn) {
            thumbBtn.addEventListener('click', function () {
                var idx = thumbBtn.getAttribute('data-index');
                var imgSrc = galleryImages[parseInt(idx, 10)];
                if (imgSrc) {
                    mainImg.src = imgSrc;
                    root.querySelectorAll('.product-inner__thumb').forEach(function (t) { t.classList.remove('product-inner__thumb--active'); });
                    thumbBtn.classList.add('product-inner__thumb--active');
                }
            });
        });
    }
});
