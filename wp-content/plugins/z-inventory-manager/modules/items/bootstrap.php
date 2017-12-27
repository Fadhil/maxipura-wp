<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Bootstrap_IM_HC_MVC extends _HC_MVC
{
	public function run()
	{
		$link = $this->make('/html/view/link')
			->to('/items')
			->add( $this->make('/html/view/icon')->icon('inventory') )
			->add( HCM::__('Inventory') )
			;

		$top_menu = $this->make('/html/view/top-menu')
			->add( $link )
			;
	}
}