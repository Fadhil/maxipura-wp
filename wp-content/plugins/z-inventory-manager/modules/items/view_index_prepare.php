<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_View_Index_Prepare_IM_HC_MVC extends _HC_MVC
{
	public function prepare_header()
	{
		$return = array(
			'title' 		=> HCM::__('Title'),
			'ref' 			=> HCM::__('SKU'),
			'qty' 			=> HCM::__('In Stock'),
			// 'id' 		=> 'ID',
			);
		return $return;
	}

	public function prepare_sort()
	{
		$return = array(
			'title'	=> 1,
			// 'qty'	=> 0,
			'ref'	=> 1,
			);
		return $return;
	}

	public function prepare_row( $e )
	{
		$return = array();
		if( ! $e ){
			return $return;
		}

		$p = $this->make('presenter')
			->set_data( $e )
			;

		$row = array();

		$name_view = $p->present_title();
		$row['title'] = $name_view;

		$name_view = $this->make('/html/view/link')
			->to('zoom', array('id' => $e['id']))
			->add($name_view)
			;
		$row['title_view'] = $name_view->run('render');

		$row['id']		= $e['id'];
		$id_view = $this->make('/html/view/element')->tag('span')
			->add_attr('class', 'hc-fs2')
			->add_attr('class', 'hc-muted-2')
			->add( $e['id'] )
			;
		$row['id_view']	= $id_view->run('render');

		if( array_key_exists('ref', $e) ){
			$row['ref'] = $e['ref'];
		}

		$manager = $this->make('model/manager');
		$qty = $manager->run('item-count', $e['id']);

		$row['qty'] = $qty;
		return $row;
	}
}