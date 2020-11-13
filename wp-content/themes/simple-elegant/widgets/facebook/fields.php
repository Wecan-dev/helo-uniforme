<?php
$fields = array(
    array(
        'id' => 'title',
        'type' => 'text',
        'name' => esc_html__( 'Title', 'simple-elegant' ),
        'std' => 'Like Us',
    ),
);

$fields[] = array(
    'id' => 'url',
    'type' => 'text',
    'name' => 'Fanpage URL',
    'std' => 'https://www.facebook.com/withemes',
    'placeholder' => 'https://www.facebook.com/your_fanpage/',
);

$fields[] = array(
    'id' => 'showfaces',
    'type' => 'checkbox',
    'name' => 'Show Faces?',
);

$fields[] = array(
    'id' => 'stream',
    'type' => 'checkbox',
    'name' => 'Stream?',
);

$fields[] = array(
    'id' => 'header',
    'type' => 'checkbox',
    'name' => 'Header?',
);