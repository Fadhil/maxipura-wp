<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Shipments_Sales_View_Index_IM_HC_MVC extends _HC_MVC
{
	public function render( $entries, $sale, $shipped_items )
	{
		$out = $this->make('/html/view/element')->tag('div')
			;
		$item_presenter = $this->make('/items/presenter');
		$shipment_presenter = $this->make('/shipments/presenter');
		$sale_items = $sale['items'];

	// total
		$total_header_view = $this->make('/html/view/grid')
			->add_attr('class', 'hc-px2')
			->add_attr('class', 'hc-py2')
			->add_attr('class', 'hc-border-bottom')
			->add_attr('class', 'hc-mb1')
			->add_attr('class', 'hc-hide-xs')

			->add( HCM::__('Title'), 6 )
			->add( HCM::__('Ordered'), 2 )
			->add( HCM::__('Shipped'), 2 )
			->add( HCM::__('To Ship'), 2 )
			;

		$out
			->add( $total_header_view )
			;

		foreach( $sale_items as $e ){
			$item_presenter->set_data( $e );
			$title_view = $item_presenter->present_title();
			$title_view = $this->make('/html/view/element')->tag('span')
				->add_attr('class', 'hc-fs4')
				->add( $title_view )
				;

			$this_ordered = $e['_qty'];
			$this_shipped = isset($shipped_items[$e['id']]) ? $shipped_items[$e['id']] : 0;
			$this_to_ship = $this_ordered - $this_shipped;

			$e_item_view = $this->make('/html/view/grid')
				->add_attr('class', 'hc-px2')
				->add_attr('class', 'hc-py2')
				->add_attr('class', 'hc-border-bottom')
				->add_attr('class', 'hc-mb1')

				->add( $title_view, 6 )
				->add( $this_ordered, 2 )
				->add( $this_shipped, 2 )
				->add( $this_to_ship, 2 )
				;

			$out
				->add( $e_item_view )
				;
		}

		if( $entries ){
			$out
				->add(
					$this->make('/html/view/element')->tag('h2')
						->add( HCM::__('Shipments') )
						->add_attr('class', 'hc-mt3')
						->add_attr('class', 'hc-mb2')
					)
				;
		}

	// header
		foreach( $entries as $e ){
			$shipment_presenter->set_data( $e );

			$e_view = $this->make('/html/view/element')->tag('div')
				;

			$date_view = $shipment_presenter->present_date();

			$also_show = array(
				'carrier'		=> HCM::__('Carrier'),
				'track_no'		=> HCM::__('Tracking Number'),
				'description'	=> HCM::__('Comments'),
				);

			foreach( $also_show as $k => $v ){
				if( strlen($e[$k]) ){
					$e_view
						->add(
							$this->make('/html/view/label-input')
								->set_label($v)
								->set_content($e[$k])
							)
						;
				}
			}

			$e_items_header_view = $this->make('/html/view/grid')
				->add_attr('class', 'hc-px2')
				->add_attr('class', 'hc-py2')
				->add_attr('class', 'hc-border-bottom')
				->add_attr('class', 'hc-mb1')
				->add_attr('class', 'hc-hide-xs')

				->add( HCM::__('Title'), 8 )
				->add( HCM::__('Shipped'), 4 )
				;

			$e_items_view = $this->make('/html/view/element')->tag('div')
				;

			$e_items_view
				->add( $e_items_header_view )
				;

			foreach( $e['items'] as $item ){
				$item_presenter->set_data( $item );
				$title_view = $item_presenter->present_title();
				$title_view = $this->make('/html/view/element')->tag('span')
					->add_attr('class', 'hc-fs4')
					->add( $title_view )
					;

				$e_item_view = $this->make('/html/view/grid')
					->add_attr('class', 'hc-px2')
					->add_attr('class', 'hc-py2')
					->add_attr('class', 'hc-border-bottom')
					->add_attr('class', 'hc-mb1')

					->add( $title_view, 8 )
					->add( $item['_qty'], 4 )
					;

				$e_items_view
					->add( $e_item_view )
					;
			}

			$e_items_view = $this->make('/html/view/label-input')
				->set_content( $e_items_view )
				->set_label( HCM::__('Items') )
				;

		// buttons
			$buttons = $this->make('/html/view/list-inline')
				->add_attr('class', 'hc-mt2')
				;

			$buttons
				->add('edit',
					$this->make('/html/view/link')
						->to('edit', array('-id' => $e['id']))
						->add_attr( 'title', HCM::__('Edit') )
						->add_attr('class', 'hc-theme-btn-submit', 'hc-theme-btn-secondary')
						->add( HCM::__('Edit') )
						->add_attr('class', 'hcj2-ajax-loader')
						
					)

				->add('delete',
					$this->make('/html/view/link')
						->to('/shipments/delete', $e['id'])
						->add_attr('class', 'hcj2-confirm')
						->add_attr( 'title', HCM::__('Delete') )
						->add_attr('class', 'hc-theme-btn-submit', 'hc-theme-btn-danger')
						->add( HCM::__('Delete') )
					)
				;

			$e_view
				->add( $e_items_view )
				->add( $buttons )
				;

			$e_view
				->add_attr('class', 'hcj2-ajax-container')
				->add_attr('class', 'hc-p2')
				;

			$print_link = $this->make('/print/view/link')
				->to('/shipments_sales/zoom', 
					array_merge( 
						array('-id' => $e['id']),
						$this->make('/print/controller')->run('print-view-args')
						)
					)
				->add_attr('class', 'hc-right-sm')
				->add_attr('class', 'hc-white')
				;

			$panel_label = $this->make('/html/view/element')->tag('div')
				->add_attr('class', 'hc-p2') 
				->add_attr('class', 'hc-white')
				->add_attr('class', 'hc-bg-gray')

				->add( $print_link )
				->add(
					$this->make('/html/view/list')
						->add( $shipment_presenter->present_title() )
						->add( $date_view )
					)
				;

			$panel = $this->make('/html/view/element')->tag('div')
				->add_attr('class', 'hc-mb3')
				->add_attr('class', 'hc-border')
				->add_attr('class', 'hc-rounded')

				->add( $panel_label )
				->add( $e_view )
				
				->add_attr('class', 'hcj2-ajax-container')
				;

			$out
				->add( $panel )
				;
		}

		return $out;
	}
}