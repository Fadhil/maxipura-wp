<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Purchases_Form_IM_HC_MVC extends _HC_Form
{
	public function _init()
	{
		$model = $this->make('model');
		$presenter = $this->make('presenter');

		$statuses = array( 'STATUS_DRAFT', 'STATUS_ISSUED' );
		$status_options = array();
		foreach( $statuses as $sta ){
			$status_options[ $model->_const($sta) ] = $presenter->set_data( array('status' => $model->_const($sta)) )->run('present_status');
		}

		$this
			->set_input( 'status',
				$this->make('/form/view/radio')
					->set_label( HCM::__('Status') )
					->set_inline()
					->set_options( $status_options )
					->set_default(1)
				)

			->set_input( 'ref',
				$this->make('/form/view/text')
					->set_label( HCM::__('Purchase #') )
				)

			->set_input( 'date',
				$this->make('/form/view/date')
					->set_label( HCM::__('Date') )
				)

			->set_input( 'description',
				$this->make('/form/view/textarea')
					->set_label( HCM::__('Comments') )
						->add_attr('cols', 40)
						->add_attr('rows', 3)
				)
			;

		$this
			->set_child_order( 'description', 100 )
			;

		return $this;
	}

	public function to_model( $values )
	{
		$return = array();

		$take = array('date', 'ref', 'description', 'status');
		foreach( $take as $t ){
			if( array_key_exists($t, $values) ){
				$return[$t] = $values[$t];
			}
		}
		return $return;
	}

	public function from_model( $values )
	{
		$return = array();

		$take = array('date', 'ref', 'description', 'status');
		foreach( $take as $t ){
			if( array_key_exists($t, $values) ){
				$return[$t] = $values[$t];
			}
		}
		return $return;
	}
}