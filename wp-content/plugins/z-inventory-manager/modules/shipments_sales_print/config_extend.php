<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
$before['/shipments_sales/view/index/menubar@render'] = 'view/menubar@remove-menubar';
$after['/shipments_sales/view/index/header@render'] = 'view/header@extend-render';

$before['/shipments_sales/view/zoom/menubar@render'] = 'view/menubar@remove-menubar';
$after['/shipments_sales/view/zoom/header@render'] = 'view/header@extend-render';

