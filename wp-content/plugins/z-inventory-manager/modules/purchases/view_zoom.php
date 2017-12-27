<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Purchases_View_Zoom_IM_HC_MVC extends _HC_MVC
{
	public function render( $model )
	{
		$id = $model['id'];

		$form = $this->make('form');
		$values = $form->run('from-model', $model );

		$form
			->set_values( $values )
			;

		$model_obj = $this->make('model');
		$options = array();

		switch( $model['status'] ){
			case $model_obj->_const('STATUS_ISSUED'):
			case $model_obj->_const('STATUS_RECEIVED'):
			case $model_obj->_const('STATUS_PARTIALLY_RECEIVED'):
				$options['status'] = array();
				$form->set_readonly();
				break;
		}

		$form->set_options( $options );

		$link = $this->make('/html/view/link')
			->to('update', $id)
			->href()
			;

		$display_form = $this->make('/html/view/form')
			->add_attr('action', $link )
			->set_form( $form )
			;

		$inputs = $form->inputs();
		foreach( $inputs as $input_name => $input ){
			$input_view = $this->make('/html/view/label-input')
				->set_label( $input->label() )
				->set_content( $input )
				->set_error( $input->error() )
				;

			$display_form
				->add( $input_view )
				;
		}

		if( ! $form->readonly() ){
			$buttons = $this->run('prepare-actions', $model);

			$display_form
				->add( $buttons )
				;
		}
		return $display_form;
	}

	public function prepare_actions( $model )
	{
		$buttons = $this->make('/html/view/list-inline');

		$buttons->add(
			'save',
			$this->make('/html/view/element')->tag('input')
				->add_attr('type', 'submit')
				->add_attr('title', HCM::__('Save') )
				->add_attr('value', HCM::__('Save') )
				->add_attr('class', 'hc-theme-btn-submit', 'hc-theme-btn-primary')
			);

		$buttons->add(
			'delete',
			$this->make('/html/view/link')
				->to('delete', $model['id'])
				->add_attr('class', 'hcj2-confirm')
				->add( HCM::__('Delete') )
				->add_attr('class', 'hc-theme-btn-submit', 'hc-theme-btn-danger')
			);

		return $buttons;
	}
}