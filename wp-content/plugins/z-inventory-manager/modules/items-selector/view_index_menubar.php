<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Selector_View_Index_Menubar_IM_HC_MVC extends _HC_MVC 
{
	public function render()
	{
		$menubar = $this->make('/html/view/container');
		return $menubar;
	}
}