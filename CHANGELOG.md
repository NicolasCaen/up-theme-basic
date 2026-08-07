# Changelog

## v0.1.0.0 — 2026-08-07

### Ajouts
- Création du thème full site editing (FSE)
- Architecture `theme.json` avec variables CSS custom centralisées :
  - `custom.color` : couleurs globales (text, background)
  - `custom.spacing` : marges/paddings par bloc (heading, paragraph, list-item, button)
  - `custom.border` : bordures par bloc (button)
  - `custom.typography` : line-height, font-weight, text-align par élément (h1, h2, paragraph, list-item, quote, button)
  - `custom.transition` : transitions par composant
  - `custom.form.input` : styles des inputs (couleur, border, padding, typo, transition, focus, placeholder)
  - `custom.form.textarea` : min-height des textareas
  - `custom.form.submit` : styles du bouton submit (couleur, border, padding, typo, hover)
- Templates personnalisés : `page-narrow`, `page-wide`, `page-index`
- Template parts : header, footer
- Patterns : header, footer, footer-4cols
- SCSS modulaire : `_root.scss`, `_forms.scss`
- Polices variables avec typographie fluide (clamp)
- Presets de spacing fluide (clamp)
- Presets de border-radius
- Palette de couleurs personnalisée
- Styles de formulaires (inputs, textareas, submit) via variables CSS
