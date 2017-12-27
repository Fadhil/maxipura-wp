<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Sales_Controller_Update_IM_HC_MVC extends _HC_MVC
{
	public function route_index( $id )
	{
		$post = $this->make('/input/lib')->post();
		if( ! $post ){
			return;
		}

		$form = $this->make('form');
		$form->grab( $post );

		$valid = $form->validate();
		if( ! $valid ){
			$form_errors = array(
				$form->slug()	=> $form->errors()
				);
			$form_values = array(
				$form->slug()	=> $form->values()
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

		$values = $form->values();
		$values = $form->run('to-model', $values);
		$values['id'] = $id;

	/* API */
		$api = $this->make('/http/lib/api')
			->request('/api/sales')
			;

		$api->put( $id, $values );

		$status_code = $api->response_code();
		$api_out = $api->response();

		if( $status_code != '200' ){
			$form_errors = array(
				$form->slug()	=> $api_out['errors']
				);
			$form_values = array(
				$form->slug()	=> $form->values()
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

	// OK
		$redirect_to = $this->make('/html/view/link')
			->to('zoom', array('-id' => $id))
			// ->to()
			->href()
			;

		return $this->make('/http/view/response')
			->set_redirect($redirect_to) 
			;
	}
}