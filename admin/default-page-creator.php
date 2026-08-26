<?php
/**
 * Page d'administration : Création des pages par défaut
 *
 * Lit le fichier default-page.json et permet de créer en masse les pages
 * listées (avec slug, titre, template et page parent optionnels).
 * Permet aussi de générer les fichiers associés : template, modèle et content.
 *
 * @package up-theme-basic
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Récupère la liste des pages par défaut depuis le JSON.
 *
 * @return array Liste des pages (slug, title, template, parent_slug).
 */
function updp_get_default_pages() {
    $json_path = __DIR__ . '/default-page.json';
    if ( ! file_exists( $json_path ) ) {
        return array();
    }

    $json = file_get_contents( $json_path );
    $data = json_decode( $json, true );

    if ( ! is_array( $data ) || ! isset( $data['pages'] ) || ! is_array( $data['pages'] ) ) {
        return array();
    }

    return $data['pages'];
}

/**
 * Renvoie le chemin racine du thème.
 *
 * @return string Chemin absolu du dossier du thème.
 */
function updp_get_theme_dir() {
    return dirname( __DIR__ );
}

/**
 * Vérifie si une page existe déjà pour un slug donné.
 *
 * @param string $slug Slug de la page.
 * @return int|null ID de la page existante, ou null si inexistante.
 */
function updp_find_page_by_slug( $slug ) {
    $query = new WP_Query(
        array(
            'post_type'        => 'page',
            'name'             => $slug,
            'posts_per_page'   => 1,
            'fields'           => 'ids',
            'suppress_filters' => false,
        )
    );

    return ! empty( $query->posts ) ? (int) $query->posts[0] : null;
}

// ---------------------------------------------------------------------------
// Génération des fichiers (template, modèle, content)
// ---------------------------------------------------------------------------

/**
 * Chemin du fichier template pour un slug donné.
 *
 * @param string $slug Slug de la page.
 * @return string Chemin absolu du fichier template.
 */
function updp_get_template_path( $slug ) {
    return updp_get_theme_dir() . '/templates/page-' . $slug . '.html';
}

/**
 * Chemin du fichier modèle pour un slug donné.
 *
 * @param string $slug Slug de la page.
 * @return string Chemin absolu du fichier modèle.
 */
function updp_get_modele_path( $slug ) {
    return updp_get_theme_dir() . '/patterns/modele-' . $slug . '.php';
}

/**
 * Chemin du fichier content pour un slug donné.
 *
 * @param string $slug Slug de la page.
 * @return string Chemin absolu du fichier content.
 */
function updp_get_content_path( $slug ) {
    return updp_get_theme_dir() . '/patterns/content-' . $slug . '.php';
}

/**
 * Génère le contenu du fichier template (templates/page-{slug}.html).
 *
 * @param string $slug Slug de la page.
 * @return string Contenu HTML du template.
 */
function updp_generate_template_content( $slug ) {
    return <<<HTML
<!-- wp:template-part {"slug":"header","tagName":"header","className":"header-fixed"} /-->

<!-- wp:group {"tagName":"main","className":"is-layout-flow wp-block-group-is-layout-flow","layout":{"type":"constrained"}} -->
<main class="wp-block-group is-layout-flow wp-block-group-is-layout-flow">
      <!-- wp:pattern {"slug":"ng1-base/modele-{$slug}"} /-->
</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->
HTML;
}

/**
 * Génère le contenu du fichier modèle (patterns/modele-{slug}.php).
 *
 * @param string $slug  Slug de la page.
 * @param string $title Titre de la page.
 * @return string Contenu PHP du modèle.
 */
