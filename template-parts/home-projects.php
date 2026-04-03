<?php
/**
 * Template Part: Home — Projects
 * 4 карточки реализованных проектов. Статика — не выводится в Gutenberg.
 * TODO: заменить на WP_Query по CPT novacraft_project, когда будет наполнение.
 */
$u = get_template_directory_uri();
?>
<section class="section" id="projects">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title reveal">Реализованные проекты</h2>
      <a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>" class="section-link reveal">Все проекты &rarr;</a>
    </div>
    <div class="projects__grid">

      <div class="project-card reveal reveal-delay-1">
        <div class="project-card__image">
          <img src="<?php echo esc_url( $u ); ?>/img/bedroom_white_storage.jpg" alt="Спальня в современном стиле" loading="lazy">
        </div>
        <div class="project-card__body">
          <span class="project-card__tag">Спальня</span>
          <h3 class="project-card__title">Встроенная система хранения</h3>
          <p class="project-card__meta">Москва · Шкаф-купе + тумбы · 18 дней</p>
        </div>
      </div>

      <div class="project-card reveal reveal-delay-2">
        <div class="project-card__image">
          <img src="<?php echo esc_url( $u ); ?>/img/living_room_tv_console.jpg" alt="Гостиная с мебелью Novacraft" loading="lazy">
        </div>
        <div class="project-card__body">
          <span class="project-card__tag">Гостиная</span>
          <h3 class="project-card__title">Стенка под телевизор и стеллаж</h3>
          <p class="project-card__meta">Нижний Новгород · Корпусная мебель · 14 дней</p>
        </div>
      </div>

      <div class="project-card reveal reveal-delay-3">
        <div class="project-card__image">
          <img src="<?php echo esc_url( $u ); ?>/img/hallway_compact_hooks.jpg" alt="Прихожая на заказ" loading="lazy">
        </div>
        <div class="project-card__body">
          <span class="project-card__tag">Прихожая</span>
          <h3 class="project-card__title">Компактная система для прихожей</h3>
          <p class="project-card__meta">Московская область · Шкаф + обувница · 12 дней</p>
        </div>
      </div>

      <div class="project-card reveal reveal-delay-4">
        <div class="project-card__image">
          <img src="<?php echo esc_url( $u ); ?>/img/kitchen_green_classic.jpg" alt="Кухня на заказ" loading="lazy">
        </div>
        <div class="project-card__body">
          <span class="project-card__tag">Кухня</span>
          <h3 class="project-card__title">Кухонный гарнитур с островом</h3>
          <p class="project-card__meta">Москва · Кухня + остров · 21 день</p>
        </div>
      </div>

    </div>
  </div>
</section>
