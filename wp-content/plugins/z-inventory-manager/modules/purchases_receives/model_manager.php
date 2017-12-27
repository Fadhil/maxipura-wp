<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Purchases_Receives_Model_Manager_IM_HC_MVC extends _HC_MVC
{
	public function extend_need_items( $return, $args, $src )
	{
		$purchase = array_shift( $args );
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

		foreach( $receives as $r ){
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