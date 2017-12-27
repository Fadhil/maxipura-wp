<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
$after['/receives/model@save'] 	= 'controller/message@extend-message';
$after['/receives/model@delete']	= 'controller/message@extend-message';
