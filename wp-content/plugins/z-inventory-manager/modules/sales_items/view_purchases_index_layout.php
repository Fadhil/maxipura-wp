<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Purchases_Items_View_Purchases_Index_Layout_IM_HC_MVC extends _HC_MVC 
{
	public function render( $content, $item )
	{
		$header = $this->make('view/purchases/index/header')
			->run('render', $item)
			;
		$menubar = $this->make('view/purchases/index/menubar')
			->run('render', $item)
			;

		$out = $this->make('/layout/view/content-header-menubar')
			->set_content( $content )
			->set_header( $header )
			->set_menubar( $menubar )
			;

		return $out;
	}
}