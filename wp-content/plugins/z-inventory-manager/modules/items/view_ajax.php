<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_View_Ajax_IM_HC_MVC extends _HC_MVC
{
	public function render( $entries, $total_count, $page = 1, $search = '' )
	{
		$per_page = 10;
		$out = $this->make('/html/view/container');

		$prepare = $this->make('/items/view/index/prepare');

		$header = $prepare->run('prepare-header');
		$sort = $prepare->run('prepare-sort');

		$rows = array();
		foreach( $entries as $e ){
			$rows[$e['id']] = $prepare->run('prepare-row', $e);
		}

		$submenu = $this->make('/html/view/list-inline');
		if( $total_count > $per_page ){
			$pager_link = $this->make('/html/view/link')
				->add_attr('class', 'hcj2-ajax-loader')
				;
			$pager = $this->make('/html/view/pager')
				->set_link_template( $pager_link )
				->set_total_count( $total_count )
				->set_current_page( $page )
				->set_per_page($per_page)
				;

			$submenu
				->add( $pager )
				;
		}

		$search_view = $this->make('/search/view');
		$submenu
			// ->add( $search_view->run('render', $search, 'ajax') )
			->add( $search_view->run('render', $search) )
			;
		$out
			->add( $submenu )
			;

		if( $rows ){
			foreach( array_keys($header) as $k ){
				$header[$k] = $this->make('/html/view/link')
					->add( $header[$k] )
					->add_attr('class', 'hcj2-ajax-loader')
					;
			}

			$table = $this->make('/html/view/sorted-table')
				->set_header( $header )
				->set_sort( $sort )
				->set_rows( $rows )
				;

			$out
				->add( $table )
				;
		}

		return $out;
	}
}