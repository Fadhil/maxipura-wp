<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Purchases_View_Zoom_Menubar_IM_HC_MVC extends _HC_MVC 
{
	public function render( $model )
	{
		$menubar = $this->make('/html/view/container');

		$link = $this->make('/html/view/link')
			->to('new', array('duplicate' => $model['id']))
			->add( HCM::__('Duplicate Purchase') )
			->add( $this->make('/html/view/icon')->icon('plus') )
			;

		$menubar
			->add(
				'duplicate',
				$link
				)
			->set_child_order(
				'duplicate',
				100
				)
			;

			
			
			
		return $menubar;
	}
}