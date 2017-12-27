<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
$config['finance:_label'] = HCM::__('Finance');

$demoPrice = 54321;
$formats = array(
	'.||,',
	'.|| ',
	',|| ',
	'.||',
	',||',
	',||.',
	);
reset( $formats );
$format_options = array();
foreach( $formats as $f ){
	list( $decPoint, $thousandSep ) = explode( '||', $f );
	$format_options[ $f ] = number_format($demoPrice, 2, $decPoint, $thousandSep);
}

$config['finance:currency_format'] = array(
	'default' 	=> '.||,',
	'label'		=> HCM::__('Currency Format'),
	'type'		=> 'dropdown',
	'options'	=> $format_options,
	);
