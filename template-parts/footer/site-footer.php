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
    <div class="eclipse-footer__trust">

        <div class="eclipse-footer__trust-col">
            <h2>Formas de pagamento</h2>
            <ul class="eclipse-footer__pay">
                <li><img src="http://eclipse-secret-frontend-site.local/wp-content/uploads/2026/10/pix.svg" alt="Pix"
                        width="48" height="28" loading="lazy"></li>
                <li><img src="http://eclipse-secret-frontend-site.local/wp-content/uploads/2026/10/Visa.svg" alt="Visa"
                        width="48" height="28" loading="lazy"></li>
                <li><img src="http://eclipse-secret-frontend-site.local/wp-content/uploads/2026/10/Mastercard.svg"
                        alt="Mastercard" width="48" height="28" loading="lazy"></li>
                <li><img src="http://eclipse-secret-frontend-site.local/wp-content/uploads/2026/10/paypal.svg" alt="Elo"
                        width="48" height="28" loading="lazy"></li>
                <li><img src="http://eclipse-secret-frontend-site.local/wp-content/uploads/2026/10/pagseguro.svg"
                        alt="Elo" width="48" height="28" loading="lazy"></li>
                <li><img src="http://eclipse-secret-frontend-site.local/wp-content/uploads/2026/10/boleto.svg"
                        alt="Boleto" width="48" height="28" loading="lazy"></li>
            </ul>
        </div>

        <div class="eclipse-footer__trust-col">
            <h2>Compra segura</h2>
            <ul class="eclipse-footer__secure">
                <li>
                    <span>Site seguro (SSL)</span>
                    <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                        <rect x="5" y="11" width="14" height="9" rx="2"></rect>
                        <path d="M8 11V8a4 4 0 0 1 8 0v3"></path>
                    </svg>
                </li>
                <li>
                    <span>Embalagem discreta</span>
                    <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                        <path d="M12 3l8 4.5v9L12 21l-8-4.5v-9L12 3z"></path>
                        <path d="M4 7.5l8 4.5 8-4.5"></path>
                        <path d="M12 12v9"></path>
                    </svg>
                </li>
            </ul>
        </div>

        <div class="eclipse-footer__trust-col">
            <h2>Ajuda</h2>
            <ul class="eclipse-footer__links">
                <li><a href="<?php echo esc_url(home_url('/trocas-e-devolucoes/')); ?>">Trocas e devoluções</a></li>
                <li><a href="<?php echo esc_url(home_url('/politica-de-privacidade/')); ?>">Política de privacidade</a>
                </li>
                <li><a href="<?php echo esc_url(home_url('/termos-de-uso/')); ?>">Termos de uso</a></li>
            </ul>
        </div>

    </div>

    <div class="eclipse-footer__bottom">
        <p>
            &copy; <?php echo esc_html(wp_date('Y')); ?>
            Eclipse Secret. Todos os direitos reservados.<br>
            Razão social da empresa LTDA · CNPJ 00.000.000/0001-00
        </p>

        <p>Conteúdo destinado a maiores de 18 anos.</p>
    </div>

</div>