<?php
comment_form();
wp_list_comments(array(
    'style' => 'ul',
    'type' => 'comment',
    'avatar_size' => '0',
    'format' => 'html5',
));
