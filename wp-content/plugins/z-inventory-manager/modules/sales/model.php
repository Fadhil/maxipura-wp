<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Sales_Model_IM_HC_MVC extends _HC_ORM
{
	protected $type = 'sale';
	protected $table = 'sales';
	protected $default_order_by = array(
		'date'	=> 'DESC',
		);
	protected $search_in = array('ref', 'description');

	const STATUS_DRAFT = 1;
	const STATUS_CONFIRMED = 2;
	const STATUS_PARTIALLY_SHIPPED = 3;
	const STATUS_SHIPPED = 4;

	public function save()
	{
		$ref = $this->get('ref');
		if( ! strlen($ref) ){
			$app_settings = $this->make('/app/lib/settings');
			$ref = $app_settings->run('get', 'sales:next_ref');
			$this->set('ref', $ref);
		}

		return parent::save();
	}
}