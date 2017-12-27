<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Model_Manager_IM_HC_MVC extends _HC_MVC
{
	public function single_instance()
	{
	}

	public function item_count( $item_id )
	{
		$return = 0;
		return $return;
	}

	public function item_count_by_location( $item_id )
	{
		$return = array();

		$locations = $this->make('/http/lib/api')
			->request('/api/locations')
			->get()
			->response()
			;

		foreach( $locations as $location ){
			$return[ $location['id'] ] = 0;
		}

		return $return;
	}
}