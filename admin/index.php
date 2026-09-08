<?php
/**
 * Index du dossier admin/
 *
 * Inclut tous les fichiers d'administration du thème.
 * Ajouter ici tout nouveau fichier admin (ne pas inclure directement
 * dans functions.php).
 *
 * @package up-coder
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// -- includes admin -- start

include_once __DIR__ . '/legal-settings.php';
include_once __DIR__ . '/default-page-creator.php';

// -- includes admin -- end
