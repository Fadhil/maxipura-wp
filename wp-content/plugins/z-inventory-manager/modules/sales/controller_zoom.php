<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Sales_Controller_Zoom_IM_HC_MVC extends _HC_MVC
{
	public function route_index()
	{
		$args = $this->make('/app/lib/args')->parse( func_get_args() );
		$id = $args->get('id');

		$api = $this->make('/http/lib/api')
			->request('/api/sales')
			->add_param('id', $id)
			->add_param('with', '-all-')
			;

		$model = $api
			->get()
			->response()
			;
		$view = $this->make('view/zoom')
			->run('render', $model)
			;
		$view = $this->make('view/zoom/layout')
			->run('render', $view, $model)
			;
		$view = $this->make('/layout/view/body')
			->set_content($view)
			;
		return $this->make('/http/view/response')
			->set_view($view) 
			;
	}
}