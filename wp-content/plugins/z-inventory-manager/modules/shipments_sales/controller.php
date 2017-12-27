<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Shipments_Sales_Controller_IM_HC_MVC extends _HC_MVC
{
	public function route_index()
	{
		$args = $this->make('/app/lib/args')->run('parse', func_get_args());

		$sale_id = $args->get('sale');
		if( ! $sale_id ){
			return;
		}

		$api = $this->make('/http/lib/api')
			->request('/api/sales')
			->add_param('id', $sale_id)
			->add_param('with', '-all-')
			;
		$sale = $api
			->get()
			->response()
			;

		$api = $this->make('/http/lib/api')
			->request('/api/shipments')
			->add_param('sale', $sale_id)
			->add_param('with', '-all-')
			;

		$entries = $api
			->get()
			->response()
			;

		if( ! $entries ){
			$redirect_to = $this->make('/html/view/link')
				->to('/sales/zoom', array('-id' => $sale['id']))
				->href()
				;
			return $this->make('/http/view/response')
				->set_redirect($redirect_to) 
				;
		}

		$ship_manager = $this->make('/items_sales_shipments/model/manager');
		$shipped_items = $ship_manager->run('shipped-items', $sale);

		$view = $this->make('view/index')
			->run('render', $entries, $sale, $shipped_items)
			;
		$view = $this->make('view/index/layout')
			->run('render', $view, $sale)
			;
		$view = $this->make('/layout/view/body')
			->set_content($view)
			;
		return $this->make('/http/view/response')
			->set_view($view)
			;
	}
}