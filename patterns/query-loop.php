<?php
/**
 * Title: Boucle de single
 * Slug: ng1-base/query-loop
 * Categories: query
 * Block Types: core/query,
 * Description: Boucle de single
 *
 * @package WordPress
 * @subpackage ng1-base
 * @since ng1-base 1.0
 */

?>

<!-- wp:query {"queryId":0,"query":{"perPage":9,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"taxQuery":null,"parents":[],"format":[]},"className":"query-loop__items",
"layout":{
    "type":"constrained",
    "contentSize":"768px",
    "wideSize":"970px"
}} -->
<div class="wp-block-query query-loop__items"><!-- wp:post-template {"className":"query-loop__item"} -->
<!-- wp:post-title /-->


<!-- wp:post-date {"metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}}} /-->
<!-- /wp:post-template -->

<!-- wp:query-pagination {"className":"query-loop__pagination"} -->
<!-- wp:query-pagination-previous /-->

<!-- wp:query-pagination-numbers /-->

<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination -->

<!-- wp:query-no-results {"className":"query-loop__no-result"} -->
<!-- wp:paragraph {"placeholder":"Ajouter un texte ou des blocs qui s’afficheront lorsqu’une requête ne renverra aucun résultat."} -->
<p></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query -->