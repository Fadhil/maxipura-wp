<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Purchases_Items_View_Purchases_Index_Menubar_IM_HC_MVC extends _HC_MVC 
{
	public function render( $item )
	{
		$menubar = $this->make('/html/view/container');

	// BACK
		$p = $this->make('/items/presenter');
		$p->set_data( $item );

		$title = $p->present_title();

		$link = $this->make('/html/view/link')
			// ->to('/items/zoom', array('id' => $item['id']))
			->to('/items/zoom', $item['id'])
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