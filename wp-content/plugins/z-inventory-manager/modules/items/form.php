<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Form_IM_HC_MVC extends _HC_Form
{
	public function _init()
	{
		$inputs = array(
			'title'	=>
				$this->make('/form/view/text')
					->set_label( HCM::__('Title') )
					->add_attr('size', 32)

					->add_validator( $this->make('/validate/required') )
				,
			'ref'	=>
				$this->make('/form/view/text')
					->set_label( HCM::__('SKU') )
					->add_attr('size', 32)

					->add_validator( $this->make('/validate/required') )
				,
			'description'	=>
				$this->make('/form/view/textarea')
					->set_label( HCM::__('Description') )
					->add_attr('cols', 40)
					->add_attr('rows', 3)
				,
			'cost'	=>
				$this->make('/form/view/text')
					->set_label( HCM::__('Default Cost') )
					->add_attr('size', 12)
				,
			'price'	=>
				$this->make('/form/view/text')
					->set_label( HCM::__('Default Price') )
					->add_attr('size', 12)
				,
			);

		foreach( $inputs as $k => $v ){
			$this
				->set_input( $k, $v )
				;
		}

		return $this;
	}
}