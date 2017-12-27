<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
$config['/receives/model']['has_many']['items'] = array(
	'their_class'	=> '/items/model',
	'my_name'		=> 'receives',
	'relation_name'	=> 'item_to_receive',
	'relation_meta'	=> array('qty'),
	);
$config['/items/model']['belongs_to_many']['receives'] = array(
	'their_class'	=> '/receives/model',
	'my_name'		=> 'items',
	'relation_name'	=> 'item_to_receive',
	'relation_meta'	=> array('qty'),
	);
