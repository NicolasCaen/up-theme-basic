<?php
/**
 * Page d'administration : Mentions légales & Politique de confidentialité
 *
 * Permet de renseigner les variables utilisées dans les patterns
 * contenu-mentions-legales.php et contenu-politique-confidentialite.php
 * via la fonction upmc_get_legal_value( $key ).
 *
 * @package up-sylphane
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Liste des champs regroupés par section.
 *
 * @return array
 */
function upmc_legal_get_fields() {
    return array(
        'company' => array(
            'title'  => 'Édition du site (entreprise)',
            'fields' => array(
                'company_name'              => 'Nom de l\'entreprise / propriétaire du site',
                'company_email'             => 'Email de contact',
                'company_phone'             => 'Téléphone de contact',
                'company_street'            => 'Adresse (rue)',
                'company_city_zip'          => 'Code postal et ville',
                'company_siret'             => 'SIRET',
            ),
        ),
        'publication' => array(
            'title'  => 'Directeur de la publication',
            'fields' => array(
                'publication_director'       => 'Nom du directeur de la publication',
                'publication_director_phone' => 'Téléphone du directeur de la publication',
            ),
        ),
        'host' => array(
            'title'  => 'Hébergeur',
            'fields' => array(
                'host_name'      => 'Nom de l\'hébergeur',
                'host_address'   => 'Adresse de l\'hébergeur',
                'host_zip_city'  => 'Code postal / ville de l\'hébergeur',
                'host_city'      => 'Ville de l\'hébergeur',
                'host_country'   => 'Pays de l\'hébergeur',
                'host_phone'     => 'Téléphone de l\'hébergeur',
            ),
        ),
        'dpo' => array(
            'title'  => 'Délégué à la protection des données (DPO)',
            'fields' => array(
                'dpo_name'  => 'Nom du DPO',
                'dpo_email' => 'Email du DPO',
            ),
        ),
    );
}

/**
 * Récupère la valeur d'une variable légale.
 *
 * @param string $key Clé du champ.
 * @return string Valeur (chaîne vide si non définie).
 */
function upmc_get_legal_value( $key ) {
    $options = get_option( 'upmc_legal_settings', array() );
    return isset( $options[ $key ] ) ? $options[ $key ] : '';
}

/**
 * Enregistre les settings.
 */
function upmc_legal_register_settings() {
    register_setting(
        'upmc_legal_group',
        'upmc_legal_settings',
        array(
            'type'              => 'array',
            'sanitize_callback' => 'upmc_legal_sanitize',
            'default'           => array(),
        )
    );
}
add_action( 'admin_init', 'upmc_legal_register_settings' );

/**
 * Sanitize les valeurs saisies.
 *
 * @param array $input Valeurs saisies.
 * @return array Valeurs nettoyées.
 */
function upmc_legal_sanitize( $input ) {
    $fields = upmc_legal_get_fields();
    $clean  = array();

    foreach ( $fields as $section ) {
        foreach ( $section['fields'] as $key => $label ) {
            if ( isset( $input[ $key ] ) ) {
                $clean[ $key ] = sanitize_text_field( $input[ $key ] );
            }
        }
    }

    return $clean;
}

/**
 * Ajoute le menu d'administration.
 */
function upmc_legal_admin_menu() {
    add_menu_page(
        'Mentions légales & Confidentialité',
        'Mentions légales',
        'manage_options',
        'upmc-legal-settings',
        'upmc_legal_settings_page',
        'dashicons-privacy',
        60
    );
}
add_action( 'admin_menu', 'upmc_legal_admin_menu' );

/**
 * Affiche la page d'administration.
 */
function upmc_legal_settings_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $sections = upmc_legal_get_fields();
    $options  = get_option( 'upmc_legal_settings', array() );
    ?>
    <div class="wrap">
        <h1>Mentions légales &amp; Politique de confidentialité</h1>
        <p>Renseignez les informations affichées dans les pages mentions légales et politique de confidentialité.</p>
        <form method="post" action="options.php">
            <?php settings_fields( 'upmc_legal_group' ); ?>
            <?php foreach ( $sections as $section_id => $section ) : ?>
                <h2><?php echo esc_html( $section['title'] ); ?></h2>
                <table class="form-table" role="presentation">
                    <?php foreach ( $section['fields'] as $key => $label ) : ?>
                        <tr>
                            <th scope="row">
                                <label for="upmc_legal_<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $label ); ?></label>
                            </th>
                            <td>
                                <input
                                    type="text"
                                    id="upmc_legal_<?php echo esc_attr( $key ); ?>"
                                    name="upmc_legal_settings[<?php echo esc_attr( $key ); ?>]"
                                    value="<?php echo esc_attr( isset( $options[ $key ] ) ? $options[ $key ] : '' ); ?>"
                                    class="regular-text"
                                />
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endforeach; ?>
            <?php submit_button( 'Enregistrer les modifications' ); ?>
        </form>
    </div>
    <?php
}
