<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Sales_Shipments_Model_Manager_IM_HC_MVC extends _HC_MVC
{
	public function extend_need_items( $return, $args, $src )
	{
		$sale = array_shift( $args );
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

		foreach( $shipments as $r ){
			if( ! $r['items'] ){
				continue;
			}
			foreach( $r['items'] as $e ){
				if( isset($return[$e['id']]) ){
					$return[$e['id']] = $return[$e['id']] - $e['_qty'];
					if( $return[$e['id']] <= 0 ){
						unset($return[$e['id']]);
					}
				}
			}
		}

		return $return;
	}
}