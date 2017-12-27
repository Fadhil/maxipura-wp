<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Wordpress_View_Index_IM_HC_MVC extends _HC_MVC
{
	protected $rows = array();

	public function posts_columns( $columns )
	{
		$prepare = $this->make('/items/view/index/prepare');

		$return = array();
		$return['cb'] = $columns['cb'];

		$my_return = $prepare->run('prepare-header');
		$return = array_merge( $return, $my_return );
		// $return['title'] = $columns['title'];
		return $return;
	}

	public function custom_columns( $column, $post_id )
	{
		if( ! isset($this->rows[$post_id]) ){
			$api = $this->make('/http/lib/api')
				->request('/api/items')
				->add_param('id', $post_id)
				;
			$model = $api
				->get()
				->response()
				;
			$prepare = $this->make('/items/view/index/prepare');
			$this->rows[$post_id] = $prepare->run('prepare-row', $model);
		}

		$return = NULL;
		$e = $this->rows[$post_id];
		if( array_key_exists($column . '_view', $e) ){
			$return = $e[$column . '_view'];
		}
		elseif( array_key_exists($column, $e) ){
			$return = $e[$column];
		}
		echo $return;
	}
}
