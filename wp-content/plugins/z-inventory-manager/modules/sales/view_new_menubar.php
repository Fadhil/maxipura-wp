<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Sales_View_New_Menubar_IM_HC_MVC extends _HC_MVC 
{
	public function render()
	{
		$menubar = $this->make('/html/view/container');
		return $menubar;
	}
}