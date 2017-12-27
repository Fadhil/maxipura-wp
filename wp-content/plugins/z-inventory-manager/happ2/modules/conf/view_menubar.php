<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Conf_View_Menubar_HC_MVC extends _HC_MVC
{
	public function render( $tabs, $current_tab = NULL )
	{
		$menubar = $this->make('/html/view/container');

		foreach( $tabs as $this_tab => $tab_props ){
			$this_tab_label = isset($tabs[$this_tab]['_label']) ? $tabs[$this_tab]['_label'] : $this_tab;

			if( in_array($this_tab, $current_tab) ){
				$link = $this->make('/html/view/element')->tag('span')
					->add( $this_tab_label )
					->add_attr('class', 'hc-theme-btn-submit', 'hc-theme-btn-secondary')
					;
			}
			else {
				$link = $this->make('/html/view/link')
					->to('', array('--tab' => $this_tab))
					->add( $this_tab_label )
					;
			}

			$menubar->add(
				$this_tab,
				$link
				);
		}

		return $menubar;
	}
}