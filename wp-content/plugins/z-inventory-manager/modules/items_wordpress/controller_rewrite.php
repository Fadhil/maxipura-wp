<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Wordpress_Controller_Rewrite_IM_HC_MVC extends _HC_MVC
{
	public function extend_link_check( $return, $args, $src )
	{
		list( $slug, $params ) = $return;

		switch( $slug ){
			case 'items/zoom':
				$id = array_shift( $params );
				$slug = admin_url('post.php?action=edit&post=' . $id);
				$return = array( $slug, $params );
				break;

			case 'items':
				$slug = admin_url('edit.php?post_type=' . $this->app_short_name() . '-item');
				$return = array( $slug, $params );
				break;
		}

		return $return;
	}
}