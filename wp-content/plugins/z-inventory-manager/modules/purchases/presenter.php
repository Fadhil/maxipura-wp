<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Purchases_Presenter_IM_HC_MVC extends _HC_MVC_Model_Presenter
{
	public function present_title()
	{
		$return = $this->data('ref');
		return $return;
	}

	public function present_status()
	{
		$model = $this->make('model');
		$return = $this->data('status');

		switch( $return ){
			case $model->_const('STATUS_DRAFT'):
				$return = HCM::__('Draft');
				$return = $this->make('/html/view/element')->tag('span')
					->add( $return )
					->add_attr('class', 'hc-theme-label')
					;
				break;

			case $model->_const('STATUS_ISSUED'):
				$return = HCM::__('Issued');
				$return = $this->make('/html/view/element')->tag('span')
					->add( $return )
					->add_attr('class', 'hc-theme-label')
					->add_attr('class', 'hc-bg-aqua')
					;
				break;

			case $model->_const('STATUS_PARTIALLY_RECEIVED'):
				$return = HCM::__('Partially Received');
				$return = $this->make('/html/view/element')->tag('span')
					->add( $return )
					->add_attr('class', 'hc-theme-label')
					->add_attr('class', 'hc-bg-olive')
					;
				break;

			case $model->_const('STATUS_RECEIVED'):
				$return = HCM::__('Received');
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