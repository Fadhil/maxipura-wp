<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Finance_Lib_Calc_HC_MVC extends _HC_MVC
{
	protected $result = 0;

	public function reset()
	{
		$this->result = 0;
		return $this;
	}

	public function add( $amount )
	{
		$this->result += $amount;
		return $this;
	}

	public function result()
	{
		$return = $this->result;
		$return = $return * 100;

		$test1 = (int) $return;
		$diff = abs($return - $test1);
		if( $diff < 0.01 ){
		}
		else {
			$return = ($return > 0) ? ceil( $return ) : floor( $return );
		}

		$return = (int) $return;
		$return = $return/100;
		return $return;
	}

	public function format_settings()
	{
		$conf = $this->make('/app/lib/settings');
		$format = $conf->get('finance:currency_format');
		$format = explode( '||', $format );

		// list( $before_sign, $dec_point, $thousand_sep, $after_sign ) = $formatConf;
		// list( $dec_point, $thousand_sep ) = $format;

		return $format;
	}

	public function format( $result = NULL )
	{
		if( $result === NULL ){
			$result = $this->result();
		}

		// list( $before_sign, $dec_point, $thousand_sep, $after_sign ) = $formatConf;
		list( $dec_point, $thousand_sep ) = $this->format_settings();

		$amount = floatval( $result );
		$return = number_format( $amount, 2, $dec_point, $thousand_sep );
		return $return;
	}
}