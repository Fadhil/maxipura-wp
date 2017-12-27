<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Sales_View_Index_Header_IM_HC_MVC extends _HC_MVC 
{
	public function render()
	{
		$return = HCM::__('Sales');
		$return = $this->make('/html/view/element')->tag('h1')
			->add( $this->make('/html/view/icon')->icon('sale') )
			->add( $return )
			;

		return $return;
	}
}