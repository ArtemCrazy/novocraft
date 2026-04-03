<?php
/**
 * Template Part: Home — About
 * Фото (статика) + текст из post meta главной страницы.
 * Клиент редактирует через Gutenberg sidebar (WP Admin → Страницы → Главная).
 */
$u   = get_template_directory_uri();
$fid = (int) get_option( 'page_on_front' );
$m   = function ( $key, $default ) use ( $fid ) {
    $v = get_post_meta( $fid, $key, true );
    return ( $v !== '' && $v !== false ) ? $v : $default;
};
?>
<section class="section section--alt" id="about">
  <div class="container">
    <div class="about__grid">

      <div class="about__image reveal">
        <img src="<?php echo esc_url( $u ); ?>/img/living_room_tv_bookshelf.jpg" alt="Производство мебели Novacraft" loading="lazy">
        <div class="about__image-badge">
          <strong>с 1996</strong>
          <span>года<br>на рынке</span>
        </div>
      </div>

      <div class="about__text reveal reveal-delay-1">

        <h2 class="section-title"><?php echo esc_html( $m( '_nc_about_title', 'О нашем производстве' ) ); ?></h2>
        <p><?php echo wp_kses( $m( '_nc_about_text_1', 'Novacraft — семейное дело, которым занимаются уже 3 поколения — с 1996 года. За это время мы реализовали более <strong>5 000 заказов</strong> для <strong>более 1 000 клиентов</strong> по всей России.' ), [ 'strong' => [], 'em' => [], 'br' => [] ] ); ?></p>
        <p><?php echo esc_html( $m( '_nc_about_text_2', 'Каждый проект — индивидуальный. Мы работаем на современном оборудовании и контролируем каждый этап: от замера и дизайна до изготовления и установки. Берёмся за самые сложные задачи.' ) ); ?></p>

        <div class="about__features">
          <div class="about__feature">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            Каркасы: ЛДСП 16/25мм, ЛМДФ
          </div>
          <div class="about__feature">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            Столешницы: постформинг, пластик, МДФ, камень (спецзаказ)
          </div>
          <div class="about__feature">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            Кромка: ПВХ и АБС — надёжное оформление торцов
          </div>
          <div class="about__feature">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            Гарантия на продукцию
          </div>
        </div>

        <div style="display:flex;gap:var(--space-xl);margin-top:var(--space-xl);padding-top:var(--space-lg);border-top:1px solid var(--color-border-light);">
          <div>
            <div style="font-size:1.75rem;font-weight:700;color:var(--color-accent);line-height:1;">5 000+</div>
            <div style="font-size:0.8rem;color:var(--color-text-soft);margin-top:4px;">выполненных заказов</div>
          </div>
          <div style="width:1px;background:var(--color-border);"></div>
          <div>
            <div style="font-size:1.75rem;font-weight:700;color:var(--color-accent);line-height:1;">1 000+</div>
            <div style="font-size:0.8rem;color:var(--color-text-soft);margin-top:4px;">довольных клиентов</div>
          </div>
          <div style="width:1px;background:var(--color-border);"></div>
          <div>
            <div style="font-size:1.75rem;font-weight:700;color:var(--color-accent);line-height:1;">с 1996</div>
            <div style="font-size:0.8rem;color:var(--color-text-soft);margin-top:4px;">3 поколения семьи</div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
