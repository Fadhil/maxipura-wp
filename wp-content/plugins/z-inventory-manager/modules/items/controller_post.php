<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Controller_Post_IM_HC_MVC extends _HC_MVC
{
	public function route_index( $id = NULL )
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
		if( $id ){
			$values['id'] = $id;
		}

	/* API */
		$api = $this->make('/http/lib/api')
			->request('/api/items')
			;

		if( $id ){
			$api->put( $id, $values );
		}
		else {
			$api->post( $values );
		}

		$status_code = $api->response_code();
		$api_out = $api->response();

		if( substr($status_code, 0, 1) != '2' ){
			$errors = $api_out['errors'];

			$form_errors = array(
				$form->slug()	=> $errors
				);
			$form_values = array(
				$form->slug()	=> $form->values()
				);

			$session = $this->make('/session/lib');
			$session
				->set_flashdata('form_errors', $form_errors)
				->set_flashdata('form_values', $form_values)
				;

			$errors_keys = array_keys( $errors );
			$hash = array_shift( $errors_keys );
			$redirect_to = $this->make('/html/view/link')
				->to('-referrer-')
				->href()
				;
			return $this->make('/http/view/response')
				->set_redirect($redirect_to) 
				;
		}

		$return = TRUE;
		return $return;
	}
}