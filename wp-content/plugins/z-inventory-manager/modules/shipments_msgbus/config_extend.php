<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
$after['/shipments/model@save'] 	= 'controller/message@extend-message';
$after['/shipments/model@delete']	= 'controller/message@extend-message';
