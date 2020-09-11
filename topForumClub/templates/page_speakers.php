<?php
/**
 * Template Name: Наши спикеры
 */

get_header();
?>
<div class="page-main-content">

        <section class="our-speakers common-section">
            <h2 class="common-section__header">our speakers</h2>

            <div class="container">
                <div class="row">
                    <div class="col-12">

                        <div class="common-section__content">
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                            </p>
                        </div> <!-- our-sponsors__text-content -->

                    </div>
                </div>
                <div class="row">
                    <div class="col-12">

                        <div class="our-speakers__selection">
                            <form class="form-default  our-speakers__form">
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
                                                $option_text = get_field('conference_name');
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
                            </form> <!-- our-speakers__form -->
                        </div> <!-- our-speakers__selection -->

                    </div>
                </div>
                <div class="row">
                    <!--
                        Блок с элементами info-item--speaker
                     -->

                    <?php
                        $speakers = get_posts( [
                            'numberposts' => -1,
                            'post_type' => "post",
                            'category_name' => 'speakers',
                            'orderby' => 'date',
                            'order' => 'ASC',
                            'suppress_filters' => true
                        ] );

                        foreach( $speakers as $post ) {
                            setup_postdata( $post );
                            get_template_part( "template_parts/tmp", "speaker" );
                        }

                        wp_reset_postdata();
                    ?>

                </div>
            </div>

        </section> <!-- our-sponsors -->

    </div> <!-- page-main-content -->
<?php
    get_footer();
