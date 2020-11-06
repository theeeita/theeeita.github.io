<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="description" content="<?php bloginfo('description'); ?>">

    <!-- title вида: Название сайта | Заголовок страницы -->
	<title>
        <?php the_title( get_bloginfo('name') . " | " ) ?>
    </title>

	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri();  ?>/assets/dist/libs/html5shiv/es5-shim.min.js"></script>
		<script src="<?php echo get_template_directory_uri();  ?>/assets/dist/libs/html5shiv/html5shiv.min.js"></script>
		<script src="<?php echo get_template_directory_uri();  ?>/assets/dist/libs/html5shiv/html5shiv-printshiv.min.js"></script>
		<script src="<?php echo get_template_directory_uri();  ?>/assets/dist/libs/respond/respond.min.js"></script>
	<![endif]-->

    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=<?php echo the_field('api_key') ?>" type="text/javascript"></script>
    <link rel="icon"
          href="<?php bloginfo("template_url"); ?>/assets/dist/images/optimized/favicon/favicon.ico">
    <?php
        wp_head();
    ?>
</head>
<body>

	<!-- Кнопка "Вверх" -->
	<a href="#header-top" class="button--up"></a>

	<header class="main-header" id="header-top">
		<div class="main-header__top-line">

			<div class="container">
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-12">
                        <!-- Главное меню -->
						<nav class="main-menu">
                            <?php
                                wp_nav_menu([
                                    'menu' => 'header__main_menu',
                                    'container' => false,
                                    'echo' => true,
                                    'items_wrap' => '<ul class="main-menu__list">%3$s</ul>',
                                    'depth' => 2,
                                ]);
                            ?>
						</nav> <!-- main-menu main-header__main-menu -->

					</div>
					<div class="col-xl-2 offset-xl-6 col-lg-3 offset-lg-5 col-12">
						<div class="btn-wrapper-center">
							<a class="button button--light" href="#">top forum club</a> <!-- button -->
						</div> <!-- btn-wrapper-center -->
					</div>
				</div>
			</div>

		</div> <!-- main-header__top-line -->
		<div class="main-header__content">

			<div class="container">
				<div class="row">
					<div class="col-xl-2 col-lg-3 col-12">

                        <!--
                            Логотип. custom_logo + группа полей: Общая информация.
                            Поля:
                                1. Ярлык компании (main_label) - text.
                         -->
						<div class="logo">
							<a class="logo__link" href="<?php echo get_home_url(); ?>">
								<img class="logo__image"
									 src="<?php
                                        $logo_image_url = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0];
                                        echo $logo_image_url;
                                     ?>"
									 alt="<?php the_field('main_label'); ?>"
                                     title="<?php the_field('main_label'); ?>">
							</a>
						</div> <!-- logo -->

					</div>
					<div class="col-xl-5 col-lg-5 col-12">
						<ul class="main-header__submenu">
							<li class="main-header__list-item">
								<a href="http://topforum/blizhajshie-sobytiya/">
									<span class="icon-item">
										<img class="icon-item__image"
											 src="<?php bloginfo("template_url"); ?>/assets/dist/images/optimized/icons/events.png"
											 alt="events">
									</span><!-- icon-item -->
                                    upcoming events
                                </a>
							</li>
							<li class="main-header__list-item">
								<a href="http://topforum/kontakty/">
									<span class="icon-item">
										<img class="icon-item__image"
											 src="<?php bloginfo("template_url"); ?>/assets/dist/images/optimized/icons/contacts.png"
											 alt="contacts">
									</span><!-- icon-item -->
                                    contacts
                                </a>
							</li>
						</ul> <!-- main-header__submenu -->
					</div>
					<div class="col-xl-2 offset-xl-3 col-lg-3 offset-lg-1 col-12">
						<div class="btn-wrapper btn-wrapper--center">
							<a class="button button--dark" href="http://topforum/registracziya/">register now</a>
						</div> <!-- btn-wrapper-center -->
					</div>
				</div>
			</div>

		</div> <!-- main-header__content -->
	</header> <!-- main-header -->