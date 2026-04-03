<?php
/**
 * Template Part: Home — About Photo
 * Левая колонка секции «О производстве»: фото + бейдж «с 1996».
 * Статика — никогда не меняется.
 */
$u = get_template_directory_uri();
?>
<div class="about__image reveal">
  <img src="<?php echo esc_url( $u ); ?>/img/living_room_tv_bookshelf.jpg" alt="Производство мебели Novacraft" loading="lazy">
  <div class="about__image-badge">
    <strong>с 1996</strong>
    <span>года<br>на рынке</span>
  </div>
</div>
