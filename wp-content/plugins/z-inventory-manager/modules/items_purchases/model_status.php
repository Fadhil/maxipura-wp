<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Purchases_Model_Status_IM_HC_MVC extends _HC_MVC
{
	public function extend_get( $return, $args, $src )
	{
		$item = array_shift( $args );
		$item_id = $item['id'];

	// get purchases of this item
		$purchase_obj = $this->make('/purchases/model');

		$api = $this->make('/http/lib/api')
			->request('/api/purchases')
			;
		$api
			->add_param('items', $item_id)
			->add_param('status', array('<>', $purchase_obj->_const('STATUS_DRAFT')))
			->add_param('with', '-all-')
			;

		$purchases = $api
			->get()
			->response()
			;

		$t = $this->make('/app/lib')->run('time');
		$purchase_presenter = $this->make('/purchases/presenter');
		$manager = $this->make('/purchases_items/model/manager');

		$need_qty = 0;
		$purchased = 0;

		foreach( $purchases as $e ){
			if( ! $e['items'] ){
				continue;
			}
			if( ! isset($e['items'][$item_id]) ){
				continue;
			}

			$purchased += $e['items'][$item_id]['_qty'];

			$need_items = $manager->run('need-items', $e);
			if( ! isset($need_items[$item_id]) ){
				continue;
			}
			$need_qty += $need_items[$item_id];
		}

		$return['purchased'] = array(
			HCM::__('Purchased'),
			$purchased
			);

		if( $purchased ){
			$return['to-receive'] = array(
				HCM::__('To Receive'),
				$need_qty
				);
		}

	// average cost
		$total_qty = 0;
		$total_cost = 0;
		$latest_cost = NULL;

		reset( $purchases );
		foreach( $purchases as $e ){
			if( ! $e['items'] ){
				continue;
			}
			if( ! isset($e['items'][$item_id]) ){
				continue;
			}

			$this_qty = $e['items'][$item_id]['_qty'];
			$this_cost = $e['items'][$item_id]['_price'];

			$total_qty += $this_qty;
			$total_cost += $this_qty * $this_cost;

			if( $latest_cost === NULL ){
				$latest_cost = $this_cost;
			}
		}

		if( $total_qty ){
			$finance = $this->make('/finance/lib/calc');
			$average_cost = $finance
				->reset()
				->add( $total_cost / $total_qty )
				->format()
				;

			$latest_cost = $finance
				->reset()
				->add( $latest_cost )
				->format()
				;

			$return['average-cost'] = array(
				HCM::__('Weighted Average Cost'),
				$average_cost
				);
			$return['latest-cost'] = array(
				HCM::__('Latest Unit Cost'),
				$latest_cost
				);
		}
		
		return $return;
	}
}