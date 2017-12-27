<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_View_Status_IM_HC_MVC extends _HC_MVC 
{
	public function render( $model, $entries )
	{
		$table = $this->make('/html/view/table')
			;

		$rows = array();
		foreach( $entries as $e ){
			$rows[] = $e;
		}

		$table
			->set_rows( $rows )
			;

		return $table;
	}
}