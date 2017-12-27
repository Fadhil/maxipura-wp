<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Sales_Shipments_Model_History_IM_HC_MVC extends _HC_MVC
{
	public function extend_prepare( $return, $args, $src )
	{
		$item_id = array_shift( $args );

	// get shipments of this item
		$api = $this->make('/http/lib/api')
			->request('/api/shipments')
			;
		$api
			->add_param('items', $item_id)
			->add_param('with', '-all-')
			;
		$shipments = $api
			->get()
			->response()
			;

		$t = $this->make('/app/lib')->run('time');
		$presenter = $this->make('/shipments/presenter');

		foreach( $shipments as $e ){
			if( ! $e['items'] ){
				continue;
			}
			if( ! isset($e['items'][$item_id]) ){
				continue;
			}

			$qty = $e['items'][$item_id]['_qty'];

			$entry = array();
			$presenter->set_data( $e['sale'] );

		// timestamp
			$t->setDateDb( $e['date'] );
			$timestamp = $t->getTimestamp();

		// description
			$title = $presenter->present_title();
			$title = $this->make('/html/view/link')
				->to('/sales_shipments', array('sale' => $e['sale']['id']))
				->add( $title )
				->admin()
				->always_show()
				;

/* translators: item shipment operation description,  for example, Shipped 100.23 kg for PO-123 */
			$description = sprintf( HCM::__('Shipped %s in %s'), $qty, $title );

			$entry[] = $timestamp;
			$entry[] = $description;

			$return[] = $entry;
		}

		return $return;
	}
}