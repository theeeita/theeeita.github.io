<?php
    /**
     * Template Name: Ближайшие события
     */

    get_header();
?>

<div class="page-main-content">

    <section class="activities-events common-section">
        <h2 class="common-section__header">our events</h2>

        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="common-section__content">
                        <?php the_field('activities_description'); ?>
                    </div> <!-- common-section__content -->

                </div>
            </div>

            <?php
                $activities = get_posts( [
                    'numberposts' => -1,
                    'post_type' => "post",
                    'category_name' => 'activities',
                    'orderby' => 'date',
                    'order' => 'ASC',
                    'suppress_filters' => true
                ] );

                foreach( $activities as $post ) {
                    setup_postdata( $post );
                    get_template_part( 'template_parts/tmp', 'activity' );
                }

                wp_reset_postdata();
            ?>

        </div>

    </section> <!-- activities-events -->

</div> <!-- page-main-content -->
<?php
    get_footer();