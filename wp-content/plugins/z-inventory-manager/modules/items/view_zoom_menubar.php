<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_View_Zoom_Menubar_IM_HC_MVC extends _HC_MVC 
{
	public function render( $model )
	{
		$menubar = $this->make('/html/view/container');

	// status
		$menubar->add(
			'status',
			$this->make('/html/view/link')
				->to('status', array('id' => $model['id']))
				->add( $this->make('/html/view/icon')->icon('status') )
				->add( HCM::__('Status') )
			);

	// history
		$menubar->add(
			'history',
			$this->make('/html/view/link')
				->to('history', array('id' => $model['id']))
				->add( $this->make('/html/view/icon')->icon('history') )
				->add( HCM::__('History') )
			);

		return $menubar;
	}
}