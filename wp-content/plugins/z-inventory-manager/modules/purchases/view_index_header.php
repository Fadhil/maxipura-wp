<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Purchases_View_Index_Header_IM_HC_MVC extends _HC_MVC 
{
	public function render()
	{
		$return = HCM::__('Purchases');
		$return = $this->make('/html/view/element')->tag('h1')
			->add( $this->make('/html/view/icon')->icon('purchase') )
			->add( $return )
			;
		return $return;
	}
}