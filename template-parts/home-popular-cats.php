<?php
/**
 * Template Part: Home — Popular Categories
 * 5 карточек категорий с фото и ценами. Статика — не выводится в Gutenberg.
 */
$u = get_template_directory_uri();
?>
<section class="section" id="catalog">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title reveal">Популярные категории</h2>
      <a href="<?php echo esc_url( home_url( '/catalog/' ) ); ?>" class="section-link reveal">Все категории &rarr;</a>
    </div>
    <div class="pop-categories__grid reveal">

      <a href="<?php echo esc_url( home_url( '/catalog/?category=kitchen' ) ); ?>" class="pop-cat-card pop-cat-card--large">
        <div class="pop-cat-card__img">
          <img src="<?php echo esc_url( $u ); ?>/img/kitchen_linear_herringbone.jpg" alt="Кухни на заказ" loading="lazy">
        </div>
        <div class="pop-cat-card__overlay"></div>
        <div class="pop-cat-card__content">
          <div class="pop-cat-card__name">Кухни</div>
          <div class="pop-cat-card__price">от 85 000 ₽</div>
        </div>
      </a>

      <a href="<?php echo esc_url( home_url( '/catalog/?category=wardrobe' ) ); ?>" class="pop-cat-card">
        <div class="pop-cat-card__img">
          <img src="<?php echo esc_url( $u ); ?>/img/wardrobe_sliding_wood.jpg" alt="Шкафы и гардеробные" loading="lazy">
        </div>
        <div class="pop-cat-card__overlay"></div>
        <div class="pop-cat-card__content">
          <div class="pop-cat-card__name">Шкафы</div>
          <div class="pop-cat-card__price">от 45 000 ₽</div>
        </div>
      </a>

      <a href="<?php echo esc_url( home_url( '/catalog/?category=storage' ) ); ?>" class="pop-cat-card">
        <div class="pop-cat-card__img">
          <img src="<?php echo esc_url( $u ); ?>/img/hallway_built_in_wardrobe.jpg" alt="Системы хранения" loading="lazy">
        </div>
        <div class="pop-cat-card__overlay"></div>
        <div class="pop-cat-card__content">
          <div class="pop-cat-card__name">Системы хранения</div>
          <div class="pop-cat-card__price">от 35 000 ₽</div>
        </div>
      </a>

      <a href="<?php echo esc_url( home_url( '/catalog/?category=bedroom' ) ); ?>" class="pop-cat-card">
        <div class="pop-cat-card__img">
          <img src="<?php echo esc_url( $u ); ?>/img/bedroom_modern_dark.jpg" alt="Спальни" loading="lazy">
        </div>
        <div class="pop-cat-card__overlay"></div>
        <div class="pop-cat-card__content">
          <div class="pop-cat-card__name">Спальни</div>
          <div class="pop-cat-card__price">от 55 000 ₽</div>
        </div>
      </a>

      <a href="<?php echo esc_url( home_url( '/catalog/?category=living' ) ); ?>" class="pop-cat-card">
        <div class="pop-cat-card__img">
          <img src="<?php echo esc_url( $u ); ?>/img/living_room_wide_cabinet.jpg" alt="Гостиные" loading="lazy">
        </div>
        <div class="pop-cat-card__overlay"></div>
        <div class="pop-cat-card__content">
          <div class="pop-cat-card__name">Гостиные</div>
          <div class="pop-cat-card__price">от 40 000 ₽</div>
        </div>
      </a>

    </div>
  </div>
</section>
