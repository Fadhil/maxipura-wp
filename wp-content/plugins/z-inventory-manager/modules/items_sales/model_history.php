<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Sales_Model_History_IM_HC_MVC extends _HC_MVC
{
	public function extend_prepare( $return, $args, $src )
	{
		$item_id = array_shift( $args );

	// get sales of this item
		$api = $this->make('/http/lib/api')
			->request('/api/sales')
			;
		$api
			->add_param('items', $item_id)
			->add_param('with', '-all-')
			;
		$sales = $api
			->get()
			->response()
			;

		$t = $this->make('/app/lib')->run('time');
		$sale_presenter = $this->make('/sales/presenter');
		$finance = $this->make('/finance/lib/calc');

		foreach( $sales as $e ){
			if( ! $e['items'] ){
				continue;
			}
			if( ! isset($e['items'][$item_id]) ){
				continue;
			}

			$qty = $e['items'][$item_id]['_qty'];
			$price_each = $e['items'][$item_id]['_price'];

			$price_each = $finance
				->reset()
				->add( $price_each )
				->format()
				;

			$price_total = $finance
				->reset()
				->add( $qty * $price_each )
				->format()
				;

			$entry = array();
			$sale_presenter->set_data( $e );

		// timestamp
			$t->setDateDb( $e['date'] );
			$timestamp = $t->getTimestamp();

		// description
			$sale_title = $sale_presenter->present_title();
			$sale_title = $this->make('/html/view/link')
				->to('/sales/zoom', array('id' => $e['id']))
				->add( $sale_title )
				->always_show()
				;

/* translators: sales order item operation description,  for example, Added 22 pc to SO-321, $10 each, $2200 total */
			$description = sprintf( HCM::__('Added %s to %s, %s each, %s total'), $qty, $sale_title, $price_each, $price_total );

			$entry[] = $timestamp;
			$entry[] = $description;

			$return[] = $entry;
		}

		return $return;
	}
}