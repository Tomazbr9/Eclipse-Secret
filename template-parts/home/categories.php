<?php
/**
 * Categorias da página inicial.
 *
 * @package eclipse-secret
 */

defined( 'ABSPATH' ) || exit;

if ( ! taxonomy_exists( 'product_cat' ) ) {
    return;
}

$default_category = absint( get_option( 'default_product_cat' ) );

$categories = get_terms(
    array(
        'taxonomy'   => 'product_cat',
        'hide_empty' => false,
        'parent'     => 0,
        'number'     => 4,
        'orderby'    => 'name',
        'order'      => 'ASC',
        'exclude'    => $default_category
            ? array( $default_category )
            : array(),
    )
);

if ( is_wp_error( $categories ) || empty( $categories ) ) {
    return;
}
?>

<section
    class="eclipse-categories"
    aria-labelledby="eclipse-categories-title"
>
    <div class="eclipse-categories__inner">

        <header class="eclipse-categories__heading">
            <p class="eclipse-categories__eyebrow">
                Descubra possibilidades
            </p>

            <h2 id="eclipse-categories-title">
                Escolha seu momento
            </h2>

            <p class="eclipse-categories__description">
                Explore nossa seleção e encontre o que combina com você.
            </p>
        </header>

        <div class="eclipse-categories__grid">
            <?php foreach ( $categories as $category ) : ?>
                <?php
                $category_url = get_term_link( $category );

                if ( is_wp_error( $category_url ) ) {
                    continue;
                }

                $image_id = absint(
                    get_term_meta(
                        $category->term_id,
                        'thumbnail_id',
                        true
                    )
                );
                ?>

                <a
                    class="eclipse-category"
                    href="<?php echo esc_url( $category_url ); ?>"
                >
                    <?php
                    if ( $image_id ) {
                        echo wp_get_attachment_image(
                            $image_id,
                            'large',
                            false,
                            array(
                                'class'   => 'eclipse-category__image',
                                'alt'     => '',
                                'loading' => 'lazy',
                                'sizes'   => '(max-width: 599px) 100vw, (max-width: 1023px) 50vw, 25vw',
                            )
                        );
                    }
                    ?>

                    <div class="eclipse-category__content">
                        <h3 class="eclipse-category__title">
                            <?php echo esc_html( $category->name ); ?>
                        </h3>

                        <span class="eclipse-category__link">
                            Explorar
                            <span aria-hidden="true">→</span>
                        </span>
                    </div>
                </a>

            <?php endforeach; ?>
        </div>

    </div>
</section>