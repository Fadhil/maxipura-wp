<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_View_History_Menubar_IM_HC_MVC extends _HC_MVC 
{
	public function render( $model )
	{
		$menubar = $this->make('/html/view/container');

	// BACK
		$p = $this->make('/items/presenter');
		$p->set_data( $model );

		$title = $p->present_title();

		$link = $this->make('/html/view/link')
			->to('/items/zoom', array('id' => $model['id']))
			->add( $this->make('/html/view/icon')->icon('arrow-left') )
			->add( $title )
			->always_show()
			;
		$menubar->add(
			'item',
			$link
			);

		return $menubar;
	}
}