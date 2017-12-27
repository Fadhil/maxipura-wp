<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Sales_View_New_IM_HC_MVC extends _HC_MVC
{
	public function render( $values = array() )
	{
		$out = $this->make('/html/view/container');

		$form = $this->make('form');
		$form
			->set_values( $values )
			;

		$input_addons = array();
		$input_addons['ref'] = $this->make('/html/view/link')
			->to('/conf', array('--tab' => 'sales'))
			->new_window()
			->add( $this->make('/html/view/icon')->icon('cog') )
			->add_attr('title', HCM::__('Configure'))
			->add_attr('class', 'hc-theme-btn-submit', 'hc-theme-btn-secondary')
			->add_attr('class', 'hc-ml1')
			;

		$link = $this->make('/html/view/link')
			->to('add')
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

			if( isset($input_addons[$input_name]) ){
				$input_view->set_content( array($input, $input_addons[$input_name]) );
			}
			else {
				$input_view->set_content( $input );
			}

			$display_form
				->add( $input_view )
				;
		}

		if( ! $form->readonly() ){
			$buttons = $this->make('/html/view/list-inline')
				;
			$buttons->add(
				$this->make('/html/view/element')->tag('input')
					->add_attr('type', 'submit')
					->add_attr('title', HCM::__('Add New Sale') )
					->add_attr('value', HCM::__('Add New Sale') )
					->add_attr('class', 'hc-theme-btn-submit', 'hc-theme-btn-primary')
				);

			$display_form
				->add(
					$this->make('/html/view/label-input')
						->set_content( $buttons )
						// ->set_observe('date=* ref=*')
						// ->set_observe('date=*')
					)
				;
		}

		$out->add( $display_form );
		return $out;
	}
}