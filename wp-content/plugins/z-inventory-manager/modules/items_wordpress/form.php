<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Wordpress_Form_IM_HC_MVC extends _HC_Form
{
	public function extend_init( $return, $args, $src )
	{
		$src
			->unset_input('title')
			->unset_input('description')
			;
		return $return;
	}
}