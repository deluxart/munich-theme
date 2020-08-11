<div class="product_item">
    <div class="image">
        <?php the_post_thumbnail( 'square-large' ); ?>
    </div>
    <div class="info">
        <a href="<?php the_permalink() ?>"><h3><?php the_title(); ?></h3></a>
        <p><?php the_field( 'short_description_product', $post ); ?></p>
        <div><a href="<?php the_permalink() ?>" class="btn border">order</a></div>
    </div>
</div>