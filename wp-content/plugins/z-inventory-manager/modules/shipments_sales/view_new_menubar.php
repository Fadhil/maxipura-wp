<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Shipments_Sales_View_New_Menubar_IM_HC_MVC extends _HC_MVC 
{
	public function render( $sale )
	{
		$menubar = $this->make('/html/view/container');
		$presenter = $this->make('/sales/presenter');
		$presenter->set_data( $sale );

	// BACK TO SALE
		$menubar->add(
			'sale',
			$this->make('/html/view/link')
				->to('/sales/zoom', array('-id' => $sale['id']))
				->add( $this->make('/html/view/icon')->icon('arrow-left') )
				->add( $presenter->present_title() )
			);

		return $menubar;
	}
}