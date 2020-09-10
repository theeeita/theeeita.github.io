<?php

    /**
     * Возвращает название месяца на русском языке в родительном падеже.
     * @param integer $number Номер месяца (1 - 12)
     * @return string
     */
    function get_month_name( $number ) {
            $month = [
                '1' => 'января',
                '2' => 'февраля',
                '3' => 'марта',
                '4' => 'апреля',
                '5' => 'мая',
                '6' => 'июня',
                '7' => 'июля',
                '8' => 'августа',
                '9' => 'сентября',
                '10' => 'октября',
                '11' => 'ноября',
                '12' => 'декабря' ];

            return $month[ $number ];
        }

    /**
     * Форматирует номер телефона: Преобразует строку "XXXXXXXXXXXX" в строку " + XXX XXX XXX XXX".
     * @param  string $digits Строка с 12 цифрами.
     * @return string
     */
    function format_phone( $digits ) {
        $temp_parts = str_split( $digits, 3 );
        return "+ " . implode( " ", $temp_parts );
    }

    /**
     * Добавляет необходимые ресурсы на сайт для работы темы.
     * Случит оберткой для top_forum_styles и top_forum_scripts.
     */
    function top_forum_assets() {
            top_forum_styles();
            top_forum_scripts();
        }

        function top_forum_styles() {
                wp_enqueue_style( 'main-styles', get_template_directory_uri() . '/assets/dist/css/main.min.css' );
            } // Добавляет css файлы.

        function top_forum_scripts() {
            wp_enqueue_script( 'main-scripts', get_template_directory_uri() . '/assets/dist/js/main.min.js', [], null, true );
        } // Добавляет js файлы.

    /**
     * Изменяет атрибуты элементов li в меню на сайте (во всех меню, что есть).
     * @param array $classes Классы li
     * @param WP_Post $item Элемент li
     * @param stdClass $args Объект с аргументами из функции wp_nav_menu()
     * @param integer $depth - глубина вложенности
     * @return mixed
     */
    function nav_menu_li_attributes( $classes, $item, $args, $depth ) {
        if( $args->menu === 'header__main_menu' ) {
            $classes[] = ( $depth === 0 ) ? 'main-menu__list-item': 'main-menu__sublist-item';
        }

        if( $args->menu === 'footer_menu' ) {
            $classes[] = 'main-menu__list-item';
        }

        return $classes;
    }

        /**
         * @param array $classes Классы вложенного ul
         * @param stdClass $args Объект с аргументами из функции wp_nav_menu()
         * @param integer $depth глубина вложенности
         * @return mixed
         */
        function submenu_ul_class( $classes, $args, $depth ) {
            $classes[] = 'main-menu__submenu';
            return $classes;
        }

    // Добавление основных css и js файлов на сайт:
    add_action( 'wp_enqueue_scripts',  'top_forum_assets' );

    // Работа с логотипом:
    add_theme_support( 'custom-logo' );

    // Добавление меню на сайт
    add_theme_support('menus');
    add_filter( 'nav_menu_css_class', 'nav_menu_li_attributes', 10, 4 );
    add_filter( 'nav_menu_submenu_css_class', 'submenu_ul_class', 10, 3 );

