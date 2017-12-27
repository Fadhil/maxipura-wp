<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Sales_Model_Status_IM_HC_MVC extends _HC_MVC
{
	public function extend_get( $return, $args, $src )
	{
		$item = array_shift( $args );
		$item_id = $item['id'];

	// get sales of this item
		$sale_obj = $this->make('/sales/model');

		$api = $this->make('/http/lib/api')
			->request('/api/sales')
			;
		$api
			->add_param('items', $item_id)
			->add_param('status', array('<>', $sale_obj->_const('STATUS_DRAFT')))
			->add_param('with', '-all-')
			;

		$sales = $api
			->get()
			->response()
			;

		$t = $this->make('/app/lib')->run('time');
		$sale_presenter = $this->make('/sales/presenter');
		$manager = $this->make('/sales_items/model/manager');

		$need_qty = 0;
		$sold = 0;

		foreach( $sales as $e ){
			if( ! $e['items'] ){
				continue;
			}
			if( ! isset($e['items'][$item_id]) ){
				continue;
			}

			$sold += $e['items'][$item_id]['_qty'];

			$need_items = $manager->run('need-items', $e);
			if( ! isset($need_items[$item_id]) ){
				continue;
			}
			$need_qty += $need_items[$item_id];
		}

		$return['sold'] = array(
			HCM::__('Sold'),
			$sold
			);

		if( $sold ){
			$return['to-ship'] = array(
				HCM::__('To Ship'),
				$need_qty
				);
		}

		if( $need_qty ){
			$have = 0;
			if( isset($return['available']) ){
				$have += $return['available'][1];
			}
			if( isset($return['to-receive']) ){
				$have += $return['to-receive'][1];
			}

			if( $have < $need_qty ){
				$return['backorder'] = array(
					$this->make('/html/view/icon')->icon('exclamation') . HCM::__('To Purchase to Fill Sales'),
					($need_qty - $have)
					);
			}
		}


	// average cost
		$total_qty = 0;
		$total_price = 0;
		$latest_price = NULL;

		reset( $sales );
		foreach( $sales as $e ){
			if( ! $e['items'] ){
				continue;
			}
			if( ! isset($e['items'][$item_id]) ){
				continue;
			}

			$this_qty = $e['items'][$item_id]['_qty'];
			$this_price = $e['items'][$item_id]['_price'];

			$total_qty += $this_qty;
			$total_price += $this_qty * $this_price;

			if( $latest_price === NULL ){
				$latest_price = $this_price;
			}
		}

		if( $total_qty ){
			$finance = $this->make('/finance/lib/calc');
			$average_price = $finance
				->reset()
				->add( $total_price / $total_qty )
				->format()
				;

			$latest_price = $finance
				->reset()
				->add( $latest_price )
				->format()
				;

			$return['average-price'] = array(
				HCM::__('Weighted Average Price'),
				$average_price
				);
			$return['latest-price'] = array(
				HCM::__('Latest Unit Price'),
				$latest_price
				);
		}
		
		return $return;
	}
}