<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Users_Acl_Controller_HC_MVC extends _HC_MVC
{
	public function extend_link_check( $return, $args, $src )
	{
		list( $slug, $params ) = $return;

		$checks = array(
			array($this, 'check_my_module'),
			array($this, 'check_delete'),
			array($this, 'check_admin'),
			array($this, 'check_if_me'),
			);

		foreach( $checks as $check ){
			$check_result = call_user_func( $check, $slug, $params );
			if( $check_result === NULL ){
				continue;
			}
			if( ! $check_result ){
				$return[0] = '';
			}
			break;
		}

		return $return;
	}

	public function check_my_module( $slug, $params )
	{
		$return = NULL;

		$module = 'users';
		if( ($module != $slug) && (substr($slug, 0, strlen($module . '/')) != $module . '/') ){
			$return = TRUE;
		}
		return $return;
	}

	public function check_delete( $slug, $params )
	{
		$return = NULL;

		$user = $this->make('/auth/model/user')->get();
		if( ($slug == 'users/delete') && (array_shift($params) == $user->id()) ){
			$return = FALSE;
		}
		return $return;
	}

	public function check_admin( $slug, $params )
	{
		$return = NULL;

		$user = $this->make('/auth/model/user')->get();
		if( $user->is_admin() ){
			$return = TRUE;
		}

		return $return;
	}

	public function check_if_me( $slug, $params )
	{
		$return = FALSE;

		$user = $this->make('/auth/model/user')->get();
		$allowed_slugs = array(
			'users/zoom/index',
			'users/zoom/update',
			);

		if( (array_shift($params) == $user->id()) && in_array($slug, $allowed_slugs) ){
			$return = TRUE;
		}

		return $return;
	}
}