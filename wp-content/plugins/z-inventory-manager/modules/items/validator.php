<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Validator_IM_HC_MVC extends _HC_Validator
{
	public function prepare( $values )
	{
		$return = array();
		$id = isset($values['id']) ? $values['id'] : NULL;

		$return['title'] = array(
			'required'	=> array( $this->make('/validate/required') ),
			'maxlen'	=> array( $this->make('/validate/maxlen'), 100 ),
			'unique'	=> array( $this->make('/validate/unique'), 'items', 'title', $id ),
			);

		$return['ref'] = array(
			'required'	=> array( $this->make('/validate/required') ),
			'minlen'	=> array( $this->make('/validate/minlen'), 2 ),
			'unique'	=> array( $this->make('/validate/unique'), 'items', 'ref', $id ),
			);

		return $return;
	}
}