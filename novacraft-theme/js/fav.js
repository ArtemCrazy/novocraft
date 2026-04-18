/* =========================================================
   Novacraft — Избранное (Favourites)
   Storage: localStorage 'nc_fav'  +  cookie 'nc_fav_count'
   ========================================================= */
(function () {
  'use strict';

  var KEY = 'nc_fav';

  /* ---------- Cookie ---------- */
  function setCookie(n) {
    var exp = new Date(Date.now() + 30 * 24 * 60 * 60 * 1000).toUTCString();
    document.cookie = 'nc_fav_count=' + n + '; path=/; expires=' + exp + '; SameSite=Lax';
  }

  /* ---------- Storage ---------- */
  function getFavs() {
    try { return JSON.parse(localStorage.getItem(KEY) || '[]'); } catch (e) { return []; }
  }
  function saveFavs(arr) {
    localStorage.setItem(KEY, JSON.stringify(arr));
    setCookie(arr.length);
    updateBadge(arr.length);
    renderDrawer(arr);
  }
  function isFav(id) {
    return getFavs().some(function (f) { return String(f.id) === String(id); });
  }
  function addFav(item) {
    var f = getFavs();
    if (!f.some(function (x) { return String(x.id) === String(item.id); })) { f.push(item); }
    saveFavs(f);
  }
  function removeFav(id) {
    saveFavs(getFavs().filter(function (f) { return String(f.id) !== String(id); }));
  }
  function toggleFav(item) {
    if (isFav(item.id)) { removeFav(item.id); return false; }
    else { addFav(item); return true; }
  }

  /* ---------- Badge ---------- */
  function updateBadge(count) {
    var badge = document.getElementById('favBadge');
    if (!badge) return;
    badge.textContent = count;
    badge.style.display = count > 0 ? 'flex' : 'none';
  }

  /* ---------- Drawer ---------- */
  function openDrawer() {
    var drawer  = document.getElementById('favDrawer');
    var overlay = document.getElementById('favOverlay');
    if (overlay) {
      overlay.style.display = 'block';
      requestAnimationFrame(function () {
        overlay.classList.add('fav-overlay--visible');
      });
    }
    if (drawer) drawer.classList.add('fav-drawer--open');
    document.body.style.overflow = 'hidden';
    renderDrawer(getFavs());
  }
  function closeDrawer() {
    var drawer  = document.getElementById('favDrawer');
    var overlay = document.getElementById('favOverlay');
    if (drawer)  drawer.classList.remove('fav-drawer--open');
    if (overlay) {
      overlay.classList.remove('fav-overlay--visible');
      setTimeout(function () { overlay.style.display = 'none'; }, 320);
    }
    document.body.style.overflow = '';
  }

  function renderDrawer(favs) {
    var list  = document.getElementById('favDrawerList');
    var empty = document.getElementById('favDrawerEmpty');
    if (!list) return;

    if (!favs || favs.length === 0) {
      list.innerHTML = '';
      if (empty) empty.style.display = 'flex';
      return;
    }
    if (empty) empty.style.display = 'none';

    var fallbackImg = (window.ncTheme && window.ncTheme.fallbackImg) || '';
    list.innerHTML = favs.map(function (item) {
      var imgSrc = item.img || fallbackImg;
      var onErr  = fallbackImg ? (' onerror="this.onerror=null;this.src=\'' + fallbackImg + '\'"') : '';
      return [
        '<div class="fav-item" data-id="' + item.id + '">',
          '<a href="' + item.url + '" class="fav-item__img">',
            '<img src="' + imgSrc + '" alt="' + item.title + '" loading="lazy"' + onErr + '>',
          '</a>',
          '<div class="fav-item__info">',
            '<a href="' + item.url + '" class="fav-item__title">' + item.title + '</a>',
            item.price ? '<div class="fav-item__price">' + item.price + '</div>' : '',
          '</div>',
          '<button class="fav-item__remove" data-id="' + item.id + '" aria-label="Убрать из избранного">',
            '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">',
              '<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>',
            '</svg>',
          '</button>',
        '</div>'
      ].join('');
    }).join('');

    list.querySelectorAll('.fav-item__remove').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var id = btn.getAttribute('data-id');
        removeFav(id);
        syncHeartState(id, false);
      });
    });
  }

  /* ---------- Heart state sync ---------- */
  function syncHeartState(id, active) {
    document.querySelectorAll('[data-fav-id="' + id + '"]').forEach(function (el) {
      el.classList.toggle('fav-heart--active', active);
      el.setAttribute('aria-pressed', active ? 'true' : 'false');
    });
    /* single-product label */
    var pdBtn = document.getElementById('pdFavBtn');
    if (pdBtn && String(pdBtn.dataset.id) === String(id)) {
      pdBtn.classList.toggle('fav-heart--active', active);
      var lbl = pdBtn.querySelector('.pd-fav-label');
      if (lbl) lbl.textContent = active ? 'В избранном' : 'В избранное';
    }
  }

  /* ---------- Catalog card hearts ---------- */
  function initCardHearts() {
    document.querySelectorAll('.furn-card').forEach(function (card) {
      var id  = card.getAttribute('data-id');
      var btn = card.querySelector('.furn-card__heart');
      if (!id || !btn) return;

      btn.setAttribute('data-fav-id', id);
      if (isFav(id)) btn.classList.add('fav-heart--active');

      btn.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var item = {
          id:    id,
          title: card.getAttribute('data-title') || '',
          img:   card.getAttribute('data-img')   || '',
          price: card.getAttribute('data-price') || '',
          url:   card.getAttribute('href')       || ''
        };
        var now = toggleFav(item);
        btn.classList.toggle('fav-heart--active', now);
        btn.setAttribute('aria-pressed', now ? 'true' : 'false');
        /* pulse animation */
        btn.classList.remove('fav-heart--pulse');
        void btn.offsetWidth;
        btn.classList.add('fav-heart--pulse');
      });
    });
  }

  /* ---------- Single-product heart ---------- */
  function initSingleHeart() {
    var btn = document.getElementById('pdFavBtn');
    if (!btn) return;
    var id = btn.getAttribute('data-id');
    if (!id) return;

    btn.setAttribute('data-fav-id', id);
    var isActive = isFav(id);
    btn.classList.toggle('fav-heart--active', isActive);
    btn.setAttribute('aria-label', isActive ? 'В избранном' : 'В избранное');

    btn.addEventListener('click', function () {
      var item = {
        id:    id,
        title: btn.getAttribute('data-title') || '',
        img:   btn.getAttribute('data-img')   || '',
        price: btn.getAttribute('data-price') || '',
        url:   window.location.href
      };
      var now = toggleFav(item);
      btn.classList.toggle('fav-heart--active', now);
      btn.setAttribute('aria-label', now ? 'В избранном' : 'В избранное');
      btn.classList.remove('fav-heart--pulse');
      void btn.offsetWidth;
      btn.classList.add('fav-heart--pulse');
    });
  }

  /* ---------- Bootstrap ---------- */
  document.addEventListener('DOMContentLoaded', function () {
    var favs = getFavs();
    updateBadge(favs.length);

    /* Header button */
    var favBtn = document.getElementById('favBtn');
    if (favBtn) favBtn.addEventListener('click', openDrawer);

    /* Close */
    var closeBtn = document.getElementById('favDrawerClose');
    if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
    var overlay = document.getElementById('favOverlay');
    if (overlay) overlay.addEventListener('click', closeDrawer);

    /* Esc */
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') closeDrawer();
    });

    initCardHearts();
    initSingleHeart();
  });
})();
