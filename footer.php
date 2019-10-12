
</main>
<footer>
<a href="<?php echo esc_url(home_url()); ?>" class="footer-text-logo" rel="home"><?php bloginfo('name'); ?></a>
<span class="site-description"><?php bloginfo('description'); ?></span>
<?php wp_nav_menu(array(
    'menu' => 'footer',
    'menu_class' => 'menu',
    'menu_id' => 'menu-menu',
    'container' => 'ul',
)); ?>
</footer>
<?php wp_footer(); ?>
</body>
</html>
