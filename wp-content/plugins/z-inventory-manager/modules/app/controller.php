<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class App_Controller_IM_HC_MVC extends _HC_MVC
{
	public function set_default_route( $args, $src )
	{
		list( $slug, $params ) = $args;

		if( ! $slug ){
			$slug = 'items';

			$root = $this->make('/root/controller');
			list( $slug, $args ) = $root->run('link-check', $slug, $args);

		// not allowed 
			if( ! $slug ){
				$user = $this->make('/auth/model/user')->get();
				$user_id = $user->id();
				if( ! $user_id ){
					$slug = 'auth/login';
				}
			}

			$return = array( $slug, $params );
			return $return;
		}
	}
}