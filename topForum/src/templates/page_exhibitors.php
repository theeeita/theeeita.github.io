<?php
    /**
     * Template Name: Наши представители
     */

    get_header();
?>
<div class="page-main-content">

    <section class="our-exhibitors common-section">
        <h2 class="common-section__header">our exhibitors</h2>

        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="common-section__content">
                        <p><?php the_field('exhibitors_text'); ?></p>
                    </div> <!-- our-sponsors__text-content -->

                </div>
            </div>
            <div class="row">
                <div class="col-12">

                    <div class="our-exhibitors__selection">
                        <form class="form-default  our-exhibitors__form">
                            <label>
                                <h3 class="form-default__header">please select a conference</h3>
                                <select class="form-default__select" name="conference">
                                    <?php
                                        $conferences = get_posts( [
                                            'numberposts' => -1,
                                            'post_type' => "post",
                                            'category_name' => 'conferences',
                                            'orderby' => 'date',
                                            'order' => 'ASC',
                                            'suppress_filters' => true
                                        ] );

                                        $selected = false;
                                        foreach( $conferences as $post ) {
                                            setup_postdata($post);
                                            $option_text = get_field('conference_name') . " " . get_field('conference_year');
                                    ?>
                                        <option value="<?php echo get_the_ID(); ?>"
                                            <?php
                                                if( get_field('is_selected') === 'on' && !$selected ) {
                                                    echo "selected";
                                                    $selected = true;
                                                }
                                            ?>
                                        >
                                                <?php echo $option_text; ?>
                                        </option>
                                            <?php
                                        }
                                        wp_reset_postdata();
                                    ?>
                                </select> <!-- form-default__select -->
                            </label>
                        </form> <!-- our-sponsors__form -->
                    </div> <!-- our-sponsors__selection -->

                </div>
            </div>
            <div class="row">

                <!--
                    В макете элементы расположены не по сетке, поэтому можно и без бутстрапа.
                    "row" нужен для того, чтобы "заключить" их в основную ширину сайта.
                 -->
                <div class="our-exhibitors__list common-section__list">

                    <?php
                        $exhibitors = get_posts( [
                            'numberposts' => -1,
                            'post_type' => "post",
                            'category_name' => 'exhibitors',
                            'orderby' => 'date',
                            'order' => 'ASC',
                            'suppress_filters' => true
                        ] );

                        foreach( $exhibitors as $post ) {
                            setup_postdata( $post );
                            get_template_part( 'template_parts/tmp', 'exhibitor' );
                        }

                        wp_reset_postdata();
                     ?>

                </div> <!-- our-exhibitors__list -->

            </div>
        </div>

    </section> <!-- our-sponsors -->

</div> <!-- page-main-content -->
<?php
    get_footer();

