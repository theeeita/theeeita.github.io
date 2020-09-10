<div class="col-xl-4 col-lg-4 col-md-6 col-sm-8 col-12">
    <div class="info-item info-item--media">
        <div class="info-item__image">
            <img
                src="<?php echo get_field('article_preview')['url']; ?>"
                alt="<?php echo get_field('article_preview')['alt']; ?>">
        </div>
        <div class="info-item__description">
            <a href="#"><h3 class="info-item__title"><?php the_title(); ?></h3></a>
            <p class="info-item__text"><?php echo get_field('article_short_description'); ?></p>
        </div> <!-- info-item__description -->
    </div>
</div>