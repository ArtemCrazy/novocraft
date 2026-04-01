/* ========================================
   NOVACRAFT — Catalog Logic
   ======================================== */

const mockProducts = window.wpProducts || [
    // Кухни
    { id: 1,  name: 'Кухня «Эстетика»',          category: 'kitchen',  thumb: 'img/kitchen_010000.jpg' },
    { id: 2,  name: 'Кухня «Неоклассика»',        category: 'kitchen',  thumb: 'img/kitchen_030002.jpg' },
    { id: 3,  name: 'Кухня «Бетон»',              category: 'kitchen',  thumb: 'img/kitchen_030000.jpg' },
    { id: 4,  name: 'Кухня «Классика»',           category: 'kitchen',  thumb: 'img/kitchen_010000.jpg' },
    { id: 5,  name: 'Кухня «Минимализм»',         category: 'kitchen',  thumb: 'img/kitchen_030002.jpg' },
    { id: 6,  name: 'Кухня «Дерево»',             category: 'kitchen',  thumb: 'img/kitchen_030000.jpg' },
    { id: 7,  name: 'Кухня «Светлая»',            category: 'kitchen',  thumb: 'img/kitchen_010000.jpg' },
    { id: 8,  name: 'Кухня «Угловая»',            category: 'kitchen',  thumb: 'img/kitchen_030002.jpg' },
    // Шкафы
    { id: 9,  name: 'Шкаф-купе «Модерно»',        category: 'wardrobe', thumb: 'img/wardrobe_020000.jpg' },
    { id: 10, name: 'Встроенный шкаф «Норд»',     category: 'wardrobe', thumb: 'img/wardrobe_010000.jpg' },
    { id: 11, name: 'Шкаф-купе «Белый»',          category: 'wardrobe', thumb: 'img/wardrobe_020000.jpg' },
    { id: 12, name: 'Шкаф «Распашной»',           category: 'wardrobe', thumb: 'img/wardrobe_010000.jpg' },
    // Гардеробные
    { id: 13, name: 'Гардеробная «Классика»',      category: 'closet',   thumb: 'img/hallway_010000.jpg' },
    { id: 14, name: 'Гардеробная «Студио»',        category: 'closet',   thumb: 'img/hallway_020000.jpg' },
    { id: 15, name: 'Гардеробная «П-образная»',    category: 'closet',   thumb: 'img/hallway_010000.jpg' },
    // Кровати / спальни
    { id: 16, name: 'Спальня «Уютная»',           category: 'bedroom',  thumb: 'img/bedroom_010001.jpg' },
    { id: 17, name: 'Спальня «Светлая»',           category: 'bedroom',  thumb: 'img/bedroom_020002.jpg' },
    { id: 18, name: 'Спальня «Тёмный акцент»',     category: 'bedroom',  thumb: 'img/bedroom_010001.jpg' },
    { id: 19, name: 'Спальня «Минималистичная»',   category: 'bedroom',  thumb: 'img/bedroom_020002.jpg' },
    // Детские
    { id: 20, name: 'Детская «Двухъярусная»',      category: 'child',    thumb: 'img/bedroom_020002.jpg' },
    { id: 21, name: 'Детская «Для девочки»',       category: 'child',    thumb: 'img/bedroom_010001.jpg' },
    { id: 22, name: 'Детская «Зелёный стиль»',     category: 'child',    thumb: 'img/bedroom_020002.jpg' },
    { id: 23, name: 'Детская «Рабочее место»',     category: 'child',    thumb: 'img/bedroom_010001.jpg' },
    { id: 24, name: 'Детская «Нейтральная»',       category: 'child',    thumb: 'img/bedroom_020002.jpg' },
    // Прихожие
    { id: 25, name: 'Прихожая «Белая»',            category: 'hallway',  thumb: 'img/hallway_020000.jpg' },
    { id: 26, name: 'Прихожая «С зеркалом»',       category: 'hallway',  thumb: 'img/hallway_010000.jpg' },
    { id: 27, name: 'Прихожая «Компактная»',       category: 'hallway',  thumb: 'img/hallway_02000120.jpg' },
    { id: 28, name: 'Прихожая «С обувницей»',      category: 'hallway',  thumb: 'img/hallway_020000.jpg' },
    // Гостиные
    { id: 29, name: 'Стенка «Лофт-Спейс»',        category: 'living',   thumb: 'img/living_room_030000.jpg' },
    { id: 30, name: 'Стенка «ТВ-зона»',            category: 'living',   thumb: 'img/living_room_dark_accent.jpg' },
    { id: 31, name: 'Стенка «С полками»',          category: 'living',   thumb: 'img/living_room_030000.jpg' },
    { id: 32, name: 'Стенка «Modern»',             category: 'living',   thumb: 'img/living_room_dark_accent.jpg' },
    // Комоды
    { id: 33, name: 'Комод «Классика»',             category: 'dresser', thumb: 'img/bedroom_020002.jpg' },
    { id: 34, name: 'Комод «Модерн»',              category: 'dresser', thumb: 'img/bedroom_010001.jpg' },
    { id: 35, name: 'Комод «Светлый»',              category: 'dresser', thumb: 'img/bedroom_020002.jpg' },
    // Стеллажи / системы хранения
    { id: 36, name: 'Стеллаж «Открытый»',            category: 'storage', thumb: 'img/living_room_030000.jpg' },
    { id: 37, name: 'Система хранения «Модуль»',    category: 'storage', thumb: 'img/living_room_030000.jpg' },
    { id: 38, name: 'Стеллаж «Угловой»',            category: 'storage', thumb: 'img/wardrobe_020000.jpg' },
    // Столы
    { id: 39, name: 'Стол письменный «Офис»',       category: 'office',  thumb: 'img/living_room_030000.jpg' },
    { id: 40, name: 'Стол обеденный «Дерево»',       category: 'office',  thumb: 'img/kitchen_010000.jpg' },
    { id: 41, name: 'Стол «Минимализм»',            category: 'office',  thumb: 'img/living_room_030000.jpg' },
    // Тумбы
    { id: 42, name: 'Тумба прикроватная «Парные»',  category: 'bedside', thumb: 'img/bedroom_020002.jpg' },
    { id: 43, name: 'Тумба «С ящиками»',            category: 'bedside', thumb: 'img/bedroom_010001.jpg' },
    { id: 44, name: 'Тумба ТВ «Под экран»',         category: 'bedside', thumb: 'img/living_room_030000.jpg' },
];

