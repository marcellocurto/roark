<?php
wp_list_comments([
    'style'       => 'ul',
    'type'        => 'comment',
    'avatar_size' => '32',
    'format'      => 'html5',
]);

$comment_form_args = [
    'title_reply' => 'Write a Comment',
];
comment_form($comment_form_args);
