<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Purchases_Receives_Model_IM_HC_MVC extends _HC_MVC
{
	public function extend_to_array( $return, $args, $src )
	{
		if( ! (isset($return['id']) && $return['id']) ){
			return $return;
		}

		if( ! (isset($return['receives']) && $return['receives']) ){
			return $return;
		}

	// change status
		$model = $this->make('/purchases/model');
		$manager = $this->make('/purchases_items/model/manager');
		$need_items = $manager->run('need-items', $return);

		if( $need_items ){
			$status = $model->_const('STATUS_PARTIALLY_RECEIVED');
		}
		else {
			$status = $model->_const('STATUS_RECEIVED');
		}
		$return['status'] = $status;
		return $return;
	}
}