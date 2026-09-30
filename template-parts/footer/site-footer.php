<?php
/**
 * Conteúdo do rodapé Eclipse Secret.
 *
 * @package eclipse-secret
 */

defined('ABSPATH') || exit;


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

        <nav class="eclipse-footer__nav" aria-labelledby="contato-title">
            <h2 id="contato-title">Contato</h2>

            <div class="eclipse-footer__info-item">
                <span class="eclipse-footer__info-icon"><?php echo eclipse_secret_icon('phone'); ?></span>
                <div>
                    <a href="https://wa.me/5511987654321" target="_blank" rel="noopener"
                        class="eclipse-footer__info-value">
                        (11) 98765-4321
                    </a>
                    <span class="eclipse-footer__info-sub">Atendimento via WhatsApp</span>
                </div>
            </div>

            <div class="eclipse-footer__info-item">
                <span class="eclipse-footer__info-icon"><?php echo eclipse_secret_icon('mail'); ?></span>
                <div>
                    <a href="mailto:contato@eclipsesecret.com.br" class="eclipse-footer__info-value">
                        contato@eclipsesecret.com.br
                    </a>
                    <span class="eclipse-footer__info-sub">Respondemos em até 24h</span>
                </div>
            </div>

            <div class="eclipse-footer__info-item">
                <span class="eclipse-footer__info-icon"><?php echo eclipse_secret_icon('clock'); ?></span>
                <div>
                    <span class="eclipse-footer__info-value">Seg a Sex: 9h às 18h</span>
                    <span class="eclipse-footer__info-sub">Sáb: 9h às 14h</span>
                </div>
            </div>
        </nav>

    </div>

    <div class="eclipse-footer__bottom">
        <p>
            &copy; <?php echo esc_html(wp_date('Y')); ?>
            Eclipse Secret. Todos os direitos reservados.
        </p>

        <p>Conteúdo destinado a maiores de 18 anos.</p>
    </div>

</div>