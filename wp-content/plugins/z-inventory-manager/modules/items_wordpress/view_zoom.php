<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Wordpress_View_Zoom_IM_HC_MVC extends _HC_MVC
{
	public function render( $post )
	{
		$id = $post->ID;

		$api = $this->make('/http/lib/api')
			->request('/api/items')
			->add_param('id', $id)
			->add_param('with', '-all-')
			;

		$model = $api
			->get()
			->response()
			;

		$out = $this->make('/html/view/form');

		$form = $this->make('/items/form');
		$out
			->set_form( $form )
			->set_route('/items/update')
			;

		$values = $form->run('from-model', $model);
		$form->set_values( $values );

		$inputs = $form->run('inputs');

		foreach( $inputs as $input_name => $input ){
			if( $input->slug == '/form/view/hidden' ){
				$out
					->add( $input )
					;
			}
			else {
				$input_view = $this->make('/html/view/label-input')
					->set_label( $input->label() )
					->set_content( $input )
					->set_error( $input->error() )
					;
				$out
					->add( $input_view )
					;
			}
		}

		$return = $out->run('render');
		echo $return;
	}
}
