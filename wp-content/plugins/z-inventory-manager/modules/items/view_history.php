<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_View_History_IM_HC_MVC extends _HC_MVC 
{
	public function render( $model, $entries )
	{
		$out = $this->make('/html/view/table')
			;

		$header = array(
			'time'			=> HCM::__('Date'),
			'description'	=> '',
			);

		$rows = array();
		$t = $this->make('/app/lib')->run('time');

		foreach( $entries as $e ){
			$ts = $e[0];
			$description = $e[1];

			$t->setTimestamp( $ts );
	
			$rows[] = array(
				'time'			=> $t->formatDateFull(),
				'description'	=> $description,
				);
		}

		$out
			// ->set_header( $header )
			->set_rows( $rows )
			;

		return $out;
	}
}