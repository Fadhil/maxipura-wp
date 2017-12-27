<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Receives_Conf_Controller_IM_HC_MVC extends _HC_Form
{
	static $last_seq_no = NULL;

	protected function _get_seq_no( $random = FALSE )
	{
		$length = 8;

		if( $random ){
			$new_seq_no = rand(10000000, 99999999);
		}
		else {
			if( self::$last_seq_no === NULL ){
				$latest_one = $this->make('/http/lib/api')
					->request('/api/receives')
					->add_param('sort', array('id', 0))
					->add_param('limit', 1)
					->get()
					->response()
					;
				if( $latest_one ){
					$latest_one = array_shift( $latest_one );
					$new_seq_no = $latest_one['id'] + 1;
				}
				else {
					$new_seq_no = 1;
				}
			}
			else {
				$new_seq_no = self::$last_seq_no + 1;
			}
			self::$last_seq_no = $new_seq_no;

			$new_seq_no = (string) $new_seq_no;
			$new_seq_no = str_pad( $new_seq_no, $length, '0', STR_PAD_LEFT);
		}
		return $new_seq_no;
	}

	public function settings_before_get( $args, $src )
	{
		$return = NULL;
		$pname = array_shift($args);

		switch( $pname ){
			case 'receives:next_ref':
				$auto_gen = $src->run('get', 'receives:ref_auto_gen');

				if( $auto_gen ){
					$prefix = $src->run('get', 'receives:ref_prefix');
					$random = $src->run('get', 'receives:ref_number_random');

					$exists = TRUE;
					while( $exists ){
						$new_seq_no = $this->_get_seq_no( $random );
						$return = $prefix . $new_seq_no; 
						$exists = $this->make('/http/lib/api')
							->request('/api/receives')
							->add_param('ref', $return)
							->add_param('limit', 1)
							->get()
							->response()
							;
					} 
				}
				break;
		}

		if( $return !== NULL ){
			return $return;
		}
	}
}