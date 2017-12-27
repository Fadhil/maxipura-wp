<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Controller_History_IM_HC_MVC extends _HC_MVC
{
	public function route_index()
	{
		$args = $this->make('/app/lib/args')->run('parse', func_get_args());
		$item_id = $args->get('id');

		$model = $this->make('/http/lib/api')
			->request('/api/items')
			->add_param('id', $item_id)
			->add_param('with', '-all-')
			->get()
			->response()
			;

		$manager = $this->make('model/history');
		$entries = $manager->run('get', $item_id);

		$view = $this->make('view/history')
			->run('render', $model, $entries)
			;
		$view = $this->make('view/history/layout')
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