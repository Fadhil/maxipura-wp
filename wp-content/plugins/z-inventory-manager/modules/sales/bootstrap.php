<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Sales_Bootstrap_IM_HC_MVC extends _HC_MVC
{
	public function run()
	{
		$link = $this->make('/html/view/link')
			->to('/sales')
			->add( $this->make('/html/view/icon')->icon('sale') )
			->add( HCM::__('Sales') )
			;

		$top_menu = $this->make('/html/view/top-menu')
			->add( $link )
			;
	}
}