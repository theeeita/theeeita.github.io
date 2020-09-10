<?php
	get_header();
?>
<div class="page-main-content">

    <!-- Форма подписки: -->
    <div class="popup-overlay">
        <div class="subscribe">
            <button class="subscribe__close"></button>
            <form class="subscribe__form form-default" action="#">
                <div class="subscribe__form-header">
                    <h3><?php the_field('popup_header'); ?></h3>
                    <p><?php the_field('popup_text'); ?></p>
                </div>
                <label>
                    <input type="text" name="full_name" placeholder="name and surname">
                </label>
                <label>
                    <input type="text" name="company_name" placeholder="company_name">
                </label>
                <label>
                    <input type="text" name="email" placeholder="e-mail">
                </label>
                <input type="submit" class="button button--dark" value="subscribe">
            </form> <!-- form-default subscribe__form -->
        </div> <!-- subscribe -->
    </div> <!-- pop-up-overlay -->

    <section class="main-events">

        <!-- Слайдер: начало -->
        <div class="slider slider--main-slider">

            <div class="container">
                <div class="row">
                    <div class="col-xl-5 offset-xl-7 col-12">

                        <div class="slider__navigation">
                            <button class="slider__prev"></button>
                            <button class="slider__next"></button>
                        </div> <!-- main-slider__navigation -->

                    </div>
                </div>
            </div>

            <!--
                Главный слайдер. Группа полей: Главный слайдер, рубрика Главные события (main_events).
                Поля:
                    1. Картинка (main_slider_image) - image.
                    2. Описание слайда
             -->
            <div class="slider__wrapper">

                <?php
                    $main_slides = get_posts( [
                        'numberposts' => -1,
                        'post_type' => "post",
                        'category_name' => 'main_events',
                        'orderby' => 'ID',
                        'order' => 'ASC',
                        'suppress_filters' => true
                    ] );

                    foreach( $main_slides as $post ):
                        setup_postdata( $post );
                ?>
                    <div
                    class="slider__slide main-slider"
                    style="background-image: url(<?php the_field('main_slider_image'); ?>);">

                    <div class="container">
                        <div class="row">
                            <div class="col-xl-5 offset-xl-7 col-12">

                                <div class="slide-data">
                                    <div class="slide-data__info-block">
                                        <a
                                            class="slide-data__date-block"
                                            href="<?php  echo get_permalink(); ?>">
                                            <span class="slide-data__date-day"><?php the_field('main_slider_event-dates'); ?></span>
                                            <span class="slide-data__date-month"><?php the_field('main_slider_event-month'); ?></span>
                                            <span class="slide-data__date-year"><?php the_field('main_slider_event-year'); ?></span>
                                        </a> <!-- main-slider__date-block -->
                                        <div class="slide-data__text-block">
                                            <a class="slide-data__link"
                                               href="<?php  echo get_permalink(); ?>">
                                                <h4><?php the_title(); ?></h4>
                                            </a>
                                            <p><?php the_field('main_slider_text'); ?></p>
                                            <span><?php the_field('main_slider_event-place'); ?></span>
                                        </div> <!-- main-slider__text-block -->
                                    </div> <!-- main-slider__info-block -->
                                </div> <!-- main-slider__slide-data -->

                            </div>
                        </div>
                    </div>

                </div> <!-- main-slider__slide-item -->
                <?php
                    endforeach;
                    wp_reset_postdata();
                ?>
            </div> <!-- main-slider__wrapper -->
        </div> <!-- main-slider -->
        <!-- Слайдер: конец -->

    </section> <!-- main-events -->

    <section class="main-content">

        <div class="container">
            <div class="row">
                <div class="col-12">

                    <!--
                        Блок с описанием основного контента страницы. Группа полей: Общая информация.
                        Поля:
                            1. Основной текст (main-content_description) - textarea.
                     -->
                    <div class="main-content__description">
                        <p>
                            <?php the_field('main-content_description'); ?>
                        </p>
                    </div> <!-- info-about__main-description -->

                </div>
            </div>

            <!--
                Главные инфо-блоки. Группа полей: Главные инфо-блоки, рубрика Главные инфо-блоки (main_info_blocks)
                Поля:
                    1. Изображение блока (main_info_block-image) - image.
                    2. Текст блока (main_info_block-text) - textarea.
                    3. Подпись блока (main_info_block-sun) - text.
             -->
            <div class="row">

                <?php
                    $main_info_blocks = get_posts( [
                        'numberposts' => -1,
                        'post_type' => 'post',
                        'category_name' => 'main_info_blocks',
                        'orderby' => 'ID',
                        'order' => 'ASC',
                        'suppress_filters' => true
                    ] );

                    foreach( $main_info_blocks as $post ) {
                        setup_postdata( $post );

                        $main_info_block_image = get_field('main_info_block-image');
                ?>
                    <div class="col-xl-4 col-lg-4">

                        <div class="info-item info-item--default">
                            <div class="info-item__image">
                                <img
                                    src="<?php echo $main_info_block_image['url']; ?>"
                                    alt="<?php echo $main_info_block_image['alt']; ?>"
                                    title="<?php the_title(); ?>">
                            </div>
                            <div class="info-item__description">
                                <a href="<?php echo get_permalink(); ?>">
                                    <h3 class="info-item__title"><?php the_title(); ?></h3>
                                </a>
                                <p class="info-item__text"><?php the_field('main_info_block-text') ?></p>
                                <a class="button button--info" href="<?php echo get_permalink(); ?>">Learn more</a>
                                <span class="info-item__event-label"><?php the_field('main_info_block-sub') ?></span>
                            </div> <!-- info-item__description -->
                        </div> <!-- info-item -->

                    </div>
                <?php
                    }
                    wp_reset_postdata();
                ?>

            </div>
            <div class="row">
                <div class="col-12">

                    <div class="info-buttons  btn-wrapper btn-wrapper--center">
                        <a class="button button--dark" href="page_registration.html">register now</a>
                        <button class="button button--deep-dark" data-action="popup-form">subscribe</button>
                    </div>

                </div>
            </div>
        </div>

    </section> <!-- main-content -->

    <section class="costumer-reviews common-section">

        <div class="container">
            <div class="row">
                <div class="col-12">

                    <h2 class="common-section__header">costumer reviews</h2>

                </div>
            </div>
        </div>

        <div class="slider slider--reviews_slider">

            <div class="container">
                <div class="row">
                    <div class="col-12 flex">

                        <div class="slider__navigation">
                            <button class="slider__prev"></button>
                            <button class="slider__next"></button>
                        </div> <!-- reviews_slider__navigation -->

                        <!--
                            Слайд на половину контейнера,
                            тут можно и без бутстрап-колонок внутри.

                            Слайдер отзывов. Группа полей: Слайдер отзывов, рубрика: Отзывы пользователей (user_reviews)
                            Поля:
                                1. Фотография пользователя (user_image) - image.
                                2. Текст отзыва (review_text) - textarea.
                         -->

                        <div class="slider__wrapper">

                            <?php
                                $reviews_slides = get_posts( [
                                    'numberposts' => -1,
                                    'post_type' => 'post',
                                    'category_name' => 'user_reviews',
                                    'orderby' => 'date',
                                    'order' => 'ASC',
                                    'suppress_filters' => true
                                ] );

                                foreach( $reviews_slides as $post ) {
                                    setup_postdata( $post );

                                    // Подготовка изображения
                                    $user_image = get_field('user_image');
                                    $user_image_data = ($user_image) ?
                                        [
                                            'url' => $user_image['url'],
                                            'alt' => $user_image['alt'],
                                        ] :
                                        [
                                            'url' => 'http://topforum/wp-content/uploads/2020/08/costumer_reviews.jpg',
                                            'alt' => 'Аватарка отсутствует',
                                        ];

                                    // Подготовка даты
                                    $review_date = explode( '-', explode( ' ', $post->post_date )[0] );
                                    $month_name = get_month_name( (int) $review_date[1] );
                                ?>

                            <div class="slider__slide response-slide">
                                <div class="response-slide__costumer-image">
                                    <img
                                        src="<?php echo $user_image_data['url']; ?>"
                                        alt="<?php echo $user_image_data['alt']; ?>"
                                        title="<?php the_title(); ?>">
                                </div>
                                <div class="response-slide__costumer-response">
										<span class="response-slide__costumer-name">
											<?php the_title(); ?>
										</span>
                                    <span class="response-slide__response-date">
											<span class="response-slide__day"><?php echo $review_date[2]; ?></span>
											<span class="response-slide__month"><?php echo $month_name; ?></span>
											<span class="response-slide__year"><?php echo $review_date[0]; ?></span>
										</span>
                                    <p><?php the_field('review_text'); ?></p>
                                </div> <!-- reviews_slider__costumer-response -->
                            </div> <!-- reviews_slider__slide -->

                            <?php
                                }
                                wp_reset_postdata();
                            ?>
                        </div> <!-- reviews_slider__wrapper -->
                    </div>
                </div>
            </div>

        </div> <!-- reviews_slider -->

    </section> <!-- costumer-reviews -->

    <section class="promo-video common-section">
        <h2 class="common-section__header">promo video</h2>
        <div class="promo-video__video">
            <!--
                Промо видео. Группа полей: Общая информация, вкладка "Промо видео".
                Поля:
                    1. Видеофайл (video_file) - file.
                    2. Постер (video_poster) - image.
             -->
            <video
                controls
                poster="<?php the_field('video_poster'); ?>">
                <source src="<?php echo get_field('video_file')['url']; ?>">
                <span>
						К сожалению, Ваш браузер не поддерживает <b>HTML5 видео</b>,
						можете скачать сам видео файл по <a href="<?php echo get_field('video_file')['link']; ?>">ссылке</a>
					</span>
            </video>
        </div> <!-- promo-video__video -->
    </section> <!-- promo-video -->

    <section class="our-clients common-section">
        <h2 class="common-section__header">our clients</h2>

        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="slider slider--clients-slider">

                        <div class="slider__navigation">
                            <button class="slider__prev"></button>
                            <button class="slider__next"></button>
                        </div> <!-- clients-slider__navigation -->

                        <!--
                            Слайдер клиентов. Группа полей: Слайдер клиентов, рубрика: Наши клиенты (our_clients).
                            Поля:
                                1. Изображение слайда (client_slide_image) - image.
                                2. Ссылка на компанию клиента (client_slide_link) - link.
                         -->
                        <div class="slider__wrapper">

                            <?php
                                $clients_slides = get_posts( [
                                    'numberposts' => -1,
                                    'post_type' => "post",
                                    'category_name' => 'our_clients',
                                    'orderby' => 'date',
                                    'order' => 'ASC',
                                    'suppress_filters' => true
                                ] );

                                foreach( $clients_slides as $post ) {
                                    setup_postdata( $post );
                                    // Подготовка изображения:
                                    $client_slide_image = get_field('client_slide_image');
                            ?>
                                <div class="slider__slide">
                                    <a href="<?php the_field('client_slide_link'); ?>">
                                        <img
                                            src="<?php echo $client_slide_image['url']; ?>"
                                            alt="<?php echo $client_slide_image['alt']; ?>"
                                            title="<?php the_title(); ?>">
                                    </a>
                                </div> <!-- clients-slider__slide -->
                            <?php
                                }
                                wp_reset_postdata();
                            ?>

                        </div> <!-- clients-slider__wrapper -->
                    </div> <!-- clients-slider -->

                </div>
            </div>
        </div>

    </section> <!-- our-clients -->

</div> <!-- page-main-content -->
<?php
    get_footer();
?>
