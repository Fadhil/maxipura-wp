<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Sales_Validator_IM_HC_MVC extends _HC_Validator
{
	public function prepare( $values )
	{
		$return = array();
		$id = isset($values['id']) ? $values['id'] : NULL;

		$return['date'] = array(
			'required'	=> array( $this->make('/validate/required') ),
			);

		$return['ref'] = array();
		$app_settings = $this->make('/app/lib/settings');
		if( ! $app_settings->get('sales:ref_auto_gen') ){
			$return['ref']['required'] = array( $this->make('/validate/required') );
		}
		$return['ref']['maxlen'] = array( $this->make('/validate/maxlen'), 100 );
		$return['ref']['unique'] = array( $this->make('/validate/unique'), 'sales', 'ref', $id );

		return $return;
	}
}