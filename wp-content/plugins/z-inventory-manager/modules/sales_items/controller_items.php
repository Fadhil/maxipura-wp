<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Purchases_Items_Controller_Items_IM_HC_MVC extends _HC_MVC
{
	public function route_index()
	{
		$uri = $this->make('/http/lib/uri');

		$items = $uri->arg('item');
		$qty = $uri->arg('qty'); 

		$value = array();
		for( $ii = 0; $ii < count($items); $ii++ ){
			$this_value = array();
			$this_value['qty'] = isset($qty[$ii]) ? $qty[$ii] : 0;
			$value[ $items[$ii] ] = $this_value;
		}

		$input = $this->make('input/items2')
			->set_value( $value )
			;
		return $input;
	
		$view = $this->make('/purchases/view/index')
			->run('render', $entries)
			;
		$view = $this->make('view/purchases/index/layout')
			->run('render', $view, $item_model)
			;
		$view = $this->make('/layout/view/body')
			->set_content($view)
			;
		return $this->make('/http/view/response')
			->set_view($view)
			;
	}
}