<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Receives_Purchases_View_Edit_IM_HC_MVC extends _HC_MVC
{
	public function render( $receive )
	{
		$purchase = $receive['purchase'];

		$form = $this->make('form');
		$form->set_values( $receive );

		$purchase_manager = $this->make('/purchases_items/model/manager');
		$need_items = $purchase_manager->run('need-items', $purchase);

		$receive_manager = $this->make('/items_purchases_receives/model/manager');
		$received_items = $receive_manager->run('received-items', $purchase);

		$my_items = $receive['items'];
		foreach( $my_items as $item_id => $my_item ){
			if( isset($received_items[$item_id]) ){
				$received_items[$item_id] -= $my_item['_qty'];
			}
			
			if( ! isset($need_items[$item_id]) ){
				$need_items[$item_id] = 0;
			}
			$need_items[$item_id] += $my_item['_qty'];
		}

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

		$link = $this->make('/html/view/link')
			->to('update', array('-id' => $receive['id']))
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
					->add_attr('title', HCM::__('Save') )
					->add_attr('value', HCM::__('Save') )
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