<?php
/**
 * Banner principal.
 *
 * @package eclipse-secret
 */

defined( 'ABSPATH' ) || exit;

$image_id = get_post_thumbnail_id( get_queried_object_id() );

$shop_url = function_exists( 'wc_get_page_permalink' )
    ? wc_get_page_permalink( 'shop' )
    : '';
?>

<section class="eclipse-hero" aria-labelledby="eclipse-hero-title">

    <?php
    if ( $image_id ) {
        echo wp_get_attachment_image(
            $image_id,
            'full',
            false,
            array(
                'class'         => 'eclipse-hero__image',
                'alt'           => '',
                'loading'       => 'eager',
                'fetchpriority' => 'high',
                'sizes'         => '100vw',
            )
        );
    }
    ?>

    <div class="eclipse-hero__inner">
        <div class="eclipse-hero__content">

            <p class="eclipse-hero__eyebrow">
                Eclipse Secret
            </p>

            <h1 id="eclipse-hero-title" class="eclipse-hero__title">
                Desejo em segredo.
                <span>Elegância em cada detalhe.</span>
            </h1>

            <p class="eclipse-hero__description">
                Descubra uma seleção de produtos para viver
                sua intimidade com liberdade, cuidado e sofisticação.
            </p>

            <?php if ( $shop_url ) : ?>
                <a
                    class="eclipse-hero__button"
                    href="<?php echo esc_url( $shop_url ); ?>"
                >
                    Explorar a coleção
                </a>
            <?php endif; ?>

        </div>
    </div>

</section>