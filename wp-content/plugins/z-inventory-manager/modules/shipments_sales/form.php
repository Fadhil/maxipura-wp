<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Shipments_Sales_Form_IM_HC_MVC extends _HC_Form
{
	public function _init()
	{
		$this
			->set_input( 'date',
				$this->make('/form/view/date')
					->set_label( HCM::__('Dispatch Date') )
				)

			->set_input( 'carrier',
				$this->make('/form/view/text')
					->set_label( HCM::__('Carrier') )
				)

			->set_input( 'track_no',
				$this->make('/form/view/text')
					->set_label( HCM::__('Tracking Number') )
				)

			->set_input( 'description',
				$this->make('/form/view/textarea')
					->set_label( HCM::__('Comments') )
						->add_attr('cols', 40)
						->add_attr('rows', 3)
				)

			->set_input( 'items',
				$this->make('input/items')
					->set_label( HCM::__('Items') )
				)

			;

		return $this;
	}

	public function to_model( $values )
	{
		$return = array();

		$take = array('date', 'carrier', 'track_no', 'description');
		foreach( $take as $t ){
			if( array_key_exists($t, $values) ){
				$return[$t] = $values[$t];
			}
		}

		if( ! (isset($values['items']) && $values['items']) ){
			return $return;
		}

		$return['items'] = array();
		foreach( $values['items'] as $item_id => $item_details ){
			if( $item_details['qty'] <= 0 ){
				continue;
			}
			$return['items'][$item_id] = $item_details;
		}

		return $return;
	}

	// public function from_model( $values )
	// {
		// $return = array();

		// $take = array('date', 'ref', 'description', 'status');
		// foreach( $take as $t ){
			// if( array_key_exists($t, $values) ){
				// $return[$t] = $values[$t];
			// }
		// }
		// return $return;
	// }
}