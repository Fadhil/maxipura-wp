<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Controller_Ajax_IM_HC_MVC extends _HC_MVC
{
	public function entries()
	{
		$uri = $this->make('/http/lib/uri');
		$sort = $uri->arg('sort');
		$skip = $uri->arg('skip');
		$search = $uri->arg('search');
		$page = $uri->arg('page') ? $uri->arg('page') : 1;

		$per_page = 10;

		$api = $this->make('/http/lib/api')
			->request('/api/items')
			;

		if( $search ){
			$api->add_param('search', $search);
		}

		if( $skip ){
			$api->add_param('id', array('NOTIN', $skip));
		}

		$api
			->add_param('count', 1)
			;

		$total_count = $api
			->get()
			->response()
			;

		$pager = $this->make('/html/view/pager')
			->set_total_count( $total_count )
			->set_per_page( $per_page )
			;

		if( $page > $pager->number_of_pages() ){
			$page = $pager->number_of_pages();
		}

		if( $page && $page > 1 ){
			$limit = array( $per_page, ($page - 1) * $per_page );
		}
		else {
			$limit = $per_page;
		}

		$api
			->add_param('with', '-all-')
			->add_param('sort', $sort )
			->add_param('limit', $limit )
			;

		if( $search ){
			$api->add_param('search', $search);
		}

		if( $skip ){
			$api->add_param('id', array('NOTIN', $skip));
		}

// echo $api->url();

		$entries = $api
			->get()
			->response()
			;

		$return = array( $entries, $total_count, $page, $search );
		return $return;
	}

	public function route_index()
	{
		list( $entries, $total_count, $page, $search ) = $this->run('entries');

		$view = $this->make('view/ajax')
			->run('render', $entries, $total_count, $page, $search)
			;
		return $this->make('/http/view/response')
			->set_view($view)
			;
	}
}