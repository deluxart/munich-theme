<div class="item">
	<div class="image"><?php the_post_thumbnail(); ?></div>
	<div class="info">
		<ul>
			<li><?php echo get_the_date(); ?></li>
            <?php $posttags = get_the_tags(); ?>
            <?php if( $posttags ){ ?>
            <li><span><?php the_tags('', ', ', '<br />'); ?></li>
            <?php } ?>
		</ul>
	</div>
	<a href="<?php the_permalink() ?>" class="title"><?php the_title(); ?></a>
	<div class="text">
        <p><?php 
            $my_excerpt = get_the_excerpt();
                if ( $my_excerpt ){
                    echo wpautop( $my_excerpt );
                } 
            ?>
        </p>
	</div>
	<a href="<?php the_permalink() ?>" class="read-more">read <img src="<?php echo get_template_directory_uri(); ?>/src/img/article_arrow.svg" alt=""></a>
</div>