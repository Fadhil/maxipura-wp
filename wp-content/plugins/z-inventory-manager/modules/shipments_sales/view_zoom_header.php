<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Shipments_Sales_View_Zoom_Header_IM_HC_MVC extends _HC_MVC 
{
	public function render( $shipment )
	{
		$presenter = $this->make('/shipments/presenter')
			->set_data( $shipment )
			;
		$return = $presenter->present_title();
		$return = $this->make('/html/view/element')->tag('h1')
			->add( $return )
			;

		return $return;
	}
}