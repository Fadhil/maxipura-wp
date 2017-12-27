<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
$after['/root/controller@link-check']		= 'controller@extend-link-check';
$after['/users/model@options']					= 'model/user@extend-options';
$before['/users/model@fetch-read'] 				= 'model/user@before-fetch-read';