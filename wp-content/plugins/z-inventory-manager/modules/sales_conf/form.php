<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Sales_Conf_Form_IM_HC_MVC extends _HC_Form
{
	public function _init()
	{
		$this
			->set_input( 'sales:ref_auto_gen',
				$this->make('/form/view/radio')
					->set_label( HCM::__('Auto-Generate Sale Numbers') )
					->set_inline()
					->set_options(
						array(
							1	=> HCM::__('Yes'),
							0	=> HCM::__('No'),
							)
						)
				)
			->set_input( 'sales:ref_prefix',
				$this->make('/form/view/text')
					->set_label( HCM::__('Prefix') )
					->set_observe('sales:ref_auto_gen=1')
				)
			->set_input( 'sales:ref_number_random',
				$this->make('/form/view/radio')
					->set_label( HCM::__('Auto-Generated Numbers') )
					->set_inline()
					->set_options(
						array(
							0	=> HCM::__('Sequential'),
							1	=> HCM::__('Random'),
							)
						)
					->set_observe('sales:ref_auto_gen=1')
				)
			;

		$defaults = array();
		$app_settings = $this->make('/app/lib/settings');
		$inputs = $this->inputs();
		foreach( $inputs as $k => $v ){
			$defaults[$k] = $app_settings->run('get', $k);
		}

		$this->set_values( $defaults );

		return $this;
	}
}