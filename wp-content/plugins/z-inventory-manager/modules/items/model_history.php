<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Model_History_IM_HC_MVC extends _HC_MVC
{
	public function single_instance()
	{
	}

	public function get( $item_id )
	{
		$return = $this->run('prepare', $item_id);
	// sort by timestamp
		uasort( $return, create_function('$a, $b', 'return ($b[0] - $a[0]);' ) );

		return $return;
	}

	public function prepare( $item_id )
	{
		$return = array();
		// array(timestamp, description)

		return $return;
	}
}