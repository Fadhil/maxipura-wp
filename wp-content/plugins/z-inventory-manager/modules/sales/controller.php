<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Sales_Controller_IM_HC_MVC extends _HC_MVC
{
	public function route_index()
	{
		$args = $this->make('/app/lib/args')->run('parse', func_get_args());

		$sort = $args->get('sort');
		$skip = $args->get('skip');
		$search = $args->get('search');
		$page = $args->get('page') ? $args->get('page') : 1;

		$per_page = 20;

		$api = $this->make('/http/lib/api')
			->request('/api/sales')
			;

		if( $search ){
			$api->add_param('search', $search);
		}
		if( $skip ){
			$api->add_param('id', array('NOTIN', $skip));
		}

		$api->add_param('count', 1);

		$total_count = $api
			->get()
			->response()
			;

		$limit = $per_page;

		if( $total_count > $per_page ){
			$pager = $this->make('/html/view/pager')
				->set_total_count( $total_count )
				->set_per_page( $per_page )
				;
			if( $page > $pager->number_of_pages() ){
				$page = $pager->number_of_pages();
			}
		}

		if( $page && $page > 1 ){
			$limit = array( $per_page, ($page - 1) * $per_page );
		}
		else {
			$limit = $per_page;
		}

		$api
			->add_param('with', '-all-')
			->add_param('limit', $limit )
			;

		if( $sort ){
			$api->add_param('sort', $sort );
		}
		if( $skip ){
			$api->add_param('id', array('NOTIN', $skip));
		}
		if( $search ){
			$api->add_param('search', $search);
		}

		$entries = $api
			->get()
			->response()
			;

		$view = $this->make('view/index')
			->run('render', $entries, $total_count, $page, $search)
			;
		$view = $this->make('view/index/layout')
			->run('render', $view)
			;
		$view = $this->make('/layout/view/body')
			->set_content($view)
			;
		return $this->make('/http/view/response')
			->set_view($view)
			;
	}
}