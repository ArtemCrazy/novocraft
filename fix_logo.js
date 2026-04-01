const fs = require('fs');
const filepath = 'c:/Users/user/Documents/Projects/Novacraft/novacraft-theme/header.php';
let text = fs.readFileSync(filepath, 'utf8');

text = text.replace('<?php echo site_url(\'../img/\'); ?>"Logo.png"', '<?php echo get_template_directory_uri(); ?>/img/Logo.png"');

fs.writeFileSync(filepath, text, 'utf8');
console.log("header.php logo fixed!");
