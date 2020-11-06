<?php
    // Подготовка изображения:
    $sponsor_image = [
        'url' => get_field('sponsor_image')['url'],
        'alt' => get_field('sponsor_image')['alt']
    ];
?>

<div class="info-item info-item--sponsor">
    <h2 class="info-item__type"><?php the_field('sponsor_type'); ?></h2>
    <div class="info-item__image">
        <img
            src="<?php echo $sponsor_image['url']; ?>"
            alt="<?php echo $sponsor_image['alt']; ?>"
            title="<?php the_title(); ?>">
    </div>
    <div class="info-item__description">
        <a href="<?php the_field('sponsor_link') ?>"><h3 class="info-item__title"><?php the_title(); ?></h3></a>
        <p class="info-item__text">
            <?php the_field('sponsor_text'); ?>
        </p>
        <a class="button button--info" href="<?php echo get_permalink(); ?>">Learn more</a>
    </div> <!-- info-item__description -->
</div> <!-- info-item--sponsor -->