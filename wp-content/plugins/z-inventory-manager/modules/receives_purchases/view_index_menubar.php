<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Receives_Purchases_View_Index_Menubar_IM_HC_MVC extends _HC_MVC 
{
	public function render( $purchase )
	{
		$menubar = $this->make('/html/view/container');
		$presenter = $this->make('/purchases/presenter');
		$presenter->set_data( $purchase );
		$purchase_obj = $this->make('/purchases/model');

		$manager = $this->make('/purchases_items/model/manager');
		$need_items = $manager->run('need-items', $purchase);

	// BACK TO PURCHASE
		$menubar->add(
			'purchase',
			$this->make('/html/view/link')
				->to('/purchases/zoom', array('-id' => $purchase['id']))
				->add( $this->make('/html/view/icon')->icon('arrow-left') )
				->add( $presenter->present_title() )
			);

		if( $purchase['status'] != $purchase_obj->_const('STATUS_DRAFT') ){
			if( $need_items ){
				$menubar->add(
					'receive-partial',
					$this->make('/html/view/link')
						->to('new', array('-purchase' => $purchase['id']) )
						->add( $this->make('/html/view/icon')->icon('arrow-right') )
						->add( HCM::__('Receive Items') )
					);
			}
		}

		return $menubar;
	}
}