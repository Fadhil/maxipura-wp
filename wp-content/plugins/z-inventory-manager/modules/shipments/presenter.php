<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Shipments_Presenter_IM_HC_MVC extends _HC_MVC_Model_Presenter
{
	public function present_title()
	{
		$return = HCM::__('Shipment') . ' ' . $this->data('ref');
		return $return;
	}

	public function present_date()
	{
		$return = $this->data('date');

		$t = $this->make('/app/lib')->run('time');
		$t->setDateDb( $return );
		$return = $t->formatDateFull();

		return $return;
	}

}