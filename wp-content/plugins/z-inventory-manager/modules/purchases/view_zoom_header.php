<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Purchases_View_Zoom_Header_IM_HC_MVC extends _HC_MVC
{
	public function render( $model )
	{
		$presenter = $this->make('presenter')
			->set_data($model)
			;
		$return = $presenter->run('present_title');

		$status = $presenter->run('present_status');
		$status = $this->make('/html/view/element')->tag('span')
			->add_attr('class', 'hc-fs2')
			->add( $status )
			;

		$return = $this->make('/html/view/element')->tag('h1')
			->add( $return )
			;
		
		$return = $this->make('/html/view/container')
			->add( $status )
			->add( $return )
			;
		return $return;
	}
}