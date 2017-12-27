<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Receives_Purchases_View_Zoom_Menubar_IM_HC_MVC extends _HC_MVC 
{
	public function render( $receive )
	{
		$menubar = $this->make('/html/view/container');
		$presenter = $this->make('/purchases/presenter');
		$presenter->set_data( $receive['purchase'] );

	// BACK TO PURCHASE
		$menubar->add(
			'sale',
			$this->make('/html/view/link')
				->to('/purchases/zoom', array('-id' => $receive['purchase']['id']))
				->add( $this->make('/html/view/icon')->icon('arrow-left') )
				->add( $presenter->present_title() )
			);

		return $menubar;
	}
}