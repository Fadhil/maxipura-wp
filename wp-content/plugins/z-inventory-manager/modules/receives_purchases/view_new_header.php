<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Receives_Purchases_View_New_Header_IM_HC_MVC extends _HC_MVC 
{
	public function render()
	{
		$return = HCM::__('Receive Items');
		$return = $this->make('/html/view/element')->tag('h1')
			->add( $return )
			;
		return $return;
	}
}