<?php
/**
 * Funções do tema Eclipse Secret.
 *
 * @package eclipse-secret
 */

defined('ABSPATH') || exit;

/**
 * Substitui os componentes visuais do cabeçalho.
 */
function eclipse_secret_setup_header()
{
    $components = array(
        'storefront_header_container' => 0,
        'storefront_site_branding' => 20,
        'storefront_secondary_navigation' => 30,
        'storefront_product_search' => 40,
        'storefront_header_container_close' => 41,
        'storefront_primary_navigation_wrapper' => 42,
        'storefront_primary_navigation' => 50,
        'storefront_header_cart' => 60,
        'storefront_primary_navigation_wrapper_close' => 68,
    );

    foreach ($components as $callback => $priority) {
        remove_action('storefront_header', $callback, $priority);
    }

    add_action(
        'storefront_header',
        'eclipse_secret_render_header',
        20
    );
}
add_action('after_setup_theme', 'eclipse_secret_setup_header', 20);

/**
 * Carrega o HTML do nosso cabeçalho.
 */
function eclipse_secret_render_header()
{
    get_template_part('template-parts/header/site-header');
}

/**
 * Exibe um ícone decorativo do Lucide.
 *
 * Utiliza somente SVGs oficiais armazenados no tema.
 */
function eclipse_secret_icon($name)
{
    $allowed_icons = array(
        'search',
        'user',
        'shopping-bag',
        'instagram',
        'facebook',
        'whatsapp',
        'clock',
        'mail',
        'phone',

    );

    if (!in_array($name, $allowed_icons, true)) {
        return;
    }

    static $icons = array();

    if (!isset($icons[$name])) {
        $path = get_stylesheet_directory()
            . '/assets/icons/lucide/'
            . $name
            . '.svg';

        if (!is_readable($path)) {
            return;
        }

        $svg = file_get_contents($path);

        if (false === $svg) {
            return;
        }

        $icons[$name] = $svg;
    }

    echo '<span class="eclipse-icon" aria-hidden="true">';

    // SVG local confiável, selecionado pela lista permitida acima.
    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    echo $icons[$name];

    echo '</span>';
}

/**
 * Ajustes exclusivos da página inicial.
 */
