<?php
    /**
     * Template Name: Регистрация
     */

    get_header();
?>

<div class="page-main-content">

    <section class="registration common-section">
        <h2 class="common-section__header">2 easy steps to register</h2>
        <div class="registration__steps">
            <div class="registration__step">FILL IN THE FORM IN ENGLISH</div>
            <div class="registration__step">READ THOROUGHLY TERMS&CONDITIONS</div>
        </div> <!-- registration__steps -->
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8 offset-xl-2 offset-lg-2 col-12">

                    <form class="form-default register-form">

                        <div class="form-default__row-item">
                            <div class="register-form__label"><label for="conference">Please, choose a conference:</label></div>
                            <select name="conference" id="conference">
                                <?php
                                    $conferences = get_posts( [
                                        'numberposts' => -1,
                                        'post_type' => "post",
                                        'category_name' => 'conferences',
                                        'orderby' => 'date',
                                        'order' => 'ASC',
                                        'suppress_filters' => true
                                    ] );

                                    $conf_selected = false;
                                    foreach( $conferences as $post ) {
                                        setup_postdata( $post );
                                        $option_text = get_field('conference_name');
                                ?>
                                        <option value="<?php echo get_the_ID(); ?>"
                                            <?php
                                            if( get_field('is_selected') === 'on' && !$conf_selected ) {
                                                echo "selected";
                                                $conf_selected = true;
                                            }
                                            ?>
                                        >
                                            <?php echo $option_text; ?>
                                        </option>
                                 <?php
                                    }
                                    wp_reset_postdata();
                                ?>
                            </select>
                        </div> <!-- form-default__row-item -->
                        <div class="form-default__row-item form-default__row-item--package">
                            <div class="register-form__label">
                                Please choose delegate package:
                            </div> <!-- register-form__label -->
                            <div class="register-form__radio-buttons">
                                <div class="register-form__radio">
                                    <input class="custom-radio custom-radio--standard"
                                           type="radio"
                                           name="package_type"
                                           id="package_standard"
                                           value="standard"
                                           checked>
                                    <label for="package_standard"></label>
                                </div> <!-- register-form__radio -->
                                <div class="register-form__radio">
                                    <input class="custom-radio custom-radio--premium"
                                           type="radio"
                                           name="package_type"
                                           id="package_premium"
                                           value="premium">
                                    <label for="package_premium"></label>
                                </div> <!-- register-form__radio -->
                            </div> <!-- register-form__radio-buttons -->
                        </div> <!-- form-default__row-item -->
                        <div class="form-default__row-item">
                            <div class="register-form__label">
                                <label for="name">Name:</label>
                            </div> <!-- register-form__label -->
                            <input type="text" name="name" id="name">
                        </div> <!-- form-default__row-item -->
                        <div class="form-default__row-item">
                            <div class="register-form__label">
                                <label for="surname">Surname:</label>
                            </div> <!-- register-form__label -->
                            <input type="text" name="surname" id="surname">
                        </div> <!-- form-default__row-item -->
                        <div class="form-default__row-item">
                            <div class="register-form__label">
                                <label for="company_name">Company Name:</label>
                            </div> <!-- register-form__label -->
                            <input type="text" name="company_name" id="company_name">
                        </div> <!-- form-default__row-item -->
                        <div class="form-default__row-item">
                            <div class="register-form__label">
                                <label for="business_area">Business Area:</label>
                            </div> <!-- register-form__label -->
                            <select name="business_area" id="business_area">
                                <?php
                                $areas = get_posts( [
                                    'numberposts' => -1,
                                    'post_type' => "post",
                                    'category_name' => 'business_area',
                                    'orderby' => 'date',
                                    'order' => 'ASC',
                                    'suppress_filters' => true
                                ] );

                                $area_selected = false;
                                foreach( $areas as $post ) {
                                    setup_postdata( $post );
                                    ?>
                                    <option value="<?php echo get_the_ID(); ?>"
                                        <?php
                                            if( get_field('is_selected') === 'on' && !$area_selected ) {
                                                echo "selected";
                                                $area_selected = true;
                                            }
                                        ?>
                                    >
                                        <?php the_title(); ?>
                                    </option>
                                <?php
                                    }
                                    wp_reset_postdata();
                                ?>
                            </select>
                        </div> <!-- form-default__row-item -->
                        <div class="form-default__row-item">
                            <div class="register-form__label">
                                <label for="email_organizers">Email (for organizers):</label>
                            </div> <!-- register-form__label -->
                            <input type="text" name="email_organizers" id="email_organizers">
                        </div> <!-- form-default__row-item -->
                        <div class="form-default__row-item">
                            <div class="register-form__label">
                                <label for="email_sponsors">Email (for sponsors):</label>
                            </div> <!-- register-form__label -->
                            <input type="text" name="email_sponsors" id="email_sponsors">
                        </div> <!-- form-default__row-item -->
                        <div class="form-default__row-item">
                            <div class="register-form__label">
                                <label for="number_organizers">Mobile Number (for organizers):</label>
                            </div> <!-- register-form__label -->
                            <input type="text" name="number_organizers" id="number_organizers">
                        </div> <!-- form-default__row-item -->
                        <div class="form-default__row-item">
                            <div class="register-form__label">
                                <label for="country">Country:</label>
                            </div> <!-- register-form__label -->
                            <input type="text" name="country" id="country">
                        </div> <!-- form-default__row-item -->
                        <div class="form-default__row-item">
                            <div class="register-form__label">
                                <label for="website">Web-site:</label>
                            </div> <!-- register-form__label -->
                            <input type="text" name="website" id="website">
                        </div> <!-- form-default__row-item -->
                        <div class="form-default__row-item form-default__row-item--payment">
                            <div class="register-form__label">
                                Method of payment
                            </div>
                            <div class="register-form__radio-buttons">
                                <div class="register-form__radio">
                                    <input class="custom-radio custom-radio--free"
                                           type="radio" name="payment"
                                           id="payment_free"
                                           value="free">
                                    <label for="payment_free"></label>
                                </div> <!-- register-form__radio -->
                                <div class="register-form__radio">
                                    <input class="custom-radio custom-radio--visa"
                                           type="radio"
                                           name="payment"
                                           id="payment_visa"
                                           value="visa"
                                           checked>
                                    <label for="payment_visa"></label>
                                </div> <!-- register-form__radio -->
                                <div class="register-form__radio">
                                    <input class="custom-radio custom-radio--invoice"
                                           type="radio"
                                           name="payment"
                                           id="payment_invoice"
                                           value="invoice">
                                    <label for="payment_invoice"></label>
                                </div> <!-- register-form__radio -->
                                <div class="register-form__radio">
                                    <input class="custom-radio custom-radio--paypal"
                                           type="radio"
                                           name="payment"
                                           id="payment_paypal"
                                           value="paypal">
                                    <label for="payment_paypal"></label>
                                </div> <!-- register-form__radio -->
                            </div> <!-- register-form__radio-buttons -->
                        </div> <!-- form-default__row-item -->
                        <div class="btn-wrapper btn-wrapper--between">
                            <div class="form-default__accepted">
                                <input class="custom-checkbox" type="checkbox" name="accepted" id="accepted">
                                <label for="accepted">
                                    <span>I accept</span><a href="#">Terms & Conditions</a>
                                </label>
                            </div> <!-- form-default__accepted -->
                            <input class="button button--dark" type="submit" value="submit">
                        </div> <!-- btn-wrapper btn-wrapper--between -->

                    </form> <!-- form-default -->

                </div>

            </div>
        </div>

    </section>

</div> <!-- page-main-content -->

<?php
    get_footer();
