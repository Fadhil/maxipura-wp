<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Finance_Html_View_Currency_HC_MVC extends Html_View_Element_HC_MVC
{
	protected $value = NULL;

	public function set_value( $value )
	{
		$this->value = $value;
		return $this;
	}

	public function value()
	{
		return $this->value;
	}

	public function render()
	{
		$value = $this->value();

		$this_id = 'hc_' . HC_Lib2::generate_rand();
		$out = $this->make('/html/view/element')->tag('span')
			->add_attr('id', $this_id)
			;

		$calc = $this->make('/finance/lib/calc');
		$amount_view = $calc->format( $value );

		// list( $before_sign, $dec_point, $thousand_sep, $after_sign ) = $formatConf;
		list( $dec_point, $thousand_sep ) = $calc->format_settings();

		$attr = $this->attr();
		foreach( $attr as $k => $v ){
			$out->add_attr( $k, $v );
		}

		$out
			->add( $amount_view )
			->add_attr('data-value', $value)
			;

		$js = <<<EOT

<script type="text/javascript">
jQuery(document).on( 'change', '#$this_id', function(event)
{
	new_value = jQuery(this).data('value');
	new_view_value = hc2_php_number_format( new_value, 2, '$dec_point', '$thousand_sep' );
	jQuery(this).html( new_view_value );
});
</script>

EOT;

		$out = $this->make('/html/view/container')
			->add( $out )
			->add( $js )
			;
		return $out;
	}
}