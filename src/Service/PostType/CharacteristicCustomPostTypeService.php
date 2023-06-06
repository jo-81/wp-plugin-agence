<?php

namespace App\Service\PostType;

use App\Traits\Module\PostTypeTrait;

if (! defined('ABSPATH')) {
    exit;
}

final class CharacteristicCustomPostTypeService
{
    use PostTypeTrait;

    public function addCustomPostType(): void
    {
        $labels = [
            'name'                => __('Caracréristiques', 'agence'),
            'singular_name'       => __('Caractéristique', 'agence'),
            'menu_name'           => __('Caractéristiques', 'agence'),
            'all_items'           => __('Toutes les caracréristiques', 'agence'),
            'view_item'           => __('Voir les caracréristiques', 'agence'),
            'add_new_item'        => __('Ajouter une nouvelle caractéristique', 'agence'),
            'add_new'             => __('Ajouter', 'agence'),
            'edit_item'           => __('Editer la caractéristique', 'agence'),
            'update_item'         => __('Modifier la caractéristique', 'agence'),
            'search_items'        => __('Rechercher une caractéristique', 'agence'),
            'not_found'           => __('Non trouvée', 'agence'),
            'not_found_in_trash'  => __('Non trouvée dans la corbeille', 'agence'),
        ];

        $args = [
            'label'                 => __('caracréristiques', 'agence'),
            'description'           => __('Tous sur caracréristiques', 'agence'),
            'labels'                => $labels,
            'supports'              => ['title'],
            'show_in_rest'          => false,
            'hierarchical'          => true,
            'public'                => true,
            'has_archive'           => true,
            'rewrite'			    => ['slug' => __('caracteristiques', 'agence')],
            'menu_position'         => 29,
            'query_var'             => true,
            'taxonomies'            => ['ag_category'],
            'show_in_menu'          => false,
        ];

        $this->registerCustomPostType('ag_characteristic', $args);
    }
}