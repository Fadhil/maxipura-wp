<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
$config['app_version'] = '1.0.1';
$config['dbprefix_version'] = 'v1';

$config['modules'] = array(
	'app',
	'utf8',
	'http',
	'html',
	'input',
	'form',
	'validate',
	'security',
	'encrypt',
	'session',

	'datetime',
	'datepicker',

	'msgbus',
	'flashdata',
	'layout',
	'root',
	'setup',
	'acl',
	'icons',
	// 'icons-chars',
	// 'icons-simple-line',
	'icons-dashicons',

	'code-snippets',
	'conf',
	'auth',

	'users',
	'print',
	'recur-dates',
	// 'algo',
	// 'evastorage',
	'ormrelations',

	'search',

	// 'locations',
	// 'locations-selector',
	'items',
	'items-selector',

	// 'amoves',
	'purchases',

	'receives',
	'shipments',

	'sales',
	'finance',
	// 'suppliers',
	);
