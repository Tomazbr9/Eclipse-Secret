<?php
/**
 * Conteúdo do cabeçalho Eclipse Secret.
 *
 * @package eclipse-secret
 */

defined( 'ABSPATH' ) || exit;

$has_woocommerce = class_exists( 'WooCommerce' );
?>

<div class="eclipse-header">

    <div class="eclipse-header__top">

        <div class="eclipse-header__search">
            <?php if ( $has_woocommerce ) : ?>
                <details class="eclipse-search">
                    <summary>
                        <?php eclipse_secret_icon( 'search' ); ?>
                        <span>Buscar</span>
                    </summary>

                    <div class="eclipse-search__panel">
                        <?php get_product_search_form(); ?>
                    </div>
                </details>
            <?php endif; ?>
        </div>

        <a
            class="eclipse-brand"
            href="<?php echo esc_url( home_url( '/' ) ); ?>"
            aria-label="Eclipse Secret — página inicial"
        >
            <span class="eclipse-brand__name">ECLIPSE SECRET</span>
        </a>

        <?php if ( $has_woocommerce ) : ?>
            <nav
                class="eclipse-header__actions"
                aria-label="Conta e compras"
            >
                <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>">
                    <?php eclipse_secret_icon( 'user' ); ?>
                    <span>Conta</span>
                </a>

                <a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
                    <?php eclipse_secret_icon( 'shopping-bag' ); ?>
                    <span>Carrinho</span>
                </a>
            </nav>
        <?php endif; ?>

    </div>

    <?php if ( has_nav_menu( 'primary' ) ) : ?>
        <nav
            class="eclipse-navigation"
            aria-label="Navegação principal"
        >
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'eclipse-menu',
                    'menu_id'        => 'eclipse-primary-menu',
                    'depth'          => 1,
                    'fallback_cb'    => false,
                )
            );
            ?>
        </nav>
    <?php endif; ?>

</div>