<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Sales_Shipments_Model_IM_HC_MVC extends _HC_MVC
{
	public function extend_to_array( $return, $args, $src )
	{
		if( ! (isset($return['id']) && $return['id']) ){
			return $return;
		}

		if( ! (isset($return['shipments']) && $return['shipments']) ){
			return $return;
		}

	// change status
		$model = $this->make('/sales/model');
		$manager = $this->make('/sales_items/model/manager');
		$need_items = $manager->run('need-items', $return);

		if( $need_items ){
			$status = $model->_const('STATUS_PARTIALLY_SHIPPED');
		}
		else {
			$status = $model->_const('STATUS_SHIPPED');
		}
		$return['status'] = $status;
		return $return;
	}
}