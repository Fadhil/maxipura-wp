<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Receives_Purchases_Controller_Zoom_IM_HC_MVC extends _HC_MVC
{
	public function route_index()
	{
		$args = $this->make('/app/lib/args')->run('parse', func_get_args());

		$id = $args->get('id');
		if( ! $id ){
			return;
		}

		$api = $this->make('/http/lib/api')
			->request('/api/receives')
			->add_param('id', $id)
			->add_param('with', '-all-')
			;
		$receive = $api
			->get()
			->response()
			;

		$view = $this->make('view/zoom')
			->run('render', $receive)
			;

		$view = $this->make('view/zoom/layout')
			->run('render', $view, $receive)
			;
		$view = $this->make('/layout/view/body')
			->set_content($view)
			;
		return $this->make('/http/view/response')
			->set_view($view)
			;
	}
}