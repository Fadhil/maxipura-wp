<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Sales_Shipments_Model_Manager_IM_HC_MVC extends _HC_MVC
{
	public function shipped_items( $sale )
	{
		if( ! isset($sale['id']) ){
			return $return;
		}

		$api = $this->make('/http/lib/api')
			->request('/api/shipments')
			->add_param('sale', $sale['id'])
			->add_param('with', 'items')
			;
		$shipments = $api
			->get()
			->response()
			;

		$return = array();
		foreach( $shipments as $r ){
			if( ! $r['items'] ){
				continue;
			}
			foreach( $r['items'] as $e ){
				if( ! isset($return[$e['id']]) ){
					$return[$e['id']] = 0;
				}
				$return[$e['id']] += $e['_qty'];
			}
		}

		return $return;
	}

	public function extend_item_count( $return, $args, $src )
	{
		$item_id = array_shift( $args );

	// get shipments of this item
		$api = $this->make('/http/lib/api')
			->request('/api/shipments')
			;

		$api
			->add_param('with', 'items')
			->add_param('items', $item_id)
			;

		$shipments = $api
			->get()
			->response()
			;

		$shipped = 0;
		foreach( $shipments as $e ){
			$this_shipped = 0;
			if( ! $e['items'] ){
				continue;
			}
			$this_items = $e['items'];

			if( ! isset($this_items[$item_id]) ){
				continue;
			}
			$this_shipped = $this_items[$item_id]['_qty'];
			$shipped += $this_shipped;
		}

		$return -= $shipped;
		return $return;
	}
}