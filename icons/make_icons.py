from pathlib import Path

out = Path('/mnt/data/novacraft_icons_flat')

stroke = '#6F706E'
accent = '#37B7AB'

svg_tpl = '''<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64" fill="none">
  <rect x="8" y="8" width="48" height="48" rx="12" fill="#F6F4F1"/>
  {content}
</svg>'''

icons = {}

icons['kitchens'] = f'''
<rect x="16" y="18" width="32" height="24" rx="4" fill="white" stroke="{stroke}" stroke-width="2"/>
<rect x="18" y="20" width="13" height="8" rx="2" fill="{accent}" opacity="0.16"/>
<rect x="33" y="20" width="13" height="8" rx="2" fill="{accent}" opacity="0.16"/>
<rect x="18" y="30" width="13" height="10" rx="2" fill="white" stroke="{stroke}" stroke-width="2"/>
<rect x="33" y="30" width="13" height="10" rx="2" fill="white" stroke="{stroke}" stroke-width="2"/>
<circle cx="29" cy="35" r="1.2" fill="{stroke}"/>
<circle cx="35" cy="35" r="1.2" fill="{stroke}"/>
<rect x="22" y="44" width="20" height="2.5" rx="1.25" fill="{stroke}" opacity="0.65"/>
'''

icons['wardrobes'] = f'''
<rect x="18" y="16" width="28" height="30" rx="4" fill="white" stroke="{stroke}" stroke-width="2"/>
<path d="M32 16V46" stroke="{stroke}" stroke-width="2"/>
<circle cx="29" cy="31" r="1.2" fill="{stroke}"/>
<circle cx="35" cy="31" r="1.2" fill="{stroke}"/>
<rect x="22" y="20" width="8" height="4" rx="2" fill="{accent}" opacity="0.18"/>
<rect x="34" y="20" width="8" height="4" rx="2" fill="{accent}" opacity="0.18"/>
'''

icons['dressing_rooms'] = f'''
<path d="M18 44V22a4 4 0 0 1 4-4h20a4 4 0 0 1 4 4v22" stroke="{stroke}" stroke-width="2" fill="white"/>
<path d="M24 22V44" stroke="{stroke}" stroke-width="2"/>
<path d="M40 22V44" stroke="{stroke}" stroke-width="2"/>
<rect x="26.5" y="27" width="11" height="13" rx="2" fill="{accent}" opacity="0.18"/>
<path d="M28 24h8" stroke="{stroke}" stroke-width="2" stroke-linecap="round"/>
<path d="M22 46h20" stroke="{stroke}" stroke-width="2.5" stroke-linecap="round"/>
'''

icons['beds'] = f'''
<rect x="18" y="28" width="28" height="12" rx="4" fill="white" stroke="{stroke}" stroke-width="2"/>
<rect x="20" y="24" width="10" height="7" rx="2" fill="{accent}" opacity="0.18"/>
<rect x="16" y="22" width="4" height="22" rx="2" fill="{stroke}"/>
<rect x="44" y="26" width="4" height="18" rx="2" fill="{stroke}"/>
<rect x="20" y="40" width="3" height="6" rx="1.5" fill="{stroke}"/>
<rect x="41" y="40" width="3" height="6" rx="1.5" fill="{stroke}"/>
'''

icons['dressers'] = f'''
<rect x="19" y="18" width="26" height="26" rx="4" fill="white" stroke="{stroke}" stroke-width="2"/>
<path d="M19 27H45" stroke="{stroke}" stroke-width="2"/>
<path d="M19 35H45" stroke="{stroke}" stroke-width="2"/>
<rect x="23" y="21" width="18" height="3" rx="1.5" fill="{accent}" opacity="0.18"/>
<circle cx="32" cy="31" r="1.2" fill="{stroke}"/>
<circle cx="32" cy="39" r="1.2" fill="{stroke}"/>
<rect x="23" y="44" width="18" height="2.5" rx="1.25" fill="{stroke}" opacity="0.65"/>
'''

icons['shoe_cabinets'] = f'''
<rect x="18" y="18" width="28" height="24" rx="4" fill="white" stroke="{stroke}" stroke-width="2"/>
<path d="M18 30H46" stroke="{stroke}" stroke-width="2"/>
<path d="M24 24h16" stroke="{stroke}" stroke-width="2" stroke-linecap="round"/>
<path d="M24 36h16" stroke="{stroke}" stroke-width="2" stroke-linecap="round"/>
<path d="M22 47c4-4 16-4 20 0" stroke="{accent}" stroke-width="3" stroke-linecap="round" opacity="0.8"/>
'''

