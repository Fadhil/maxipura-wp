<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Purchases_Model_IM_HC_MVC extends _HC_ORM
// class Purchases_Model_IM_HC_MVC extends _HC_ORM_EVA
{
	protected $type = 'purchase';
	protected $table = 'purchases';
	protected $default_order_by = array(
		'date'	=> 'DESC',
		);
	protected $search_in = array('ref', 'description');

	const STATUS_DRAFT = 1;
	const STATUS_ISSUED = 2;
	const STATUS_PARTIALLY_RECEIVED = 3;
	const STATUS_RECEIVED = 4;

	public function save()
	{
		$ref = $this->get('ref');
		if( ! strlen($ref) ){
			$app_settings = $this->make('/app/lib/settings');
			$ref = $app_settings->run('get', 'purchases:next_ref');
			$this->set('ref', $ref);
		}

	// save seqno
		// $seqno = $this->custom_next_seqno();
		// $this->set( 'seqno', $seqno );

		return parent::save();
	}
}