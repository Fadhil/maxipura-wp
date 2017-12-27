<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Purchases_Items_Controller_Purchases_IM_HC_MVC extends _HC_MVC
{
	public function route_index()
	{
		$model = $this->make('/http/lib/api')
			->request('/api/purchases')
			;

		$uri = $this->make('/http/lib/uri');
		$item_id = $uri->arg('item');

		$item = $this->make('/http/lib/api')
			->request('/api/items')
			->add_param('id', $item_id)
			->get()
			->response()
			;

		$purchases = $model
			->add_param('items', $item_id)
			->add_param('with', '-all-')
			->get()
			->response()
			;

		$view = $this->make('view/purchases/index')
			->run('render', $purchases, $item)
			;
		$view = $this->make('view/purchases/index/layout')
			->run('render', $view, $item)
			;
		$view = $this->make('/layout/view/body')
			->set_content($view)
			;
		return $this->make('/http/view/response')
			->set_view($view)
			;
	}
}