icons['nightstands'] = f'''
<rect x="20" y="22" width="24" height="18" rx="4" fill="white" stroke="{stroke}" stroke-width="2"/>
<path d="M20 31H44" stroke="{stroke}" stroke-width="2"/>
<circle cx="32" cy="27" r="1.2" fill="{stroke}"/>
<circle cx="32" cy="35" r="1.2" fill="{stroke}"/>
<rect x="24" y="40" width="3" height="7" rx="1.5" fill="{stroke}"/>
<rect x="37" y="40" width="3" height="7" rx="1.5" fill="{stroke}"/>
<rect x="24" y="18" width="16" height="3" rx="1.5" fill="{accent}" opacity="0.18"/>
'''

icons['shelving'] = f'''
<rect x="18" y="18" width="28" height="28" rx="4" fill="white" stroke="{stroke}" stroke-width="2"/>
<path d="M32 18V46" stroke="{stroke}" stroke-width="2"/>
<path d="M18 32H46" stroke="{stroke}" stroke-width="2"/>
<rect x="22" y="22" width="8" height="8" rx="2" fill="{accent}" opacity="0.18"/>
<rect x="34" y="34" width="8" height="8" rx="2" fill="{accent}" opacity="0.18"/>
'''

icons['tables'] = f'''
<rect x="18" y="22" width="28" height="7" rx="3.5" fill="white" stroke="{stroke}" stroke-width="2"/>
<path d="M24 29V44" stroke="{stroke}" stroke-width="2.5" stroke-linecap="round"/>
<path d="M40 29V44" stroke="{stroke}" stroke-width="2.5" stroke-linecap="round"/>
<path d="M20 44H28" stroke="{stroke}" stroke-width="2.5" stroke-linecap="round"/>
<path d="M36 44H44" stroke="{stroke}" stroke-width="2.5" stroke-linecap="round"/>
<rect x="24" y="18" width="16" height="3" rx="1.5" fill="{accent}" opacity="0.18"/>
'''

labels = {
    'kitchens':'Кухни',
    'wardrobes':'Шкафы',
    'dressing_rooms':'Гардеробные',
    'beds':'Кровати',
    'dressers':'Комоды',
    'shoe_cabinets':'Обувницы',
    'nightstands':'Тумбы',
    'shelving':'Стеллажи',
    'tables':'Столы',
}

for name, content in icons.items():
    (out / f'{name}.svg').write_text(svg_tpl.format(content=content), encoding='utf-8')

cards = []
for name, label in labels.items():
    svg = (out / f'{name}.svg').read_text(encoding='utf-8')
    cards.append(f'<div class="card"><div class="icon">{svg}</div><div class="label">{label}</div><div class="file">{name}.svg</div></div>')

html = f'''<!doctype html>
<html lang="ru">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Novacraft Flat Icons</title>
<style>
body{{font-family: Inter, Arial, sans-serif; margin:0; background:#f2f1ef; color:#2d3648;}}
.wrap{{max-width:1180px; margin:0 auto; padding:40px 28px 56px;}}
h1{{font-size:44px; margin:0 0 10px;}}
p{{font-size:18px; color:#6d6a67; margin:0 0 28px;}}
.grid{{display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:18px;}}
.card{{background:white; border:1px solid #e8e3dc; border-radius:20px; padding:18px; box-shadow:0 6px 22px rgba(34,34,34,.04);}}
.icon{{display:flex; align-items:center; justify-content:center; height:96px; background:#fbfaf8; border-radius:16px;}}
.label{{margin-top:12px; font-weight:700; font-size:18px;}}
.file{{margin-top:6px; color:#8a8681; font-size:13px;}}
.note{{margin-top:28px; padding:16px 18px; background:#fff; border-radius:16px; border:1px solid #e8e3dc; color:#5e5a55;}}
</style>
</head>
<body>
<div class="wrap">
<h1>Novacraft Flat Icons</h1>
<p>Flat-версия набора: мягкие формы, плоская подача, чистая геометрия, удобна для каталога и категорий.</p>
<div class="grid">{''.join(cards)}</div>
<div class="note">SVG уже готовы к применению на сайте. Если нужно, следующим проходом можно сделать ещё более фирменную версию: тоньше, премиальнее или с более смелым акцентом.</div>
</div>
</body>
</html>'''
(out / 'preview.html').write_text(html, encoding='utf-8')
