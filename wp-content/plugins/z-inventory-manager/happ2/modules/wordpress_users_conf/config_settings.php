<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
$config['wordpress_users:_label'] = HCM::__('Access Permissions');

$options = array(
	'none'	=> HCM::__('No Access'),
	// 'user'	=> HCM::__('User'),
	'admin'	=> HCM::__('Admin')
	);

$wp_roles = new WP_Roles();
$wordpress_roles = $wp_roles->get_names();

foreach( $wordpress_roles as $role_value => $role_name ){
	$default = 1;

	switch( $role_value ){
		case 'administrator':
			$config['wordpress_users:role_' . $role_value ] = array(
				'default' 	=> HCM::__('Admin'),
				'label'		=> $role_name,
				'type'		=> 'label',
				);
			break;

		default:
			$config['wordpress_users:role_' . $role_value ] = array(
				'default' 	=> 'none',
				'label'		=> $role_name,
				'type'		=> 'radio',
				'options'	=> $options,
				);
			break;
	}
}