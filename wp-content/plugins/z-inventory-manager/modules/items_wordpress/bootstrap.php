<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Items_Wordpress_Bootstrap_IM_HC_MVC extends _HC_MVC
{
	public function run()
	{
		$this->register_types();

		$this_type = $this->app_short_name() . '-item';

	// THIS WILL ENABLE OUR SEARCH ON CUSTOM FIELDS
		$lib = $this->make('/wordpress/lib/custom-search')
			->enable( array($this_type) )
			;

		$view = $this->make('view/index');
	// METABOX
		add_action(
			'add_meta_boxes',
			array($this, 'add_meta_boxes')
			);

	// LISTING HEADER
		add_filter(
			'manage_' . $this_type . '_posts_columns',
			array($view, 'posts_columns')
			);

	// LISTING ROWS
		add_filter(
			'manage_' . $this_type . '_posts_custom_column',
			array($view, 'custom_columns'), 10, 2
			);
		}

	public function add_meta_boxes()
	{
		$this_type = $this->app_short_name() . '-item';
		$view = $this->make('view/zoom');

		add_meta_box(
			$this_type . '-' . 'details',	// id
			HCM::__('Item Details'),		// title
			array($view, 'render'),			// callable
			$this_type,						// screeen
			'advanced',						// context
			'core'							// priority
			);

		$menubar = $this->make('view/zoom/menubar');
		add_meta_box(
			$this_type . '-' . 'menubar',	// id
			HCM::__('Item Menubar'),		// title
			array($menubar, 'render'),		// callable
			$this_type,						// screeen
			'side',							// context
			'core'							// priority
			);
	}

	public function register_types()
	{
		$app_title = isset($this->app->app_config['nts_app_title']) ? $this->app->app_config['nts_app_title'] : 'Inventory Manager';

	// register custom types
		register_post_type( 
			$this->app_short_name() . '-' . 'item',
			array(
				'labels' => array(
					// 'menu_name'		=> HCM::__('Items'),
					'menu_name'		=> $app_title,
					'name'			=> HCM::__('Inventory'),
					'singular_name'	=> HCM::__('Item'),
					'not_found'		=> HCM::__('No Items Found'),
					'new_item'		=> HCM::__('New Item'),
					'add_new' 		=> HCM::__('Add New Item'),
					'add_new_item'	=> HCM::__('Add New Item'),
					'edit_item'		=> HCM::__('Edit Item'),
					'all_items'		=> HCM::__('Inventory'),
					'search_items'	=> HCM::__('Search Items'),
					'view_item'		=> HCM::__('View Items'),
					),
				'public' => true,
				'has_archive' => false,
				'exclude_from_search' => true,
				'show_in_menu' => $this->app_short_name(),
				// 'show_in_menu' => FALSE,
				// 'show_in_nav_menus'	=> FALSE,
				)
			);
	}
}