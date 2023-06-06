<?php

namespace App\Service\PostType;

use App\Traits\Module\PostTypeTrait;

if (! defined('ABSPATH')) {
    exit;
}

final class PropertyCustomPostTypeService
{
    use PostTypeTrait;

    public function addCustomPostType(): void
    {
        $labels = [
            'name'                => __('Propriétés', 'agence'),
            'singular_name'       => __('Propriété', 'agence'),
            'menu_name'           => __('Propriétés', 'agence'),
            'all_items'           => __('Toutes les propriétés', 'agence'),
            'view_item'           => __('Voir les propriétés', 'agence'),
            'add_new_item'        => __('Ajouter une nouvelle propriété', 'agence'),
            'add_new'             => __('Ajouter', 'agence'),
            'edit_item'           => __('Editer la propriété', 'agence'),
            'update_item'         => __('Modifier la propriété', 'agence'),
            'search_items'        => __('Rechercher une propriété', 'agence'),
            'not_found'           => __('Non trouvée', 'agence'),
            'not_found_in_trash'  => __('Non trouvée dans la corbeille', 'agence'),
        ];

        $args = [
            'label'                 => __('propriétés', 'agence'),
            'characteristic'           => __('Tous sur propriétés', 'agence'),
            'labels'                => $labels,
            'supports'              => ['title', 'editor', 'thumbnail'],
            'show_in_rest'          => false,
            'hierarchical'          => true,
            'public'                => true,
            'has_archive'           => true,
            'rewrite'			    => ['slug' => __('proprietes', 'agence')],
            'menu_position'         => 28,
            'query_var'             => true,
            'menu_icon'             => 'dashicons-admin-multisite',
            'taxonomies'            => ['ag_type', 'ag_mode'],
            'show_in_menu'          => false,
            'show_in_nav_menus'     => true,
        ];

        $this->registerCustomPostType('ag_property', $args);
    }
}