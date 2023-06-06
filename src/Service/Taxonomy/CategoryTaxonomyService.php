<?php

namespace App\Service\Taxonomy;

use App\Traits\Module\TaxonomyTrait;

if (! defined('ABSPATH')) {
    exit;
}

final class CategoryTaxonomyService
{
    use TaxonomyTrait;
    
    /**
     * addTaxonomy
     *
     * @return void
     */
    public function addTaxonomy()
    {
        $labels = [
            'name'              			=> __('Catégories', 'agence'),
            'singular_name'     			=> __('Catégorie', 'agence'),
            'search_items'      			=> __('Chercher une catégorie', 'agence'),
            'all_items'        				=> __('Toutes les catégories', 'agence'),
            'edit_item'         			=> __('Editer la catégorie', 'agence'),
            'update_item'       			=> __('Mettre à jour la catégorie', 'agence'),
            'add_new_item'     				=> __('Ajouter une nouvelle catégorie', 'agence'),
            'new_item_name'     			=> __('Valeur de la nouvelle catégorie', 'agence'),
            'separate_items_with_commas'	=> __('Séparer les catégories avec une virgule', 'agence'),
            'menu_name'                     => __('Categories', 'agence'),
        ];

        $args = [
            'hierarchical'          => true,
            'labels'                => $labels,
            'show_ui'               => true,
            'show_in_rest'          => true,
            'show_admin_column'     => true,
            'rewrite'               => ['slug' => __('categories', 'agence')],
            'show_in_menu'          => true,
            'show_in_quick_edit'    => false,
            'meta_box_cb'           => false,
        ];

        $this->registerTaxonomy('ag_category', ['ag_characteristic'], $args);
    }
}