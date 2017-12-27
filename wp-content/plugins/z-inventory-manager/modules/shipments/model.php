<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Shipments_Model_IM_HC_MVC extends _HC_ORM
{
	protected $type = 'shipment';
	protected $table = 'shipments';
	protected $default_order_by = array(
		'date'		=> 'DESC',
		);

	public function save()
	{
		if( ! $this->get('date') ){
			$t = $this->make('/app/lib')->run('time');
			$date = $t->formatDateDb();
			$this->set('date', $date );
		}

		if( ! strlen($this->get('ref')) ){
			$app_settings = $this->make('/app/lib/settings');
			$ref = $app_settings->run('get', 'shipments:next_ref');
			$this->set('ref', $ref);
		}

		return parent::save();
	}
}