<?php
/**
 * Template Part: Home — Category Icons Row
 * Статическая навигация по категориям с SVG-иконками.
 * Никогда не меняется — в Gutenberg не выводится.
 */
?>
<section class="cat-icons" id="categories">
  <div class="container">
    <div class="cat-icons__row">

      <a href="<?php echo esc_url( home_url( '/catalog/?category=kitchen' ) ); ?>" class="cat-icon-item">
        <div class="cat-icon-item__icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
            <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
            <rect x="16" y="18" width="32" height="24" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/>
            <rect x="18" y="20" width="13" height="8" rx="2" fill="#37B7AB" opacity="0.16"/>
            <rect x="33" y="20" width="13" height="8" rx="2" fill="#37B7AB" opacity="0.16"/>
            <rect x="18" y="30" width="13" height="10" rx="2" fill="white" stroke="#6F706E" stroke-width="2"/>
            <rect x="33" y="30" width="13" height="10" rx="2" fill="white" stroke="#6F706E" stroke-width="2"/>
            <circle cx="29" cy="35" r="1.2" fill="#6F706E"/><circle cx="35" cy="35" r="1.2" fill="#6F706E"/>
            <rect x="22" y="44" width="20" height="2.5" rx="1.25" fill="#6F706E" opacity="0.65"/>
          </svg>
        </div>
        <span>Кухни</span>
      </a>

      <a href="<?php echo esc_url( home_url( '/catalog/?category=wardrobe' ) ); ?>" class="cat-icon-item">
        <div class="cat-icon-item__icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
            <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
            <rect x="18" y="16" width="28" height="30" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/>
            <path d="M32 16V46" stroke="#6F706E" stroke-width="2"/>
            <circle cx="29" cy="31" r="1.2" fill="#6F706E"/><circle cx="35" cy="31" r="1.2" fill="#6F706E"/>
            <rect x="22" y="20" width="8" height="4" rx="2" fill="#37B7AB" opacity="0.18"/>
            <rect x="34" y="20" width="8" height="4" rx="2" fill="#37B7AB" opacity="0.18"/>
          </svg>
        </div>
        <span>Шкафы</span>
      </a>

      <a href="<?php echo esc_url( home_url( '/catalog/?category=wardrobe' ) ); ?>" class="cat-icon-item">
        <div class="cat-icon-item__icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
            <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
            <path d="M18 44V22a4 4 0 0 1 4-4h20a4 4 0 0 1 4 4v22" stroke="#6F706E" stroke-width="2" fill="white"/>
            <path d="M24 22V44M40 22V44" stroke="#6F706E" stroke-width="2"/>
            <rect x="26.5" y="27" width="11" height="13" rx="2" fill="#37B7AB" opacity="0.18"/>
            <path d="M28 24h8" stroke="#6F706E" stroke-width="2" stroke-linecap="round"/>
            <path d="M22 46h20" stroke="#6F706E" stroke-width="2.5" stroke-linecap="round"/>
          </svg>
        </div>
        <span>Гардеробные</span>
      </a>

      <a href="<?php echo esc_url( home_url( '/catalog/?category=bedroom' ) ); ?>" class="cat-icon-item">
        <div class="cat-icon-item__icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
            <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
            <rect x="18" y="28" width="28" height="12" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/>
            <rect x="20" y="24" width="10" height="7" rx="2" fill="#37B7AB" opacity="0.18"/>
            <rect x="16" y="22" width="4" height="22" rx="2" fill="#6F706E"/>
            <rect x="44" y="26" width="4" height="18" rx="2" fill="#6F706E"/>
            <rect x="20" y="40" width="3" height="6" rx="1.5" fill="#6F706E"/>
            <rect x="41" y="40" width="3" height="6" rx="1.5" fill="#6F706E"/>
          </svg>
        </div>
        <span>Кровати</span>
      </a>

      <a href="<?php echo esc_url( home_url( '/catalog/?category=dresser' ) ); ?>" class="cat-icon-item">
        <div class="cat-icon-item__icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
            <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
            <rect x="19" y="18" width="26" height="26" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/>
            <path d="M19 27H45M19 35H45" stroke="#6F706E" stroke-width="2"/>
            <rect x="23" y="21" width="18" height="3" rx="1.5" fill="#37B7AB" opacity="0.18"/>
            <circle cx="32" cy="31" r="1.2" fill="#6F706E"/><circle cx="32" cy="39" r="1.2" fill="#6F706E"/>
            <rect x="23" y="44" width="18" height="2.5" rx="1.25" fill="#6F706E" opacity="0.65"/>
          </svg>
        </div>
        <span>Комоды</span>
      </a>

      <a href="<?php echo esc_url( home_url( '/catalog/?category=storage' ) ); ?>" class="cat-icon-item">
        <div class="cat-icon-item__icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
            <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
            <rect x="18" y="18" width="28" height="24" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/>
            <path d="M18 30H46M24 24h16M24 36h16" stroke="#6F706E" stroke-width="2" stroke-linecap="round"/>
            <path d="M22 47c4-4 16-4 20 0" stroke="#37B7AB" stroke-width="3" stroke-linecap="round" opacity="0.8"/>
          </svg>
        </div>
        <span>Обувницы</span>
      </a>

      <a href="<?php echo esc_url( home_url( '/catalog/?category=dresser' ) ); ?>" class="cat-icon-item">
        <div class="cat-icon-item__icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
            <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
            <rect x="20" y="22" width="24" height="18" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/>
            <path d="M20 31H44" stroke="#6F706E" stroke-width="2"/>
            <circle cx="32" cy="27" r="1.2" fill="#6F706E"/><circle cx="32" cy="35" r="1.2" fill="#6F706E"/>
            <rect x="24" y="40" width="3" height="7" rx="1.5" fill="#6F706E"/>
            <rect x="37" y="40" width="3" height="7" rx="1.5" fill="#6F706E"/>
            <rect x="24" y="18" width="16" height="3" rx="1.5" fill="#37B7AB" opacity="0.18"/>
          </svg>
        </div>
        <span>Тумбы</span>
      </a>

      <a href="<?php echo esc_url( home_url( '/catalog/?category=storage' ) ); ?>" class="cat-icon-item">
        <div class="cat-icon-item__icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
            <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
            <rect x="18" y="18" width="28" height="28" rx="4" fill="white" stroke="#6F706E" stroke-width="2"/>
            <path d="M32 18V46M18 32H46" stroke="#6F706E" stroke-width="2"/>
            <rect x="22" y="22" width="8" height="8" rx="2" fill="#37B7AB" opacity="0.18"/>
            <rect x="34" y="34" width="8" height="8" rx="2" fill="#37B7AB" opacity="0.18"/>
          </svg>
        </div>
        <span>Стеллажи</span>
      </a>

      <a href="<?php echo esc_url( home_url( '/catalog/?category=storage' ) ); ?>" class="cat-icon-item">
        <div class="cat-icon-item__icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
            <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
            <rect x="18" y="22" width="28" height="7" rx="3.5" fill="white" stroke="#6F706E" stroke-width="2"/>
            <path d="M24 29V44M40 29V44" stroke="#6F706E" stroke-width="2.5" stroke-linecap="round"/>
            <path d="M20 44H28M36 44H44" stroke="#6F706E" stroke-width="2.5" stroke-linecap="round"/>
            <rect x="24" y="18" width="16" height="3" rx="1.5" fill="#37B7AB" opacity="0.18"/>
          </svg>
        </div>
        <span>Столы</span>
      </a>

    </div>
  </div>
</section>
