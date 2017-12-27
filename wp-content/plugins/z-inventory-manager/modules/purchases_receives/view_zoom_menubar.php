<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Purchases_Receives_View_Zoom_Menubar_IM_HC_MVC extends _HC_MVC 
{
	public function extend_render( $menubar, $args, $src )
	{
		$purchase = array_shift( $args );
		$purchase_obj = $this->make('/purchases/model');

		$manager = $this->make('/purchases_items/model/manager');
		$need_items = $manager->run('need-items', $purchase);

		if( (isset($purchase['receives']) && $purchase['receives']) ){
			$menubar->add(
				'receives',
				$this->make('/html/view/link')
					->to('/receives_purchases', array('-purchase' => $purchase['id']) )
					->add( $this->make('/html/view/icon')->icon('list') )
					->add( HCM::__('Received Items') )
				);
		}

		if( $purchase['status'] != $purchase_obj->_const('STATUS_DRAFT') ){
			if( $need_items ){
				$menubar->add(
					'receive',
					$this->make('/html/view/link')
						->to('/receives_purchases/new', array('-purchase' => $purchase['id']) )
						->add( $this->make('/html/view/icon')->icon('arrow-right') )
						->add( HCM::__('Receive Items') )
					);
			}
		}

		return $menubar;
	}
}