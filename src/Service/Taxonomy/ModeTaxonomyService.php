<?php

namespace App\Service\Taxonomy;

use App\Traits\Module\TaxonomyTrait;

if (! defined('ABSPATH')) {
    exit;
}

final class ModeTaxonomyService
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
            'name'              			=> __('Modes', 'agence'),
            'singular_name'     			=> __('Mode', 'agence'),
            'search_items'      			=> __('Chercher un mode', 'agence'),
            'all_items'        				=> __('Tous les modes', 'agence'),
            'edit_item'         			=> __('Editer le mode', 'agence'),
            'update_item'       			=> __('Mettre à jour le mode', 'agence'),
            'add_new_item'     				=> __('Ajouter une nouveau mode', 'agence'),
            'new_item_name'     			=> __('Valeur du mode', 'agence'),
            'separate_items_with_commas'	=> __('Séparer les modes avec une virgule', 'agence'),
            'menu_name'                     => __('Modes', 'agence'),
        ];

        $args = [
            'hierarchical'          => true,
            'labels'                => $labels,
            'show_ui'               => true,
            'show_in_rest'          => true,
            'show_admin_column'     => true,
            'rewrite'               => ['slug' => __('propriete', 'agence')],
            'show_in_menu'          => true,
            'show_in_quick_edit'    => false,
            'meta_box_cb'           => false,
        ];

        $this->registerTaxonomy('ag_mode', ['ag_property'], $args);
    }
}