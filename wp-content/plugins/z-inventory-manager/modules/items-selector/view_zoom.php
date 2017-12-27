<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Selector_View_Zoom_IM_HC_MVC extends _HC_MVC
{
	public function render( $model, $qty = NULL, $price = NULL, $parent_input = NULL, $readonly = FALSE, $available = NULL )
	{
		$out = $this->make('/html/view/container');

		if( ! $qty ){
			$qty = 1;
		}
		if( ! $price ){
			$price = 100;
		}

		$presenter = $this->make('/items/presenter');
		$presenter->set_data( $model );

		$title = $presenter->present_title();
		$title = $this->make('/html/view/element')->tag('span')
			->add_attr('class', 'hc-fs4')
			->add( $title )
			;

		if( ! $readonly ){
			$title
				->add(
					$this->make('/form/view/hidden')
						->set_name( $parent_input . '_item[]' )
						->set_value($model['id'])
					)
				;
		}

		$input_qty = $this->make('/form/view/text')
			->set_name( $parent_input . '_qty[]' )
			->add_attr('size', 4)
			->add_attr('title', HCM::__('Quantity'))
			->set_value( $qty )
			->add_attr('class', 'hcj2-qty')
			->add_validator( $this->make('/validate/required') )
			;
		if( $readonly ){
			$input_qty->set_readonly();
		}

		if( $available !== NULL ){
			$available_view = $this->make('/html/view/element')->tag('span')
				->add_attr('class', 'hc-theme-label')
				->add( $available )
				->add_attr('title', HCM::__('Available'))
				;

			$input_qty = $this->make('/html/view/list-inline')
				->set_gutter(1)
				->add( $input_qty )
				->add( $available_view )
				;
		}

		$input_price = $this->make('/form/view/text')
			->set_name( $parent_input . '_price[]' )
			->add_attr('size', 8)
			->add_attr('title', HCM::__('Price'))
			->set_value( $price )
			->add_attr('class', 'hcj2-price')
			;
		if( $readonly ){
			$input_price->set_readonly();
		}

		$subtotal_view = $this->make('/finance_html/view/currency')
			->add_attr('class', 'hcj2-subtotal')
			->set_value( $qty * $price )
			;

		// $delete_link = $this->make('/html/view/element')->tag('a')
		$delete_link = $this->make('/html/view/link')
			->to('#')
			->add( $this->make('/html/view/icon')->icon('times') )
			->add_attr('class', 'hc-red')
			->add_attr('class', 'hc-closer-nofloat')
			->add_attr('class', 'hcj2-delete')
			->add_attr('class', 'hc-fs4')
			->add_attr('class', 'hc-mr1') 
			;
		
		if( ! $readonly ){
			$title = array($delete_link, $title);
		}

		$parent_id = 'hc_' . HC_Lib2::generate_rand();
		$this_view = $this->make('/html/view/grid')
			->add_attr('id', $parent_id)
			->add_attr('class', 'hc-py2')
			->add_attr('class', 'hc-px2')
			->add_attr('class', 'hc-border-bottom')

			->add( $title, 6 )
			->add( $input_qty, 2 )
			->add( $input_price, 2 )
			->add( $subtotal_view, 2 )
			;

		$anchor_id = 'hc_' . HC_Lib2::generate_rand();
		$js = <<<EOT
<a id="$anchor_id"></a>

<script type="text/javascript">
jQuery('#$anchor_id').closest('.hcj2-event-catcher').trigger('item_added');

jQuery(document).on('change', '#$parent_id input', function(event)
{
	var this_price = jQuery('#$parent_id .hcj2-price').val();
	var this_qty = jQuery('#$parent_id .hcj2-qty').val();
	var this_subtotal = this_price * this_qty;

	hc2_widget_set_value( jQuery('#$parent_id .hcj2-subtotal'), this_subtotal );
});
jQuery('#$parent_id input').trigger('change');

jQuery(document).on('click', '#$parent_id .hcj2-delete', function(event)
{
	var this_total = jQuery(this).closest('.hcj2-event-catcher').find('.hcj2-total');
	jQuery('#$parent_id').remove();
	if( this_total.length ){
		this_total.trigger('recalc');
	}
	return false;
});


</script>

EOT;

		$out
			->add( $this_view )
			;
		
		if( ! $readonly ){
			$out
				->add( $js )
				;
		}
		
		return $out;
	}
}
