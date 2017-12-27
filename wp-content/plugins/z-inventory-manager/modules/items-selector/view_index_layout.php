<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Selector_View_Index_Layout_IM_HC_MVC extends _HC_MVC
{
	public function render( $content )
	{
		$menubar = $this->make('view/index/menubar');

		$out = $this->make('/layout/view/content-header-menubar')
			->set_content( $content )
			->set_menubar( $menubar )
			;

		return $out;
	}
}