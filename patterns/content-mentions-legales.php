<?php
/**
 * Title: Contenu Mentions légales
 * Slug: ng1-base/content-mentions-legales
 * Block Types: core/group
 * Inserter: false
 * Synced: false
 */
?>
<!-- wp:group {"metadata":{"name":"Contenu | Mentions légales","patternName":"ng1-base/contenu-mentions-legales"},"align":"full","className":"contenu-mentions-legales","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull contenu-mentions-legales"><!-- wp:post-title {"level":1} /-->
<!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|2","left":"var:preset|spacing|2"}}},"layout":{"type":"constrained","contentSize":"960px"}} -->
<div class="wp-block-group" style="padding-right:var(--wp--preset--spacing--2);padding-left:var(--wp--preset--spacing--2)">
<!-- wp:spacer {"height":"3.5rem"} -->
<div style="height:3.5rem" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:heading -->
<h2 class="wp-block-heading">1 – Édition du site </h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>En vertu de l'<a href="https://www.legifrance.gouv.fr/codes/article_lc/LEGIARTI000032655082" data-type="link" data-id="https://www.legifrance.gouv.fr/codes/article_lc/LEGIARTI000032655082">article 6 de la loi n° 2004-575 du 21 juin 2004</a> pour la confiance dans l'économie numérique, il est précisé aux utilisateurs du site internet <?php echo esc_url( home_url() ); ?> l'identité des différents intervenants dans le cadre de sa réalisation et de son suivi:</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>Propriétaire du site : </strong><?php echo esc_html( upmc_get_legal_value( 'company_name' ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Information de Contact : </h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Email :</strong><?php echo esc_html( upmc_get_legal_value( 'company_email' ) ); ?> <strong>Tél</strong> :<?php echo esc_html( upmc_get_legal_value( 'company_phone' ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>Adresse :</strong> <?php echo esc_html( upmc_get_legal_value( 'company_street' ) ); ?> <?php echo esc_html( upmc_get_legal_value( 'company_city_zip' ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>Identification de l'entreprise :</strong> <?php echo esc_html( upmc_get_legal_value( 'company_name' ) ); ?> au capital social de 1000€ SIRET : <?php echo esc_html( upmc_get_legal_value( 'company_siret' ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>Directeur de la publication : </strong><?php echo esc_html( upmc_get_legal_value( 'publication_director' ) ); ?><strong> Tél : </strong><?php echo esc_html( upmc_get_legal_value( 'publication_director_phone' ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>Hébergeur :</strong> </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php echo esc_html( upmc_get_legal_value( 'host_name' ) ); ?> </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php echo esc_html( upmc_get_legal_value( 'host_address' ) ); ?> </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php echo esc_html( upmc_get_legal_value( 'host_zip_city' ) ); ?> , <?php echo esc_html( upmc_get_legal_value( 'host_city' ) ); ?> <?php echo esc_html( upmc_get_legal_value( 'host_country' ) ); ?> </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>Téléphone :</strong> <?php echo esc_html( upmc_get_legal_value( 'host_phone' ) ); ?> </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>Délégué à la protection des données : </strong><?php echo esc_html( upmc_get_legal_value( 'dpo_name' ) ); ?> – <?php echo esc_html( upmc_get_legal_value( 'dpo_email' ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">2 – Propriété intellectuelle et contrefaçons.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo esc_html( upmc_get_legal_value( 'company_name' ) ); ?> est propriétaire des droits de propriété intellectuelle et détient les droits d'usage sur tous les éléments accessibles sur le site internet, notamment les textes, images, graphismes, logos, vidéos, architecture, icônes et sons.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Toute reproduction, représentation, modification, publication, adaptation de tout ou partie des éléments du site, quel que soit le moyen ou le procédé utilisé, est interdite, sauf autorisation écrite préalable de <?php echo esc_html( upmc_get_legal_value( 'company_name' ) ); ?>.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Toute exploitation non autorisée du site ou de l'un quelconque des éléments qu'il contient sera considérée comme constitutive d'une contrefaçon et poursuivie conformément aux dispositions des articles<a href="https://www.legifrance.gouv.fr/affichCodeArticle.do?idArticle=LEGIARTI000032655082&amp;cidTexte=LEGITEXT000006069414&amp;dateTexte=20160605" data-type="link" data-id="https://www.legifrance.gouv.fr/affichCodeArticle.do?idArticle=LEGIARTI000032655082&amp;cidTexte=LEGITEXT000006069414&amp;dateTexte=20160605"> L.335-2 et suivants du Code de Propriété Intellectuelle</a>.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">3 – Limitations de responsabilité.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo esc_html( upmc_get_legal_value( 'company_name' ) ); ?> ne pourra être tenu pour responsable des dommages directs et indirects causés au matériel de l'utilisateur, lors de l'accès au site <?php echo esc_url( home_url() ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php echo esc_html( upmc_get_legal_value( 'company_name' ) ); ?> décline toute responsabilité quant à l'utilisation qui pourrait être faite des informations et contenus présents sur <?php echo esc_url( home_url() ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php echo esc_html( upmc_get_legal_value( 'company_name' ) ); ?> s'engage à sécuriser au mieux le site <?php echo esc_url( home_url() ); ?> cependant sa responsabilité ne pourra être mise en cause si des données indésirables sont importées et installées sur son site à son insu.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Des espaces interactifs (espace contact ou commentaires) sont à la disposition des utilisateurs. <?php echo esc_html( upmc_get_legal_value( 'company_name' ) ); ?> se réserve le droit de supprimer, sans mise en demeure préalable, tout contenu déposé dans cet espace qui contreviendrait à la législation applicable en France, en particulier aux dispositions relatives à la protection des données.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Le cas échéant, <?php echo esc_html( upmc_get_legal_value( 'company_name' ) ); ?> se réserve également la possibilité de mettre en cause la responsabilité civile et/ou pénale de l'utilisateur, notamment en cas de message à caractère raciste, injurieux, diffamant, ou pornographique, quel que soit le support utilisé (texte, photographie …).</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">4 – CNIL et gestion des données personnelles.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Conformément aux dispositions de la loi 78-17 du 6 janvier 1978 modifiée, l'utilisateur du site <?php echo esc_url( home_url() ); ?> dispose d'un droit d'accès, de modification et de suppression des informations collectées. Pour exercer ce droit, envoyez un message à notre Délégué à la Protection des Données : <?php echo esc_html( upmc_get_legal_value( 'dpo_name' ) ); ?> – <?php echo esc_html( upmc_get_legal_value( 'dpo_email' ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Pour plus d'informations sur la façon dont nous traitons vos données (type de données, finalité, destinataire…), lisez notre politique de confidentialité.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">5 – Liens hypertextes et cookies</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Le site <?php echo esc_url( home_url() ); ?> contient des liens hypertextes vers d'autres sites et dégage toute responsabilité à propos de ces liens externes ou des liens créés par d'autres sites vers <?php echo esc_url( home_url() ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>La navigation sur le site <?php echo esc_url( home_url() ); ?> est susceptible de provoquer l'installation de cookie(s) sur l'ordinateur de l'utilisateur.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Un « cookie » est un fichier de petite taille qui enregistre des informations relatives à la navigation d'un utilisateur sur un site. Les données ainsi obtenues permettent d'obtenir des mesures de fréquentation, par exemple.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Vous avez la possibilité d'<strong>accepter ou de refuser</strong> les cookies en modifiant les paramètres de votre navigateur. Aucun cookie ne sera déposé sans votre consentement.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Les cookies sont enregistrés pour une durée maximale de 13 mois.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Pour plus d'informations sur la façon dont nous faisons usage des cookies, lisez notre politique de confidentialité.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">6 – Droit applicable et attribution de juridiction.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Tout litige en relation avec l'utilisation du site <?php echo esc_url( home_url() ); ?> est soumis au droit français. En dehors des cas où la loi ne le permet pas, il est fait attribution exclusive de juridiction aux tribunaux compétents de<strong> Caen</strong>.</p>
<!-- /wp:paragraph -->

<!-- wp:spacer {"height":"3.5rem"} -->
<div style="height:3.5rem" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
