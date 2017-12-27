<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
$before['/conf/controller@form'] = 'controller@before-form';
// $after['/conf/controller@form'] = 'form@-init';

$before['/app/lib/settings@get'] = 'controller@settings-before-get';


