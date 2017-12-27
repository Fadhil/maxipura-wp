<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Sales_View_New_Header_IM_HC_MVC extends _HC_MVC 
{
	public function render()
	{
		$return = HCM::__('Add New Sale');
		$return = $this->make('/html/view/element')->tag('h1')
			->add( $return )
			;
		return $return;
	}
}