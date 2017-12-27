<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Receives_Controller_Delete_IM_HC_MVC extends _HC_MVC
{
	public function route_index( $id )
	{
	/* API */
		$api = $this->make('/http/lib/api')
			->request('/api/receives')
			;

		$api->delete( $id );

		$status_code = $api->response_code();
		$api_out = $api->response();

		if( $status_code != '204' ){
			echo $api_out['errors'];
			exit;
		}

	// OK
		$redirect_to = $this->make('/html/view/link')
			->to('-referrer-')
			->href()
			;

		return $this->make('/http/view/response')
			->set_redirect($redirect_to) 
			;
	}
}