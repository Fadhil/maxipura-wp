<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Conf_Controller_Update_HC_MVC extends _HC_MVC
{
	public function save( $posted )
	{
		$app_settings = $this->make('/app/lib/settings');
		if( $posted ){
			foreach( $posted as $k => $v ){
				$app_settings->set( $k, $v );
			}
			$model = $this->make('model');
			$model->run('save');
			$app_settings->reload();
		}
	}

	public function grab( $tab )
	{
		$return = array();

		$config_loader = $this->make('/app/lib/config-loader');

		$fields = $config_loader->get('settings');
		$tabs = $this->make('controller')
			->run('get-tabs', $fields)
			;

		$this_fields = $tabs[$tab];
		$form = $this->make('controller')
			->run('form', $tab)
			;

		$post = $this->make('/input/lib')->post();
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
			return $return;
		}

		$values = $form->values();
		reset( $this_fields );

		foreach( $this_fields as $fn => $flabel ){
			if( $fn == '_label' ){
				continue;
			}
			if( array_key_exists($fn, $values) ){
				if( is_array($values[$fn]) OR strlen($values[$fn]) ){
					$return[$fn] = $values[$fn];
				}
			}
		}
		return $return;
	}

	public function route_index( $tab = '' )
	{
		$args = hc2_parse_args( func_get_args() );
		$tab = isset($args['tab']) ? $args['tab'] : '';

		$config_loader = $this->make('/app/lib/config-loader');

		$fields = $config_loader->get('settings');
		$tabs = $this->make('controller')
			->run('get-tabs', $fields)
			;

		$tab_keys = array_keys($tabs);
		if( ! $tab ){
			$tab = $tab_keys[0];
		}

		$posted = $this->run('grab', $tab);
		$this->run('save', $posted);

		$redirect_to = $this->make('/html/view/link')
			->to('-referrer-')
			->href()
			;
		return $this->make('/http/view/response')
			->set_redirect($redirect_to) 
			;
	}
}