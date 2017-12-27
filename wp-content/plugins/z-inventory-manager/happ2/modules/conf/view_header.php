<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Conf_View_Header_HC_MVC extends _HC_MVC
{
	public function render()
	{
		$return = HCM::__('Settings');
		$return = $this->make('/html/view/element')->tag('h1')
			->add( $this->make('/html/view/icon')->icon('cog') )
			->add( $return )
			;
		return $return;
	}
}