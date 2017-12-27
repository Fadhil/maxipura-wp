<?php
/*
 * Plugin Name: Z Inventory Manager
 * Plugin URI: http://www.z-inventory-manager.com
 * Description: Manage your inventory - keep track of purchases, sales, transfers.
 * Version: 1.0.1
 * Author: hitcode.com
 * Author URI: http://www.hitcode.com/
 * Text Domain: z-inventory-manager
 * Domain Path: /languages/
*/

if (! defined('ABSPATH')) exit; // Exit if accessed directly

if( file_exists(dirname(__FILE__) . '/db.php') ){
	$nts_no_db = TRUE;
	include_once( dirname(__FILE__) . '/db.php' );
	$happ_path = NTS_DEVELOPMENT2;
}
else {
	$happ_path = dirname(__FILE__) . '/happ2';
}

include_once( $happ_path . '/lib-wp/hcWpBase6.php' );

class Z_Inventory_Manager extends hcWpBase6
{
	public function __construct()
	{
		parent::__construct(
			array('z-inventory-manager', 'im'),	// app
			__FILE__	// path,
			);

		add_action(	'init', array($this, '_this_init') );
		add_action( 'admin_print_styles', array($this, 'print_styles') );
		add_action( 'wp_enqueue_scripts', array($this, 'print_styles') );
	}

	public function _this_init()
	{
		$this->hcapp_start();
	}
}

$hcim = new Z_Inventory_Manager();
