<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
$before['/purchases/view/index/menubar@render'] = 'view/menubar@remove-menubar';
$after['/purchases/view/index/header@render'] = 'view/header@extend-render';

$before['/purchases/view/zoom/menubar@render'] = 'view/menubar@remove-menubar';
$after['/purchases/view/zoom/header@render'] = 'view/header@extend-render';

