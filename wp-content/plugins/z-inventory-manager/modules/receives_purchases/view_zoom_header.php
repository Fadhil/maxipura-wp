<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Receives_Purchases_View_Zoom_Header_IM_HC_MVC extends _HC_MVC 
{
	public function render( $receive )
	{
		$presenter = $this->make('/receives/presenter')
			->set_data( $receive )
			;
		$return = $presenter->present_title();
		$return = $this->make('/html/view/element')->tag('h1')
			->add( $return )
			;

		return $return;
	}
}