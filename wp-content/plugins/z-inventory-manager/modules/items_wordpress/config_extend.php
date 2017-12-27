<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
$alias['/items/model']		= 'model';
$alias['/items/presenter']	= 'presenter';

$after['/items/form@-init']	= 'form@extend-init';
$after['/items/validator@prepare']	= 'validator@extend-prepare';

$alias['/items/controller/update']	= 'controller/update';

$after['/root/controller@link-check']	= 'controller/rewrite@extend-link-check';
