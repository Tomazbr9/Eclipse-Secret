<?php
/**
 * Vitrine de produtos em destaque.
 *
 * @package eclipse-secret
 */

defined( 'ABSPATH' ) || exit;

if ( ! shortcode_exists( 'products' ) ) {
    return;
}

$shop_url = wc_get_page_permalink( 'shop' );
?>

<section
    class="eclipse-featured"
    aria-labelledby="eclipse-featured-title"
>
    <div class="eclipse-featured__inner">

        <header class="eclipse-featured__heading">
            <div>
                <p class="eclipse-featured__eyebrow">
                    Uma seleção para você
                </p>

                <h2 id="eclipse-featured-title">
                    Seleção Eclipse Secret
                </h2>
            </div>

            <?php if ( $shop_url ) : ?>
                <a
                    class="eclipse-featured__view-all"
                    href="<?php echo esc_url( $shop_url ); ?>"
                >
                    Ver todos os produtos
                </a>
            <?php endif; ?>
        </header>

        <?php
        echo do_shortcode( '[shop_messages]' );

        echo do_shortcode(
            '[products limit="4" columns="4" visibility="featured" orderby="date" order="DESC"]'
        );
        ?>

    </div>
</section>