function updp_generate_modele_content( $slug, $title ) {
    $slug_escaped = esc_html( $slug );
    $title_escaped = esc_html( $title );

    return <<<PHP
<?php
/**
 * Title: {$title_escaped}
 * Slug: ng1-base/modele-{$slug_escaped}
 * Categories: query
 * Block Types: core/post-content
 * Description: Contenu de base des pages {$title_escaped}
 *
 * @package WordPress
 * @subpackage ng1-base
 * @since ng1-base 1.0
 */

?>
<!-- wp:group {"metadata":{"name":"Wrapper | Padding","patternName":"ng1-base/wrapper-padding-56-72"},"align":"full","className":"section-styles is-style-default wrapper-padding","style":{"spacing":{"padding":{"top":"var:preset|spacing|56-72","bottom":"var:preset|spacing|56-72"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull section-styles is-style-default wrapper-padding" style="padding-top:var(--wp--preset--spacing--56-72);padding-bottom:var(--wp--preset--spacing--56-72)">
	<!-- wp:pattern {"slug":"ng1-base/content-{$slug_escaped}"} /-->
</div>
<!-- /wp:group -->
PHP;
}

/**
 * Génère le contenu du fichier content (patterns/content-{slug}.php).
 *
 * @param string $slug  Slug de la page.
 * @param string $title Titre de la page.
 * @return string Contenu PHP du content (en-tête uniquement).
 */
function updp_generate_content_file( $slug, $title ) {
    $slug_escaped = esc_html( $slug );
    $title_escaped = esc_html( $title );

    return <<<PHP
<?php
/**
 * Title: Content {$title_escaped}
 * Slug: ng1-base/content-{$slug_escaped}
 * Block Types: core/group
 * Inserter: true
 * Synced: false
 */
?>
PHP;
}

/**
 * Crée les trois fichiers (template, modèle, content) pour une page.
 *
 * @param array $page Entrée du JSON (slug, title).
 * @return array Résultat ['template' => bool|string, 'modele' => bool|string, 'content' => bool|string].
 */
function updp_create_files( $page ) {
    $slug  = isset( $page['slug'] ) ? sanitize_title( $page['slug'] ) : '';
    $title = isset( $page['title'] ) ? $page['title'] : $slug;

    $results = array(
        'template' => true,
        'modele'   => true,
        'content'  => true,
    );

    // Template.
    $template_path = updp_get_template_path( $slug );
    if ( file_exists( $template_path ) ) {
        $results['template'] = 'exists';
    } else {
        $written = file_put_contents( $template_path, updp_generate_template_content( $slug ) );
        if ( false === $written ) {
            $results['template'] = false;
        }
    }

    // Modèle.
    $modele_path = updp_get_modele_path( $slug );
    if ( file_exists( $modele_path ) ) {
        $results['modele'] = 'exists';
    } else {
        $written = file_put_contents( $modele_path, updp_generate_modele_content( $slug, $title ) );
        if ( false === $written ) {
            $results['modele'] = false;
        }
    }

    // Content.
    $content_path = updp_get_content_path( $slug );
    if ( file_exists( $content_path ) ) {
        $results['content'] = 'exists';
    } else {
        $written = file_put_contents( $content_path, updp_generate_content_file( $slug, $title ) );
        if ( false === $written ) {
            $results['content'] = false;
        }
    }

    return $results;
}

// ---------------------------------------------------------------------------
// Création des pages WordPress
// ---------------------------------------------------------------------------

/**
 * Crée une page à partir d'une entrée du JSON.
 *
 * @param array $page Entrée du JSON (slug, title, template, parent_slug).
 * @return int|WP_Error ID de la page créée ou existante, ou WP_Error.
 */
function updp_create_page( $page ) {
    $slug        = isset( $page['slug'] ) ? sanitize_title( $page['slug'] ) : '';
    $title       = isset( $page['title'] ) ? $page['title'] : $slug;
    $template    = isset( $page['template'] ) ? $page['template'] : '';
    $parent_slug = isset( $page['parent_slug'] ) ? $page['parent_slug'] : '';

    if ( '' === $slug ) {
        return new WP_Error( 'updp_no_slug', 'Slug manquant.' );
    }

    // Page déjà existante ? On renvoie son ID sans la recréer.
    $existing_id = updp_find_page_by_slug( $slug );
    if ( $existing_id ) {
        return $existing_id;
    }

    // Résolution de la page parent.
    $parent_id = 0;
    if ( '' !== $parent_slug ) {
        $parent_id = updp_find_page_by_slug( $parent_slug );
        if ( ! $parent_id ) {
            // Tente de créer la parente d'abord si elle est dans le JSON.
            $pages = updp_get_default_pages();
            foreach ( $pages as $parent_page ) {
                if ( isset( $parent_page['slug'] ) && $parent_page['slug'] === $parent_slug ) {
                    $created_parent = updp_create_page( $parent_page );
                    if ( ! is_wp_error( $created_parent ) ) {
                        $parent_id = (int) $created_parent;
                    }
                    break;
                }
            }
        }
    }

    $page_id = wp_insert_post(
        array(
            'post_title'   => $title,
            'post_name'    => $slug,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_parent'  => $parent_id ? (int) $parent_id : 0,
            'post_content' => '',
        ),
        true
    );

    if ( is_wp_error( $page_id ) ) {
        return $page_id;
    }

    // Assignation du template (FSE : page-{slug}.html est auto-détecté,
    // mais on stocke aussi la meta _wp_page_template pour les templates
    // personnalisés dont le slug diffère du slug de page).
    if ( '' !== $template ) {
        update_post_meta( $page_id, '_wp_page_template', $template );
    }

    return (int) $page_id;
}

// ---------------------------------------------------------------------------
// Menu et page d'administration
// ---------------------------------------------------------------------------

/**
 * Ajoute le menu d'administration.
 */
function updp_admin_menu() {
    add_menu_page(
        'Pages par défaut',
        'Pages par défaut',
        'manage_options',
        'updp-default-pages',
        'updp_admin_page',
        'dashicons-admin-page',
        61
    );
}
add_action( 'admin_menu', 'updp_admin_menu' );

/**
 * Affiche la page d'administration.
 */
function updp_admin_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $pages    = updp_get_default_pages();
    $messages = array();
    $created  = 0;
    $skipped  = 0;
    $errors   = 0;
    $files_created   = 0;
    $files_skipped   = 0;
    $files_errors    = 0;

    // Traitement du formulaire.
    if ( isset( $_POST['updp_action'] ) && 'create' === $_POST['updp_action']
        && check_admin_referer( 'updp_create_pages' )
    ) {
        $selected_pages  = isset( $_POST['updp_pages'] ) ? (array) $_POST['updp_pages'] : array();
        $selected_pages  = array_map( 'sanitize_title', $selected_pages );
        $selected_files  = isset( $_POST['updp_files'] ) ? (array) $_POST['updp_files'] : array();
        $selected_files  = array_map( 'sanitize_title', $selected_files );

        foreach ( $pages as $page ) {
            if ( ! isset( $page['slug'] ) ) {
                continue;
            }
            $slug  = $page['slug'];
            $title = isset( $page['title'] ) ? $page['title'] : $slug;

            // --- Création de la page WordPress ---
            if ( in_array( $slug, $selected_pages, true ) ) {
                if ( updp_find_page_by_slug( $slug ) ) {
                    $skipped++;
                } else {
                    $result = updp_create_page( $page );
                    if ( is_wp_error( $result ) ) {
                        $errors++;
                        $messages[] = array(
                            'type'    => 'error',
                            'message' => sprintf(
                                'Erreur lors de la création de la page « %s » : %s',
                                esc_html( $title ),
                                esc_html( $result->get_error_message() )
                            ),
                        );
                    } else {
                        $created++;
                        $messages[] = array(
                            'type'    => 'success',
                            'message' => sprintf(
                                'Page « %s » créée (ID %d).',
                                esc_html( $title ),
                                (int) $result
                            ),
                        );
                    }
                }
            }

            // --- Création des fichiers (template + modèle + content) ---
            if ( in_array( $slug, $selected_files, true ) ) {
                $file_results = updp_create_files( $page );
                $all_ok   = true;
                $all_skip = true;

                foreach ( $file_results as $type => $status ) {
                    if ( false === $status ) {
                        $all_ok   = false;
                        $all_skip = false;
                        $files_errors++;
                        $messages[] = array(
                            'type'    => 'error',
                            'message' => sprintf(
                                'Erreur lors de la création du fichier %s pour « %s ».',
                                esc_html( $type ),
                                esc_html( $title )
                            ),
                        );
                    } elseif ( 'exists' === $status ) {
                        // Fichier déjà existant — on ne compte pas en skip global.
                    } else {
                        $all_skip = false;
                        $files_created++;
                    }
                }

                if ( $all_ok && ! $all_skip ) {
                    $messages[] = array(
                        'type'    => 'success',
                        'message' => sprintf(
                            'Fichiers créés pour « %s » : template, modèle, content.',
                            esc_html( $title )
                        ),
                    );
                } elseif ( $all_ok && $all_skip ) {
                    $files_skipped++;
                }
            }
        }

        // Récapitulatifs.
        if ( $created > 0 ) {
            $messages[] = array(
                'type'    => 'success',
                'message' => sprintf( '%d page(s) créée(s).', $created ),
            );
        }
        if ( $skipped > 0 ) {
            $messages[] = array(
                'type'    => 'info',
                'message' => sprintf( '%d page(s) déjà existante(s) ignorée(s).', $skipped ),
            );
        }
        if ( $errors > 0 ) {
            $messages[] = array(
                'type'    => 'error',
                'message' => sprintf( '%d erreur(s) lors de la création des pages.', $errors ),
            );
        }
        if ( $files_created > 0 ) {
            $messages[] = array(
                'type'    => 'success',
                'message' => sprintf( '%d fichier(s) créé(s).', $files_created ),
            );
        }
        if ( $files_skipped > 0 ) {
            $messages[] = array(
                'type'    => 'info',
                'message' => sprintf( '%d page(s) avec tous les fichiers déjà existants.', $files_skipped ),
            );
        }
        if ( $files_errors > 0 ) {
            $messages[] = array(
                'type'    => 'error',
                'message' => sprintf( '%d erreur(s) lors de la création des fichiers.', $files_errors ),
            );
        }
    }

    // Construction de l'affichage.
    ?>
    <div class="wrap">
        <h1>Pages par défaut</h1>
        <p>
            Cochez les pages à créer et/ou les fichiers à générer, puis cliquez sur le bouton.
            Les pages et fichiers déjà existants sont ignorés.
        </p>

        <?php foreach ( $messages as $msg ) : ?>
            <div class="notice notice-<?php echo esc_attr( $msg['type'] ); ?> is-dismissible">
                <p><?php echo $msg['message']; // déjà échappé lors de la construction ?></p>
            </div>
        <?php endforeach; ?>

        <?php if ( empty( $pages ) ) : ?>
            <div class="notice notice-warning">
                <p>Aucune page définie dans <code>admin/default-page.json</code>.</p>
            </div>
        <?php else : ?>
            <form method="post" action="">
                <?php wp_nonce_field( 'updp_create_pages' ); ?>
                <input type="hidden" name="updp_action" value="create" />

                <table class="wp-list-table widefat fixed striped" role="presentation">
                    <thead>
                        <tr>
                            <th scope="col" class="manage-column check-column" style="width:4%;">
                                <input type="checkbox" id="updp_select_all_pages" title="Tout sélectionner (pages WP)" />
                            </th>
                            <th scope="col" class="manage-column check-column" style="width:4%;">
                                <input type="checkbox" id="updp_select_all_files" title="Tout sélectionner (fichiers)" />
                            </th>
                            <th scope="col" class="manage-column" style="width:18%;">Titre</th>
                            <th scope="col" class="manage-column" style="width:13%;">Slug</th>
                            <th scope="col" class="manage-column" style="width:12%;">Template</th>
                            <th scope="col" class="manage-column" style="width:12%;">Page parent</th>
                            <th scope="col" class="manage-column" style="width:9%;">Page WP</th>
                            <th scope="col" class="manage-column" style="width:9%;">Tpl</th>
                            <th scope="col" class="manage-column" style="width:9%;">Modèle</th>
                            <th scope="col" class="manage-column" style="width:10%;">Content</th>
                        </tr>
                        <tr>
                            <th scope="col" class="manage-column" style="text-align:center; font-weight:normal; font-size:11px;">
                                Créer la page
                            </th>
                            <th scope="col" class="manage-column" style="text-align:center; font-weight:normal; font-size:11px;">
                                Créer fichiers du thème
                            </th>
                            <th scope="col" colspan="8"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ( $pages as $page ) :
                            $slug        = isset( $page['slug'] ) ? $page['slug'] : '';
                            $title       = isset( $page['title'] ) ? $page['title'] : $slug;
                            $template    = isset( $page['template'] ) ? $page['template'] : '—';
                            $parent_slug = isset( $page['parent_slug'] ) ? $page['parent_slug'] : '';
                            $page_exists = $slug ? updp_find_page_by_slug( $slug ) : null;

                            $tpl_path    = updp_get_template_path( $slug );
                            $mod_path    = updp_get_modele_path( $slug );
                            $cnt_path    = updp_get_content_path( $slug );
                            $tpl_exists  = file_exists( $tpl_path );
                            $mod_exists  = file_exists( $mod_path );
                            $cnt_exists  = file_exists( $cnt_path );
                        ?>
                            <tr>
                                <th scope="row" class="check-column">
                                    <input
                                        type="checkbox"
                                        name="updp_pages[]"
                                        value="<?php echo esc_attr( $slug ); ?>"
                                        class="updp-page-checkbox"
                                        <?php echo $page_exists ? 'disabled' : ''; ?>
                                    />
                                </th>
                                <th scope="row" class="check-column">
                                    <input
                                        type="checkbox"
                                        name="updp_files[]"
                                        value="<?php echo esc_attr( $slug ); ?>"
                                        class="updp-file-checkbox"
                                        <?php echo ( $tpl_exists && $mod_exists && $cnt_exists ) ? 'disabled' : ''; ?>
                                    />
                                </th>
                                <td><strong><?php echo esc_html( $title ); ?></strong></td>
                                <td><code><?php echo esc_html( $slug ); ?></code></td>
                                <td><code><?php echo esc_html( $template ); ?></code></td>
                                <td><?php echo $parent_slug ? '<code>' . esc_html( $parent_slug ) . '</code>' : '—'; ?></td>
                                <td>
                                    <?php if ( $page_exists ) : ?>
                                        <span class="dashicons dashicons-yes-alt" title="Existante (ID <?php echo (int) $page_exists; ?>)"></span>
                                        <a href="<?php echo esc_url( get_edit_post_link( $page_exists ) ); ?>">Éditer</a>
                                    <?php else : ?>
                                        <span class="dashicons dashicons-plus-alt" title="À créer"></span>
                                        À créer
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ( $tpl_exists ) : ?>
                                        <span class="dashicons dashicons-yes-alt" title="Existant"></span>
                                    <?php else : ?>
                                        <span class="dashicons dashicons-plus-alt" title="À créer"></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ( $mod_exists ) : ?>
                                        <span class="dashicons dashicons-yes-alt" title="Existant"></span>
                                    <?php else : ?>
                                        <span class="dashicons dashicons-plus-alt" title="À créer"></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ( $cnt_exists ) : ?>
                                        <span class="dashicons dashicons-yes-alt" title="Existant"></span>
                                    <?php else : ?>
                                        <span class="dashicons dashicons-plus-alt" title="À créer"></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <p>
                    <?php submit_button( 'Créer la sélection', 'primary', 'updp_submit', false ); ?>
                </p>
            </form>

            <script>
            (function() {
                var selectAllPages = document.getElementById('updp_select_all_pages');
                var selectAllFiles = document.getElementById('updp_select_all_files');

                if (selectAllPages) {
                    selectAllPages.addEventListener('change', function() {
                        var checked = this.checked;
                        document.querySelectorAll('.updp-page-checkbox').forEach(function(cb) {
                            if (!cb.disabled) {
                                cb.checked = checked;
                            }
                        });
                    });
                }

                if (selectAllFiles) {
                    selectAllFiles.addEventListener('change', function() {
                        var checked = this.checked;
                        document.querySelectorAll('.updp-file-checkbox').forEach(function(cb) {
                            if (!cb.disabled) {
                                cb.checked = checked;
                            }
                        });
                    });
                }
            })();
            </script>
        <?php endif; ?>
    </div>
    <?php
}
