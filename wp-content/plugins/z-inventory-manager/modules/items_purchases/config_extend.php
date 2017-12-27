<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
$after['/items/model/history@prepare'] = 'model/history@extend-prepare';
$after['/items/model/status@get'] = 'model/status@extend-get';
