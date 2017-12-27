<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Sales_Items_Model_Manager_IM_HC_MVC extends _HC_MVC
{
	public function need_items( $sale )
	{
		$return = array();

		if( ! (isset($sale['items']) && $sale['items']) ){
			return $return;
		}

		$items = $sale['items'];
		foreach( $items as $e ){
			$return[ $e['id'] ] = $e['_qty'];
		}
		return $return;
	}
}