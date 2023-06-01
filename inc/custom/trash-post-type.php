<?php

add_action( 'init', function () {
	register_post_type( 'post_type_name', [
		'label'  => null,
		'labels' => [
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
			'menu_name'          => 'Метки', // название меню
		],
		'description'            => 'Метки мусора для отображения на карте',
		'public'                 => true,
		'show_in_menu'           => true, // показывать ли в меню админки
		'menu_position'       => null,
		'menu_icon'           => null,
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	] );

} );