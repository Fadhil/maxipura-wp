<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Shipments_Sales_View_Index_Header_IM_HC_MVC extends _HC_MVC 
{
	public function render( $sale )
	{
		$presenter = $this->make('/sales/presenter');
		$presenter->set_data( $sale );

		$return = $presenter->run('present-title') . ': ' . HCM::__('Shipped Items');
		$return = $this->make('/html/view/element')->tag('h1')
			->add( $return )
			;

		$status = $presenter->run('present_status');
		$status = $this->make('/html/view/element')->tag('span')
			->add_attr('class', 'hc-fs2')
			->add( $status )
			;

		$return = $this->make('/html/view/container')
			->add( $status )
			->add( $return )
			;

		return $return;
	}
}