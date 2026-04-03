(function () {
    var registerPlugin      = wp.plugins.registerPlugin;
    var PluginDocumentSettingPanel = wp.editPost.PluginDocumentSettingPanel;
    var TextControl         = wp.components.TextControl;
    var TextareaControl     = wp.components.TextareaControl;
    var useEntityProp       = wp.coreData.useEntityProp;
    var useSelect           = wp.data.useSelect;
    var el                  = wp.element.createElement;

    // Хелпер: читает/пишет одно поле из meta объекта страницы
    function useMetaField(key) {
        var entityProp = useEntityProp('postType', 'page', 'meta');
        var meta    = entityProp[0];
        var setMeta = entityProp[1];
        var value   = (meta && meta[key] !== undefined) ? meta[key] : '';
        function onChange(newVal) {
            var updated = Object.assign({}, meta);
            updated[key] = newVal;
            setMeta(updated);
        }
        return [value, onChange];
    }

    // Проверка: мы на странице «Главная»
    function useIsFrontPage() {
        var postId = useSelect(function (select) {
            return select('core/editor').getCurrentPostId();
        });
        return postId && parseInt(postId) === parseInt(ncEditorData.frontPageId);
    }

    // ── Панель «Герой — тексты» ──────────────────────────────────
    function NcHeroPanel() {
        if (!useIsFrontPage()) return null;

        var badge     = useMetaField('_nc_hero_badge');
        var title     = useMetaField('_nc_hero_title');
        var titleEm   = useMetaField('_nc_hero_title_em');
        var desc      = useMetaField('_nc_hero_desc');
        var b1title   = useMetaField('_nc_hero_benefit_1_title');
        var b1text    = useMetaField('_nc_hero_benefit_1_text');
        var b2title   = useMetaField('_nc_hero_benefit_2_title');
        var b2text    = useMetaField('_nc_hero_benefit_2_text');
        var b3title   = useMetaField('_nc_hero_benefit_3_title');
        var b3text    = useMetaField('_nc_hero_benefit_3_text');

        return el(PluginDocumentSettingPanel,
            { name: 'nc-hero-panel', title: 'Герой — тексты баннера', icon: 'format-image' },
            el(TextControl, { label: 'Бейдж',                    value: badge[0],   onChange: badge[1]   }),
            el(TextControl, { label: 'H1 — строка 1',            value: title[0],   onChange: title[1]   }),
            el(TextControl, { label: 'H1 — выделенная часть',    value: titleEm[0], onChange: titleEm[1] }),
            el(TextControl, { label: 'Подзаголовок',             value: desc[0],    onChange: desc[1]    }),
            el('hr', { style: { margin: '8px 0', borderColor: '#ddd' } }),
            el('p', { style: { margin: '0 0 4px', fontSize: '11px', color: '#888', textTransform: 'uppercase' } }, 'Преимущества'),
            el(TextControl, { label: 'Преимущество 1 — заголовок', value: b1title[0], onChange: b1title[1] }),
            el(TextControl, { label: 'Преимущество 1 — подпись',   value: b1text[0],  onChange: b1text[1]  }),
            el(TextControl, { label: 'Преимущество 2 — заголовок', value: b2title[0], onChange: b2title[1] }),
            el(TextControl, { label: 'Преимущество 2 — подпись',   value: b2text[0],  onChange: b2text[1]  }),
            el(TextControl, { label: 'Преимущество 3 — заголовок', value: b3title[0], onChange: b3title[1] }),
            el(TextControl, { label: 'Преимущество 3 — подпись',   value: b3text[0],  onChange: b3text[1]  })
        );
    }

    // ── Панель «О производстве» ──────────────────────────────────
    function NcAboutPanel() {
        if (!useIsFrontPage()) return null;

        var aTitle = useMetaField('_nc_about_title');
        var aText1 = useMetaField('_nc_about_text_1');
        var aText2 = useMetaField('_nc_about_text_2');

        return el(PluginDocumentSettingPanel,
            { name: 'nc-about-panel', title: 'О производстве — тексты', icon: 'admin-home' },
            el(TextControl,     { label: 'Заголовок раздела', value: aTitle[0], onChange: aTitle[1] }),
            el(TextareaControl, { label: 'Первый абзац (можно <strong>жирный</strong>)', value: aText1[0], onChange: aText1[1], rows: 4 }),
            el(TextareaControl, { label: 'Второй абзац',      value: aText2[0], onChange: aText2[1], rows: 4 })
        );
    }

    registerPlugin('nc-hero-fields',  { render: NcHeroPanel,  icon: 'edit' });
    registerPlugin('nc-about-fields', { render: NcAboutPanel, icon: 'edit' });
})();
