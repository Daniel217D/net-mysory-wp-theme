<?php

add_action(
	'init',
	function () {
		register_taxonomy(
			'cities',
			[ 'trash-dot' ],
			[
				'label'               => 'Населенные пункты', // определяется параметром $labels->name
				'labels'              => [
					'name'              => 'Населенные пункты',
					'singular_name'     => 'Населенный пункт',
					'search_items'      => 'Поиск по населенным пунктам',
					'all_items'         => 'Все населенные пункты',
					'view_item '        => 'Населенный пункт',
					'parent_item'       => 'Находится в',
					'parent_item_colon' => 'Находится в:',
					'edit_item'         => 'Редактировать населенный пункт',
					'update_item'       => 'Обновить населенный пункт',
					'add_new_item'      => 'Добавить населенный пункт',
					'new_item_name'     => 'Новый населенный пункт',
					'menu_name'         => 'Населенные пункты',
					'back_to_items'     => '← Обратно к населенным пунктам',
				],
				'description'         => 'Области, города, районы, села, деревни', // описание таксономии
				'public'              => true,
				'hierarchical'        => true,
				'exclude_from_search' => false,
				'capabilities'        => array(),
				'show_admin_column'   => true,
				'show_in_rest'        => null,
				'rest_base'           => null,
				'rewrite'             => array(
					'hierarchical' => true,
				),
			]
		);

		register_post_type(
			'trash-dot',
			[
				'label'         => null,
				'labels'        => [
					'name'               => 'Метка мусора',
					'singular_name'      => 'Метка мусора', // название для одной записи этого типа
					'add_new'            => 'Добавить метку', // для добавления новой записи
					'add_new_item'       => 'Добавление метку', // заголовка у вновь создаваемой записи в админ-панели.
					'edit_item'          => 'Редактирование метки', // для редактирования типа записи
					'new_item'           => 'Новая метка', // текст новой записи
					'view_item'          => 'Открыть метку', // для просмотра записи этого типа.
					'search_items'       => 'Искать метки', // для поиска по этим типам записи
					'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
					'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
					'parent_item_colon'  => 'Метки', // для родителей (у древовидных типов)
					'menu_name'          => 'Метки мусора', // название меню
				],
				'description'   => 'Метки мусора для отображения на карте',
				'public'        => true,
				'show_in_menu'  => true,
				// показывать ли в меню админки
				'menu_position' => null,
				'menu_icon'     => null,
				//'capability_type'   => 'post',
				//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
				//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
				'hierarchical'  => true,
				'supports'      => [ 'title', 'editor' ],
				// 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
				'taxonomies'    => [ 'cities' ],
				'has_archive'   => true,
				'rewrite'       => true,
				'query_var'     => true,
			]
		);

		$get_post_type              = get_post_type_object( 'post' );
		$labels                     = $get_post_type->labels;
		$labels->name               = 'Новости';
		$labels->singular_name      = 'Новости';
		$labels->add_new            = 'Добавить новость';
		$labels->add_new_item       = 'Добавить новость';
		$labels->edit_item          = 'Редактировать новости';
		$labels->new_item           = 'Новости';
		$labels->view_item          = 'Просмотреть новости';
		$labels->search_items       = 'Поиск по новостям';
		$labels->not_found          = 'Новости не найдены';
		$labels->not_found_in_trash = 'Новости не найдены в корзине';
		$labels->all_items          = 'Все новости';
		$labels->menu_name          = 'Новости';
		$labels->name_admin_bar     = 'Новости';
	}
);