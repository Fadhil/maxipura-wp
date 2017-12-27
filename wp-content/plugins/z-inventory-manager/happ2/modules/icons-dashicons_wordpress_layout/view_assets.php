<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Icons_Dashicons_Wordpress_Layout_View_Assets_HC_MVC extends _HC_MVC
{
	public function extend_css( $params )
	{
		$params['dashicons'] = 'dashicons';
		return $params;
	}
}