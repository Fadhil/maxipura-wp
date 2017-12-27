<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
$after['/sales/form@-init']			= 'form@extend-init';
$after['/sales/form@to-model']		= 'form@extend-to-model';
$after['/sales/form@from-model']	= 'form@extend-from-model';

$after['/sales/validator@prepare']	= 'validator@extend-prepare';

$after['/sales/view/index@prepare-header']	= 'view/extend/sales/index@extend-prepare-header';
$after['/sales/view/index@prepare-row']		= 'view/extend/sales/index@extend-prepare-row';
$after['/sales/view/index@prepare-footer']	= 'view/extend/sales/index@extend-prepare-footer';
