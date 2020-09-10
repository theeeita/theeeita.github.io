<?php
    // Подготовка изображения:
    $speaker_image = [
        'url' => get_field('speaker_image')['url'],
        'alt' => get_field('speaker_image')['alt']
    ];
?>

<div class="col-xl-3 col-lg-6 col-md-6 col-12">

    <div class="info-item info-item--speaker">
        <div class="info-item__image">
            <img
                src="<?php echo $speaker_image['url'];  ?>"
                alt="<?php echo $speaker_image['alt'];  ?>"
                title="<?php the_title() ?>">
        </div>
        <div class="info-item__description">
            <a href="<?php the_field('speaker_link'); ?>"><h3 class="info-item__title"><?php the_title(); ?></h3></a>
            <p class="info-item__text"><?php the_field('speaker_text'); ?></p>
            <a class="button button--info" href="<?php echo get_permalink(); ?>">Learn more</a>
        </div> <!-- info-item__description -->
    </div> <!-- info-item--speaker -->

</div>