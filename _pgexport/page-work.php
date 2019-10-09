<?php
/*
 Template Name: Work
 Template Post Type: post, page
*/
?>
<?php get_header(); ?>

<?php
    $work_args = array(
        'post_type' => 'work',
        'posts_per_page' => 2,
        'paged' => get_query_var( 'paged' ) ?: 1,
        'order' => 'ASC',
        'orderby' => 'date'
    )
?>
<?php $work = new WP_Query( $work_args ); ?>
<?php if ( $work->have_posts() ) : ?>
    <?php while ( $work->have_posts() ) : $work->the_post(); ?>
        <?php PG_Helper::rememberShownPost(); ?>
        <article <?php post_class( 'post-wrapper' ); ?> id="post-<?php the_ID(); ?>" style="background-image: linear-gradient(to right, <?php echo get_field( 'background_color' ) . ' , ' . get_field( 'background_color_right' ) . ');'; ?>:<?php echo get_field( 'a' ); ?>;">
            <div class="post-part-1">
                <a href="<?php echo esc_url( get_permalink() ); ?>"><h1><?php the_title(); ?></h1></a>
                <div class="category-wrapper">
                    <p><?php $cats = array(); foreach (get_the_category($post_id) as $c) { $cat = get_category($c); array_push($cats, $cat->name); } if (sizeOf($cats) > 0) { $post_categories = implode(' / ', $cats); } else { $post_categories = 'Not Assigned'; } echo $post_categories; ?></p>
                </div>
                <div class="excerpt-wrapper">
                    <p><?php echo get_the_excerpt(); ?></p>
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
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
<?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.', 'roark_agency_theme' ); ?></p>
<?php endif; ?>
<?php if ( PG_Pagination::isPaginated($work) ) : ?>
    <div class="pagination">
        <?php if( PG_Pagination::getCurrentPage() > 1 ) : ?>
            <a class="pagination-link" <?php echo PG_Pagination::getPreviousHrefAttribute( $work ); ?>><i class="fas fa-chevron-left"></i></a>
        <?php endif; ?>
        <div>
            <span><?php echo PG_Pagination::getCurrentPage(); ?></span>
            <span> / </span>
            <span><?php echo PG_Pagination::getMaxPages( $work ); ?></span>
        </div>
        <?php if( PG_Pagination::getCurrentPage() < PG_Pagination::getMaxPages( $work ) ) : ?>
            <a class="pagination-link" <?php echo PG_Pagination::getNextHrefAttribute( $work ); ?>><i class="fas fa-chevron-right"></i></a>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php get_footer(); ?>