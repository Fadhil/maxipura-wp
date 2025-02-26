<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Validate_Required_HC_MVC extends _HC_MVC
{
	public function validate( $value )
	{
		$return = TRUE;
		$msg = HCM::__('Required Field');

		if( is_null($value) ){
			$return = $msg;
		} elseif( is_string($value) && trim($value) === '' ){
			$return = $msg;
		} elseif( is_array($value) && count($value) < 1 ){
			$return = $msg;
		}
		return $return;
	}

	public function render( $return )
	{
		$return
			->add_attr('required', 'required')
			;
		return $return;
	}
}