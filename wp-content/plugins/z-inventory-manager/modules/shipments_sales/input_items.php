<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Shipments_Sales_Input_Items_IM_HC_MVC extends HC_Form_Input2
{
	public function always_label()
	{
		return TRUE;
	}

	public function render()
	{
		$value = $this->value();

		$name = $this->name();
		$my_total = 0;

		$container_id = 'hc_' . HC_Lib2::generate_rand();
		$out = $this->make('/html/view/element')->tag('div')
			->add_attr('class', 'hc-theme-box')
			->add_attr('id', $container_id)
			->add_attr('class', 'hcj2-event-catcher')
			;

	// current ones
		$items_view = $this->make('/html/view/element')->tag('div')
			->add_attr('class', 'hcj2-items')
			;


	// header
		$header_view = $this->make('/html/view/grid')
			->add_attr('class', 'hc-px2')
			->add_attr('class', 'hc-py2')
			->add_attr('class', 'hc-border-bottom')
			->add_attr('class', 'hc-mb1')
			->add_attr('class', 'hc-hide-xs')

			->add( HCM::__('Title'), 6 )
			->add( HCM::__('Ordered'), 2 )
			->add( HCM::__('Shipped'), 2 )
			->add( HCM::__('Shipping Now'), 2 )
			;
		$items_view
			->add( $header_view )
			;

		$items_conf = $this->conf('items');

		if( ! $value ){
			$value = array();
			foreach( $items_conf as $item_id => $item_details ){
				if( ! isset($item_details['need']) ){
					continue;
				}
				$value[ $item_id ] = array('qty' => $item_details['need']);
			}
		}

		if( $value ){
			foreach( $value as $item_id => $item_details ){
				$item_conf = $items_conf[$item_id];

				$item_title = isset( $item_conf['title'] ) ? $item_conf['title'] : NULL;
				$item_qty = isset( $value[$item_id]['qty'] ) ? $value[$item_id]['qty'] : $item_conf['need'];

				$input_item = $this->make('/form/view/hidden')
					->set_name( $this->name() . '_item[]' )
					->set_value( $item_id )
					;
				$input_qty = $this->make('/form/view/text')
					->set_name( $this->name() . '_qty[]' )
					->add_attr('size', 4)
					->set_value( $item_qty )
					;

				$item_view = $this->make('/html/view/grid')
					->add_attr('class', 'hc-px2')
					->add_attr('class', 'hc-py2')
					->add_attr('class', 'hc-border-bottom')
					->add_attr('class', 'hc-mb1')

					->add( array($input_item, $item_title),	6 )
					->add( $item_conf['need'] + $item_conf['shipped'],		2 )
					->add( $item_conf['shipped'],	2 )
					->add( $input_qty,				2 )
					;

				$items_view
					->add( $item_view )
					;
			}
		}

		$out
			->add( $items_view )
			;

		$return = $this->decorate( $out );
		return $return;
	}

	public function grab( $post )
	{
		$return = array();

		$ii = 1;

		$input_item = $this->make('/form/view/hidden')
			->set_name( $this->name() . '_item[]' )
			;
		$input_item->grab( $post );
		$items = $input_item->value();
		if( ! $items ){
			$items = array();
		}

		$input_qty = $this->make('/form/view/text')
			->set_name( $this->name() . '_qty[]' )
			;
		$input_qty->grab( $post );
		$qtys = $input_qty->value();

		$ii = 0;
		foreach( $items as $item_id ){
			if( $item_id ){
				$return[$item_id] = array();
				if( isset($qtys[$ii]) ){
					$return[$item_id]['qty'] = $qtys[$ii];
				}
			}
			$ii++;
		}

		$this->set_value( $return );
		return $this;
	}
}