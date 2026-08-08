# Up Thème Basic

## Description

Thème WordPress full site editing (FSE) basé sur l'architecture `theme.json`. Conçu comme un thème de départ léger et personnalisable.

### Fonctionnalités

- **Full Site Editing** : support complet de l'éditeur de site WordPress
- **theme.json centralisé** : variables CSS custom pour couleurs, spacing, borders, typography, forms — toutes pilotables depuis `settings.custom`
- **Templates personnalisés** : `page-narrow` (contenu resserré), `page-wide` (contenu large), `page-index` (page d'index)
- **Patterns** : header, footer, footer 4 colonnes, et plus
- **SCSS modulaire** : feuilles de style organisées en partials (`_root.scss`, `_forms.scss`, etc.)
- **Polices variables** : typographie fluide avec `clamp()`
- **Spacing fluide** : presets de spacing avec valeurs responsives (clamp)
- **Styles de formulaires** : inputs, textareas et submit stylés via variables CSS

## Installation

1. Copier le dossier `up-theme-basic` dans `wp-content/themes/`.
2. Activer le thème dans **Apparence → Thèmes** de l'administration WordPress.
3. Compiler les styles SCSS si nécessaire (`assets/scss/style.scss`).

## Structure

```
up-theme-basic/
├── assets/
│   ├── scss/            # Sources SCSS
│   │   ├── style.scss   # Feuille principale
│   │   ├── _root.scss   # Variables root
│   │   └── _forms.scss  # Styles formulaires
│   ├── fonts/           # Polices variables
│   ├── editor.css       # Style éditeur
│   └── ...
├── functions/           # Fonctions PHP modulaires
├── parts/               # Template parts (header, footer)
├── patterns/            # Patterns de blocs
├── styles/
│   └── sections/        # Styles de sections JSON
├── templates/           # Templates FSE
│   ├── index.html
│   ├── page-narrow.html
│   ├── page-wide.html
│   └── page-index.html
├── theme.json           # Configuration centrale
├── functions.php        # Bootstrap du thème
└── style.css            # CSS compilé
```

## Variables custom (theme.json)

Les paramètres centralisés se trouvent dans `settings.custom` du `theme.json`.
La structure suit le pattern **`élément|propriété`** : chaque élément (heading, button, input…) regroupe toutes ses propriétés sous une seule clé, sans niveau de catégorie intermédiaire (plus de `spacing`, `border`, `typography`…).

### Variables existantes

| Clé JSON | Variable CSS | Propriétés |
|---|---|---|
| `custom.font` | `--wp--custom--font--*` | `body`, `title` (font-family) |
| `custom.color` | `--wp--custom--color--*` | `text`, `background` |
| `custom.navigation` | `--wp--custom--navigation--*` | `footer` (nom du menu) |
| `custom.heading` | `--wp--custom--heading--*` | `margin-y` |
| `custom.h1` | `--wp--custom--h1--*` | `line-height` |
| `custom.h2` | `--wp--custom--h2--*` | `line-height` |
| `custom.paragraph` | `--wp--custom--paragraph--*` | `margin-y`, `line-height` |
| `custom.list-item` | `--wp--custom--list-item--*` | `margin-y`, `line-height` |
| `custom.quote` | `--wp--custom--quote--*` | `font-weight`, `line-height`, `text-align`, `font-style` |
| `custom.button` | `--wp--custom--button--*` | `padding-y`, `padding-x`, `radius`, `width`, `style`, `font-weight`, `transition` |
| `custom.input` | `--wp--custom--input--*` | `color-text`, `color-background`, `color-border`, `color-placeholder`, `color-focus-border`, `padding-y`, `padding-x`, `border-radius`, `border-width`, `border-style`, `font-size`, `line-height`, `transition` |
| `custom.textarea` | `--wp--custom--textarea--*` | `min-height` |
| `custom.submit` | `--wp--custom--submit--*` | `color-text`, `color-background`, `color-border`, `color-hover-background`, `padding-y`, `padding-x`, `border-radius`, `border-width`, `border-style`, `font-size`, `font-weight`, `text-transform`, `transition` |

### Référencer une variable

Dans `theme.json`, deux syntaxes selon le contexte :

```json
"margin": "var:custom|button|padding-y"
"color": "var:preset|color|accent"
```

Dans les fichiers SCSS / CSS :

```scss
padding: var(--wp--custom--button--padding-y) var(--wp--custom--button--padding-x);
color: var(--wp--preset--color--accent);
```

### Ajouter une variable custom

1. **Définir** la variable dans `settings.custom` du `theme.json` :

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
> **Références presets** : pour pointer vers un preset (couleur, font-size, font-family…), utiliser `var:preset|catégorie|slug` dans le JSON (ex: `var:preset|color|accent`). Ne pas utiliser `var(--wp--preset--...)` comme valeur JSON, sauf dans une chaîne CSS composite (ex: un shadow).

## Changelog

- 2026-08-07 · v0.1.0.0 · Création du thème. Architecture FSE, theme.json avec variables custom centralisées, templates personnalisés, patterns, SCSS modulaire, styles de formulaires.
