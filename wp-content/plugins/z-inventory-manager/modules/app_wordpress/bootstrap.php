<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class App_Wordpress_Bootstrap_IM_HC_MVC extends _HC_MVC
{
	public function run()
	{
		add_action( 'admin_menu', array($this, 'admin_menu') );
		return $this;
	}

	public function admin_menu()
	{
		$app_short_name = $this->app_short_name();
		$default_title = isset($this->app->app_config['nts_app_title']) ? $this->app->app_config['nts_app_title'] : 'Resource Booker';
		$title = get_site_option( $app_short_name . '_menu_title', $default_title );
		if( ! strlen($title) ){
			$title = $default_title;
		}

		$ret = add_submenu_page(
			$app_short_name,			// parent
			$title,				// page_title
			$title,				// menu_title
			'read',						// capability
			$app_short_name,		// menu_slug
			'__return_null'
			);
		remove_submenu_page( $app_short_name, $app_short_name );
	}
}