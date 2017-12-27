<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
$before['/receives_purchases/view/index/menubar@render'] = 'view/menubar@remove-menubar';
$after['/receives_purchases/view/index/header@render'] = 'view/header@extend-render';

$before['/receives_purchases/view/zoom/menubar@render'] = 'view/menubar@remove-menubar';
$after['/receives_purchases/view/zoom/header@render'] = 'view/header@extend-render';

