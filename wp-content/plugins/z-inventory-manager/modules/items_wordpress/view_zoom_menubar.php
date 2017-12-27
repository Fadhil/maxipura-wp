<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Wordpress_View_Zoom_Menubar_IM_HC_MVC extends _HC_MVC
{
	public function render( $post )
	{
		$id = $post->ID;

		$api = $this->make('/http/lib/api')
			->request('/api/items')
			->add_param('id', $id)
			->get()
			;

		$status_code = $api->response_code();
		if( substr($status_code, 0, 1) == '4' ){
			return;
		}

		$model = $api
			->response()
			;

		$menubar = $this->make('/items/view/zoom/menubar')
			->run('render', $model)
			;

		if( is_object($menubar) && ($menubar_items = $menubar->children()) ){
			$menubar = $this->make('/html/view/sidebar')
				->set_children( $menubar_items )
				;
			echo $menubar;
		}
	}
}
