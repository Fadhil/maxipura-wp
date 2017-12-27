<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Purchases_Receives_Model_Manager_IM_HC_MVC extends _HC_MVC
{
	public function received_items( $purchase )
	{
		if( ! isset($purchase['id']) ){
			return $return;
		}

		$api = $this->make('/http/lib/api')
			->request('/api/receives')
			->add_param('purchase', $purchase['id'])
			->add_param('with', 'items')
			;
		$receives = $api
			->get()
			->response()
			;

		$return = array();
		foreach( $receives as $r ){
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

	// get receives of this item
		$api = $this->make('/http/lib/api')
			->request('/api/receives')
			;

		$api
			->add_param('with', 'items')
			->add_param('items', $item_id)
			;

		$receives = $api
			->get()
			->response()
			;

		$received = 0;
		foreach( $receives as $r ){
			$this_received = 0;
			if( ! $r['items'] ){
				continue;
			}
			$this_items = $r['items'];

			if( ! isset($this_items[$item_id]) ){
				continue;
			}
			$this_received = $this_items[$item_id]['_qty'];
			$received += $this_received;
		}

		$return += $received;
		return $return;
	}
}