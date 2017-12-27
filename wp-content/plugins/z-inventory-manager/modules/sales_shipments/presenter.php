<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Sales_Shipments_Presenter_IM_HC_MVC extends _HC_MVC_Model_Presenter
{
	public function extend_present_status( $return, $args, $src )
	{
		$model = $this->make('/sales/model');
		$status = $src->data('status');

		switch( $status ){
			case $model->_const('STATUS_PARTIALLY_SHIPPED'):
				$return = HCM::__('Partially Shipped');
				$return = $this->make('/html/view/element')->tag('span')
					->add( $return )
					->add_attr('class', 'hc-theme-label')
					->add_attr('class', 'hc-bg-olive')
					;
				break;

			case $model->_const('STATUS_SHIPPED'):
				$return = HCM::__('Shipped');
				$return = $this->make('/html/view/element')->tag('span')
					->add( $return )
					->add_attr('class', 'hc-theme-label')
					->add_attr('class', 'hc-bg-green')
					;
				break;
		}
		return $return;
	}
}