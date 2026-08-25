# Changelog

## v1.0.0.0 — 2026-08-25

### Ajouts
- Système de variables custom **par élément** (règle d'or : toutes les variables sous un élément, sauf `font`) :
  - `custom.body` : couleurs globales (color-text, color-background, color-title, color-link, color-link-hover, color-accent, color-decorative, color-error)
  - `custom.heading` + `custom.h1` à `custom.h5` : font-size et line-height des titres
  - `custom.paragraph` : font-size, line-height, font-weight, font-size-small
  - `custom.quote` : font-size, line-height, font-weight + bordure et padding (border-color, border-width, padding-x/y)
  - `custom.button` : couleurs normal/hover + variante `outline` avec ses couleurs
  - `custom.form`, `custom.label`, `custom.checkbox` : layout des formulaires
  - `custom.list.copyright` : variante liste copyright
- Palette de couleurs sémantique (primary / secondary / neutral / semantic-error)
- Nouvelle échelle typographique fluide (`body-xsmall` → `title-large`)
- 42 dégradés et 42 duotones générés depuis la palette
- Style de section `default` (`styles/sections/style-default.json`)
- Preset d'aspect ratio `2 / 1` et unité `svh`

### Modifications
- Variables custom alignées sur le système d'up-sylphane (mêmes slugs et structure)
- `custom.navigation` : variantes `principal` et `footer` complètes (font-size, font-family, color-text, color-text-hover, column-gap, row-gap)
- `_forms.scss` : noms de variables alignés (`input.color-*`, `submit.color-*`), styles label / checkbox / grille CF7
- Spacing fluide recalculé (clamp en vw) et slugs `56-100`, `56-140` ajoutés
- Sections de style `style1.json` à `style5.json` : références complètes à `custom.style.N`

### Suppressions
- Variables standalone `custom.color`, `custom.font-size`, `custom.line-height`, `custom.font-weight` (déplacées sous les éléments)
- Couleurs brutes inutilisées (`creme-*`, `green-*`, `light-grey`, `black`, `white`)
- `custom.color.button-link` et `button-outline-link` (redondants)
- Ancienne palette `base` / `contrast` / `accent` et anciennes tailles `xxs` → `h-five`

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
