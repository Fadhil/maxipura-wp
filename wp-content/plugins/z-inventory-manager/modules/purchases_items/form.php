<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Purchases_Items_Form_IM_HC_MVC extends _HC_MVC
{
	public function extend_init( $return )
	{
		$return
			->set_input( 'items',
				$this->make('/items-selector/input')
					->set_price_field('cost')
					->set_label( HCM::__('Items') )
				)
			;

		return $return;
	}

	public function extend_to_model( $return, $args )
	{
		$values = array_shift( $args );
		if( ! array_key_exists('items', $values) ){
			return $return;
		}
		$return['items'] = $values['items'];
		return $return;
	}

	public function extend_from_model( $return, $args )
	{
		$values = array_shift( $args );
		if( ! array_key_exists('items', $values) ){
			return $return;
		}
		if( ! $values['items'] ){
			return $return;
		}

		$this_return = array();
		foreach( $values['items'] as $item_id => $item ){
			$this_return[ $item_id ] = array( 
				'qty'	=> $item['_qty'],
				'price'	=> $item['_price']
				);
		}

		$return['items'] = $this_return;
		return $return;
	}
}