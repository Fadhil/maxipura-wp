<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Shipments_Sales_Print_View_Menubar_IM_HC_MVC extends _HC_MVC
{
	public function remove_menubar( $args, $src )
	{
		$is_print_view = $this->make('/print/controller')->run('is-print-view');
		if( $is_print_view ){
			return '';
		}
	}
}