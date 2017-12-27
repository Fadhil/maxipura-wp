<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Conf_Bootstrap_HC_MVC extends _HC_MVC
{
	public function run()
	{
		$link = $this->make('/html/view/link')
			->to('/conf')
			->add( $this->make('/html/view/icon')->icon('cog') )
			->add( HCM::__('Settings') )
			;

		$top_menu = $this->make('/html/view/top-menu')
			->add( 'conf', $link )
			->set_child_order( 'conf', 100 )
			;
	}
}