<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Shipments_Sales_Controller_Zoom_IM_HC_MVC extends _HC_MVC
{
	public function route_index()
	{
		$args = $this->make('/app/lib/args')->run('parse', func_get_args());

		$id = $args->get('id');
		if( ! $id ){
			return;
		}

		$api = $this->make('/http/lib/api')
			->request('/api/shipments')
			->add_param('id', $id)
			->add_param('with', '-all-')
			;
		$shipment = $api
			->get()
			->response()
			;

		$view = $this->make('view/zoom')
			->run('render', $shipment)
			;

		$view = $this->make('view/zoom/layout')
			->run('render', $view, $shipment)
			;
		$view = $this->make('/layout/view/body')
			->set_content($view)
			;
		return $this->make('/http/view/response')
			->set_view($view)
			;
	}
}