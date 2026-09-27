<?php
/**
 * Conteúdo do rodapé Eclipse Secret.
 *
 * @package eclipse-secret
 */

defined('ABSPATH') || exit;

$footer_menus = array(
    'eclipse_footer_shop' => 'Comprar',
    'eclipse_footer_help' => 'Ajuda',
    'eclipse_footer_info' => 'Sobre',
);
?>

<div class="eclipse-footer">

    <div class="eclipse-footer__grid">

        <div class="eclipse-footer__brand">
            <a class="eclipse-footer__logo" href="<?php echo esc_url(home_url('/')); ?>"
                aria-label="Eclipse Secret — página inicial">
                ECLIPSE SECRET
            </a>

            <p class="eclipse-footer__tagline">
                Desejo em segredo.<br>
                Elegância em cada detalhe.
            </p>

            <p class="eclipse-footer__description">
                Descubra novas formas de viver sua intimidade,
                no seu tempo e do seu jeito.
            </p>
            <div class="eclipse-footer__social">
                <a href="https://www.instagram.com/" class="eclipse-footer__social-link" aria-label="Instagram"
                    target="_blank" rel="noopener">
                    <?php echo eclipse_secret_icon('instagram'); ?>
                </a>
                <a href="https://www.facebook.com/?locale=pt_BR" class="eclipse-footer__social-link"
                    aria-label="Facebook" target="_blank" rel="noopener">
                    <?php echo eclipse_secret_icon('facebook'); ?>
                </a>
                <a href="https://web.whatsapp.com/" class="eclipse-footer__social-link" aria-label="WhatsApp"
                    target="_blank" rel="noopener">
                    <?php echo eclipse_secret_icon('whatsapp'); ?>
                </a>
            </div>
        </div>

        <?php foreach ($footer_menus as $location => $title): ?>
            <?php
            if (!has_nav_menu($location)) {
                continue;
            }

            $heading_id = $location . '-title';
            ?>

            <nav class="eclipse-footer__nav" aria-labelledby="<?php echo esc_attr($heading_id); ?>">
                <h2 id="<?php echo esc_attr($heading_id); ?>">
                    <?php echo esc_html($title); ?>
                </h2>

                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => $location,
                        'container' => false,
                        'menu_class' => 'eclipse-footer__menu',
                        'menu_id' => $location . '-menu',
                        'depth' => 1,
                        'fallback_cb' => false,
                    )
                );
                ?>
            </nav>

        <?php endforeach; ?>

    </div>

    <div class="eclipse-footer__bottom">
        <p>
            &copy; <?php echo esc_html(wp_date('Y')); ?>
            Eclipse Secret. Todos os direitos reservados.
        </p>

        <p>Conteúdo destinado a maiores de 18 anos.</p>
    </div>

</div>