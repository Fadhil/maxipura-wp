<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Purchases_Receives_Model_History_IM_HC_MVC extends _HC_MVC
{
	public function extend_prepare( $return, $args, $src )
	{
		$item_id = array_shift( $args );

	// get receives of this item
		$api = $this->make('/http/lib/api')
			->request('/api/receives')
			;
		$api
			->add_param('items', $item_id)
			->add_param('with', '-all-')
			;
		$receives = $api
			->get()
			->response()
			;

		$t = $this->make('/app/lib')->run('time');
		$presenter = $this->make('/purchases/presenter');

		foreach( $receives as $e ){
			if( ! $e['items'] ){
				continue;
			}
			if( ! isset($e['items'][$item_id]) ){
				continue;
			}

			$qty = $e['items'][$item_id]['_qty'];

			$entry = array();
			$presenter->set_data( $e['purchase'] );

		// timestamp
			$t->setDateDb( $e['date'] );
			$timestamp = $t->getTimestamp();

		// description
			$title = $presenter->present_title();
			$title = $this->make('/html/view/link')
				->to('/purchases_receives', array('purchase' => $e['purchase']['id']))
				->add( $title )
				->admin()
				->always_show()
				;

/* translators: item receipt operation description,  for example, Received 100.23 kg with PO-123, or Received 22 pc with PO-321 */
			$description = sprintf( HCM::__('Received %s with %s'), $qty, $title );

			$entry[] = $timestamp;
			$entry[] = $description;

			$return[] = $entry;
		}

		return $return;
	}
}