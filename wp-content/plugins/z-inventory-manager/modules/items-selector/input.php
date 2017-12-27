<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Selector_Input_IM_HC_MVC extends HC_Form_Input2
{
	protected $price_field = 'price';

	public function always_label()
	{
		return TRUE;
	}

	public function set_price_field( $price_field )
	{
		$this->price_field = $price_field;
		return $this;
	}

	public function price_field()
	{
		return $this->price_field;
	}

	public function render()
	{
		$value = $this->value();
		$readonly = $this->readonly();

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
			->add_attr('class', 'hc-py2')
			->add_attr('class', 'hc-px2')

			->add_attr('class', 'hc-border-bottom')
			->add_attr('class', 'hc-mb1')
			->add_attr('class', 'hcj2-header')
			->add_attr('class', 'hc-hide-xs')

			->add( HCM::__('Title'), 6 )
			->add( HCM::__('Quantity'), 2 )
			->add( HCM::__('Price'), 2 )
			->add( HCM::__('Total'), 2 )
			;
		if( ! $value ){
			$header_view
				->add_attr('style', 'display: none')
				;
		}
		$items_view
			->add( $header_view )
			;

		if( $value ){
			$controller = $this->make('controller/zoom');
			foreach( $value as $item_id => $item_details ){
				$item_view = $controller
					->run('route-index', 
						'id', $item_id,
						'qty', $item_details['qty'],
						'price', $item_details['price'],
						'input', $name,
						'readonly', $readonly
						)
					;
				$items_view
					->add( $item_view )
					;
				$my_total += $item_details['qty'] * $item_details['price'];
			}
		}

	// add link
		$price_field = $this->price_field();

		$add_link_template = $this->make('/html/view/link')
			->to('', array('--input' => $name, '--price_field' => $price_field, '--skip' => '_SKIP_') )
			->ajax()
			->add_attr('class', 'hcj2-ajax-loader')
			->add( $this->make('/html/view/icon')->icon('plus') )
			->add( HCM::__('Add Item') )
			->add_attr('class', 'hc-theme-tab-link')
			->run('render')
			;

		$add_block = $this->make('/html/view/ajax-loaded');
		$add_block_template = $this->make('/html/view/ajax-loaded');

		if( $value ){
			$skip = join('|', array_keys($value));
		}
		else {
			$skip = 0;
		}

		$add_link = str_replace( '_SKIP_', $skip, $add_link_template );

		$add_block = $add_block
			->add( $add_link )
			;
		$add_block_template = $add_block_template
			->add( $add_link_template )
			;

		$template_id = 'hc_' . HC_Lib2::generate_rand();
		$add_block_template = $this->make('/html/view/element')
			->tag('script')
			->add_attr('type', 'text/template')
			->add_attr('id', $template_id)
			->add( $add_block_template )
			;

		$total_view = $this->make('/html/view/grid')
			->add_attr('class', 'hcj2-footer')
			->add_attr('class', 'hc-py2')
			->add_attr('class', 'hc-px2')
			->add_attr('class', 'hc-fs5')
			->add(
				$this->make('/html/view/element')->tag('div')
					->add( HCM::__('Total') )
					->add_attr('class', 'hc-px3-sm')
					->add_attr('class', 'hc-align-sm-right')
				, 10 
				)
			->add(
				$this->make('/finance_html/view/currency')
					->add_attr('class', 'hcj2-total')
					->set_value( $my_total )
					,
				2
				)
			;

		if( ! $value ){
			$total_view
				->add_attr('style', 'display: none')
				;
		}

		$js = <<<EOT

<script type="text/javascript">
jQuery(document).on( 'item_added', '#$container_id', function(event)
{
	var item_inputs = jQuery(this).find("input[name$='_item\[\]']");
	var item_ids = [];
	item_inputs.each( function(index)
	{
		item_ids.push( jQuery(this).val() );
	});

	var append_html = jQuery('#$template_id').html();
	append_html = append_html.replace('_SKIP_', item_ids.join('|'));
	jQuery(this).find('.hcj2-items').append( append_html );
});

jQuery(document).on( 'recalc', '#$container_id .hcj2-total', function(event)
{
	var this_total;
	this_total = 0;
	jQuery('#$container_id .hcj2-subtotal').each( function(index)
	{
		var this_subtotal = parseFloat( hc2_widget_value(jQuery(this)) );
		if( this_subtotal ){
			this_total += this_subtotal;
		}
	});
	hc2_widget_set_value( jQuery('#$container_id .hcj2-total'), this_total );

	if( jQuery('#$container_id .hcj2-subtotal').length ){
		jQuery('#$container_id .hcj2-header').show();
		jQuery('#$container_id .hcj2-footer').show();
	}
	else {
		jQuery('#$container_id .hcj2-header').hide();
		jQuery('#$container_id .hcj2-footer').hide();
	}
});

jQuery(document).on( 'change', '#$container_id .hcj2-subtotal', function(event)
{
	jQuery('#$container_id .hcj2-total').trigger('recalc');
});
// jQuery('#$container_id .hcj2-total').trigger('recalc');

</script>

EOT;

		if( ! $readonly ){
			$items_view
				->add( $add_block )
				->add( $add_block_template )
				;
		}

		$out
			->add( $items_view )
			->add( $total_view )
			;

		if( ! $readonly ){
			$out
				->add( $js )
				;
		}

		$return = $this->decorate( $out );
		return $return;
	}

	public function grab( $post )
	{
		$return = array();

		$ii = 1;

		$input_item = $this->make('/form/view/select')
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

		$input_price = $this->make('/form/view/text')
			->set_name( $this->name() . '_price[]' )
			;
		$input_price->grab( $post );
		$prices = $input_price->value();

		$ii = 0;
		foreach( $items as $item_id ){
			if( $item_id ){
				$return[$item_id] = array();
				if( isset($qtys[$ii]) && $qtys[$ii] ){
					$return[$item_id]['qty'] = $qtys[$ii];
				}
				else {
					unset($return[$item_id]);
					continue;
				}

				if( isset($prices[$ii]) ){
					$return[$item_id]['price'] = $prices[$ii];
				}
			}
			$ii++;
		}

		$this->set_value( $return );
		return $this;
	}
}