// Дефолты по категориям: описание, размеры (мм), цена (руб.)
const categoryDefaults = {
    kitchen:   { desc: 'Кухонный гарнитур на заказ. Фасады, столешница и фурнитура по вашему выбору.', w: 2400, h: 2400, d: 600, price: 85000 },
    wardrobe:  { desc: 'Шкаф-купе или распашной шкаф для организованного хранения одежды.', w: 2000, h: 2500, d: 600, price: 45000 },
    closet:    { desc: 'Гардеробная система с полками, штангами и ящиками под ваши размеры.', w: 2500, h: 2500, d: 600, price: 75000 },
    bedroom:   { desc: 'Спальня с кроватью и системой хранения. Изготовление по размерам комнаты.', w: 3000, h: 2200, d: 600, price: 55000 },
    child:     { desc: 'Детская мебель: кровать, стол, шкаф. Безопасные материалы и фурнитура.', w: 2500, h: 2200, d: 600, price: 48000 },
    hallway:   { desc: 'Прихожая с шкафом и обувницей. Компактные решения под вашу планировку.', w: 1800, h: 2400, d: 450, price: 42000 },
    living:    { desc: 'Стенка или стеллаж под ТВ и хранение. Современный дизайн на заказ.', w: 3000, h: 2400, d: 450, price: 65000 },
    dresser:   { desc: 'Комод с ящиками для белья и вещей. Различная ширина и высота.', w: 1200, h: 900, d: 500, price: 28000 },
    storage:   { desc: 'Стеллаж или система хранения открытого или закрытого типа.', w: 2000, h: 2400, d: 400, price: 35000 },
    office:    { desc: 'Письменный или обеденный стол. Столешница и опора по вашим размерам.', w: 1400, h: 760, d: 700, price: 22000 },
    bedside:   { desc: 'Прикроватная тумба или тумба под ТВ. Ящики и полки по желанию.', w: 500, h: 500, d: 400, price: 12000 },
};

