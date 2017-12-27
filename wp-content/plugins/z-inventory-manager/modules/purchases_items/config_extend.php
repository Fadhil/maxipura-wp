<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
// $after['/purchases/form@-init']			= 'form/purchase@extend-init';
// $after['/purchases/form@to-model']		= 'form/purchase@extend-to-model';
// $after['/purchases/form@from-model']	= 'form/purchase@extend-from-model';


$after['/purchases/form@-init']			= 'form@extend-init';
$after['/purchases/form@to-model']		= 'form@extend-to-model';
$after['/purchases/form@from-model']	= 'form@extend-from-model';

$after['/purchases/validator@prepare']	= 'validator@extend-prepare';

$after['/purchases/view/index@prepare-header']	= 'view/extend/purchases/index@extend-prepare-header';
$after['/purchases/view/index@prepare-row']		= 'view/extend/purchases/index@extend-prepare-row';
$after['/purchases/view/index@prepare-footer']	= 'view/extend/purchases/index@extend-prepare-footer';
