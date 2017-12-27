<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
$after['/purchases/model@to-array'] = 'model@extend-to-array';

$after['/purchases/view/zoom/menubar@render'] = 'view/zoom/menubar@extend-render';
$after['/purchases_items/model/manager@need-items'] = 'model/manager@extend-need-items';
