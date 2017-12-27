<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Presenter_IM_HC_MVC extends _HC_MVC_Model_Presenter
{
	public function present_title()
	{
		$return = $this->data('title') ? $this->data('title') : HCM::__('Unknown');
		return $return;
	}
}