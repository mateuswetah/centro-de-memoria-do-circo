<?php

/**
 * Registers the curadorias post type.
 */
function cmc_curadoria_post_type_init() {

    // Registers curadoria post type 
    $args = array(
        'labels'             => array(
            'name'                  => _x( 'Curadorias', 'Post type general name', 'cmc' ),
            'singular_name'         => _x( 'Curadoria', 'Post type singular name', 'cmc' ),
            'menu_name'             => _x( 'Curadorias', 'Admin Menu text', 'cmc' ),
            'name_admin_bar'        => _x( 'Curadoria', 'Add New on Toolbar', 'cmc' ),
            'add_new'               => __( 'Adicionar Nova', 'cmc' ),
            'add_new_item'          => __( 'Adicionar Nova Curadoria', 'cmc' ),
            'new_item'              => __( 'Nova Curadoria', 'cmc' ),
            'edit_item'             => __( 'Editar Curadoria', 'cmc' ),
            'view_item'             => __( 'Ver Curadoria', 'cmc' ),
            'all_items'             => __( 'Todos as Curadorias', 'cmc' ),
            'search_items'          => __( 'Pesquisar Curadorias', 'cmc' ),
            'parent_item_colon'     => __( 'Curadorias raiz:', 'cmc' ),
            'not_found'             => __( 'Nenhuma Curadoria encontrado.', 'cmc' ),
            'not_found_in_trash'    => __( 'Nenhuma Curadoria encontrado na lixeira.', 'cmc' ),
            'featured_image'        => _x( 'Imagem de capa do Curadoria', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'cmc' ),
            'set_featured_image'    => _x( 'Configurar imagem de capa', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'cmc' ),
            'remove_featured_image' => _x( 'Remover imagem de capa', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'cmc' ),
            'use_featured_image'    => _x( 'Usar como imagem de capa', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'cmc' ),
            'archives'              => _x( 'Lista de Curadorias', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'cmc' ),
            'insert_into_item'      => _x( 'Inserir na Curadoria', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'cmc' ),
            'uploaded_to_this_item' => _x( 'Enviado para esta Curadoria', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'cmc' ),
            'filter_items_list'     => _x( 'Filtrar lista de Curadorias', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'cmc' ),
            'items_list_navigation' => _x( 'Navegação na lista de Curadorias', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'cmc' ),
            'items_list'            => _x( 'Lista de Curadorias', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'cmc' ),
        ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'curadorias' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'show_in_rest'       => true,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-format-quote',
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    );

    register_post_type( 'curadorias', $args );
}
add_action( 'init', 'cmc_curadoria_post_type_init' );
