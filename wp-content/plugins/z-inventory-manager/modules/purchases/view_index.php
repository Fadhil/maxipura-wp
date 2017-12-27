<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Purchases_View_Index_IM_HC_MVC extends _HC_MVC
{
	public function render( $entries, $total_count, $page = 1, $search = '' )
	{
		$per_page = 20;

		$header = $this->run('prepare-header');
		$sort = $this->run('prepare-sort');

		$rows = array();
		foreach( $entries as $e ){
			$rows[$e['id']] = $this->run('prepare-row', $e);
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

		if( ($total_count > 1) OR $search ){
			$search_view = $this->make('/search/view');
			$submenu
				->add( $search_view->run('render', $search) )
				;
		}

		$out
			->add( $submenu )
			;

		if( $rows ){
			$table = $this->make('/html/view/sorted-table')
				->set_header( $header )
				->set_rows( $rows )
				->set_sort( $sort )
				;
			$out->add( $table );
		}
		elseif( $search ){
			$msg = HCM::__('No Matches');
			$out
				->add( $msg )
				;
		}

		return $out;
	}

	public function prepare_header()
	{
		$return = array(
			'ref'		=> HCM::__('Purchase #'),
			'date'		=> HCM::__('Date'),
			'status'	=> HCM::__('Status'),
			);
		return $return;
	}

	public function prepare_sort()
	{
		$return = array(
			'date'	=> 0,
			'ref'	=> 1,
			);
		return $return;
	}

	public function prepare_row( $e )
	{
		$return = array();

		$p = $this->make('presenter')
			->set_data( $e )
			;

		$row = array();

		$row['ref']		= $e['ref'];

		$view = $p->present_title();
		$view = $this->make('/html/view/link')
			->to('zoom', array('-id' => $e['id']))
			->add($view)
			->always_show()
			;
		$row['ref_view'] = $view;

		$row['date']		= $e['date'];

		$t = $this->make('/app/lib')->run('time');
		$t->setDateDb( $e['date'] );
		$row['date_view'] = $t->formatDateFullShort();

		$row['status'] = $p->run('present_status');

		return $row;
	}
}