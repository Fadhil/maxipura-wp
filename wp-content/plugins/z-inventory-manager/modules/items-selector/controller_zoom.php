<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Selector_Controller_Zoom_IM_HC_MVC extends _HC_MVC
{
	public function route_index()
	{
		$args = hc2_parse_args( func_get_args() );

		$id = isset($args['id']) ? $args['id'] : NULL;
		$qty = isset($args['qty']) ? $args['qty'] : NULL;

		$price = isset($args['price']) ? $args['price'] : NULL;
		$price_field = isset($args['price_field']) ? $args['price_field'] : NULL;

		$parent_input = isset($args['input']) ? $args['input'] : NULL;
		$readonly = isset($args['readonly']) ? $args['readonly'] : FALSE;

		$api = $this->make('/http/lib/api')
			->request('/api/items')
			->add_param('id', $id)
			// ->add_param('with', '-all-')
			;

		$model = $api
			->get()
			->response()
			;

	// currently available
		$manager = $this->make('/items/model/manager');
		$available = $manager->run('item-count', $id);

		if( $price === NULL && $price_field && array_key_exists($price_field, $model) ){
			$price = $model[$price_field];
		}

		$view = $this->make('view/zoom')
			->run('render', $model, $qty, $price, $parent_input, $readonly, $available)
			;
		return $this->make('/http/view/response')
			->set_view($view) 
			;
	}
}