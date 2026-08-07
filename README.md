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

Les paramètres centralisés se trouvent dans `settings.custom` du `theme.json` :

| Namespace | Usage |
|---|---|
| `custom.color` | Couleurs globales (text, background) |
| `custom.spacing` | Marges et paddings par bloc (heading, paragraph, list-item, button) |
| `custom.border` | Bordures par bloc (button radius, width, style) |
| `custom.typography` | Line-height, font-weight, text-align par élément |
| `custom.transition` | Transitions par composant |
| `custom.form.input` | Styles inputs (couleur, border, padding, typo, transition) |
| `custom.form.textarea` | Styles textarea (min-height) |
| `custom.form.submit` | Styles bouton submit (couleur, border, padding, typo, hover) |

## Changelog

- 2026-08-07 · v0.1.0.0 · Création du thème. Architecture FSE, theme.json avec variables custom centralisées, templates personnalisés, patterns, SCSS modulaire, styles de formulaires.
