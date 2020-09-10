<?php
    /**
     * Template Name: Контакты
     */

    get_header();
?>

    <div class="page-main-content">

        <section class="main-contacts common-section">

            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-8">

                        <div class="main-contacts__map-wrapper" id="contacts-yandex-map">
                            <!-- Тут будет подгружаться карта -->
                        </div> <!-- #contacts-yandex-map (.main-contacts__map-wrapper) -->

                    </div>
                    <div class="col-xl-4 col-lg-4">

                        <div class="main-contacts__delegates-info">
                            <ul class="main-contacts__list">

                                <li class="main-contacts__list-item">
                                    <span class="main-contacts__person-duty">DELEGATE ENQUIRIES</span>
                                    <span class="main-contacts__person-name"><?php the_field('delegate_name'); ?></span>
                                    <span class="main-contacts__person-email">
                                    E: <a
                                            href="mailto:<?php the_field('delegate_email'); ?>"><?php the_field('delegate_email'); ?></a>
                                </span>
                                    <span class="main-contacts__person-phone">P: <span class="phone-field"><?php echo format_phone( get_field('delegate_phone') ); ?></span></span>
                                </li> <!-- main-contacts__list-item -->

                                <li class="main-contacts__list-item">
                                    <span class="main-contacts__person-duty">BUSINESS DEVELOPMENT</span>
                                    <span class="main-contacts__person-name"><?php the_field('developer_name'); ?></span>
                                    <span class="main-contacts__person-email">
                                    E: <a
                                            href="mailto:<?php the_field('developer_email'); ?>"><?php the_field('developer_email'); ?></a>
                                </span>
                                    <span class="main-contacts__person-phone">P: <span class="phone-field"><?php echo format_phone( get_field('developer_phone') ); ?></span></span>
                                </li> <!-- main-contacts__list-item -->
                                <li class="main-contacts__list-item">
                                    <span class="main-contacts__person-duty">COMMUNICATIONS DEPARTMENT</span>
                                    <span class="main-contacts__person-name"><?php the_field('comdep_name'); ?></span>
                                    <span class="main-contacts__person-email">
                                    E: <a
                                            href="mailto:<?php the_field('comdep_email'); ?>"><?php the_field('comdep_email'); ?></a>
                                </span>
                                    <span class="main-contacts__person-phone">P: <span class="phone-field"><?php echo format_phone( get_field('comdep_phone') ); ?></span></span>
                                </li> <!-- main-contacts__list-item -->
                                <li class="main-contacts__list-item">
                                    <span class="main-contacts__person-duty">MARKETING</span>
                                    <span class="main-contacts__person-name"><?php the_field('marketman_name'); ?></span>
                                    <span class="main-contacts__person-email">
                                    E: <a
                                            href="mailto:<?php the_field('marketman_email'); ?>"><?php the_field('marketman_email'); ?></a>
                                </span>
                                    <span class="main-contacts__person-phone">P: <span class="phone-field"><?php echo format_phone( get_field('marketman_phone') ); ?></span></span>
                                </li> <!-- main-contacts__list-item -->

                            </ul> <!-- main-contacts__list -->
                        </div> <!-- main-contacts__delegates-info -->

                    </div>
                </div>
            </div>

        </section> <!-- main-contacts -->
        <section class="feedback common-section">
            <h2 class="common-section__header">feedback</h2>

            <div class="container">
                <div class="row">

                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">

                        <form class="feedback__form form-default">
                            <div class="form-default__row-item">
                                <span class="form-default__row-header">Your appeal</span>
                                <label>
                                    <textarea name="appeal-text" placeholder="Text here"></textarea>
                                </label>
                            </div>
                            <div class="form-default__row-item">
                                <span class="form-default__row-header">How to contact you?</span>
                                <label>
                                    <input type="text" name="email" placeholder="E-mail">
                                </label>
                                <label>
                                    <input type="text" name="name" placeholder="Your name">
                                </label>
                            </div>
                            <div class="btn-wrapper btn-wrapper--right">
                                <input class="button button--dark" type="submit" value="send">
                            </div>
                        </form> <!-- feedback__form form-default -->

                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                        <div class="feedback__description">
                            <span class="feedback__text-line">You can also ask questions by phone of a hot line:</span>
                            <span class="feedback__text-line phone-number"><?php echo format_phone( get_field('common_contacts_phone', 2) ); ?></span>
                            <span class="feedback__text-line">The answers to many questions already in our <a href="#">FAQ</a></span>
                            <span class="feedback__text-line">All suggestions and comments are considered mandatory!</span>
                        </div> <!-- feedback__description -->
                    </div>

                </div>
            </div>

        </section>

    </div> <!-- page-main-content -->

    <script>
        // Инициализация яндекс карты:
        document.addEventListener("DOMContentLoaded", function() {
            const address = "<?php the_field('address'); ?>";
            ymaps.ready(initContactsMap.bind(null, address, "contacts-yandex-map", "<?php the_field('pointer') ?>"));
        });

    </script>
<?php
    get_footer();
