import sys
import os

filepath = r"c:\Users\user\Documents\Projects\Novacraft\novacraft-theme\header.php"
with open(filepath, 'r', encoding='utf-8') as f:
    text = f.read()

text = text.replace("<?php echo esc_html(get_field('address_msk', 'option') ?: 'г. Москва, МО, Нижний Новгород'); ?>", "<?php $c = novacraft_contacts(); echo esc_html($c['address'] ?: 'г. Москва, МО, Нижний Новгород'); ?>")
text = text.replace("<?php echo esc_html(get_field('work_hours', 'option') ?: 'Ежедневно 9:00–21:00'); ?>", "<?php echo esc_html($c['work_hours'] ?: 'Ежедневно 9:00–21:00'); ?>")
text = text.replace("<?php $email = get_field('val_email', 'option') ?: '9160128777@mail.ru'; ?>", "<?php $email = $c['email'] ?: '9160128777@mail.ru'; ?>")

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(text)

print("header.php updated!")
