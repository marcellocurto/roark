<?php
if (!function_exists('roark_agency_theme_setup')):

    function roark_agency_theme_setup()
    {
        load_theme_textdomain('roark_agency_theme', get_template_directory() . '/languages');

        add_theme_support('automatic-feed-links');

        add_theme_support('title-tag');

        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(825, 510, true);

        register_nav_menus(array(
            'main'   => __('Nav Menu', 'roark_agency_theme'),
            'footer' => __('Footer Menu', 'roark_agency_theme'),
        ));

        function roark_login_url($url)
        {
            return get_bloginfo('url');
        }
        add_filter('login_headerurl', 'roark_login_url', 10, 1);

        function roark_login_title()
        {
            return 'Roark';
        }
        add_filter('login_headertitle', 'roark_login_title', 10, 1);

        function roark_login_enqueue()
        {
            wp_enqueue_style('roark-login-font', 'https://use.typekit.net/bqf5yhx.css', array('login'));
            wp_enqueue_style('roark-login-style', get_stylesheet_directory_uri() . '/login.css', array('login'));
        }
        add_filter('login_enqueue_scripts', 'roark_login_enqueue', 10, 1);

        function roark_login_form()
        {
            echo '<a href="https://accounts.google.com/signin/oauth/oauthchooseaccount?response_type=code&redirect_uri=https%3A%2F%2Froark.at%2Fxo%2F&client_id=407692703194-0pe3je32bunlpn6dvgs9qfikv28rpck3.apps.googleusercontent.com&scope=openid%20email%20https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile&access_type=online&approval_prompt=auto&state=a2ea2f9249%257C&o2v=1&as=EZD9zSv3ovbzW_UZ0Vx7pg&flowName=GeneralOAuthFlow" class="login-button">Log in</a>';
            exit;
        }
        // add_filter('login_header', 'roark_login_form');

        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
        ));

        add_theme_support('post-formats', array(
            'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat',
        ));

        add_theme_support('align-wide');
        add_theme_support('responsive-embeds');
        add_theme_support('wp-block-styles');

        add_theme_support('editor-styles');
        add_editor_style('assets/editor-style.css');
        add_editor_style('https://use.typekit.net/bqf5yhx.css');

        add_action('wp_footer', function () {
            wp_dequeue_style('syntax-highlighting-code-block');
        });

        add_theme_support(
            'editor-color-palette',
            array(
                array(
                    'name'  => __('Black', 'roark_agency_theme'),
                    'slug'  => 'black',
                    'color' => '#000000',
                ),
                array(
                    'name'  => __('White', 'roark_agency_theme'),
                    'slug'  => 'white',
                    'color' => '#FFFFFF',
                ),
                array(
                    'name'  => __('Accent', 'roark_agency_theme'),
                    'slug'  => 'accent',
                    'color' => '#0000FF',
                ),
            )
        );

        function roark_js_async_attr($tag)
        {
            $scripts_to_include = array('gtag');
            foreach ($scripts_to_include as $include_script) {
                if (true == strpos($tag, $include_script)) {
                    return str_replace(' src', ' async="async" src', $tag);
                }
            }
            return $tag;
        }
        add_filter('script_loader_tag', 'roark_js_async_attr', 10);

        /*
         * Enable support for Page excerpts.
         */
        add_post_type_support('page', 'excerpt');
    }
endif; // roark_agency_theme_setup

add_action('after_setup_theme', 'roark_agency_theme_setup');

if (!function_exists('roark_agency_theme_init')):

    function roark_agency_theme_init()
    {

        // Use categories and tags with attachments
        register_taxonomy_for_object_type('category', 'attachment');
        register_taxonomy_for_object_type('post_tag', 'attachment');

        /*
         * Register custom post types. You can also move this code to a plugin.
         */

        /*
     * Register custom taxonomies. You can also move this code to a plugin.
     */
    }
endif; // roark_agency_theme_setup

add_action('init', 'roark_agency_theme_init');

if (!function_exists('roark_agency_theme_custom_image_sizes_names')):

    function roark_agency_theme_custom_image_sizes_names($sizes)
    {

        /*
         * Add names of custom image sizes.
         */
        return $sizes;
    }
    add_action('image_size_names_choose', 'roark_agency_theme_custom_image_sizes_names');
endif; // roark_agency_theme_custom_image_sizes_names

if (!function_exists('roark_agency_theme_widgets_init')):

    function roark_agency_theme_widgets_init()
    {
    }
    add_action('widgets_init', 'roark_agency_theme_widgets_init');
endif; // roark_agency_theme_widgets_init

if (!function_exists('roark_agency_theme_customize_register')):

    function roark_agency_theme_customize_register($wp_customize)
    {
        // Do stuff with $wp_customize, the WP_Customize_Manager object.
    }
    add_action('customize_register', 'roark_agency_theme_customize_register');
endif; // roark_agency_theme_customize_register

if (!function_exists('roark_agency_theme_enqueue_scripts')):
    function roark_agency_theme_enqueue_scripts()
    {
        wp_register_script('roark_script', get_template_directory_uri() . '/assets/roark.js', null, null, true);
        wp_enqueue_script('roark_script');
        
        wp_deregister_style('typekitfonts');
        wp_register_style('typekitfonts', 'https://use.typekit.net/bqf5yhx.css', null, null, 'all');
        wp_enqueue_style('typekitfonts');

        wp_deregister_style('style');
        wp_enqueue_style('style', get_template_directory_uri() . '/style.css', false, null, 'all');
    }
    add_action('wp_enqueue_scripts', 'roark_agency_theme_enqueue_scripts');
endif;

function pgwp_sanitize_placeholder($input)
{
    return $input;
}

require_once "inc/wp_pg_helpers.php";
require_once "inc/wp_pg_pagination.php";
