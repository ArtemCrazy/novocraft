import os

def process_file(filename, title_search, slug_search, fallback_title):
    with open(filename, 'r', encoding='utf-8') as f:
        content = f.read()
    
    # Split after get_header(); ?>
    parts = content.split("get_header(); ?>", 1)
    if len(parts) != 2:
        return
    
    header = parts[0] + "get_header(); ?>\n"
    rest = parts[1]
    
    # Check if already processed
    if "<main id=\"primary" in rest:
        return
        
    new_code = f"""<main id="primary" class="site-main">
<?php
    $archive_page = get_page_by_title('{title_search}');
    if (!$archive_page) $archive_page = get_page_by_path('{slug_search}');
    if (!$archive_page) $archive_page = get_page_by_title('{fallback_title}');

    if ($archive_page && trim($archive_page->post_content) !== '') {{
        echo apply_filters('the_content', $archive_page->post_content);
    }} else {{
?>
"""
    
    # Find where the footer starts
    footer_split = rest.rsplit("<?php", 1)
    if len(footer_split) != 2:
        # try splitting at <?php get_footer
        footer_split = rest.rsplit("<?php get_footer", 1)
        if len(footer_split) == 2:
            body = footer_split[0]
            footer = "<?php get_footer" + footer_split[1]
        else:
            return
    else:
        # Check if it's the wp_products part
        if "get_posts" in footer_split[1] or "get_footer" in footer_split[1]:
            body = footer_split[0]
            footer = "<?php" + footer_split[1]
        else:
            body = rest
            footer = ""
    
    # For furniture, body ends with <!-- ============ FOOTER ============ -->
    if "<!-- ============ FOOTER ============ -->" in body:
        body_parts = body.rsplit("<!-- ============ FOOTER ============ -->", 1)
        body = body_parts[0]
        footer = "<!-- ============ FOOTER ============ -->\n<?php } ?>\n</main>\n" + body_parts[1] + footer
    else:
         body = body + "\n<?php } ?>\n</main>\n"

    with open(filename, 'w', encoding='utf-8') as f:
        f.write(header + new_code + body + footer)

process_file(r'c:\Users\user\Documents\Projects\Novacraft\novacraft-theme\archive-furniture.php', 'Мебель для дома', 'furniture', 'Для дома')
process_file(r'c:\Users\user\Documents\Projects\Novacraft\novacraft-theme\archive-project.php', 'Реализованные проекты', 'project', 'Проекты')
