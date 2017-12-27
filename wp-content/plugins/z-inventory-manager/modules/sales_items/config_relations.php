<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
$config['/sales/model']['has_many']['items'] = array(
	'their_class'	=> '/items/model',
	'my_name'		=> 'sales',
	'relation_name'	=> 'item_to_sale',
	'relation_meta'	=> array('qty', 'price'),
	);
$config['/items/model']['belongs_to_many']['sales'] = array(
	'their_class'	=> '/sales/model',
	'my_name'		=> 'items',
	'relation_name'	=> 'item_to_sale',
	'relation_meta'	=> array('qty', 'price'),
	);
