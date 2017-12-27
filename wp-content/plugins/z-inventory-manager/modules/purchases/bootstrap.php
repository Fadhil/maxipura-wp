<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Purchases_Bootstrap_IM_HC_MVC extends _HC_MVC
{
	public function run()
	{
		$link = $this->make('/html/view/link')
			->to('/purchases')
			->add( $this->make('/html/view/icon')->icon('purchase') )
			->add( HCM::__('Purchases') )
			;

		$top_menu = $this->make('/html/view/top-menu')
			->add( 'purchases', $link )
			;
	}
}