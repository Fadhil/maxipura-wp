<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
$after['/items/model@save'] 	= 'controller/message@extend-message';
$after['/items/model@delete']	= 'controller/message@extend-message';
