const fs = require('fs');
const filepath = 'c:/Users/user/Documents/Projects/Novacraft/novacraft-theme/header.php';
let text = fs.readFileSync(filepath, 'utf8');

text = text.replace(/get_field\('address_msk', 'option'\)/g, "$c['address']");
text = text.replace(/get_field\('work_hours', 'option'\)/g, "$c['work_hours']");
text = text.replace(/get_field\('val_email', 'option'\)/g, "$c['email']");

// Make sure $c is defined at the very beginning of topbar
text = text.replace('<div class="topbar">', '<?php $c = novacraft_contacts(); ?>\n  <div class="topbar">');

fs.writeFileSync(filepath, text, 'utf8');
console.log("header.php updated!");
