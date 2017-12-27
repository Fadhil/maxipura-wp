<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
$config['/shipments/model']['has_many']['items'] = array(
	'their_class'	=> '/items/model',
	'my_name'		=> 'shipments',
	'relation_name'	=> 'item_to_shipment',
	'relation_meta'	=> array('qty'),
	);
$config['/items/model']['belongs_to_many']['shipments'] = array(
	'their_class'	=> '/shipments/model',
	'my_name'		=> 'items',
	'relation_name'	=> 'item_to_shipment',
	'relation_meta'	=> array('qty'),
	);
