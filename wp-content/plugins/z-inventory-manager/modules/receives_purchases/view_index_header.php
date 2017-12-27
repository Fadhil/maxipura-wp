<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Receives_Purchases_View_Index_Header_IM_HC_MVC extends _HC_MVC 
{
	public function render( $purchase )
	{
		$presenter = $this->make('/purchases/presenter');
		$presenter->set_data( $purchase );

		$return = $presenter->run('present-title') . ': ' . HCM::__('Received Items');
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