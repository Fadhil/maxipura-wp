<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_View_History_Header_IM_HC_MVC extends _HC_MVC
{
	public function render( $model )
	{
		$presenter = $this->make('presenter')
			->set_data($model)
			;
		$return = $presenter->present_title();

		$return = $this->make('/html/view/element')->tag('h1')
			->add( $this->make('/html/view/icon')->icon('history') )
			->add( $return )
			;

		return $return;
	}
}