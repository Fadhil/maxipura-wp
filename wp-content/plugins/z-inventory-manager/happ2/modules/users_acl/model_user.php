<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Users_Acl_Model_User_HC_MVC extends _HC_MVC
{
// limits to the users that this one can view
	public function before_fetch_read( $args, $user_model )
	{
		$user = $this->make('/auth/model/user')->get();
		if( $user->is_admin() ){
			return;
		}

		$user_model
			->where('id', '=', $user->id())
			;
	}

// filters options for properties available for editing
	public function extend_options( $return, $args, $model )
	{
		$user = $this->make('/auth/model/user')->get();

		if( $user->id() == $model->id() ){
			$return['is_admin'] = array( $model->get('is_admin') );
		}

		if( $user->is_admin() ){
			return $return;
		}

		$return['is_admin'] = array();

		if( $user->id() == $model->id() ){
		}
		else {
			$return['display_name'] = array( $model->get('display_name') );
			$return['email'] = array();
		}

		return $return;
	}
}