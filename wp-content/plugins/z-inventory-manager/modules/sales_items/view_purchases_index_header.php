<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Purchases_Items_View_Purchases_Index_Header_IM_HC_MVC extends _HC_MVC 
{
	public function render( $item )
	{
		$p = $this->make('/items/presenter');
		$p->set_data( $item );

		$return = $p->present_title() . ': ' . HCM::__('Purchases');
		$return = $this->make('/html/view/element')->tag('h1')
			->add( $return )
			;
		return $return;
	}
}