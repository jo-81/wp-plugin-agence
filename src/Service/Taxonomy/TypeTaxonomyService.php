<?php

namespace App\Service\Taxonomy;

use App\Traits\Module\TaxonomyTrait;

if (! defined('ABSPATH')) {
    exit;
}

final class TypeTaxonomyService
{
    use TaxonomyTrait;

    public function addTaxonomy()
    {
        $labels = [
            'name'              			=> __('Types', 'agence'),
            'singular_name'     			=> __('Type', 'agence'),
            'search_items'      			=> __('Chercher un type', 'agence'),
            'all_items'        				=> __('Tous les types', 'agence'),
            'edit_item'         			=> __('Editer le type', 'agence'),
            'update_item'       			=> __('Mettre à jour le type', 'agence'),
            'add_new_item'     				=> __('Ajouter un nouveau type', 'agence'),
            'new_item_name'     			=> __('Valeur de le nouveau type', 'agence'),
            'separate_items_with_commas'	=> __('Séparer les types avec une virgule', 'agence'),
            'menu_name'                     => __('Types', 'agence'),
        ];

        $args = [
            'hierarchical'          => true,
            'labels'                => $labels,
            'show_ui'               => true,
            'show_in_rest'          => true,
            'show_admin_column'     => true,
            'rewrite'               => ['slug' => __('types', 'agence')],
            'show_in_menu'          => true,
            'show_in_quick_edit'    => false,
            'meta_box_cb'           => false,
        ];

        $this->registerTaxonomy('ag_type', ['ag_property'], $args);
    }
}