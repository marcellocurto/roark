<?php get_header();?>

<?php if (have_posts()): ?>
<?php
$custom_css_light = '';
$custom_css_dark  = '';
?>

<?php while (have_posts()): the_post();?>
		<?php PG_Helper::rememberShownPost();?>
		<?php
    $id_of_post      = get_the_ID();
    $direction_color = get_field('direction_color');

    $field_light = get_field('light_colors');
    $left_light  = $field_light['background_color_left'];
    $right_light = $field_light['background_color_right'];

    if (empty($left_light)) {
        $left_light .= '#ffffff00';
    }

    if (empty($right_light)) {
        $right_light .= '#ffffff00';
    }

    $field_dark = get_field('dark_colors');
    $left_dark  = $field_dark['background_color_left'];
    $right_dark = $field_dark['background_color_right'];

    if (empty($left_dark)) {
        $left_dark .= '#ffffff00';
    }

    if (empty($right_dark)) {
        $right_dark .= '#ffffff00';
    }

// $custom_css_light .= '#post-' . $id_of_post . ' {background-image:linear-gradient(to ' . $direction_color . ', ' . $left_light . ', ' . $right_light . ')} ';

// $custom_css_dark .= '#post-' . $id_of_post . ' {background-image:linear-gradient(to ' . $direction_color . ', ' . $left_dark . ', ' . $right_dark . ')} ';

    $background_html_direction = $direction_color;
    if ('top' == $direction_color) {$background_html_direction = 'bottom';} elseif ('bottom' == $direction_color) {$background_html_direction = 'top';}

$custom_css_light .= 'html { background-color:' . $left_light . '; background-image:linear-gradient(to ' . $background_html_direction . ', ' . $left_light . ', ' . $right_light . ')}  body {background-color:' . $left_light . '; background-image:linear-gradient(to ' . $direction_color . ', ' . $left_light . ', ' . $right_light . ')} ';

$custom_css_dark .= 'html { background-color:' . $left_dark . '; background-image:linear-gradient(to ' . $background_html_direction . ', ' . $left_dark . ', ' . $right_dark . ')}  body {background-color:' . $left_dark . '; background-image:linear-gradient(to ' . $direction_color . ', ' . $left_dark . ', ' . $right_dark . ')} ';
?>

<article <?php post_class('post-wrapper single-page');?> id="post-<?php the_ID();?>"  <?php
if (get_field('language_of_posts') == 'de-DE') {
    echo 'lang="de-DE"';
}
?>>
    <section class="title-wrapper">
        <h1 class="title-single-page"><?php the_title();?></h1>
        <?php
$cats = array();
foreach (get_the_category($post_id) as $c) {
    $cat = get_category($c);
    array_push($cats, $cat->name);
}
$post_categories = implode(' / ', $cats);
if (sizeOf($cats) > 0) {
    echo '<div class="category-wrapper"><p>' . $post_categories . '</p></div>';
}
?>
    </section>
    <?php if (is_singular('about')): ?>

        <?php if (has_post_thumbnail()): ?>

    <div class="image-wrapper image-single image-about">
        <a href="<?php echo esc_url(get_permalink()); ?>">

        <picture>

        <?php
$image_sizes = 'large';
$image_dark  = get_field('night_image');

if ($image_dark) {
    $srcset_dark = wp_get_attachment_image_srcset($image_dark, $image_sizes);
    echo '<source media="(prefers-color-scheme: dark)" srcset="' . $srcset_dark . '">';
}
?>

        <?php echo get_the_post_thumbnail(null, $image_sizes); ?>

        </picture>

        </a>
    </div>

<?php endif;?>
    <?php endif;?>

    <?php if (is_singular('about')): ?>

        <div class="contact-wrapper contact-single">

        <?php if (get_field('facebook')): ?>
		            <span class="icon-wrapper">
                        <a href="<?php echo esc_url(get_field('facebook')); ?>" target="_blank">
                        <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook" class="svg-inline--fa fa-facebook fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"></path></svg>
                        </a>
                    </span>
		        <?php endif;?>

	        <?php if (get_field('instagram')): ?>
	            <span class="icon-wrapper">
                    <a href="<?php echo esc_url(get_field('instagram')); ?>" target="_blank"> 
                <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="instagram" class="svg-inline--fa fa-instagram fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></svg>
                    </a>
                </span>
	        <?php endif;?>

        <?php if (get_field('linkedin')): ?>
            <span class="icon-wrapper">
                <a href="<?php echo esc_url(get_field('linkedin')); ?>" target="_blank">
                <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="linkedin" class="svg-inline--fa fa-linkedin fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z"></path></svg>
                </a>
            </span>
        <?php endif;?>

        <?php if (get_field('github')): ?>
            <span class="icon-wrapper">
                <a href="<?php echo esc_url(get_field('github')); ?>" target="_blank">
                <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="github" class="svg-inline--fa fa-github fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path fill="currentColor" d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z"></path></svg>
                </a>
            </span>
        <?php endif;?>

        <?php if (get_field('email')): ?>
            <span class="icon-wrapper">
                <a href="<?php echo esc_url('mailto:' . get_field('email')); ?>" target="_blank"> 
            <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="envelope" class="svg-inline--fa fa-envelope fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M464 64H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V112c0-26.51-21.49-48-48-48zm0 48v40.805c-22.422 18.259-58.168 46.651-134.587 106.49-16.841 13.247-50.201 45.072-73.413 44.701-23.208.375-56.579-31.459-73.413-44.701C106.18 199.465 70.425 171.067 48 152.805V112h416zM48 400V214.398c22.914 18.251 55.409 43.862 104.938 82.646 21.857 17.205 60.134 55.186 103.062 54.955 42.717.231 80.509-37.199 103.053-54.947 49.528-38.783 82.032-64.401 104.947-82.653V400H48z"></path></svg>
                </a>
            </span>
        <?php endif;?>

        </div>

    <?php endif;?>

    <div class="content-wrapper">
        <?php the_content();?>
    </div>

    <?php if (get_post_type() === 'post'): ?>
    <section class="date-wrapper date-singular">
        <p><?php _e('Published on:', 'roark_agency_theme');?></p>
        <p><?php echo get_the_time('F jS Y'); ?></p>
    </section>
    <?php endif;?>

    <?php if (comments_open()): ?>
    <section id="comments">
        <h2>Comments</h2>
        <?php comments_template();?>
    </section>
    <?php endif;?>
</article>
<?php endwhile;?>

<?php else: ?>
    <p class="no-posts"><?php _e('Sorry, no posts matched your criteria.', 'roark_agency_theme');?></p>
<?php endif;?>



<?php
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
?>

<?php get_footer();?>