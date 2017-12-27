<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Shipments_Msgbus_Controller_Message_IM_HC_MVC extends _HC_MVC
{
	public function extend_message( $return, $params, $model )
	{
		$msg = NULL;
		$msg_key = NULL;
		$error = NULL;

		if( $return ){
			if( $model->exists() ){
				$changes = $model->changes();
				if( $changes ){
					if( array_key_exists('id', $changes) ){
						$msg = HCM::__('Shipment Added');
						$msg_key = $model->type() . '-add-' . $model->id();
					}
					else {
						$msg = HCM::__('Shipment Updated');
						$msg_key = $model->type() . '-update-' . $model->id();
					}
				}
			}
			else {
				$msg = HCM::__('Shipment Deleted');
				$msg_key = $model->type() . '-delete-' . $model->id();
			}
		}
		else {
			$error = $model->errors();
		}

		$msgbus = $this->make('/msgbus/lib');
		if( $msg ){
			$msgbus->add('message', $msg, $msg_key);
		}
		if( $error ){
			$msgbus->add('error', $error, $msg_key);
		}
	}
}