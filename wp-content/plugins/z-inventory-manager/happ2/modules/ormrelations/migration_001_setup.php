<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class ORMRelations_Setup_HC_Migration extends HC_Migration
{
	public function up()
	{
		if( $this->db->table_exists('relations') ){
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
				'from_id' => array(
					'type' => 'INT',
					'null' => FALSE,
					'unsigned' => TRUE, 
					),
				'to_id' => array(
					'type' => 'INT',
					'null' => FALSE,
					'unsigned' => TRUE, 
					),
				'relation_name' => array(
					'type' => 'VARCHAR(64)',
					'null' => TRUE,
					),
				)
			);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('relations');
	}

	public function down()
	{
		if( $this->db->table_exists('relations') ){
			$this->dbforge->drop_table('relations');
		}
	}
}