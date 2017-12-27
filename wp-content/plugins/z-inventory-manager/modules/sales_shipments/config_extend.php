<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
$after['/sales/model@to-array'] = 'model@extend-to-array';
$after['/sales/presenter@present-status'] = 'presenter@extend-present-status';

$after['/sales/view/zoom/menubar@render'] = 'view/zoom/menubar@extend-render';
$after['/sales_items/model/manager@need-items'] = 'model/manager@extend-need-items';
