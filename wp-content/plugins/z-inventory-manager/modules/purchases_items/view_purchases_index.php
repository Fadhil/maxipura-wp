<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Purchases_Items_View_Purchases_Index_IM_HC_MVC extends _HC_MVC
{
	public function render( $purchases, $item )
	{
		$header = $this->run('prepare-header');
		$sort = $this->run('prepare-sort');

		$rows = array();
		foreach( $purchases as $e ){
			$rows[$e['id']] = $this->run('prepare-row', $e, $item);
		}

		$out = $this->make('/html/view/container');

		if( $rows ){
			// prepare footer with totals
			$footer = array();
			$footer['ref'] = HCM::__('Total');

			$calc = $this->make('/finance/lib/calc');

			$footer['qty'] = 0;
			$footer['total'] = 0;
			foreach( $rows as $r ){
				$footer['qty'] += $r['qty'];
				$calc->add( $r['total'] );
			}
			$footer['total'] = $calc->format();

			$table = $this->make('/html/view/sorted-table')
				->set_header( $header )
				->set_rows( $rows )
				->set_sort( $sort )
				->set_footer( $footer );
				;
			$out->add( $table );
		}

		return $out;
	}

	public function prepare_header()
	{
		$return = array(
			'date'	=> HCM::__('Date'),
			'ref'	=> HCM::__('Reference'),
			'qty'	=> HCM::__('Quantity'),
			'cost'	=> HCM::__('Price'),
			'total'	=> HCM::__('Total'),
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

	public function prepare_row( $e, $item )
	{
		$return = array();

		$p = $this->make('/purchases/presenter')
			->set_data( $e )
			;

		$row = array();
		$row['ref']		= $e['ref'];

		$view = $p->present_title();
		$view = $this->make('/html/view/link')
			->to('/purchases/zoom', array('-id' => $e['id']))
			->add($view)
			->always_show()
			;
		$row['ref_view'] = $view;

		$row['date']		= $e['date'];

		$t = $this->make('/app/lib')->run('time');
		$t->setDateDb( $e['date'] );
		$row['date_view'] = $t->formatDateFullShort();

		$calc = $this->make('/finance/lib/calc');

		if( isset($e['items'][$item['id']]) ){
			$this_item = $e['items'][$item['id']];
			$row['qty'] = $this_item['_qty'];

			$calc->reset()->add( $this_item['_price'] );
			$row['cost'] = $calc->result();
			$row['cost_view'] = $calc->format();

			$calc->reset()->add( $this_item['_qty'] * $row['cost'] );
			$row['total'] = $calc->result();
			$row['total_view'] = $calc->format();
		}

		return $row;
	}
}