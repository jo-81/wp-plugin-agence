<?php

namespace App\Traits\Module;

if (! defined('ABSPATH')) {
    exit;
}

trait TaxonomyTrait
{
    /**
     * registerTaxonomy
     * Ajoute une taxonomie
     *
     * @param  string $name
     * @param  mixed $post
     * @param  array|null $datas
     * @return void
     */
    public function registerTaxonomy(string $name, $post, ?array $datas): void
    {
        $result = register_taxonomy($name, $post, $datas);
        if (\is_wp_error($result)) {
            throw new \Exception($result->get_error_message());
        }
    }
    
    /**
     * registerValues
     * Ajoute une valeur pour une taxonomie $taxonomy
     *
     * @param  array $datas
     * @param  string $taxonomy
     * @return void
     */
    public function registerValues(array $datas, string $taxonomy)
    {
        if (! isset($datas['name'])) {
            throw new \Exception("La clé name n'existe pas pour enregistrer cette taxonomie");
        }
        $name = $datas['name'];
        unset($datas['name']);

        if (term_exists($name, $taxonomy)) {
            return;
        }

        if (empty($datas)) {
            throw new \Exception("Aucuns arguments pour cette taxonomie");
        }
        
        $result = wp_insert_term($name, $taxonomy, $datas);
        if (\is_wp_error($result)) {
            throw new \Exception($result->get_error_message());
        }
    }
}