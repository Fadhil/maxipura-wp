<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Receives_Purchases_View_New_Layout_IM_HC_MVC extends _HC_MVC
{
	public function render( $content, $purchase )
	{
		$header = $this->make('view/new/header');
		$menubar = $this->make('view/new/menubar')
			->run('render', $purchase)
			;

		$out = $this->make('/layout/view/content-header-menubar')
			->set_content( $content )
			->set_header( $header )
			->set_menubar( $menubar )
			;

		return $out;
	}
}