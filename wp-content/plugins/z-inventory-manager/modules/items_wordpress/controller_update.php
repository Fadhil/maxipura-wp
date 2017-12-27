<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Wordpress_Controller_Update_IM_HC_MVC extends _HC_MVC
{
	public function route_index( $id )
	{
		$controller_post = $this->make('/items/controller/post');
		$return = $controller_post->run('route-index', $id);

		if( $return === TRUE ){
		}
		else {
			// $redirect_to = get_edit_post_link( $id );
			// $return = $this->make('/http/view/response')
				// ->set_redirect($redirect_to) 
				// ;
		}
		return $return;
	}
}