function eclipse_secret_setup_front_page()
{
    if (!is_front_page()) {
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
add_action('wp', 'eclipse_secret_setup_front_page');

/**
 * Configura o rodapé e registra seus menus.
 */
function eclipse_secret_setup_footer()
{
    register_nav_menus(
        array(
            'eclipse_footer_shop' => 'Rodapé — Comprar',
            'eclipse_footer_help' => 'Rodapé — Atendimento',
            'eclipse_footer_info' => 'Rodapé — Informações',
        )
    );

    remove_action(
        'storefront_footer',
        'storefront_footer_widgets',
        10
    );

    remove_action(
        'storefront_footer',
        'storefront_credit',
        20
    );

    add_action(
        'storefront_footer',
        'eclipse_secret_render_footer',
        10
    );
}
add_action('after_setup_theme', 'eclipse_secret_setup_footer', 20);

/**
 * Exibe o conteúdo personalizado do rodapé.
 */
function eclipse_secret_render_footer()
{
    get_template_part('template-parts/footer/site-footer');
}

/**
 * Remove a barra lateral apenas da página individual do produto.
 */
function eclipse_secret_setup_product_page()
{
    if (!function_exists('is_product') || !is_product()) {
        return;
    }

    remove_action(
        'storefront_sidebar',
        'storefront_get_sidebar',
        10
    );
}
add_action('wp', 'eclipse_secret_setup_product_page');

/**
 * Coloca a descrição completa na área de compra.
 */
function eclipse_secret_move_product_description()
{
    if (!function_exists('is_product') || !is_product()) {
        return;
    }

    // Evita exibir a descrição curta junto da completa.
    remove_action(
        'woocommerce_single_product_summary',
        'woocommerce_template_single_excerpt',
        20
    );

    add_action(
        'woocommerce_single_product_summary',
        'eclipse_secret_product_description',
        20
    );

    add_filter(
        'woocommerce_product_tabs',
        'eclipse_secret_remove_description_tab',
        98
    );
}
add_action('wp', 'eclipse_secret_move_product_description');

/**
 * Exibe o conteúdo cadastrado na descrição do produto.
 */
function eclipse_secret_product_description()
{
    $content = get_post_field('post_content', get_the_ID());

    if ('' === trim($content)) {
        return;
    }

    echo '<div class="eclipse-product-description">';
    echo apply_filters('the_content', $content);
    echo '</div>';
}

/**
 * Remove a aba para não repetir a descrição.
 */
function eclipse_secret_remove_description_tab($tabs)
{
    unset($tabs['description']);

    return $tabs;
}

/**
 * Remove a barra lateral da página do carrinho.
 */
function eclipse_secret_setup_cart_page()
{
    if (!function_exists('is_cart') || !is_cart()) {
        return;
    }

    remove_action(
        'storefront_sidebar',
        'storefront_get_sidebar',
        10
    );
}
add_action('wp', 'eclipse_secret_setup_cart_page');

/**
 * Remove o breadcrumb da página do carrinho.
 */
function eclipse_secret_remove_cart_breadcrumb()
{
    if (!function_exists('is_cart') || !is_cart()) {
        return;
    }

    remove_action(
        'storefront_before_content',
        'woocommerce_breadcrumb',
        10
    );
}
add_action('wp', 'eclipse_secret_remove_cart_breadcrumb', 20);

/**
 * Ajusta a estrutura da página Minha conta.
 */
function eclipse_secret_setup_account_page() {
    if ( ! function_exists( 'is_account_page' ) || ! is_account_page() ) {
        return;
    }

    remove_action(
        'storefront_sidebar',
        'storefront_get_sidebar',
        10
    );

    remove_action(
        'storefront_before_content',
        'woocommerce_breadcrumb',
        10
    );
}
add_action( 'wp', 'eclipse_secret_setup_account_page', 20 );

/**
 * Exibe o botão flutuante de atendimento pelo WhatsApp.
 */
function eclipse_secret_whatsapp_button() {
    $phone = '5511913732365';

    // Não exibe o botão enquanto o número não estiver configurado.
    if ( ! preg_match( '/^55[0-9]{10,11}$/', $phone ) ) {
        return;
    }

    $message = 'Olá! Estou na loja Eclipse Secret e gostaria de ajuda.';

    $url = 'https://wa.me/' . $phone
        . '?text=' . rawurlencode( $message );
    ?>

    <a
        class="eclipse-whatsapp"
        href="<?php echo esc_url( $url ); ?>"
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Falar com a Eclipse Secret no WhatsApp (abre em nova aba)"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            aria-hidden="true"
            focusable="false"
        >
            <path d="M20.52 3.48A11.91 11.91 0 0 0 12.05 0C5.47 0 .11 5.35.1 11.94c0 2.1.55 4.16 1.6 5.98L0 24l6.24-1.64a11.97 11.97 0 0 0 5.8 1.48h.01c6.58 0 11.94-5.35 11.95-11.94a11.87 11.87 0 0 0-3.48-8.42ZM12.05 21.82a9.9 9.9 0 0 1-5.05-1.38l-.36-.21-3.7.97.99-3.61-.24-.37a9.9 9.9 0 0 1-1.52-5.28c0-5.47 4.45-9.92 9.93-9.92a9.85 9.85 0 0 1 7.01 2.91 9.85 9.85 0 0 1 2.9 7.02c0 5.47-4.45 9.92-9.96 9.92Zm5.44-7.43c-.3-.15-1.77-.87-2.04-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.95 1.17-.17.2-.35.22-.65.07-.3-.15-1.26-.46-2.4-1.48-.89-.79-1.49-1.77-1.66-2.07-.18-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.18.2-.3.3-.5.1-.2.05-.37-.03-.52-.07-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.8.37-.27.3-1.04 1.02-1.04 2.49s1.07 2.89 1.22 3.09c.15.2 2.1 3.2 5.09 4.49.71.3 1.27.48 1.7.61.71.23 1.36.2 1.87.12.57-.09 1.77-.72 2.02-1.42.25-.7.25-1.3.17-1.42-.07-.12-.27-.2-.57-.35Z"/>
        </svg>
    </a>

    <?php
}
add_action( 'wp_footer', 'eclipse_secret_whatsapp_button' );