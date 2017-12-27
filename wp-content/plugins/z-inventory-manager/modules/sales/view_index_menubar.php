<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Sales_View_Index_Menubar_IM_HC_MVC extends _HC_MVC 
{
	public function render()
	{
		$menubar = $this->make('/html/view/container');

	// ADD
		$menubar->add(
			'add',
			$this->make('/html/view/link')
				->to('new')
				->add( $this->make('/html/view/icon')->icon('plus') )
				->add( HCM::__('Add New Sale') )
			);

		return $menubar;
	}
}