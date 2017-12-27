<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Purchases_Model_History_IM_HC_MVC extends _HC_MVC
{
	public function extend_prepare( $return, $args, $src )
	{
		$item_id = array_shift( $args );

	// get purchases of this item
		$api = $this->make('/http/lib/api')
			->request('/api/purchases')
			;
		$api
			->add_param('items', $item_id)
			->add_param('with', '-all-')
			;
		$purchases = $api
			->get()
			->response()
			;

		$t = $this->make('/app/lib')->run('time');
		$purchase_presenter = $this->make('/purchases/presenter');
		$finance = $this->make('/finance/lib/calc');

		foreach( $purchases as $e ){
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
			$purchase_presenter->set_data( $e );

		// timestamp
			$t->setDateDb( $e['date'] );
			$timestamp = $t->getTimestamp();

		// description
			$purchase_title = $purchase_presenter->present_title();
			$purchase_title = $this->make('/html/view/link')
				->to('/purchases/zoom', array('id' => $e['id']))
				->add( $purchase_title )
				->always_show()
				;

/* translators: purchase item operation description,  for example, Added 22 pc to PO-321, $10 each, $2200 total */
			$description = sprintf( HCM::__('Added %s to %s, %s each, %s total'), $qty, $purchase_title, $price_each, $price_total );

			$entry[] = $timestamp;
			$entry[] = $description;

			$return[] = $entry;
		}

		return $return;
	}
}