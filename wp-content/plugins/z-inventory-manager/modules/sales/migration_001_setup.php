<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Sales_Setup_IM_HC_Migration extends HC_Migration
{
	public function up()
	{
		if( $this->db->table_exists('sales') ){
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
		$this->dbforge->create_table('sales');
	}

	public function down()
	{
		if( $this->db->table_exists('sales') ){
			$this->dbforge->drop_table('sales');
		}
	}
}