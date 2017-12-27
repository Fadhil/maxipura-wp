<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
$config['/sales/model']['has_many']['shipments'] = array(
	'their_class'	=> '/shipments/model',
	'my_name'		=> 'sale',
	'relation_name'	=> 'shipment_to_sale',
	);
$config['/shipments/model']['belongs_to_one']['sale'] = array(
	'their_class'	=> '/sales/model',
	'my_name'		=> 'shipments',
	'relation_name'	=> 'shipment_to_sale',
	);
