<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Sales_Presenter_IM_HC_MVC extends _HC_MVC_Model_Presenter
{
	public function present_title()
	{
		$return = $this->data('ref');
		return $return;
	}

	public function present_status()
	{
		$model = $this->make('model');
		$status = $this->data('status');
		$return = $status;

		switch( $status ){
			case $model->_const('STATUS_DRAFT'):
				$return = HCM::__('Draft');
				$return = $this->make('/html/view/element')->tag('span')
					->add( $return )
					->add_attr('class', 'hc-theme-label')
					;
				break;

			case $model->_const('STATUS_CONFIRMED'):
				$return = HCM::__('Confirmed');
				$return = $this->make('/html/view/element')->tag('span')
					->add( $return )
					->add_attr('class', 'hc-theme-label')
					->add_attr('class', 'hc-bg-aqua')
					;
				break;
		}
		return $return;
	}
}