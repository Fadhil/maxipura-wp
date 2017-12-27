<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
$after['/purchases/model@save'] 	= 'controller/message@extend-message';
$after['/purchases/model@delete']	= 'controller/message@extend-message';
