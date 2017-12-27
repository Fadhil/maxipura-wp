<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Purchases_Items_Model_Manager_IM_HC_MVC extends _HC_MVC
{
	public function need_items( $purchase )
	{
		$return = array();

		if( ! (isset($purchase['items']) && $purchase['items']) ){
			return $return;
		}

		$items = $purchase['items'];
		foreach( $items as $e ){
			$return[ $e['id'] ] = $e['_qty'];
		}
		return $return;
	}
}