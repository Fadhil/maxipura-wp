<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Wordpress_Presenter_IM_HC_MVC extends _HC_MVC_Model_Presenter
{
	function present_title()
	{
		$return = $this->data('post_title');
		return $return;
	}
}