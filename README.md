# Up Thème Basic

## Description

Thème WordPress full site editing (FSE) basé sur l'architecture `theme.json`. Conçu comme un thème de départ léger et personnalisable.

### Fonctionnalités

- **Full Site Editing** : support complet de l'éditeur de site WordPress
- **theme.json centralisé** : variables CSS custom organisées **par élément** (body, button, input…) — toutes pilotables depuis `settings.custom`
- **Palette sémantique** : couleurs `primary` / `secondary` / `neutral` + `semantic-error`
- **Typographie fluide** : échelle `body-xsmall` → `title-large` avec `clamp()`
- **Spacing fluide** : presets fixes et fluides (clamp) + border radius, shadows, gradients, duotones
- **Templates personnalisés** : `page-narrow` (contenu resserré), `page-wide` (contenu large), `page-index` (page d'index)
- **Patterns** : header, footer, footer 4 colonnes, et plus
- **Styles de sections** : variantes de style `1` à `5` + `default` (dossier `styles/sections/`)
- **SCSS modulaire** : feuilles de style organisées en partials (`_root.scss`, `_forms.scss`, etc.)
- **Styles de formulaires** : inputs, labels, checkbox et submit stylés via variables CSS

## Installation

1. Copier le dossier `up-theme-basic` dans `wp-content/themes/`.
2. Activer le thème dans **Apparence → Thèmes** de l'administration WordPress.
3. Compiler les styles SCSS si nécessaire (`sass assets/scss/style.scss style.css`).

## Structure

```
up-theme-basic/
├── assets/
│   ├── scss/            # Sources SCSS
│   │   ├── style.scss   # Feuille principale
│   │   ├── _root.scss   # Point d'entrée des includes
│   │   ├── _forms.scss  # Styles formulaires
│   │   └── blocks/      # Styles par bloc WordPress
│   ├── fonts/           # Polices variables
│   ├── editor.css       # Style éditeur (compilé, ne pas éditer)
│   └── ...
├── functions/           # Fonctions PHP modulaires
├── parts/               # Template parts (header, footer)
├── patterns/            # Patterns de blocs
├── styles/
│   └── sections/        # Styles de sections JSON (style1-5, default)
├── templates/           # Templates FSE
│   ├── index.html
│   ├── page-narrow.html
│   ├── page-wide.html
│   └── page-index.html
├── theme.json           # Configuration centrale
├── functions.php        # Bootstrap du thème
└── style.css            # CSS compilé (ne pas éditer)
```

## Variables custom (theme.json)

Toutes les variables centralisées se trouvent dans `settings.custom` du `theme.json`.

### Règle d'or

> Mis à part `font`, toutes les variables custom sont organisées **par élément**. Aucune variable standalone (`custom.color`, `custom.font-size`, `custom.line-height`, `custom.font-weight`…) n'est tolérée.

Chaque élément regroupe toutes ses propriétés sous une seule clé, au format **`élément|propriété`** :

- `custom.body.color-text` → `--wp--custom--body--color-text`
- `custom.button.color-background-hover` → `--wp--custom--button--color-background-hover`
- `custom.button.outline.color-border` → `--wp--custom--button--outline--color-border`

### Éléments et propriétés

| Clé JSON | Variable CSS | Propriétés |
|---|---|---|
| `custom.font` | `--wp--custom--font--*` | `body`, `title` (font-family) — **seule exception standalone** |
| `custom.body` | `--wp--custom--body--*` | `color-text`, `color-background`, `color-title`, `color-link`, `color-link-hover`, `color-accent`, `color-decorative`, `color-error` |
| `custom.heading` | `--wp--custom--heading--*` | `margin-y`, `font-size` |
| `custom.h1` à `custom.h5` | `--wp--custom--h1--*` etc. | `font-size`, `line-height` |
| `custom.paragraph` | `--wp--custom--paragraph--*` | `margin-y`, `font-size`, `line-height`, `font-weight`, `font-size-small` |
| `custom.list-item` | `--wp--custom--list-item--*` | `margin-y` |
| `custom.list` | `--wp--custom--list--*` | `copyright.*` (variante liste copyright) |
| `custom.quote` | `--wp--custom--quote--*` | `font-size`, `line-height`, `font-weight`, `text-align`, `font-style`, `padding-x`, `padding-y`, `border-color`, `border-style`, `border-width` |
| `custom.button` | `--wp--custom--button--*` | `color-text`, `color-background`, `color-border`, `color-text-hover`, `color-background-hover`, `color-border-hover`, `padding-y`, `padding-x`, `radius`, `width`, `style`, `font-weight`, `text-transform`, `transition`, `outline.*` |
| `custom.input` | `--wp--custom--input--*` | `color-text`, `color-background`, `color-border`, `color-placeholder`, `color-focus-border`, `padding-y`, `padding-x`, `border-radius`, `border-width`, `border-style`, `font-size`, `line-height`, `transition` |
| `custom.label` | `--wp--custom--label--*` | `font-family`, `font-size`, `font-weight`, `line-height` |
| `custom.textarea` | `--wp--custom--textarea--*` | `min-height` |
| `custom.submit` | `--wp--custom--submit--*` | `color-text`, `color-background`, `color-border`, `color-text-hover`, `color-background-hover`, `color-border-hover`, `padding-y`, `padding-x`, `border-radius`, `border-width`, `border-style`, `font-size`, `font-weight`, `text-transform`, `transition` |
| `custom.checkbox` | `--wp--custom--checkbox--*` | `gap`, `align-items` |
| `custom.form` | `--wp--custom--form--*` | `columns`, `column-gap`, `row-gap` |
| `custom.navigation` | `--wp--custom--navigation--*` | `footer-menu-name`, `principal.*`, `footer.*` |
| `custom.media-text` | `--wp--custom--media-text--*` | `padding-x`, `column-gap`, `row-gap` |
| `custom.style` | `--wp--custom--style--*` | Variantes de section (`1` à `5`, `default`) |

### Conventions

- **Couleurs** : préfixe `color-` directement sous l'élément (`button.color-text`, pas `button.color.text`)
- **Références entre éléments** : `var:custom|<élément>|<propriété>` (ex : `submit.color-text` → `"var:custom|button|color-text"` — le submit hérite du bouton)
- **Références presets** : `var:preset|catégorie|slug` (ex : `var:preset|color|primary-default`)
- **Palette sémantique** : `primary-default`, `secondary-dark`, `neutral-dark`, `secondary-default`, `primary-light`, `neutral-light`, `secondary-light`, `primary-dark`, `neutral-subtle`, `semantic-error` (+ `custom1`)

### Référencer une variable

Dans `theme.json`, deux syntaxes selon le contexte :

```json
"margin": "var:custom|button|padding-y"
"color": "var:preset|color|primary-default"
```

Dans les fichiers SCSS / CSS :

```scss
padding: var(--wp--custom--button--padding-y) var(--wp--custom--button--padding-x);
color: var(--wp--preset--color--primary-default);
```

### Ajouter une variable custom

1. **Définir** la variable sous son élément dans `settings.custom` du `theme.json` :

```json
"custom": {
    "card": {
        "radius": "0.5rem",
        "padding-y": "1rem",
        "padding-x": "1.5rem"
    }
}
```

2. **Référencer** dans `theme.json` via la syntaxe `var:custom|` :

```json
"border": {
    "radius": "var:custom|card|radius"
}
```

3. **Utiliser** dans les fichiers SCSS via la variable CSS générée automatiquement :

```scss
.card {
    border-radius: var(--wp--custom--card--radius);
    padding: var(--wp--custom--card--padding-y) var(--wp--custom--card--padding-x);
}
```

> **Règle de nommage** : une clé imbriquée `card.radius` produit la variable `--wp--custom--card--radius`. Les tirets `-` dans les noms de propriétés sont conservés (ex: `padding-y` → `--wp--custom--card--padding-y`).
>
> **Références presets** : pour pointer vers un preset (couleur, font-size, font-family…), utiliser `var:preset|catégorie|slug` dans le JSON (ex: `var:preset|color|primary-default`). Ne pas utiliser `var(--wp--preset--...)` comme valeur JSON, sauf dans une chaîne CSS composite (ex: un shadow).

## Changelog

- 2026-08-25 · v1.0.0.0 · Refonte du système de variables custom **par élément** (règle d'or : tout sous un élément sauf `font`), aligné sur up-sylphane. Nouvelle palette sémantique (primary/secondary/neutral), nouvelle échelle typographique (`body-*` / `title-*`), 42 gradients + 42 duotones, navigation principal/footer, styles de sections 1-5 + default. Voir `CHANGELOG.md`.
- 2026-08-07 · v0.1.0.0 · Création du thème. Architecture FSE, theme.json avec variables custom centralisées, templates personnalisés, patterns, SCSS modulaire, styles de formulaires.
