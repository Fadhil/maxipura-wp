<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Shipments_Sales_View_Index_Menubar_IM_HC_MVC extends _HC_MVC 
{
	public function render( $sale )
	{
		$menubar = $this->make('/html/view/container');
		$presenter = $this->make('/sales/presenter');
		$presenter->set_data( $sale );
		$sale_obj = $this->make('/sales/model');

		$manager = $this->make('/sales_items/model/manager');
		$need_items = $manager->run('need-items', $sale);

	// BACK TO SALE
		$menubar->add(
			'sale',
			$this->make('/html/view/link')
				->to('/sales/zoom', array('-id' => $sale['id']))
				->add( $this->make('/html/view/icon')->icon('arrow-left') )
				->add( $presenter->present_title() )
			);

		if( $sale['status'] != $sale_obj->_const('STATUS_DRAFT') ){
			if( $need_items ){
				$menubar->add(
					'ship',
					$this->make('/html/view/link')
						->to('new', array('-sale' => $sale['id']) )
						->add( HCM::__('Ship Items') )
						->add( $this->make('/html/view/icon')->icon('arrow-right') )
					);
			}
		}

		return $menubar;
	}
}