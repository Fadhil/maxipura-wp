<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Shipments_Setup_IM_HC_Migration extends HC_Migration
{
	public function up()
	{
		if( $this->db->table_exists('shipments') ){
			return;
		}

		$this->dbforge->add_field(
			array(
				'id' => array(
					'type' => 'INT',
					'null' => FALSE,
					'unsigned' => TRUE,
					'auto_increment' => TRUE
					),
				'ref' => array(
					'type'	=> 'VARCHAR(100)',
					'null'	=> FALSE,
					'unique'	=> TRUE,
					),
				'date' => array(
					'type' => 'INT',
					'null' => FALSE,
					),
				'description' => array(
					'type'		=> 'TEXT',
					'null'		=> TRUE,
					),
				'carrier' => array(
					'type'	=> 'VARCHAR(64)',
					'null'	=> TRUE,
					),
				'track_no' => array(
					'type'	=> 'VARCHAR(128)',
					'null'	=> TRUE,
					),
				)
			);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('shipments');
	}

	public function down()
	{
		if( $this->db->table_exists('shipments') ){
			$this->dbforge->drop_table('shipments');
		}
	}
}