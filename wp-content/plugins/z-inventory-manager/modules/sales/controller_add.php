<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Sales_Controller_Add_IM_HC_MVC extends _HC_MVC
{
	public function route_index()
	{
	// GET POST
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

	// SUBMIT
		$api = $this->make('/http/lib/api')
			->request('/api/sales')
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
			->to('')
			->href()
			;
		return $this->make('/http/view/response')
			->set_redirect($redirect_to) 
			;
	}
}