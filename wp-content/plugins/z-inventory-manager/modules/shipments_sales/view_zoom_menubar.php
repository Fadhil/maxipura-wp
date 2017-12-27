<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Shipments_Sales_View_Zoom_Menubar_IM_HC_MVC extends _HC_MVC 
{
	public function render( $shipment )
	{
		$menubar = $this->make('/html/view/container');
		$presenter = $this->make('/sales/presenter');
		$presenter->set_data( $shipment['sale'] );

	// BACK TO SALE
		$menubar->add(
			'sale',
			$this->make('/html/view/link')
				->to('/sales/zoom', array('-id' => $shipment['sale']['id']))
				->add( $this->make('/html/view/icon')->icon('arrow-left') )
				->add( $presenter->present_title() )
			);

		return $menubar;
	}
}