<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Wordpress_Validator_IM_HC_MVC extends _HC_Validator
{
	public function extend_prepare( $return, $args, $src )
	{
		$values = array_shift( $args );

		unset( $return['title'] );
		unset( $return['description'] );

		return $return;
	}
}