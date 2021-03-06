<?php get_header();?>

<?php
$work_query_args = array(
    'post_type'      => 'work',
    'posts_per_page' => 1,
    'order'          => 'DESC',
    'orderby'        => 'date',
)
?>
<?php $work_query = new WP_Query($work_query_args);?>
<?php if ($work_query->have_posts()): ?>
    <?php while ($work_query->have_posts()): $work_query->the_post();?>
		        <?php PG_Helper::rememberShownPost();?>
		        <article <?php post_class('post-wrapper');?> id="post-<?php the_ID();?>">
		            <div class="post-part-1">
		                <a href="/work"><h1><?php _e('Latest Work', 'roark_agency_theme');?></h1></a>
		                <div class="excerpt-wrapper">
		                    <?php the_excerpt();?>
		                </div>
		                <div class="more-wrapper more-front">
		                    <span class="icon-wrapper icon-more"><a href="/work" class="link-more"> <i class="fas fa-arrow-right"></i> </a></span>
		                </div>
		            </div>
		            <?php if (has_post_thumbnail()): ?>
		<div class="post-part-2">
		    <div class="image-wrapper">
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
		</div>
		<?php endif;?>
        </article>
    <?php endwhile;?>
    <?php wp_reset_postdata();?>
<?php endif;?>



<?php
$blog_query_args = array(
    'posts_per_page' => 1,
    'order'          => 'DESC',
    'orderby'        => 'date',
)
?>
<?php $blog_query = new WP_Query($blog_query_args);?>
<?php if ($blog_query->have_posts()): ?>
    <?php while ($blog_query->have_posts()): $blog_query->the_post();?>
		        <?php PG_Helper::rememberShownPost();?>
		        <article <?php post_class('post-wrapper');?> id="post-<?php the_ID();?>">
		            <div class="post-part-1">
		                <a href="/blog"><h1><?php _e('Blog', 'roark_agency_theme');?></h1></a>
		                <div class="excerpt-wrapper">
		                    <p><?php _e('Essays, tutorials & interviews.', 'roark_agency_theme');?></p>
		                </div>
		                <div class="more-wrapper more-front">
		                    <span class="icon-wrapper icon-more"><a href="/blog" class="link-more"> <i class="fas fa-arrow-right"></i> </a></span>
		                </div>
		            </div>
		            <?php if (has_post_thumbnail()): ?>
		<div class="post-part-2">
		    <div class="image-wrapper">
		        <a href="/blog">

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
		</div>
		<?php endif;?>
        </article>
    <?php endwhile;?>
    <?php wp_reset_postdata();?>
<?php endif;?>



<?php
$about_query_args = array(
    'post_type'      => 'about',
    'posts_per_page' => 1,
    'order'          => 'DESC',
    'orderby'        => 'date',
)
?>
<?php $about_query = new WP_Query($about_query_args);?>
<?php if ($about_query->have_posts()): ?>
    <?php while ($about_query->have_posts()): $about_query->the_post();?>
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

    $custom_css_light .= '#post-' . $id_of_post . ' {background-image:linear-gradient(to ' . $direction_color . ', ' . $left_light . ', ' . $right_light . ')} ';

    $custom_css_dark .= '#post-' . $id_of_post . ' {background-image:linear-gradient(to ' . $direction_color . ', ' . $left_dark . ', ' . $right_dark . ')} ';
    ?>
		        <article <?php post_class('post-wrapper');?> id="post-<?php the_ID();?>">
		            <div class="post-part-1">
		                <a href="/about"><h1><?php _e('About Us', 'roark_agency_theme');?></h1></a>
		                <div class="excerpt-wrapper">
		                    <?php the_excerpt();?>
		                </div>
		                <div class="contact-wrapper">
		                    <?php if (get_field('facebook')): ?>
		                        <span class="icon-wrapper"><a href="<?php echo esc_url(get_field('facebook')); ?>" target="_blank"> <i class="fab fa-facebook"></i> </a></span>
		                    <?php endif;?>
                    <?php if (get_field('instagram')): ?>
                        <span class="icon-wrapper"><a href="<?php echo esc_url(get_field('instagram')); ?>" target="_blank"> <i class="fab fa-instagram"></i> </a></span>
                    <?php endif;?>
                    <?php if (get_field('linkedin')): ?>
                        <span class="icon-wrapper"><a href="<?php echo esc_url(get_field('linkedin')); ?>" target="_blank"> <i class="fab fa-linkedin-in"></i> </a></span>
                    <?php endif;?>
                    <?php if (get_field('email')): ?>
                        <span class="icon-wrapper"><a href="<?php echo esc_url('mailto:' . get_field('email')); ?>" target="_blank"> <i class="far fa-envelope"></i> </a></span>
                    <?php endif;?>
                </div>
                <div class="more-wrapper">
                    <span class="icon-wrapper icon-more"><a href="/about" class="link-more"> <i class="fas fa-arrow-right"></i> </a></span>
                </div>
            </div>

<?php if (has_post_thumbnail()): ?>
<div class="post-part-2">
    <div class="image-wrapper">
        <a href="/about">

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
</div>
<?php endif;?>

        </article>
    <?php endwhile;?>
    <?php wp_reset_postdata();?>
<?php endif;?>

<?php get_footer();?>