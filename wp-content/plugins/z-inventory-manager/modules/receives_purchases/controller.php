<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Receives_Purchases_Controller_IM_HC_MVC extends _HC_MVC
{
	public function route_index()
	{
		$args = $this->make('/app/lib/args')->run('parse', func_get_args());

		$purchase_id = $args->get('purchase');
		if( ! $purchase_id ){
			return;
		}

		$api = $this->make('/http/lib/api')
			->request('/api/purchases')
			->add_param('id', $purchase_id)
			->add_param('with', '-all-')
			;
		$purchase = $api
			->get()
			->response()
			;

		$api = $this->make('/http/lib/api')
			->request('/api/receives')
			->add_param('purchase', $purchase_id)
			->add_param('with', '-all-')
			;

		$entries = $api
			->get()
			->response()
			;

		if( ! $entries ){
			$redirect_to = $this->make('/html/view/link')
				->to('/purchases/zoom', array('-id' => $purchase['id']))
				->href()
				;
			return $this->make('/http/view/response')
				->set_redirect($redirect_to) 
				;
		}

		$manager = $this->make('/items_purchases_receives/model/manager');
		$received_items = $manager->run('received-items', $purchase);

		$view = $this->make('view/index')
			->run('render', $entries, $purchase, $received_items)
			;
		$view = $this->make('view/index/layout')
			->run('render', $view, $purchase)
			;
		$view = $this->make('/layout/view/body')
			->set_content($view)
			;
		return $this->make('/http/view/response')
			->set_view($view)
			;
	}
}