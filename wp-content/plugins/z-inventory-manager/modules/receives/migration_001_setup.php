<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Receives_Setup_IM_HC_Migration extends HC_Migration
{
	public function up()
	{
		if( $this->db->table_exists('receives') ){
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
				)
			);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('receives');
	}

	public function down()
	{
		if( $this->db->table_exists('receives') ){
			$this->dbforge->drop_table('receives');
		}
	}
}