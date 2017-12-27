<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Sales_Controller_New_IM_HC_MVC extends _HC_MVC
{
	public function route_index()
	{
		$values = array();
		$args = $this->make('/app/lib/args')->parse( func_get_args() );

		$duplicate = $args->get('duplicate');
		if( $duplicate ){
			$api = $this->make('/http/lib/api')
				->request('/api/sales')
				->add_param('id', $duplicate)
				->add_param('with', '-all-')
				;
			$duplicate = $api
				->get()
				->response()
				;

			if( $duplicate ){
				$form = $this->make('form');
				$values = $form->run('from-model', $duplicate);
			}
		}

		$t = $this->make('/app/lib')->run('time');
		$values['date'] = $t->formatDateDb();

	// generate new number
		$app_settings = $this->make('/app/lib/settings');
		$values['ref'] = $app_settings->run('get', 'sales:next_ref');

		$view = $this->make('view/new')
			->run('render', $values)
			;
		$view = $this->make('view/new/layout')
			->run('render', $view)
			;
		$view = $this->make('/layout/view/body')
			->set_content($view)
			;
		return $this->make('/http/view/response')
			->set_view($view)
			;
	}
}