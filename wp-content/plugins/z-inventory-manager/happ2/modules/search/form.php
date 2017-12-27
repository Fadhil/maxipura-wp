<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Search_Form_HC_MVC extends _HC_Form
{
	public function _init()
	{
		$this
			->set_input( 'search',
				$this->make('/form/view/text')
					->add_attr('size', 12)
				)
			;

		return $this;
	}
}