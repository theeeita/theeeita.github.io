<?php
    $activity_image = get_field('activity_preview');
    $activity_date = get_field('activity_month') . " " . get_field('activity_year');

    $item_class = ( get_field('activity_sold') === 'spare' ) ? "activities-events__item" : "activities-events__item--sold activities-events__item";
?>

<div class="<?php echo $item_class; ?>">

    <div class="row">
        <div class="col-xl-4 col-lg-4 col-12">

            <div class="activities-events__item-image">
                <img
                    src="<?php echo $activity_image['url']; ?>"
                    alt="<?php echo $activity_image['alt']; ?>"
                    title="<?php the_title(); ?>">
            </div> <!-- activities-events__item-image -->

        </div>
        <div class="col-xl-8 col-lg-8 col-12">

            <div class="activities-events__item-description">
                <h3 class="activities-events__item-title"><?php the_title(); ?></h3>
                <span class="activities-events__item-subtitle">
									<span class="activities-events__item-sub activities-events__item-sub--date"><?php echo $activity_date; ?></span>
									<span class="activities-events__item-sub activities-events__item-sub--type"><?php the_field('activity_type'); ?></span>
								</span> <!-- activities-events__item-subtitle -->
                <p class="activities-events__item-text"><?php the_field('activity_description'); ?></p>
                <a class="button button--light" href="<?php echo get_permalink(); ?>">Learn more</a>
            </div> <!-- activities-events__item-description -->

        </div>
    </div>

</div> <!-- activities-events__item -->
