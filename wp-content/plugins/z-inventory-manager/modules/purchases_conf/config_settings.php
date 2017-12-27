<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
$config['purchases:_label'] = HCM::__('Purchases');

$config['purchases:ref_auto_gen'] = array(
	'default' 	=> 1,
	);
$config['purchases:ref_prefix'] = array(
	'default' 	=> 'PO-',
	);
$config['purchases:ref_number_random'] = array(
	'default' 	=> 0,
	);