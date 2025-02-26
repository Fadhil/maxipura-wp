<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_View_History_Layout_IM_HC_MVC extends _HC_MVC
{
	public function render( $content, $model )
	{
		$menubar = $this->make('view/history/menubar')
			->run('render', $model)
			;
		$header = $this->make('view/history/header')
			->run('render', $model)
			;

		$out = $this->make('/layout/view/content-header-menubar')
			->set_content( $content )
			->set_header( $header )
			->set_menubar( $menubar )
			;

		return $out;
	}
}