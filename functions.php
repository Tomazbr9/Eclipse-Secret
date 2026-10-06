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
 * Remove a barra lateral das páginas de categoria e loja. 04/10
 */
function eclipse_secret_setup_shop_pages()
{
    if (
        !function_exists('is_shop') || !function_exists('is_product_category')
    ) {
        return;
    }

    if (!is_shop() && !is_product_category()) {
        return;
    }

    remove_action(
        'storefront_sidebar',
        'storefront_get_sidebar',
        10
    );
}
add_action('wp', 'eclipse_secret_setup_shop_pages');


/**
 * Remove a ordenação duplicada do final da página
 * nas páginas de loja e categoria.
 */
function eclipse_secret_remove_bottom_ordering()
{
    if (
        !function_exists('is_shop') || !function_exists('is_product_category')
    ) {
        return;
    }

    if (!is_shop() && !is_product_category()) {
        return;
    }

    remove_action(
        'woocommerce_after_shop_loop',
        'woocommerce_catalog_ordering',
        10
    );
}
add_action('wp', 'eclipse_secret_remove_bottom_ordering', 20);


/**
 * Remove o contador de produtos do final da página.
 */
function eclipse_secret_remove_bottom_result_count()
{
    if (
        !function_exists('is_shop') || !function_exists('is_product_category')
    ) {
        return;
    }

    if (!is_shop() && !is_product_category()) {
        return;
    }

    remove_action(
        'woocommerce_after_shop_loop',
        'woocommerce_result_count',
        20
    );
}
add_action('wp', 'eclipse_secret_remove_bottom_result_count', 20);


/**
 * ECLIPSE SECRET — Banner da categoria
 * Troca título/descrição/breadcrumb padrão por um banner com a imagem da categoria.
 */
function eclipse_secret_setup_category_banner()
{
    if (!function_exists('is_product_category') || !is_product_category()) {
        return;
    }

    // Breadcrumb padrão sai de cima; ele será renderizado dentro do banner.
    remove_action('storefront_before_content', 'woocommerce_breadcrumb', 10);
    add_action('storefront_before_content', 'eclipse_secret_render_category_banner', 10);

    // Remove título e descrição padrão da área de conteúdo.
    add_filter('woocommerce_show_page_title', '__return_false');
    remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
    remove_action('woocommerce_archive_description', 'woocommerce_product_archive_description', 10);
}
add_action('wp', 'eclipse_secret_setup_category_banner', 20);

function eclipse_secret_render_category_banner()
{
    $term = get_queried_object();

    if (!$term instanceof WP_Term) {
        return;
    }

    $thumb_id = (int) get_term_meta($term->term_id, 'thumbnail_id', true);
    $description = term_description($term->term_id, 'product_cat');
    ?>
    <section class="eclipse-category-banner">
        <?php
        if ($thumb_id) {
            echo wp_get_attachment_image($thumb_id, 'full', false, array(
                'class' => 'eclipse-category-banner__image',
                'alt' => '',
                'loading' => 'eager',
            ));
        }
        ?>
        <div class="eclipse-category-banner__inner">
            <?php
            woocommerce_breadcrumb(array(
                'delimiter' => ' / ',
                'wrap_before' => '<nav class="woocommerce-breadcrumb" aria-label="Breadcrumb">',
                'wrap_after' => '</nav>',
                'home' => 'Início',
            ));
            ?>
            <h1 class="eclipse-category-banner__title"><?php echo esc_html($term->name); ?></h1>

            <?php if ($description): ?>
                <div class="eclipse-category-banner__description">
                    <?php echo wp_kses_post($description); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php
}

/**
 * Selo de desconto em porcentagem (-10%) em vez de "Promoção!".
 */
function eclipse_secret_sale_badge($html, $post, $product)
{
    if ($product->is_type('variable')) {
        $regular = (float) $product->get_variation_regular_price('min');
        $sale = (float) $product->get_variation_sale_price('min');
    } else {
        $regular = (float) $product->get_regular_price();
        $sale = (float) $product->get_sale_price();
    }

    if ($regular <= 0 || $sale <= 0 || $sale >= $regular) {
        return $html;
    }

    $percent = round((1 - ($sale / $regular)) * 100);

    return '<span class="onsale">-' . (int) $percent . '%</span>';
}
add_filter('woocommerce_sale_flash', 'eclipse_secret_sale_badge', 10, 3);

/**
 * 12 produtos por página (4 colunas x 3 linhas), como no design.
 */
add_filter('loop_shop_per_page', function () {
    return 12;
}, 20);

/**
 * Nome do produto na listagem: converte CAIXA ALTA em "Primeira Letra Maiúscula".
 * Nomes que já estão em caixa mista não são alterados.
 */
function eclipse_secret_setup_loop_title()
{
    if (!function_exists('is_shop') || (!is_shop() && !is_product_taxonomy())) {
        return;
    }

    remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
    add_action('woocommerce_shop_loop_item_title', 'eclipse_secret_loop_product_title', 10);
}
add_action('wp', 'eclipse_secret_setup_loop_title', 20);

function eclipse_secret_loop_product_title()
{
    $title = get_the_title();

    if (mb_strtoupper($title, 'UTF-8') === $title) {
        $title = mb_convert_case(mb_strtolower($title, 'UTF-8'), MB_CASE_TITLE, 'UTF-8');
    }

    echo '<h2 class="woocommerce-loop-product__title">' . esc_html($title) . '</h2>';
}


add_action('storefront_before_header', function () {
    echo '<div class="eclipse-topbar">Embalagem 100% discreta · Entrega segura para todo o Brasil.</div>';
});


add_action( 'wp_footer', function () {
    ?>
    <div class="eclipse-age" id="eclipse-age" role="dialog" aria-modal="true" aria-labelledby="eclipse-age-title">
        <div class="eclipse-age__box">
            <p class="eclipse-age__brand">ECLIPSE SECRET</p>
            <h2 id="eclipse-age-title">Conteúdo para maiores de 18 anos</h2>
            <p class="eclipse-age__text">Este site contém produtos destinados ao público adulto. Você confirma que tem 18 anos ou mais?</p>
            <div class="eclipse-age__actions">
                <button type="button" class="eclipse-age__yes" id="eclipse-age-yes">Sim, tenho 18 anos ou mais</button>
                <a class="eclipse-age__no" href="https://www.google.com">Não, sair</a>
            </div>
        </div>
    </div>
    <script>
    (function () {
        var box = document.getElementById('eclipse-age');
        var ok = false;
        try { ok = localStorage.getItem('eclipse_age_ok') === '1'; } catch (e) {}
        if (ok) { return; }
        box.classList.add('is-open');
        document.documentElement.style.overflow = 'hidden';
        document.getElementById('eclipse-age-yes').addEventListener('click', function () {
            try { localStorage.setItem('eclipse_age_ok', '1'); } catch (e) {}
            box.classList.remove('is-open');
            document.documentElement.style.overflow = '';
        });
    })();
    </script>
    <?php
} );