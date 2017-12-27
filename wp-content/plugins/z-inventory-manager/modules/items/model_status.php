<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Model_Status_IM_HC_MVC extends _HC_MVC
{
	public function single_instance()
	{
	}

	public function get( $model )
	{
		$return = array();

	// available count
		$manager = $this->make('model/manager');
		$available = $manager->run('item-count', $model['id']);

		$return['available'] = array(
			HCM::__('In Stock'),
			$available
			);

		return $return;
	}
}