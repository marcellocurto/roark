<article <?php post_class( 'post-wrapper' ); ?> id="post-<?php the_ID(); ?>" style="background-image: linear-gradient(to right, <?php echo get_field( 'background_color' ) . ' , ' . get_field( 'background_color_right' ) . ');'; ?>:<?php echo get_field( 'a' ); ?>;">
    <div class="post-part-1">
        <a href="<?php echo esc_url( get_permalink() ); ?>"><h1><?php the_title(); ?></h1></a>
        <div class="category-wrapper">
            <p><?php $cats = array(); foreach (get_the_category($post_id) as $c) { $cat = get_category($c); array_push($cats, $cat->name); } if (sizeOf($cats) > 0) { $post_categories = implode(' / ', $cats); } else { $post_categories = 'Not Assigned'; } echo $post_categories; ?></p>
        </div>
        <div class="excerpt-wrapper">
            <?php the_excerpt( ); ?>
        </div>
        <div class="date-wrapper">
            <p><?php echo get_the_time( 'Y' ) ?></p>
        </div>
    </div>
    <div class="post-part-2">
        <div class="image-wrapper">
            <a href="<?php echo esc_url( get_permalink() ); ?>"> <?php echo PG_Image::getPostImage( null, 'large', array(
                        'class' => 'attachment-medium size-medium wp-post-image wp-post-image wp-post-image wp-post-image',
                        'sizes' => '(max-width: 1024px) 100vw, 1024px'
                ), null, null ) ?> </a>
        </div>
    </div>
</article>