<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
$config['/purchases/model']['has_many']['receives'] = array(
	'their_class'	=> '/receives/model',
	'my_name'		=> 'purchase',
	'relation_name'	=> 'receive_to_purchase',
	);
$config['/receives/model']['belongs_to_one']['purchase'] = array(
	'their_class'	=> '/purchases/model',
	'my_name'		=> 'receives',
	'relation_name'	=> 'receive_to_purchase',
	);
