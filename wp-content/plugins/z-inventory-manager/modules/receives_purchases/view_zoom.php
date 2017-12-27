<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Receives_Purchases_View_Zoom_IM_HC_MVC extends _HC_MVC
{
	public function render( $receive )
	{
		$out = $this->make('/html/view/container');
		$purchase = $receive['purchase'];
		$purchase_presenter = $this->make('/purchases/presenter');
		$purchase_presenter->set_data( $purchase);

	// DETAILS
		$t = $this->make('/app/lib')->run('time');
		$t->setDateDb( $receive['date'] );

		$out
			->add(
				$this->make('/html/view/label-row')
					->set_label( HCM::__('Dispatch Date') )
					->set_content( $t->formatDateFull() )
				)
			;

		$also_show = array(
			'description'	=> HCM::__('Comments'),
			);

		foreach( $also_show as $k => $v ){
			if( strlen($receive[$k]) ){
				$out
					->add(
						$this->make('/html/view/label-row')
							->set_label($v)
							->set_content($receive[$k])
						)
					;
			}
		}

		$out
			->add(
				$this->make('/html/view/label-row')
					->set_label( HCM::__('Purchase #') )
					->set_content( $purchase_presenter->present_title() )
				)
			;

	// ITEMS
		$item_presenter = $this->make('/items/presenter');
		$items_view = $this->make('/html/view/table')
			;
		$header = array(
			'title'	=> HCM::__('Title'),
			'qty'	=> HCM::__('Quantity'),
			);

		$rows = array();
		foreach( $receive['items'] as $item_id => $item ){
			$rows[] = array(
				'title'	=> $item_presenter->set_data($item)->present_title(),
				'qty'	=> $item['_qty'],
				);
		}

		$items_view
			->set_header( $header )
			->set_rows( $rows )
			;

		$out
			->add( $items_view )
			;
		
		return $out;
			
		$items = $shipment['items'];

		foreach( $my_items as $item_id => $my_item ){
			if( isset($shipped_items[$item_id]) ){
				$shipped_items[$item_id] -= $my_item['_qty'];
			}
			if( ! isset($need_items[$item_id]) ){
				$need_items[$item_id] = 0;
			}
			$need_items[$item_id] += $my_item['_qty'];
		}

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
			$shipped = isset($shipped_items[$item_id]) ? $shipped_items[$item_id] : 0;

			$items_input_conf_items[$item_id] = array(
				'need'		=> $qty,
				'shipped'	=> $shipped,
				'title'		=> $presenter->run('present-title')
				);
		}

		$form
			->input('items')
			->set_conf('items', $items_input_conf_items)
			;

		$link = $this->make('/html/view/link')
			->to('update', array('-id' => $shipment['id']))
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

		return $display_form;
	}
}