<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Sales_Shipments_View_Zoom_Menubar_IM_HC_MVC extends _HC_MVC 
{
	public function extend_render( $menubar, $args, $src )
	{
		$sale = array_shift( $args );
		$sale_obj = $this->make('/sales/model');

		$manager = $this->make('/sales_items/model/manager');
		$need_items = $manager->run('need-items', $sale);

		if( (isset($sale['shipments']) && $sale['shipments']) ){
			$menubar->add(
				'shipments',
				$this->make('/html/view/link')
					->to('/shipments_sales', array('-sale' => $sale['id']) )
					->add( $this->make('/html/view/icon')->icon('list') )
					->add( HCM::__('Shipped Items') )
				);
		}

		if( $sale['status'] != $sale_obj->_const('STATUS_DRAFT') ){
			if( $need_items ){
				$menubar->add(
					'ship',
					$this->make('/html/view/link')
						->to('/shipments_sales/new', array('-sale' => $sale['id']) )
						->add( HCM::__('Ship Items') )
						->add( $this->make('/html/view/icon')->icon('arrow-right') )
					);
			}
		}

		return $menubar;
	}
}