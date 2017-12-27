<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Wordpress_Model_IM_HC_MVC extends _HC_ORM_WP_Custom_Post
{
	protected $default_order_by = array(
		'post_title'	=> 'ASC',
		);

	public function _init()
	{
		$this->storable->post_type = $this->app_short_name() . '-' . 'item';
		return $this;
	}
}