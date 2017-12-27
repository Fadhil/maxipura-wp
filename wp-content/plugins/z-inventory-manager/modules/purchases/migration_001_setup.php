<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Purchases_Setup_IM_HC_Migration extends HC_Migration
{
	public function up()
	{
		if( $this->db->table_exists('purchases') ){
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
				'date' => array(
					'type' => 'INT',
					'null' => FALSE,
					),
				'ref' => array(
					'type'	=> 'VARCHAR(100)',
					'null'	=> FALSE,
					'unique'	=> TRUE,
					),
				'status' => array(
					'type'		=> 'TINYINT',
					'null'		=> FALSE,
					'default'	=> 1,
					),
				'description' => array(
					'type'		=> 'TEXT',
					'null'		=> TRUE,
					),
				)
			);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('purchases');
	}

	public function down()
	{
		if( $this->db->table_exists('purchases') ){
			$this->dbforge->drop_table('purchases');
		}
	}
}