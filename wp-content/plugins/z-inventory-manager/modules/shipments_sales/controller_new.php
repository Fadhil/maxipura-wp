<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Shipments_Sales_Controller_New_IM_HC_MVC extends _HC_MVC
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

		$view = $this->make('view/new')
			->run('render', $sale)
			;
		$view = $this->make('view/new/layout')
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