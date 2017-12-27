<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Selector_View_Index_IM_HC_MVC extends _HC_MVC
{
	public function render( $entries, $total_count, $page, $search = '' )
	{
		$per_page = 5;
		$preparer = $this->make('/items/view/index/prepare');

		$header = $this->run('prepare-header');
		$sort = $preparer->run('prepare-sort');

		$rows = array();
		foreach( $entries as $e ){
			$rows[$e['id']] = $preparer->run('prepare-row', $e);

			$rows[$e['id']]['title_view'] = $this->make('/html/view/link')
				->to('zoom', array('id' => $e['id']))
				->add( $rows[$e['id']]['title'] )
				->add_attr('class', 'hcj2-ajax-loader')
				;
		}

		$out = $this->make('/html/view/container');

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

		if( $rows OR $search ){
			$submenu
				->add( $search_view->run('render', $search, 'ajax') )
				;
		}

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
				->set_header($header)
				->set_rows($rows)
				->set_sort($sort)
				;
			$out
				->add( $table )
				;
		}
		elseif( $search ){
			$msg = HCM::__('No Matches');
			$out
				->add( $msg )
				;
		}
		else{
			$msg = HCM::__('No Items Available');
			$out
				->add( $msg )
				;
		}

		return $out;
	}

	public function prepare_header()
	{
		$return = array(
			'title' 		=> HCM::__('Title'),
			'ref' 			=> HCM::__('Ref Code'),
			'qty' 			=> HCM::__('Quantity'),
			);
		return $return;
	}
}