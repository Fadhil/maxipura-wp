<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
$config['/purchases/model']['has_many']['items'] = array(
	'their_class'	=> '/items/model',
	'my_name'		=> 'purchases',
	'relation_name'	=> 'item_to_purchase',
	'relation_meta'	=> array('qty', 'price'),
	);
$config['/items/model']['belongs_to_many']['purchases'] = array(
	'their_class'	=> '/purchases/model',
	'my_name'		=> 'items',
	'relation_name'	=> 'item_to_purchase',
	'relation_meta'	=> array('qty', 'price'),
	);
