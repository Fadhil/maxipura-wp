<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Shipments_Sales_Controller_Add_IM_HC_MVC extends _HC_MVC
{
	public function route_index()
	{
		$args = $this->make('/app/lib/args')->run('parse', func_get_args());

		$sale_id = $args->get('sale');
		if( ! $sale_id ){
			return;
		}

		$sale = $this->make('/http/lib/api')
			->request('/api/sales')
			->add_param('id', $sale_id)
			->add_param('with', '-all-')
			->get()
			->response()
			;

		$post = $this->make('/input/lib')
			->post()
			;

		$form = $this->make('form');
		$form->grab( $post );
		$valid = $form->validate();
		$this_form_values = $form->values();

		if( ! $valid ){
			$form_errors = array(
				$form->slug()	=> $form->errors()
				);
			$form_values = array(
				$form->slug()	=> $this_form_values
				);

			$session = $this->make('/session/lib');
			$session
				->set_flashdata('form_errors', $form_errors)
				->set_flashdata('form_values', $form_values)
				;
			$redirect_to = $this->make('/html/view/link')
				->to('-referrer-')
				->href()
				;
			return $this->make('/http/view/response')
				->set_redirect($redirect_to) 
				;
		}

		$values = $form->run('to-model', $this_form_values);

		$values['sale'] = $sale_id;

	// SUBMIT
		$api = $this->make('/http/lib/api')
			->request('/api/shipments')
			;
		$api->post( $values );

		$status_code = $api->response_code();
		$api_out = $api->response();
		if( $status_code != '201' ){
			$form_errors = array(
				$form->slug()	=> $api_out['errors']
				);
			$form_values = array(
				$form->slug()	=> $this_form_values
				);

			$session = $this->make('/session/lib');
			$session
				->set_flashdata('form_errors', $form_errors)
				->set_flashdata('form_values', $form_values)
				;
			$redirect_to = $this->make('/html/view/link')
				->to('-referrer-')
				->href()
				;
			return $this->make('/http/view/response')
				->set_redirect($redirect_to) 
				;
		}

	// COMPLETE
		$redirect_to = $this->make('/html/view/link')
			->to('', array('-sale' => $sale_id))
			->href()
			;
		return $this->make('/http/view/response')
			->set_redirect($redirect_to) 
			;
	}

	public function route_all()
	{
		$args = $this->make('/app/lib/args')->run('parse', func_get_args());

		$sale_id = $args->get('sale');
		if( ! $sale_id ){
			return;
		}

		$api = $this->make('/http/lib/api')
			->request('/api/sales')
			;
		$sale = $api
			->add_param('id', $sale_id)
			->add_param('with', '-all-')
			->get()
			->response()
			;

		$manager = $this->make('/sales_items/model/manager');
		$need_items = $manager->run('need-items', $sale);

		$items = array();
		foreach( $need_items as $item_id => $qty ){
			$items[ $item_id ] = array('qty' => $qty);
		}

		$values = array(
			'sale'	=> $sale_id,
			'items'		=> $items,
			);

	// SUBMIT
		$api = $this->make('/http/lib/api')
			->request('/api/shipments')
			;
		$api->post( $values );

		$status_code = $api->response_code();
		$api_out = $api->response();

		if( $status_code != '201' ){
			_print_r( $api_out['errors'] );
			exit;
		}

	// COMPLETE
		$redirect_to = $this->make('/html/view/link')
			->to('-referrer-')
			->href()
			;
		return $this->make('/http/view/response')
			->set_redirect($redirect_to) 
			;
	}
}