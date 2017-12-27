<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Sales_Controller_Preview_IM_HC_MVC extends _HC_MVC
{
	public function route_index()
	{
		$uri = $this->make('/http/lib/uri');
		$items = $uri->arg('items');
		$qty = $uri->arg('qty');

		$values = array();
		if( $items ){
			$values['items'] = array();
			for( $ii = 0; $ii < count($items); $ii++ ){
				if( isset($qty[$ii]) ){
					$values['items'][ $items[$ii] ] = array(
						'qty'	=> $qty[$ii]
						);
				}
			}
		}

		$view = $this->make('view/preview')
			->run('render', $values)
			;
		$view = $this->make('view/new/layout')
			->run('render', $view)
			;
		$view = $this->make('/layout/view/body')
			->set_content($view)
			;
		return $this->make('/http/view/response')
			->set_view($view)
			;
	}

}