<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Receives_Purchases_View_New_Menubar_IM_HC_MVC extends _HC_MVC 
{
	public function render( $purchase )
	{
		$menubar = $this->make('/html/view/container');
		$presenter = $this->make('/purchases/presenter');
		$presenter->set_data( $purchase );

	// BACK TO PURCHASE
		$menubar->add(
			'purchase',
			$this->make('/html/view/link')
				->to('/purchases/zoom', array('-id' => $purchase['id']))
				->add( $this->make('/html/view/icon')->icon('arrow-left') )
				->add( $presenter->present_title() )
			);

		return $menubar;
	}
}