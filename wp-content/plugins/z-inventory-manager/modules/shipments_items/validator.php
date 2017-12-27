<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Shipments_Items_Validator_IM_HC_MVC extends _HC_Validator
{
	public function extend_prepare( $return, $args, $src )
	{
		$values = array_shift( $args );

		$return['items'] = array(
			'required'	=> array( $this->make('/validate/required') )
			);

		return $return;
	}
}