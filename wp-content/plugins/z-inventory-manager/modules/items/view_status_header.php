<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_View_Status_Header_IM_HC_MVC extends _HC_MVC
{
	public function render( $model )
	{
		$presenter = $this->make('presenter')
			->set_data($model)
			;

		$title_view = $presenter->present_title();

		$return = $this->make('/html/view/element')->tag('h1')
			->add( $this->make('/html/view/icon')->icon('status') )
			->add( $title_view )
			;

		return $return;
	}
}