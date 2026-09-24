<?php
/**
 * Página inicial da Eclipse Secret.
 *
 * @package eclipse-secret
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="primary" class="site-main eclipse-home">
    <?php get_template_part( 'template-parts/home/hero' ); ?>
</main>

<?php get_footer(); ?>