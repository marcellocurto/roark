<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
        <?php PG_Helper::rememberShownPost(); ?>
        <article <?php post_class( 'post-wrapper' ); ?> id="post-<?php the_ID(); ?>" style="<?php echo 'background-color:' . get_field( 'background_color' ) . ';background-image:linear-gradient(to ' . get_field( 'direction_color' ) . ', ' . get_field( 'background_color' ) . ', ' . get_field( 'background_color_right' ) . ');'; ?>">
            <div class="post-part-1">
                <a href="<?php echo esc_url( get_permalink() ); ?>"><h1><?php the_title(); ?></h1></a>
                <div class="category-wrapper">
                    <p><?php $cats = array(); foreach (get_the_category($post_id) as $c) { $cat = get_category($c); array_push($cats, $cat->name); } if (sizeOf($cats) > 0) { $post_categories = implode(' / ', $cats); } else { $post_categories = ''; } echo $post_categories; ?></p>
                </div>
                <div class="excerpt-wrapper">
                    <p><?php echo get_the_excerpt(); ?></p>
                </div>
                <?php if ( !is_post_type_archive( 'about' ) ) : ?>
                    <div class="contact-wrapper">
                        <?php if ( get_field( 'facebook' ) ) : ?>
                            <span class="icon-wrapper"><a href="<?php echo esc_url( get_field( 'facebook' ) ); ?>" target="_blank"> <i class="fab fa-facebook"></i> </a></span>
                        <?php endif; ?>
                        <?php if ( get_field( 'instagram' ) ) : ?>
                            <span class="icon-wrapper"><a href="<?php echo esc_url( get_field( 'instagram' ) ); ?>" target="_blank"> <i class="fab fa-instagram"></i> </a></span>
                        <?php endif; ?>
                        <?php if ( get_field( 'linkedin' ) ) : ?>
                            <span class="icon-wrapper"><a href="<?php echo esc_url( get_field( 'linkedin' ) ); ?>" target="_blank"> <i class="fab fa-linkedin-in"></i> </a></span>
                        <?php endif; ?>
                        <?php if ( get_field( 'email' ) ) : ?>
                            <span class="icon-wrapper"><a href="<?php echo esc_url( 'mailto:' . get_field( 'email' ) ); ?>" target="_blank"> <i class="far fa-envelope"></i> </a></span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <div class="more-wrapper">
                    <span class="icon-wrapper"><a href="<?php echo esc_url( get_permalink() ); ?>"> <i class="fas fa-arrow-right"></i> </a></span>
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
<?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.', 'roark_agency_theme' ); ?></p>
<?php endif; ?>
<?php if ( PG_Pagination::isPaginated() ) : ?>
    <div class="pagination">
        <?php if( PG_Pagination::getCurrentPage() > 1 ) : ?>
            <a class="pagination-link" <?php echo PG_Pagination::getPreviousHrefAttribute(); ?>><i class="fas fa-chevron-left"></i></a>
        <?php endif; ?>
        <div>
            <span><?php echo PG_Pagination::getCurrentPage(); ?></span>
            <span> / </span>
            <span><?php echo PG_Pagination::getMaxPages(); ?></span>
        </div>
        <?php if( PG_Pagination::getCurrentPage() < PG_Pagination::getMaxPages() ) : ?>
            <a class="pagination-link" <?php echo PG_Pagination::getNextHrefAttribute(); ?>><i class="fas fa-chevron-right"></i></a>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php get_footer(); ?>