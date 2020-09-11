<?php
    /**
     * Template Name: Медиа
     */

    get_header();
?>

<div class="page-main-content">

    <section class="media-content common-section">
        <h2 class="common-section__header">articles from sponsors</h2>

        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="common-section__content">
                        <p><?php the_field('media_description'); ?></p>
                    </div>

                </div>
            </div>
            <div class="row">
                <!--

                 -->
                <div class="media-content__list common-section__list">

                    <?php
                        $main_post_per_page = 6;
                        $category = 'sponsors_articles';
                        $sponsors_articles = new WP_Query( [
                            'category_name' => $category,
                            'post_type' => 'post',
                            'posts_per_page' => $main_post_per_page,
                            'orderby'=> 'date',
                            'order' => 'ASC'
                        ] );

                        $destroy_count = $sponsors_articles->found_posts - $main_post_per_page;

                        while( $sponsors_articles->have_posts() ) {
                            $sponsors_articles->the_post();
                            get_template_part( 'template_parts/tmp', 'article' );
                        }

                        wp_reset_postdata();

                        $load_post_per_page = 3;
                        echo do_shortcode( "[ajax_load_more post_type='post' order='ASC' posts_per_page='$load_post_per_page' offset='$main_post_per_page' destroy_after='$destroy_count' category='$category' pause='true' scroll='false' button_label='More Articles' button_loading_label='Loading...' button_done_label='No Articles Remain']" );
                    ?>
                </div> <!-- common-section__list -->

            </div>
        </div>

    </section> <!-- our-sponsors -->

</div> <!-- page-main-content -->

<?php
    get_footer();
