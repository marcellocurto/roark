<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
        <?php PG_Helper::rememberShownPost(); ?>
        <article <?php post_class( 'post-wrapper single-page' ); ?> id="post-<?php the_ID(); ?>" style="<?php echo 'background-color:' . get_field( 'background_color' ) . ';background-image:linear-gradient(to ' . get_field( 'direction_color' ) . ', ' . get_field( 'background_color' ) . ', ' . get_field( 'background_color_right' ) . ');'; ?>">
            <section class="title-wrapper">
                <h1 class="title-single-page"><?php the_title(); ?></h1>
                <?php                       $cats = array();                       foreach (get_the_category($post_id) as $c){                         $cat = get_category($c);                         array_push($cats, $cat->name);                       }                       $post_categories = implode(' / ', $cats);                         if (sizeOf($cats) > 0){                           echo '<div class="category-wrapper"><p>' . $post_categories. '</p></div>';                            } ?>
            </section>
            <div class="image-wrapper image-single image-about">
                <?php echo PG_Image::getPostImage( null, 'large', array(
                        'class' => 'attachment-medium size-medium wp-post-image wp-post-image wp-post-image wp-post-image',
                        'sizes' => '(max-width: 1024px) 100vw, 1024px'
                ), null, null ) ?>
            </div>
            <div class="contact-wrapper contact-single">
                <?php if ( get_field( 'facebook' ) ) : ?>
                    <span class="icon-wrapper"><a href="<?php echo esc_url( get_field( 'facebook' ) ); ?>" target="_blank"> <i class="fab fa-facebook"></i> </a></span>
                <?php endif; ?>
                <?php if ( get_field( 'instagram' ) ) : ?>
                    <span class="icon-wrapper"><a href="<?php echo esc_url( get_field( 'instagram' ) ); ?>" target="_blank"> <i class="fab fa-instagram"></i> </a></span>
                <?php endif; ?>
                <?php if ( get_field( 'linkedin' ) ) : ?>
                    <span class="icon-wrapper"><a href="<?php echo esc_url( get_field( 'linkedin' ) ); ?>" target="_blank"> <i class="fab fa-linkedin"></i> </a></span>
                <?php endif; ?>
                <?php if ( get_field( 'email' ) ) : ?>
                    <span class="icon-wrapper"><a href="<?php echo esc_url( 'mailto:' . get_field( 'email' ) ); ?>" target="_blank"> <i class="far fa-envelope"></i> </a></span>
                <?php endif; ?>
            </div>
            <div class="content-wrapper">
                <?php the_content(); ?>
            </div>
        </article>
    <?php endwhile; ?>
<?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.', 'roark_agency_theme' ); ?></p>
<?php endif; ?>

<?php get_footer(); ?>