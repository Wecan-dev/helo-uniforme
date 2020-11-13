<?php
$params['rollover_background'] = array(
	'selector' => '.rollover-overlay',
	'property' => 'background-color',
	'dependency' => array(
		'element' => 'style',
		'value' => '1'
	),
);

$params['rollover_color'] = array(
	'selector' => '.wi-rollover',
	'property' => 'color',
	'dependency' => array(
		'element' => 'style',
		'value' => '1'
	),
);