<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Receives_Purchases_Controller_New_IM_HC_MVC extends _HC_MVC
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

		$view = $this->make('view/new')
			->run('render', $purchase)
			;
		$view = $this->make('view/new/layout')
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