function getProductDisplay(p) {
    const d = categoryDefaults[p.category] || { desc: 'Мебель на заказ по индивидуальным размерам.', w: 0, h: 0, d: 0, price: 0 };
    const desc = p.description || d.desc;
    const w = p.width ?? d.w, h = p.height ?? d.h, depth = p.depth ?? d.d;
    const price = p.price ?? d.price;
    const priceStr = price > 0 ? 'от ' + price.toLocaleString('ru-RU') + ' руб.' : 'по запросу';
    return { desc, w, h, depth, priceStr };
}

let activeCategory = 'all';

document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('catalogGrid')) {
        // Circle filter buttons
        document.querySelectorAll('.cat-circle-item').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.cat-circle-item').forEach(b => b.classList.remove('cat-circle-item--active'));
                btn.classList.add('cat-circle-item--active');
                activeCategory = btn.dataset.cat;
                renderCatalog();
            });
        });

        // Apply category from URL param if present
        const urlCat = new URLSearchParams(window.location.search).get('category');
        if (urlCat) {
            const btn = document.querySelector(`.cat-circle-item[data-cat="${urlCat}"]`);
            if (btn) {
                document.querySelectorAll('.cat-circle-item').forEach(b => b.classList.remove('cat-circle-item--active'));
                btn.classList.add('cat-circle-item--active');
                activeCategory = urlCat;
            }
        }

        renderCatalog();
    }
});

function renderCatalog() {
    const grid = document.getElementById('catalogGrid');
    const emptyMsg = document.getElementById('catalogEmpty');

    const filtered = activeCategory === 'all'
        ? mockProducts
        : mockProducts.filter(p => p.category === activeCategory);

    grid.innerHTML = '';

    if (filtered.length === 0) {
        emptyMsg.style.display = 'block';
    } else {
        emptyMsg.style.display = 'none';
        filtered.forEach((p, idx) => {
            const delay = (idx % 3) * 0.08;
            const disp = getProductDisplay(p);
            const card = document.createElement('div');
            card.className = 'catalog-card';
            card.style.animation = `fadeIn 0.4s ease-out ${delay}s both`;
            card.innerHTML = `
                <div class="catalog-card__img">
                    <img src="${p.thumb}" alt="${p.name}" loading="lazy" onerror="this.src='img/hero_secondary.png'">
                </div>
                <div class="catalog-card__body">
                    <h3 class="catalog-card__title">${p.name}</h3>
                    <p class="catalog-card__desc">${disp.desc}</p>
                    <div class="catalog-card__dims">
                        <span><strong>Ширина</strong> ${disp.w ? disp.w + ' мм' : '—'}</span>
                        <span><strong>Высота</strong> ${disp.h ? disp.h + ' мм' : '—'}</span>
                        <span><strong>Глубина</strong> ${disp.depth ? disp.depth + ' мм' : '—'}</span>
                    </div>
                    <div class="catalog-card__price-row">
                        <span class="catalog-card__price">${disp.priceStr}</span>
                    </div>
                </div>
                <div class="catalog-card__hover">
                    <button type="button" class="catalog-card__hover-btn" onclick="event.stopPropagation(); openModal();">Рассчитать стоимость по вашим размерам</button>
                </div>
            `;
            initCatalogCardClick(card, p.id);
            grid.appendChild(card);
        });
    }
}

// Для страницы товара (product.html)
window.mockProducts = mockProducts;
window.getProductDisplay = getProductDisplay;

// Клик по карточке — переход на внутреннюю страницу товара (кроме кнопок)
function initCatalogCardClick(card, productId) {
    card.addEventListener('click', function (e) {
        if (e.target.closest('button') || e.target.closest('.catalog-card__hover')) return;
        window.location.href = 'product.html?id=' + productId;
    });
}
