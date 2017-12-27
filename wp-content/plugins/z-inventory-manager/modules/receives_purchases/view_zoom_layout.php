<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Receives_Purchases_View_Zoom_Layout_IM_HC_MVC extends _HC_MVC
{
	public function render( $content, $shipment )
	{
		$header = $this->make('view/zoom/header')
			->run('render', $shipment)
			;
		$menubar = $this->make('view/zoom/menubar')
			->run('render', $shipment)
			;

		$out = $this->make('/layout/view/content-header-menubar')
			->set_content( $content )
			->set_header( $header )
			->set_menubar( $menubar )
			;

		return $out;
	}
}