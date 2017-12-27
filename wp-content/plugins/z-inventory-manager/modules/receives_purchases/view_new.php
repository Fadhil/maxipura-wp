<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Receives_Purchases_View_New_IM_HC_MVC extends _HC_MVC
{
	public function render( $purchase )
	{
		$form = $this->make('form');

		$defaults = array();

		$t = $this->make('/app/lib')->run('time');
		$defaults['date'] = $t->formatDateDb();

		$manager = $this->make('/purchases_items/model/manager');
		$need_items = $manager->run('need-items', $purchase);

		$manager = $this->make('/items_purchases_receives/model/manager');
		$received_items = $manager->run('received-items', $purchase);

		$presenter = $this->make('/items/presenter');
		$api = $this->make('/http/lib/api')
			->request('/api/items')
			;

		$items_input_conf_items = array();
		foreach( $need_items as $item_id => $qty ){
			$item = $api
				->add_param('id', $item_id)
				->get()
				->response()
				;
			$presenter->set_data( $item );
			$received = isset($received_items[$item_id]) ? $received_items[$item_id] : 0;

			$items_input_conf_items[$item_id] = array(
				'need'		=> $qty,
				'received'	=> $received,
				'title'		=> $presenter->run('present-title')
				);
		}

		$form
			->input('items')
			->set_conf('items', $items_input_conf_items)
			;

		$form->set_values( $defaults );

		$link = $this->make('/html/view/link')
			->to('add', array('-purchase' => $purchase['id']))
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
			$buttons = $this->make('/html/view/list-inline');
			$buttons->add(
				$this->make('/html/view/element')->tag('input')
					->add_attr('type', 'submit')
					->add_attr('title', HCM::__('Receive Items') )
					->add_attr('value', HCM::__('Receive Items') )
					->add_attr('class', 'hc-theme-btn-submit', 'hc-theme-btn-primary')
				);

			$buttons = $this->make('/html/view/grid')
				->add_attr('class', 'hc-px2')
				->add_attr('class', 'hc-py2')
				->add_attr('class', 'hc-mb1')

				->add( NULL,		10 )
				->add( $buttons,	2 )
				;

			$display_form->add( $buttons );
		}

		return $display_form;
	}
}