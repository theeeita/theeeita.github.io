<?php
    // Подготовка изображения:
    $exhibitor_image = [
        'url' => get_field('exhibitor_image')['url'],
        'alt' => get_field('exhibitor_image')['alt']
    ];
?>

<div class="info-item info-item--exhibitor">
    <div class="info-item__image">
        <img
            src="<?php echo $exhibitor_image['url']; ?>"
            alt="<?php echo $exhibitor_image['alt']; ?>"
            title="<?php the_title(); ?>">
    </div>
    <div class="info-item__description">
        <a href="<?php the_field('exhibitor_link'); ?>"><h3 class="info-item__title"><?php the_title(); ?></h3></a>
        <p class="info-item__text"><? the_field('exhibitor_text'); ?></p>
        <a class="button button--info" href="<?php echo get_permalink(); ?>">Learn more</a>
    </div> <!-- info-item__description -->
</div> <!-- info-item--exhibitor -->
