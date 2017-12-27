<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Purchases_Items_View_Extend_Purchases_Index_IM_HC_MVC extends _HC_MVC
{
	public function extend_prepare_header( $return )
	{
		// $return['items'] = HCM::__('Items');
		$return['total'] = HCM::__('Total');
		return $return;
	}

	public function extend_prepare_row( $return, $args )
	{
		$purchase = array_shift( $args );

		$return['items'] = 0;
		$return['total'] = 0;

		$items = $purchase['items'];

		if( ! $items ){
			return $return;
		}

		// $return['items'] = count($items);

		$calc = $this->make('/finance/lib/calc');
		foreach( $items as $item ){
			$calc->add( $item['_qty'] * $item['_price'] );
		}
		$total_price = $calc->result();
		$return['total'] = $total_price;
		$return['total_view'] = $calc->format();

		return $return;
	}
}