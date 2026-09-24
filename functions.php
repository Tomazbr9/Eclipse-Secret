<?php
/**
 * Funções do tema Eclipse Secret.
 *
 * @package eclipse-secret
 */

defined( 'ABSPATH' ) || exit;

/**
 * Substitui os componentes visuais do cabeçalho.
 */
function eclipse_secret_setup_header() {
    $components = array(
        'storefront_header_container'                 => 0,
        'storefront_site_branding'                    => 20,
        'storefront_secondary_navigation'             => 30,
        'storefront_product_search'                   => 40,
        'storefront_header_container_close'           => 41,
        'storefront_primary_navigation_wrapper'       => 42,
        'storefront_primary_navigation'               => 50,
        'storefront_header_cart'                      => 60,
        'storefront_primary_navigation_wrapper_close' => 68,
    );

    foreach ( $components as $callback => $priority ) {
        remove_action( 'storefront_header', $callback, $priority );
    }

    add_action(
        'storefront_header',
        'eclipse_secret_render_header',
        20
    );
}
add_action( 'after_setup_theme', 'eclipse_secret_setup_header', 20 );

/**
 * Carrega o HTML do nosso cabeçalho.
 */
function eclipse_secret_render_header() {
    get_template_part( 'template-parts/header/site-header' );
}

/**
 * Exibe um ícone decorativo do Lucide.
 *
 * Utiliza somente SVGs oficiais armazenados no tema.
 */
function eclipse_secret_icon( $name ) {
    $allowed_icons = array(
        'search',
        'user',
        'shopping-bag',
    );

    if ( ! in_array( $name, $allowed_icons, true ) ) {
        return;
    }

    static $icons = array();

    if ( ! isset( $icons[ $name ] ) ) {
        $path = get_stylesheet_directory()
            . '/assets/icons/lucide/'
            . $name
            . '.svg';

        if ( ! is_readable( $path ) ) {
            return;
        }

        $svg = file_get_contents( $path );

        if ( false === $svg ) {
            return;
        }

        $icons[ $name ] = $svg;
    }

    echo '<span class="eclipse-icon" aria-hidden="true">';

    // SVG local confiável, selecionado pela lista permitida acima.
    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    echo $icons[ $name ];

    echo '</span>';
}

/**
 * Ajustes exclusivos da página inicial.
 */
function eclipse_secret_setup_front_page() {
    if ( ! is_front_page() ) {
        return;
    }

    remove_action(
        'storefront_before_content',
        'woocommerce_breadcrumb',
        10
    );

    remove_action(
        'storefront_before_content',
        'storefront_header_widget_region',
        10
    );
}
add_action( 'wp', 'eclipse_secret_setup_front_page' );