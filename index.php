<?php
get_header();

if (have_posts()):

    $custom_css_light = '';
    $custom_css_dark = '';

    while (have_posts()): the_post();
        PG_Helper::rememberShownPost();
        $id_of_post = get_the_ID();
        $direction_color = get_field('direction_color');

        $field_light = get_field('light_colors');
        $left_light = $field_light['background_color_left'];
        $right_light = $field_light['background_color_right'];

        if (empty($left_light)) {
            $left_light .= '#ffffff00';
        }

        if (empty($right_light)) {
            $right_light .= '#ffffff00';
        }

        $field_dark = get_field('dark_colors');
        $left_dark = $field_dark['background_color_left'];
        $right_dark = $field_dark['background_color_right'];

        if (empty($left_dark)) {
            $left_dark .= '#ffffff00';
        }

        if (empty($right_dark)) {
            $right_dark .= '#ffffff00';
        }

        $custom_css_light .= '#post-' . $id_of_post . ' {background-image:linear-gradient(to ' . $direction_color . ', ' . $left_light . ', ' . $right_light . ')} ';

        $custom_css_dark .= '#post-' . $id_of_post . ' {background-image:linear-gradient(to ' . $direction_color . ', ' . $left_dark . ', ' . $right_dark . ')} ';
        ?>
																			        <article <?php post_class('post-wrapper'); ?> id="post-<?php the_ID(); ?>">
																			            <div class="post-part-1">
																			                <a href="<?php echo esc_url(get_permalink()); ?>"><h1><?php the_title(); ?></h1></a>
																			                <?php $cats = array();foreach (get_the_category($post_id) as $c) {$cat = get_category($c);
            array_push($cats, $cat->name);}
        $post_categories = implode(' / ', $cats);if (sizeOf($cats) > 0) {echo '<div class="category-wrapper"><p>' . $post_categories . '</p></div>';} ?>
																			                <div class="excerpt-wrapper">
																			                    <?php the_excerpt(); ?>
																			                </div>
																			                <?php if (is_post_type_archive('about')): ?>
																			                    <div class="contact-wrapper">
																			                        <?php if (get_field('facebook')): ?>
																			                            <span class="icon-wrapper"><a href="<?php echo esc_url(get_field('facebook')); ?>" target="_blank"> <i class="fab fa-facebook"></i> </a></span>
																			                        <?php endif; ?>
									                        <?php if (get_field('instagram')): ?>
									                            <span class="icon-wrapper"><a href="<?php echo esc_url(get_field('instagram')); ?>" target="_blank"> <i class="fab fa-instagram"></i> </a></span>
									                        <?php endif; ?>
                        <?php if (get_field('linkedin')): ?>
                            <span class="icon-wrapper"><a href="<?php echo esc_url(get_field('linkedin')); ?>" target="_blank"> <i class="fab fa-linkedin-in"></i> </a></span>
                        <?php endif; ?>
                        <?php if (get_field('email')): ?>
                            <span class="icon-wrapper"><a href="<?php echo esc_url('mailto:' . get_field('email')); ?>" target="_blank"> <i class="far fa-envelope"></i> </a></span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php if (!is_post_type_archive('about')): ?>
                    <div class="date-wrapper">
                        <p><?php echo get_the_time('Y'); ?></p>
                    </div>
                <?php endif; ?>
                <div class="more-wrapper">
                    <span class="icon-wrapper"><a href="<?php echo esc_url(get_permalink()); ?>"> <i class="fas fa-arrow-right"></i> </a></span>
                </div>
            </div>
            <div class="post-part-2">
                <div class="image-wrapper">
                    <a href="<?php echo esc_url(get_permalink()); ?>">

<?php
$size = 'large';
echo PG_Image::getPostImage(null, $size, array(
    'class' => 'image-post-' . $id_of_post . ' attachment-medium size-medium wp-post-image wp-post-image wp-post-image wp-post-image',
    'sizes' => '(max-width: 1024px) 100vw, 1024px',
), null, null)
;

$alternate_image = get_field('night_image');
if ($alternate_image) {
    $dark_image[] = wp_get_attachment_image($alternate_image, $size, array(
        'class' => 'image-post-' . $id_of_post . ' attachment-medium size-medium wp-post-image wp-post-image wp-post-image wp-post-image',
        'sizes' => '(max-width: 1024px) 100vw, 1024px'));
}
?>
                    </a>
                </div>
            </div>
        </article>
    <?php
endwhile;
else: ?>
    <p><?php _e('Sorry, no posts matched your criteria.', 'roark_agency_theme'); ?></p>
<?php
endif;
if (PG_Pagination::isPaginated()):
?>
    <div class="pagination">
        <?php if (PG_Pagination::getCurrentPage() > 1): ?>
            <a class="pagination-link" <?php echo PG_Pagination::getPreviousHrefAttribute(); ?>><i class="fas fa-long-arrow-alt-left"></i></a>
        <?php endif; ?>
        <div>
            <span><?php echo PG_Pagination::getCurrentPage(); ?></span>
            <span> / </span>
            <span><?php echo PG_Pagination::getMaxPages(); ?></span>
        </div>
        <?php if (PG_Pagination::getCurrentPage() < PG_Pagination::getMaxPages()): ?>
            <a class="pagination-link" <?php echo PG_Pagination::getNextHrefAttribute(); ?>><i class="fas fa-long-arrow-alt-right"></i></a>
        <?php endif; ?>
    </div>
<?php
endif;
if (!empty($custom_css_light) || !empty($custom_css_dark)) {
    add_action('custom_style_action', 'roark_enqueue_post_css', 10, 1);
    $custom_css = $custom_css_light . '@media (prefers-color-scheme: dark) {' . $custom_css_dark . '}';

    function roark_enqueue_post_css($css) {
        wp_register_style('roark-custom-post-style', false);
        wp_enqueue_style('roark-custom-post-style');
        wp_add_inline_style('roark-custom-post-style', $css);
    }

    do_action('custom_style_action', $custom_css);
}
print_r($dark_image);
get_footer();
?>