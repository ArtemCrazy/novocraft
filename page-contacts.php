<?php
/* Template Name: Контакты */

get_header();

$u = esc_url( get_template_directory_uri() );
?>

<!-- ============ PAGE HERO ============ -->
<section class="section" style="padding-bottom: 0; padding-top: 60px;">
    <div class="container">
        <h1 class="section-title" style="text-align: left; margin-bottom: 0;">Контакты</h1>
    </div>
</section>

<!-- ============ CONTACTS INFO ============ -->
<section style="padding: 60px 0;">
    <div class="container">

        <div class="contacts-locations">

            <!-- Офис Москва -->
            <div class="contact-location-card">
                <div class="contact-location-info">
                    <div class="location-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                            <polyline points="9 22 9 12 15 12 15 22"/>
                        </svg>
                        Офис продаж
                    </div>
                    <h2>Москва</h2>

                    <div class="contact__detail">
                        <div class="contact__detail-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                        </div>
                        <div class="contact__detail-body">
                            <div class="contact__detail-label">Адрес</div>
                            <div class="contact__detail-value"><?php echo esc_html( nc_moscow_address() ); ?></div>
                        </div>
                    </div>

                    <div class="contact__detail">
                        <div class="contact__detail-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                            </svg>
                        </div>
                        <div class="contact__detail-body">
                            <div class="contact__detail-label">Телефон для связи</div>
                            <div class="contact__detail-value">
                                <a href="tel:<?php echo esc_attr( nc_phone() ); ?>"><?php echo esc_html( nc_phone_fmt() ); ?></a>
                            </div>
                        </div>
                    </div>

                    <div class="contact__detail">
                        <div class="contact__detail-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                        </div>
                        <div class="contact__detail-body">
                            <div class="contact__detail-label">Режим работы</div>
                            <div class="contact__detail-value">
                                <?php echo esc_html( nc_hours() ); ?>
                                <span class="hint">Посещение офиса по предварительной записи</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-location-map">
                    <iframe src="<?php echo esc_url( nc_moscow_map() ); ?>" width="100%" height="100%" frameborder="0" style="height:100%;min-height:380px;border:0;"></iframe>
                </div>
            </div>

            <!-- Производство -->
            <div class="contact-location-card">
                <div class="contact-location-info">
                    <div class="location-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"/>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                        </svg>
                        Производство
                    </div>
                    <h2>Нижний Новгород</h2>

                    <div class="contact__detail">
                        <div class="contact__detail-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                        </div>
                        <div class="contact__detail-body">
                            <div class="contact__detail-label">Адрес завода</div>
                            <div class="contact__detail-value"><?php echo esc_html( nc_address() ); ?></div>
                        </div>
                    </div>

                    <div class="contact__detail">
                        <div class="contact__detail-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </div>
                        <div class="contact__detail-body">
                            <div class="contact__detail-label">Почта для эскизов и расчетов</div>
                            <div class="contact__detail-value">
                                <a href="mailto:<?php echo esc_attr( nc_email() ); ?>"><?php echo esc_html( nc_email() ); ?></a>
                            </div>
                        </div>
                    </div>

                    <div class="contact__detail">
                        <div class="contact__detail-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"/>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                            </svg>
                        </div>
                        <div class="contact__detail-body">
                            <div class="contact__detail-label">Экскурсия на производство</div>
                            <div class="contact__detail-value">
                                Хотите увидеть процесс своими глазами?
                                <span class="hint">Возможно по предварительному согласованию</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-location-map">
                    <iframe src="<?php echo esc_url( nc_nn_map() ); ?>" width="100%" height="100%" frameborder="0" style="height:100%;min-height:380px;border:0;"></iframe>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- ============ CONTACT FORM ============ -->
<?php get_template_part( 'template-parts/contact-section' ); ?>

<?php get_footer(); ?>
