    <footer class="main-footer">

        <div class="container">
            <div class="row">
                <div class="col-xl-2 col-lg-2 col-6">

                    <div class="main-footer__menu-item">
                        <h4 class="main-footer__header">top forum</h4>
                        <div class="main-menu">
                            <?php
                                wp_nav_menu([
                                    'menu' => 'footer_menu',
                                    'container' => false,
                                    'echo' => true,
                                    'items_wrap' => '<ul class="main-menu__list">%3$s</ul>',
                                    'depth' => 1,
                                ]);
                            ?>
                        </div> <!-- main-menu -->
                    </div> <!-- main-footer__menu-item -->

                </div>
                <div class="col-xl-2 col-lg-2 col-6">

                    <!--
                        Основные контакты. группа полей: Общая информация.
                        Поля:
                            1. Ярлык компании (main_label) - text.
                            2. Адрес (common_contacts_address) - text.
                            3. Телефон (common_contacts_phone) - text.
                            4. E-mail (common_contacts_email) - e-mail.
                            5. Ссылка на twitter (twitter_link) - link.
                     -->
                    <h4 class="main-footer__header">contact</h4>
                    <div class="main-menu">
                        <ul class="main-menu__list">
                            <li class="main-menu__list-item"><?php the_field('main_label', 2); ?></li>
                            <li class="main-menu__list-item"><?php the_field('common_contacts_address', 2); ?></li>
                            <li class="main-menu__list-item">
                                <?php
                                    echo format_phone( get_field('common_contacts_phone', 2) );
                                ?>
                            </li>
                            <li class="main-menu__list-item main-menu__list-item--email">
                                <?php
                                    $email = get_field('common_contacts_email', 2);
                                ?>
                                <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
                            </li>
                        </ul> <!-- main-menu__list -->
                    </div> <!-- main-menu -->

                </div>
                <div class="col-xl-2 offset-xl-6 col-lg-2 offset-lg-6 col-12">

                    <h4 class="main-footer__header main-footer__header--right">
                        <a href="<?php the_field('twitter_link', 2); ?>" target="_blank">follow us</a>
                    </h4>

                </div>
            </div>
            <div class="row">
                <div class="col-12">

                    <div class="main-footer__bottom">
                        <p>© 2014 - <?php echo date('Y') . " " . get_field('main_label', 2); ?>. All rights reserved.</p>
                    </div> <!-- main-footer_bottom -->

                </div>
            </div>
        </div>

    </footer> <!-- main-footer -->

    <?php
        wp_footer()
    ?>
</body>
</html>