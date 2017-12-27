<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
$after['/items/model/manager@item-count'] = 'model/manager@extend-item-count';
$after['/items/model/history@prepare'] = 'model/history@extend-prepare';